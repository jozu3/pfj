<tr>
<td class="header">
		
<a href="{{ $url }}" style="display: inline-block;">
	<center style="">
		<img src="{{ $url }}/img/logo2024.png" style="border-radius: 20% !important; max-height: 150px!important;height: 150px!important; width:150px!important; " class="logo" alt="PFJ Logo">
	</center>
@if (trim($slot) === 'PFJ')
{{-- aquí iba el logo de laravel --}}
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
