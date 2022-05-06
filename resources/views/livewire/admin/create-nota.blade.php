<div>
<form wire:submit.prevent="submit">
	<input type="number" wire:model="valor" class="form-control {{ $valor_classdanger }} input-nota" step="0.5" min="0" max="20" >
	@error('valor')<small class="text-danger">{{ $message }}</small> @enderror
</form>
</div>