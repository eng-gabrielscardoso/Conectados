<?php

/** 
 *  Efetuar cadastro do Pessoa Fisica
 *  @Author Wagner Alcantara / Fabio Silva
 *  @Version 0.0.1
 */
require_once './connection.php';
// criptogra a senha vinda do formulário
$newPassword = sha1($passwordVoluntaryPf);

try {

  // Recupera as informações vinda dos inputs

  $firstNameVoluntaryPf = (string)filter_input(INPUT_POST, 'firstNameVoluntaryPf', FILTER_DEFAULT);
  $lastNameVoluntaryPf = (string)filter_input(INPUT_POST, 'lastNameVoluntaryPf', FILTER_DEFAULT);
  $cpfVoluntary = (string)filter_input(INPUT_POST, 'cpfVoluntary', FILTER_DEFAULT);
  $emailVoluntaryPf = (string)filter_input(INPUT_POST, 'emailVoluntaryPf', FILTER_DEFAULT);
  $passwordVoluntaryPf = (string)filter_input(INPUT_POST, 'passwordVoluntaryPf', FILTER_DEFAULT);
  $addressVoluntaryPf = (string)filter_input(INPUT_POST, 'addressVoluntaryPf', FILTER_DEFAULT);
  $numberAddressVoluntaryPf = (string)filter_input(INPUT_POST, 'numberAddressVoluntaryPf', FILTER_DEFAULT);
  $complementAddressVoluntaryPf = (string)filter_input(INPUT_POST, 'complementAddressVoluntaryPf', FILTER_DEFAULT);
  $districtPf = (string)filter_input(INPUT_POST, 'districtPf', FILTER_DEFAULT);
  $cityPf = (string)filter_input(INPUT_POST, 'cityPf', FILTER_DEFAULT);
  $statePf = (string)filter_input(INPUT_POST, 'statePf', FILTER_DEFAULT);
  $helpPf = (string)filter_input(INPUT_POST, 'helpPf', FILTER_DEFAULT);

  // criptogra a senha vinda do formulário

  $newPassword = sha1($passwordBeneficiary);

  // recebe a conexão

  $connection = Connection::getConnection();

  // monta a string sql para inserir na tabela users do banco de dados
  $sql = "(`uid`,`email`,`password`,`isActive`,`isRoot`) 
  VALUES (UUID(), '$emailVoluntaryPf', '$newPassword', 1,0);";

  $query = $connection->prepare("INSERT INTO " . DB_NAME . ".Users" . $sql);
  if ($query->execute()) {


    // monta um select na tabela users para inserir nas demais tabelas

    $query = $connection->query("SELECT uid FROM " . DB_NAME . ".Users WHERE email ='$emailVoluntaryPf'");

    $userResult = $query->fetchAll();
    $uidUser = $userResult[0]['uid'];

    // monta a string sql para inserir na tabela address  do banco de dados

    $sql = "(`uid`,`uidUser`,`street`,`number`,`district`,`city`,`state`,`complement`)
VALUES (UUID(),'$uidUser','$addressVoluntaryPf','$numberAddressVoluntaryPf','$districtPf','$cityPf','$statePf','$complementAddressVoluntaryPf');";

    $query = $connection->prepare("INSERT INTO " . DB_NAME . ".address" . $sql);

    if ($query->execute()) {

      $sql = "(`uid`, `uidUser`, `firstName`, `lastName`, `cpf`) 
      VALUES  (UUID(), '$uidUser', '$firstNameVoluntaryPf', '$lastNameVoluntaryPf', $cpfVoluntary);";
      //monta a sql para inserir tabela pessoa fisica
      $query = $connection->prepare("INSERT INTO " . DB_NAME . ".physicalPerson " . $sql);
      if ($query->execute()) {
        $sql = " (`uid`,`uidUser`,`help`)
        VALUES (UUID(),'$uidUser','$helpPf');";
        //monta a sql para inserir na tabela pessoa fisica
        $query = $connection->prepare("INSERT INTO " . DB_NAME . ".voluntary " . $sql);
        if ($query->execute()) {
          echo $error;
          header('Location: ../sign_up.html?register=true');
        }
      }
    }
  }
} catch (Exception $error) {
  header('Location: ../sign_up.html?register=false');
}
