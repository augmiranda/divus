<?php

class Pessoa {

	public $nome;
	public $idade;

	public function __construct($nome, $idade){
		$this->nome = $nome;
		$this->idade = $idade;
		//echo "Objeto $nome criado! <br>";
	}

	public function __destruct(){
		echo "Classe finalizada! <br>";
	}

	public function anda(){
		echo $this->nome . " de " . $this->idade .  " anos andou!<br>";
	}

	public function falou($mensagem, $nome){
		echo $this->nome . " falou " . $mensagem . " para $nome <br>";
	}

}

// Pessoa::anda();

// $objeto = new Pessoa();

// $objeto->nome = "Leleco";

// echo $objeto->nome . "<br>";

// $objeto->anda();

$objeto = new Pessoa("Chico", 15);
//$objeto->anda();

$objeto->falou("E isso ai!", "Rosinha");



$objeto->anda();