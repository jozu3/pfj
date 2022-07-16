<div class="grid grid-cols-12 gap-4">

    {!! Form::hidden('programa_id', $_GET['programa_id']) !!}
    <div class="col-span-12 sm:col-span-6">
        {!! Form::label('nombres', 'Nombre del participante', ['class' => 'block font-medium text-sm text-gray-700']) !!}
        {!! Form::text('nombres', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Ingrese el nombre del participante',
        ]) !!}
    </div>
    <div class="col-span-12 sm:col-span-6">
        {!! Form::label('apellidos', 'Apellidos del participante', [
            'class' => 'block font-medium text-sm text-gray-700',
        ]) !!}
        {!! Form::text('apellidos', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Ingrese lo apellidos del particpante',
        ]) !!}
    </div>
</div>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 mt-3 sm:col-span-4">
        {!! Form::label('documento', 'Documento de identidad', ['class' => 'block font-medium text-sm text-gray-700']) !!}
        {!! Form::text('documento', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Ingrese el documento de identidad',
        ]) !!}
    </div>
    <div class="col-span-12 mt-3 sm:col-span-4">
        {!! Form::label('fecnac', 'Fecha de nacimiento', ['class' => 'block font-medium text-sm text-gray-700']) !!}
        {!! Form::date('fecnac', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Ingrese la fecha de nacimiento',
        ]) !!}
    </div>
    <div class="col-span-12 mt-3 sm:col-span-4">
        {!! Form::label('genero', 'Seleccione el género', ['class' => 'block font-medium text-sm text-gray-700']) !!}
        {!! Form::select('genero', ['0' => 'Femenino', '1' => 'Masculino'], null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Seleccione el género',
        ]) !!}
    </div>
</div>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 mt-3 sm:col-span-4">
        {!! Form::label('telefono', 'Teléfono', ['class' => 'block font-medium text-sm text-gray-700']) !!}
        {!! Form::text('telefono', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Ingrese el teléfono',
        ]) !!}
    </div>
    {{-- <div class="col-span-12 mt-3 sm:col-span-4">
        {!! Form::label('age', 'Edad', ['class' => 'block font-medium text-sm text-gray-700']) !!}
        {!! Form::text('age', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Ingrese la edad',
        ]) !!}
    </div> --}}
    <div class="col-span-12 mt-3 sm:col-span-4">
        {!! Form::label('talla', 'Talla de polo', ['class' => 'block font-medium text-sm text-gray-700']) !!}
        {!! Form::text('talla', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Ingrese la talla',
        ]) !!}
    </div>
    <div class="col-span-12 mt-3 sm:col-span-4">
        {!! Form::label('tipo_ingreso', 'Tipo de ingreso', ['class' => 'block font-medium text-sm text-gray-700']) !!}
        {!! Form::select('tipo_ingreso', ['1' => 'Ingreso nomal', '0' => 'Permutado'], null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Seleccione',
        ]) !!}
    </div>
</div>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 mt-3 sm:col-span-2">
        {!! Form::label('vacunas', 'Vacunas', ['class' => 'block font-medium text-sm text-gray-700']) !!}
        {!! Form::select('vacunas', ['1' => 'Sí', '0' => 'No'], null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Seleccione',
        ]) !!}
    </div>
    <div class="col-span-12 mt-3 sm:col-span-2">
        {!! Form::label('sangre', 'Tipo de sangre', ['class' => 'block font-medium text-sm text-gray-700']) !!}
        {!! Form::text('sangre', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Ingrese el tipo de sangre',
        ]) !!}
    </div>
    <div class="col-span-12 mt-3 sm:col-span-3">
        {!! Form::label('diabetico_asmatico', '¿Diabético o asmático?', [
            'class' => 'block font-medium text-sm text-gray-700',
        ]) !!}
        {!! Form::text('diabetico_asmatico', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Ingrese la alergia',
        ]) !!}
    </div>
    <div class="col-span-12 mt-3 sm:col-span-5">
        {!! Form::label('alergia', 'Alergia', ['class' => 'block font-medium text-sm text-gray-700']) !!}
        {!! Form::text('alergia', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Ingrese la alergia',
        ]) !!}
    </div>


    <div class="col-span-12 mt-3 sm:col-span-7">
        {!! Form::label('tratamiento_medico', 'Sigue tratamiento médico', [
            'class' => 'block font-medium text-sm text-gray-700',
        ]) !!}
        {!! Form::text('tratamiento_medico', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Ingrese el tratamiento',
        ]) !!}
    </div>

    <div class="col-span-12 mt-3 sm:col-span-5">
        {!! Form::label('seguro_medico', '¿Tiene seguro médico?', [
            'class' => 'block font-medium text-sm text-gray-700',
        ]) !!}
        {!! Form::text('seguro_medico', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Ingrese el seguro médico',
        ]) !!}
    </div>


</div>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 mt-3">
        {!! Form::label('informacion_medica', 'Información médica', [
            'class' => 'block font-medium text-sm text-gray-700',
        ]) !!}
        {!! Form::textarea('informacion_medica', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'rows' => 3,
            'placeholder' => 'Ingrese la información médica',
        ]) !!}
    </div>
</div>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 mt-3">
        {!! Form::label('informacion_alimentaria', 'Información alimentaria', [
            'class' => 'block font-medium text-sm text-gray-700',
        ]) !!}
        {!! Form::textarea('informacion_alimentaria', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'rows' => 3,
            'placeholder' => 'Ingrese la información alimentaria',
        ]) !!}
    </div>
</div>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 mt-3 sm:col-span-4">
        {!! Form::label('contacto1', 'Número de contacto 1', ['class' => 'block font-medium text-sm text-gray-700']) !!}
        {!! Form::text('contacto1', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Ingrese el contacto',
        ]) !!}
    </div>
    <div class="col-span-12 mt-3 sm:col-span-4">
        {!! Form::label('contacto2', 'Número de contacto 2', ['class' => 'block font-medium text-sm text-gray-700']) !!}
        {!! Form::text('contacto2', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Ingrese el contacto',
        ]) !!}
    </div>
</div>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 mt-3 sm:col-span-4">
        {!! Form::label('barrio_id', 'Barrio', ['class' => 'block font-medium text-sm text-gray-700']) !!}
        {!! Form::select('barrio_id', $estacasselect, null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Seleccione',
        ]) !!}
    </div>
    <div class="col-span-12 sm:col-span-4">
        {!! Form::label('estado_aprobacion', 'Estado de aprobación', [
            'class' => 'block font-medium text-sm text-gray-700',
        ]) !!}
        {!! Form::select('estado_aprobacion', ['1' => 'Aprobado', '0' => 'No aprobado'], null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Seleccione',
        ]) !!}
    </div>
    <div class="col-span-12 sm:col-span-4">
        {!! Form::label('obispo', 'Nombre del obispo o presidente de rama', [
            'class' => 'block font-medium text-sm text-gray-700',
        ]) !!}
        {!! Form::text('obispo', null, [
            'class' =>
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
            'placeholder' => 'Ingrese el nombre del obispo o presidente de rama',
        ]) !!}
    </div>
    <div class="col-span-12 sm:col-span-4">
        {!! Form::label('estado', 'Estado del participante', [
            'class' => 'block font-medium text-sm text-gray-700',
        ]) !!}
        {!! Form::select(
            'estado',
            ['0' => 'Inscrito', '1' => 'Ingresado', '2' => 'Permutado', '3' => 'Terminado', '4' => 'Retirado'],
            null,
            [
                'class' =>
                    'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full',
                'placeholder' => 'Seleccione',
            ],
        ) !!}
    </div>
</div>
