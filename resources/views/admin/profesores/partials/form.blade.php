<div class="form-group">
    {!! Form::label('nombres', 'Nombre:') !!}
    {!! Form::text('nombres', null, ['class' => 'form-control']) !!}
</div>
@error('nombres')
    <small class="text-danger">{{ trans($message) }}</small>
@enderror
<div class="form-group">
    {!! Form::label('apellidos', 'Apellidos:') !!}
    {!! Form::text('apellidos', null, ['class' => 'form-control']) !!}
</div>
@error('apellidos')
    <small class="text-danger">{{ $message }}</small>
@enderror
<div class="form-group">
    {!! Form::label('telefono', 'Teléfono:') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
</div>
@error('telefono')
    <small class="text-danger">{{ $message }}</small>
@enderror
@if (isset($profesore))
<div class="form-group">
    {!! Form::label('email', 'Correo electrónico:') !!}
    {!! Form::text('email', $profesore->user->email, ['class' => 'form-control']) !!}
</div>
@else
<div class="form-group">
    {!! Form::label('email', 'Correo electrónico:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>
@endif
@error('email')
    <small class="text-danger">{{ $message }}</small>
@enderror
{!! Form::hidden('user_id','') !!}