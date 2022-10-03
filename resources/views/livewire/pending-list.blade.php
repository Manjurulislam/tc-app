<div class="row">
    <div class="col-12">
{{--        @include('backend.modal.update')--}}
        @include('backend.modal.details')
{{--        @include('backend.modal.bulk-update')--}}
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Application List</h3>
                <div class="card-tools">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group input-group-sm" style="width: 300px;">
                                <input wire:model="search" type="search" name="table_search"
                                       class="form-control float-right"
                                       placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-right">
{{--                            <button class="btn btn-success btn-sm" wire:click="export">--}}
{{--                                Export--}}
{{--                            </button>--}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                @if(!blank($selectedStudents))
                    <button data-toggle="modal" data-target="#bulkUpdateModal" class="btn btn-success btn-sm">
                        Bulk status update
                    </button>
                @endif
                <table class="table table-bordered table-sm small text-nowrap">
                    <thead>
                    <tr class="thead-dark font-weight-light">
                        <th>SL</th>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>Mother Name</th>
                        <th>Phone</th>
                        <th>Current College</th>
                        <th>College admission</th>
                        <th>SSC Roll</th>
                        <th>SSC Reg</th>
                        <th>Comp. Subjects</th>
                        <th>Elec. Subject</th>
                        <th>Optn. Subject</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!blank($items))
                        @foreach($items as $item)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$item->student ? $item->student->name : ''}}</td>
                                <td>{{$item->student ? $item->student->father_name : ''}}</td>
                                <td>{{$item->student ? $item->student->mother_name : ''}}</td>
                                <td>{{$item->student ? $item->student->phone :''}}</td>
                                <td>{{$item->student->academicInfo ? $item->student->academicInfo->college_name :''}}</td>
                                <td>{{$item->college_name}}</td>
                                <td>{{$item->student->academicInfo ? $item->student->academicInfo->ssc_roll_no :''}}</td>
                                <td>{{$item->student->academicInfo ? $item->student->academicInfo->ssc_reg_no :''}}</td>
                                <td>{{$item->student->academicInfo ? $item->student->academicInfo->subject_comp :''}}</td>
                                <td>{{$item->student->academicInfo ? $item->student->academicInfo->subject_elec :''}}</td>
                                <td>{{$item->student->academicInfo ? $item->student->academicInfo->subject_optn :''}}</td>
                                <td class="text-capitalize">
                                    <span class="badge bg-success">{{\App\Models\Application::$status[$item->status]}}</span>
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#detailModal" wire:click="show({{ $item->id }})" class="btn btn-warning btn-xs">
                                        Details
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-1 clearfix">
                <div class="d-flex">
                    <div class="mx-auto">
                        {{$items->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
