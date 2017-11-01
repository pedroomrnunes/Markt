<?php

if( !isset($_SESSION['id-user']) && empty($_SESSION['id-user'])){
  $_SESSION['error'] = "session"; 
	header("Location: pages/login.php");
}
?>



<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FindTour</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.agency.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="dist/css/agency.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger"    style="color: #337ab7;" href="#page-top">FindTour</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="pages/support">Ajuda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="pages/register-user.php">Registar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="pages/login.php">Iniciar Sessão</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <div class="intro-lead-in">Plataforma de Intermediação de Tours</div>
          <div class="intro-heading">It's Nice To Meet You</div>

  	<a class="btn btn-xl js-scroll-trigger" href="#services">Descubra </a>
        </div>
      </div>
    </header>

    <!-- Services -->
    <section id="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Como funciona?</h2>
      <!--      <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->

			</div>
			 <div class="col-lg-12 text-center">
		<div style="margin-top: 15px; margin-bottom: 38px;">	O FindTour é a plataforma que efectua a intermediação entre dois tipos de utilizadores : Prestador de Serviços e Angariador de Tours.</div>
        </div></div>
        <div class="row ">
          <div class="col-md-4 text-center">
			<span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-users fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Angariador de Tours</h4>
            <p class="text-muted text-left"> O Angariador de Tours  é quem faz o trabalho relações públicas e consegue publicar através desta plataforma o anúncio
			do seu contacto.
			</p>
          </div>
          <div class="col-md-4 text-center">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-building-o fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Prestador de Serviços</h4>
            <p class="text-muted text-left">O Prestador de Serviços é a empresa ou empregado que trabalha na aréa de negocio Animação Turística que procura Tours por necessidade de aumentar
			a sua faturação. Aumenta a sua faturação  mensal ao adquirir Tours <br> </p>
          </div>
          <div class="col-md-4 text-center">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">FindTours</h4>
                  <p class="text-muted text-left">  O FindTours oferece: <br>- Segurança na transmissão dos dados; <br> - Rapidez no Processo de procura e compra de tours.<br> - Verificação cuidada dos Tours inseridos <br> - Sistemas de pontos com descontos nas compras.<br> </p>
          </div>
        </div>
      </div>
    </section>


<!-- Contact -->
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Contact Us</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <form id="contactForm" name="sentMessage" novalidate>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="name" type="text" placeholder="Your Name *" required data-validation-required-message="Please enter your name.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" type="email" placeholder="Your Email *" required data-validation-required-message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required data-validation-required-message="Please enter your phone number.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Your Message *" required data-validation-required-message="Please enter a message."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
                  <button id="sendMessageButton" class="btn btn-xl" type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4 text-left">
            <span class="copyright"> &copy; FindTour 2017</span>
          </div>
          <div class="col-md-4">
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-linkedin"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="list-inline quicklinks">
              <li class="list-inline-item">
                <a href="#">Termos</a>
              </li>
			  <li class="list-inline-item">
                <a href="#">Privacidade</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Reembolsos</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <!-- Portfolio Modals -->











    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <script src="vendor/popper/popper.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.agency.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/agency.min.js"></script>

  </body>

</html>
