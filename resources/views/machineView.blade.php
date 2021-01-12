@extends('layouts.app')

@section('content')


<div class="jumbotron col-md-12 mt-2">
    <h1 class="display-4">Orden no. {{ $maquina->id }}</h1>
    <p class="lead">Estos son los detalles de la orden que seleccionaste</p>

    <a href="{{ url('/main') }}" class="btn btn-primary">Regresar</a>

    <hr class="my-4">

    <div class="row">

        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Orden no.: {{ $maquina->id }}</h5>
                    <form action="{{ url('/edit/' . $maquina->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="order" class="col-sm-2 col-form-label">Numero de Orden:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="order" name="order" value="{{ $maquina->order }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inventary" class="col-sm-2 col-form-label">Numero de inventario:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="inventary" name="inventary" value="{{ $maquina->inventary }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="machinetype" class="col-sm-2 col-form-label">Tipo de máquina:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="machinetype" name="machinetype" value="{{ $maquina->machinetype }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keyword" class="col-sm-2 col-form-label">Palabras clave:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="keyword" name="keyword" value="{{ $maquina->keyword }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-lg" type="submit">Actualizar</button>
                        </div>
                    </form>

                    <div class="form-group">
                        <form action="{{ url('/pdf/' . $maquina->id) }}" method="post">
                            @csrf
                            <button class="btn btn-warning btn-lg" type="submit">Ver archivo</button>
                        </form>
                    </div>

                    {{-- <div class="form-group">
                        <img style="width:500px;" src="{{ url('storage/file/' . $maquina->file) }}" alt="">
                    </div> --}}



                </div>
            </div>

        </div>
    </div>
</div>




@endsection