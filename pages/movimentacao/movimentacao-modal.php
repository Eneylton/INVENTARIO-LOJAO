
<?php

use App\Entidy\Catdespesa;
use App\Entidy\FormaPagamento;
use App\Entidy\Movimentacao;

require __DIR__ . '../../../vendor/autoload.php';

$dados = "";
$id =0;
$id_cat = 0;
$tipo = 0;
$categoria = "";
$select1 = "";
$data = date("d/m/Y H:i:s");
$caixa_id = 0;

$param = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$value = Movimentacao::getID('*','movimentacoes',$param ,null,null);

$id_cat = $value->catdespesas_id;
$caixa_id = $value->caixa_id;
$tipo = $value->tipo;

$valor  = $value->valor;

$val1              = $valor;
$preco             = str_replace(".", ",",  $val1);

$res = Catdespesa ::getID('*','catdespesas',$id_cat,null,null);

$categoria = $res->nome;

$pagamentos = FormaPagamento ::getList('*','forma_pagamento');

foreach ($pagamentos as $item) {

   $select1 .= '<option value="' . $item->id .'" >' . $item->nome . '</option>';
}


$dados .= '<div class="row">
               <input class="form-control" type="hidden" name="id" value="'.$param.'">
               <input class="form-control" type="hidden" name="caixa_id" value="'.$caixa_id.'">
               <input class="form-control" type="hidden" name="tipo" value="'.$tipo.'">

                  <div class="col-12">
                  
                  <i style="margin-top:10px; color:#ff0000" class="fa fa-circle"></i>  <span style="font-size: 23px;">&nbsp;&nbsp;'.$data.'</span>

                  </div>
                  <div class="col-8">

                  <div class="form-group">
                  <label>DESCRIÇÃO</label>
                  <input  type="text" class="pg form-control" name="categoria" value="'.$categoria.'" required disabled>
                  </div>
                 </div>

                 <div class="col-4">

                 <div class="form-group">
                 <label>V. A PAGAR</label>
                 <input  type="text" class="pg form-control pg" id="dinheiro" name="valor" value="'.$preco.'" required >
                  </div>
                </div>

                <div class="col-8">
                <label>FORMA DE PAGAMENTO</label>
                <select class="form-control select" style="width: 100%;" name="pagamento_id">
                           
                '.$select1.'

                 </select>

               </div>

               <div class="col-4">

                 
               <label>V. A RECEBER</label>
               <input type="text" class="pg form-control pgr" id="dinheiro3" name="receber" value="" placeholder="R$" required>

              </div>

           </div>';

$retorna = ['erro' => false, 'dados' => $dados];

echo json_encode($retorna);



?>
