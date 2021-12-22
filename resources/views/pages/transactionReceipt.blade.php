@extends('layout.layout')
@section('content')
<main>
    <div>
        <p>Shopping Cart</p>
        <p>Transaction Information</p>
        <p>Transaction Receipt</p>
    </div>
    <h1>Transaction Receipt</h1>
    <div>
        <p>Transaction ID: {{$transactionHeader->transaction_header_id}}</p>
        <p>Purchased Date: {{$transactionHeader->purchase_date}}</p>
        <div>
            @for($i = 0; $i<count($transactionHeader->transactionDetails);$i++)
            <div>
                <img src={{Storage::url($transactionHeader->transactionDetails[$i]->game->cover)}} alt="">
                <p>{{$transactionHeader->transactionDetails[$i]->game->name}}</p>
                <p>Rp. {{$transactionHeader->transactionDetails[$i]->game->price}}</p>
            </div>
            @endfor
        </div>
        <p>Total Price Rp. {{$transactionHeader->total_price}}</p>
    </div>
</main>
@endsection