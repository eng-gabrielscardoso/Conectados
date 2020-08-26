<?php
session_start();

/** 
 *  Efetuar cadastro do Beneficiario
 *  @Author Wagner Alcantara / Fabio Silva
 *  @Version 0.0.1
 */

use function PHPSTORM_META\expectedArguments;

require_once './connection.php';

// Recupera as informações vinda dos inputs

$emailLoginVoluntaryPf =(string)filter_input(INPUT_POST, 'emailLoginVoluntaryPf', FILTER_DEFAULT);

$passwordLoginVoluntaryPf = (string)filter_input(INPUT_POST, 'passwordLoginVoluntaryPf', FILTER_DEFAULT);
$password = sha1($passwordLoginVoluntaryPf);
$sql = "select * from Users where email = '$emailLoginVoluntaryPf' AND password = '$password'";

try {
    $connection = Connection::getConnection();
    
    $query = $connection->prepare("select * from" . DB_NAME . ".Users where email = '$emailLoginVoluntaryPf' AND password = '$password'");
    $query->execute();
    $result = $query->fetch();
    $email = $result['email'];
    $password = $result['password'];

    if ($email != null || $email != "") {
        if ($email = $emailLoginVoluntaryPf && $password = $passwordLoginVoluntaryPf) {
            $_SESSION['login'] = $emailLoginVoluntaryPf;
            //setcookie("login", $login);
            header("Location:../dash_voluntary.php");         
        } else {
            unset ($_SESSION['login']);
            echo "<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location.href='../sign_in.html';</script>";
            
            die();
        }
    } else {
        unset ($_SESSION['login']);
        echo "<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location.href='../sign_in.html';</script>";
        die();
    }
} catch (Exception $error) {
    print($error);
}

