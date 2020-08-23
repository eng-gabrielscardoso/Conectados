<?php

/** 
 *  Efetuar cadastro do Beneficiario
 *  @Author Wagner Alcantara / Fabio Silva
 *  @Version 0.0.1
 */
require_once './connection.php';
try {

    // Recupera as informações vinda dos inputs
    $emailLoginBeneficiary = (string)filter_input(INPUT_POST, 'emailLoginBeneficiary', FILTER_DEFAULT);
    $passwordLoginBeneficiary = (string)filter_input(INPUT_POST, 'passwordLoginBeneficiary', FILTER_DEFAULT);

    $password = sha1($passwordLoginBeneficiary);

    // recebe a conexão

    $connection = Connection::getConnection();

    // monta a string sql para inserir na tabela users do banco de dados
    // $sql = "(`uid`,`email`,`password`,`isActive`,`isRoot`)";
    //VALUES (UUID(), '$emailBeneficiary', '$newPassword', 1,0);";

    $query = $connection->prepare("select * from " . DB_NAME . ".Users" . " where email='$emailLoginBeneficiary' AND password = '$password'");

    $query->execute();
    //print(`login` . $emailLoginBeneficiary);
    //print(`Senha` . $passwordLoginBeneficiary);

    
    if(mysqli_num_rows($check) <=0) {

        header('Location: ../sign_up.html?register=true');
    }



} catch (Exception $error) {
    echo $error;
    header('Location: ../sign_up.html?register=false');
}
