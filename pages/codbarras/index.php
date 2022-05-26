<?php
require __DIR__ . '../../../vendor/autoload.php';

use App\Entidy\Produto;

$contador = 0;
$produto = "";
$barra = "";
$valor = "";

$barra = $_GET['barra'];

$consulta = "p.barra LIKE'%".$barra."%'";

$res = "";

$listar = Produto::getList(
  'p.id as id,
                            p.data as data,
                            p.codigo as codigo,
                            p.barra as barra,
                            p.nome as nome,
                            p.foto as foto,
                            p.qtd as  qtd,
                            p.estoque as estoque,
                            p.aplicacao as aplicacao,
                            p.valor_compra as valor_compra,
                            p.valor_venda as valor_venda,
                            p.categorias_id as categorias_id,
                            c.nome as categoria',
  'produtos AS p
                            INNER JOIN
                            categorias AS c ON (p.categorias_id = c.id)',
  $consulta,
  null,
  null
);

foreach ($listar as $item) {

  $contador += 1;
  $produto = $item->nome;
  $barra = $item->barra;
  $valor = number_format($item->valor_venda, "2", ",", ".");


  $res .= '   <tr>
                
                      
                        <td style="font-size:16px;text-align:left;width:40px">' . $contador . '</td>
                        <td style="font-size:16px;text-align:left;width:80px"><span class="eneylton" >' . $item->barra . '</span></td>
                      
                        <td style="font-size:16px;text-transform: uppercase; width:250px; text-align:left" >' . $item->categoria . '</td>
                        <td style="font-size:16px;text-transform: uppercase; width:250px; text-align:left"><span >' . $item->nome . '</span></td>
                      
                        <td style="color:#ff0000;font-size:22px;text-transform: uppercase; width:100px; text-align:left"> R$ ' . number_format($item->valor_compra, "2", ",", ".") . '</td>
                        <td style="font-size:22px;text-transform: uppercase; width:100px; text-align:left">R$ ' . number_format($item->valor_venda, "2", ",", ".") . '</td>
    
                </tr>
                ';
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>GERAR BARRAS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>

  <div class="container">
    <div style="margin: 20px;margin-top:30px">
      <h2 class="text-center">GERAR CÓDIGO DE BARRAS</h2>
      <form class="form-horizontal" method="post" action="barcode.php" target="_blank">

        <input type="hidden" name="product" value="<?= $produto ?>">
        <input type="hidden" name="product_id" value="<?= $barra ?>">
        <input type="hidden" name="rate" value="<?= $valor ?>">

        <table class="table table-striped">
          <tbody>
            <tr style="background-color:#ff7c7f; color:#fff">
              <td style="text-align: center; text-transform:uppercase" colspan="9">Gerar código de barras de produtos</td>
            </tr>

            <tr style="background-color: #000; color:#fff">

              <td>Nª</td>
              <td style="text-align:left;"> BARRA </td>
           
              <td style="text-align:left"> CATEGORIA </td>
              <td style="text-align:left"> NOME </td>
            
              <td> COMPRA </td>
              <td> VENDA </td>

            </tr>

            <?= $res ?>




          </tbody>
        </table>


        <div class="row">
          <div class="col-8">
          
              
              <div class="col-sm-10">
                <input autofocus placeholder="Quantidade de etiquetas" autocomplete="OFF" type="print_qty" class="form-control" id="print_qty" name="print_qty">
              </div>
           

          </div>
          <div class="col-4">
            
            <div class="form-group" style="text-align: right;">
             
                <button type="submit" class="btn btn-warning"><i class="fa fa-barcode" aria-hidden="true"></i> &nbsp; GERAR COD BARRAS</button>

            </div>

          </div>
        </div>
      </form>
    </div>
  </div>

</body>

</html>