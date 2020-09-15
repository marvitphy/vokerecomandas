<?php

include 'config.php';

if(isset($_GET['id'])){
$id = $_GET['id'];
$sql_categorias = "SELECT * from categorias where user_id = '$id'";
$result = mysqli_query($db,$sql_categorias);
$sql_destaques = "SELECT * from produtos where user_id = '$id' and destaque = 1";

}


?>

<div class="scrolling-wrapper mb-3">
    <?php while($row = $result->fetch_assoc()) {
        $categoria = $row['nome'];
    $sql_2 = "SELECT * FROM produtos where link = '$nome' and categoria = '$categoria'";
$result_2 = $db->query($sql_2);
    ?>
  <div class="card-cat btn btn-sm btn-light border border-dark pt-2 pb-1 mt-0 text-dark"><h4 class="cat-nome"><?php echo $row['nome'];?></h4></div>
    <?php } ?>
</div>

 <div class="produtosAll">
</div>
<script>
    $(document).ready(function(){
        
        
        var user = '<?php echo $id;?>'
        var nome

        $('.cat-nome').on('click', function(){
            nome = $(this).text()
             $.ajax({
                url: "/cardapioViews/selectCategoria.php",
                method: 'post',
                data: {user: user, nome: nome},
                success: function (response) {
                    $('.produtosAll').html('')
                   $('.produtosAll').html(response)

                }
            }); 
        })
    })
</script>