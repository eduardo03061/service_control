@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Servicios</div>

                <div class="card-body"> 
                    <a href="{{ url('/home') }}" class="btn btn-warning">Regresar</a>
                    <a href="{{ route('service.create') }}" class="btn btn-success float-right"> + Crear</a>
                    <br>
                    <br>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Estatus</th>
                                <th scope="col">Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($services as $service)
                            <tr>
                                <td>{{$service->name}}</td>
                                <td class="{{($service->status == 1)? 'text-success' : 'text-danger'}} ">{{($service->status == 1)? 'activo' : 'desactivado'}}</td>
                                <td>
                                    <a href="{{ route('service.edit', $service->id) }}" class="btn btn-primary">Editar</a>
                                    <form action="{{ route('service.delete', $service->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger delete-user" value="Eliminar servicio">
                                    </form>

                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection