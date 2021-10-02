@extends('layouts.app')
@section('content')
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="signup-card card-block auth-body mr-auto ml-auto">
                        {{Form::open(['method'=>"post", 'url'=>"/resetpassword", 'class'=>"md-float-material"])}}
                        @csrf
                            <div class="text-center" style="font-size:30px; font-weight: bold;">
                                SIGE
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Recuperação de Palavra-Passe</h3>
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
                                    {{Form::text('username', null, ['class'=>"form-control", 'placeholder'=>"Nome de usuário"])}}
                                    <span class="md-line"></span>
                                </div>
                                <div class="erro">
                                    @if($errors->has('username'))
                                    <div class="text-danger">{{$errors->first('username')}}</div>
                                    @endif
                                </div>

                                <div class="input-group">
                                    {{Form::email('email', null, ['class'=>"form-control", 'placeholder'=>"Email de registro"])}}
                                    <span class="md-line"></span>
                                </div>
                                <div class="erro">
                                    @if($errors->has('email'))
                                    <div class="text-danger">{{$errors->first('email')}}</div>
                                    @endif
                                </div>

                                <div class="input-group">
                                    {{Form::number('telefone', null, ['class'=>"form-control", 'placeholder'=>"Telefone"])}}
                                    <span class="md-line"></span>
                                </div>
                                <div class="erro">
                                    @if($errors->has('telefone'))
                                    <div class="text-danger">{{$errors->first('telefone')}}</div>
                                    @endif
                                </div>

                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Recuperar</button>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Após preencher o formulário receberá SMS em seu E-mail.</p>
                                        <p class="text-inverse text-left"><b>Sua equipe de autenticação</b></p>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="/" title="Voltar a Página Principal"><i class="ti-home"></i></a>
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
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
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
</body>

@endsection
