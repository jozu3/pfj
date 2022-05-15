<div>
    @php
        $checkedVacuna = $inscripcioneVacuna->isNotEmpty() && $inscripcioneVacuna->where('vacuna_id', $vacuna_id)->firstWhere('vacunado', true) ? 'checked' : '';
    @endphp  

    <input type="checkbox" {{ $checkedVacuna }}  >
</div>
