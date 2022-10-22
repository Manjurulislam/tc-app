<div wire:ignore.self class="modal fade bd-example-modal-xl" id="detailsModal" tabindex="-1" role="dialog"
     aria-labelledby="approveDetail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveDetail">Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($detailsItems))
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline card-primary">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-bordered table-sm text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 15%">Name</th>
                                            <th style="width: 5%">Role</th>
                                            <th>Comment</th>
                                            <th style="width: 4%">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!blank(data_get($detailsItems,'approves')))
                                            @foreach(data_get($detailsItems,'approves') as $item)
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
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
