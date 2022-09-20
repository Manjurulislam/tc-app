<table class="table">
    <thead>
    <tr>
        <th>Exam</th>
        <th>Year</th>
        <th>Roll</th>
        <th>Registration</th>
        <th>Session</th>
        <th>Center Name & Code</th>
        <th>Eiin</th>
    </tr>
    </thead>
    <tbody>
    @if(!blank($exams))
        @foreach($exams as $item)
            <tr>
                <td>
                    {{$item->title}}
                </td>
                <td>
                    <select class="custom-select-sm custom-select" id="exam">
                        <option value="">Select</option>
                        @if(!blank($exams))
                            @foreach($exams as $item)
                                <option value="{{$item->slug}}">{{$item->title}}</option>
                            @endforeach
                        @endif
                    </select>
                </td>
                <td>
                    <input class="form-control form-control-sm">
                </td>
                <td><input class="form-control form-control-sm"></td>
                <td>
                    <select class="custom-select-sm custom-select">
                        <option value="">Select</option>
                        @if(!blank($passingYear))
                            @foreach($passingYear as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        @endif
                    </select>
                </td>
                <td><input class="form-control form-control-sm"></td>
                <td><input class="form-control form-control-sm"></td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>