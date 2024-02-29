<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" wire:model="collegeId">
                    <div class="form-group">
                        <label for="seats">Available Seats:</label>
                        <input type="text" class="form-control" wire:model="availableSeats" id="seats">
                        @error('status') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="update()" data-dismiss="modal" class="btn btn-dark btn-sm">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>
