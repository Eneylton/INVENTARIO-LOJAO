<?php

use App\Session\Login;

$usuariologado = Login::getUsuarioLogado();

$acesso = $usuariologado['acessos_id'];

$maximo = 0;

foreach ($grafico2 as $value) {
  
  $maximo += $value->total;

}

?>

<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-teal" style="display:<?php

                                                    switch ($acesso) {
                                                      case '2':
                                                        echo "";
                                                        break;
                                                      case '3':
                                                        echo "none";
                                                        break;
                                                      case '4':
                                                        echo "none";
                                                        break;

                                                      default:
                                                        echo "";
                                                        break;
                                                    }

                                                    ?>">
        <div class="inner">
          <p>Faturamento do Dia - <?php date_default_timezone_set('America/Sao_Paulo'); echo date('d/m/Y'); ?></p>
          <h3>R$ <?= number_format($geral_diaria ,"2",",",".") ?></h3>
        </div>
        <div class="icon">
          <i class="ion ion-cash"></i>
        </div>
        <a href="#" class="small-box-footer">Relatório <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-lime" style="display:<?php

                                                        switch ($acesso) {
                                                          case '2':
                                                            echo "none";
                                                            break;
                                                          case '3':
                                                            echo "";
                                                            break;
                                                          case '4':
                                                            echo "none";
                                                            break;

                                                          default:
                                                            echo "";
                                                            break;
                                                        }

                                                        ?>">
        <div class="inner">
        <p>Faturamento Mensal - <?php echo date('d/m/Y'); ?></p>
          <h3>R$ <?= number_format($total_mes,"2",",",".") ?></h3>
        </div>
        <div class="icon">
          <i class="ion ion-cash"></i>
        </div>
        <a href="#" class="small-box-footer">Relatórios <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">

      <!-- small box -->
      <div class="small-box bg-danger" style="display:<?php

                                                    switch ($acesso) {
                                                      case '2':
                                                        echo "none";
                                                        break;
                                                      case '3':
                                                        echo "none";
                                                        break;
                                                      case '4':
                                                        echo "none";
                                                        break;

                                                      default:
                                                        echo "";
                                                        break;
                                                    }

                                                    ?>">
        <div class="inner">
        <p>Despesas Diárias - <?php echo date('d/m/Y'); ?></p>
          <h3>R$ <?= number_format($despesadia,"2",",",".") ?></h3>
        </div>
        <div class="icon">
        <i class="fa fa-minus-circle" aria-hidden="true"></i>
        </div>
        <a href="#" class="small-box-footer">Relatórios <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-orange" style="display:<?php

                                                    switch ($acesso) {
                                                      case '2':
                                                        echo "";
                                                        break;
                                                      case '3':
                                                        echo "";
                                                        break;
                                                      case '4':
                                                        echo "";
                                                        break;

                                                      default:
                                                        echo "";
                                                        break;
                                                    }

                                                    ?>">
        <div class="inner">
        <p>Despesas Mensal - <?php echo date('d/m/Y'); ?></p>
          <h3>R$ <?= number_format($despesames,"2",",",".") ?></h3>
        </div>
        <div class="icon">
        <i class="fa fa-minus-circle" aria-hidden="true"></i>
        </div>
        <a href="#" class="small-box-footer">Relatórios <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-maroon" style="display:<?php

                                                    switch ($acesso) {
                                                      case '2':
                                                        echo "";
                                                        break;
                                                      case '3':
                                                        echo "";
                                                        break;
                                                      case '4':
                                                        echo "";
                                                        break;

                                                      default:
                                                        echo "";
                                                        break;
                                                    }

                                                    ?>">
        <div class="inner">
        <p>Contas a pagar - <?php echo date('d/m/Y'); ?></p>
          <h3>R$ <?= number_format($pagamento,"2",",",".") ?></h3>
        </div>
        <div class="icon">
        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
        </div>
        <a href="#" class="small-box-footer">Relatórios <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning" style="display:<?php

                                                    switch ($acesso) {
                                                      case '2':
                                                        echo "";
                                                        break;
                                                      case '3':
                                                        echo "";
                                                        break;
                                                      case '4':
                                                        echo "";
                                                        break;

                                                      default:
                                                        echo "";
                                                        break;
                                                    }

                                                    ?>">
        <div class="inner">
        <p>Contas a receber - <?php echo date('d/m/Y'); ?></p>
          <h3>R$ <?= number_format($recebimento,"2",",",".") ?></h3>
        </div>
        <div class="icon">
        <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
        </div>
        <a href="#" class="small-box-footer">Relatórios <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-navy" style="display:<?php

                                                    switch ($acesso) {
                                                      case '2':
                                                        echo "";
                                                        break;
                                                      case '3':
                                                        echo "";
                                                        break;
                                                      case '4':
                                                        echo "";
                                                        break;

                                                      default:
                                                        echo "";
                                                        break;
                                                    }

                                                    ?>">
        <div class="inner">
        <p>Inventário - <?php echo date('d/m/Y'); ?>  /  <span style="text-transform: uppercase; color:#8aff07">V. VENDA R$ <?= number_format($valor_total_compra,"2",",",".") ?></span>
          <span style="text-transform: uppercase;color:#56dfb6">Qtd prod [ <?= $valor_total_quantidade ?> ]</span></p>
          <h3>R$ <?= number_format($total_intario,"2",",",".") ?></h3>
       
        </div>
        <div class="icon">
        <i class="fa fa-indent" aria-hidden="true"></i>
        </div>
        <a href="#" class="small-box-footer">Relatórios <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-primary" style="display:<?php

                                                    switch ($acesso) {
                                                      case '2':
                                                        echo "";
                                                        break;
                                                      case '3':
                                                        echo "";
                                                        break;
                                                      case '4':
                                                        echo "";
                                                        break;

                                                      default:
                                                        echo "";
                                                        break;
                                                    }

                                                    ?>">
        <div class="inner">
        <p>Lucro parcial - <?php echo date('d/m/Y'); ?></p>
          <h3>R$ <?= number_format($lucro,"2",",",".") ?></h3>
        </div>
        <div class="icon">
        <i class="fa fa-credit-card" aria-hidden="true"></i>
        </div>
        <a href="#" class="small-box-footer">Relatórios <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-6 col-6">
    <div class="card-body" style="background:#eeeeee">
                  <div class="d-flex">
                     <p class="d-flex flex-column">
                        
                     <span class="text-muted">PRODUTOS MAIS VENDIDOS</span>
                     </p>
                     <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-info">
                           <i class="fas fa-arrow-up"></i> &nbsp; 
                        </span>
                        <span class="text-muted">PRODUTOS MAIS VENDIDOS</span>
                     </p>
                  </div>
                  <!-- /.d-flex -->

                  <div class="card-body">

                     <canvas id="myChart" width="400" height="130"></canvas> 

                  </div>
               </div>
    </div>

    <div class="col-lg-6 col-6">

    <div class="card-body" style="background:#eeeeee">
                  <div class="d-flex">
                     <p class="d-flex flex-column">
                        <span style="color:#000" class="grande">Acumulado no mês</span>
                     </p>
                     <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-info grande">
                           <i class="fas fa-arrow-up grande"></i> &nbsp;<span style="font-size:22px"> R$ <?= number_format($maximo,"2",",",".") ?> </sapn>
                        </span>
                      
                     </p>
                  </div>
                  <!-- /.d-flex -->

                  <div class="card-body">

                     <canvas id="myChart2" width="400" height="130"></canvas>

                  </div>
               </div>
    </div>

  </div>
</div>