@extends('layout.layout')
@section('content')
<main>
    <div id="checkage-container">
        <div id="checkage-game-cover">
            <img src={{Storage::url($game->cover)}} alt={{$game->name}}>
        </div>
        <div id="checkage-detail-container">
            <div id="checkage-game-title">
                <p>CONTENT IN THIS PRODUCT MAY NOT BE APPROPRIATE FOR ALL AGES, OR MAY NOT BE APPROPRIATE FOR VIEWING AT WORK</p>
            </div>
            <div id="checkage-game-form">
                <form class="mb-4" action="{{url()->current()}}" method="POST">
                    @csrf
                    <div id="checkage-game-container">
                        <p>Please enter your birth date to continue</p>
                        <input type="date" name="dob" id="dob">
                    </div>
            </div>
            <div id="checkage-button-container">
                <div>
                    <button id="checkage-button-view" class="btn" type="submit">View Page</button>
                </div>
                <div>
                    <button id="checkage-button-cancel" class="btn" name="cancel" value="cancel">Cancel</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</main>
@endsection