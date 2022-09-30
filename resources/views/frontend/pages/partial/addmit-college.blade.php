<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            College admission
        </h3>
    </div>
    <div class="card-body border border-2">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="eiin">Eiin</label>
                    <input type="text" class="form-control" id="eiin" wire:model="addColEiin">
                    @error('addColEiin') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="col_code">College Code</label>
                    <input type="text" class="form-control" id="col_code" wire:model="addColCode">
                    @error('addColCode') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="col_name">College Name</label>
                    <input type="text" class="form-control" id="col_name" wire:model="addColName" disabled>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="post">Post office</label>
                    <input type="text" class="form-control" id="post" wire:model="addColPost">
                    @error('addColPost') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="upazila">Upazila</label>
                    <input type="text" class="form-control" id="upazila" wire:model="addColUpozila">
                    @error('addColUpozila') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="district">District</label>
                    <input type="text" class="form-control" id="district" wire:model="addColDistrict">
                    @error('addColDistrict') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
        </div>
        <div class="col-md-12">
            @if(!blank($subjects))
                <p>Subjects : {{$subjects}}</p>
            @endif
        </div>
    </div>
</div>
