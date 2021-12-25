@extends('layout.layout')
@section('content')
<main id="receipt-main">
    <div id="bread-container">
        <div id="bread">
            <ol style="--bs-breadcrumb-divider: '>';" class="breadcrumb">
                <li class="breadcrumb-item">Shopping Cart</li>
                <li class="breadcrumb-item">Transaction Information</li>
                <li class="breadcrumb-item active">Transaction Receipt</li>
            </ol>
        </div>
    </div>
    <h1>Transaction Receipt</h1>
    <div id='receipt-container'>
        <p id='receipt-id'>Transaction ID: {{$transactionHeader->transaction_header_id}}</p>
        <p>Purchased Date: {{$transactionHeader->purchase_date}}</p>
        <div>
            @for($i = 0; $i<count($transactionHeader->transactionDetails);$i++)
            <div class='receipt-items'>
                <img src={{Storage::url($transactionHeader->transactionDetails[$i]->game->cover)}} alt="">
                <div class='receipt-items-texts'>
                    <p class='receipt-items-names'>{{$transactionHeader->transactionDetails[$i]->game->name}}</p>
                    <p>Rp. {{$transactionHeader->transactionDetails[$i]->game->price}}</p>
                </div>
            </div>
            @endfor
        </div>
        <p>Total Price <span id='receipt-total'>Rp. {{$transactionHeader->total_price}}</span></p>
    </div>
</main>
@endsection