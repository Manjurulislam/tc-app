<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">College</h3>
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
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 550px;">
                <table class="table table-bordered table-sm small text-nowrap">
                    <thead>
                    <tr class="thead-dark font-weight-light">
                        <th>SL</th>
                        <th>EIIN</th>
                        <th>College Name</th>
                        <th>District</th>
                        <th>Thana</th>
                        <th>Shift</th>
                        <th>Version</th>
                        <th>Group</th>
                        <th class="text-center">Total Seats</th>
                        <th class="text-center">Available Seats</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!blank($items))
                        @foreach($items as $item)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$item->eiin}}</td>
                                <td>{{$item->college_name}}</td>
                                <td>{{$item->district}}</td>
                                <td>{{$item->thana}}</td>
                                <td>{{$item->shift}}</td>
                                <td>{{$item->version}}</td>
                                <td>{{$item->group_name}}</td>
                                <td class="text-center">{{$item->total_seats}}</td>
                                <td class="text-center">{{$item->available_seats}}</td>
                                <td>
{{--                                    <button data-toggle="modal" data-target="#updateModal"--}}
{{--                                            wire:click="updateStatus({{ $item->id }})"--}}
{{--                                            class="btn btn-primary btn-xs">--}}
{{--                                        Edit--}}
{{--                                    </button>--}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>

            <div class="card-footer p-1 clearfix">
                <div class="d-flex">
                    <div class="mx-auto">
                        {{$items->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
