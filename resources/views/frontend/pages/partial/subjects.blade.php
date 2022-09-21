<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Subjects
        </h3>
    </div>
    <div class="card-body border border-2">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="mother" value="Bangla" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="mother" value="English" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="email" class="form-control" id="mother" value="ICT" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <select class="form-control select2" id="group" wire:model="subjects" data-placeholder="Select a Subject" multiple="multiple">
                        @if(!blank($subject))
                            @foreach($subject as $item)
                                <option value="{{$item->subj_code}}">{{$item->subj_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

        </div>
    </div>
</div>
