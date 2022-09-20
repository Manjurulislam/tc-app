<div wire:ignore.self class="modal fade" id="bulkUpdateModal" tabindex="-1" role="dialog"
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
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control custom-select" id="status" wire:model="status">
                            <option>Select</option>
                            <option value="4">Approved</option>
                            <option value="5">Invalid</option>
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="bulkUpdate()" data-dismiss="modal" class="btn btn-dark btn-sm">
                    Save changes
                </button>
                <button type="button" wire:click.prevent="cancel()" data-dismiss="modal" class="btn btn-danger btn-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
