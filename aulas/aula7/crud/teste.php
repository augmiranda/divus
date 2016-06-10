<?php


if($_POST){

	$nome = (string)$_POST['nome'];
	$idade = (int)$_POST['idade'];
	$habilitado = isset($_POST['habilitado']) ? true : false;

	// if(isset($_POST['habilitado'])){
	// 	$habilitado = true;
	// }else{
	// 	$habilitado = false;
	// }

	if(empty($nome)){
		echo "Nome esta vazio! <br>";
	}

	$words = explode(" ", $nome);

	if(count($words) < 2){
		echo "E necessario digitar um nome e sobrenome! <br>";
	}

}


?>