<div class="row">
    <div class="col-12">
        @include('backend.modal.details')
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Invalid List</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 300px;">
                        <input wire:model="search" type="search" name="table_search" class="form-control float-right"
                               placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
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
                        <th>Exam</th>
                        <th>Roll</th>
                        <th>Reg.</th>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>Mother Name</th>
                        <th>DOB</th>
                        <th>Cor. Name</th>
                        <th>Cor. Father Name</th>
                        <th>Cor. Mother Name</th>
                        <th>Cor. DOB</th>
                        <th>Phone</th>
                        <th>Religion</th>
                        <th>Gender</th>
                        <th>Institute</th>
                        <th>Center</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!blank($items))
                        @foreach($items as $item)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>
                                    {{$item->exams ? $item->exams->map(function ($item){ return $item->exam->title;   })->implode(',') : ''}}
                                </td>
                                <td>
                                    {{$item->exams ? $item->exams->map(function ($item){ return $item->roll_no;   })->implode(',') : ''}}
                                </td>
                                <td>
                                    {{$item->exams ? $item->exams->map(function ($item){ return $item->reg_no;   })->implode(',') : ''}}
                                </td>
                                <td>{{$item->student ? $item->student->name : ''}}</td>
                                <td>{{$item->student ? $item->student->father_name : ''}}</td>
                                <td>{{$item->student ? $item->student->mother_name : ''}}</td>
                                <td>{{$item->student ? $item->student->dob : ''}}</td>
                                <td>{{$item->cor_name ?? 'N/A'}}</td>
                                <td>{{$item->cor_father_name ?? 'N/A'}}</td>
                                <td>{{$item->cor_mother_name ?? 'N/A'}}</td>
                                <td>{{$item->cor_dob ?? 'N/A'}}</td>
                                <td>{{$item->student ? $item->student->phone :''}}</td>
                                <td>{{$item->student ? $item->student->religion:''}}</td>
                                <td>{{$item->student ? $item->student->gender:''}}</td>
                                <td>{{$item->student ? $item->student->institute:''}}</td>
                                <td>{{$item->student ? $item->student->center_code:''}}</td>
                                <td>
                                    @if($item->photo)
                                        <img src="{{$item->photo}}" width="50" height="40">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#detailModal"
                                            wire:click="show({{ $item->id }})" class="btn btn-warning btn-xs">Details
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
