@extends('layout.profileLayout')
@section('page')
    <div>
        <h2>Transaction History</h2>
        @if(count($transactionHeaders)==0)
            <p>Your transaction history is empty</p>
        @else
            @for($i=0;$i<count($transactionHeaders);$i++)
                <div>
                    <p>Transaction ID: {{$transactionHeaders[$i]->transaction_header_id}}</p>
                    <p>Purchased Date: {{$transactionHeaders[$i]->purchase_date}}</p>
                    @for($j=0;$j<count($transactionHeaders[$i]->transactionDetails);$j++)
                        <img src="{{Storage::url($transactionHeaders[$i]->transactionDetails[$j]->game->cover)}}" alt="">
                    @endfor
                    <p>Total Price Rp. {{$transactionHeaders[$i]->total_price}}</p>
                </div>
            @endfor
        @endif
    </div>
@endsection