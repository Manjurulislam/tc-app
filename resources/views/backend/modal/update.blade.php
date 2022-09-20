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
                    <input type="hidden" wire:model="appId">
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control custom-select" id="status" wire:model="status">
                            <option>Select</option>
                            <option value="2">Literally correction</option>
                            <option value="3">For Meeting</option>
                            <option value="4">Approved</option>
                            <option value="5">Invalid</option>
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    @if($status == 3)
                        <div class="form-group">
                            <label for="mno">Meeting No:</label>
                            <input type="text" class="form-control" id="mno" wire:model="meetingNo">
                        </div>
                        <div class="form-group">
                            <label for="date">Meeting Date:</label>
                            <input type="datetime-local" class="form-control" id="date" wire:model="meetingDate">
                        </div>
                    @endif
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="update()" data-dismiss="modal" class="btn btn-dark btn-sm">
                    Save changes
                </button>
                <button type="button" wire:click.prevent="cancel()" data-dismiss="modal" class="btn btn-danger btn-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
