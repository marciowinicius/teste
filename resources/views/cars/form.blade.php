{{ csrf_field() }}
<input type="hidden" name="id" required id="id" value="{{$car['id'] or ''}}">
<div class="row">
    <div class="input-field col s4 {{ $errors->has('user_id') ? 'has-error' : '' }}">
        <select required class="select" id="user_id" name="user_id">
            <option value="option_select" disabled selected>Proprietário</option>
            @foreach($users as $user)
                <option value="{{ $user['id'] }}" {{isset($car) && $car['user_id'] == $user['id']  ? 'selected' : ''}}>{{ $user['email'] }}</option>
            @endforeach
        </select>
        @if ($errors->has('user_id'))
            <span class="red-text  text-darken-2">
                <strong>{{ $errors->first('user_id') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="row">
    <div class="input-field col s6 {{ $errors->has('placa') ? ' has-error' : '' }}">
        <input id="placa" name="placa" autocomplete="off" type="text" required class="validate" length="8"
               value="{{$car['placa'] or old('placa')}}">
        <label for="placa">Placa</label>
        @if ($errors->has('placa'))
            <span class="red-text text-darken-2">
      <strong>{{ $errors->first('placa') }}</strong>
    </span>
        @endif
    </div>
    <div class="input-field col s6 {{ $errors->has('renavam') ? ' has-error' : '' }}">
        <input id="renavam" name="renavam" autocomplete="off" type="text" required class="validate" length="20"
               value="{{$car['renavam'] or old('renavam')}}">
        <label for="renavam">Renavam</label>
        @if ($errors->has('renavam'))
            <span class="red-text text-darken-2">
      <strong>{{ $errors->first('renavam') }}</strong>
    </span>
        @endif
    </div>
</div>
<div class="row">
    <div class="input-field col s4 {{ $errors->has('modelo') ? ' has-error' : '' }}">
        <input id="modelo" name="modelo" autocomplete="off" type="text" required class="validate" minlength="3"
               value="{{$car['modelo'] or old('modelo')}}">
        <label for="modelo">Modelo</label>
        @if ($errors->has('modelo'))
            <span class="red-text text-darken-2">
      <strong>{{ $errors->first('modelo') }}</strong>
    </span>
        @endif
    </div>
    <div class="input-field col s4 {{ $errors->has('marca') ? ' has-error' : '' }}">
        <input id="marca" name="marca" autocomplete="off" type="text" required class="validate" minlength="3"
               value="{{$car['marca'] or old('marca')}}">
        <label for="marca">Marca</label>
        @if ($errors->has('marca'))
            <span class="red-text text-darken-2">
      <strong>{{ $errors->first('marca') }}</strong>
    </span>
        @endif
    </div>
    <div class="input-field col s4 {{ $errors->has('ano') ? ' has-error' : '' }}">
        <input id="ano" name="ano" autocomplete="off" type="text" required class="validate" length="4"
               value="{{$car['ano'] or old('ano')}}">
        <label for="ano">Ano</label>
        @if ($errors->has('ano'))
            <span class="red-text text-darken-2">
      <strong>{{ $errors->first('ano') }}</strong>
    </span>
        @endif
    </div>
</div>
<div class="col s12 right-align m-t-sm">
    <a href="{{ route('admin.indexCarAdmin') }}" class="waves-effect waves-grey btn-flat"><i class="material-icons left">subdirectory_arrow_left</i>Voltar</a>
    <button id="save" type="submit" class="waves-effect waves-light btn"><i
                class="material-icons left">save</i>Salvar
    </button>
</div>
@section('post-script')
    @include('js.js-mask')
    @include('cars.js')
@endsection
