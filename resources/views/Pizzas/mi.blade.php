@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cloudflare.com" rel="stylesheet">
    <link href="https://cloudflare.com" rel="stylesheet">
    <style>
        .card-product {
            border-radius: 15px;
            overflow: hidden;
            background-color: #f8f9fa;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card-product:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .product-title {
            font-family: 'Century Gothic', sans-serif;
            font-weight: bold;
            font-size: 16px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .section-title {
            font-family: 'Century Gothic', sans-serif;
            font-weight: bold;
            color: #212529;
        }
    </style>
</head>

<div class="container-fluid px-4">
    <!-- Cabecera del Panel de Control -->
    <div class="row my-4 align-items-center bg-white p-3 rounded shadow-sm">
        <div class="col-md-6">
            <h2 class="section-title mb-1"><i class="fas fa-boxes text-warning"></i> Control de Inventario</h2>
            <p class="text-muted mb-0">Administrador: <strong>{{ auth()->user()->name }}</strong></p>
        </div>
        <div class="col-md-6 text-md-end text-start mt-3 mt-md-0">
            <a href="{{ route('Pizzas.index') }}" class="btn btn-dark px-4" style="border-radius: 20px;">
                <i class="fas fa-arrow-left"></i> Volver al Menú
            </a>
        </div>
    </div>

    <!-- ==================== SECCIÓN 1: PIZZAS ==================== -->
    <div class="row mb-3 align-items-center">
        <div class="col-6">
            <h4 class="section-title mb-0">🍕 Pizzas en Menú <span class="badge bg-dark">{{ $pizzas->total() }}</span></h4>
        </div>
        <div class="col-6 text-end">
            <a class="btn btn-sm btn-success px-3" href="{{ route('Pizzas.create') }}" style="border-radius: 15px;">
                <i class="fas fa-plus"></i> Añadir Pizza
            </a>
        </div>
        <div class="col-12"><hr class="my-2"></div>
    </div>

    <div class="row">
        @forelse($pizzas as $pizza)
            <div class="col-xl-3 col-lg-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm card-product border-0">
                    <div class="text-center pt-3 px-3">
                        <img src="{{ asset('img/'.$pizza->imagen_pizza) }}" class="card-img-top rounded" style="height: 140px; object-fit: cover;" alt="Pizza">
                    </div>
                    <div class="card-body d-flex flex-column p-3">
                        <p class="product-title text-dark mb-1" title="{{ $pizza->nombre_pizza }}">{{ $pizza->nombre_pizza }}</p>
                        <h5 class="text-primary font-weight-bold mb-3">${{ number_format($pizza->precio_pizza, 2) }}</h5>
                        
                        <div class="mt-auto">
                            @if($pizza->vendido == 1)
                                <div class="alert alert-danger py-2 text-center mb-2 border-0 small font-weight-bold" style="border-radius: 10px;">
                                    <i class="fas fa-times-circle"></i> AGOTADO
                                </div>
                            @else
                                <div class="alert alert-success py-2 text-center mb-2 border-0 small font-weight-bold" style="border-radius: 10px;">
                                    <i class="fas fa-check-circle"></i> DISPONIBLE
                                </div>
                            @endif
                            <div class="d-grid">
                                <a href="{{ route('Pizzas.edit', $pizza->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 10px;">
                                    <i class="fas fa-cog"></i> Configurar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-3">No registraste pizzas aún.</div>
        @endforelse
    </div>

    <!-- ==================== SECCIÓN 2: BEBIDAS ==================== -->
    <div class="row mb-3 mt-4 align-items-center">
        <div class="col-6">
            <h4 class="section-title mb-0">🥤 Bebidas y Refrescos <span class="badge bg-dark">{{ $bebidas->total() }}</span></h4>
        </div>
        <div class="col-6 text-end">
            <a class="btn btn-sm btn-success px-3" href="#" style="border-radius: 15px;">
                <i class="fas fa-plus"></i> Añadir Bebida
            </a>
        </div>
        <div class="col-12"><hr class="my-2"></div>
    </div>

    <div class="row">
        @forelse($bebidas as $bebida)
            <div class="col-xl-3 col-lg-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm card-product border-0">
                    <div class="text-center pt-3 px-3">
                        <img src="{{ asset('img/'.$bebida->bebida_imagen) }}" class="card-img-top rounded" style="height: 140px; object-fit: cover;" alt="Bebida">
                    </div>
                    <div class="card-body d-flex flex-column p-3">
                        <p class="product-title text-dark mb-1" title="{{ $bebida->nombre_bebida }}">{{ $bebida->nombre_bebida }}</p>
                        <h5 class="text-primary font-weight-bold mb-3">${{ number_format($bebida->bebida_precio, 2) }}</h5>
                        
                        <div class="mt-auto">
                            @if($bebida->vendido == 1)
                                <div class="alert alert-danger py-2 text-center mb-2 border-0 small font-weight-bold" style="border-radius: 10px;">
                                    <i class="fas fa-times-circle"></i> AGOTADO
                                </div>
                            @else
                                <div class="alert alert-success py-2 text-center mb-2 border-0 small font-weight-bold" style="border-radius: 10px;">
                                    <i class="fas fa-check-circle"></i> DISPONIBLE
                                </div>
                            @endif
                            <div class="d-grid">
                                <a href="{{ route('Bebidas.edit', $bebida->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 10px;">
                                    <i class="fas fa-cog"></i> Configurar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-3">No registraste bebidas aún.</div>
        @endforelse
    </div>

    <!-- ==================== SECCIÓN 3: POSTRES ==================== -->
    <div class="row mb-3 mt-4 align-items-center">
        <div class="col-6">
            <h4 class="section-title mb-0">🍰 Nevería y Postres <span class="badge bg-dark">{{ $postres->total() }}</span></h4>
        </div>
        <div class="col-6 text-end">
            <a class="btn btn-sm btn-success px-3" href="#" style="border-radius: 15px;">
                <i class="fas fa-plus"></i> Añadir Postre
            </a>
        </div>
        <div class="col-12"><hr class="my-2"></div>
    </div>

    <div class="row">
        @forelse($postres as $postre)
            <div class="col-xl-3 col-lg-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm card-product border-0">
                    <div class="text-center pt-3 px-3">
                        <img src="{{ asset('img/'.$postre->postre_imagen) }}" class="card-img-top rounded" style="height: 140px; object-fit: cover;" alt="Postre">
                    </div>
                    <div class="card-body d-flex flex-column p-3">
                        <p class="product-title text-dark mb-1" title="{{ $postre->nombre_postre }}">{{ $postre->nombre_postre }}</p>
                        <h5 class="text-primary font-weight-bold mb-3">${{ number_format($postre->postre_precio, 2) }}</h5>
                        
                        <div class="mt-auto">
                            @if($postre->vendido == 1)
                                <div class="alert alert-danger py-2 text-center mb-2 border-0 small font-weight-bold" style="border-radius: 10px;">
                                    <i class="fas fa-times-circle"></i> AGOTADO
                                </div>
                            @else
                                <div class="alert alert-success py-2 text-center mb-2 border-0 small font-weight-bold" style="border-radius: 10px;">
                                    <i class="fas fa-check-circle"></i> DISPONIBLE
                                </div>
                            @endif
                            <div class="d-grid">
                                <a href="{{ route('Postres.edit', $postre->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 10px;">
                                    <i class="fas fa-cog"></i> Configurar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-3">No registraste postres aún.</div>
        @endforelse
    </div>
</div>
@endsection