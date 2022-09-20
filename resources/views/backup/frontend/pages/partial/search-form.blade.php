<div class="row mt-3">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header p-2">
                Name & Age Correction Form
            </div>
            <div class="card-body p-3">
                <form class="form-inline search-form" action="{{route('details')}}" method="post">
                    @csrf

                    <label for="exam" class="mr-sm-2 font-weight-normal">Exam</label>
                    <select class="custom-select-sm custom-select mb-2 mr-sm-3"
                            id="exam" style="width: 12%">
                        <option value="">Select</option>
                        @if(!blank($exams))
                            @foreach($exams as $item)
                                <option value="{{$item->slug}}">{{$item->title}}</option>
                            @endforeach
                        @endif
                    </select>

                    <label for="year" class="mr-sm-2 font-weight-normal">Passing Year</label>
                    <select class="custom-select-sm custom-select mb-2 mr-sm-3"
                            style="width: 12%" id="year">
                        <option value="">Select</option>
                        @if(!blank($passingYear))
                            @foreach($passingYear as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        @endif
                    </select>
                    <label for="roll" class="mr-sm-3 font-weight-normal">Roll</label>
                    <input type="text" class="form-control form-control-sm mb-2 mr-sm-3" id="roll">
                    <label for="reg" class="mr-sm-3 font-weight-normal">Reg No.</label>
                    <input type="text" class="form-control form-control-sm mb-2 mr-sm-3" id="reg">
                    <label for="center" class="mr-sm-3 font-weight-normal">Center Name & Code</label>
                    <input type="text" class="form-control form-control-sm mb-2 mr-sm-3" id="center">
                    <button type="submit" class="btn btn-primary btn-sm mb-2">Find
                        <i class="fa fa-search"></i>
                    </button>
                </form>

                <div class="row">
                    <div class="col-2 text-right">
                        @if($errors->has('exam'))
                        <span class="text-danger">{{$errors->first('exam')}}</span>
                        @endif
                    </div>
                    <div class="col-2 text-right">
                        @if($errors->has('year'))
                            <span class="text-danger">{{$errors->first('year')}}</span>
                        @endif
                    </div>
                    <div class="col-2 text-right">
                        @if($errors->has('rollNo'))
                            <span class="text-danger">{{$errors->first('rollNo')}}</span>
                        @endif
                    </div>
                    <div class="col-2 text-right">
                        @if($errors->has('regNo'))
                            <span class="text-danger">{{$errors->first('regNo')}}</span>
                        @endif
                    </div>
                    <div class="col-3 text-right">
                        @if($errors->has('centerName'))
                            <span class="text-danger">{{$errors->first('centerName')}}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>