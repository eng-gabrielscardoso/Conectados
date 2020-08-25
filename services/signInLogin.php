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

try {
    $connection = Connection::getConnection();
    $result = mysqli_query($connection, "select * from" . DB_NAME . ".Users WHERE email = '$emailLoginBeneficiary' AND password = '$password'");
    //$result = $connection->query("select * from" . DB_NAME . ".Users WHERE email = '$emailLoginBeneficiary' AND password = '$password'");
        
    if (mysqli_num_rows($result) <= 0) {
        echo "<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location.href='../sign_in.html';</script>";
        die();
        
    } else {
        setcookie("login", $login);
        header("Location:index.php"); 
    }
} catch (Exception $error) {
    print($error);
}

