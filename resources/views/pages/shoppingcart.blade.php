@extends('layout.layout')
@section('content')
    <div>
        <a href="">Shopping Cart</a>
        <a href="">Transaction Information</a>
        <a href="">Transaction Receipt</a>
    </div>
    <h1>Shopping Cart</h1>
    <div>
        @for
        @if (count($games)>0)
        @for ($i = 0; $i < count($games); $i++)

        @endfor
        @else
            <p>Your cart is empty</p>
        @endif  
    </div>
@endsection