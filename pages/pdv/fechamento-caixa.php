<?php

use App\Entidy\Caixa;
use App\Entidy\Fechamento;

require __DIR__ . '../../../vendor/autoload.php';

$id=0;
$dados = "";
$total = 0;
$geral = 0;
$data = date('y-m-d');

$param = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$value = Fechamento ::getFecharID('fc.id as id, sum(fc.valor) as total ','fechamento as fc',$param,null,null);

$id = $value->id;
$total = $value->total;

$result = Caixa :: getID('*','caixa',$param,null,null);

$id_caixa = $result->id;
$valor_caixa = $result->valor;

$geral = $total + $valor_caixa;

$dados .= '

            <div class="small-box bg-teal">
            <input class="form-control" type="hidden" name="id" value="'.$id_caixa.'">
              <div class="inner">
                <h1>R$ '.number_format($geral,"2",",",".").'</h1>

                <p>DESEJA REALMENTE FECHAR ESTE CAIXA</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">'. date('d/m/Y', strtotime($data)) .' <i class="fas fa-arrow-circle-right"></i></a>
            </div>


            ';

                $retorna = ['erro' => false, 'dados' => $dados];

                echo json_encode($retorna);
