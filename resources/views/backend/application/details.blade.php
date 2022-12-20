@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Details</h3>
                    <div class="card-tools">
                        <button type="button" onclick="printDiv('printableArea')" class="btn btn-primary btn-sm">
                            <i class="fas fa-print"></i> Print
                        </button>
                        @if(data_get($data,'is_file'))
                            <a href="{{route('download', data_get($data,'id'))}}" class="btn btn-success btn-sm">
                                <i class="fas fa-download"></i> Marksheet
                            </a>
                        @endif
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" id="printableArea">
                    <table class="table table-bordered table-sm text-nowrap">
                        <tr>
                            <th style="width: 8%">Name</th>
                            <td>{{data_get($data,'name')}}</td>
                        </tr>
                        <tr>
                            <th>Father Name</th>
                            <td>{{data_get($data,'father_name')}}</td>
                        </tr>
                        <tr>
                            <th>Mother Name</th>
                            <td>{{data_get($data,'mother_name')}}</td>
                        </tr>

                        <tr>
                            <th>Phone</th>
                            <td>{{data_get($data,'phone')}}</td>
                        </tr>

                        <tr>
                            <th>SSC Roll</th>
                            <td>{{data_get($data,'roll_no')}}</td>
                        </tr>
                        <tr>
                            <th>SSC Reg. No.</th>
                            <td>{{data_get($data,'reg_no')}}</td>
                        </tr>
                        <tr>
                            <th>SSC Passing Year</th>
                            <td>{{data_get($data,'pass_year')}}</td>
                        </tr>
                        <tr>
                            <th>CGPA</th>
                            <td>{{data_get($data,'cgpa')}}</td>
                        </tr>
                    </table>
                    <div class="pt-2">
                        <h6 class="text-center text-uppercase">Current College</h6>
                        <table class="table table-bordered table-sm text-nowrap">
                            <tr>
                                <th style="width: 12%">EIIN</th>
                                <td>{{data_get($data,'current_col.eiin_no')}}</td>
                            </tr>
                            <tr>
                                <th>College</th>
                                <td>{{data_get($data,'current_col.name')}}</td>
                            </tr>
                            <tr>
                                <th>Group</th>
                                <td>{{data_get($data,'current_col.group')}}</td>
                            </tr>

                            <tr>
                                <th>Class</th>
                                <td>{{data_get($data,'current_col.class')}}</td>
                            </tr>
                            <tr>
                                <th>Session</th>
                                <td>{{data_get($data,'current_col.session')}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="pt-0">
                        <h6 class="text-center text-uppercase">Admission College</h6>
                        <table class="table table-bordered table-sm text-nowrap">
                            <tr>
                                <th style="width: 12%">EIIN</th>
                                <td>{{data_get($data,'admission_col.eiin_no')}}</td>
                            </tr>
                            <tr>
                                <th>College</th>
                                <td>{{data_get($data,'admission_col.name')}}</td>
                            </tr>
                            <tr>
                                <th>Subject Com.</th>
                                <td>{{data_get($data,'admission_col.subject_comp')}}</td>
                            </tr>
                            <tr>
                                <th>Subject Elec.</th>
                                <td>{{data_get($data,'admission_col.subject_elec')}}</td>
                            </tr>
                            <tr>
                                <th>Subject Optn.</th>
                                <td>{{data_get($data,'admission_col.subject_optn')}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="pt-2 table-responsive">
                        <table class="table table-bordered table-sm text-nowrap">
                            <thead>
                            <tr>
                                <th style="width: 15%">Name</th>
                                <th style="width: 5%">Role</th>
                                <th style="width: 10%">Comment</th>
                                <th style="width: 4%">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!blank(data_get($data,'approves')))
                                @foreach(data_get($data,'approves') as $item)
                                    <tr>
                                        <td>{{data_get($item,'admin.inst_name')}}</td>
                                        <td>{{\App\Models\User::$role[data_get($item,'admin.user_role')]}}</td>
                                        <td>{{data_get($item,'comment.body')}}</td>
                                        <td>{{$item->is_approved ? 'Approved' : 'Pending'}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
