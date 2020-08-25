<?php



/** 

 *  Efetuar cadastro do Beneficiario

 *  @Author Wagner Alcantara / Fabio Silva

 *  @Version 0.0.1

 */

require_once './connection.php';

try {



  // Recupera as informações vinda dos inputs

  $firstNameBeneficiary = (string)filter_input(INPUT_POST, 'firstNameBeneficiary', FILTER_DEFAULT);

  $lastNameBeneficiary = (string)filter_input(INPUT_POST, 'lastNameBeneficiary', FILTER_DEFAULT);

  $cpfBeneficiary = (string)filter_input(INPUT_POST, 'cpfBeneficiary', FILTER_DEFAULT);

  $emailBeneficiary = (string)filter_input(INPUT_POST, 'emailBeneficiary', FILTER_DEFAULT);

  $passwordBeneficiary = (string)filter_input(INPUT_POST, 'passwordBeneficiary', FILTER_DEFAULT);

  $addressBeneficiary = (string)filter_input(INPUT_POST, 'addressBeneficiary', FILTER_DEFAULT);

  $numberAddressBeneficiary = (string)filter_input(INPUT_POST, 'numberAddressBeneficiary', FILTER_DEFAULT);

  $complementAddressBeneficiary = (string)filter_input(INPUT_POST, 'complementAddressBeneficiary', FILTER_DEFAULT);

  $district = (string)filter_input(INPUT_POST, 'district', FILTER_DEFAULT);

  $city = (string)filter_input(INPUT_POST, 'city', FILTER_DEFAULT);

  $state = (string)filter_input(INPUT_POST, 'state', FILTER_DEFAULT);

  $renda = (string)filter_input(INPUT_POST, 'renda', FILTER_DEFAULT);

  $singleCard = (string)filter_input(INPUT_POST, 'singleCard', FILTER_DEFAULT);



  // Criptogra a senha vinda do formulário



  $newPassword = sha1($passwordBeneficiary);

  // Recebe a conexão

  $connection = Connection::getConnection();



  $query_select = "SELECT login FROM Users WHERE login = '$emailBeneficiary'";

  $query = $connection->prepare($query_select);
  $array = mysqli_fetch_array($query);
  $logarray = $array['login'];


  //TESSTE
  if ($emailBeneficiary == "" || $emailBeneficiary == null) {
    echo "<script language='javascript' type='text/javascript'>
    alert('O campo login deve ser preenchido');window.location.href='../sign_up.html?register=false';</script>";
  } else {
    if ($logarray == $emailBeneficiary) {

      echo "<script language='javascript' type='text/javascript'>
        alert('Esse login já existe');window.location.href='
        ../sign_up.html?register=false';</script>";
      die();
    } else {
      // monta a string sql para inserir na tabela users do banco de dados

      $sql = "(`uid`,`email`,`password`,`isActive`,`isRoot`) 

  VALUES (UUID(), '$emailBeneficiary', '$newPassword', 1,0);";

      $query = $connection->prepare("INSERT INTO " . DB_NAME . ".Users" . $sql);

      if ($query->execute()) {

        // monta um select na tabela users para inserir nas demais tabelas

        $query = $connection->query("SELECT uid FROM " . DB_NAME . ".Users WHERE email ='$emailBeneficiary'");

        $userResult = $query->fetchAll();

        $uidUser = $userResult[0]['uid'];

        // monta a string sql para inserir na tabela address  do banco de dados

        $sql = "(`uid`,`uidUser`,`street`,`number`,`district`,`city`,`state`,`complement`)

VALUES (UUID(),'$uidUser','$addressBeneficiary','$numberAddressBeneficiary','$district','$city','$state','$complementAddressBeneficiary');";

        $query = $connection->prepare("INSERT INTO " . DB_NAME . ".address" . $sql);

        if ($query->execute()) {

          $sql = "(`uid`, `uidUser`, `firstName`, `lastName`, `cpf`) 

      VALUES  (UUID(), '$uidUser', '$firstNameBeneficiary', '$lastNameBeneficiary', $cpfBeneficiary);";

          //monta a sql para inserir tabela pessoa fisica

          $query = $connection->prepare("INSERT INTO " . DB_NAME . ".physicalPerson " . $sql);

          if ($query->execute()) {

            $sql = " (`uid`,`uidUser`,`cardUnico`,`renda`)

        VALUES (UUID(),'$uidUser','$singleCard','$renda');";

            //monta a sql para inserir na tabela beneficiario

            $query = $connection->prepare("INSERT INTO " . DB_NAME . ".beneficiary " . $sql);

            $insert = $query->execute();            
          }
        }
      }

      if ($insert) {
        echo "<script language='javascript' type='text/javascript'>
          alert('Usuário cadastrado com sucesso!');window.location.
          href='../sign_in.html?register=true'</script>";
      } else {
        echo "<script language='javascript' type='text/javascript'>
          alert('Não foi possível cadastrar esse usuário');window.location
          .href='../sign_up.html?register=false'</script>";
      }
    }
  }

  //TESTE

} catch (Exception $error) {

  echo $error;

  header('Location: ../sign_up.html?register=erro');
}
