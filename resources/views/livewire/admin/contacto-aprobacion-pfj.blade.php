<div>
    <button wire.ignore id="btn_aprobarconsejero" type="button" wire:loading.remove wire:loading.attr="disabled" class="btn btn-success">Enviar al obispo</button>
    <span wire:loading class="spinner-border text-danger" role="status">
        <span class="sr-only">  Loading...</span>
      </span>
    <span wire:loading>
        Enviado al obispo...
    </span>
    <script>
         document.addEventListener('livewire:load', function(){
            $('#btn_aprobarconsejero').click(function(){
                Swal.fire({
                        title: 'Se necesita confirmación',
                        text: 'Se enviará al obispo para su aprobación.',
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, enviar',
                    }).then((result) => {
                        if (result.value) {
                            Livewire.emit('aprobacionPfj');
                        } else {
                        }
                    })
            })

            Livewire.on('no_hay_obispo', function(){
                Swal.fire({
                        title: 'Información',
                        text: 'No hay obispo registrado',
                        icon: 'warning',
                        showCancelButton: true,
                        showConfirmButton: false,
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonColor: '#3085d6',
                        // confirmButtonText: 'Sí, enviar',
                    }).then((result) => {
                        if (result.value) {
                        } else {
                        }
                    })
            })

         })
    </script>
</div>
