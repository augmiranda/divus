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

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form action="" method="POST">

	Nome: <input type="text" name="nome"/> <br><br>

	Idade: <input type="text" name="idade"/> <br><br>

	Habilitado: <input type="checkbox" name="habilitado"/> <br><br>

	<button type="submit">Enviar</button>

</form>

</body>
</html>