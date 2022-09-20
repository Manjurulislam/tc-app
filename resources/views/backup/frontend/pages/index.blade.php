@extends('frontend.layouts.front-app')
@section('content')
    <!--- search form -->
    @include('frontend.pages.partial.search-form')
    <!--- end search form -->







{{--    @if(isset($student))--}}
        <div class="content-student">
            {{--        <div v-if="loading" class="loader mx-auto mt-5"></div>--}}

            {{--        <div class="row" v-if="formModel.student.name">--}}

{{--            @if(!blank($student))--}}
                <div class="row mb-5">
                    <div class="col-8 mx-auto">
                        <div class="card shadow-none mt-3">
                            <form class="form-horizontal">
                                <div class="card-body">
                                    @include('frontend.pages.partial.student-form')
                                    <div class="form-group row">
                                        <label for="address2" class="col-sm-2 col-form-label font-weight-normal text-right">What is required to correct</label>
                                        <div class="col-sm-8">
                                            <div class="row mt-2">
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox">
                                                            <label class="form-check-label">Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox">
                                                            <label class="form-check-label">Father</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox">
                                                            <label class="form-check-label">Mother</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox">
                                                            <label class="form-check-label">Religion</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox">
                                                            <label class="form-check-label">Gender</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('frontend.pages.partial.correction-form')
                                    <div class="form-group row">
                                        <label for="address2" class="col-sm-3 col-form-label font-weight-normal">What Examination Required To correct</label>
                                        <div class="col-sm-8">
                                            <div class="row mt-2">
                                                @if(!blank($exams))
                                                    @foreach($exams as $item)
                                                        <div class="col-2">
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="{{$item->id}}">
                                                                    <label class="form-check-label">{{$item->title}}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>


                    <div class="col-10 mx-auto mb-3">
                        @include('frontend.pages.partial.exams-table')
                        <div class="row mb-3">
                            <div class="mx-auto">
                                @include('frontend.pages.partial.attachment')
                            </div>
                        </div>
                        <div class="card">
                            @include('frontend.pages.partial.notice')
                        </div>
                    </div>
                </div>
{{--            @else--}}
{{--                <div class="jumbotron jumbotron-fluid">--}}
{{--                    <div class="container">--}}
{{--                        <h1 class="text-center text-uppercase">No Data Found</h1>--}}
{{--                        <p class="text-center">Your given information is not correct</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
        </div>
{{--    @endif--}}
@endsection
