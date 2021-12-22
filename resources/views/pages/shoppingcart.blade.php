@extends('layout.layout')
@section('content')
    <div>
        <p>Shopping Cart</p>
        <p>Transaction Information</p>
        <p>Transaction Receipt</p>
    </div>
    <h1>Shopping Cart</h1>
    <div>
        @if ($games && count($games)>0)
            @for ($i = 0; $i < count($games); $i++)
                <div>
                    <a href="/game/{{$games[$i]->game_id}}">
                        <img src={{Storage::url($games[$i]->cover)}} alt={{$games[$i]->name}}>
                    </a>
                    <h2>{{$games[$i]->name}}</h2>
                    <p>{{$games[$i]->category}}</p>
                    <p>{{$games[$i]->price}}</p>
                    <button onClick="renderPopup('{{$games[$i]->game_id}}')">Delete</button>
                </div>
            @endfor
            @php
                $total_price=0;
                for($i = 0;$i<count($games);$i++){
                    $total_price+=$games[$i]->price;
                }
            @endphp
            <p>Total Price <span>Rp. {{$total_price}}</span></p>
        @else
            <p>Your cart is empty</p>
        @endif  
    </div>
    <div id="shoppingcart-popup-container">
        {{-- <div id='shoppingcart-popup-bg'>
            <div id='shoppingcart-popup'>
                <p id='shoppingcart-popup-heading'>Delete Cart</p>
                <p id='shoppingcart-popup-content'>Are you sure you want to delete this game from your shopping cart? All of your data will be permanently removed. This action cannot be undone.</p>
        
            </div>
        </div> --}}
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
                    <button type='submit' id="shoppingcart-delete-btn">Delete</button>
                    <button id="shoppingcart-cancel-btn">Cancel</button>
                </form>
            `;
        }
    </script>
    <a href="/checkout">Checkout</a>
@endsection