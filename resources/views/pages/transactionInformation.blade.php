@extends('layout.layout')
@section('content')
    <main>
        <div id="transact-info-container">
            <div id="bread-container">
                <div id="bread">
                    <ol style="--bs-breadcrumb-divider: '>';" class="breadcrumb">
                        <li class="breadcrumb-item">Shopping Cart</li>
                        <li class="breadcrumb-item active">Transaction Information</li>
                        <li class="breadcrumb-item">Transaction Receipt</li>
                    </ol>
                </div>
            </div>
            <div id="transact-bot">
                <div>
                    <h1>Transaction Information</h1>
                </div>
                <div>
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="cardName">Card Name</label>
                            <input class="form-control" type="text" id="cardName" name="cardName" placeholder="Card Name">
                        </div>
                        <div class="mb-3">
                            <label for="cardNumber">Card Number</label>
                            <input class="form-control" type="text" id="cardNumber" name="cardNumber" placeholder="0000 0000 0000 0000">
                        </div>
                        <div id="card-detail" class="mb-3">
                            <div id="card-detail-1">
                                <label for="">Expired Date</label>
                                <input class="form-control mb-2" type="text" id="expiredDateMonth" name="expiredDateMonth" placeholder="MM">
                                <input class="form-control" type="text" id="expiredDateYear" name="expiredDateYear" placeholder="YYYY">
                            </div>
                            <div id="card-detail-2">
                                <label for="cvccvv">CVC / CVV</label>
                                <input class="form-control" type="text" id='cvccvv' name="cvccvv" placeholder="3 or 4 digit number">
                            </div>
                        </div>
                        <div id="country-detail" class="mb-3">
                            <div id="country-detail-1">
                                <label for="cardCountry">Country</label>
                                <select class="form-select" name="cardCountry" id="cardCountry">
                                    <option value="indonesia">Indonesia</option>
                                    <option value="japan">Japan</option>
                                    <option value="united kingdom">United Kingdom</option>
                                    <option value="united states of america">United States of America</option>
                                </select>
                            </div>
                            <div id="country-detail-2">
                                <label for="zip">ZIP</label>
                                <input class="form-control" type="text" name="zip" id="zip" placeholder="ZIP">
                            </div>
                        </div>
                        @php
                            $total_price=0;
                            for($i = 0;$i<count($games);$i++){
                                $total_price+=$games[$i]->price;
                            }
                        @endphp
                        <div id="country-detail">
                            <div id="transact-total-price">
                                <p>Total Price <span>Rp. {{$total_price}}</span></p>
                            </div>
                            <div id="country-detail">
                                <div id="transact-cancel-btn"><a href="/cart"><button class="btn" type="button">Cancel</button></a></div>
                                <div id="transact-checkout-btn"><button class="btn" type="submit">Checkout</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div id="game-detail-error-container">
                <div id="game-detail-show-error">
                    <div id="game-detail-show-error-title">
                        There were error with your submission
                    </div>
                    <div id="game-detail-show-error-desc">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach
        @endif --}}
    </main>
@endsection