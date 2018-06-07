<div class="row">
    <h5>ID: {{ $car['id'] }}</h5>
</div>
<div class="row">
    <div class="input-field col s6">
        <p>Placa: {{$car['placa']}}</p>
    </div>
    <div class="input-field col s6">
        <p>Renavam: {{$car['renavam']}}</p>
    </div>
</div>
<div class="row">
    <div class="input-field col s6">
        <p>Modelo: {{$car['modelo']}}</p>
    </div>
    <div class="input-field col s6">
        <p>Marca: {{$car['marca']}}</p>
    </div>
    <div class="input-field col s6">
        <p>Ano: {{$car['ano']}}</p>
    </div>
</div>
<div class="col s12 right-align m-t-sm">
    <a href="{{ route('cars.indexCarUser') }}" class="waves-effect waves-grey btn-flat"><i class="material-icons left">subdirectory_arrow_left</i>Voltar</a>
</div>
