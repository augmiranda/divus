<?php

session_start();

require "conexao.php";

if($_GET){

  $codigo = $_GET['codigo'];

  $sql = "DELETE FROM usuario WHERE codigo = :codigo";
  $sth = $dbh->prepare($sql);
  $sth->bindParam(':codigo', $codigo);
  $success = $sth->execute();

  if($success)
  {
    $alerts[] = ['type' => 'success' , 'message' => "Usuário deletado com sucesso!"];
  }else{
    $alerts[] = ['type' => 'danger' , 'message' => "Não foi possivel deletar o usuario!"];
  }

  $_SESSION['alerts'] = $alerts;

  header('Location: usuario_listar.php');
}

