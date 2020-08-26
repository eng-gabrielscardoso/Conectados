<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <?php
  session_start();
  if (!isset($_SESSION['login']) == true) {
    unset($_SESSION['login']);
    header('Location: ./sign_in.html');
  }

  $logado = $_SESSION['login'];
  ?>

  <!-- device meta tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- seo meta tags -->
  <meta name="author" content="Gabriel Santos Cardoso - Equipe Biblios">
  <meta name="description" content="Site desenvolvido com o intuito de agregar, distribuir, incentivar e publicar ações solidárias e iniciativas sociais a fim de compartilhar com pessoas em situação de vulnerabilidade socioeconômica da cidade de Barcarena e arredores meios de amparo e auxílio">
  <meta name="keywords" content="conectados,solidário,auxílio,Barcarena,social">
  <meta name="robots" content="index,follow">
  <meta name="theme-color" content="">
  <meta name="format-detection" content="telephone=no">
  <meta property="og:title" content="Conectados">
  <meta property="og:site_name" content="Conectados">
  <meta property="og:description" content="">
  <meta property="og:url" content="">
  <meta property="og:image" content="">
  <meta property="og:image:type" content="image/jpeg">
  <!-- links  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="./css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="./css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link rel='manifest' href='/manifest.json'>
  <link rel="shortcut icon" href="./img/conectados-icon.png" type="image/x-icon" />
  <!-- service workers -->

  <!-- title -->
  <title>Plataforma - Conectados</title>
</head>

<body>

  <!-- 
      FAVOR, IMPLEMENTAR O CODIGO PARA QUE QUANDO O USUÁRIO CLICAR EM 'SAIR' SUA CONTA SEJA AUTOMATICAMENTE DESLOGADA
   
    -->


  <nav class="green darken-3" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="./index.html" class="brand-logo">Conectados</a>
      <!-- desktop-menu -->
      <ul class="right hide-on-med-and-down">
        <li><a href="./index.html">Início</a></li>
        <li><a href="./our_team.html">Nosso time</a></li>
        <li><a href="./our_mission.html">Nossa proposta</a></li>
        <li><a href="./sign_up.html">Cadastro</a></li>
        <li><a href="./sign_in.html">Plataforma</a></li>
        <li><a href="./services/logout.php">Sair</a></li>
      </ul>
      <!-- mobile-menu -->
      <ul id="nav-mobile" class="sidenav">
        <div class="container center logo-wraper"><img width="60" src="./img/conectados-icon.png"></div>
        <li><a class="green-text text-darken-1" href="./index.html">Início</a></li>
        <li><a class="green-text text-darken-1" href="./our_team.html">Nosso time</a></li>
        <li><a class="green-text text-darken-1" href="./our_mission.html">Nossa proposta</a></li>
        <li><a class="green-text text-darken-1" href="./sign_up.html">Cadastro</a></li>
        <li><a class="green-text text-darken-1" href="./sign_in.html">Plataforma</a></li>
        <li><a class="green-text text-darken-1" href="./services/logout.php">Sair</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div><!-- container -->
  </nav>

  <div class="section dash-welcome">
    <div class="container">
      <h5 class="center green-text text-darken-3">Seja muito bem-vindo à Plataforma Conectados, {Capturar e exibir o
        primeiro nome da pessoa}!</h5>
    </div>
  </div><!-- dash-welcome -->

  <div class="section dash-information-beneficiary">
    <div class="container">
      <!-- 
            COMO DISPOMOS DE POUCO TEMPO PARA O DESENVOLVIMENTO DE UM SISTEMA MELHOR ELABORADO, ESSA SECTION IRÁ CONTER AS AÇÕES DIVULGADAS PELOS VOLUNTÁRIOS. A FORMA COM O SERÃO DISPOSTAS SERÁ EM SEÇÕES RETANGULARES 3x3 (DESKTOP) E 1x1 (MOBILE).
            
            ESSAS SEÇÕES IRÃO CONTER UMA FOTO, NA PARTE SUPERIOR, UM TÍTULO E O NOME DO VOLUNTÁRIO QUE PROMOVERÁ A AÇÃO.
         -->
    </div>
  </div><!-- dash information beneficiary -->

  <footer class="page-footer green darken-3">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Conectados</h5>
          <p class="grey-text text-lighten-4 footer-text">
            Temos o intuito de agregar, distribuir, incentivar e publicar ações solidárias e iniciativas sociais a fim
            de compartilhar com pessoas em situação de vulnerabilidade socioeconômica da cidade de Barcarena e arredores
            meios de amparo e auxílio.
          </p>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Navegue pelo site</h5>
          <ul>
            <li><a class="white-text" href="./index.html">Início</a></li>
            <li><a class="white-text" href="./our_team.html">Nosso time</a></li>
            <li><a class="white-text" href="./our_mission.html">Nossa proposta</a></li>
            <li><a class="white-text" href="./sign_up.html">Cadastro</a></li>
            <li><a class="white-text" href="./sign_in.html">Plataforma</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Informações</h5>
          <ul>
            <i class="material-icons">email</i>
            <li class="white-text">equipebiblios@gmail.com</li>
            <i class="material-icons">phone</i>
            <li class="white-text">(91) 9 8516-0142</li>
            <i class="material-icons">place</i>
            <li class="white-text">Tv. da Matriz, prox. ao MPPA</li>
          </ul>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container footer-mobile">
          <p class="white-text s12 l6 left">&copy;Conectados v. 1.2.20</p>
          <p class="white-text s12 l6 right">Desenvolvido por G. S. Cardoso e Equipe Biblios</p>
        </div>
      </div><!-- footer-copyright -->
    </div> <!-- container -->
  </footer>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="./js/materialize.js"></script>
  <script src="./js/init.js"></script>

</body>

</html>