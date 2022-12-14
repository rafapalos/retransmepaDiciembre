@extends('adminlte::page')

@section('title', 'Retransmepa')

@section('content_header')
    <h2>Añadir Limpieza</h2>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#empleadoAsignado').select2({
            language: "es",
            theme: "classic",
            width: '100%'
        });

        $('#matricula').select2({
            language: "es",
            theme: "classic",
            width: '100%'
        });

        let Actual = new Date();
        let mesActual = Actual.getMonth();
        let anioActual = Actual.getFullYear();
        let ultimoDia = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();
        let min = anioActual+'-'+mesActual+'-'+'01';
        let max = anioActual+'-'+mesActual+'-'+ultimoDia;

        $("#fechaLimpieza").attr("min", min);
        $("#fechaLimpieza").attr("max", max);

    });

</script>
@stop

@section('content')
    <form action="/limpiezas" method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Matricula</label>
            <select class="form-control" id="matricula" name="matricula" required>
                <option value="">Seleccionar opción</option>
                @foreach ($clientesLimpiezas as $clientesLimpiezas)
                <option value="{{$clientesLimpiezas->id}}-{{$clientesLimpiezas->matricula}}">{{$clientesLimpiezas->matricula}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo de Lavado</label>
            <select class="form-control" id="tipoLavado" name="tipoLavado" required>
                <option value="Básico">Básico</option>
                <option value="Integral Tapicería">Integral Tapicería</option>
                <option value="Integral Reestreno">Integral Reestreno</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo de Coche</label>
            <select class="form-control" id="tipoCoche" name="tipoCoche" required>
                <option value="Pequeño">Pequeño</option>
                <option value="Mediano">Mediano</option>
                <option value="Grande">Grande</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Precio</label>
            <input id="precio" name="precio" type="number" step="any" min="0" max="1000" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Fecha de Limpieza</label>
            <input id="fechaLimpieza" name="fechaLimpieza" type="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Empleado a Asignar</label>
            <select class="form-control" id="empleadoAsignado" name="empleadoAsignado" required>
                <option value="">Seleccionar</option>
                @foreach ($empleadosLimpiezas as $empleadosLimpiezas)
                <option value="{{$empleadosLimpiezas->id}}-{{$empleadosLimpiezas->nombre}} {{$empleadosLimpiezas->apellidos}}">{{$empleadosLimpiezas->nombre}} {{$empleadosLimpiezas->apellidos}}</option>
                @endforeach
            </select>
        </div>
        <a href="/limpiezas" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@stop