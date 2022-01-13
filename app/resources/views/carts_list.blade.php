<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <link href="/css/app.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">


      <div class="container">

      <div id="accordion" >

        @foreach ($carts as $cart)

        <div class="card">
          <div class="card-header" id="{{$cart->hash}}_show">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#{{$cart->hash}}" aria-expanded="true" aria-controls="{{$cart->hash}}">
                <b>#{{$cart->id}}</b> - {{$cart->hash}}
              </button>
            </h5>
          </div>

          <div id="{{$cart->hash}}" class="collapse show" aria-labelledby="{{$cart->hash}}_show" data-parent="#accordion">
            <div class="mb-2" >
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Quantity</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cart->products as $product)

                <tr>
                  <th scope="row">{{$product->product->id}}</th>
                  <td>{{$product->product->name}}</td>
                  <td>{{$product->quantity}}</td>
                </tr>
                @endforeach

              </tbody>
            </table>
            </div>
          </div>
        </div>

        @endforeach

      </div>
      </div>



      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>
