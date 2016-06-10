<?php


class Filho extends Pai{

	public $profissao = "Engenheiro";

	private $segredo = "Gosta de pokemon";

	public static function falar(){
		echo "iai tudo bem ? <br>";
	}

	public function contarSegredo(){
		echo $this->segredo . "<br>";
	}

	function __call($funcao, $args) {
		echo "Você tentou executar um método inválido.<br>";
		echo "Método: $funcao <br>";
		//print_r($args);
		echo implode('-', $args);
	}
}