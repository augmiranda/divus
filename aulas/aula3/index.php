<?php


// Imprime: Arnold disse uma vez: "I'll be back"
// echo 'Arnold disse uma vez: "I\'ll be back"';

// $nome = "Arnold";
// $sobrenome = 'Xuazinega';
// echo "$nome $sobrenome <br>";
// echo $nome . " " . $sobrenome . '<br>' . "$nome $sobrenome <br>";

// echo "$nome disse uma vez: I\'ll be back";
// //echo $frase;

// $teste = 'sdfsdf';


$teste = array(1, 2, 3);

$teste = [1, 2, 3];

echo "<pre>";
print_r($teste); 
echo "</pre>";

$teste = "chave";

// $teste = [1=>1, 2=>'Jose', $teste=>3];

// echo $teste['chave'] . $teste[2];

// $teste = [1, 2, 3, 4, 5, 6, 7];

// for($i=0; $i < count($teste); $i++){

// 	echo "Valor: " . $teste[$i] . "<br>";
// }

// //foreach($teste as $value)
// foreach($teste as $k => $v){
// 	echo "$key : $value <br>";
// }


function printArray($value){
	echo "<pre>";
	print_r($value); 
	echo "</pre>";
}

// $carros = [
// 	['marca' => 'fiat', 'modelo' => 'palio', 'valor' => 22000],
// 	['marca' => 'chevrolet', 'modelo' => 'celta', 'valor' => 20000],
// 	['marca' => 'honda', 'modelo' => 'fit', 'valor' => 40000],
// 	['marca' => 'volks', 'modelo' => 'gol', 'valor' => 23500],
// ];

// $total = 0;

// foreach($carros as $carro){

// 	$total = $total + $carro['valor'];
// 	printArray($carro);
// 	//$total += $carro['valor'];($carro);
// 	//echo $carro['marca'] . ' ' . $carro['modelo'] . '<br>';

// }

// echo "O total e $total <br>";

// $teste = [1,2,3];

// foreach($teste as $value){
// 	echo "$value <br>";
// }



// $teste = '10; drop table carro;';

// $teste2 = (int)$teste;


// $sql = "select * from carro where id = $teste2";


// $total += 10;

// $total = $total + 10;

// $output = `dir /p`;
// echo $output;

// if($teste == true && || $teste == false)


$valor1 = 2;
$valor2 = 3;

if($valor1 > $valor2){
	echo "Valor1 e maior";
}else if($valor2 == $valor1){
	echo "Valor2 e maior";
}else{
	echo "Valor1 e menor";
}

// sintaxe alternativa
if($valor1 > $valor2):
	echo "Valor 1 e maior";
endif;