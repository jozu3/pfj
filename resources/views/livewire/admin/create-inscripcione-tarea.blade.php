<div>
    @php
        $checkedTarea = $inscripcioneTarea->isNotEmpty() && $inscripcioneTarea->where('tarea_id', $tarea_id)->firstWhere('realizado', true) ? 'checked' : '';
    @endphp    
    
    <input type="checkbox" {{ $checkedTarea }} wire:click="hecho">    
</div>
