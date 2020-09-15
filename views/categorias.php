<?php


include 'config.php';
session_start();
$id = $_SESSION['id'];
$sql = "SELECT * FROM categorias where user_id = '$id'";
$result = $db->query($sql);

?>

	<div class="col pedidos-main">
								<!-- RECENT PURCHASES -->
								<div class="panel">
									<div class="panel-heading">
											<h3 class="panel-title" style="font-size: 22px; font-weight: 600">Gerenciar Categorias</h3>
										<div class="right">
											<button type="button" style="background: #123ba3; padding: 10px; border-radius: 500px; color: white" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></button>
											
										</div>
									</div>
									<div class="panel-body no-padding">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Id</th>
													<th>Nome</th>
													<th>Descrição</th>
													<th>Ações</th>
            
												</tr>
											</thead>
											<tbody class="dados-categorias">
											    
											</tbody>
											<script>
											    $(document).ready(function(){
											        $('.actionDel').on('click', function(){
											            console.log('asdf')
                                                      
                                                    })
											    })
											</script>
										</table>
									</div>
									
								</div>
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
                                                          <span>Digite o nome:</span>
                                                        <input type="text" class="form-control nomeCat" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
                                                          <span>Digite a descrição:</span>
                                                        <input type="text" class="form-control descricaoCat" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="fechar btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="button" class="btn btn-primary salvarCat">Salvar</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                                <div class="modal fade" id="deletar" tabindex="-1" role="dialog" aria-labelledby="deletar" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Excluir Categoria</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <span class="confirmText">Tem certeza que deseja excluir a categoria&nbsp;</span>
                                                        
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="fechar btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="button" class="btn btn-danger excluirCat">Excluir</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                                <div class="modal fade" id="editarCategoria" tabindex="-1" role="dialog" aria-labelledby="deletar" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <span class="confirmText">Nome</span>
                                                            <input type="text" placeholder="Digite o novo nome da categoria" class="form-control nomeAtual">
                                                          <span class="confirmText">Descrição</span>
                                                            <input type="text" placeholder="Digite uma nova descrição para a categoria" class="form-control descAtual">
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="fechar btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="button" class="btn btn-primary editarCategoria">Editar</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
							</div>
							
						
						</div>
					</div>
<script>
    $(document).ready(function(){
        
        $('.actionDel').on('click', function(){
            console.log('oi')
        })
        
        function salvarCat(nome, descricao){
            
            $.ajax({
                url: "views/cruds.php",
                method: 'post',
                data: {nome: nome, descricao: descricao},
                success: function (response) {
            

                }
            });
        }
        
        $('.salvarCat').on('click', function(){
            
            
            if($('.nomeCat').val() == ''){
                alert('Preencha todos os campos')
            }else{
            $('.fechar').click();
            $('.app').load('/views/categorias.php')
            salvarCat($('.nomeCat').val(), $('.descricaoCat').val())
            }
          
            
    })
        
        
        
    
        $('.dados-categorias').load('/views/categoriasMain.php')
    })
</script>
  