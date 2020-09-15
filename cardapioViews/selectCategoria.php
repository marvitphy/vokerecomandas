<?php

include 'config.php';


$id = $_POST['user'];
$nome = $_POST['nome'];
$sql_produtos = "SELECT * from produtos where user_id = '$id' and categoria = '$nome'";
$query = mysqli_query($db, $sql_produtos);
//$rows = mysqli_num_rows($query);
$sql_2 = "SELECT * from produtos where user_id = '$id' and categoria = '$nome'";
$q_2 = mysqli_query($sql_2);
$catNome = mysqli_fetch_array($q_2);
session_start();
$_SESSION['email_cliente'];



?>

<span class="btn text-dark btn-block mt-2 text-left" style="border-bottom: 2.2px solid white ; font-weight: bold; font-size: 18px"><?php echo $catNome['categoria'] ?></span>
<?php while ($rows_produtos = mysqli_fetch_assoc($query)) {

	$id_produto = $rows_produtos['id'];
	$sql_op = "SELECT * from opcoes where produto_id = '$id_produto'";
	$q_op = mysqli_query($db, $sql_op);
	$q_op2 = mysqli_query($db, $sql_op);
	$fetch_op = mysqli_fetch_array($q_op2);
?>
	<div class="prod">
		<section class="produto container card bg-dark rounded row mt-1 pt-2" style="display: ">
			<div class="item-2 item-img" style="background-size: cover; background-position: center; background-repeat: no-repeat; background-image: url(<?php echo 'http://vcomandas.com/views/' . $rows_produtos['foto'] ?>) ; width: 10px;"></div>
			<div class="item text-white "><span class="nomeProduto"><?php echo $rows_produtos['nome'] ?></span><br> <small><?php echo $rows_produtos['descricao']; ?></small><br><small class="text-warning preco font-weight-bold"><?php echo 'R$' . number_format($rows_produtos['preco'], 2, ',', '.');  ?></small>
				<small class="text-warning preco2 font-weight-bold" style="opacity: 0; font-weight: 1px"><?php echo $rows_produtos['preco'];  ?></small>

			</div>
			<div class="item-3 pt-4">
				<?php if (!is_array($fetch_op)) { ?>
					<i class="text-success fas fa-plus-circle add" data-toggle="modal" data-target="#exampleModal"></i>
				<?php } else { ?>
					<i class="text-success fas fa-bars show-op"></i>
				<?php } ?>

                </div>
		</section>
		
		
			<div class="opcoes" style="overflow: auto; display: none; margin-top: 5px; ">

			<div class="opcoes-div" style="height: 1200px; overflow: auto; margin-bottom: 150px; ">
			    <span class="float-left nomeProd-show bg-dark text-white" style="padding: 5px 10px 5px 10px; border-radius: 25px; margin-left: 5px; font-weight: bold; font-family: 'Roboto', sans-serif"></span>
			    <i class="fas fa-times-circle float-right close" style="z-index: 1001; color: red; font-size: 28px; margin-right: 10px"></i> <br> <br>
				<span class="font-weight-bold" style="margin-bottom: 10px; margin-left: 5px">Escolha de</span>
				<span class="font-weight-bold" style=""><?php echo $rows_produtos['min'] ?></span>
				<span class="font-weight-bold" style="">a</span>
				<span class="font-weight-bold maxProd"><?php echo $rows_produtos['max'] ?></span>
				<?php

				while ($rows_opcoes = mysqli_fetch_assoc($q_op)) {
				?>

                <div style="overflow: auto">
					<div class="op" style="overflow: auto;">
						<i class="addOp float-right fas fa-plus-circle" data-toggle="modal" style="margin-top: 5px; color: black; font-size: 26px;" data-target="#exampleModal"></i>
						<i class="delOp float-right fas fa-plus-circle" data-toggle="modal" style="margin-top: 5px; color: #d9091d; font-size: 26px; display:none;" data-target="#exampleModal"></i>
				
						<span class="font-weight-bold d-block opName"><?php echo $rows_opcoes['nome']; ?></span>
						<span class=" d-block"><?php echo $rows_opcoes['descricao']; ?></span>
					</div>
                    
                </div>
                    
				<?php } ?>
                        <br><br><br><br><br><br>
                <div style="width: 100%; bottom: 15px; position: fixed;" class="text-center text-dark"> <div class="btn btn-danger shadow confirmarEscolhas" style="border-radius: 25px" >Confirmar Escolhas</div></div>
			</div>
			
		</div>
		
		
		</div>
		
		
<?php } ?>

<script>
	$(document).ready(function() {

        var lista = []
        var lista_2 = []
        var teste = []
        var pickName
        var precoP
	    $('.close').click(function(){
	        lista = []
	        $(this).closest('.prod').find('.opcoes').hide()
	        $('.delOp').hide()
	        $('.addOp').show()
	    })
		$('.show-op').click(function() {
			$(this).closest('.prod').find('.opcoes').fadeIn('fast')
			pickName = $(this).closest('.prod').find('.nomeProduto').text()
			$('.nomeProd-show').text(pickName)
		})
		
		
		var max = $('.maxProd').text()
		var nomeOp
		var nomeP
		$('.addOp').click(function() {
		    max = parseInt($(this).closest('.opcoes-div').find('.maxProd').text())
		   
			 nomeP = $(this).closest('.prod').find('.nomeProduto').text()
			nomeOp = $(this).closest('.op').find('.opName').text()
			precoP = $(this).closest('.prod').find('.preco2').text()
			if(lista.length == max){
			    alert('Você atingiu o limite')
			}else{
			if (lista.includes(nomeOp) == false ){lista.push(nomeOp)
			    
			     $(this).hide()
		        $(this).closest('.op').find('.delOp').show()
			    
			};
			

			}
			console.log(lista, lista.length, 'max = ' + max)
		})
		var teste_2
		$('.add').click(function(){
		    var user = '<?php echo $_SESSION['username'];?>'
		    var email = '<?php echo $_SESSION['email_cliente'];?>'
		    nomeP = $(this).closest('.prod').find('.nomeProduto').text()
		    alert(user, email, nomeP)
		      
		})
		$('.confirmarEscolhas').click(function(){
		    var user = '<?php echo $_SESSION['username'];?>'
		    var email = '<?php echo $_SESSION['email_cliente'];?>'
		    lista_final = lista.join(" ").replace(/[ ,]+/g, ", ");
		    console.log(user, lista_final, precoP, nomeP, email)
		    $('.close').click();
		    $.ajax({
                url: "/cardapioViews/cruds.php",
                method: 'post',
                data: {nome_cliente: user, detalhes: lista_final, nomeP: nomeP, precoP, email: email},
                success: function (response) {


                }
            }); 
		  
		})
		
		
		
		$('.delOp').click(function(){
		    nomeOp = $(this).closest('.op').find('.opName').text()
		    console.log(nomeOp)
		    const index = lista.indexOf(nomeOp)
            if (index > -1) { lista.splice(index, 1) }
            console.log(lista)
            $(this).hide()
		    $(this).closest('.op').find('.addOp').show()
		})
	})
</script>