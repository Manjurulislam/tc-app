@if($setSubjects)
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Subjects
            </h3>
        </div>
        <div class="card-body border border-2">
            <div class="row">
                <div class="col-md-1">
                    <div class="form-group">
                        <input type="text" class="form-control" value="Bangla" readonly>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <input type="text" class="form-control" value="English" readonly>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <input type="email" class="form-control" value="ICT" readonly>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group required">
                        <div wire:ignore>
                            <select class="form-control" id="select2-dropdown"
                                    data-placeholder="Select Subjects" multiple="multiple">
                                @if(!blank($subjectsArr))
                                    @foreach($subjectsArr as $item)
                                        <option value="{{$item->subj_code}}">{{$item->subj_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @error('subjects') <small class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@push('scripts')
    <script>
        $(document).ready(function () {
            window.loadSelect2 = () => {
                $('#select2-dropdown').select2();
                $('#select2-dropdown').on('change', function (e) {
                    var data = $('#select2-dropdown').select2('val');
                    @this.set('subjects', data);
                });
            }
            loadSelect2();
            window.livewire.on('select2Hydrate', () => {
                loadSelect2();
            });
        })
    </script>
@endpush
