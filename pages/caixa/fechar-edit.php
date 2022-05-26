<?php

use App\Entidy\Caixa;
use App\Entidy\Fechamento;

require __DIR__.'../../../vendor/autoload.php';


$value = Caixa::getID('*','caixa',$_POST['id'],null,null);

$id_caixa = $value->id;

$result = Fechamento ::getFechamentoID('*','fechamento',$id_caixa,null,null);

$result->status = 1;

$result->atualizar();

header('location: caixa-list.php?status=success');

exit;

?>

