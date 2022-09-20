<div class="row mt-3">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header p-2">
                Name & Age Correction Form
            </div>
            <div class="card-body p-3">
                <form class="form-inline search-form" action="">
                    @csrf

                    <label for="exam" class="mr-sm-2 font-weight-normal">Exam</label>
                    <select class="custom-select-sm custom-select mb-2 mr-sm-3" v-model="searchParams.exam"
                            id="exam" style="width: 12%">
                        <option value="">Select</option>
                        @if(!blank($exams))
                            @foreach($exams as $item)
                                <option value="{{$item->slug}}">{{$item->title}}</option>
                            @endforeach
                        @endif
                    </select>

                    <label for="year" class="mr-sm-2 font-weight-normal">Passing Year</label>
                    <select class="custom-select-sm custom-select mb-2 mr-sm-3" v-model="searchParams.year"
                            style="width: 12%" id="year">
                        <option value="">Select</option>
                        @if(!blank($passingYear))
                            @foreach($passingYear as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        @endif
                    </select>
                    <label for="roll" class="mr-sm-3 font-weight-normal">Roll</label>
                    <input type="text" class="form-control form-control-sm mb-2 mr-sm-3" v-model="searchParams.rollNo" id="roll">
                    <label for="reg" class="mr-sm-3 font-weight-normal">Reg No.</label>
                    <input type="text" class="form-control form-control-sm mb-2 mr-sm-3" id="reg" v-model="searchParams.regNo">
                    <label for="center" class="mr-sm-3 font-weight-normal">Center Name & Code</label>
                    <input type="text" class="form-control form-control-sm mb-2 mr-sm-3" id="center" v-model="searchParams.centerName">
                    <button type="button" @click="studentDetails" class="btn btn-primary btn-sm mb-2">Find
                        <i class="fa fa-search"></i>
                    </button>
                </form>

                <div class="row" id="search-error" hidden v-if="errors">
                    <div class="col-2 text-center">
                        <span v-if="errors.exam" :class="['text-danger']">@{{ errors.exam[0] }}</span>
                    </div>
                    <div class="col-2 text-right">
                        <span v-if="errors.year" :class="['text-danger']">@{{ errors.year[0] }}</span>
                    </div>
                    <div class="col-2 text-center">
                        <span v-if="errors.rollNo" :class="['text-danger']">@{{ errors.rollNo[0] }}</span>
                    </div>
                    <div class="col-2 text-right">
                        <span v-if="errors.regNo" :class="['text-danger']">@{{ errors.regNo[0] }}</span>
                    </div>
                    <div class="col-3 text-right">
                        <span v-if="errors.centerName" :class="['text-danger']">@{{ errors.centerName[0] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
