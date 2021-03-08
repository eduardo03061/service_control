@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inicio</div> 
                <div class="card-body" style="margin-left: auto; margin-right: auto;">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if(Auth::user()->hasRole('admin'))
                    <div>Acceso como administrador</div><br>
                    <a href="{{ route('users.list') }}" class="btn btn-success">Lista de usuarios</a>
                    @else
                    <div>Acceso usuario</div><br>
                    <a href="{{ route('service.list') }}" class="btn btn-success">Lista de servicios</a>
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection