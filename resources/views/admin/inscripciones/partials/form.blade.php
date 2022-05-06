<h4>Datos del personale</h4>
{!! Form::hidden('contacto_id', $_GET['idcontacto']) !!}
{!! Form::hidden('fecha', date('Y-m-d')) !!}
{!! Form::hidden('user_id', '') !!}

@include('admin.contactos.partials.form')
<br>
<h4>Información del PFJ y sesión</h4>
@livewire('admin.programa-info')
@include('admin.inscripciones.partials.formedit')