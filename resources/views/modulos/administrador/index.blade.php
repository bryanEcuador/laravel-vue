@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row" id="applicacion">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Detale de compras</div>

                    <div  class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <table class="table table-bordered">
                                <thead>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Stock actual</th>
                                </thead>
                                <tbody>
                                @forelse ($datos as $dato)
                                    <tr>
                                        <td>{{$dato->descripcion}}</td>
                                        <td>{{$dato->stock}}</td>
                                        <td>{{$dato->stock_vendido}}</td>
                                    </tr>
                                @empty
                                    <p>no se han comprado productos aun</p>
                                @endforelse

                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
