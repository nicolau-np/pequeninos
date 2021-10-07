<?php
use App\Http\Controllers\ControladorStatic;
$lastYear = ControladorStatic::getLastYear();
?>
<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

<head>
<title>{{$title}}</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="SIGE - Sistema de Gestão Escolar">
      <meta name="keywords" content="sistema , gestão, escolar, Sistema, Gestão, Escolar, SIGE, sige, escola, gestor, sistema de gestao escolar">
      <meta name="author" content="Nicolau NP">
      <!-- Favicon icon -->
      <link rel="icon" href="{{asset('assets/template/images/favicon.ico')}}" type="image/x-icon">
      <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="{{asset('assets/template/css/bootstrap/css/bootstrap.min.css')}}">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="{{asset('assets/template/icon/themify-icons/themify-icons.css')}}">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="{{asset('assets/template/icon/icofont/css/icofont.css')}}">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="{{asset('assets/template/css/style.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/template/css/jquery.mCustomScrollbar.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/template/style.css')}}">
    <script src="{{asset('assets/template/js/jquery-360.js')}}"></script>

      @if($menu=="Gráfico" || $submenu == "Gráfico")
      <script src="{{asset('assets/highcharts/highcharts.js')}}"></script>
      <script src="{{asset('assets/highcharts/modules/exporting.js')}}"></script>
      <script src="{{asset('assets/highcharts/modules/export-data.js')}}"></script>
      <script src="{{asset('assets/highcharts/modules/accessibility.js')}}"></script>
      @endif


  </head>
  @if($type!="login")
  <body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    @if($type=="mobile")
    @yield('content')
    @else
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="/">
                            <!--<img class="img-fluid" src="{{asset('assets/logos/logo2.png')}}" style="width:50%; height:50px;" alt="Theme-Logo" />-->
                            <span style="font-weight: bold; font-size:25px;">SIGE</span>
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>

                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <a href="#!">
                                    <i class="ti-bell"></i>
                                    <span class="badge bg-c-pink"></span>
                                </a>
                                <ul class="show-notification">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center" src="{{asset('assets/template/images/user.png')}}" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">John Doe</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center" src="{{asset('assets/template/images/user.png')}}" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Joseph William</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center" src="{{asset('assets/template/images/user.png')}}" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Sara Soudein</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                            <li class="user-profile header-notification">
                                <a href="#!">
                                    <img src="{{asset('assets/template/images/profile.png')}}" class="img-radius" alt="User-Profile-Image">
                                    <span>
                                        @auth
                                            {{Auth::user()->username}}
                                        @endauth
                                    </span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <li>
                                        <a href="#!">
                                            <i class="ti-settings"></i> Configurações
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/user/profile">
                                            <i class="ti-user"></i> Perfil
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-email"></i> Mensagens
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-lock"></i> Bloquear
                                        </a>
                                    </li>
                                    <li>
                                    <a href="{{route('logout')}}">
                                            <i class="ti-layout-sidebar-left"></i> Sair
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-40 img-radius" src="{{asset('assets/template/images/profile.png')}}" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span>
                                            @auth
                                                {{Auth::user()->username}}
                                            @endauth
                                        </span>
                                        <span id="more-details">
                                            @auth
                                                {{Auth::user()->nivel_acesso}}
                                            @endauth
                                            <i class="ti-angle-down"></i></span>
                                    </div>
                                </div>

                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="#"><i class="ti-user"></i>Ver Perfil</a>
                                            <a href="#"><i class="ti-settings"></i>Configurações</a>
                                            <a href="{{route('logout')}}"><i class="ti-layout-sidebar-left"></i>Sair</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="pcoded-search">
                                <span class="searchbar-toggle">  </span>
                                <div class="pcoded-search-box ">
                                    <input type="text" placeholder="Search">
                                    <span class="search-icon"><i class="ti-search" aria-hidden="true"></i></span>
                                </div>
                            </div>

                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Principal</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="@if($menu=="Home") active @endif">
                                    <a href="/home">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>H</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Home</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                @if (Auth::user()->nivel_acesso=="admin" || Auth::user()->nivel_acesso=="user")
                                <li class="@if($menu=="Usuários") active @endif">
                                    <a href="/usuarios/">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>U</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Usuários</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="@if($menu=="Funcionários") active @endif">
                                    <a href="/funcionarios/">
                                        <span class="pcoded-micon"><i class="ti-layout-tab-v"></i><b>F</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Funcionários</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="@if($menu=="Directores de Turma") active @endif">
                                    <a href="/directores/">
                                        <span class="pcoded-micon"><i class="ti-briefcase"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Directores</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="@if($menu=="Estudantes") active @endif">
                                    <a href="/estudantes/">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i><b>F</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Estudantes</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="@if($menu=="Turma") active @endif">
                                    <a href="/turmas/list/{{$lastYear}}">
                                        <span class="pcoded-micon"><i class="ti-layers"></i><b>T</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Turmas</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                @endif
                            </ul>

                            @if (Auth::user()->nivel_acesso=="admin" || Auth::user()->nivel_acesso=="user")
                                  <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms">Extras</div>
                            <ul class="pcoded-item pcoded-left-item">

                                @if(Auth::user()->nivel_acesso=="admin")
                                <li class="pcoded-hasmenu @if($type=="institucional") active pcoded-trigger @endif">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-settings"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Institucional</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="@if($menu=="Cursos") active @endif">
                                            <a href="/institucional/cursos/">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Cursos</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li class="@if($menu=="Turmas") active @endif">
                                            <a href="/institucional/turmas/">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Turmas</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="@if($menu=="Disciplinas") active @endif">
                                            <a href="/institucional/disciplinas/">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Disciplinas</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="@if($menu=="Grades Curricular") active @endif">
                                            <a href="/institucional/grades/">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Grade Curricular</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                      <!--  <li class="@if($menu=="Salas") active @endif">
                                            <a href="/institucional/salas/">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Salas</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li class="@if($menu=="Horas") active @endif">
                                            <a href="/institucional/horas/">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Horas</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>-->

                                        <li class="@if($menu=="Ano Lectivo") active @endif">
                                            <a href="/institucional/ano_lectivos/">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Ano Lectivo</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li class="@if($menu=="Observações") active @endif">
                                            <a href="/institucional/observacoes/">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Observações</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li class="@if($menu=="Recursos") active @endif">
                                            <a href="/institucional/recursos/">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Recursos</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li class="@if($menu=="Exames") active @endif">
                                            <a href="/institucional/exames/">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Exames</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                                @endif

                                @if(Auth::user()->nivel_acesso=="admin")
                                <li class="pcoded-hasmenu @if($type=="financas") active pcoded-trigger @endif">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-money"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Finanças</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="@if($menu=="Tipo de Pagamentos") active @endif">
                                            <a href="/financas/tipo_pagamentos/">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Tipos de Pagamentos</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="@if($menu=="Tabela de Preços") active @endif">
                                            <a href="/financas/tabela_precos/">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Tabela de Preços</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>


                                <li class="@if($menu=="Encarregados") active @endif">
                                    <a href="/encarregados/">
                                        <span class="pcoded-micon"><i class="ti-layout-media-overlay-alt"></i><b>E</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Encarregados</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                @endif


                                <li class="pcoded-hasmenu @if($type=="estatisticas") active pcoded-trigger @endif">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-bar-chart"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Estatísticas</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        @if(Auth::user()->nivel_acesso=="admin" || Auth::user()->nivel_acesso=="user")
                                        <li class="@if($menu=="Listas de Pagamentos") active @endif">
                                            <a href="/estatisticas/pagamentos/">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Listas de Pagamentos</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        @endif

                                        @if(Auth::user()->nivel_acesso=="admin")
                                        <li class="@if($menu=="Balanços") active @endif">
                                            <a href="/estatisticas/balancos/list/{{$lastYear}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Balanços</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        @endif


                                    </ul>
                                </li>
                                @if(Auth::user()->nivel_acesso=="admin")
                                <li class="@if($menu=="Bloqueios de Epocas") active @endif">
                                    <a href="/bloqueios">
                                        <span class="pcoded-micon"><i class="ti-key"></i><b>B</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Bloqueios</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="@if($menu=="Mapas") active @endif">
                                    <a href="/mapas">
                                        <span class="pcoded-micon"><i class="ti-map"></i><b>M</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Mapas</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                             @endif

                            </ul>
                            @endif

                            @if(Auth::user()->nivel_acesso=="professor")
                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Professor</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="@if($menu=="Caderneta") active @endif">
                                    <a href="/cadernetas/list/{{$lastYear}}">
                                        <span class="pcoded-micon"><i class="icofont icofont-file-alt"></i><b>H</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Caderneta</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="@if($menu=="Minha Turma") active @endif">
                                    <a href="/minha_turma/list/{{$lastYear}}">
                                        <span class="pcoded-micon"><i class="ti-folder"></i><b>U</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Minha Turma</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>


                            </ul>
                            @endif

                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms">Acerca</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="@if($menu=="Sistema") active @endif">
                                    <a href="/about/sistema">
                                        <span class="pcoded-micon"><i class="ti-bookmark-alt"></i><b>S</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Sistema</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="@if($menu=="Instituição") active @endif">
                                    <a href="/about/instituicao">
                                        <span class="pcoded-micon"><i class="ti-direction-alt"></i><b>I</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Instituição</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>


                            </ul>

                        </div>
                    </nav>

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    @if($type!="home")
                                    <!-- Page-header start -->
                                    <div class="page-header card">
                                        <div class="row align-items-end">
                                            <div class="col-lg-8">
                                                <div class="page-header-title">
                                                    <i class="icofont icofont-layout bg-c-blue"></i>
                                                    <div class="d-inline">
                                                        <h4>{{$menu}}</h4>
                                                    <span>{{$type}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item">
                                                        <a href="{{route('home')}}">
                                                                <i class="icofont icofont-home"></i>
                                                            </a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="#!">{{$menu}}</a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="#!">{{$submenu}}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-header end -->
                                    @endif
                                  @yield('content')
                            </div>
                        </div>
                        <!-- Main-body end -->
                        <div id="styleSelector">

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    @endif
</div>
@if($menu=="Home")
<div class="fixed-button">
	<a href="https://codedthemes.com/item/guru-able-admin-template/" target="_blank" class="btn btn-md btn-primary">
	  <i class="fa fa-shopping-cart" aria-hidden="true"></i> Versão PRO
	</a>
</div>
@endif
<!-- Warning Section Starts -->
<!-- Older IE warning message -->
    <!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="{{asset('assets/template/images/browser/chrome.png')}}" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="{{asset('assets/template/images/browser/firefox.png')}}" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="{{asset('assets/template/images/browser/opera.png')}}" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="{{asset('assets/template/images/browser/safari.png')}}" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="{{asset('assets/template/images/browser/ie.png')}}" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->
<!-- Required Jquery -->
<script type="text/javascript" src="{{asset('assets/template/js/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/template/js/jquery-ui/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/template/js/popper.js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/template/js/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{asset('assets/template/js/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{asset('assets/template/js/modernizr/modernizr.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/template/js/modernizr/css-scrollbars.js')}}"></script>
<!-- classie js -->
<script type="text/javascript" src="{{asset('assets/template/js/classie/classie.js')}}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{asset('assets/template/js/script.js')}}"></script>
<script src="{{asset('assets/template/js/pcoded.min.js')}}"></script>
<script src="{{asset('assets/template/js/demo-12.js')}}"></script>
<script src="{{asset('assets/template/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Accordion js -->
<script type="text/javascript" src="{{asset('assets/template/pages/accordion/accordion.js')}}"></script>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).ready(function() {
        $('[data-toggle="popover"]').popover({
            html: true,
            content: function() {
                return $('#primary-popover-content').html();
            }
        });
    });

</script>

</body>
@else
@yield('content')
@endif
</html>
