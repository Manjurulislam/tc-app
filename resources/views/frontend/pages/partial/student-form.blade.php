{{--<div class="row justify-content-end mb-3">--}}
{{--    <div class="col-md-3">--}}
{{--        <div v-if="attachments.photo">--}}
{{--            <img :src="photoUrl" :alt="attachments.photo.name" width="100%" class="img-thumbnail">--}}
{{--        </div>--}}
{{--       <div v-else>--}}
{{--           <img  src="{{asset('assets/images/200x200.webp')}}" width="100%" alt="..." class="img-thumbnail">--}}
{{--       </div>--}}
{{--        <div>--}}
{{--            <label class="btn btn-success btn-block btn-flat" for="photo">--}}
{{--                <input id="photo" type="file" class="d-none" ref="photo" @change="onFileChange">--}}
{{--                Upload Photo--}}
{{--            </label>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}



{{--<div class="row mt-5">--}}
{{--    <div class="col-md-8">--}}
{{--        <div class="form-group row">--}}
{{--            <label for="name" class="col-sm-3 col-form-label font-weight-normal text-right">Name</label>--}}
{{--            <div class="col-sm-8">--}}
{{--                <input type="text" class="form-control form-control-sm" id="name" v-model="formModel.name" disabled>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="col-md-4">--}}
{{--        <div class="form-group row">--}}
{{--            <label class="col-sm-6 col-form-label font-weight-normal text-right">Passport size photo</label>--}}
{{--            <div class="col-sm-6">--}}
{{--                <label class="btn btn-primary" for="photo">--}}
{{--                    <input id="photo" type="file" class="d-none" ref="photo" @change="onFileChange">--}}
{{--                    Choose photo--}}
{{--                </label>--}}
{{--                <br>--}}
{{--                <span v-if="attachments.photo"> @{{attachments.photo.name}}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label font-weight-normal text-right">Name</label>
    <div class="col-sm-10">
        <input type="text" class="form-control form-control-sm" id="name" v-model="formModel.name" disabled>
    </div>
</div>

<div class="form-group row">
    <label for="father_name"
           class="col-sm-2 col-form-label font-weight-normal text-right">Father</label>
    <div class="col-sm-10">
        <input type="text" class="form-control form-control-sm" id="father_name" v-model="formModel.father_name" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="mother" class="col-sm-2 col-form-label font-weight-normal text-right">Mother</label>
    <div class="col-sm-10">
        <input type="text" class="form-control form-control-sm" id="mother" v-model="formModel.mother_name" disabled>
    </div>
</div>


<div class="row">
    <div class="col-6">
        <div class="form-group required row">
            <label for="mother" class="col-sm-4 col-form-label font-weight-normal text-right">Religion</label>
            <div class="col-sm-8">
                <select class="custom-select-sm custom-select mb-2 mr-sm-3" id="year" v-model="formModel.religion">
                    <option value="">Select</option>
                    <option value="Islam">Islam</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Christian">Christian</option>
                    <option value="Buddha">Buddha</option>
                </select>
                <span v-if="errors.religion" :class="['text-danger']">@{{ errors.religion[0] }}</span>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="mother"
                   class="col-sm-4 col-form-label font-weight-normal text-right">Gender</label>
            <div class="col-sm-8">
                <select class="custom-select-sm custom-select mb-2 mr-sm-3" id="year" v-model="formModel.gender" disabled>
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
                <input type="text" class="form-control form-control-sm" id="mother" v-model="formModel.eiin_no"
                       disabled>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group required row">
            <label for="mother" class="col-sm-4 col-form-label font-weight-normal text-right">Center Code</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="mother" v-model="formModel.center_code">
                <span v-if="errors.center_code" :class="['text-danger']">@{{ errors.center_code[0] }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <div class="form-group required row">
            <label for="phone" class="col-sm-4 col-form-label font-weight-normal text-right">Student Mobile</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="phone" v-model="formModel.phone">
                <span v-if="errors.phone" :class="['text-danger']">@{{ errors.phone[0] }}</span>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="dob"
                   class="col-sm-4 col-form-label font-weight-normal text-right">DOB</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="dob" v-model="formModel.dob" disabled>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <div class="form-group row">
            <label for="institute" class="col-sm-4 col-form-label font-weight-normal text-right">Institute</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="institute" v-model="formModel.institute" disabled>
                <span v-if="errors.institute" :class="['text-danger']">@{{ errors.institute[0] }}</span>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group required row">
            <label for="sonali_sheba" class="col-sm-4 col-form-label font-weight-normal text-right">Sonali sheba No</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="sonali_sheba" v-model="formModel.sonali_sheba_no">
                <span v-if="errors.sonali_sheba_no" :class="['text-danger']">@{{ errors.sonali_sheba_no[0] }}</span>
            </div>
        </div>
    </div>
</div>

<div class="form-group required row">
    <label for="address1" class="col-sm-2 col-form-label fs-6 font-weight-normal text-right">Present Address</label>
    <div class="col-sm-10">
        <textarea class="form-control" rows="3" id="address1" v-model="formModel.present_address"></textarea>
        <span v-if="errors.present_address" :class="['text-danger']">@{{ errors.present_address[0] }}</span>
    </div>
</div>

<div class="form-group required row">
    <label for="address2" class="col-sm-2 col-form-label font-weight-normal text-right">Permanent Address</label>
    <div class="col-sm-10">
        <textarea class="form-control" rows="3" id="address2" v-model="formModel.permanent_address"></textarea>
        <span v-if="errors.permanent_address" :class="['text-danger']">@{{ errors.permanent_address[0] }}</span>
    </div>
</div>


