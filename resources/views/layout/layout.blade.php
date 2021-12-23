<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/createGame.css"> --}}
    <link href="{{ asset('css/header.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/createGame.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/gameDetail.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/checkAge.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/transactionInformation.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/transactionReceipt.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="{{asset('css/manageGame.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/profileLayout.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/profile.css')}}" type='text/css'>
    <link rel="stylesheet" href="{{asset('css/transactionHistory.css')}}" type="text/css">
    <link href="{{ asset('css/friend.css') }}" rel="stylesheet" type="text/css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    @include('layout.header')
    @yield('content')
    @include('layout.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>