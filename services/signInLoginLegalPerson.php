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

$emailLoginVoluntaryPj = (string)filter_input(INPUT_POST, 'emailLoginVoluntaryPj', FILTER_DEFAULT);
$passwordLoginVoluntaryPj = (string)filter_input(INPUT_POST, 'passwordLoginVoluntaryPj', FILTER_DEFAULT);
$password = sha1($passwordLoginVoluntaryPj);
$sql = "select * from Users where email = '$emailLoginVoluntaryPj' AND password = '$password'";

try {
    $connection = Connection::getConnection();
    
    //$query = $connection->prepare("select * from" . DB_NAME . ".Users where email = '$emailLoginVoluntaryPj' AND password = '$password'");
    $query = $connection->prepare("SELECT U.email, U.password, L.fantasyName FROM" . DB_NAME . ".Users as U," . DB_NAME . ".legalPerson as L WHERE U.uid = L.uidUser and U.email = '$emailLoginVoluntaryPj' AND U.password = '$password'");
    $query->execute();
    $result = $query->fetch();
    $email = $result['email'];
    $password = $result['password'];
    $user = $result['fantasyName'];

    if ($email != null || $email != "") {
        if ($email = $emailLoginVoluntaryPj && $password = $passwordLoginVoluntaryPj) {
            //setcookie("login", $login);
            $_SESSION['login'] = $emailLoginVoluntaryPj;

            header("Location:../dash_company.php?user=".$user);         
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

