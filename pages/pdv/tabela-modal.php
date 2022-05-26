<?php

use App\Entidy\Movimentacao;

require __DIR__ . '../../../vendor/autoload.php';

$dados = "";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$dados .= '';

                $retorna = ['erro' => false, 'dados' => $dados];

                echo json_encode($retorna);



?>

