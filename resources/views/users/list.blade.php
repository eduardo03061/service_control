@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Usuarios</div>

                <div class="card-body"> 
                    <a href="{{ url('/home') }}" class="btn btn-warning">Regresar</a> 
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
                            @foreach ($users as $user)
                            <tr>
                                <td scope="row">{{$user->name}}</td>
                                <td class="{{($user->status == 1)? 'text-success' : 'text-danger'}} ">{{($user->status == 1)? 'activo' : 'desactivado'}}</td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Editar</a>
                                    <a href="{{ route('users.listServices', $user->id) }}" class="btn btn-primary" >Ver servicios</a> 
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