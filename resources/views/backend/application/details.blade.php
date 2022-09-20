@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Required to Correction</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-sm text-nowrap">
                        <tr>
                            <th style="width: 8%">Name</th>
                            <td>{{$application->corr_name}}</td>
                        </tr>
                        <tr>
                            <th>Father Name</th>
                            <td>{{$application->cor_father_name}}</td>
                        </tr>
                        <tr>
                            <th>Mother Name</th>
                            <td>{{$application->cor_mother_name}}</td>
                        </tr>
                        <tr>
                            <th>Religion</th>
                            <td>{{$application->cor_religion}}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{$application->cor_gender}}</td>
                        </tr>
                        <tr>
                            <th>DOB</th>
                            <td>{{$application->cor_dob}}</td>
                        </tr>
                        <tr>
                            <th>Remarks</th>
                            <td>{{$application->remarks}}</td>
                        </tr>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Correction for exam</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-sm text-nowrap">
                        <thead>
                        <tr>
                            <th>Exam</th>
                            <th>EIIN NO</th>
                            <th>Roll NO.</th>
                            <th>Registration NO.</th>
                            <th>Passing Year</th>
                            <th>Session</th>
                            <th>Center</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!blank($application->exams))
                            @foreach($application->exams as $item)
                                <tr>
                                    <td>{{data_get($item,'exam.title','')}}</td>
                                    <td>{{data_get($item,'eiin_no')}}</td>
                                    <td>{{data_get($item,'roll_no')}}</td>
                                    <td>{{data_get($item,'reg_no')}}</td>
                                    <td>{{data_get($item,'passing_year')}}</td>
                                    <td>{{data_get($item,'session')}}</td>
                                    <td>{{data_get($item,'center')}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Attachments</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-sm text-nowrap">
                        @if($application->birthCertificate)
                        <tr>
                            <th style="width: 15%">Birth Certificate</th>
                            <td>
                                <a href="{{$application->birthCertificate}}" target="_blank" class="btn btn-success btn-xs">
                                    <i class="fas fa-file-download"></i> Download
                                </a>
                            </td>
                        </tr>
                        @endif

                        @if($application->schoolCertificate)
                            <tr>
                                <th style="width: 15%">Primary School Certificate</th>
                                <td>
                                    <a href="{{$application->schoolCertificate}}" target="_blank" class="btn btn-success btn-xs">
                                        <i class="fas fa-file-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                        @endif

                        @if($application->testimonial)
                            <tr>
                                <th style="width: 15%">Testimonial</th>
                                <td>
                                    <a href="{{$application->testimonial}}" target="_blank" class="btn btn-success btn-xs">
                                        <i class="fas fa-file-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                        @endif

                        @if($application->nid)
                            <tr>
                                <th style="width: 15%">NID</th>
                                <td>
                                    <a href="{{$application->nid}}" target="_blank" class="btn btn-success btn-xs">
                                        <i class="fas fa-file-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                        @endif

                        @if($application->affidavit)
                            <tr>
                                <th style="width: 15%">Affidavit</th>
                                <td>
                                    <a href="{{$application->affidavit}}" target="_blank" class="btn btn-success btn-xs">
                                        <i class="fas fa-file-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                        @endif

                        @if($application->nidGurd)
                            <tr>
                                <th style="width: 15%">Nid Extra</th>
                                <td>
                                    <a href="{{$application->nidGurd}}" target="_blank" class="btn btn-success btn-xs">
                                        <i class="fas fa-file-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                        @endif

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection

