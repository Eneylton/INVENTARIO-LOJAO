<?php

$list = '';
$resultados = '';
$contador = 0;
$quantidade = 0;
$total = 0;

foreach ($listar as $item) {

  $contador += 1;

  $quantidade += $item->estoque;

  $total = $quantidade * $item->valor_venda;

   if (empty($item->foto)) {
      $foto = './imgs/sem-foto.jpg';
   } else {
      $foto = $item->foto;
   }

   $resultados .= '<tr>
   <td class="texto-medio">' . $contador . '</td>
   <td><img src="../.' . $foto . '" class="img-thumbnail imgs"></td>   
   <td><span  class="barra texto-grande">' . $item->barra . '</span></td>
   <td class="texto-medio">' . $item->categoria . '</td>
   <td class="texto-medio">' . $item->nome . '</td>
   <td>
     
     <span  class="' . ($item->estoque <= 3 ? 'badge badge-danger' : 'badge badge-primary') . ' qtd">' . $item->estoque . '</span>
     
   </td>
   <td> <button type="button" class="btn btn-danger"> R$ ' . number_format($item->valor_compra, "2", ",", ".") . '</button></td>
   
   <td> <button class="btn btn-success"> R$ ' . number_format($item->valor_venda, "2", ",", ".") . '</button></td>
 

   <td class="centro">
   
   <button class="btn btn-light btn-sm" onclick="Editar(' . $item->id . ')"> <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
  
   &nbsp;
    <a href="produto-delete.php?id=' . $item->id . '">
    <button type="button" class="btn btn-light btn-sm"> <i class="far fa-trash-alt"></i> &nbsp; Excluir</button>
    </a>
   </td>
  </tr>

   ';
}

$resultados = strlen($resultados) ? $resultados : '<tr>
                                  <td colspan="9" class="text-center" > Nenhum produto encontrado !!!!! </td>
                                  </tr>';

?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">

            <div class="card back-black">
               <div class="card-header">
   
                  <button title="ALT+Q" accesskey="q" type="submit" class="btn btn-warning" data-toggle="modal" data-target="#modal-default"> <i class="fas fa-plus"></i> &nbsp; Novo</button>
   
                  <button accesskey="r" type="submit" class="btn btn-link float-right" data-toggle="modal" data-target="#modal-data"> <i class="fas fa-print"></i> &nbsp; IMPRIMIR RELATÓRIOS</button>
                           
                  <button accesskey="b" type="submit" class="btn btn-link float-right" data-toggle="modal" data-target="#modal-data2"> <i class="fas fa-barcode"></i> &nbsp; GERAR COD/BARRAS</button>

               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table id="example" class="table table-dark table-hover table-bordered table-striped">
                     <thead>
                        <tr>

                           <th> Nº</th>
                           <th> FOTO</th>
                           <th> COD BARRAS </th>
                           <th> CATEGORIAS </th>
                           <th> NOME DO PRODUTO </th>
                           <th> ESTOQUE </th>
                           <th> COMPRA </th>
                           <th> VENDA </th>
                           <th> AÇÃO </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?= $resultados ?>
                     </tbody>
                     <tfoot>
                        <tr>
                           <th colspan="5" class="direita"> EM ESTOQUE </th>
                        
                           <th><?= $quantidade  ?></th>
                           <th>INVENTÁRIO</th>
                           <th>R$ <?= number_format($total,"2",",",".") ?></th>
                           <th></th>
                           
                        </tr>
                     </tfoot>
                  </table>
               </div>

            </div>

         </div>

      </div>

   </div>

</section>


<div class="modal fade" id="modal-default">
   <div class="modal-dialog modal-lg">
      <div class="modal-content bg-light">
         <form action="./produto-insert.php" method="post" enctype="multipart/form-data">

            <div class="modal-header">
               <h4 class="modal-title">Novo produto
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-lg-3 col-3">
                     <div id="divImgConta">
                        <?php if ($foto2 != "") { ?>
                           <img src="../../imgs/<?php echo $foto2 ?>" width=50%" id="target">
                        <?php  } else { ?>
                           <img src="../../imgs/sem-foto.jpg" width="50%" id="target">
                        <?php } ?>
                     </div>
                  </div>
                  <div class="col-lg-8 col-12 custom-file">
                     <input type="file" name="arquivo" class="form-control" value="<?php echo $foto2 ?>" id="imagem" name="arquivo" onChange="carregarImg();">
                     <br>
                  </div>

               </div>
               <br>

               <div class="row">
                  <div class="col-6">
                     <div class="form-group">
                        <label>Código de Barras</label>
                        <input type="text" class="form-control" name="barra">
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label>Categorias</label>
                        <select class="form-control select2 " style="width: 100%;" name="categorias_id" required autofocus>
                           <option value=""> Selecione uma categoria </option>
                           <?php

                           foreach ($categorias as $item) {
                              echo '<option style="text-transform:uppercase;" value="' . $item->id . '">' . $item->nome . '</option>';
                           }
                           ?>

                        </select>
                     </div>

                  </div>

               </div>

               <div class="row">
                  <div class="col-6">
                     <div class="form-group">
                        <label>Nome do produto</label>
                        <input type="text" class="form-control" name="nome" style="text-transform: uppercase;">
                     </div>

                  </div>

                  <div class="col-3">
                     <div class="form-group">
                        <label>Compra</label>
                        <input placeholder="R$ 0,00" type="text" class="form-control" name="valor_compra" id="compra1"  required>
                     </div>

                  </div>

                  <div class="col-3">
                     <div class="form-group">
                        <label>Venda</label>
                        <input placeholder="R$ 0,00" type="text" class="form-control" name="valor_venda" id="venda1" required>
                     </div>

                  </div>


               </div>

               <div class="row">
                  <div class="col-4">
                     <div class="form-group">
                        <label>Quantidade</label>
                        <input type="text" class="form-control" name="estoque" required>
                     </div>

                  </div>

                  <div class="col-8">
                     <div class="form-group">
                        <label>Descrição</label>
                        <textarea class="form-control" name="aplicacao" cols="60" rows="5" style="text-transform: uppercase;"></textarea>
                     </div>

                  </div>

               </div>

            </div>
            <div class="modal-footer justify-content-between">
               <button title="ALT+W" accesskey="w" type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
               <button title="ALT+S" accesskey="s" type="submit" class="btn btn-primary">Salvar</button>
            </div>

         </form>

      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>


<form action="./produto-edit.php" method="POST" enctype="multipart/form-data">
   <div class="modal fade" id="editModal">
      <div class="modal-dialog modal-lg">

         <div class="modal-content bg-light">
            <div class="modal-header">
               <h4 class="modal-title">Editar
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">


               <span class="edit-modal"></span>

            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
               <button title="ALT+3" accesskey="3" type="submit" class="btn btn-primary">Salvar
               </button>
            </div>
         </div>

         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
</form>

<div class="modal fade" id="modal-data">
   <div class="modal-dialog modal-lg">
      <div class="modal-content ">
         <form action="./produto-gerar.php" method="GET" enctype="multipart/form-data">

            <div class="modal-header">
               <h4 class="modal-title">Relatórios
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="card-body">

               <div class="form-group">

                  <div class="row">

                     <div class="col-lg-4 col-4">
                        <input class="form-control" type="date" value="<?php date_default_timezone_set('America/Sao_Paulo'); echo date('Y-m-d') ?>" name="dataInicio">
                     </div>


                     <div class="col-lg-4 col-4">
                        <input class="form-control" type="date" value="<?php date_default_timezone_set('America/Sao_Paulo'); echo date('Y-m-d') ?>" name="dataFim">
                     </div>


                     <div class="col-lg-4 col-4">

                        <select class="form-control select" name="categorias_id" >
                           <option value=""> Categorias </option>
                           <?php

                           foreach ($categorias as $item) {
                              echo '<option value="' . $item->id . '">' . $item->nome . '</option>';
                           }
                           ?>

                        </select>

                     </div>

                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-8 col-8">
                     <input autofocus placeholder="Nome do produto" class="form-control" type="text" name="nome">
                  </div>

                  <div class="col-lg-4 col-4">
                     <input placeholder="Código de barras" class="form-control" type="text" name="barra">
                  </div>

               </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button accesskey="w" type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
               <button accesskey="g" type="submit" class="btn btn-primary">Gerar relatório</button>
            </div>

         </form>

      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-data2">
   <div class="modal-dialog modal-lg">
      <div class="modal-content ">
         <form action="../../pages/codbarras/index.php" method="GET" enctype="multipart/form-data">

            <div class="modal-header">
               <h4 class="modal-title">GERAR CÓDIGO DE BARRAS
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="card-body">
               <div class="row">
               
                  <div class="col-lg-4 col-4">
                     <input placeholder="Código de barras" class="form-control" type="text" name="barra">
                  </div>

               </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
               <button type="submit" class="btn btn-primary">Gerar </button>
            </div>

         </form>

      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>