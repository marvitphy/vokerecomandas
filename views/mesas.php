

								
								<?php


include 'config.php';
session_start();
$id = $_SESSION['id'];
$sql = "SELECT * FROM mesas where user_id = '$id'";
$sql_2 = "SELECT * FROM users where id = '$id'";
$result_2 = mysqli_query($db,$sql_2);
$data = mysqli_fetch_array($result_2);
$link = $data['link'];
$result = $db->query($sql);
$rows_qtd = mysqli_num_rows($result);
?>

	<div class="col">
								<!-- RECENT PURCHASES -->
								<div class="panel">
									<div class="panel-heading">
											<h3 class="panel-title" style="font-size: 22px; font-weight: 600">Mesas Cadastradas</h3>
										<div class="right">
										
										    
										</div>
									</div>
									<div class="panel-body no-padding">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>N. da Mesa</th>
													<th>Qr Code</th>
													<th>Ações</th>
												</tr>
											</thead>
											<tbody>
											    
											    <?php if($rows_qtd <= 0 ){ ?>
											    
											    <tr>
											        
													<td class="mesa-num">0</td>
													<td><a class="btn btn-success">Nenhuma mesa cadastrada</a></td>
			
													<td class="">Nenhuma mesa cadastrada</td>
												</tr>
											    <?php }?>
											    <?php while($row = $result->fetch_assoc()) { ?> 
											    
												<tr class="mesas">
													<td class="mesa-num"><a><?php echo $row['numero_mesa']?></a></td>
													<td><a class="btn btn-success btn-baixar">Baixar</a></td>
			
													<td class=""><i class="f7-icons btn-printer text-danger">trash</i></td>
												</tr>
												
												<?php } ?>
												<span style="opacity: 0" class="link_url"><?php echo $link ?></span>
											</tbody>
										</table>
									</div>
									<div class="panel-footer">
										<div class="row">
											<div class="col-md-6"><span class="panel-note"><i class="fas fa-dice-d6"></i> Por segurança, cada mesa tem um Qr Code</span></div>
											<div class="col-md-6 text-right addMesa"><a class="btn btn-primary">Adicionar Mesa</a></div>
										</div>
									</div>
								</div>
								<!-- END RECENT PURCHASES -->
							</div>
							
						
						</div>
					</div>
								<!-- END RECENT PURCHASES -->
							</div>
							
						
						</div>
					</div>
<script>
    $(document).ready(function(){
        
         $('.btn-baixar').on('click', function(){
             var link_2 = $('.link_url').text()
            
            var numMesa = $(this).closest('.mesas').find('.mesa-num').text()
            window.open('https://api.qrserver.com/v1/create-qr-code/?size=1000x1000&data=http://www.vcomandas.com/c/'+ link_2 +'/' + numMesa)
        })
        
        var mesaNum = parseInt($('.mesa-num').last().text()) + 1
        
        $('.addMesa').on('click', function(){
          alert('Mesa cadastrada: ' + mesaNum)
            window.location.reload()
             $.ajax({
                url: "views/cruds.php",
                method: 'post',
                data: {mesa: mesaNum},
                success: function (response) {

                }
            }); 
        })
        
    })
</script>
  