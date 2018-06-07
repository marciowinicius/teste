{{ csrf_field() }}
<input type="hidden" name="id" required id="id" value="{{$product['id'] or ''}}">
<div class="row">
    @is('superuser')
    <div class="input-field col s4 {{ $errors->has('shopping_id') ? 'has-error' : '' }}">
        <select required class="js-states browser-default" {{ (isset($product) ? 'disabled' : '')}} id="shopping_id">
            @if(!isset($product))
                <option value="option_select" disabled selected>Shopping</option>
            @endif
            @foreach($shoppings as $shopping)
                <option value="{{ $shopping['id'] }}" {{isset($company) && $company['shopping_id'] == $shopping['id']  ? 'selected' : ''}}>{{ $shopping['fantasyname'] }}</option>
            @endforeach
        </select>
        @if ($errors->has('shopping_id'))
            <span class="red-text  text-darken-2">
                <strong>{{ $errors->first('shopping_id') }}</strong>
            </span>
        @endif
    </div>
    @endis
    @shield('product.adm')
    <div class="input-field col s4 {{ $errors->has('company_id') ? ' has-error' : '' }}">
        <select required class="js-states browser-default" name="company_id" {{ (isset($product) ? 'disabled' : '')}} id="company_id">
            @if(!isset($product))
                <option value="option_select" disabled selected>Empresas</option>
            @endif
            @if (isset($companies) && !empty($companies))
                @foreach($companies as $company)
                    <option value="{{ $company['id'] }}" {{isset($product['id']) && $product['company_id'] == $company['id']  ? 'selected' : ''}}>{{ $company['fantasyname'] }}</option>
                @endforeach
            @endif
        </select>
        @if ($errors->has('company_id'))
            <span class="red-text text-darken-2">
            <strong>{{ $errors->first('company_id') }}</strong>
        </span>
        @endif
    </div>
    @endshield
    @if(isset($product))
        @shield('product.update')
        <div class="input-field col s4">
            <a onclick="enable()"
               class="waves-effect waves-circle waves-light btn-floating btn-list-default" title="Editar"><i
                        class="material-icons" id="icom-list">mode_edit</i></a>
        </div>
        @endshield
    @endif
</div>
<div class="input-field col s12 {{ $errors->has('name') ? ' has-error' : '' }}">
    <input id="name" name="name" autocomplete="off" type="text" required class="validate" length="50" minlength="3"
           {{ (isset($product) ? 'disabled' : '')}} value="{{$product['name'] or old('name')}}">
    <label for="name">Nome</label>
    @if ($errors->has('name'))
        <span class="red-text text-darken-2">
      <strong>{{ $errors->first('name') }}</strong>
    </span>
    @endif
</div>
<div class="input-field col s3 {{ $errors->has('quantity_in_stock') ? ' has-error' : '' }}">
    <input id="quantity_in_stock" name="quantity_in_stock" autocomplete="off" type="number" required class="validate"
           {{ (isset($product) ? 'disabled' : '')}} value="{{$product['quantity_in_stock'] or old('quantity_in_stock')}}">
    <label for="quantity_in_stock">Quantidade em estoque</label>
    @if ($errors->has('quantity_in_stock'))
        <span class="red-text text-darken-2">
      <strong>{{ $errors->first('quantity_in_stock') }}</strong>
    </span>
    @endif
</div>
<div class="input-field col s3 {{ $errors->has('quantity_by_day') ? ' has-error' : '' }}">
    <input id="quantity_by_day" name="quantity_by_day" autocomplete="off" type="number" required class="validate"
           {{ (isset($product) ? 'disabled' : '')}} value="{{$product['quantity_by_day'] or old('quantity_by_day')}}">
    <label for="quantity_by_day">Quantidade de resgate por dia</label>
    @if ($errors->has('quantity_by_day'))
        <span class="red-text text-darken-2">
      <strong>{{ $errors->first('quantity_by_day') }}</strong>
    </span>
    @endif
</div>
<div class="input-field col s3 {{ $errors->has('quantity_by_cpf') ? ' has-error' : '' }}">
    <input id="quantity_by_cpf" name="quantity_by_cpf" autocomplete="off" type="number" required class="validate"
           {{ (isset($product) ? 'disabled' : '')}} value="{{$product['quantity_by_cpf'] or old('quantity_by_cpf')}}">
    <label for="quantity_by_day">Quantidade de resgate por CPF</label>
    @if ($errors->has('quantity_by_cpf'))
        <span class="red-text text-darken-2">
      <strong>{{ $errors->first('quantity_by_cpf') }}</strong>
    </span>
    @endif
</div>
<div class="input-field col s4 {{ $errors->has('price') ? ' has-error' : '' }}">
    <input id="price" name="price" autocomplete="off" type="text" required class="price validate" placeholder="50,00"
           {{ (isset($product) ? 'disabled' : '')}} value="{{$product['price'] or old('price')}}">
    <label for="price">Preço</label>
    @if ($errors->has('price'))
        <span class="red-text text-darken-2">
      <strong>{{ $errors->first('price') }}</strong>
    </span>
    @endif
</div>
<div class="input-field col s4 {{ $errors->has('date_start') ? ' has-error' : '' }}">
    <input autocomplete="off" required id="date_start" name="date_start" type="text" class="datepicker"
           {{ (isset($product) ? 'disabled' : '')}} value="{{$product['date_start'] or old('date_start')}}">
    <label class="active" for="date_start">Data Inicial</label>
    @if ($errors->has('date_start'))
        <span class="red-text  text-darken-2">
            <strong>{{ $errors->first('date_start') }}</strong>
        </span>
    @endif
</div>
<div class="input-field col s4 {{ $errors->has('date_end') ? ' has-error' : '' }}">
    <input autocomplete="off" required id="date_end" name="date_end" type="text" class="datepicker"
           {{ (isset($product) ? 'disabled' : '')}} value="{{$product['date_end'] or old('date_end')}}">
    <label class="active" for="date_end">Data Final</label>
    @if ($errors->has('date_end'))
        <span class="red-text  text-darken-2">
            <strong>{{ $errors->first('date_end') }}</strong>
        </span>
    @endif
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="input-field col s2">
        Local de retirada diferente do endereço da loja?
    </div>
    <div class="input-field col s1 left-align">
        <a onclick="changeToAddressToWithdraw()"
           class="waves-effect waves-circle waves-light btn-floating btn-list-default"
           title="Alterar endereço de entrega"><i
                    class="material-icons" id="icom-list">local_shipping</i></a>
    </div>
    <div class="input-field col s9 left-align" style="margin-top: 3%;">
        <input id="address_to_withdraw" name="address_to_withdraw" autocomplete="off" type="text" class="validate"
               length="150" minlength="3" disabled
               value="{{isset($product) && !is_null($product['address_to_withdraw']) ? $product['address_to_withdraw'] : \Illuminate\Support\Facades\Auth::user()->company->getLocation()}}">
        <label for="address_to_withdraw">Endereço de retirada</label>
        @if ($errors->has('address_to_withdraw'))
            <span class="red-text text-darken-2">
              <strong>{{ $errors->first('address_to_withdraw') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="clearfix"></div>
<div class="input-field col s12 {{ $errors->has('description') ? 'has-error' : '' }}">
    <input id="description" name="description" autocomplete="off" type="text" required class="validate" length="150"
           {{ (isset($product) ? 'disabled' : '')}} minlength="5"
           value="{{$product['description'] or old('description')}}">
    <label for="description">Descrição/Características</label>
    @if ($errors->has('description'))
        <span class="red-text text-darken-2">
      <strong>{{ $errors->first('description') }}</strong>
    </span>
    @endif
</div>
<div class="clearfix"></div>
<div class="input-field col s12 {{ $errors->has('how_use') ? 'has-error' : '' }}">
    <textarea {{ (isset($product) ? 'disabled' : '')}} placeholder="Escrever como funciona aqui" autocomplete="off"
              id="how_use" name="how_use" length="4000"
              class="materialize-textarea">{{$product['how_use'] or old('how_use')}}</textarea>
    <label for="use_rule">Como funciona &nbsp;&nbsp;&nbsp;
        <a class="waves-effect waves-light waves-grey modal-trigger" href="#modal-how-use" title="Exemplos">
            <i class="material-icons" id="icom-list">radio_button_checked</i>
        </a>
    </label>
    @if ($errors->has('how_use'))
        <span class="red-text text-darken-2">
          <strong>{{ $errors->first('how_use') }}</strong>
        </span>
    @endif
</div>
<div class="input-field col s12 {{ $errors->has('rules') ? 'has-error' : '' }}">
    <textarea {{ (isset($product) ? 'disabled' : '')}} placeholder="Escrever regras aqui" autocomplete="off" id="rules"
              name="rules" length="4000"
              class="materialize-textarea">{{$product['rules'] or old('rules')}}</textarea>
    <label for="rules">Regras &nbsp;&nbsp;&nbsp;
        <a class="waves-effect waves-light waves-grey modal-trigger" href="#modal-rules" title="Exemplos">
            <i class="material-icons" id="icom-list">radio_button_checked</i>
        </a>
    </label>
    @if ($errors->has('rules'))
        <span class="red-text text-darken-2">
          <strong>{{ $errors->first('rules') }}</strong>
        </span>
    @endif
</div>
<div class="clearfix"></div>
<br/>
@if (isset($product['id']))
    <div class="col s12">
        <div class="card-panel grey lighten-5 z-depth-1">
            <div class="row valign-wrapper">
                <div class="col s12 offset-l3">
                    <img src="{{$product['image']}}" align="center" alt="Imagem do produto" class="responsive-img">
                </div>
            </div>
        </div>
    </div>
@endif
<div class="input-field col s12 {{ $errors->has('image') ? ' has-error' : '' }}" id="div-image">
    <div class="file-field input-field">
        <div class="btn tooltipped" data-position="top" data-delay="50"
             data-tooltip="Arquivos aceitos: JPEG, JPG, PNG.">
            <span>Imagem do produto</span>
            <input {{ (isset($product) ? 'disabled' : '')}} type="file" name="image" id="image">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
        </div>
        @if ($errors->has('image'))
            <span class="red-text  text-darken-2">
              <strong>{{ $errors->first('image') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="row">
    <div class="col s1" style="margin-top: 10px">
        Precisa agendar?
    </div>
    <div class="input-field col s3 left-align">
        <div class="switch">
            <label>
                Não
                <input type="checkbox"
                       {{(isset($product) ? ($product['to_schedule'] == 't' ? 'checked' : '') : old('to_schedule'))}} name="to_schedule"
                       {{ (isset($product) ? 'disabled' : '')}} data-on="yes" data-off="no">
                <span class="lever"></span>
                Sim
            </label>
        </div>
    </div>
</div>
@if (isset($product['id']))
    <div class="input-field col s9 {{ $errors->has('situation') ? ' has-error' : '' }}">
        <p>Situação</p>
        @foreach($situations as $keySituation => $situation)
            <p>
                <input name="situation" type="radio" id="{{ $keySituation }}"
                       {{ (isset($product) ? 'disabled' : '')}} value="{{ $situation }}" {{ $product['situation'] == $keySituation ? 'checked' : '' }}>
                <label for="{{ $keySituation }}">{{ $situation }}</label>
            </p>
        @endforeach
    </div>
    <div class="input-field col s12">
        <div class="switch">
            <label>
                Desativado
                <input type="checkbox" {{$product['status'] == 't' ? 'checked' : ''}} name="status" data-on="yes"
                       {{ (isset($product) ? 'disabled' : '')}} data-off="no">
                <span class="lever"></span>
                Ativado
            </label>
        </div>
    </div>
@endif
<div class="col s12 right-align m-t-sm">
    <a onclick="atualizarDadosModal()" class="waves-effect waves-light waves-grey btn-flat modal-trigger" href="#modal"><i
                class="material-icons left">phone_iphone</i>APP</a>
    <a href="{{ route('indexProduct') }}" class="waves-effect waves-grey btn-flat"><i class="material-icons left">subdirectory_arrow_left</i>Voltar</a>
    @shield(['product.add','product.update'])
    <button id="save" {{ (isset($product) ? 'disabled' : '')}} type="submit" class="waves-effect waves-light btn"><i
                class="material-icons left">save</i>Salvar
    </button>
    @endshield
</div>
<div id="modal" class="modal modal-fixed-footer">
    <div class="modal-content" style="background-color:white; font-family: 'Lato';">
        <div class="row">
            <div class="col s3">
                @if(isset($product))
                    <img src="{{$product['image']}}" align="center" alt="Imagem do produto"
                         class="responsive-img" id="image_preview_added">
                    <div id="image-holder"></div>
                @else
                    <div id="image-holder"></div>
                @endif
            </div>
            <div class="col s4">
                <div class="row" style="margin-top: 15%; font-size: 25px;"><p id="p_produto" style="color: #1c3d91;">
                    </p></div>
                <div class="row" style="margin-top: -9%; font-size: 20px"><p id="p_company" style="color: #4593d0;">
                    </p></div>
            </div>
            <div class="col s3" style="text-align: center; display:block; margin-top: 6%">
                <div class="flex-rectangle"
                     style="font-size: 22px; display:table-cell; vertical-align:middle; width: 300px;background: #1c3d91;">
                    <p id="p_points" style="color: white; text-align: center;"></p></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Fechar</a>
        </div>
    </div>
</div>
<div id="modal-how-use" class="modal modal-fixed-footer">
    <div class="modal-content" style="background-color:white;">
        <div class="row modal-header">
            <h4>Exemplos - marque para selecionar os que deseja</h4>
        </div>
        <div id="checkbox-how-use">
            @foreach($all_use_rules as $use_rule)
                <div class="row">
                    <p>
                        <input type="checkbox" id="chb-how-use-{{$use_rule['id']}}" value="{{$use_rule['text']}}"/>
                        <label for="chb-how-use-{{$use_rule['id']}}">{{$use_rule['text']}}</label>
                    </p>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Fechar</a>
            <a href="#!" onclick="getValuesCheckboxHowUse()"
               class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
        </div>
    </div>
</div>
<div id="modal-rules" class="modal modal-fixed-footer">
    <div class="modal-content" style="background-color:white;">
        <div class="row modal-header">
            <h4>Exemplos - marque para selecionar os que deseja</h4>
        </div>
        <div id="checkbox-rules">
            @foreach($all_swap_rules as $swap_rule)
                <div class="row">
                    <p>
                        <input type="checkbox" id="chb-rules-{{$swap_rule['id']}}" value="{{$swap_rule['text']}}"/>
                        <label for="chb-rules-{{$swap_rule['id']}}">{{$swap_rule['text']}}</label>
                    </p>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Fechar</a>
            <a href="#!" onclick="getValuesCheckboxRules()"
               class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
        </div>
    </div>
</div>
@section('post-script')
    @include('js.js-mask')
    @include('js.js-enable-disabled')
    @include('products.js')
@endsection
