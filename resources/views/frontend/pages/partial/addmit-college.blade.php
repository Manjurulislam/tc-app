<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            College admission
        </h3>
    </div>
    <div class="card-body border border-2">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="eiin">Eiin</label>
                    <input type="text" class="form-control" id="eiin" wire:model="addColEiin">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="col_code">College Code</label>
                    <input type="text" class="form-control" id="col_code" wire:model="addColCode">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="col_name">College Name</label>
                    <input type="text" class="form-control" id="col_name" wire:model="addColName">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="post">Post office</label>
                    <input type="text" class="form-control" id="post" wire:model="addColPost">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="upazila">Upazila</label>
                    <input type="text" class="form-control" id="upazila" wire:model="addColUpozila">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="district">District</label>
                    <input type="text" class="form-control" id="district" wire:model="addColDistrict">
                </div>
            </div>
        </div>
    </div>
</div>
