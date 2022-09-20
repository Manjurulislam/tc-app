<div class="correction-form">

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label font-weight-normal text-right">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="name" v-model="formModel.student.correction_name" disabled>
        </div>
    </div>
    <div class="form-group row">
        <label for="father_name"
               class="col-sm-2 col-form-label font-weight-normal text-right">Father</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="father_name" v-model="formModel.student.correction_father_name" disabled>
        </div>
    </div>
    <div class="form-group row">
        <label for="mother" class="col-sm-2 col-form-label font-weight-normal text-right">Mother</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="mother" v-model="formModel.student.correction_mother_name" disabled>
        </div>
    </div>



    <div class="row">
        <div class="col-6">
            <div class="form-group row">
                <label for="mother"
                       class="col-sm-4 col-form-label font-weight-normal text-right">Religion</label>
                <div class="col-sm-8">
                    <select class="custom-select-sm custom-select mb-2 mr-sm-3" id="year" v-model="formModel.student.correction_religion">
                        <option value="">Select..</option>
                        <option value="Islam">Islam</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Christian">Christian</option>
                        <option value="Buddha">Buddha</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group row">
                <label for="mother"
                       class="col-sm-4 col-form-label font-weight-normal text-right">Gender</label>
                <div class="col-sm-8">
                    <select class="custom-select-sm custom-select mb-2 mr-sm-3" id="year" v-model="formModel.student.correction_gender">
                        <option value="">Select</option>
                        <option value="MALE">MALE</option>
                        <option value="FEMALE">FEMALE</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="mother" class="col-sm-2 col-form-label font-weight-normal text-right">DOB</label>
        <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" id="mother" v-model="formModel.student.correction_dob"
                   disabled>
        </div>
    </div>
</div>