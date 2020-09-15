<?php


include 'config.php';
session_start();
$email = $_SESSION['email'];
$sql = "SELECT * FROM users where email = '$email'";
$result = $db->query($sql);
$rows = mysqli_fetch_array($result);

?>
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<?php include 'navbarDash.php'?>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<?php include 'sidebarDash.php'?>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid app">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Dashboard</h3>
							<!-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> -->
						</div>
						<div class="panel-body">
						    
							<div class="row">
								<div class="col-md-4">
									<div class="metric">
										<span class="icon"><i class="fa fa-shopping-bag"></i></span>
										<p>
											<span class="number">1,252</span>
											<span class="title">Pedidos</span>
										</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="metric">
										<span class="icon"><i class="fas fa-scroll"></i></span>
										<p>
											<span class="number">203</span>
											<span class="title">Comandas</span>
										</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="metric">
										<span class="icon"><i class="fas fa-users"></i> </span>
										<p>
											<span class="number">274,678</span>
											<span class="title">Clientes</span>
										</p>
									</div>
								</div>

							</div>
</div></div>
						
					<!-- END OVERVIEW -->
					<div >
					    <div class="pedidos_ver"></div>
						
						<div class="col">
							<!-- MULTI CHARTS -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Controle de Pedidos</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<div id="visits-trends-chart" class="ct-chart"></div>
								</div>
							</div>
							<!-- END MULTI CHARTS -->
						</div>
					</div>
					<div class="row">

					</div>
					<div class="row">
					
						<!--<div class="col-md-5">
							 VISIT CHART 
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Website Visits</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<div id="visits-chart" class="ct-chart"></div>
								</div>
							</div>-->
							<!-- END VISIT CHART -->
						</div>
						<!--		<div class="col-md-4">
							
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">System Load</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<div id="system-load" class="easy-pie-chart" data-percent="70">
										<span class="percent">70</span>
									</div>
									<h4>CPU Load</h4>
									<ul class="list-unstyled list-justify">
										<li>High: <span>95%</span></li>
										<li>Average: <span>87%</span></li>
										<li>Low: <span>20%</span></li>
										<li>Threads: <span>996</span></li>
										<li>Processes: <span>259</span></li>
									</ul>
								</div>
							</div>
							 END REALTIME CHART -->
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="" style="display: flex; align-items: center; justify-content: center;"><img id="img" src="https://gutta.lv/wp-content/uploads/2015/10/test-img.jpg" height="80px" width="80px" style="border-radius: 150px"></div>
        <span style="margin-top: 10px; display: flex; align-items: center; justify-content: center;" class="btn btn-success"><input type="file" id="upload" placeholder="Editar Foto"></span><br>
        <span class="text-dark text-capitalize"><b>Nome do responsável:</b> <?php echo $rows['nomeResponsavel'].$rows['sobrenomeResponsavel'];?></span><br>
        <span class="text-dark"><b>Nome da empresa:</b> <?php echo $rows['nomeEmpresa'];?></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
			<!-- END MAIN CONTENT -->
		</div>
		
		
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; <?php echo date('Y'); ?> <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	
	
	<script>
	
	    $(document).ready(function(){
	        
	       $.getJSON('https://ipinfo.io/geo', function(response) {
    var loc = response.loc.split(',');
    var coords = {
        latitude: loc[0],
        longitude: loc[1]
    };
    
    console.log(coords)
});
	        
	        
	        $('#upload').change(function(){
	            const file = $(this)[0].files[0]
	            const fileReader = new FileReader()
	            fileReader.onloadend = function(){
	                $('#img').attr('src', fileReader.result)
	            }
	            fileReader.readAsDataURL(file)
	        })
	    })
	</script>
	
