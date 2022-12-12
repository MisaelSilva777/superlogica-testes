<?php

//1) Crie um array

$array = [];

//2) Popule este array com 7 números. *resolvi colocar números aleatórios

for ( $i = 0; $i < 7; $i++) {
	$array[] = rand (0, 20);
}

var_dump($array);

//3) Imprima o número da posição 3 do array

echo "Número da posição 3 do array: $array[3] \n";

//4) Crie uma variável com todas as posições do array no formato de string separado por vírgula

$array_imploded = implode(', ', $array);

//5) Crie um novo array a partir da variável no formato de string que foi criada e destrua o array anterior

$new_array = explode(', ', $array_imploded);
//unset($array); pelo enunciado era para excluir aqui, mas o item 7 ainda precisa do array antigo

//6) Crie uma condição para verificar se existe o valor 14 no array

if ( in_array( 14, $new_array ) ) echo "existe valor 14 no array \n";

//7) Faça uma busca em cada posição. Se o número da posição atual for menor que o
//da posição anterior (valor anterior que não foi excluído do array ainda), exclua esta

foreach( $new_array as $index => $value ) {
	
	if ( $value >= $array[$index] ) continue;
	unset( $new_array[$index] );
	
}

unset($array);

//8) Remova a última posição deste array

if ( ! empty ( $new_array[-1] ) ) {
	unset( $new_array[-1]  );
}

//9) Conte quantos elementos tem neste array

echo count($new_array) . "\n";

//10) Inverta as posições deste array *foi solicitado para inverter as posições ( indices )
//não foi citado nada sobre inverter os valores ou não.

$new_array = array_reverse( $new_array );

var_dump( $new_array );


