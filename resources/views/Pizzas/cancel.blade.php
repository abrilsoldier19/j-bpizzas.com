@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Set your desired background color */
        }

        .container {
            margin-top: 50px;
        }

        .card {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Pizzas</h1>
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        Cancelacion
                    </div>
                    <div class="card-body">
                        <p class="lead">¿Seguro que quieres cancelar?</p>
                        <a href="{{ route('Pizzas.index') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continuar comprando</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
@endsection
