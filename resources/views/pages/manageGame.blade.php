@extends('layout.layout')
@section('content')
<h1>Manage Games</h1>
    <form action="/manageGame" method="POST">
        @csrf
        <div>
            <label for="filterName">Filter by Games Name</label>
            <input type="search" id="filterName" name="filterName">
        </div>  
        <div>
            <p>Filter by Games Category</p>
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
        <button type="submit">Search</button>
    </form>
    @if (count($games)>0)
        <div>
            @for($i=0;$i<count($games);$i++)
            <div>
                <div>
                    <img src={{Storage::url($games[$i]->cover)}} alt={{$games[$i]->name}}>
                    <div>
                        <div>{{$games[$i]->name}}</div>
                        <div>{{$games[$i]->category}}</div>
                    </div>
                </div>
                <a href="/updateGame/{{$games[$i]->game_id}}">Update</a>
                <button onClick="renderPopup('{{$games[$i]->game_id}}')">Delete</button>
            </div>
            @endfor
        </div>
    @else
        <p>There are no games content can be showed right now.</p>
    @endif
    <div id="managegame-popup-container"></div>
    <a href="/createGame">Create Game</a>
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
                    <button type='submit' id="managegame-delete-btn">Delete</button>
                    <button id="managegame-cancel-btn">Cancel</button>
                </form>
            `;
        }
    </script>
@endsection