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
                            <th>Religion</th>
                            <th>DOB</th>
                            <th>Gender</th>
                            <th>Present Address</th>
                            <th>Permanent Address</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!blank($student))
                            <tr>
                                <td>{{$student->name}}</td>
                                <td>{{$student->father_name}}</td>
                                <td>{{$student->mother_name}}</td>
                                <td>{{$student->phone}}</td>
                                <td>{{$student->religion}}</td>
                                <td>{{$student->dob}}</td>
                                <td>{{$student->gender}}</td>
                                <td>{{$student->present_address}}</td>
                                <td>{{$student->permanent_address}}</td>
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
                    <h3 class="card-title text-uppercase">Applied for correction</h3>
                </div>
                <div class="card-body p-2">
                    <table class="table table-bordered table-sm small text-nowrap" style="text-align: center">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Exam</th>
                            <th>Roll No.</th>
                            <th>Reg No.</th>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>Mother Name</th>
                            <th>Religion</th>
                            <th>DOB</th>
                            <th>Gender</th>
                            <th>So. No.</th>
                            <th>Meeting At</th>
                            <th>Applied At</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!blank($student->application))
                            @foreach($student->application as $key=>$app)
                                <tr>
                                    <td>{{($key+1)}}</td>
                                    <td>
                                        {{$app->exams ? $app->exams->map(function ($item){ return $item->exam->title;   })->implode(',') : ''}}
                                    </td>
                                    <td>
                                        {{$app->exams ? $app->exams->map(function ($item){ return $item->roll_no;   })->implode(',') : ''}}
                                    </td>
                                    <td>
                                        {{$app->exams ? $app->exams->map(function ($item){ return $item->reg_no;   })->implode(',') : ''}}
                                    </td>
                                    <td>{{$app->cor_name ?? 'N/A'}}</td>
                                    <td>{{$app->cor_father_name ?? 'N/A'}}</td>
                                    <td>{{$app->cor_mother_name ?? 'N/A'}}</td>
                                    <td>{{$app->cor_religion ?? 'N/A'}}</td>
                                    <td>{{$app->cor_dob ?? 'N/A'}}</td>
                                    <td>{{$app->cor_gender ?? 'N/A'}}</td>
                                    <td>{{$app->sonali_sheba_no ?? 'N/A'}}</td>
                                    <td>
                                        {{$app->meeting_date ? $app->meeting_date->format('d-m-Y, h:i:s') :  'N/A'}}
                                    </td>
                                    <td>{{$app->created_at->format('d-m-Y')}}</td>
                                    <td>
                                        <span class="badge badge-primary">
                                            {{\App\Models\Application::$status[$app->status]}}
                                        </span>
                                    </td>
                                    <td>
                                        @if($app->status == 4)
                                            <a href="{{route('student.download')}}" class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
