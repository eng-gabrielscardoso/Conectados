<?php

/** 
 *  Efetuar cadastro do Beneficiario
 *  @Author Wagner Alcantara / Fabio Silva
 *  @Version 0.0.1
 */

use function PHPSTORM_META\expectedArguments;

require_once './connection.php';

// Recupera as informações vinda dos inputs

$emailLoginBeneficiary = (string)filter_input(INPUT_POST, 'emailLoginBeneficiary', FILTER_DEFAULT);

$passwordLoginBeneficiary = (string)filter_input(INPUT_POST, 'passwordLoginBeneficiary', FILTER_DEFAULT);
$password = sha1($passwordLoginBeneficiary);
$sql = "select * from Users where email = '$emailLoginBeneficiary' AND password = '$password'";

try {
    $connection = Connection::getConnection();

    $query = $connection->prepare("select * from" . DB_NAME . ".Users where email = '$emailLoginBeneficiary' AND password = '$password'");
    $query->execute();
    $result = $query->fetch();
    $email = $result['email'];
    $password = $result['password'];

    if ($email != null || $email != "") {
        if ($email = $emailLoginBeneficiary && $password = $passwordLoginBeneficiary) {
            setcookie("login", $login);
            header("Location:../dash_voluntary.html?register=");         
        } else {
            echo "<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location.href='../sign_in.html';</script>";
            die();
        }
    } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location.href='../sign_in.html';</script>";
        die();
    }
} catch (Exception $error) {
    print($error);
}
