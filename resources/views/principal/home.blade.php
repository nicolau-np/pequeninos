@extends('layouts.app_principal')
@section('content')
    <style>
        @media(max-width:700px) {
            .img_home {
                display: none;
            }
            .about-text{
                margin-top: -10px;
            }
        }

    </style>
    <!-- About Section -->
    <section id="about" class="site-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 img_home">
                    <div class="about-image wow fadeInLeft">
                        <img src="{{ asset('assets/template2/img/about-image.jpg') }}" alt="About Image" />
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="about-text wow fadeInRight">
                        <h3>SIGE OKUSSOLEKA</h3>
                        <p style="text-align: justify;">O Melhor Sistema de Gestão Escola, com Propinas, Notas e Estatística
                            Escolar. Aulas, pautas, estatísticas, provas em online e muito mais...
                            Cadastre urgentemente a sua escola, e seja um dos bem sucedidos no que tem haver ao
                            gerenciamento da sua escola.<br /> Basta entrar em contacto connosco </p>
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
                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                aria-valuemax="100" style="width: 60%;">
                                60%
                            </div>
                        </div>
                    </div>

                    <div class="progress-bar-custom wow fadeInLeft">
                        <h5>Pautas</h5>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                aria-valuemax="100" style="width: 90%;">
                                90%
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-sm-4">

                    <div class="progress-bar-custom wow fadeInLeft">
                        <h5>Aulas</h5>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                aria-valuemax="100" style="width: 80%;">
                                80%
                            </div>
                        </div>
                    </div>

                    <div class="progress-bar-custom wow fadeInLeft">
                        <h5>Finanças</h5>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                aria-valuemax="100" style="width: 70%;">
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
                        <h3>Nossos <span>Clientes</span></h3>
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
                                        <p>Complexo escolar das Irmãs do santíssimo salvador, ensino primário do 1º Cíclo e
                                            2º Cíclo.</p>
                                    </div>

                                    <div class="profile-image">
                                        <img src="{{ asset('assets/template/images/auth/Logo-small-bottom.png') }}"
                                            class="img-caroucel" alt="Author Image" />
                                        <h4>Colégio dos Pequeninos</h4>
                                        <p>Huambo-Angola</p>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="single-testimonials">
                                    <div class="text">
                                        <p>Liceu Welwitchia Mirábilis, ensino secundário do 2º Cíclo<br /> </p>
                                    </div>

                                    <div class="profile-image">
                                        <img src="{{ asset('assets/template/images/auth/Logo-small-bottom.png') }}"
                                            alt="Author Image" />
                                        <h4>Liceu Welwitchia Mirábilis</h4>
                                        <p>Moçamedes-Namibe</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Next Slide -->
                    <!--<div class="item">
           <div class="row">
            <div class="col-sm-6">
             <div class="single-testimonials">
              <div class="text">
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              </div>

              <div class="profile-image">
               <img src="{{ asset('assets/template2/img/client.jpg') }}" alt="Author Image" />
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
               <img src="{{ asset('assets/template2/img/client.jpg') }}" alt="Author Image" />
               <h4>Kim Cheng</h4>
               <p>Marketing Manager</p>
              </div>

             </div>
            </div>
           </div>
          </div>-->
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
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14608.272959726353!2d90.38896245!3d23.744945849999997!3m2!1i1024!2i768!4f13.1!4m3!3e1!4m0!4m0!5e0!3m2!1sen!2sbd!4v1465238371126"
                width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>

        <div class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h4>Entre em contato conosco para qualquer tipo de informação</strong></h4>
                        <form id="contactform" action="" method="post" class="validateform" name="send-contact">
                            <div class="row">
                                <div class="col-lg-4 field">
                                    <input type="text" name="name" placeholder="* Seu Nome" data-rule="maxlen:4"
                                        data-msg="Please enter at least 4 chars" />
                                    <div class="validation">
                                    </div>
                                </div>
                                <div class="col-lg-4 field">
                                    <input type="text" name="email" placeholder="* Seu Email" data-rule="email"
                                        data-msg="Please enter a valid email" />
                                    <div class="validation">
                                    </div>
                                </div>
                                <div class="col-lg-4 field">
                                    <input type="text" name="subject" placeholder="Assunto" data-rule="maxlen:4"
                                        data-msg="Please enter at least 4 chars" />
                                    <div class="validation">
                                    </div>
                                </div>
                                <div class="col-lg-12 margintop10 field">
                                    <textarea rows="12" name="message" class="input-block-level"
                                        placeholder="* Sua mensagem aqui..." data-rule="required"
                                        data-msg="Please write something"></textarea>
                                    <div class="validation">
                                    </div>
                                    <p>
                                        <button class="btn btn-theme margintop10 pull-left" type="submit">Enviar
                                            mensagem</button>

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
@endsection
