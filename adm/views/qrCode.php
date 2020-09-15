<?php 

include 'config.php';
session_start();
$id = $_SESSION['id'];

$sql = "SELECT link FROM users WHERE id='$id'";
$result = $db->query($sql);
$dados = mysqli_fetch_assoc($result);

$sql_2 = "SELECT link FROM users WHERE id='$id'";
$result_2 = $db->query($sql);
$dados_2 = mysqli_fetch_assoc($result);


$rows = mysqli_num_rows($dados);


?>

	<div id="print" class="col cadastrarLink">
								<!-- RECENT PURCHASES -->
								<div class="panel">
									<div class="panel-heading">
											<h3 class="panel-title" style="font-size: 22px; font-weight: 600">Gerar Qr Code</h3>
										<div class="right">
											<button type="button" class=""><i class="fas fa-sync"></i></button>
											
										</div>
									</div>
									<div class="panel-body">
									    <?php if($dados['link'] == ''){ ?>
									    <form>
									        
									        <div class="form-group">
									            <h3>Defina o link do seu estabelecimento<?php echo $dados['id']; ?> </h3>
									            <hr class="text-dark">
									            <span style="color: black; font-size: 18px">Exemplo: <small>MeuRestaurante</small> <input type="text" class="form-control url" style="margin-top: 10px; border-radius: 25px; border: 2.2px solid gray" placeholder="Digite o nome do seu link"></span>
									            <span class="mt-2 result text-dark"></span><br>
									            
									        </div>
									        <span class="btn btn-success rounded cadastrar-link" style="display: none">Cadastrar link</span>
									    </form><br><?php }else{?>
									    <span style="border-radius: 15px; color: white; font-family: roboto; background: #bf132a; padding: 5px 15px 5px 15px">Seu link: <span class="urlCompleto">www.vcomandas.com/c/<?php echo $dados['link']?> </span></span><span style="border-radius: 15px; color: white; font-family: roboto; padding: 5px 15px 5px 15px; margin-left: 8px;" class="ml-3 btn btn-primary edit" data-toggle="modal" data-target="#exampleModal">Editar</span>
									    <a href="<?php echo '/c/'.$dados['link'];?>"style="border-radius: 15px; color: white; font-family: roboto; padding: 5px 15px 5px 15px; margin-left: 8px;" class="ml-3 btn btn-success">Acessar</a> <br><br>
									    <div id="qr">
										<img width="100px"  class="qrCodeImg"src="https://api.qrserver.com/v1/create-qr-code/?size=1000x1000&data=<?php echo 'www.vcomandas.com/c/'.$dados['link'];?>"> </div><br><br>
										<span class="btn btn-success print">Baixar <i class="fas fa-download"></i></span>
										
						
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Link</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <span>Digite o novo link:</span>
                                                        <input type="text" class="form-control novoLink" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="button" class="btn btn-primary editarLink">Salvar</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
										<?php }?>
									</div>
									
								</div>
								<!-- END RECENT PURCHASES -->
							</div>
							
						
						</div>
					</div>
					
<script>
$(document).ready(function(){
    function printDiv(div) 
{

  var divToPrint=document.getElementById(div);

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
    $('.print').on('click', function(){
        var urlCompleto = $('.qrCodeImg').attr('src')
         window.open(urlCompleto, '_blank');
    })
        var link 
        
        $('.edit').click(function(){
            window.location.hash = 'qrcode'
        })
    $('.cadastrar-link').on('click', function(){
        $( ".app" ).load('views/qrCode.php' );
        link = $('.url').val();
            $.ajax({
                url: "views/cadastrarLink.php",
                method: 'post',
                data: {link: link},
                success: function (response) {
                   alert(response)
                   $('.cadastrarLink').load('.cadastrarLink')

                }
            });
    })

    $('.editarLink').on('click', function(){
       
        link = $('.novoLink').val();
        
        window.location.reload()
        $('.app').load('views/qrCode.php')
            $.ajax({
                url: "views/editarQr.php",
                method: 'post',
                data: {link: link},
                success: function (response) {
                    alert(response)
                   
                    

                }
            });
    })
    
    $('.url').keydown(function(e) {
        if(e.keyCode=='192')
            return false;
        
        });
        
    $('.url').on('keyup', function(){
            $('.cadastrar-link').show('slow');
         this.value = this.value.replace(/\s/g,'');
      
        $('.result').html('Como ficará: www.vcomandas.com/' + '<b>' +$('.url').val() + '</b>')
    })
    
    
})
</script>
  