@extends('layout.profileLayout')
@section('page')
    <div id='history-side'>
        <h2>Transaction History</h2>
        @if(count($transactionHeaders)==0)
            <p>Your transaction history is empty</p>
        @else
            @for($i=0;$i<count($transactionHeaders);$i++)
                <div class='history-items'>
                    <p class='history-ids'>Transaction ID: {{$transactionHeaders[$i]->transaction_header_id}}</p>
                    <p>Purchased Date: {{$transactionHeaders[$i]->purchase_date}}</p>
                    @for($j=0;$j<count($transactionHeaders[$i]->transactionDetails);$j++)
                        <img src="{{Storage::url($transactionHeaders[$i]->transactionDetails[$j]->game->cover)}}" alt="">
                    @endfor
                    <p>Total Price <span class='history-totals'>Rp. {{$transactionHeaders[$i]->total_price}}</span></p>
                </div>
            @endfor
        @endif
    </div>
@endsection