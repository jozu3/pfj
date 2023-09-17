<h4>Datos del personale</h4>
{!! Form::hidden('contacto_id', $_GET['idcontacto']) !!}
{!! Form::hidden('fecha', date('Y-m-d')) !!}
{!! Form::hidden('user_id', '') !!}

@include('admin.contactos.partials.form')
<br>
<h4>Información del PFJ y sesión</h4>
@livewire('admin.programa-info', ['pfj_id' => old('pfj_id') , 'programa_id' => old('programa_id')])
@include('admin.inscripciones.partials.formedit')