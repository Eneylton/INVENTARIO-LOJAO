<?php

use App\Entidy\Fechamento;

$list = '';

if (isset($_GET['status'])) {

   switch ($_GET['status']) {
      case 'success':
         $icon  = 'success';
         $title = 'Parabéns';
         $text = 'Cadastro realizado com Sucesso !!!';
         break;

      case 'del':
         $icon  = 'error';
         $title = 'Parabéns';
         $text = 'Esse usuário foi excluido !!!';
         break;

      case 'edit':
         $icon  = 'success';
         $title = 'Parabéns';
         $text = 'CAIXA FECHADO COM SUCESSO !!!';
         break;


      default:
         $icon  = 'error';
         $title = 'Opss !!!';
         $text = 'Algo deu errado entre em contato com admin !!!';
         break;
   }

   function alerta($icon, $title, $text)
   {
      echo "<script type='text/javascript'>
      Swal.fire({
        type:'type',  
        icon: '$icon',
        title: '$title',
        text: '$text'
       
      }) 
      </script>";
   }

   alerta($icon, $title, $text);
}

$resultados = '';

$contador = 0;
$nenhum = 0;
$negativo = 0;
$positivo = 0;
$calculo = 0;

foreach ($listar as $item) {
   if($item->valor_fechamento == ""){
      $nenhum = 00;
   }else{

      $nenhum = $item->valor_fechamento + $item->valor;
   }

   if ($item->status == 0) {
      $bad = 'badge-warning';
      $cor = "st-verde";
      $texto = 'Aberto';
      $check = "";
      $flag = "badge-success";
   } else {
      
      $bad   = 'badge-info';
      $cor   = "st-vermelho";
      $texto = 'fechado';
      $check = "disabled";
      $flag = "badge-danger";
   }


   $result = Fechamento::getList('*','fechamento','caixa_id='.$item->id);

   foreach ($result as $res) {
      if($res->tipo == 1){

         $positivo += $res->valor;
         
      }else{
         
         $negativo += $res->valor;
         
      }

      $calculo = $item->valor + $positivo - $negativo;

   }
     

   $contador += 1;

   $resultados .= '<tr>
                       
                        <td >' . $contador . '</td>
                        <td class="'.$cor.' caixa-alta texto-medio">'.$texto.'</td>
                        <td> <h3><span class="badge badge-pill '.$flag.'"">
                        <i class="fa fa-clock" aria-hidden="true"></i> &nbsp; &nbsp;' .date('d/m/Y', strtotime($item->data)). '</span></h3> </td>

                        <td style="text-transform:uppercase; width:100px"> <h3><span class="badge badge-pill badge-secondary">
                        <i class="fas fa-check"></i> &nbsp;' . $item->pagamento . '</span></h3> </td>

                        <td style="text-transform:uppercase; width:100px;text-align:center"> <h3><span class="badge badge-pill badge-primary">
                        <i class="fas fa-plus-circle"></i>&nbsp; R$ &nbsp;' . number_format($item->valor,"2",",",".") . '</span></h3> </td>

                        <td style="text-transform:uppercase; width:100px;text-align:center"> <h3><span class="badge badge-pill '.$bad.'">
                        <i class="fas fa-plus-circle"></i>&nbsp; R$ &nbsp;' . number_format($calculo,"2",",",".") . '</span></h3> </td>


                        <td class="centro">

                        <a href="../pdv/pdv.php?id_caixa=' . $item->id . '&data='.$item->data.'">
                        <button '. $check.' type="button" class="btn btn-primary btn-sm"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> &nbsp;  &nbsp;  INICIAR</button>
                        </a>
                      
                         &nbsp;
                      
                        <a href="../movimentacao/movimentacao-list.php?id=' . $item->id . '">
                        <button '. $check.' type="button" class="btn btn-success btn-sm"><i class="fas fa-sync"></i> &nbsp;  &nbsp;  Movimentações</button>
                        </a>

                        &nbsp;
                        
                        
                        <button '. $check.' class="btn btn-danger btn-sm" onclick="Fechar(' . $item->id . ')"> <i class="fa fa-times" aria-hidden="true"></i> &nbsp; Fechar Caixa</button>
                        &nbsp;
                        
                        <button '. $check.' class="btn btn-light btn-sm" onclick="Editar(' . $item->id . ')"> <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
                        
                        &nbsp;
                      
                        <a href="caixa-delete.php?id=' . $item->id . '">
                        <button '. $check.'  type="button" class="btn btn-light btn-sm"> <i class="far fa-trash-alt"></i> &nbsp; Excluir</button>
                        </a>


                        </td>
                        </tr>

                        ';
                        }

                         $resultados = strlen($resultados) ? $resultados : '<tr>
                                                     <td colspan="7" class="text-center" > Nenhuma caixa cadastrada !!!!! </td>
                                                     </tr>';


?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">

            <div class="card back-black">
               <div class="card-header">
                  <button title="ALT + Q" accesskey="q" type="submit" class="btn btn-warning" data-toggle="modal" data-target="#modal-default"> <i class="fas fa-plus"></i> &nbsp; ABRIR CAIXA</button>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table id="example" class="table table-dark table-hover table-bordered table-striped">
                     <thead>
                     <tr>
                           <th class="t-40"> Nº </th>
                           <th class="t-20"> STATUS </th>
                           <th class="t-300"> DATA </th>
                           <th> TIPO DE ENTRADA </th>
                           <th> V.ENTRADA </th>
                           <th> V.FECHAMENTO </th>
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
   <div class="modal-dialog">
      <div class="modal-content bg-light">
         <form action="./caixa-insert.php" method="post">

            <div class="modal-header">
               <h4 class="modal-title">Abrir Caixa 
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label>Entrada</label>
                  <input type="text" class="form-control" name="valor" required id="dinheiro" autofocus>
               </div>
               <div class="form-group">
                        <label>Forma de pagamento</label>
                        <select class="form-control select" style="width: 100%;" name="forma_pagamento_id" required>
                           <option value=""> Selecione um tipo de pagamento </option>
                           <?php

                           foreach ($pagamentos as $item) {
                              echo '<option style="text-transform:uppercase;" value="' . $item->id . '">' . $item->nome . '</option>';
                           }
                           ?>

                        </select>
                     </div>

            </div>
            <div class="modal-footer justify-content-between">
               <button accesskey="w" title="ALT+W" type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
               <button accesskey="s" title="ALT+S" type="submit" class="btn btn-primary">Salvar</button>
            </div>

         </form>

      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>

<form action="./fechar-edit.php" method="POST" enctype="multipart/form-data">
   <div class="modal fade" id="fechamentoModal">
      <div class="modal-dialog modal-dialog-centered">

         <div class="modal-content bg-light">
            <div class="modal-header">
               <h4 class="modal-title">FECHAMENTO DE CAIXA
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">


               <span class="fechar-modal"></span>

            </div>
            <div class="modal-footer justify-content-between">
       
            <button title="ALT+E" accesskey="e" type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
               <button title="ALT+R" accesskey="r" type="submit" class="btn btn-success">Sim
               </button>
            </div>
         </div>

         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
</form>


