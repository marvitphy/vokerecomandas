<?php 



include 'config.php';
session_start();
                $e_c = $_SESSION['email_cliente'];
                $data_temp = mysqli_query($db, "SELECT * from pedidos_temp where email = '$e_c' order by id asc");
                while($rows_temp = mysqli_fetch_assoc($data_temp)){
                
            ?>
            <section class="produto container card bg-dark rounded row mt-1 pt-2" >
			<div class="item text-white "><span class="nomeProduto"><?php echo $rows_temp['nome_produto'] ?></span><br> <small><?php echo $rows_produtos['descricao']; ?></small><br><small class="text-warning preco font-weight-bold"><?php echo 'R$' . number_format($rows_temp['preco'], 2, ',', '.');  ?></small>
				<small class="text-warning preco font-weight-bold" style="opacity: 0; font-weight: 1px"><?php echo $rows_temp['preco'];  ?></small>
				<small style="width: 0px; height: 0px; font-size: 0px;" class="detalhes" ><?php echo $rows_temp['detalhes']?></small>
			</div>
			<div class=" pt-4">
				<?php if (!is_array($fetch_op)){ ?>
					<span class="btn btn-success pt-1 pb-1 btn-sm text-white pedir" style="font-size: 18px">Finalizar</span>	<span class="btn btn-danger pt-1 pb-1 btn-sm text-white" style="font-size: 18px"> <i class="fas fa-trash"></i></span>
				<?php } else { ?>
					<i class="text-success fas fa-bars show-op"></i>
				<?php } ?>

                </div>
		</section>
		
            <?php } ?>
            
            <div style="width: 100%; bottom: 15px; position: fixed;" class="text-center text-dark"> <div class="btn btn-danger shadow finalizar" style="border-radius: 25px">Finalizar Pedido</div></div>
            
            
            
            <script>
                $(document).ready(function(){
                    var lista_pedido = []
                    var nome_produto
                    var detalhes_produto
                    var preco
                    var userid = <?php echo $rows_user['id']?>
                    var cliente = '<?php echo $_SESSION['username'] ?>'
                  $('.pedir').click(function(){
                      nome_produto = $(this).closest('.produto').find('.nomeProduto').text()
                      detalhes_produto = $(this).closest('.produto').find('.detalhes').text()
                      preco = $(this).closest('.produto').find('.preco').text()
                       $.ajax({
                        url: "../addPedido.php",
                        method: 'post',
                        data: {
                            cliente: cliente
                        },
                        success: function(response) {
                            alert('Pedido Finalizado com sucesso!')
                        }
                    });
                  }) 
                });
            </script>