<?php

require __DIR__ . '../../../vendor/autoload.php';

$dados = '';

$dados .= '    

               <div class="row">
                  <div class="col-6">
                     <div class="form-group">
                        <label>Código de Barras</label>
                        <input type="text" class="form-control" name="nome" autofocus>
                     </div>
                  </div>
                 


';

$retorna = ['erro' => false, 'dados' => $dados];

echo json_encode($retorna);
