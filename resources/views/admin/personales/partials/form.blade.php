{{-- <div class="form-group">
    {!! Form::label('barrio_id', 'Barrio/Rama') !!}
    <select name="barrio_id" id="barrio_id" class="form-control" aria-placeholder="-- Escoge un barrio --" style="appearance: none">
        @foreach ($estacas as $estaca)
            <option value="" class="bg-light font-weight-bold">{{ 'Estaca '. $estaca->nombre }}</option>
            @foreach ($estaca->barrios as $barrio)
                <option value="{{$barrio->id}}" class="mp-2" @if ( isset($contacto->personale) && $contacto->personale->barrio_id == $barrio->id){{'selected'}}@endif >{{ $barrio->nombre }}</option>
            @endforeach
        @endforeach
    </select>
</div> --}}
{{-- @error('barrio_id')
    <small class="text-danger">{{ $message }}</small>
@enderror --}}
{{-- <div class="form-group">
    {!! Form::label('preinscripcion', 'Pre-Inscripcion') !!}
    {!! Form::select('preinscripcion', [
            '1' => 'Sí',
            '0' => 'No',
        ], null, ['class' => 'form-control', 'placeholder' => '-- Escoge --', 'style' => 'appearance: none; ']); !!}
</div>
@error('preinscripcion')
    <small class="text-danger">{{ $message }}</small>
@enderror --}}
@php
// $permiso = 2;
// $permiso = isset($contacto->personale->permiso_obispo)? $contacto->personale->permiso_obispo: 2;

@endphp
<div class="form-group">
    {!! Form::label('permiso_obispo', 'Aprobación de su Obispo/Presidente de rama') !!}
    {!! Form::select('permiso_obispo', [
            '0' => 'Aprobación pendiente',
            '2' => 'Desaprobado',
            '1' => 'Aprobado',
        ], null, ['class' => 'form-control', 'placeholder' => '-- Escoge --', 'style' => 'appearance: none; ']); !!}
</div>
@error('permiso_obispo')
    <small class="text-danger">{{ $message }}</small>
@enderror
{{-- <div class="form-group">
    {!! Form::label('estado_rtemplo', 'Estado de la recomendación para el templo') !!}
    {!! Form::select('estado_rtemplo', [
            '1' => 'Activa',
            '0' => 'No está activa',
        ], null, ['class' => 'form-control', 'placeholder' => '-- Escoge --', 'style' => 'appearance: none; ']); !!}
</div>
@error('estado_rtemplo')
    <small class="text-danger">{{ $message }}</small>
@enderror
<div class="form-group">
    {!! Form::label('obs_rtemplo', 'Observación de la recomendación para el templo') !!}
    {!! Form::text('obs_rtemplo', null, ['class' => 'form-control']); !!}
</div>
@error('obs_rtemplo')
    <small class="text-danger">{{ $message }}</small>
@enderror --}}