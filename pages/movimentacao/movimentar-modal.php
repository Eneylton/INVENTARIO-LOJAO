
<?php

use App\Entidy\Catdespesa;
use App\Entidy\FormaPagamento;
use App\Entidy\Movimentacao;
use App\Entidy\Status;
use App\Entidy\Tipo;

require __DIR__ . '../../../vendor/autoload.php';

$dados = "";
$res = "";
$res1 = "";
$res2 = "";
$res3 = "";
$selected = "";
$selected1 = "";
$selected2 = "";
$selected3 = "";
$checked = "";
$id_cat = "";
$id_tipo = "";
$id_pag = "";
$id_caixa = "";
$id_status = "";
$data = "";
$valor= "";
$val1= "";
$preco= "";
$descricao= "";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$value = Movimentacao::getID('*', 'movimentacoes', $id, null, null);

$id_cat        = $value->catdespesas_id;
$id_caixa      = $value->caixa_id;
$id_pag        = $value->forma_pagamento_id;
$id_status     = $value->status;
$id_tipo       = $value->tipo;
$data          = $value->data;
$valor         = $value->valor;
$val1          = $valor;
$preco         = str_replace(".", ",",  $val1);


$descricao     = $value->descricao;

$categorias = Catdespesa::getList('*', 'catdespesas', null, 'nome ASC', null);

foreach ($categorias as $item) {
   if ($item->id == $id_cat) {

      $selected = "selected";
   } else {
      $selected = "";
   }

   $res .= '<option value="' . $item->id . '"  ' . $selected . '>' . $item->nome . '</option>';
}

$pagamentos = FormaPagamento::getList('*', 'forma_pagamento', null, 'nome ASC', null);

foreach ($pagamentos as $item) {
   if ($item->id == $id_cat) {

      $selected1 = "selected";
   } else {
      $selected1 = "";
   }

   $res1 .= '<option value="' . $item->id . '"  ' . $selected . '>' . $item->nome . '</option>';
}

$status = Status::getList('*', 'status', null, 'nome ASC', null);

foreach ($status as $item) {
   if ($item->id == $id_status) {

      $selected2 = "checked";
   } else {
      $selected2 = "";
   }

   $res2 .= '&nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="' . $item->id . '" ' . $selected2 . '> ' . $item->nome . '';
}


$tipos = Tipo::getList('*', 'tipo', null, 'nome ASC', null);

foreach ($tipos as $item) {
   if ($item->id == $id_tipo) {

      $selected3 = "checked";
   } else {
      $selected3 = "";
   }

   $res3 .= '&nbsp;&nbsp;&nbsp;<input class="" type="radio" name="tipo" value="' . $item->id . '" ' . $selected3 . '> ' . $item->nome . '';
}




$dados .= '<div class="row">
                     <input class="form-control" type="hidden" name="id" value="' . $id . '">

                     <div class="col-12">
                          <div class="form-group">
                              <label>Categorias</label>
                              <select class="form-control select2bs4" style="width: 100%;" name="catdespesas_id" required>

                                 ' . $res . '                          

                               </select>
                           </div>
                     </div>

                     <div class="col-12">
                           <div class="form-group">
                              <label>Forma de pagamento</label>
                                 <select class="form-control select2bs4" style="width: 100%;" name="forma_pagamento_id" required>

                                 ' . $res1 . '

                               </select>
                           </div>
                     </div>

                     <div class="col-6">

                     <div class="form-group">

                     <label>Previão de pagamento:</label>

                     <div class="input-group">
                     <div class="input-group-prepend">
                     <span class="input-group-text"><i class="far fa-clock"></i></span>
                     </div>
                     <input value="' . $data . '" type="date" class="form-control" name="data" disabled>
                     </div>

                     </div>

                     </div>
                     
                     <div class="col-6">

                     <div class="form-group">

                     <label>Status</label>
                     <div>
                     <div class="form-check form-check-inline">
                     <label class="form-control">
                     ' . $res2 . '
                     </label>
                     </div>


                     </div>
                     </div>

                     </div>

                     <div class="col-6">

                     <div class="form-group">

                     <label>Tipo</label>
                     <div>
                     <div class="form-check form-check-inline">
                     <label class="form-control">
                     ' . $res3 . '
                     </label>
                     </div>

                     </div>
                     </div>

                     </div>

                     <div class="col-lg-6 col-6">
                     <div class="form-group">
                     <label>Observação</label>
                     <textarea class="form-control" aria-label="With textarea" name="descricao" >'.$descricao.'</textarea>
                     </div>
                     </div>

                     <div class="col-lg-6 col-6">
                     <div class="form-group">
                     <label>Valor</label>
                     <input placeholder="R$" type="text" class="form-control mov-edi" value="'.$preco.'" name="valor" id="dinheiro" required>
                     </div>
                     </div>

                    
            </div>';

$retorna = ['erro' => false, 'dados' => $dados];

echo json_encode($retorna);



?>
