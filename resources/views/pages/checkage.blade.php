@extends('layout.layout')
@section('content')
<main>
    <img src={{Storage::url($game->cover)}} alt={{$game->name}}>
    <p>CONTENT IN THIS PRODUCT MAY NOT BE APPROPRIATE FOR ALL AGES, OR MAY NOT BE APPROPRIATE FOR VIEWING AT WORK</p>
    <form class="mb-4" action="{{url()->current()}}" method="POST">
        @csrf
        <p>Please enter your birth date to continue</p>
        <input type="date" name="dob" id="dob">
        <button type="submit">View Page</button>
        <button name="cancel" value="cancel">Cancel</button>
    </form>
</main>
@endsection