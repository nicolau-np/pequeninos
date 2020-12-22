<!DOCTYPE html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png')}}">
        <!-- Place favicon.ico in the root directory -->
		
		<!-- Font -->
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,700,600italic,700italic,800,800italic' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<!-- Font -->
		
		
        <link rel="stylesheet" href="{{asset('assets/template2/css/normalize.css')}}">
        <link rel="stylesheet" href="{{asset('assets/template2/css/main.css')}}">
        <link rel="stylesheet" href="{{asset('assets/template2/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/template2/css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('assets/template2/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/template2/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('assets/template2/css/responsive.css')}}">
        <script src="{{asset('assets/template2/js/vendor/modernizr-2.8.3.min.js')}}"></script>
		
		<style>
            

            @media (max-width:700px){
            .sld{
                width: 100%;
                height: 100px;
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
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="sr-only">Toggle Navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								
								<a href="#" class="navbar-brand"><img src="{{asset('assets/template2/img/logo.png')}}" alt="Logo" /></a>							
							</div>
							
							<div class="navbar-collapse collapse">
								<ul class="nav navbar-nav navbar-right">
									<li><a href="#home">Principal</a></li>
                                    <li><a href="#about">Sobre</a></li>
                                    <li><a href="#contact-us">Contactar</a></li>
                                    <li><a href="#">Consultar</a></li>
                                <li><a href="{{route('login')}}">Entrar</a></li>
								</ul>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<!-- Main Menu End -->
			
			<!-- Sider Start -->
			<div class="slider">
				<div id="fawesome-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators indicatior2">
						<li data-target="#fawesome-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#fawesome-carousel" data-slide-to="1"></li>
					</ol>
				 
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<img src="{{asset('assets/template2/img/slide1.jpg')}}" alt="Sider Big Image" class="img_sld" style="width: 100%; height:38em;">
							<div class="carousel-caption">
								<h1 class="wow fadeInLeft">Todos juntos por uma educação Inclusiva</h1>
								<div class="slider-btn wow fadeIn">
									<a href="#" class="btn btn-learn">OKUSSOLEKA</a>
								</div>
							</div>
						</div>
						<div class="item">
							<img src="{{asset('assets/template2/img/slide2.jpeg')}}" alt="Sider Big Image" class="img_sld" style="width: 100%; height:38em;">
							<div class="carousel-caption">
								<h1 class="wow fadeInLeft">Aprender e ensinar de forma abrangente</h1>
								<div class="slider-btn wow fadeIn">
									<a href="#" class="btn btn-learn">OKUSSOLEKA</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Sider End -->
			
		</header>
		<!-- Header End -->
		
		
		<!-- About Section -->
		<section id="about" class="site-padding">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="about-image wow fadeInLeft">
							<img src="{{asset('assets/template2/img/about-image.jpg')}}" alt="About Image" />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="about-text wow fadeInRight">
							<h3>Sobre OKUSSOLEKA</h3>
							<p>O Melhor Sistema de Gestão e Estatística Escolar. Aulas, pautas, estatísticas, provas em online e muito mais... 
                                Cadastre urgentemente a sua escola, e seja um dos bem sucedidos no que tem haver ao gerenciamento da sua escola.<br/> Basta entrar em contacto connosco  </p>
							<a href="#" class="btn btn-read-more">Ler Mais</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- About Section -->
		
		
		<!-- Award Winning Section -->
		
		<section id="awards" class="site-padding">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="progress-bar-custom wow fadeInLeft">
							<h5>Estatísticas</h5>
							<div class="progress">
							  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
								60%
							  </div>
							</div>
						</div>
						
						<div class="progress-bar-custom wow fadeInLeft">
							<h5>Pautas</h5>
							<div class="progress">
							  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
								90%
							  </div>
							</div>
						</div>
						
					</div>
					
					<div class="col-sm-4">
						
						<div class="progress-bar-custom wow fadeInLeft">
							<h5>Aulas</h5>
							<div class="progress">
							  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
								80%
							  </div>
							</div>
						</div>
						
						<div class="progress-bar-custom wow fadeInLeft">
							<h5>Finanças</h5>
							<div class="progress">
							  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
								70%
							  </div>
							</div>
						</div>
						
					</div>
					
					
					<div class="col-sm-4">
						<div class="award-win wow fadeInRight">
							<div class="trophy">
								<i class="fa fa-trophy"></i>
							</div>
							<h3>180 <br /> Temos Para sí</h3>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<!-- Award Winning Section -->
	
		
		
		<!-- Testimonials -->
		
		<section id="testimonials">
			<div class="container">
				
				<div class="row">
					<div class="col-sm-12">
						<div class="title">
							<h3>Satisfação das <span>Escolas</span></h3>
						</div>
					</div>
				</div>
				
				<div id="fawesome-carousel-two" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#fawesome-carousel-two" data-slide-to="0" class="active"></li>
						<li data-target="#fawesome-carousel-two" data-slide-to="1"></li>
					</ol>
				 
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<div class="row">
								<div class="col-sm-6">
									<div class="single-testimonials">
										<div class="text">
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
										</div>
										
										<div class="profile-image">
											<img src="{{asset('assets/template2/img/client.jpg')}}" alt="Author Image" />
											<h4>John Doe</h4>
											<p>Marketing Manager</p>
										</div>
										
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="single-testimonials">
										<div class="text">
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
										</div>
										
										<div class="profile-image">
											<img src="{{asset('assets/template2/img/client.jpg')}}" alt="Author Image" />
											<h4>John Doe</h4>
											<p>Marketing Manager</p>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						
						<!-- Next Slide -->
						<div class="item">
							<div class="row">
								<div class="col-sm-6">
									<div class="single-testimonials">
										<div class="text">
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
										</div>
										
										<div class="profile-image">
											<img src="{{asset('assets/template2/img/client.jpg')}}" alt="Author Image" />
											<h4>Jason Cheng</h4>
											<p>Marketing Manager</p>
										</div>
										
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="single-testimonials">
										<div class="text">
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
										</div>
										
										<div class="profile-image">
											<img src="{{asset('assets/template2/img/client.jpg')}}" alt="Author Image" />
											<h4>Kim Cheng</h4>
											<p>Marketing Manager</p>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						<!-- Next Slide -->
						
					</div>
				 
				</div>
				
			</div>
		</section>
		
		<!-- Testimonials -->
		
		<!-- Contact -->
		<section id="contact-us">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="title">
							<h3>Contactar</h3>
						</div>
					</div>
				</div>
			</div>
		
			<div class="map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14608.272959726353!2d90.38896245!3d23.744945849999997!3m2!1i1024!2i768!4f13.1!4m3!3e1!4m0!4m0!5e0!3m2!1sen!2sbd!4v1465238371126" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		
			<div class="contact">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<h4>Entre em contato conosco para qualquer tipo de informação</strong></h4>
							<form id="contactform" action="" method="post" class="validateform" name="send-contact">
								<div class="row">
									<div class="col-lg-4 field">
										<input type="text" name="name" placeholder="* Seu Nome" data-rule="maxlen:4" data-msg="Please enter at least 4 chars" />
										<div class="validation">
										</div>
									</div>
									<div class="col-lg-4 field">
										<input type="text" name="email" placeholder="* Seu Email" data-rule="email" data-msg="Please enter a valid email" />
										<div class="validation">
										</div>
									</div>
									<div class="col-lg-4 field">
										<input type="text" name="subject" placeholder="Assunto" data-rule="maxlen:4" data-msg="Please enter at least 4 chars" />
										<div class="validation">
										</div>
									</div>
									<div class="col-lg-12 margintop10 field">
										<textarea rows="12" name="message" class="input-block-level" placeholder="* Sua mensagem aqui..." data-rule="required" data-msg="Please write something"></textarea>
										<div class="validation">
										</div>
										<p>
											<button class="btn btn-theme margintop10 pull-left" type="submit">Enviar mensagem</button>
											
										</p>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>		
		<!-- Contact -->
		
		
		<!-- footer -->
		
		<footer>
			<div class="container">
				<div class="row">
				
					<!-- Single Footer -->
					<div class="col-sm-3">
						<div class="single-footer">
							<div class="footer-logo">
								<img src="{{asset('assets/template2/img/footer-logo.png')}}" alt="Footer Logo" />
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut .</p>
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
							geral@okussoleka.com <br />
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
									<input type="email" class="form-control my-form" id="exampleInputEmail1" placeholder="Insira o seu endereço de email">
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
								<li><img src="{{asset('assets/template2/img/project.png')}}" alt="Reccent Project" /></li>
								<li><img src="{{asset('assets/template2/img/project.png')}}" alt="Reccent Project" /></li>
								<li><img src="{{asset('assets/template2/img/project.png')}}" alt="Reccent Project" /></li>
								<li><img src="{{asset('assets/template2/img/project.png')}}" alt="Reccent Project" /></li>
								<li><img src="{{asset('assets/template2/img/project.png')}}" alt="Reccent Project" /></li>
								<li><img src="{{asset('assets/template2/img/project.png')}}" alt="Reccent Project" /></li>
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
								<p>Todos os direitos reservados | Copyright {{date('Y')}} © O template Bizium por pFind's Goodies</p>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="footer-menu pull-right">
								<ul>
									<li><a href="#">Home</a></li>
									<li><a href="#">Sobre</a></li>
                                    <li><a href="#">Contactar</a></li>
                                    <li><a href="#">Consultar</a></li>
                                <li><a href="{{route('login')}}">Entrar</a></li>
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
		
		<!-- footer -->
		
		
		

        <script src="https://code.jquery.com/jquery-1.12.0.min.js')}}"></script>
        <script>window.jQuery || document.write('<script src="{{asset('assets/template2/js/vendor/jquery-1.12.0.min.js')}}"><\/script>')</script>
        <script src="{{asset('assets/template2/js/plugins.js')}}"></script>
        <script src="{{asset('assets/template2/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/template2/js/jquery.mousewheel-3.0.6.pack.js')}}"></script>
        <script src="{{asset('assets/template2/js/paralax.js')}}"></script>
        <script src="{{asset('assets/template2/js/jquery.smooth-scroll.js')}}"></script>
        <script src="{{asset('assets/template2/js/jquery.sticky.js')}}"></script>
        <script src="{{asset('assets/template2/js/wow.min.js')}}"></script>
        <script src="{{asset('assets/template2/js/main.js')}}"></script>
        
		
		<script type="text/javascript">
			$(document).ready(function(){
				$('a[href^="#"]').on('click',function (e) {
					e.preventDefault();

					var target = this.hash;
					var $target = $(target);

					$('html, body').stop().animate({
						 'scrollTop': $target.offset().top
					}, 900, 'swing');
					});
			});
		</script>
		
		<script src="{{asset('assets/template2/js/custom.js')}}"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js')}}';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>

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
</html>
