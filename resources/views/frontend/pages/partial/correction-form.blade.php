<div class="form-group row">
    <label for="address2" class="col-sm-3 col-form-label font-weight-normal text-right">What is required to correct <i class="text-red">*</i> </label>
    <div class="col-sm-8">
        <div class="row mt-2">
            <div class="col-2">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="name" v-model="schema.correction">
                        <label class="form-check-label">Name</label>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="father" v-model="schema.correction">
                        <label class="form-check-label">Father</label>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="mother" v-model="schema.correction">
                        <label class="form-check-label">Mother</label>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="religion" v-model="schema.correction">
                        <label class="form-check-label">Religion</label>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="gender" v-model="schema.correction">
                        <label class="form-check-label">Gender</label>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="dob" v-model="schema.correction">
                        <label class="form-check-label">DOB</label>
                    </div>
                </div>
            </div>
        </div>
        <span v-if="correctionError" :class="['text-danger']">@{{ correctionError }}</span>
    </div>
</div>

<div class="correction-form">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label font-weight-normal text-right">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="name"
                   v-model="formModel.cor_name" :disabled="!schema.correction.includes('name')">
        </div>
    </div>
    <div class="form-group row">
        <label for="father_name"
               class="col-sm-2 col-form-label font-weight-normal text-right">Father</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="father_name"
                   v-model="formModel.cor_father_name" :disabled="!schema.correction.includes('father')">
        </div>
    </div>
    <div class="form-group row">
        <label for="mother" class="col-sm-2 col-form-label font-weight-normal text-right">Mother</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="mother"
                   v-model="formModel.cor_mother_name" :disabled="!schema.correction.includes('mother')">
        </div>
    </div>


    <div class="row">
        <div class="col-6">
            <div class="form-group row">
                <label for="rel" class="col-sm-4 col-form-label font-weight-normal text-right">Religion</label>
                <div class="col-sm-8">
                    <select class="custom-select-sm custom-select mb-2 mr-sm-3" id="rel"
                            v-model="formModel.cor_religion" :disabled="!schema.correction.includes('religion')">
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
                <label for="gender" class="col-sm-4 col-form-label font-weight-normal text-right">Gender</label>
                <div class="col-sm-8">
                    <select class="custom-select-sm custom-select mb-2 mr-sm-3" id="gender"
                            v-model="formModel.cor_gender" :disabled="!schema.correction.includes('gender')">
                        <option value="">Select</option>
                        <option value="MALE">MALE</option>
                        <option value="FEMALE">FEMALE</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="cor_dob" class="col-sm-2 col-form-label font-weight-normal text-right">DOB</label>
        <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" placeholder="MM-DD-YYY" id="cor_dob" v-model="formModel.cor_dob"
                   :disabled="!schema.correction.includes('dob')">
        </div>
    </div>
</div>
