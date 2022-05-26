<?php

require __DIR__ . '../../../vendor/autoload.php';

use App\Entidy\Clientes;
use App\Entidy\Produto;
use App\Session\Login;
use App\Webservice\ViaCEP;

Login::requireLogin();
$usuariologado = Login::getUsuarioLogado();
$usuario = $usuariologado['nome'];

$foto = "";
$estoque = 0;
$venda = 0;

define('TITLE', 'Caixa');
define('BRAND', 'Atendente: &nbsp; <span style="text-transform: uppercase; color:#000">'.$usuario.'</span>');

if (isset($_POST['id'])) {

  $id = $_POST['id'];

  $dadosCEP = ViaCEP::consultaCEP($id);

  $logradouro  = $dadosCEP['logradouro'];
  $bairro  = $dadosCEP['bairro'];
  $localidade  = $dadosCEP['localidade'];
  $uf  = $dadosCEP['uf'];
  $cep  = $dadosCEP['cep'];
} else {
  $id = "";
  $logradouro  = "";
  $bairro  = "";
  $localidade  = "";
  $uf  = "";
  $cep  = "";
}

if(isset($_POST['buscar'])){

  $buscar = $_POST['buscar'];
  $barra = Produto::getBarra('*','produtos',$buscar,null,null);

  if($barra != false){

    $foto = $barra->foto;
    $estoque = $barra->estoque;
    $venda = $barra->valor_venda;

  }else{

    echo "<script type='text/javascript'>
    alert(oook);
     </script>";
  }

 

  if ($barra != false) {

    $id =  $barra->id;

    if (!isset($_SESSION['carrinho'][$id])) {

      $_SESSION['carrinho'][$id] = 1;
    } else {
      $_SESSION['carrinho'][$id] += 1;
    }
      
  }

  
}

if (isset($_GET['acao'])) {

  if ($_GET['acao'] == 'up') {

    if (is_array($_POST['prod'])) {

      foreach ($_POST['prod'] as $id => $qtd) {

        $id = intval($id);
        $qtd = intval($qtd);

        if (!empty($qtd) || $qtd != 0) {

          $_SESSION['carrinho'][$id] = $qtd;
        } else {

          unset($_SESSION['carrinho'][$id]);
        }
      }
    }

    if(isset($_POST['val'])){

    if (is_array($_POST['val'])) {

      foreach ($_POST['val'] as $id => $valor) {

        $item = Produto::getID('*', 'produtos', $id, null, null);
        $val1              = $valor;
        $val2              = str_replace(".", "", $val1);
        $preco             = str_replace(",", ".", $val2);

        $item->valor_venda = $preco;
        $item->atualizar();
      }
    }

  }
  }

  
}

$clientes = Clientes ::getList('*','clientes',null,'nome ASC');
$produtos = Produto ::getList('*','produtos',null,'nome ASC');

include __DIR__ . '../../../includes/layout/header.php';
include __DIR__ . '../../../includes/layout/top.php';
include __DIR__ . '../../../includes/layout/menu.php';
include __DIR__ . '../../../includes/layout/content.php';
include __DIR__ . '../../../includes/pdv/pdv-caixa.php';
include __DIR__ . '../../../includes/layout/footer.php';


?>

<script>

async function Tabela(id){
    const dadosResp = await fetch('tabela-modal.php?id=' + id);
    const result = await dadosResp.json();
  
    const tabelaModal = new bootstrap.Modal(document.getElementById("tabelaModal"));
    tabelaModal.show();
    document.querySelector(".tabela-modal").innerHTML = result['dados'];
 
}

</script>


<script type="text/javascript">
  $(document).ready(function() {
    $("#cpf").mask("000.000.000-00")
    $("#telefone").mask("(00) 0000-0000")
    $("#dinheiro2").mask("999.999.990,00", {
      reverse: true
    })
  })
</script>

<script>
    async function Cep() {

        $("#cep1").on("keyup", function() {

            var idCEP = $("#cep1").val();
            $.ajax({
                url: 'https://viacep.com.br/ws/' + idCEP + '/json',
                dataType: 'json',
                success: function(resposta) {

                    $("#logradouro1").val(resposta.logradouro);
                    $("#bairro1").val(resposta.bairro);
                    $("#cidade1").val(resposta.localidade);
                    $("#uf1").val(resposta.uf);
                    $("#numero1").focus();
                }

            })

        });
    }
</script>

<script>
    async function Cep2() {

        $("#cep2").on("change", function() {

            var idCEP = $("#cep2").val();
            $.ajax({
                url: 'https://viacep.com.br/ws/' + idCEP + '/json',
                dataType: 'json',
                success: function(resposta) {

                    $("#logradouro").val(resposta.logradouro);
                    $("#bairro1").val(resposta.bairro);
                    $("#cidade1").val(resposta.localidade);
                    $("#uf1").val(resposta.uf);
                    $("#numero1").focus();
                }

            })

        });
    }
</script>


<script>

async function Fechar(id){
    const dadosResp = await fetch('fechamento-caixa.php?id=' + id);
    const result = await dadosResp.json();
  
    const fechamentoModal = new bootstrap.Modal(document.getElementById("fechamentoModal"));
    fechamentoModal.show();
    document.querySelector(".fechar-modal").innerHTML = result['dados'];
 
 
}

</script>