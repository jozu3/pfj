<div style="">
    @php
        $checkedTarea = $inscripcioneTarea->isNotEmpty() && $inscripcioneTarea->where('tarea_id', $tarea_id)->firstWhere('realizado', true) ? 'checked' : '';
    @endphp    
    
    <input type="checkbox" {{ $checkedTarea }} style="transform: scale(1.3);" wire:click="hecho">    
</div>
