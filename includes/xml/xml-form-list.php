<?php

$_SESSION['parcelas'] = array();
$_SESSION['produtos'] = array();

if (isset($_GET['status'])) {

   switch ($_GET['status']) {
      case 'success':
         $icon  = 'success';
         $title = 'Parabéns';
         $text = 'ARQUIVO XML IMPORTADO COM SUCESSO !!!';
         break;

      case 'del':
         $icon  = 'error';
         $title = 'Parabéns';
         $text = 'Esse usuário foi excluido !!!';
         break;

      case 'edit':
         $icon  = 'warning';
         $title = 'Parabéns';
         $text = 'Cadastro atualizado com sucesso !!!';
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
$resultados2 = '';
$parcela = 0;
$contador = 0;
$ocultar = "";
$ocultar2 = "";
$titulo2 = "";
$emissao = "";
$barra = "";
$data_emissao  = "";
$data  = "";

if (!empty($xml->NFe->infNFe->cobr->dup)) {

   $emissao =  $xml->NFe->infNFe->ide->dhEmi;

   $data_emissao = date('Y-m-d', strtotime($emissao));
   $data = date('d/m/Y', strtotime($emissao));

   foreach ($xml->NFe->infNFe->cobr->dup as $dup) {

      $parcela = number_format((float) $dup->vDup, 2, ",", ".");
      $vencimento = strval($dup->dVenc);
      $titulo2 = strval($dup->nDup);

      $resultados .= '<tr>
            <td>' . $titulo2 . '</td>
            <td class="caixa-alta">' . date('d/m/Y', strtotime($vencimento)) . '</td>
            <td class="caixa-alta ">R$ ' . $parcela . '</td>


            </tr>';

      array_push(
         $_SESSION['parcelas'],

         array(

            'parcela'                 =>  $parcela,
            'vencimento'              =>  $vencimento,
            'titulo'                  =>  $titulo2

         )
      );
   }

   $resultados = strlen($resultados) ? $resultados : '<tr>
                                                     <td colspan="3" class="text-center" > Nenhuma resultado encontrado !!!!! </td>
                                                     </tr>';
}

if (!empty($xml->NFe->infNFe->det)) {
   foreach ($xml->NFe->infNFe->det as $item) {
      $contador += 1;
      $codigo       = strval($item->prod->cProd);
      $xProd        = strval($item->prod->xProd);
      $NCM          = strval($item->prod->NCM);
      $barra        = strval($item->prod->cEAN);
      $CFOP         = strval($item->prod->CFOP);
      $uCom         = strval($item->prod->uCom);
      $qCom         = strval($item->prod->qCom);
      $qCom         = number_format((float) $qCom, 2, ",", ".");
      $vUnCom       = strval($item->prod->vUnCom);
      $vUnCom       = number_format((float) $vUnCom, 2, ",", ".");
      $vProd        = strval($item->prod->vProd);
      $vProd        = number_format((float) $vProd, 2, ",", ".");
      $vBC_item     = $item->imposto->ICMS->ICMS00->vBC;
      $icms00       = $item->imposto->ICMS->ICMS00;
      $icms10       = $item->imposto->ICMS->ICMS10;
      $icms20       = $item->imposto->ICMS->ICMS20;
      $icms30       = $item->imposto->ICMS->ICMS30;
      $icms40       = $item->imposto->ICMS->ICMS40;
      $icms50       = $item->imposto->ICMS->ICMS50;
      $icms51       = $item->imposto->ICMS->ICMS51;
      $icms60       = $item->imposto->ICMS->ICMS60;
      $ICMSSN102    = $item->imposto->ICMS->ICMSSN102;
      if (!empty($ICMSSN102)) {
         $bc_icms = "0.00";
         $pICMS = "0	";
         $vlr_icms = "0.00";
      }


      if (!empty($icms00)) {
         $bc_icms = $item->imposto->ICMS->ICMS00->vBC;
         $bc_icms = number_format((float) $bc_icms, 2, ",", ".");
         $pICMS = $item->imposto->ICMS->ICMS00->pICMS;
         $pICMS = round($pICMS, 0);
         $vlr_icms = $item->imposto->ICMS->ICMS00->vICMS;
         $vlr_icms = number_format((float) $vlr_icms, 2, ",", ".");
      }
      if (!empty($icms20)) {
         $bc_icms = $item->imposto->ICMS->ICMS20->vBC;
         $bc_icms = number_format((float) $bc_icms, 2, ",", ".");
         $pICMS = $item->imposto->ICMS->ICMS20->pICMS;
         $pICMS = round($pICMS, 0);
         $vlr_icms = $item->imposto->ICMS->ICMS20->vICMS;
         $vlr_icms = number_format((float) $vlr_icms, 2, ",", ".");
      }
      if (!empty($icms30)) {
         $bc_icms = "0.00";
         $pICMS = "0	";
         $vlr_icms = "0.00";
      }
      if (!empty($icms40)) {
         $bc_icms = "0.00";
         $pICMS = "0	";
         $vlr_icms = "0.00";
      }
      if (!empty($icms50)) {
         $bc_icms = "0.00";
         $pICMS = "0	";
         $vlr_icms = "0.00";
      }
      if (!empty($icms51)) {
         $bc_icms = $item->imposto->ICMS->ICMS51->vBC;
         $pICMS = $item->imposto->ICMS->ICMS51->pICMS;
         $pICMS = round($pICMS, 0);
         $vlr_icms = $item->imposto->ICMS->ICMS51->vICMS;
      }
      if (!empty($icms60)) {
         $bc_icms = "0,00";
         $pICMS = "0";
         $vlr_icms = "0,00";
      }
      $IPITrib = $item->imposto->IPI->IPITrib;
      if (!empty($IPITrib)) {
         $bc_ipi = $item->imposto->IPI->IPITrib->vBC;
         $bc_ipi = number_format((float) $bc_ipi, 2, ",", ".");
         $perc_ipi =  $item->imposto->IPI->IPITrib->pIPI;
         $perc_ipi = round($perc_ipi, 0);
         $vlr_ipi = $item->imposto->IPI->IPITrib->vIPI;
         $vlr_ipi = number_format((float) $vlr_ipi, 2, ",", ".");
      }
      $IPINT = $item->imposto->IPI->IPINT; {
         $bc_ipi = "0,00";
         $perc_ipi =  "0";
         $vlr_ipi = "0,00";
      }


      $resultados2 .= '<tr>

      <td>' . $contador . '</td>
      <td class="caixa-alta">  ' .   $codigo . '</td>
      <td class="caixa-alta">  ' .   $barra . '</td>
      <td class="caixa-alta "> ' .   $xProd  . '</td>
      <td class="caixa-alta "> ' .   $NCM . '</td>
      <td class="caixa-alta "> ' .   $CFOP . '</td>
      <td class="caixa-alta "> ' .   $uCom . '</td>
      <td class="caixa-alta "> ' .   $qCom . '</td>
      <td class="caixa-alta ">R$ ' . $vUnCom . '</td>
      <td class="caixa-alta ">R$ ' . $vProd . '</td>
      <td class="caixa-alta ">R$ ' . $bc_icms . '</td>
      <td class="caixa-alta ">R$ ' . $vlr_icms  . '</td>
      <td class="caixa-alta ">R$ ' . $vlr_ipi . '</td>
      <td class="caixa-alta "> ' .   $pICMS . ' %</td>
      <td class="caixa-alta "> ' .   $perc_ipi . ' %</td>
      </tr>';

      array_push(
         $_SESSION['produtos'],

         array(

            'codigo'                 =>  $codigo,
            'produto'                =>  $xProd,
            'ncm'                    =>  $NCM,
            'cfop'                   =>  $CFOP,
            'un'                     =>  $uCom,
            'qtd'                    =>  $qCom,
            'valor_uni'              =>  $vUnCom,
            'bc_icms'                =>  $vProd,
            'valor_prod'             =>  $bc_icms,
            'valor_icms'             =>  $vlr_icms,
            'valor_ipi'              =>  $vlr_ipi,
            'icms'                   =>  $pICMS,
            'barra'                  =>  $barra,
            'emissao'                =>  $data_emissao,
            'ipi'                    =>  $perc_ipi

         )
      );
   }
}

$resultados2 = strlen($resultados2) ? $resultados2 : '<tr>
                                               <td colspan="14" class="text-center" > Nenhuma resultado encontrado !!!!! </td>
                                               </tr>';

if ($chave != "") {
   $ocultar = 'class="card-body caixa-alta "';
} else {
   $ocultar = 'class="card-body caixa-alta ocultar "';
}

if ($chave != "") {
   $ocultar2 = 'class="card-body caixa-alta ocultar "';
} else {
   $ocultar2 = 'class="card-body caixa-alta "';
}


?>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card back-black">
               <div class="card-header">
                  <div class="modal-body">
                     <form id="form1" action="xml-list.php" method="post" enctype="multipart/form-data">
                        <div class="row">

                           <div class="col-6">

                              <input type="file" name="arquivo" class="form-control" value="" id="imagem" name="arquivo">

                           </div>

                           <div class=" col-6">

                              <button type="submit" class="btn btn-primary">CARREGAR XML</button>

                           </div>

                        </div>
                     </form>
                  </div>
                  <form id="form2" action="xml-insert.php" method="post">




                     <div <?= $ocultar ?>>
                        <div class="row">

                           <div class="col-12 info-nota"><span>DADOS DA NOTA FISCAL</span></div>

                           <div class="col-4">
                              </br>
                              <div class="form-group">
                                 <label>Chave de Acesso da NFE </label>
                                 <p>
                                    <span class="amarelo"><?php echo $chave ?></span>
                                    <input type="hidden" value="<?php echo $chave ?>" name="chave">
                              </div>

                           </div>

                           <div class="col-2">
                              </br>
                              <div class="form-group">
                                 <label>Prot. Autorização de uso</label>
                                 <p>
                                    <span class="amarelo"><?php echo $nProt ?></span>
                                    <input type="hidden" value="<?php echo $nProt ?>" name="autorizacao">
                              </div>
                           </div>
                           <div class="col-2">
                              </br>
                              <div class="form-group">
                                 <label>Nº da Nota Fiscal</label>
                                 <p>
                                    <span class="amarelo"><?php echo $nNF ?></span>
                                    <input type="hidden" value="<?php echo $nNF ?>" name="notaFiscal">
                              </div>
                           </div>
                           <div class="col-2">
                              </br>
                              <div class="form-group">
                                 <label>Série</label>
                                 <p>
                                    <span class="amarelo"><?php echo $serie ?><span>
                                          <input type="hidden" value="<?php echo $serie ?>" name="serie">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 info-nota"><span>DADOS DO FORNECEDOR</span></div>

                           <div class="col-3">
                              </br>
                              <div class="form-group caixa-alta">
                                 <label>Nome / Razão Social</label>
                                 <p>
                                    <span class="amarelo"><?php echo $emit_xNome ?></span>
                                    <input type="hidden" value="<?php echo $emit_xNome ?>" name="razaoSocial">
                              </div>

                           </div>

                           <div class="col-3">
                              </br>
                              <div class="form-group">
                                 <label>CNPJ / CPF</label>
                                 <p>
                                    <span class="amarelo"><?php echo $emit_CNPJ  ?></span>
                                    <input type="hidden" value="<?php echo $emit_CNPJ ?>" name="cnpj">

                              </div>
                           </div>
                           <div class="col-3">
                              </br>
                              <div class="form-group">
                                 <label>Inscrição Estadual</label>
                                 <p>
                                    <span class="amarelo"><?php echo $emit_IE ?></span>
                                    <input type="hidden" value="<?php echo $emit_IE ?>" name="InscricaoEstadual">
                              </div>
                           </div>
                           <div class="col-3">
                              </br>
                              <div class="form-group">
                                 <label>Data Emissão</label>
                                 <p>
                                    <span class="amarelo"><?= $data  ?></span>
                                    <input type="hidden" value="<?php echo $emissao ?>" name="emissao">

                              </div>
                           </div>

                        </div>

                        <div class="row">
                           <div class="col-12 info-nota"><span>TOTAIS</span></div>

                           <div class="col-2">
                              </br>
                              <div class="form-group caixa-alta">
                                 <label>BC do ICMS</label>
                                 <p>
                                    <span class="amarelo">R$ <?php echo $vBC ?></span>
                                    <input type="hidden" value="<?php echo $vBC ?>" name="Bcicms">
                              </div>

                           </div>

                           <div class="col-2">
                              </br>
                              <div class="form-group">
                                 <label>Valor do ICMS</label>
                                 <p>
                                    <span class="amarelo">R$ <?php echo $vICMS  ?></span>
                                    <input type="hidden" value="<?php echo $vICMS ?>" name="valorIcms">
                              </div>
                           </div>
                           <div class="col-2">
                              </br>
                              <div class="form-group">
                                 <label>BC ICMS ST</label>
                                 <p>
                                    <span class="amarelo">R$ <?php echo $vBCST ?></span>
                                    <input type="hidden" value="<?php echo $vBCST ?>" name="bcicmsst">

                              </div>
                           </div>
                           <div class="col-2">
                              </br>
                              <div class="form-group">
                                 <label>Valor do ICMS ST</label>
                                 <p>
                                    <span class="amarelo">R$ <?php echo $vST ?></span>
                                    <input type="hidden" value="<?php echo $vST ?>" name="valoricms">
                              </div>
                           </div>
                           <div class="col-3">
                              </br>
                              <div class="form-group">
                                 <label>Vl Total dos Produtos</label>
                                 <p>
                                    <span class="amarelo">R$ <?php echo $vProd ?></span>
                                    <input type="hidden" value="<?php echo $vProd ?>" name="totalproduto">
                              </div>
                           </div>

                           <div class="col-2">
                              </br>
                              <div class="form-group caixa-alta">
                                 <label>Valor do Frete</label>
                                 <p>
                                    <span class="amarelo">R$ <?php echo $vFrete ?></span>
                                    <input type="hidden" value="<?php echo $vFrete ?>" name="frete">
                              </div>

                           </div>

                           <div class="col-2">
                              </br>
                              <div class="form-group">
                                 <label>Valor do Seguro</label>
                                 <p>
                                    <span class="amarelo">R$ <?php echo $vSeg  ?></span>
                                    <input type="hidden" value="<?php echo $vSeg ?>" name="seguro">
                              </div>
                           </div>
                           <div class="col-2">
                              </br>
                              <div class="form-group">
                                 <label>Desconto</label>
                                 <p>
                                    <span class="amarelo">R$ <?php echo $vDesc ?></span>
                                    <input type="hidden" value="<?php echo $vDesc ?>" name="desconto">
                              </div>
                           </div>
                           <div class="col-2">
                              </br>
                              <div class="form-group">
                                 <label>Vl Total do IPI</label>
                                 <p>
                                    <span class="amarelo">R$ <?php echo $vIPI ?></span>
                                    <input type="hidden" value="<?php echo $vIPI  ?>" name="totalipi">
                              </div>
                           </div>
                           <div class="col-3">
                              </br>
                              <div class="form-group">
                                 <label>VL Total da Nota</label>
                                 <p>
                                    <span class="prod-verde">R$ <?php echo $vNF ?></span>
                                    <input type="hidden" value="<?php echo $vNF  ?>" name="totalnota">
                              </div>
                           </div>

                           <div class="col-12 info-nota"><span>FATURA / DUPLICADA</span>
                              <p>
                           </div>
                           <div class="col-12">

                              <table class="table table-dark table-hover table-bordered table-striped">
                                 <thead>
                                    <tr>
                                       <th style="width: 30px;">PARCELAS</th>
                                       <th>DATA</th>
                                       <th style="text-align: esqueda; width: 200px;">VALOR</th>

                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?= $resultados ?>

                              </table>

                           </div>

                           <div class="col-12 info-nota" style="margin-top: 30px;"><span>ITENS DA NOTA</span>
                              <p>
                           </div>
                           <div class="col-12">

                              <table class="table table-dark table-hover table-bordered table-striped">
                                 <thead>
                                    <tr>
                                       <th>Nº</th>
                                       <th>CÓDIGO</th>
                                       <th>BARRA</th>
                                       <th>DESCRIÇÃO DOS PRODUTOS</th>
                                       <th>NCM</th>
                                       <th>CFOP</th>
                                       <th>UN</th>
                                       <th>QTD</th>
                                       <th>VL. UNI</th>
                                       <th>VAL. PRODUTO</th>
                                       <th>BC ICMS</th>
                                       <th>VL. ICMS</th>
                                       <th>VL. IPI</th>
                                       <th>% ICMS</th>
                                       <th>% IPI</th>

                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?= $resultados2 ?>

                              </table>

                           </div>


                           <div class="col-12">

                              <button type="submit" class="btn btn-success float-right">SALVAR NOTA FISCAL</button>

                           </div>

                        </div>



                     </div>

                     <div <?= $ocultar2 ?>>
                        <div class="col-12 centro altura-100">

                           <img src="../../imgs/nota-fiscal.png" alt="">
                        </div>


                     </div>

                  </form>

               </div>

            </div>
            </form>

         </div>

      </div>

   </div>

</section>