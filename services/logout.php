<?php
    session_start();   
    unset(
        $_SESSION['login']
    );   
    $_SESSION['logindeslogado'] = "Deslogado com sucesso";
    //redirecionar o usuario para a página de login
    header("Location: ../sign_in.html");
?>