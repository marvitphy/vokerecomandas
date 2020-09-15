

	<div class="col pedidos-main">
								<!-- RECENT PURCHASES -->
								<div class="panel">
									<div class="panel-heading">
											<h3 class="panel-title" style="font-size: 22px; font-weight: 600">Pedidos</h3>
										<div class="right">
											<button type="button" class=""><i class="fas fa-sync"></i></button>
											
										</div>
									</div>
									<div class="panel-body no-padding">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Número do Pedido</th>
													<th>Mesa</th>
													<th>Cliente</th>
													<th>Status</th>
													<th>Realizado</th>
													<th>Ações</th>
												</tr>
											</thead>
											<tbody class="dados-pedidos">
											    
											</tbody>
										</table>
									</div>
									<div class="panel-footer">
										<div class="row">
											<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Nas últimas 24h</span></div>
											<div class="col-md-6 text-right"><a href="#" class="btn btn-primary">Ver tudo</a></div>
										</div>
									</div>
								</div>
								<!-- END RECENT PURCHASES -->
							</div>
							
						
						</div>
					</div>
<script>
    $(document).ready(function(){
        $('.dados-pedidos').load('/views/pedidosMain.php')
                setInterval(function(){
                    $('.dados-pedidos').load('/views/pedidosMain.php')
                }, 3000)
    })
</script>
  