<?php

/** 
 *  Efetuar cadastro do Pessoal Juridica
 *  @Author Wagner Alcantara / Fabio Silva
 *  @Version 0.0.1
 */
require_once './connection.php';
try {
  $companyName = (string)filter_input(INPUT_POST, 'companyName', FILTER_DEFAULT);
  $fantasyName = (string)filter_input(INPUT_POST, 'fantasyName', FILTER_DEFAULT);
  $cnpjVoluntary = (string)filter_input(INPUT_POST, 'cnpjVoluntary', FILTER_DEFAULT);
  $emailVoluntaryPj = (string)filter_input(INPUT_POST, 'emailVoluntaryPj', FILTER_DEFAULT);
  $passwordVoluntaryPj = (string)filter_input(INPUT_POST, 'passwordVoluntaryPj', FILTER_DEFAULT);
  $addressVoluntaryPj = (string)filter_input(INPUT_POST, 'addressVoluntaryPj', FILTER_DEFAULT);
  $numberAddressVoluntaryPj = (string)filter_input(INPUT_POST, 'numberAddressVoluntaryPj', FILTER_DEFAULT);
  $complementAddressVoluntaryPj = (string)filter_input(INPUT_POST, 'complementAddressVoluntaryPj', FILTER_DEFAULT);
  $districtPj = (string)filter_input(INPUT_POST, 'districtPj', FILTER_DEFAULT);
  $cityPj = (string)filter_input(INPUT_POST, 'cityPj', FILTER_DEFAULT);
  $statePj = (string)filter_input(INPUT_POST, 'statePj', FILTER_DEFAULT);
  $helpPj = (string)filter_input(INPUT_POST, 'helpPj', FILTER_DEFAULT);

  // criptogra a senha vinda do formulário

  $newPassword = sha1($passwordVoluntaryPj);

  // recebe a conexão

  $connection = Connection::getConnection();

  // monta a string sql para inserir na tabela users do banco de dados
  $sql = "(`uid`,`email`,`password`,`isActive`,`isRoot`) 
  VALUES (UUID(), '$emailVoluntaryPj', '$newPassword', 1,0);";

  $query = $connection->prepare("INSERT INTO " . DB_NAME . ".Users " . $sql);
  if ($query->execute()) {

    // monta um select na tabela users para inserir nas demais tabelas

    $query = $connection->query("SELECT uid FROM " . DB_NAME . ".Users WHERE email ='$emailVoluntaryPj'");

    $userResult = $query->fetchAll();
    $uidUser = $userResult[0]['uid'];

    // monta a string sql para inserir na tabela address  do banco de dados

    $sql = "(`uid`,`uidUser`,`street`,`number`,`district`,`city`,`state`,`complement`)
VALUES (UUID(),'$uidUser','$addressVoluntaryPj','$numberAddressVoluntaryPj','$districtPj','$cityPj','$statePj','$complementAddressVoluntaryPj');";

    $query = $connection->prepare("INSERT INTO " . DB_NAME . ".address" . $sql);

    if ($query->execute()) {


      $sql = "(`uid`,
`uidUser`,
`socialReason`,
`fantasyName`,
`cnpj`)
VALUES
(UUID(),
'$uidUser',
'$companyName',
'$fantasyName',
'$cnpjVoluntary');";
      //monta a sql para inserir tabela pessoa juridica
      $query = $connection->prepare("INSERT INTO " . DB_NAME . ".legalPerson" . $sql);
      if ($query->execute()) {
        $sql = " (`uid`,`uidUser`,`help`)
        VALUES (UUID(),'$uidUser','$helpPj');";
        //monta a sql para inserir na tabela voluntary
        $query = $connection->prepare("INSERT INTO " . DB_NAME . ".voluntary" . $sql);
        if ($query->execute()) {

          header('Location: ../sign_up.html?register=true');
        }
      }
    }
  }
} catch (Exception $error) {
  header('Location: ../sign_up.html?register=false');
  //print($error);
}
