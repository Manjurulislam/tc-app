@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-2">
                    <table class="table table-bordered table-sm" style="text-align: center">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>Mother Name</th>
                            <th>Phone</th>
                            <th>Current College</th>
                            <th>Group</th>
                            <th>Class</th>
                            <th>Roll</th>
                            <th>Session</th>
                            <th>Subjects</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!blank($student))
                            <tr>
                                <td>{{$student->name}}</td>
                                <td>{{$student->father_name}}</td>
                                <td>{{$student->mother_name}}</td>
                                <td>{{$student->phone}}</td>
                                <td>{{$student->academicInfo ? $student->academicInfo->college_name : ''}}</td>
                                <td>{{$student->academicInfo ? $student->academicInfo->group : ''}}</td>
                                <td>{{$student->academicInfo ? $student->academicInfo->class : ''}}</td>
                                <td>{{$student->academicInfo ? $student->academicInfo->roll_no : ''}}</td>
                                <td>{{$student->academicInfo ? $student->academicInfo->session : ''}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <br>
                    <table class="table table-bordered table-sm" style="text-align: center">
                        <thead>
                        <tr>
                            <th>Subject Compulsory</th>
                            <th>Subject Elective</th>
                            <th>Subject Optional</th>
                            <th>SSC Roll</th>
                            <th>SSC Reg. No.</th>
                            <th>SSC Passing Year</th>
                            <th>SSC CGPA</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!blank($student))
                            <tr>
                                <td>{{$student->academicInfo ? $student->academicInfo->subject_comp : ''}}</td>
                                <td>{{$student->academicInfo ? $student->academicInfo->subject_elec : ''}}</td>
                                <td>{{$student->academicInfo ? $student->academicInfo->subject_optn : ''}}</td>
                                <td>{{$student->academicInfo ? $student->academicInfo->ssc_roll_no : ''}}</td>
                                <td>{{$student->academicInfo ? $student->academicInfo->ssc_reg_no : ''}}</td>
                                <td>{{$student->academicInfo ? $student->academicInfo->ssc_pass_year : ''}}</td>
                                <td>{{$student->academicInfo ? $student->academicInfo->ssc_cgpa : ''}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-uppercase">Application</h3>
                </div>
                <div class="card-body p-2">
                    <table class="table table-bordered table-sm small text-nowrap" style="text-align: center">
                        <thead>
                        <tr>
                            <th>EIIN NO.</th>
                            <th>College Code</th>
                            <th>College Name</th>
                            <th>Post Office</th>
                            <th>upazila</th>
                            <th>district</th>
                            <th>district</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!blank($student->application))
                            <tr>
                                <td>{{data_get($student,'application.to_college_eiin')}}</td>
                                <td>{{data_get($student,'application.college_code')}}</td>
                                <td>{{data_get($student,'application.college_name')}}</td>
                                <td>{{data_get($student,'application.post_office')}}</td>
                                <td>{{data_get($student,'application.upazila')}}</td>
                                <td>{{data_get($student,'application.district')}}</td>
                                <td>{{data_get($student,'application.sharok_no')}}</td>
                                <td class="text-uppercase">
                                    <span class="badge bg-success">
                                    {{\App\Models\Application::$status[data_get($student,'application.status')]}}
                                    </span>
                                </td>
                                <td>
{{--                                    <a href="{{route('student.download')}}" class="btn btn-sm btn-success">--}}
{{--                                        <i class="fas fa-download"></i>--}}
{{--                                    </a>--}}
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
