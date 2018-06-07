@extends('layouts.app')
@section('content')
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <form class="col s12" method="POST" id="form" action="{{route('storeProduct')}}" enctype="multipart/form-data">
                        @include('products.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('post-script')
    @include('products.js')
@endsection