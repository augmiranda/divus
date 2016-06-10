<?php

// require "Pai.php";
// require "Filho.php";
// require "Filha.php";


function __autoload($class) {
	require "$class.php";

	//echo "Incluiu $class <br>";
}

// Filho::falar();


$filho = new Filho();
$filho->problemaPressao();
$filho->corDosOlhos();
//$filho->testando(123, 456);

echo $filho->profissao . "<br>";

$filho->profissao = "Gamer";

echo $filho->profissao . "<br>";

$filho->contarSegredo();



// $filha = new Filha();
// $filha->problemaPressao();
// $filha->corDosOlhos();