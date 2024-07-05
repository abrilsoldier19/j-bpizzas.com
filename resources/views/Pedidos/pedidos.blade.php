@extends('layouts.app')
 
 @section('content')
   <div class="container-fluid">
     <div class="row">
       <div class="col-lg-6">
         <div class="card">
           <div class="card-body p-3">
             <h5>Purchase History</h5>
             <hr>
             <table class="table align-items-center mb-0">
               <thead>
                 <tr>
                   <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product</th>
                   <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Seller</th>
                   <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                 </tr>
               </thead>
               <tbody>
               @php
         $vendidos = Auth::user()->vendidos;
     @endphp
 
     @if($vendidos)
         @foreach($vendidos as $pizza)
                     <tr>
                       <td>
                         <div class="d-flex align-items-center">
                           <img src="{{ asset('assets/img') }}/{{ $pizza->detalle->imagen_pizza }}" style="height: 50px; width: 50px; object-fit: contain"/>
                           <div class="ms-2">
                             <h6 class="mb-0 text-sm text-primary">${{ number_format($pizza->detalle->precio_pizza, 0, '.', '.') }}</h6>
                             <h6 class="mb-0 text-sm">{{ $pizza->detalle->nombre_pizza }}</h6>
                           </div>
                         </div>
                       </td>
                       <td>
                         <div class="d-flex">
                           <div class="d-flex flex-column justify-content-center">
                             <h6 class="mb-0 text-sm">{{ $pizza->detalle->vendedor->name }}</h6>
                             <p class="text-xs text-secondary mb-0">{{ $pizza->detalle->vendedor->email }}</p>
                           </div>
                         </div>
                       </td>
                       <td type="date" name="fecha">
                       date("Y-m-d")
                       </td>
                     </tr>
                   @endforeach
                   @endif
               </tbody>
             </table>
           </div>
         </div>
       </div>
     </div>
   </div>
 @endsection