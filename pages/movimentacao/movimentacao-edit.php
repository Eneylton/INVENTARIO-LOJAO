<?php

require __DIR__ . '../../../vendor/autoload.php';

$alertaCadastro = '';

use App\Entidy\Fechamento;
use App\Entidy\Movimentacao;
use App\Session\Login;


Login::requireLogin();

date_default_timezone_set('America/Sao_Paulo');
$hoje = date('Y-m-d');

$usuariologado = Login:: getUsuarioLogado();

$usuario_id = $usuarios_id = $usuariologado['id'];

if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {

    header('location: index.php?status=error');

    exit;
}

$value = Movimentacao:: getID('*','movimentacoes',$_GET['id'],null,null);


if (!$value instanceof Movimentacao) {
    header('location: index.php?status=error');

    exit;
}

if(isset($_GET['caixa_id'])){

    $idcaixa = $_GET['caixa_id'];
 
} 

if (isset($_GET['pagamento_id'])) {
    date_default_timezone_set('America/Sao_Paulo');
	
	$val1              = $_GET['receber'];
    $val2              = str_replace(".", "", $val1);
    $preco             = str_replace(",", ".",$val2);

    $value->status = 1;
    $value->tipo   = $_GET['tipo'];
    $value->data = date('Y-m-d H:i:s');
    $value->forma_pagamento_id = $_GET['pagamento_id'];
    $value->valor = $preco ;
    $value->atualizar();

    if($_GET['tipo'] == 1){

   $item_fech = new Fechamento;
            
    $item_fech->data                    = $hoje;
    $item_fech->status                  = 0;
    $item_fech->tipo                    = $_GET['tipo'];
    $item_fech->valor                   = $preco;
    $item_fech->usuarios_id             = $usuario_id;
    $item_fech->caixa_id                = $idcaixa;
    $item_fech->cadastar();
    }

    header('location: movimentacao-list.php?id='.$idcaixa);

    exit;
}
