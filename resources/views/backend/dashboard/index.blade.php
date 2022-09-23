@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$pending}}</h3>
                    <p>Pending</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list"></i>
                </div>
                <a href="{{route('pending')}}" class="small-box-footer">
                    More
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$approved}}</h3>
                    <p>Approved</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list"></i>
                </div>
                <a href="{{route('approve')}}" class="small-box-footer">
                    More
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
