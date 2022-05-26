<?php
require __DIR__ . '../../../vendor/autoload.php';

use App\Entidy\Catdespesa;
use App\Entidy\FormaPagamento;
use App\Entidy\Movimentacao;
use App\Session\Login;

define('TITLE','Movimentações financeiras');
define('BRAND','Financeiro');

Login::requireLogin();

if(isset($_GET['id'])){

    $idcaixa = $_GET['id'];
   
}  

$categorias = Catdespesa :: getList('*','catdespesas');
$pagamentos = FormaPagamento :: getList('*','forma_pagamento');

$listar     = Movimentacao::getList('m.id AS id,m.usuarios_id AS usuarios_id,m.catdespesas_id AS catdespesas_id,m.troco as troco,
                                     m.forma_pagamento_id AS forma_pagamento_id,m.data AS data,m.valor AS valor,
                                     m.descricao AS descricao,m.tipo AS tipo,m.status AS status,
                                     u.nome AS usuario,c.nome AS categoria,f.nome AS pagamento',
                                                            
                                     'movimentacoes AS m INNER JOIN usuarios AS u ON (m.usuarios_id = u.id) INNER JOIN
                                      catdespesas AS c ON (m.catdespesas_id = c.id) INNER JOIN forma_pagamento AS f ON (m.forma_pagamento_id = f.id)',
                                      'm.caixa_id='. $idcaixa, 'm.id DESC',null);


include __DIR__ . '../../../includes/layout/header.php';
include __DIR__ . '../../../includes/layout/top.php';
include __DIR__ . '../../../includes/layout/menu.php';
include __DIR__ . '../../../includes/layout/content.php';
include __DIR__ . '../../../includes/movimentacao/movimentacao-form-list.php';
include __DIR__ . '../../../includes/layout/footer.php';

?>


<script>

async function Pagar(id){
    const dadosResp = await fetch('movimentacao-modal.php?id=' + id);
    const result = await dadosResp.json();
  
    const pagarModal = new bootstrap.Modal(document.getElementById("pagarModal"));
    pagarModal.show();
    document.querySelector(".pag-modal").innerHTML = result['dados'];
 
}

</script>

<script>

async function Editar(id){
    const dadosResp = await fetch('movimentar-modal.php?id=' + id);
    const result = await dadosResp.json();
  
    const editModal = new bootstrap.Modal(document.getElementById("editModal"));
    editModal.show();
    document.querySelector(".edit-modal").innerHTML = result['dados'];
 
}

</script>


<script type="text/javascript">
  $(document).ready(function() {
    $("#cpf").mask("000.000.000-00")
    $("#telefone").mask("(00) 0000-0000")
    $("#dinheiro3").mask("999.999.990,00", {
      reverse: true
    })
  })
</script>