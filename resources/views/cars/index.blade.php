@extends('layouts.app')
@section('content')
    <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                <a type="submit" href="{{ route('addProduct') }}" class="waves-effect waves-light btn right"><i class="material-icons left">add</i>Novo</a>
                <table class="display responsive-table centered" id="product-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Loja</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('post-script')
    @include('products.js-index')
    @include('products.js')
@endsection


