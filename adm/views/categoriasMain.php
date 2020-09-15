<?php


include 'config.php';
session_start();
$id = $_SESSION['id'];
$sql = "SELECT * FROM categorias where user_id = '$id'";
$result = $db->query($sql);

?>
<?php if(mysqli_num_rows($result) <= 0){  ?>

<tr class="cats text-capitalize">
    <td class="idCat"><a >Nenhuma Categoria Cadastrada</a></td>
    <td class="idCat"><a >Nenhuma Categoria Cadastrada</a></td>
    <td class="idCat"><a >Nenhuma Categoria Cadastrada</a></td>
    <td class="idCat"><a >Nenhuma Categoria Cadastrada</a></td>

</tr>

<?php }else{  ?>
<?php while($row = $result->fetch_assoc()) { ?>
<tr class="cats text-capitalize">
    <td class="idCat"><a ><?php echo $row['id']?></a></td>
    <td class="nameCat"><a ><?php echo $row['nome']?></a></td>
    <td class="desc"><a><?php echo $row['descricao']?></a></td>
    <td><i class="fas fa-pen text-success editarCat" data-toggle="modal" data-target="#editarCategoria" style="margin-right: 10px"></i><i data-toggle="modal" data-target="#deletar" class="fas fa-trash text-danger actionDel"></i></td>
</tr>
<?php }} ?>

<script>
 $(document).ready(function(){
     
     
        var lista = []
        var valor_1
        var id
        $('.actionDel').on('click', function(){
            
            valor_1 = $(this).closest('.cats').find('.nameCat').text()
            id = $(this).closest('.cats').find('.idCat').text()
            $('.confirmText').html('Tem certeza que deseja excluir a categoria '+ '<b>' + valor_1 + '?</b>')
            console.log(valor_1, id)
        })
        
        $('.excluirCat').on('click', function(){

            window.location.reload()
            $.ajax({
                url: "views/cruds.php",
                method: 'post',
                data: {catExcluir: id},
                success: function (response) {

                   

                }
            });
        })
        var nome_atual
        var desc_atual
        var id_atual
        $('.editarCat').on('click', function(){
               var temp_1 = $(this).closest('.cats').find('.nameCat').text()
               var temp_2 = $(this).closest('.cats').find('.desc').text()
               id_atual = $(this).closest('.cats').find('.idCat').text()
                $('.nomeAtual').val(temp_1)
                $('.descAtual').val(temp_2)
           
        })
        $('.editarCategoria').click(function(){
            nome_atual = $('.nomeAtual').val()
            desc_atual = $('.descAtual').val()
            console.log(nome_atual + desc_atual + id_atual)
            
            window.location.reload()
            $.ajax({
                url: "views/editarCategoria.php",
                method: 'post',
                data: {catId: id_atual, catNome: nome_atual, catDesc: desc_atual },
                success: function (response) {


                }
            }); 
            
            
        })
             
    
        })
        
        </script>