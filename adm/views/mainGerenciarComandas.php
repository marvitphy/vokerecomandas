

	<div class="col">
								<!-- RECENT PURCHASES -->
								<div class="panel" style="display: none">
									<div class="panel-heading">
											<h3 class="panel-title" style="font-size: 22px; font-weight: 600">Comandas Em Andamento</h3>
										<div class="right">
											<button type="button" class=""><i class="fas fa-sync"></i></button>
											
										</div>
									</div>
									<div class="panel-body">
									<form>
                                          <div class="row">
                                            <div class="col">
                                              <input type="text" class="form-control" placeholder="Nome da Categoria">
                                            </div>
                                            <div class="col">
                                              <input type="text" class="form-control" placeholder="Descrição da Categoria">
                                            </div>
                                          </div>
                            
                                        </form>
									</div>
									<div class="panel-footer">
										<div class="row">
											<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Nas últimas 24h</span></div>
											<div class="col-md-6 text-right"><button class="btn btn-success btn block">Salvar</button></div>
										</div>
									</div>
								</div>
								
								<?php


include 'config.php';

$sql = "SELECT * FROM pedidos";
$result = $db->query($sql);?>

	<div class="col">
								<!-- RECENT PURCHASES -->
								<div class="panel">
									<div class="panel-heading">
											<h3 class="panel-title" style="font-size: 22px; font-weight: 600">Categorias Cadastradas</h3>
										<div class="right">
											<button type="button" style="bakground: green; padding: 5px; border-radius: 50px;"><i class="fas fa-plus"></i></button>
											
										</div>
									</div>
									<div class="panel-body no-padding">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Id da Categoria</th>
													<th>Nome</th>
													<th>Mesa</th>
													<th>Detalhes</th>
										
													<th>Ações</th>
												</tr>
											</thead>
											<tbody>
											    <?php while($row = $result->fetch_assoc()) { ?> 
												<tr>
													<td><a href="#"><?php echo $row['id']?></a></td>
													<td><?php echo $row['produtos']?></td>
													<td class="btn-danger text-center"><?php echo $row['mesa']?></td>
													<td class="text-center"><i class="fas fa-eye text-info"></td>
													<td class="text-center"><i class="fas fa-pen text-success"></i><i class="f7-icons btn-printer text-danger">trash</i></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
									<div class="panel-footer">
										<div class="row">
											<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Nas últimas 24h</span></div>
											<div class="col-md-6 text-right"><a href="#" class="btn btn-primary">Adicionar Categorias</a></div>
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

  