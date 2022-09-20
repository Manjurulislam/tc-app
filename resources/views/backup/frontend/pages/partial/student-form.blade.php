<div class="student-form">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label font-weight-normal text-right">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="name" v-model="formModel.student.name" disabled>
        </div>
    </div>
    <div class="form-group row">
        <label for="father_name"
               class="col-sm-2 col-form-label font-weight-normal text-right">Father</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="father_name" v-model="formModel.student.father_name" disabled>
        </div>
    </div>
    <div class="form-group row">
        <label for="mother" class="col-sm-2 col-form-label font-weight-normal text-right">Mother</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="mother" v-model="formModel.student.mother_name" disabled>
        </div>
    </div>


    <div class="row">
        <div class="col-6">
            <div class="form-group row">
                <label for="mother"
                       class="col-sm-4 col-form-label font-weight-normal text-right">Religion</label>
                <div class="col-sm-8">
                    <select class="custom-select-sm custom-select mb-2 mr-sm-3" id="year" v-model="formModel.student.religion">
                        <option value="">Select</option>
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
                    <select class="custom-select-sm custom-select mb-2 mr-sm-3" id="year" v-model="formModel.student.gender">
                        <option value="">Select</option>
                        <option value="MALE">MALE</option>
                        <option value="FEMALE">FEMALE</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="form-group row">
                <label for="mother"
                       class="col-sm-4 col-form-label font-weight-normal text-right">Eiin</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-control-sm" id="mother" v-model="formModel.student.eiin_no"
                           disabled>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group row">
                <label for="mother" class="col-sm-4 col-form-label font-weight-normal text-right">Center
                    Code</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-control-sm" id="mother"
                           disabled v-model="formModel.student.center_code">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="form-group row">
                <label for="std_phone" class="col-sm-4 col-form-label font-weight-normal text-right">Student Mobile</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-control-sm" id="std_phone" v-model="formModel.student.std_phone">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group row">
                <label for="mother"
                       class="col-sm-4 col-form-label font-weight-normal text-right">DOB</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-control-sm" id="mother" v-model="formModel.student.dob"
                           disabled>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="mother" class="col-sm-2 col-form-label font-weight-normal text-right">Institute</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="mother" disabled v-model="formModel.student.institute">
        </div>
    </div>

    <div class="form-group row">
        <label for="address1" class="col-sm-2 col-form-label fs-6 font-weight-normal text-right">Present Address</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" id="address1" v-model="formModel.student.present_address"></textarea>
        </div>
    </div>

    <div class="form-group row">
        <label for="address2" class="col-sm-2 col-form-label font-weight-normal text-right">Permanent Address</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" id="address2" v-model="formModel.student.permanent_address"></textarea>
        </div>
    </div>
</div>

