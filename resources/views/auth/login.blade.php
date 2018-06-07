<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
        <title>Federa Ist</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="keywords" content="FederaIst" />
        <meta name="author" content="FederaIst" />
        <link rel="icon" type="image/png" href="{{url('assets/images/laravel.png')}}" />
        <link href="{{ asset('assets/plugins/materialize/css/materialize.min.css') }}" type="text/css" rel="stylesheet" >
        <link href="{{ asset('assets/fonts/icon.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/material-preloader/css/materialPreloader.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/alpha.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    </head>
    <body class="signin-page">
        <div class="loader-bg"></div>
        <div class="loader">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mn-content valign-wrapper background-login" style="background: url('{{ asset('/assets/images/background.jpg') }}')">
            <main class="mn-inner container">
                <div class="valign">
                      <div class="row">
                          <div class="col s12 m6 l4 offset-l4 offset-m3">
                              <div class="card white darken-1">
                                  <div class="card-content ">
                                       <div class="row">
                                            <form class="col s12" role="form" method="POST" action="{{ route('login') }}">
                                              {{ csrf_field() }}
                                              <div class="input-field col s12 {{ $errors->has('email') ? ' has-error' : '' }}">
                                                <input autocomplete="off" id="email" name="email" type="text" class="validate">
                                                <label for="email">Email</label>
                                                @if ($errors->has('email'))
                                                  <span class="red-text text-darken-2">
                                                      <strong>{{ $errors->first('email') }}</strong>
                                                  </span>
                                                @endif
                                              </div>
                                              <div class="input-field col s12 {{ $errors->has('password') ? ' has-error' : '' }}">
                                                <input autocomplete="off" id="password" name="password" type="password" class="validate">
                                                <label for="password">Senha</label>
                                                  @if ($errors->has('password'))
                                                    <span class="red-text text-darken-2">
                                                      <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif
                                              </div>
                                              <div class="col s12 right-align m-t-sm">
                                                <button type="submit" class="waves-effect waves-light btn teal">Login</button>
                                              </div>
                                            </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="{{ asset('assets/plugins/jquery/jquery-2.2.0.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/materialize/js/materialize.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/material-preloader/js/materialPreloader.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-blockui/jquery.blockui.js') }}"></script>
        <script src="{{ asset('assets/js/alpha.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jqueryMask/jquery.mask.js') }}"></script>
        <script src="{{ asset('assets/plugins/jqueryMask/jquery.mask.min.js') }}"></script>
    </body>
</html>