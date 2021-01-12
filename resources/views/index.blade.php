@extends('layouts.app')

@section('content')

@include('partials.messages')

<div class="jumbotron col-md-12 mt-2">
  <h1 class="display-4">Ingreso de Ordenes</h1>
  <p class="lead">En esta sección se podrán subir ordenes nuevas</p>
  <hr class="my-4">

  <div class="row">

    <div class="col-md-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Nueva orden:</h5>

          <form action="{{ url('/neworder') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
              <label for="order" class="col-sm-2 col-form-label">Numero de Orden:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="order" name="order" placeholder="Introduce número de orden">
              </div>
            </div>

            <div class="form-group row">
              <label for="inventary" class="col-sm-2 col-form-label">Numero de inventario:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inventary" name="inventary" placeholder="Introduce número de inventario">
              </div>
            </div>

            <div class="form-group row">
              <label for="machinetype" class="col-sm-2 col-form-label">Tipo de máquina:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="machinetype" name="machinetype" placeholder="Introduce tipo de máquina">
              </div>
            </div>

            <div class="form-group row">
              <label for="keyword" class="col-sm-2 col-form-label">Palabras clave:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Introduce palabras clave...">
              </div>
            </div>

            <div class="form-group">
              <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="file">
                <label class="custom-file-label" for="file">Selecciona el archivo...</label>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>

          </form>

        </div>
      </div>

    </div>
  </div>
</div>

<div class="jumbotron col-md-12 mt-2">
  <h1 class="display-4">Consultas</h1>
  <p class="lead">Esta sección está destinada a búsqueda.</p>
  <a href="{{ url('/main') }}" class="btn btn-primary">Mostar todo</a>
  <hr class="my-4">
  <div class="row">

    <div class="col-md-12">

      <div class="card">
        <div class="card-body">

          <div class="form-group row">

            <form action="{{ url('/search-order/') }}" method="GET" class="form-inline mr-5">
              <input type="search" name="searchOrder" class="form-control" placeholder="Orden...">
              <button type="submit" class="btn btn-secondary">Orden</button>
            </form>

            <form action="{{ url('/search-inventary/') }}" method="GET" class="form-inline mr-5">
              <input type="search" name="searchInventary" class="form-control" placeholder="Inventario...">
              <button type="submit" class="btn btn-secondary">Inventario</button>
            </form>

            <form action="{{ url('/search-type/') }}" method="GET" class="form-inline mr-5">
              <input type="search" name="searchMachinetype" class="form-control" placeholder="Tipo...">
              <button type="submit" class="btn btn-secondary">Tipo</button>
            </form>

          </div>

          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Orden</th>
                <th>Inventario</th>
                <th>Tipo de máquina</th>
                <th>acciones</th>
              </tr>
            </thead>

            <tbody>

              @if(count($ordenes) >= 1)

              @foreach($ordenes as $order)
                <tr>
                  <th>{{ $order->id }}</th>
                  <td>{{ $order->order }}</td>
                  <td>{{ $order->inventary }}</td>
                  <td>{{ $order->machinetype }}</td>
                  <td>
                    <a href="{{ url('/machine/' . $order->id) }}" class="btn btn-primary btn-sm">Ver</a>
                    {{-- btn modal --}}
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#staticBackdrop-{{ $order->id }}">
                      Eliminar
                    </button>
                    {{-- modal body --}}
                    <div class="modal fade" id="staticBackdrop-{{ $order->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Eliminar orden</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>

                          <div class="modal-body">
                            ¿Estás seguro de eliminar la orden?
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                            <form action="{{ url('/delete/' . $order->id) }}" method="post">
                              @csrf
                              <button type="submit" class="btn btn-danger">Sí, eliminar.</button>
                            </form>
                          </div>

                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach

              @else
                <tr>
                  <td></td>
                  <td></td>
                  <td>no hay datos :(</td>
                  <td></td>
                  <td></td>
                </tr>
              @endif

            </tbody>
          </table>

          {{ $ordenes->links() }}

        </div>
      </div>

    </div>
  </div>
</div>

@endsection