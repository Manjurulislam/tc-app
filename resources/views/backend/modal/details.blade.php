<div wire:ignore.self class="modal fade bd-example-modal-lg" id="detailModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
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
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Current College</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-sm text-nowrap">
                                    <tr>
                                        <th style="width: 8%">Name</th>
                                        <td>{{$details->student->academicInfo ? $details->student->academicInfo->college_name :''}}</td>
                                    </tr>
                                    <tr>
                                        <th>Group</th>
                                        <td>{{$details->student->academicInfo ? $details->student->academicInfo->group :''}}</td>
                                    </tr>
                                    <tr>
                                        <th>Class</th>
                                        <td>{{$details->student->academicInfo ? $details->student->academicInfo->class :''}}</td>
                                    </tr>
                                    <tr>
                                        <th>Class Roll</th>
                                        <td>{{$details->student->academicInfo ? $details->student->academicInfo->roll_no :''}}</td>
                                    </tr>
                                    <tr>
                                        <th>Session</th>
                                        <td>{{$details->student->academicInfo ? $details->student->academicInfo->session :''}}</td>
                                    </tr>
                                    <tr>
                                        <th>Compulsory Subjects</th>
                                        <td>{{$details->student->academicInfo ? $details->student->academicInfo->subject_comp :''}}</td>
                                    </tr>
                                    <tr>
                                        <th>Elective Subject</th>
                                        <td>{{$details->student->academicInfo ? $details->student->academicInfo->subject_elec :''}}</td>
                                    </tr>
                                    <tr>
                                        <th>Optional Subject</th>
                                        <td>{{$details->student->academicInfo ? $details->student->academicInfo->subject_optn :''}}</td>
                                    </tr>
                                    <tr>
                                        <th>SSC Roll</th>
                                        <td>{{$details->student->academicInfo ? $details->student->academicInfo->ssc_roll_no :''}}</td>
                                    </tr>
                                    <tr>
                                        <th>SSC Reg No.</th>
                                        <td>{{$details->student->academicInfo ? $details->student->academicInfo->ssc_reg_no :''}}</td>
                                    </tr>
                                    <tr>
                                        <th>SCC Passing Year</th>
                                        <td>{{$details->student->academicInfo ? $details->student->academicInfo->ssc_pass_year :''}}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Applied for admission</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-sm text-nowrap">
                                    <tr>
                                        <th style="width: 8%">EIIN NO.</th>
                                        <td>{{$details->eiin_no}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 8%">College code</th>
                                        <td>{{$details->college_code}}</td>
                                    </tr>
                                    <tr>
                                        <th>College Name</th>
                                        <td>{{$details->college_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Post Office</th>
                                        <td>{{$details->post_office}}</td>
                                    </tr>
                                    <tr>
                                        <th>Upazila</th>
                                        <td>{{$details->upazila}}</td>
                                    </tr>
                                    <tr>
                                        <th>District</th>
                                        <td>{{$details->district}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><span class="badge bg-success">{{\App\Models\Application::$status[$details->status]}}</span></td>
                                    </tr>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>



                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Approval Process</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-sm text-nowrap">
                                    @foreach(data_get($details,'approves') as $item)
                                        <tr>
                                            <td>{{data_get($item,'admin.inst_name')}}</td>
                                            <td>{{\App\Models\User::$role[data_get($item,'admin.user_role')]}}</td>
                                            <td>{{data_get($item,'comment.body')}}</td>
                                            <td>
                                                    <span class="badge bg-pink text-uppercase">
                                                        {{$item->is_approved ? 'Approved' : 'Pending'}}
                                                    </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
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
