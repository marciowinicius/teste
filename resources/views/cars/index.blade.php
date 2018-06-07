@extends('layouts.admin')
@section('content')
    <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                @if(\Illuminate\Support\Facades\Auth::user()->role == \FederalSt\User::ROLE_ADMIN)
                    <a type="submit" href="{{ route('admin.addCar') }}" class="waves-effect waves-light btn right"><i
                                class="material-icons left">add</i>Novo</a>
                @endif
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
                        @if(\Illuminate\Support\Facades\Auth::user()->role == \FederalSt\User::ROLE_ADMIN)
                            <th>Ações</th>
                        @endif
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


