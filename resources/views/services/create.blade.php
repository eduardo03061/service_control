@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nuevo Servicio</div>


                @if ( session('mensaje') )
                    @if (session('mensaje')=='Correctamente creado' ||session('mensaje')=='Correctamente actualizado')
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                    @else
                    <div class="alert alert-danger">{{ session('mensaje') }}</div>
                    @endif 
                @endif

                <div class="row">
                    <div class="col-6" style="margin-left:auto; margin-right: auto;">
                        <form action="{{ route('service.storage') }}" method="POST">
                        @csrf
                        @method('POST')
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Introduce el nombre del servicio">
                            </div>
                            <div class="form-group">
                                <label for="status">Estatus</label>
                                <select name="status" id="status">
                                    <option value=1 >Activo</option>
                                    <option value=0 >Desactivado</option>
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