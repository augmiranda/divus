<?php

$carros = [
	['marca' => 'fiat', 'modelo' => 'palio', 'valor' => 22000],
	['marca' => 'chevrolet', 'modelo' => 'celta', 'valor' => 20000],
	['marca' => 'honda', 'modelo' => 'fit', 'valor' => 40000],
	['marca' => 'volks', 'modelo' => 'gol', 'valor' => 23500],
];


foreach($carros as $carro):
?>

<b>Marca:</b> <?= strtoupper($carro['marca']) ?> <br>
<b>Modelo:</b> <?= $carro['modelo'] ?> <br>
<b>Valor:</b> <?= $carro['valor'] ?> <br><br>

<?php
endforeach;
?>