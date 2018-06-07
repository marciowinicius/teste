@extends('layouts.admin')
@section('content')
    <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                <a type="submit" href="{{ route('admin.addCar') }}" class="waves-effect waves-light btn right"><i class="material-icons left">add</i>Novo</a>
                <table class="display responsive-table centered" id="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Proprietário</th>
                        <th>Placa</th>
                        <th>Renavam</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Ano</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('post-script')
    @include('cars.js-index')
    @include('cars.js')
@endsection


