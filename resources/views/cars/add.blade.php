@extends('layouts.admin')
@section('content')
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <form class="col s12" method="POST" id="form" action="{{route('admin.storeCar')}}" enctype="multipart/form-data">
                        @include('cars.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('post-script')
    @include('cars.js')
@endsection