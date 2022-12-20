<div class="row">
    <div class="col-12">
        @include('backend.modal.comment.edit')
        @include('backend.modal.comment.create')

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Signature</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-6 mx-auto">
                        <form>
                            <div class="form-group">
                                <label for="name">EIIN :</label>
                                <input type="text" class="form-control" value="{{$user->eiin_no}}" id="name" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Name :</label>
                                <input type="text" class="form-control" value="{{$user->inst_name}}" id="name" readonly>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="signature">Signature :</label>
                                        <input type="file" class="form-control"  wire:model="signature"  id="signature">
                                        @error('signature') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                   <div class="pt-3">
                                       @if(!blank($user->signature_image) && $user->signature_image !== 'Null')
                                       <img src="{{asset('storage/'.$user->signature_image)}}" class="img-thumbnail" alt="signature">
                                       @elseif($signature)
                                           <img src="{{ $signature->temporaryUrl() }}" class="img-thumbnail" alt="signature">
                                       @else
                                           <img src="https://via.placeholder.com/350x50" class="img-thumbnail" alt="signature">
                                       @endif
                                   </div>
                                </div>
                            </div>



                            <div class="text-center pt-3">
                                <button type="button" wire:click.prevent="store()" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
