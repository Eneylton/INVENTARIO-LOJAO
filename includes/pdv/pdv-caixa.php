<?php

use App\Entidy\Produto;

$caixa_id = 0;
$modal = '';

$resultados = '';

foreach ($produtos as $items) {
  $resultados .= '<tr>
  <td>' . $items->id . '</td>
  <td>' . $items->nome . '</td>
  <td>' . $items->estoque . '</td>
  <td>R$ ' .number_format( $items->valor_venda,"2",",",".") . '</td>

  <td style="text-align: right;">
    
   <a href="cargo-delete.php?id=' . $items->id . '">
   <button type="button" class="btn btn-link btn-lg"> <i style="font-size:25px" class="fa fa-plus-circle" aria-hidden="true"></i></button>
   </a>


  </td>
  </tr>

  ';
}

$resultados = strlen($resultados) ? $resultados : '<tr>
                                 <td colspan="2" class="text-center" > Nenhum produto Encontrado !!!!! </td>
         
                                 </tr>';

if (isset($_GET['id_caixa'])) {

  $caixa_id = $_GET['id_caixa'];
  $data = $_GET['data'];

  $modal = 'onclick="Fechar(' . $caixa_id . ')"';

  $_SESSION['caixa'] = array();

  array_push(
    $_SESSION['caixa'],

    array(

      'caixa_id'     =>  $caixa_id,
      'data'         =>  $data

    )
  );
}

$result_cli = "";
$pedido = 0;

foreach ($clientes as $item) {

  $result_cli .= '
  <option value="' . $item->id . '">' . $item->nome . '</option>
   
  ';
}

if (empty($foto)) {
  $img = './imgs/sem-foto.jpg';
} else {
  $img = $foto;
}

$imagem = '<img src="../.' . $img . '" class="foto">';

$qtd   = '<input type="text" class="form-control altura-70 texto-grande" name="qtd" placeholder="000" value="' . $estoque . '">';
$valor = '<input type="text" class="form-control altura-70 texto-grande" name="valor_venda" placeholder="R$" value="' . $venda . '" id="dinheiro3">';

?>

<div class="container-fluid margintop">
  <div class="row">

    <div class="col-4">
      <div class="card-body fundo-branco">
        <form id="form-1" method="POST">
          <div class="row">

            <div class="col-4">

              <div class="form-group">
                <?= $imagem ?>
              </div>

            </div>

            <div class="col-8">

              <div class="form-group">
                <label>COD.BARRA / PRODUTO</label>

                <input type="text" class="form-control altura-70 texto-receber" name="buscar" autofocus>
                <button type="submit" class="btn btn-primary ocultar"><i class="fas fa-search"></i></button>
              </div>

            </div>

          </div>
        </form>
        <form id="form-2" action="venda.php" method="POST">
          <div class="row">

            <div class="col-6">

              <div class="form-group">
                <label>QUANTIDADE</label>

                <?= $qtd ?>

              </div>

            </div>
            <div class="col-6">


              <div class="form-group">
                <label>VALOR</label>

                <?= $valor ?>
              </div>

            </div>

            <div class="col-8">


              <div class="form-group">
                <label>CLIENTE</label>

                <select class="form-control altura-70 texto-receber" name="clientes_id" required>



                  <?= $result_cli; ?>


                </select>
              </div>

            </div>
            <div class="col-4">


              <div class="form-group">
                <label style="color: #fff;">3</label>

                <button accesskey="q" type="button" data-toggle="modal" data-target="#modal-primary" class="btn btn-dark btn-block altura-70 texto-botao" title="ALT + Q"><i class="fas fa-user-alt"></i></button>

              </div>

            </div>

            <div class="col-12">


              <div class="form-group">
                <label>FORMA DE PAGAMENTO</label>
                <select class="form-control altura-70 texto-receber" name="forma_pagamento_id" required>
                  <option value=" ">SELECIONE</option>
                  <option accesskey="z" value="2">DINHEIRO</option>
                  <option accesskey="x" value="3">CARTÃO DE CRÉDITO</option>
                  <option accesskey="c" value="4">CARTÃO DE DÉBITO</option>
                  <option accesskey="v" value="5">PIX</option>

                </select>
              </div>

            </div>

            <div class="col-6">
              <div class="form-group">
                <label style="color:#fff">RECEBER</label>
                <input type="text" class="form-control altura-70 verde" name="receber" id="dinheiro7" placeholder="R$ 0,00" required>
              </div>

            </div>
            <div class="col-6">
              <div class="form-group">
                <label style="color:#fff">OBSERVAÇÕES</label>
                <button accesskey="a" type="submit" class="btn btn-dark btn-block altura-133 texto-botao"><i class="lg-60 fa fa-chevron-circle-right"></i>
                  <p class="texto-p">PAGAR</p>
                </button>
              </div>

            </div>

          </div>
        </form>
      </div>
    </div>

    <?php

    if (!isset($_SESSION['carrinho'])) {
      $_SESSION['carrinho'] = array();
    }


    $_SESSION['dados-venda'] = array();

    $listItem = '';
    $valor1 = "";
    $total = 0;
    $porcento = "";

    foreach ($_SESSION['carrinho'] as $barra => $qtd) {

      $pedido = substr(uniqid(rand()), 0, 6);

      if (isset($_POST['porcent'][$barra])) {

        $porcento = $_POST['porcent'][$barra];
      }

      if ($porcento != null) {

        $item = Produto::getID('*', 'produtos', $id, null, null);

        $valor1 = $item->valor_venda;

        $valor2 = str_replace(".", ",", $valor1);

        $nome = $item->nome;

        $valor_porcento  = $qtd * $valor1;

        $sub  = $valor_porcento  - ($valor_porcento  * $porcento / 100);

        $total += $sub;
      } else {

        $item = Produto::getID('*', 'produtos', $barra, null, null);

        $valor1 = $item->valor_venda;

        $valor2 = str_replace(".", ",", $valor1);

        $nome = $item->nome;

        $sub = $qtd * $valor1;

        $total += $sub;
      }



      $listItem .= '
    <tr>
    <td class="texto-carrinho">' . $nome . '</td>
    <td class="centro">
    <input class="form-control centro texto-carrinho" type="text" name="prod[' . $barra . ']" value="' . $qtd . '"  />
    </td>

    <td class="centro">
    <input class="form-control texto-carrinho" type="text" id="dinheiro2" name="val[' . $barra . ']" value="' . $valor2 . '" />
    </td>
    <td>
    <select class="form-control texto-carrinho" name="porcent[' . $barra . ']">
    <option value="">Desconto %</option>
    <option value="5">5%</option>
    <option value="10">10%</option>
    <option value="15">15%</option>
    <option value="20">20%</option>
    <option value="50">50%</option>
    </select>

    </td>
    <td class="texto-carrinho"> R$ ' . number_format($sub, "2", ",", ".") . '</td>
    <td class="centro">
    <button type="submit" class="btn btn-link edit"><i class="fas fa-broom"></i></button>
    <a href="excluir.php?excluir=del&id=' . $barra . '" class="delete">
    &nbsp <i class="fas fa-trash"></i></a>
    
    </td>
    </tr> ';


      $listItem = strlen($listItem) ? $listItem : '<tr>
                                                 <td colspan="6" class="text-center" > Nenhum pedido até o momento !!!!! </td>
                                                 </tr>';


      array_push(
        $_SESSION['dados-venda'],

        array(
          'nome'         => $nome,
          'codigo'       => $item->codigo,
          'barra'        => $item->barra,
          'qtd'          => $qtd,
          'valor_venda'  => $valor1,
          'subtotal'     => $sub,
          'desconto'     => $porcento,
          'produtos_id'  => $barra
        )
      );
    }

    ?>

    <div class="col-8">
      <div class="card-body fundo-branco">
        <div class="row">
          <div class="col-12">

            <span class="pedido">Nº DO PEDIDO: <?= $pedido ?></span>
            <span class="float-right calculo">R$ <?= number_format($total, "2", ",", ".")  ?></span>

          </div>
        </div>
      </div>

      <form action="?acao=up" method="post">
        <div class="card-body fundo-branco" style="margin-top: 20px;">
          <div class="row">
            <div class="col-12">

              <table class="table table-bordered table-light table-bordered table-hover table-striped">
                <thead class="thead-dark">
                  <tr>
                    <th> PRODUTO </th>
                    <th class="lg-30"> QTD </th>
                    <th class="lg-50"> VALOR </th>
                    <th class="centro lg-150"> DESCONTO % </th>
                    <th> SUBTOTAL </th>
                    <th class="centro"> AÇÕES </th>
                  </tr>
                </thead>
                <tbody>
                  <?= $listItem ?>
                </tbody>

              </table>

            </div>

            <hr>


          </div>
        </div>
      </form>

      <div class="card-body fundo-branco" style="margin-top: 20px;">

        <div class="row">
          <div class="col-3">
            <div class="form-group">
              <button onclick="Tabela(<?= $caixa_id ?>)" type="button" class="btn btn-success btn-block altura-70 texto-botao">PRODUTOS</button>
            </div>
          </div>
          <div class="col-3">
            <div class="form-group">
              <button type="button" class="btn btn-success btn-block altura-70 texto-botao">DESPESAS</button>
            </div>
          </div>
          <div class="col-3">
            <div class="form-group">
              <button type="button" class="btn btn-success btn-block altura-70 texto-botao">NOVA CATEGORIA</button>
            </div>
          </div>
          <div class="col-3">
            <div class="form-group">
              <button <?= $modal ?> type="button" class="btn btn-success btn-block altura-70 texto-botao">FECHAR</button>

            </div>
          </div>
        </div>

      </div>
    </div>

    <form action="../clientes/clientes-modal.php" method="post">
      <div class="modal fade" id="modal-primary">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Novo Cliente</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control caixa-alta" name="nome" autofocus>
                  </div>

                </div>

              </div>

              <div class="row">
                <div class="col-8">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control caixa-alta" name="email">
                  </div>

                </div>
                <div class="col-4">

                  <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" class="form-control" name="telefone" id="cel">
                  </div>

                </div>

              </div>
              <div class="row">
                <div class="col-2">
                  <div class="form-group">
                    <label>CEP</label>
                    <input type="text" class="form-control caixa-alta" name="cep" id="cep1" onkeyup="Cep()">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Logradouro</label>
                    <input type="text" class="form-control caixa-alta" name="logradouro" id="logradouro1">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>Bairro</label>
                    <input type="text" class="form-control caixa-alta" name="bairro" id="bairro1">
                  </div>
                </div>
              </div>

              <div class="row">

                <div class="col-2">
                  <div class="form-group">
                    <label>Nº</label>
                    <input type="text" class="form-control " name="numero" id="numero1">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>Complemento</label>
                    <input type="text" class="form-control caixa-alta" name="complemento">
                  </div>
                </div>

                <div class="col-3">
                  <div class="form-group">
                    <label>Cidade</label>
                    <input type="text" class="form-control caixa-alta" name="localidade" id="cidade1">
                  </div>
                </div>
                <div class="col-3">

                  <div class="form-group">
                    <label>Estado</label>
                    <input type="text" class="form-control caixa-alta" name="uf" id="uf1">
                  </div>

                </div>

              </div>


            </div>
            <div class="modal-footer justify-content-between">
              <button title="ALT+W" accesskey="w" data-toggle="tooltip" type="button" class="btn btn-danger float-right" data-dismiss="modal">Fechar</button>
              <button title="ALT+S" accesskey="s" type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </form>

    <form action="./fechar-modal.php" method="POST" enctype="multipart/form-data">
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

    <form action="./pagar-edit.php" method="POST" enctype="multipart/form-data">
      <div class="modal fade" id="tabelaModal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">

          <div class="modal-content bg-light">
            <div class="modal-header">
              <h4 class="modal-title">PRODUTOS
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <table id="example" class="table table-bordered table-light table-bordered table-hover table-striped">
                     <thead>
                        
                        <tr>
                           <th style="text-align: left; width:80px"> CÓDIGO </th>
                           <th> NOME </th>
                           <th> QTD </th>
                           <th> VALOR </th>
                          
                           <th style="text-align: right; width:100px"> AÇÃO </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?= $resultados ?>
                     </tbody>

                  </table>

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