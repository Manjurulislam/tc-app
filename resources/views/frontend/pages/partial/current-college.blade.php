<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Current college
        </h3>
    </div>
    <div class="card-body border border-2">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="eiin">Eiin</label>
                    <input type="text" class="form-control" id="eiin" wire:model="curCollegeEiin">
                    @error('curCollegeEiin') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="c_name">College Name</label>
                    <input type="text" class="form-control" id="c_name" wire:model="curCollegeName">
                    @error('curCollegeName') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="post">Post office</label>
                    <input type="text" class="form-control" id="post" wire:model="curPostOffice">
                    @error('curPostOffice') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="upz">Upazila</label>
                    <input type="text" class="form-control" id="upz" wire:model="curUpozilla">
                    @error('curUpozilla') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="dis">District</label>
                    <input type="text" class="form-control" id="dis" wire:model="curDistrict">
                    @error('curDistrict') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="group">Group</label> <!-- dropdown science, commerce ars -->
                    <select class="form-control" id="group" wire:model="group">
                        <option selected>Select</option>
                        <option value="science">Science</option>
                        <option value="commerce">Commerce</option>
                        <option value="ars">Ars</option>
                    </select>
                    @error('group') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="class">Class</label>
                    <input type="text" class="form-control" id="class" wire:model="class">
                    @error('class') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="roll">Roll No</label>
                    <input type="text" class="form-control" id="roll" wire:model="roll">
                    @error('roll') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="session">Session</label>
                    <input type="text" class="form-control" id="session" wire:model="session">
                    @error('session') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
        </div>
    </div>
</div>
