@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Servicio</div>


                @if ( session('mensaje') )
                    @if (session('mensaje')=='Correctamente creado' ||session('mensaje')=='Correctamente actualizado')
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                    @else
                    <div class="alert alert-danger">{{ session('mensaje') }}</div>
                    @endif 
                @endif

                <div class="row">
                    <div class="col-6" style="margin-left:auto; margin-right: auto;">
                        <form action="{{ route('service.update',$service->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" value='{{$service->name}}'>
                                <small id="name" class="form-text text-muted">Introduzca el nombre del servicio</small>
                            </div>
                            <div class="form-group">
                                <label for="status">Estatus</label>
                                <select name="status" id="status">
                                    <option value=1 {{($service->status == 1)? 'selected' : ''}}>Activo</option>
                                    <option value=0 {{($service->status != 1)? 'selected' : ''}}>Desactivado</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-success float-right" >Guardar</button>
                        </form>
                        <a href="{{ url('/services') }}" class="btn btn-warning">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function reload(){
    window.location.href = "{{ route('service.list') }}";    
    }
    @if ( session('mensaje') )
        @if (session('mensaje')=='Correctamente creado' ||session('mensaje')=='Correctamente actualizado')
            setInterval('reload()',2000);                  
        @endif
    @endif
</script>
@endsection