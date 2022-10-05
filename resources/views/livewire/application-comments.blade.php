<div class="row">
    <div class="col-12">
        @include('backend.modal.comment.edit')
        @include('backend.modal.comment.create')

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Comment List</h3>
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
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#createModal">
                                Add New
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-sm small text-nowrap">
                    <thead>
                    <tr class="thead-dark font-weight-light">
                        <th>SL</th>
                        <th>Title</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!blank($items))
                        @foreach($items as $item)
                            <tr>
                                <td width="5%">{{$loop->index + 1}}</td>
                                <td>{{$item->title}}</td>
                                <td width="50%">{{$item->body }}</td>
                                <td class="text-capitalize">
                                    <span class="badge bg-success">{{$item->status ? 'Active' : 'Inactive'}}</span>
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#updateModal"
                                            wire:click="edit({{ $item->id }})" class="btn btn-primary btn-xs">
                                        Edit
                                    </button>
                                    <button wire:click="delete({{ $item->id }})" class="btn btn-danger btn-xs">
                                        Delete
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
