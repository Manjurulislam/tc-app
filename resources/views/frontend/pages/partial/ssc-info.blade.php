<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            SSC Exam Information
        </h3>
    </div>
    <div class="card-body border border-2">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="ssc_roll">Roll No.</label>
                    <input type="text" class="form-control" id="ssc_roll" wire:model="sscRoll">
                    @error('sscRoll') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="ssc_reg">Registration No.</label>
                    <input type="text" class="form-control" id="ssc_reg" wire:model="sscReg">
                    @error('sscReg') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="pass_year">Passing Year</label>
                    <input type="text" class="form-control" id="pass_year" wire:model="sscPassYear">
                    @error('sscPassYear') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone">Mobile</label>
                    <input type="text" class="form-control" id="phone" wire:model="stdPhone">
                    @error('stdPhone') <small class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cgpa">CGPA</label>
                    <input type="text" class="form-control" id="cgpa" disabled wire:model="sscGpa">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="board">Board</label>
                    <input type="text" class="form-control" id="board" disabled wire:model="sscBoard">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Applicant Name</label>
                    <input type="text" class="form-control" id="name" disabled wire:model="stdName">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="fname">Father Name</label>
                    <input type="text" class="form-control" disabled id="fname" wire:model="stdFatherName">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="mother">Mother Name</label>
                    <input type="text" class="form-control" id="mother" disabled wire:model="stdMotherName">
                </div>
            </div>

        </div>
    </div>
</div>
