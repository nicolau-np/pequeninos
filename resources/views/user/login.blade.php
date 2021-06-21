@extends('layouts.app')
@section('content')
<style>
    .text-danger{
        font-size: 12px;
    }
    .erro{
        margin-left: 0%;
    }
</style>
<body class="fix-menu">
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

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        {{Form::open(['method'=>"post", 'class'=>"md-float-material", 'url'=>"/logar"])}}


                            <div class="text-center">
                                <img src="{{asset('assets/logos/logo1.png')}}" alt='logo.png' style="width:150px; height:120px;"/>
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">Entrar</h3>
                                    </div>
                                </div>
                                <hr/>
                                @if(session('error'))
                                <div class="alert alert-danger">{{session('error')}}</div>
                                @endif

                                @if(session('success'))
                                <div class="alert alert-success">{{session('success')}}</div>
                                @endif

                                <div class="input-group">
                                    {{Form::text('username', null, ['placeholder'=>"Nome de Usuário", 'class'=>"form-control"])}}
                                    <span class="md-line"></span>

                                </div>
                                <div class="erro">
                                @if($errors->has('username'))
                                <div class="text-danger">{{$errors->first('username')}}</div>
                                @endif
                                </div>

                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="Palavra-Passe" name="password">
                                    <span class="md-line"></span>

                                </div>
                                <div class="erro">
                                    @if($errors->has('password'))
						            <div class="text-danger">{{$errors->first('password')}}</div>
						            @endif
                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-sm-7 col-xs-12">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Lembrar me</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                        <a href="auth-reset-password.html" class="text-right f-w-600 text-inverse"> Esqueceu sua senha?</a>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign in</button>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Obrigado e aproveite nosso site.</p>
                                        <p class="text-inverse text-left"><b>Sua equipe de autenticação</b></p>
                                    </div>
                                </div>

                            </div>
                        {{Form::close()}}
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
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
    <script type="text/javascript" src="{{asset('assets/template/js/common-pages.js')}}"></script>
    <SCRIPT LANGUAGE="JavaScript">
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
        //-->
        </script>
</body>


@endsection
