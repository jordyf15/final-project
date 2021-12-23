@extends('layout.layout')
@section('content')
<main id='managegame-main'>
    <h1>Manage Games</h1>
    <form action="/manageGame" method="POST" id='managegame-form-filter'>
        @csrf
        <div id='managegame-filtername-container'>
            <label for="filterName" id='managegame-filtername-label'>Filter by Games Name</label><br>
            <input type="search" id="filterName" name="filterName">  <button type="submit" id='managegame-search-button'>Search</button>
        </div>
        <p id='managegame-categories-title'>Filter by Games Category</p>
        <div id='managegame-categories-container'>
            <span>
                <input type="checkbox" id='filterIdle' name="filterIdle">
                <label for="filterIdle">Idle</label>
            </span>
            <span>
                <input type="checkbox" id='filterHorror' name="filterHorror">
                <label for="filterHorror">Horror</label>
            </span>
            <span>
                <input type="checkbox" id='filterAdventure' name="filterAdventure">
                <label for="filterAdventure">Adventure</label>
            </span>
            <span>
                <input type="checkbox" id='filterAction' name="filterAction">
                <label for="filterAction">Action</label>
            </span>
            <span>
                <input type="checkbox" id='filterSports' name="filterSports">
                <label for="filterSports">Sports</label>
            </span>
            <span>
                <input type="checkbox" id='filterStrategy' name="filterStrategy">
                <label for="filterStrategy">Strategy</label>
            </span>
            <span>
                <input type="checkbox" id='filterRolePlaying' name="filterRolePlaying">
                <label for="filterRolePlaying">Role-Playing</label>
            </span>
            <span>
                <input type="checkbox" id='filterPuzzle' name="filterPuzzle">
                <label for="filterPuzzle">Puzzle</label>
            </span>
            <span>
                <input type="checkbox" id='filterSimulation' name="filterSimulation">
                <label for="filterSimulation">Simulation</label>
            </span>
        </div>
        <a id='managegame-creategame' href="/createGame">Create Game</a>
    </form>
    @if (count($games)>0)
        <div id='managegame-gamecontainer'>
            @for($i=0;$i<count($games);$i++)
            <div id='managegame-games'>
                <div id='managegame-games-info'>
                    <a href="/game/{{$games[$i]->game_id}}">
                        <img id='managegame-images' src={{Storage::url($games[$i]->cover)}} alt={{$games[$i]->name}}>
                    </a>
                    <div id='managegame-games-texts'>
                        <div id='manage-games-texts-title'>{{$games[$i]->name}}</div>
                        <div>{{$games[$i]->category}}</div>
                    </div>
                </div>
                <a id='managegame-games-update' href="/updateGame/{{$games[$i]->game_id}}">Update</a>
                <button id="managegame-games-delete" onClick="renderPopup('{{$games[$i]->game_id}}')">Delete</button>
            </div>
            @endfor
        </div>
        <div id="managegame-pagination-container">
            {{$games->withQueryString()->links()}}
        </div>
    @else
        <p>There are no games content can be showed right now.</p>
    @endif
    <div id="managegame-popup-container"></div>
    @if(session()->has('successMessage'))
    <div id="game-detail-success-container">
        <div id="game-detail-show-success">
            <div id="game-detail-success-content">
                <p>{{session()->get('successMessage')}}</p>
            </div>
        </div>
    </div>
    @endif
</main>
    <script>
        function renderPopup(game_id){
            const popupContainer = document.querySelector('#managegame-popup-container');
            const popupBg = document.createElement('div');
            popupBg.id = 'managegame-popup-bg';
            popupContainer.appendChild(popupBg);

            const popup = document.createElement('div');
            popup.id = 'managegame-popup';
            popupBg.appendChild(popup);

            const popupHeading = document.createElement('p');
            popupHeading.id = 'managegame-popup-heading';
            popupHeading.textContent = 'Delete Games';
            popup.appendChild(popupHeading);

            const popupContent = document.createElement('p');
            popupContent.id = 'managegame-popup-content';
            popupContent.textContent = 'Are you sure you want to delete this game? All of your data will be permanently removed. This action cannot be undone.';
            popup.appendChild(popupContent);

            const popupFormContainer = document.createElement('div');
            popupFormContainer.id = 'managegame-popup-formcontainer';
            popup.appendChild(popupFormContainer);

            popupFormContainer.innerHTML = `
                <form action="/game/${game_id}" id='managegame-popup-button-container' method='POST'>
                    @csrf
                    @method('DELETE')
                    <button type='button' id="managegame-cancel-btn">Cancel</button>
                    <button type='submit' id="managegame-delete-btn">Delete</button>
                </form>
            `;
            const cancelBtn = document.querySelector('#managegame-cancel-btn');
            cancelBtn.addEventListener('click',()=>{
                popupContainer.removeChild(popupBg);
            });
        }
    </script>
@endsection