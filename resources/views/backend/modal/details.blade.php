<div wire:ignore.self class="modal fade bd-example-modal-lg" id="detailModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($details))
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Student</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-sm text-nowrap">
                                    <tr>
                                        <th style="width: 8%">Name</th>
                                        <td>{{$details->student->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Father Name</th>
                                        <td>{{$details->student->father_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Mother Name</th>
                                        <td>{{$details->student->mother_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{$details->student->phone}}</td>
                                    </tr>
                                    <tr>
                                        <th>Religion</th>
                                        <td>{{$details->student->religion}}</td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td>{{$details->student->gender}}</td>
                                    </tr>
                                    <tr>
                                        <th>DOB</th>
                                        <td>{{$details->student->dob}}</td>
                                    </tr>
                                    <tr>
                                        <th>Center Code</th>
                                        <td>{{$details->student->center_code}}</td>
                                    </tr>
                                    <tr>
                                        <th>Institute</th>
                                        <td>{{$details->student->institute}}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
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
                                        <td>{{$details->cor_name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Father Name</th>
                                        <td>{{$details->cor_father_name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Mother Name</th>
                                        <td>{{$details->cor_mother_name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Religion</th>
                                        <td>{{$details->cor_religion ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td>{{$details->cor_gender ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>DOB</th>
                                        <td>{{$details->cor_dob ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Remarks</th>
                                        <td>{{$details->remarks}}</td>
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
                                    @if(!blank($details->exams))
                                        @foreach($details->exams as $item)
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
                                    @if($details->birthCertificate)
                                        <tr>
                                            <th style="width: 15%">Birth Certificate</th>
                                            <td>
                                                <a href="{{$details->birthCertificate}}" target="_blank" class="btn btn-success btn-xs">
                                                    <i class="fas fa-file-download"></i> Download
                                                </a>
                                            </td>
                                        </tr>
                                    @endif

                                    @if($details->schoolCertificate)
                                        <tr>
                                            <th style="width: 15%">Primary School Certificate</th>
                                            <td>
                                                <a href="{{$details->schoolCertificate}}" target="_blank" class="btn btn-success btn-xs">
                                                    <i class="fas fa-file-download"></i> Download
                                                </a>
                                            </td>
                                        </tr>
                                    @endif

                                    @if($details->testimonial)
                                        <tr>
                                            <th style="width: 15%">Testimonial</th>
                                            <td>
                                                <a href="{{$details->testimonial}}" target="_blank" class="btn btn-success btn-xs">
                                                    <i class="fas fa-file-download"></i> Download
                                                </a>
                                            </td>
                                        </tr>
                                    @endif

                                    @if($details->nid)
                                        <tr>
                                            <th style="width: 15%">NID</th>
                                            <td>
                                                <a href="{{$details->nid}}" target="_blank" class="btn btn-success btn-xs">
                                                    <i class="fas fa-file-download"></i> Download
                                                </a>
                                            </td>
                                        </tr>
                                    @endif

                                    @if($details->affidavit)
                                        <tr>
                                            <th style="width: 15%">Affidavit</th>
                                            <td>
                                                <a href="{{$details->affidavit}}" target="_blank" class="btn btn-success btn-xs">
                                                    <i class="fas fa-file-download"></i> Download
                                                </a>
                                            </td>
                                        </tr>
                                    @endif

                                    @if($details->nidGurd)
                                        <tr>
                                            <th style="width: 15%">Nid Extra</th>
                                            <td>
                                                <a href="{{$details->nidGurd}}" target="_blank" class="btn btn-success btn-xs">
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
                @endif
            </div>
            <div class="modal-footer">
                <button  class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
