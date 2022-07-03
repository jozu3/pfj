<div>
    <!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">
        <div class="modal-header">
            <div class="text-center w-100" id="exampleModalLabel">
                @if (isset($inscripcione->personale->user))
                    <img src="{{$inscripcione->personale->user->adminlte_image()}}" class="" style="object-fit: cover; max-height: 300px;" alt="">
                @endif
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>
</div>

</div>
