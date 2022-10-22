<div class="row">
    <div class="col-12">
        @include('backend.modal.update')
        @include('backend.modal.approve-details')
        @include('backend.modal.bulk-update')
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
                @if(!blank($multipleSelect))
                    <button data-toggle="modal" data-target="#bulkUpdateModal" class="btn btn-success btn-sm">
                        Approves
                    </button>
                @endif
                <table class="table table-bordered table-sm small text-nowrap">
                    <thead>
                    <tr class="thead-dark font-weight-light">
                        <th></th>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>Mother Name</th>
                        <th>Phone</th>
                        <th>Current College</th>
                        <th>College admission</th>
                        <th>SSC Roll</th>
                        <th>SSC Reg</th>
                        <th>Subjects</th>
                        <th>Sharok No.</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!blank($items))
                        @foreach($items as $item)
                            <tr>
                                <td>
                                    @if(!$item->approved)
                                        <input type="checkbox" wire:model="multipleSelect" value="{{ $item->id }}"
                                               style="margin-left: -16px">
                                    @endif
                                </td>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->father_name}}</td>
                                <td>{{$item->mother_name}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->current_college}}</td>
                                <td>{{$item->admission_college}}</td>
                                <td>{{$item->ssc_roll_no}}</td>
                                <td>{{$item->ssc_reg_no}}</td>
                                <td>
                                    <div class="text-bold">Comp. - {{$item->subject_comp}}</div>
                                    <div class="text-bold">Elec. - {{$item->subject_elec}} , Optn.
                                        - {{$item->subject_optn}}</div>
                                </td>
                                <td>{{$item->sharok_no}}</td>
                                <td class="text-capitalize">
                                    <span class="badge bg-success">{{$item->status}}</span>
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#detailsModal" type="button"
                                            wire:click="details({{ $item->application_id }})"
                                            class="btn btn-warning btn-xs">
                                        Details
                                    </button>
                                    @if(!$item->approved)
                                        <button data-toggle="modal" data-target="#updateModal"
                                                wire:click="updateStatus({{ $item->id }})"
                                                class="btn btn-primary btn-xs">
                                            Approve
                                        </button>
                                    @endif
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
