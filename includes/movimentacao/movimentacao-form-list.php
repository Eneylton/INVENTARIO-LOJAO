<?php

if (isset($_GET['id'])) {

   $idcaixa = $_GET['id'];
}

$despesa  = 0;
$receita  = 0;
$valor1  = 0;
$total = 0;
$resultados = '';
$list = '';
$status1 = '';
$total = 0;
$total_dinheiro = 0;
$subtracao = 0;
$calculo = 0;

$texto = "";
$cor = "";
$cores = "";
$cores2 = "";


$id = '';

$list = '';

$resultados = '';

$resultados = '';

foreach ($listar as $item) {

   $total = $item->valor;

   if ($item->tipo == 0) {
      $cor = "#ff0000";
      $texto = 'Despesa';

      $despesa += $item->valor;
   } else {
      $receita += $item->valor;
      $texto = 'Receita';
      $cor = "$00ff00";
   }


   $total = ($receita - $despesa);

   if ($total <= 0) {

      $cores = "#ff0000";
   } else {
      $cores = "#fff200";
   }

   if ($total <= 0) {

      $cores2 = "#ff0000";
   } else {
      $cores2 = "#00deff";
   }


   $resultados .= '<tr>
    <td>

                     <span style="color:' . ($item->status <= 0 ? '#ff2121' : '#00ff00') . '"> 
                     <i class="fa fa-circle" aria-hidden="true"></i> 
                     </span>

                     </td>
                     <td style="width:150px">
                      
                      <span style="color:' . ($item->status <= 0 ? '#ff2121' : '#00ff00') . '">
                      ' . ($item->status <= 0 ? 'EM ABERTO' : 'PAGO') . '
                      </span>
                      
                      </td>

                      <td>
                      
                      <span style="color:' . ($item->tipo <= 0 ? '#ff2121' : '#48da59 ') . '">
                      ' . ($item->tipo <= 0 ? 'DESPESA' : 'RECEITA') . '
                      </span>
                      
                      </td>
                    
                      <td>' . date('d/m/Y', strtotime($item->data)) . '</td>

                      <td>' . $item->categoria . '</td>

                      <td><h3><span class="badge badge-pill badge-danger">' . $item->pagamento . '</span></h3></td>

                      <td style="font-weight: 600; width:50px"> <span style="font-size:22px; color:' . ($item->tipo <= 0 ? '#ff2121 ' : '#48da59') . '"> R$ ' . number_format($item->valor, "2", ",", ".") . '</span></td>
                    
                                    
                      <td class="centro">
                      
                      <button title="PAGAR" ' . ($item->status == 1 ? 'disabled' : '') . ' class="btn btn-warning btn-sm" onclick="Pagar(' . $item->id . ')"> <i class="fa fa-credit-card" aria-hidden="true"></i> </button>
                      &nbsp;
                      <button class="btn btn-success btn-sm" onclick="Editar(' . $item->id . ')"> <i class="fas fa-pencil-alt"></i></button>

                      
                      </td>
                      </tr>

                      ';
}

$resultados = strlen($resultados) ? $resultados : '<tr>
                                                     <td colspan="8" class="text-center" > Nenhuma movimentaçãox cadastrada !!!!! </td>
                                                     </tr>';


?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">

            <div class="card back-black">
               <div class="card-header">
                  <button title="ALT + Q" accesskey="q" type="submit" class="btn btn-warning" data-toggle="modal" data-target="#modal-default"> <i class="fas fa-plus"></i> &nbsp; MOVIMENTAR</button>
                  <a href="movimentacao-detalhe.php?id=<?= $idcaixa ?>">
                     <button style="margin-right:50px; font-weight:600; font-size:x-large" type="submit" class="<?= $total_diaria <= 0 ? 'btn btn-danger' : 'btn btn-default' ?> float-right btn-lg"> <i class="fa fa-print" aria-hidden="true"></i>
                        FECHAMENTO </button>
                  </a>
                  <button type="submit" style="margin-right:50px; font-weight:600; font-size:x-large" class="btn btn-default float-right" data-toggle="modal" data-target="#modal-data"> <i class="fa fa-print"></i> &nbsp; RELATÓRIOS</button>
                  <button style="margin-right:50px; font-weight:600; font-size:x-large" type="submit" class="<?= $total <= 0 ? 'btn btn-danger' : 'btn btn-success' ?> float-right btn-lg"><i class="fa fa-arrow-right" aria-hidden="true"></i>
                     R$ <?= number_format($total, "2", ",", ".")  ?></button>

               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table id="example" class="table table-dark table-hover table-bordered table-striped">
                     <thead>
                        <tr>
                           <th> <i class="fa fa-align-justify" aria-hidden="true"></i> </th>

                           <th> STATUS </th>
                           <th> TIPO </th>
                           <th> DATA </th>
                           <th> CATEGORIA </th>
                           <th> FORMA DE PAGAMENTO </th>
                           <th class="t-100"> RECEBIDO </th>
                           <th class="centro"> AÇÃO </th>
                        </tr>
                     </thead>
                     <tbody>

                        <?= $resultados ?>

                  </table>
               </div>

            </div>

         </div>

      </div>

   </div>

</section>
<div class="modal fade" id="modal-default">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form action="./movimentacao-insert.php" method="post">
            <input type="hidden" name="idcaixa" value="<?= $idcaixa ?>">
            <div class="modal-header">
               <h4 class="modal-title">MOVIMENTAR
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="card-body">

               <div class="form-group">

                  <div class="row">

                     <div class="col-lg-12 col-12">
                        <div class="form-group">
                           <label>Categorias</label>
                           <select class="form-control select2bs4" style="width: 100%;" name="catdespesas_id" required>

                              <option value=""> Selecione uma categoria </option>
                              <?php

                              foreach ($categorias as $item) {
                                 echo '<option value="' . $item->id . '">' . $item->nome . '</option>';
                              }
                              ?>

                           </select>
                        </div>
                     </div>

                     <div class="col-lg-12 col-12">
                        <div class="form-group">
                           <label>Forma de pagamento</label>
                           <select class="form-control select2bs4" style="width: 100%;" name="forma_pagamento_id" required>

                              <option value=""> Selecione uma categoria </option>
                              <?php

                              foreach ($pagamentos as $item) {
                                 echo '<option value="' . $item->id . '">' . $item->nome . '</option>';
                              }
                              ?>

                           </select>
                        </div>
                     </div>

                     <div class="col-lg-6 col-6">

                        <div class="form-group">
                           <label>Previão de pagamento:</label>

                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <span class="input-group-text"><i class="far fa-clock"></i></span>
                              </div>
                              <input value="<?php
                                             date_default_timezone_set('America/Sao_Paulo');
                                             echo date('Y-m-d\TH:i:s', time()); ?>" type="datetime-local" class="form-control" name="data" required>
                           </div>
                           <!-- /.input group -->
                        </div>
                     </div>
                     <div class="col-lg-6 col-6">

                        <div class="form-group">

                           <label>Status</label>
                           <div>
                              <div class="form-check form-check-inline">
                                 <label class="form-control">
                                    <input type="radio" name="status" value="1" checked> Pago
                                 </label>
                              </div>

                              <div class="form-check form-check-inline">
                                 <label class="form-control">
                                    <input type="radio" name="status" value="0"> Em aberto
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6 col-6">

                        <div class="form-group">

                           <label>Tipo</label>
                           <div>

                              <div class="form-check form-check-inline">
                                 <label class="form-control">
                                    <input type="radio" name="tipo" value="1" checked> Receita
                                 </label>
                              </div>

                              <div class="form-check form-check-inline">
                                 <label class="form-control">
                                    <input type="radio" name="tipo" value="0"> Despesas
                                 </label>
                              </div>

                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6 col-6">
                        <div class="form-group">
                           <label>Observação</label>
                           <textarea class="form-control" aria-label="With textarea" name="descricao"></textarea>
                        </div>
                     </div>

                     <div class="col-lg-6 col-6">
                        <div class="form-group">
                           <label>Valor</label>
                           <input placeholder="R$" style="border:none !important; background-color:#a20808;color:#fff;font-size:26px;font-weight:600 " type="text" class="form-control" name="valor" id="dinheiro" required>
                        </div>
                     </div>

                  </div>
               </div>

            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
               <button type="submit" class="btn btn-primary">SALVAR</button>
            </div>

         </form>

      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>


<form action="./movimentacao-edit.php" method="GET">
   <div class="modal fade" id="pagarModal">
      <div class="modal-dialog">

         <div class="modal-content bg-light">
            <div class="modal-header">
               <h4 class="modal-title">PAGAMENTO
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">


               <span class="pag-modal"></span>

            </div>
            <div class="modal-footer justify-content-between">
               <button title="ALT+E" accesskey="e" type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
               <button title="ALT+R" accesskey="r" type="submit" class="btn btn-primary">Salvar
               </button>
            </div>
         </div>

         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
</form>


<form action="./pagar-edit.php" method="POST" enctype="multipart/form-data">
   <div class="modal fade" id="editModal">
      <div class="modal-dialog modal-lg">

         <div class="modal-content bg-light">
            <div class="modal-header">
               <h4 class="modal-title">ATUALIZAR
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">


               <span class="edit-modal"></span>

            </div>
            <div class="modal-footer justify-content-between">
               <button title="ALT+E" accesskey="e" type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
               <button title="ALT+R" accesskey="r" type="submit" class="btn btn-primary">Salvar
               </button>
            </div>
         </div>

         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
</form>