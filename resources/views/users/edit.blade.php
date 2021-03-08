@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Usuario</div>


                @if ( session('mensaje') )
                    @if (session('mensaje')=='Correctamente creado' ||session('mensaje')=='Correctamente actualizado')
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                    @else
                    <div class="alert alert-danger">{{ session('mensaje') }}</div>
                    @endif 
                @endif

                <div class="row">
                    <div class="col-6" style="margin-left:auto; margin-right: auto;">
                        <form action="{{ route('users.update',$user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" value='{{$user->name}}'> 
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value='{{$user->email}}'> 
                            </div>
                            <div class="form-group">
                                <label for="status">Estatus</label>
                                <select name="status" id="status">
                                    <option value=1 {{($user->status == 1)? 'selected' : ''}}>Activo</option>
                                    <option value=0 {{($user->status != 1)? 'selected' : ''}}>Desactivado</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="age">Edad</label>
                                <input type="number" class="form-control" name="age" value='{{$user->age}}'> 
                            </div>
                            <div class="form-group">
                                <label for="gender">Genero</label>
                             
                                <select name="gender" id="gender" class="form-select">
                                    <option value="male" {{($user->gender == 'male')? 'selected' : ''}}>Masculino</option>
                                    <option value="female" {{($user->gender == 'female')? 'selected' : ''}}>Femenino</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-success float-right" >Guardar</button>
                        </form>
                        <a href="{{ url('/users') }}" class="btn btn-warning">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function reload(){
    window.location.href = "{{ route('users.list') }}";    
    }
    @if ( session('mensaje') )
        @if (session('mensaje')=='Correctamente creado' ||session('mensaje')=='Correctamente actualizado')
            setInterval('reload()',2000);                  
        @endif
    @endif
</script>
@endsection