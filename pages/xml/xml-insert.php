<?php 

session_start();

require __DIR__.'../../../vendor/autoload.php';

define('TITLE','Novo Usuário');
define('BRAND','Cadastrar Usuário');

use App\Entidy\NotaFiscal;
use App\Entidy\Parcela;
use App\Entidy\Produto;
use App\Session\Login;

$usuariologado = Login:: getUsuarioLogado();

$usuario = $usuariologado['id'];

$data = date('Y-m-d');

Login::requireLogin();

if(isset($_POST['chave'])){
    
    $item = new NotaFiscal;
    $item->valoricms            = $_POST['valoricms'];
    $item->data                 = $_POST['emissao'];
    $item->chave                = $_POST['chave'];
    $item->autorizacao          = $_POST['autorizacao'];
    $item->notafiscal           = $_POST['notaFiscal'];
    $item->serie                = $_POST['serie'];
    $item->razaosocial          = $_POST['razaoSocial'];
    $item->cnpj                 = $_POST['cnpj'];
    $item->inscricaoestadual    = $_POST['InscricaoEstadual'];
    $item->bcicms               = $_POST['Bcicms'];
    $item->totalproduto         = $_POST['totalproduto'];
    $item->frete                = $_POST['frete'];
    $item->seguro               = $_POST['seguro'];
    $item->desconto             = $_POST['desconto'];
    $item->totalipi             = $_POST['totalipi'];
    $item->totalnota            = $_POST['totalnota'];
    $item->usuarios_id          = $usuario;

    $item->cadastar();

    $notaID = $item->id;

  
}


if (isset($_SESSION['parcelas'])) {
    foreach ($_SESSION['parcelas'] as $item) {

        $titulo           = $item['titulo'];
        $vencimento       = $item['vencimento'];
        $parcela          = $item['parcela'];

        $itemparcela = new Parcela;
        $itemparcela->titulo            = $titulo;        
        $itemparcela->parcela           = $parcela;        
        $itemparcela->vencimento        = $vencimento;        
        $itemparcela->notafiscal_id     = $notaID;      
        
        $itemparcela->cadastar();
    }

}


if (isset($_SESSION['produtos'])) {
    foreach ($_SESSION['produtos'] as $item) {

        $codigo             = $item['codigo'];
        $barra              = $item['barra'];
        $produto            = $item['produto'];
        $ncm                = $item['ncm'];
        $cfop               = $item['cfop'];
        $un                 = $item['un'];
        $qtd                = $item['qtd'];
        $valor_uni          = $item['valor_uni'];
        $bc_icms            = $item['bc_icms'];
        $valor_compra       = $item['valor_prod'];
        $valor_icms         = $item['valor_icms'];
        $valor_ipi          = $item['valor_ipi'];
        $icms               = $item['icms'];
        $ipi                = $item['ipi'];

        $val1              =  $qtd;
        $val2              = str_replace(".", "", $val1);
        $qtd_nota          = str_replace(",", ".",  $val2);

        $val3              = $valor_uni ;
        $val4              = str_replace(".", "", $val3);
        $preco             = str_replace(",", ".",  $val4);


        $itemproduto = new Produto;
        $itemproduto->data              = $_POST['emissao'];;        
        $itemproduto->codigo            = $codigo;        
        $itemproduto->barra             = $barra;        
        $itemproduto->nome              = $produto;        
        $itemproduto->ncm               = $ncm;        
        $itemproduto->cfop              = $cfop;      
        $itemproduto->un                = $un;      
        $itemproduto->estoque           = $qtd_nota;      
        $itemproduto->valor_uni         = $preco;      
        $itemproduto->bc_icms           = $bc_icms;      
        $itemproduto->valor_compra      = $preco;       
        $itemproduto->valor_venda       = $preco;       
        $itemproduto->valor_icms        = $valor_icms;      
        $itemproduto->valor_ipi         = $valor_ipi;      
        $itemproduto->ipi               = $ipi;      
        $itemproduto->icms              = $icms;      
        $itemproduto->categorias_id     = 123;      
        $itemproduto->notafiscal_id     = $notaID;      
        
        $itemproduto->cadastar();
     
    }


    header('location: xml-list.php?status=success');
    exit;

}



