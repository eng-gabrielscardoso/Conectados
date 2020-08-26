<?php
session_start();
$login = $_POST['login'];
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

    //$query = $connection->prepare("select u.email, u.password, p.firstname [physicalPerson] from" . DB_NAME . ".Users where email = '$emailLoginBeneficiary' AND password = '$password'");
    
    $query = $connection->prepare("SELECT U.email, U.password, P.firstname FROM" . DB_NAME . ".Users as U," . DB_NAME . ".physicalPerson as P WHERE U.uid = P.uidUser and U.email = '$emailLoginBeneficiary' AND U.password = '$password'");
    $query->execute();
    $result = $query->fetch();
    $email = $result['email'];
    $password = $result['password'];
    $user = $result['firstname'];

    if ($email != null || $email != "") {
        if ($email = $emailLoginBeneficiary && $password = $passwordLoginBeneficiary) {
            $_SESSION['login'] = $emailLoginBeneficiary;
                     
            //setcookie("login", $login);
            header("Location:../dash_beneficiary.php?user=".$user);
        } else {
            unset($_SESSION['login']);
            echo "<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location.href='../sign_in.html';</script>";
            die();
        }
    } else {
        unset($_SESSION['login']);
        echo "<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location.href='../sign_in.html';</script>";
        die();
    }
} catch (Exception $error) {
    print($error);
}
