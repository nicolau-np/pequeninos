<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SIGE OKUSSOLEKA - Sistema de Gestão Escolar</title>
    <meta name="description" content="SIGE OKUSSOLEKA - Sistema de Gestão Escolar">
    <meta name="keywords"
        content="sistema , gestão, escolar, Sistema, Gestão, Escolar, SIGE OKUSSOLEKA, sige, escola, gestor, sistema de gestao escolar">
    <meta name="author" content="Nicolau NP">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('assets/template/images/favicon.ico') }}" type="image/x-icon">
    <!-- Place favicon.ico in the root directory -->

    <!-- Font -->
    <link
        href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,700,600italic,700italic,800,800italic'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- Font -->


    <link rel="stylesheet" href="{{ asset('assets/template2/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template2/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template2/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template2/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template2/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template2/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template2/css/responsive.css') }}">
    <script src="{{ asset('assets/template2/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <style>
        .carousel-inner .item img {
            width: 100%;
            height: 38em;
        }

        @media (max-width:700px) {
            .carousel-inner .item img {
                width: 100%;
                height: 16em;
            }

            .carousel-caption .wow {
                padding-top: 35px;
            }
        }

    </style>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- Header Start -->
    <header id="home">

        <!-- Main Menu Start -->
        <div class="main-menu">
            <div class="navbar-wrapper">
                <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle Navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <a href="/" class="navbar-brand">
                                <div style="font-weight: bold; font-size:26px;">
                                    <span style="color:#3ea0e6;">SI</span>GE OKUSSOLEKA
                                </div>
                            </a>
                        </div>

                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="/">Principal</a></li>
                                <li><a href="#about">Sobre</a></li>
                                <li><a href="#contact-us">Contactar</a></li>
                                <li><a href="{{ route('consultar') }}">Consultar</a></li>
                                <li><a href="{{ route('login') }}">Entrar</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Main Menu End -->

        <!-- Sider Start -->
        @if ($type == 'principal')
            <div class="slider">
                <div id="fawesome-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators indicatior2">
                        <li data-target="#fawesome-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#fawesome-carousel" data-slide-to="1"></li>
                    </ol>

                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="{{ asset('assets/template2/img/slide1.jpg') }}" alt="Sider Big Image"
                                class="img_slid" />
                            <div class="carousel-caption">
                                <h1 class="wow fadeInLeft">Todos juntos por uma educação Inclusiva</h1>
                                <div class="slider-btn wow fadeIn">
                                    <a href="#" class="btn btn-learn">SIGE okussoleka</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <img src="{{ asset('assets/template2/img/slide2.jpeg') }}" alt="Sider Big Image"
                                class="img_slid" />
                            <div class="carousel-caption">
                                <h1 class="wow fadeInLeft">Aprender e ensinar de forma abrangente</h1>
                                <div class="slider-btn wow fadeIn">
                                    <a href="#" class="btn btn-learn">SIGE okussoleka</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Sider End -->

    </header>
    <!-- Header End -->


    @yield('content')


    <!-- footer -->
    @if ($type == 'principal')
        <footer>
            <div class="container">
                <div class="row">

                    <!-- Single Footer -->
                    <div class="col-sm-3">
                        <div class="single-footer">
                            <div class="footer-logo">
                                <div style="font-weight: bold; font-size:26px;">
                                    <span style="color:#3ea0e6;">SI</span>GE OKUSSOLEKA
                                </div>
                                <p style="text-align: justify;">O Melhor Sistema de Gestão Escola, com Propinas, Notas e
                                    Estatística Escolar. Aulas, pautas, estatísticas.</p>
                                <p style="text-align: justify;">Cadastre urgentemente a sua escola, e seja um dos bem
                                    sucedidos no que tem haver ao gerenciamento da sua escola.<br /> Basta entrar em
                                    contacto connosco.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Single Footer -->


                    <!-- Single Footer -->
                    <div class="col-sm-3">
                        <div class="single-footer">
                            <h4>Huíla-Lubango-Angola</h4>
                            <p>Bairro da Minhota <br />
                                +(244) 946 216 795 <br />
                                geral@SIGEOKUSSOLEKA.com <br />
                            </p>
                        </div>
                    </div>
                    <!-- Single Footer -->


                    <!-- Single Footer -->
                    <div class="col-sm-3">
                        <div class="single-footer">
                            <h4>Subscrição</h4>
                            <p>Digite seu endereço de e-mail para assinar nossos boletins mensais</p>

                            <form action="">
                                <div class="form-group">
                                    <input type="email" class="form-control my-form" id="exampleInputEmail1"
                                        placeholder="Insira o seu endereço de email">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-subscribe">Subscrever-se</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- Single Footer -->

                    <!-- Single Footer -->
                    <div class="col-sm-3">
                        <div class="single-footer">
                            <h4>Projectos Recentes</h4>
                            <ul class="projects">
                                <li><img src="{{ asset('assets/template2/img/project.png') }}"
                                        alt="Reccent Project" />
                                </li>
                                <li><img src="{{ asset('assets/template2/img/project.png') }}"
                                        alt="Reccent Project" />
                                </li>
                                <li><img src="{{ asset('assets/template2/img/project.png') }}"
                                        alt="Reccent Project" />
                                </li>
                                <li><img src="{{ asset('assets/template2/img/project.png') }}"
                                        alt="Reccent Project" />
                                </li>
                                <li><img src="{{ asset('assets/template2/img/project.png') }}"
                                        alt="Reccent Project" />
                                </li>
                                <li><img src="{{ asset('assets/template2/img/project.png') }}"
                                        alt="Reccent Project" />
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Single Footer -->

                </div>
            </div>

        </footer>

        <!-- Copyright -->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="copy-text">
                            <p>Todos os direitos reservados | Copyright {{ date('Y') }} © powered by Brini-Investiment</p>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="footer-menu pull-right">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><a href="#">Sobre</a></li>
                                <li><a href="#">Contactar</a></li>
                                <li><a href="{{ route('consultar') }}">Consultar</a></li>
                                <li><a href="{{ route('login') }}">Entrar</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="social">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- footer -->




    <script src="https://code.jquery.com/jquery-1.12.0.min.js')}}"></script>
    <script>
        window.jQuery || document.write(
            '<script src="{{ asset('assets/template2/js/vendor/jquery-1.12.0.min.js') }}"><\/script>')

    </script>
    <script src="{{ asset('assets/template2/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/template2/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/template2/js/jquery.mousewheel-3.0.6.pack.js') }}"></script>
    <script src="{{ asset('assets/template2/js/paralax.js') }}"></script>
    <script src="{{ asset('assets/template2/js/jquery.smooth-scroll.js') }}"></script>
    <script src="{{ asset('assets/template2/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('assets/template2/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/template2/js/main.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();

                var target = this.hash;
                var $target = $(target);

                $('html, body').stop().animate({
                    'scrollTop': $target.offset().top
                }, 900, 'swing');
            });
        });

    </script>

    <script src="{{ asset('assets/template2/js/custom.js') }}"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <!--<script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js')}}';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>

<script LANGUAGE="JavaScript">
    <!-- Disable
    function disableselect(e){
    return false
    }

    function reEnable(){
    return true
    }

    //if IE4+
    document.onselectstart=new Function ("return false")
    document.oncontextmenu=new Function ("return false")
    //if NS6
    if (window.sidebar){
    document.onmousedown=disableselect
    document.onclick=reEnable
    }

    </script>-->
</body>

</html>
