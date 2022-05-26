<?php

use App\Entidy\Caixa;
use App\Entidy\Fechamento;

require __DIR__ . '../../../vendor/autoload.php';

$id=0;
$id_caixa=0;
$dados = "";
$total = 0;
$geral = 0;
$valor_caixa = 0;
$positivo = 0;
$negativo = 0;
$data = date('y-m-d');

$param = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$result = Caixa::getID('*','caixa',$param,null,null);

$valor_caixa = $result->valor;

$value = Fechamento ::getList('*','fechamento','caixa_id='.$param);

foreach ($value as $key) {
  
   if($key->tipo == 1){

    $positivo = $key->valor;
    
  }else{
    
    $negativo = $key->valor;

   }

   $geral = $valor_caixa + $positivo - $negativo;

}

$dados .= '

            <div class="small-box bg-danger">
            <input class="form-control" type="hidden" name="id" value="'.$param .'">
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
