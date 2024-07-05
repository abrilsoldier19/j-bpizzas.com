<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>
    <link href = "css/jquery-ui.css" rel = "stylesheet">

</head>
        <div class="row">
        @if($pizzas->count() > 0)
            @foreach ($pizzas as $pizza)
                <div class="col-lg-4 mb-4">
                    <div class="card" >
                    <img src="{{ asset('img/'.$pizza->imagen_pizza) }}" alt="Pizza Image" class="card-img-top" style="max-height: 200px; object-fit: cover;">
                        <div class="card-body">
                        <h6 class="mb-0 text-sm">{{ optional($pizza->vendedor)->name }}</h6>
                            <h5 class="card-title">{{$pizza->nombre_pizza}}</h5>
                            <p class="card-text" >Precio: ${{ number_format($pizza->precio_pizza, 0, '.', '.') }}</p>
                            @if (Auth::user()->hasRole('Usuario') )
                                <form action="{{ route('Pizzas.agregarCarrito', $pizza->id) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="quantity">Cantidad:</label>
                                        <input name="quantity" type="number"
                                       class="text-sm sm:text-base px-2 pr-2 rounded-lg border border-gray-400 py-1 focus:outline-none focus:border-blue-400"
                                       style="width: 50px" value="1" min="1" />
                                    </div>
                                    <p class="btn-holder">
                                        <button type="submit"  class="btn btn-success" role="button">Agregar al carrito</button> 
                                    </p>
                                </form>
                            @endif
                            @can('Administrador-rol')
                                <a href="{{ route('Pizzas.edit', $pizza->id) }}" class="btn btn-info">Editar</a>
                            @endcan
                            @if (Auth::user()->hasRole('Usuario') )
                                @if(!$pizza->vendido)
                                    <form method="POST" action="{{ route('Pizzas.comprar', $pizza->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">Comprar</button>
                                    </form>
                                @else
                                    <span class="btn bg-danger">Sold</span>
                                @endif
                            @endif
                            @can('Administrador-rol')
                                {!! Form::open(['method' => 'DELETE','route' => ['Pizzas.destroy', $pizza->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endcan
                        </div>
                    </div>
                </div>

                <!-- Add a clearfix after every third card to start a new row -->
                @if($loop->iteration % 3 == 0)
                    <div class="clearfix"></div>
                @endif
            @endforeach
        @endif
        {!! $pizzas->links() !!}
        </div>