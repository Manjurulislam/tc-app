<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog"
     aria-labelledby="create" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" wire:model="commentId">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Title:</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title" wire:model="title">
                        @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Body:</label>
                        <textarea type="email" class="form-control" id="exampleFormControlInput2" wire:model="body" placeholder="Enter Body"></textarea>
                        @error('body') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="update()" class="btn btn-dark btn-sm close-modal">
                    Save changes
                </button>
                <button type="button" wire:click.prevent="cancel()" data-dismiss="modal" class="btn btn-danger btn-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

