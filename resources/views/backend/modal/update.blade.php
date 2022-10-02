<div wire:ignore.self class="modal fade bd-example-modal-lg" id="updateModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" wire:model="appId">
                    <div class="form-group">
                        <label for="comments">Comments :</label>
                        <textarea class="form-control" wire:model="comments" id="comments"></textarea>
                        @error('comments') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    @if(auth()->check() && auth()->user()->role == 4)
                        <div class="form-group">
                            <label for="sharok_no">Sharok No :</label>
                            <input type="text" class="form-control" wire:model="sharok_no" id="sharok_no">
                        </div>
                    @endif
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="approved()" data-dismiss="modal" class="btn btn-dark btn-sm">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>
