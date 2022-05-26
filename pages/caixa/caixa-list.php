<?php
require __DIR__ . '../../../vendor/autoload.php';

use App\Entidy\Caixa;
use App\Entidy\FormaPagamento;
use App\Session\Login;

define('TITLE','Abrir Caixa');
define('BRAND','Caixa');


Login::requireLogin();

$usuariologado = Login:: getUsuarioLogado();

$usuarios_id = $usuariologado['id'];

$listar = Caixa::getList('c.id AS id,fc.id as id_fechamento,
c.data AS data,
c.forma_pagamento_id AS forma_pagamento_id,
c.valor AS valor,
f.nome AS pagamento,
fc.tipo AS tipo,
sum(fc.valor) as valor_fechamento,
fc.status as status','caixa AS c
left JOIN
forma_pagamento AS f ON (c.forma_pagamento_id = f.id)
left JOIN
fechamento fc ON (fc.caixa_id = c.id) WHERE c.usuarios_id='.$usuarios_id.' group by c.data',null, 'c.id desc',null);


$pagamentos = FormaPagamento :: getList('*','forma_pagamento',null,'nome ASC');


include __DIR__ . '../../../includes/layout/header.php';
include __DIR__ . '../../../includes/layout/top.php';
include __DIR__ . '../../../includes/layout/menu.php';
include __DIR__ . '../../../includes/layout/content.php';
include __DIR__ . '../../../includes/caixa/caixa-form-list.php';
include __DIR__ . '../../../includes/layout/footer.php';


?>

<script>

async function Editar(id){
    const dadosResp = await fetch('caixa-modal.php?id=' + id);
    const result = await dadosResp.json();
  
    const editModal = new bootstrap.Modal(document.getElementById("editModal"));
    editModal.show();
    document.querySelector(".edit-modal").innerHTML = result['dados'];
 
}

</script>

<script>

async function Fechar(id){
    const dadosResp = await fetch('fechamento-modal.php?id=' + id);
    const result = await dadosResp.json();
  
    const fechamentoModal = new bootstrap.Modal(document.getElementById("fechamentoModal"));
    fechamentoModal.show();
    document.querySelector(".fechar-modal").innerHTML = result['dados'];
 
 
}

</script>