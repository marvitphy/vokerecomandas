								<?php


include 'config.php';

$sql = "SELECT * FROM pedidos";
$result = $db->query($sql);?>

	<div class="col">
								<!-- RECENT PURCHASES -->
								<div class="panel">
									<div class="panel-heading">
										<h3 class="panel-title" style="font-size: 22px; font-weight: 600">Gerenciar Mesas</h3>
									</div>
									<div class="panel-body ">
									    <i class="fas fa-circle text-warning"></i> <span> Garçom solicitado</span>
									    <i class="fas fa-circle text-primary"></i> <span> Pagar conta</span>
									    <i class="fas fa-circle text-success"></i> <span> Pedido realizado</span>
									    
										<div style="margin-top: 15px" class="row mesasAll">
                                              
                                            </div>
									</div>
								</div>
								<!-- END RECENT PURCHASES -->
							</div>
							
						
						</div>
				
<script>
    $(document).ready(function(){
        $('.mesasAll').load('/views/mesasAll.php')
        setInterval(function(){
            $('.mesasAll').load('/views/mesasAll.php')
        },3000)
    })
</script>
  