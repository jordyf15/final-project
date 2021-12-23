@extends('layout.layout')
@section('content')
<main>
    <div id="cart-container">
        <div id="bread-container">
            <div id="bread">
                <ol style="--bs-breadcrumb-divider: '>';" class="breadcrumb">
                    <li class="breadcrumb-item active">Shopping Cart</li>
                    <li class="breadcrumb-item">Transaction Information</li>
                    <li class="breadcrumb-item">Transaction Receipt</li>
                </ol>
            </div>
        </div>
        <div id="shopping-cart-container">
            <div id="shopping-cart-title">
                <h1>Shopping Cart</h1>
            </div>
            <div id="shopping-cart-details">
                @if ($games && count($games)>0)
                    @for ($i = 0; $i < count($games); $i++)
                        <div id="cart-game-row">
                            <div id="cart-game-left">
                                <a href="/game/{{$games[$i]->game_id}}">
                                    <img src={{Storage::url($games[$i]->cover)}} alt={{$games[$i]->name}}>
                                </a>
                            </div>
                            <div id="cart-game-middle">
                                <div id="cart-game-middle-top">
                                    <div><h2>{{$games[$i]->name}}</h2></div>
                                    <div id="cart-game-middle-top-cat"><p>{{$games[$i]->category}}</p></div>
                                </div>
                                <div id="cart-game-middle-bot">
                                    <p>Rp. {{$games[$i]->price}}</p>
                                </div>
                            </div>
                            <div id="cart-game-right">
                                <button class="btn" id="cart-del-btn" onClick="renderPopup('{{$games[$i]->game_id}}')">Delete</button>
                            </div>
                        </div>
                    @endfor
                    @php
                        $total_price=0;
                        for($i = 0;$i<count($games);$i++){
                            $total_price+=$games[$i]->price;
                        }
                    @endphp
                    <div id="cart-total-price">
                        <p>Total Price <span>Rp. {{$total_price}}</span></p>
                    </div>
                    <div id="cart-checkout">
                        <a href="/checkout"><button class="btn">Checkout</button></a>
                    </div>
                @else
                    <p>Your cart is empty</p>
                @endif
            </div>
        </div>
        <div id="shoppingcart-popup-container">
        </div>
        <script>
            function renderPopup(game_id){
                const popupContainer = document.querySelector('#shoppingcart-popup-container');
                const popupBg = document.createElement('div');
                popupBg.id = 'shoppingcart-popup-bg';
                popupContainer.appendChild(popupBg);
    
                const popup = document.createElement('div');
                popup.id = 'shoppingcart-popup';
                popupBg.appendChild(popup);
    
                const popupHeading = document.createElement('p');
                popupHeading.id = 'shoppingcart-popup-heading';
                popupHeading.textContent = 'Delete Cart';
                popup.appendChild(popupHeading);
    
                const popupContent = document.createElement('p');
                popupContent.id = 'shoppingcart-popup-content';
                popupContent.textContent = 'Are you sure you want to delete this game from your shopping cart? All of your data will be permanently removed. This action cannot be undone.';
                popup.appendChild(popupContent);
    
                const popupFormContainer = document.createElement('div');
                popupFormContainer.id = 'shopping-cart-popup-formcontainer';
                popup.appendChild(popupFormContainer);
    
                popupFormContainer.innerHTML = `
                    <form action="/cart/${game_id}" id='shoppingcart-popup-button-container' method='POST'>
                        @csrf
                        @method('DELETE')
                        <button id="shoppingcart-cancel-btn" type="button">Cancel</button>
                        <button type='submit' id="shoppingcart-delete-btn">Delete</button>
                    </form>
                `;

                const cancelBtn = document.querySelector('#shoppingcart-cancel-btn');
                cancelBtn.addEventListener('click', ()=>{
                    popupContainer.removeChild(popupBg);
                });
            }
        </script>
    </div>
</main>
@endsection