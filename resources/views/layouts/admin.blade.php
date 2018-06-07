<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>FederaIst</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta charset="UTF-8">
    <meta name="keywords" content="FederaIst"/>
    <meta name="author" content="FederaIst"/>
    <link rel="icon" type="image/png" href="{{url('assets/images/laravel.png')}}"/>
    <link href="{{ asset('assets/plugins/materialize/css/materialize.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/fonts/icon.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/material-preloader/css/materialPreloader.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/alpha.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/jstree/dist/themes/default/style.min.css') }}" rel='stylesheet'>
    <link href="{{ asset('assets/plugins/jquery-confirm/css/jquery-confirm.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/metrojs/MetroJs.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/weather-icons-master/css/weather-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/select2/css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/timepicker/css/timepicker.css') }}" rel="stylesheet">
</head>
<body>
<div class="loader-bg"></div>
<div class="loader">
    <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-blue">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
</div>
<div class="mn-content fixed-sidebar">
    <header class="mn-header navbar-fixed">
        <nav class="cyan darken-1">
            <div class="nav-wrapper row">
                <section class="material-design-hamburger navigation-toggle">
                    <a href="#" data-activates="slide-out"
                       class="button-collapse show-on-large material-design-hamburger__icon">
                        <span class="material-design-hamburger__layer"></span>
                    </a>
                </section>
                <div class="header-title col s3">
                    <span class="chapter-title">FederaIst</span>
                </div>
            </div>
        </nav>
    </header>
    <aside id="slide-out" class="side-nav white fixed">
        <div class="side-nav-wrapper">
            <div class="sidebar-profile">
                <div id="profile">
                    <div class="sidebar-profile-image">

                        <img src="{{ asset('assets/images/profile-image.png') }}" class="circle">
                    </div>
                    <div class="sidebar-profile-info">
                        <a href="javascript:void(0);" class="account-settings-link">
                            <p>{{ Auth::user()->name }}</p>
                            <span>{{ Auth::user()->email }}<i class="material-icons right">arrow_drop_down</i></span>

                        </a>
                    </div>
                </div>
            </div>
            <div class="sidebar-account-settings">
                <ul>
                    <li class="no-padding">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="waves-effect waves-grey"><i class="material-icons">exit_to_app</i>Sair</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
            <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
                <div class="footer">
                    <p class="copyright">FederaIst ©</p>
                    <a href="#!">Privacidade</a> &amp; <a href="#!">Termos</a>
                </div>
            </ul>
        </div>
    </aside>
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title title-page-breadcrumb">
                    <p class="p-title-page">{!! Session::get('title') !!}</p>
                    {{ Breadcrumbs::render('federaist') }}
                </div>
            </div>
            <div class="col s12">
                @if (Session::has('flash_error'))
                    <div class="message-error" id="message-alerts">
                        <p class="p-message-alert">Error: {{ Session::get('flash_error') }} <i
                                    class="material-icons icon-message-alert">error_outline</i></p>

                    </div>
                @endif
                @if (Session::has('flash_success'))
                    <div class="message-success" id="message-alerts">
                        <p class="p-message-alert">{{ Session::get('flash_success') }} <i
                                    class="material-icons icon-message-alert">done</i></p>
                    </div>
                @endif
                @if (Session::has('flash_info'))
                    <div class="message-info" id="message-alerts">
                        <p class="p-message-alert">{{ Session::get('flash_info') }} <i
                                    class="material-icons icon-message-alert">info_outline</i></p>
                    </div>
                @endif
                @if (Session::has('flash_warning'))
                    <div class="message-warning" id="message-alerts">
                        <p class="p-message-alert">{{ Session::get('flash_warning') }} <i
                                    class="material-icons icon-message-alert">warning</i></p>
                    </div>
                @endif
            </div>
            @yield('content')
        </div>
    </main>
</div>
<div class="left-sidebar-hover"></div>
<script src="{{ asset('assets/plugins/jquery/jquery-2.2.0.min.js') }}"></script>
<script src="{{ asset('assets/plugins/materialize/js/materialize.min.js') }}"></script>
<script src="{{ asset('assets/plugins/material-preloader/js/materialPreloader.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-blockui/jquery.blockui.js') }}"></script>
<script src="{{ asset('assets/js/alpha.min.js') }}"></script>
<script src="{{ asset('assets/js/jstree/dist/jstree.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jqueryMask/jquery.mask.js') }}"></script>
<script src="{{ asset('assets/plugins/jqueryMask/jquery.mask.min.js') }}"></script>
<script src="{{ asset('assets/js/message-alert.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-confirm/js/jquery-confirm.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net/datatables1-10-16.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-select2.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jqueryMask/jquery.maskMoney.min.js') }}"></script>
<script src="{{ asset('assets/plugins/number-format/jquery.number.min.js') }}"></script>
<script src="{{ asset('assets/plugins/timepicker/js/timepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/baloon/baloon.min.js') }}"></script>
@yield('post-script')


</body>
</html>