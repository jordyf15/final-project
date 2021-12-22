@extends('layout.layout')
@section('content')
    <main>
        <h1>Transaction Information</h1>
        <form action="" method="POST">
            @csrf
            <div>
                <label for="cardName">Card Name</label>
                <input type="text" id="cardName" name="cardName" placeholder="Card Name">
            </div>
            <div>
                <label for="cardNumber">Card Number</label>
                <input type="text" id="cardNumber" name="cardNumber" placeholder="0000 0000 0000 0000">
            </div>
            <div>
                <label for="">Expired Date</label>
                <input type="text" id="expiredDateMonth" name="expiredDateMonth" placeholder="MM">
                <input type="text" id="expiredDateYear" name="expiredDateYear" placeholder="YYYY">
            </div>
            <div>
                <label for="cvccvv">CVC / CVV</label>
                <input type="text" id='cvccvv' name="cvccvv" placeholder="3 or 4 digit number">
            </div>
            <div>
                <label for="cardCountry">Country</label>
                <select name="cardCountry" id="cardCountry">
                    <option value="indonesia">Indonesia</option>
                    <option value="japan">Japan</option>
                    <option value="united kingdom">United Kingdom</option>
                    <option value="united states of america">United States of America</option>
                </select>
            </div>
            <div>
                <label for="zip">ZIP</label>
                <input type="text" name="zip" id="zip" placeholder="ZIP">
            </div>
            @php
                $total_price=0;
                for($i = 0;$i<count($games);$i++){
                    $total_price+=$games[$i]->price;
                }
            @endphp
            <p>Total Price <span>Rp. {{$total_price}}</span></p>
            <a href="/cart">Cancel</a><button type="submit">Checkout</button>
        </form>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach
        @endif
    </main>
@endsection