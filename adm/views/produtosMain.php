<?php


include 'config.php';
session_start();
$id = $_SESSION['id'];
if (!isset($_GET['categoria'])) {
    $sql = "SELECT * FROM produtos where user_id = '$id' ";
} else {
    $sql = "SELECT * FROM produtos where user_id = '$id' order by categoria";
}

$result = $db->query($sql);

?>
<?php if (mysqli_num_rows($result) <= 0) {  ?>

    <tr class="cats text-capitalize">
        <td class="idCat"><a>Nenhum produto cadastrado</a></td>
        <td class="idCat"><a>Nenhum produto cadastrado</a></td>
        <td class="idCat"><a>Nenhum produto cadastrado</a></td>
        <td class="idCat"><a>Nenhum produto cadastrado</a></td>
        <td class="idCat"><a>Nenhum produto cadastrado</a></td>
        <td class="idCat"><a>Nenhum produto cadastrado</a></td>

    </tr>

<?php } else {  ?>
    <?php while ($row = $result->fetch_assoc()) {
        $prod_id = $row['id'];
        $sql_op = "SELECT * from opcoes where produto_id = $prod_id";
        $result_op = mysqli_query($db, $sql_op);

    ?>

        <tr id="prod-<?php echo $row['id'] ?>" class="text-dark prods">
            <td class="idProd"><a><?php echo $row['id'] ?></a></td>
            <td class="nameProd"><a><?php echo $row['nome'] ?></a></td>
            <td class="categoriaProd"><a><?php echo $row['categoria'] ?></a></td>
            <td class="precoProd" id="preco-produto"><a><?php echo $row['preco'] ?></a></td>
            <td class="descProd"><a><?php echo $row['descricao'] ?></a></td>
            <td class="imgProd" data-toggle="modal" data-target="#ftProd"><i class="fas fa-camera"><span style="opacity: 0"><?php echo $row['foto']; ?></span></i>
            </td>
            <td class="destaqueProd"><a><?php if ($row['destaque'] == 0) {
                                            echo 'Não';
                                        } else {
                                            echo "Sim";
                                        } ?></a></td>
            <td><a class="minProduto"><?php echo $row['min'] ?></a>-<a class="maxProduto"><?php echo $row['max'] ?></a></td>
            <td>
                <i title="Editar Produto" class="fas fa-pen text-success editarProd" data-toggle="modal" data-target="#editarProduto" style="cursor: pointer; margin-right: 10px"></i>
                <i title="Excluir Produto" data-toggle="modal" data-target="#deletarProd" style="cursor: pointer" class="fas fa-trash text-danger actionDel"></i>
                <i title="Cadastrar Opções do Produto" class="f7-icons opcao text-success" style="cursor: pointer; margin-left: 10px; font-size: 18px; font-weight: bold" data-toggle="modal" data-target="#cadOp">square_stack_3d_up_fill</i>
                <i class="fas fa-chevron-down ver" style="margin-left: 5px; padding: 10px; cursor: crosshair;"></i>

            </td>
        </tr>
        <?php while ($row2 = $result_op->fetch_assoc()) { ?>
            <tr class="prod-<?php echo $row['id'] ?> opc" style="border-left: 10px solid gray; display: none">
                <td class="iOp"><?php echo $row2['id'] ?></td>
                <td class="nOp"><?php echo $row2['nome'] ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="dOp" style="width: 120px; line-break: auto;"><?php echo $row2['descricao'] ?></td>
                <td></td>
                <td></td>
                <td>
                    <i title="Editar Produto" class="fas fa-pen text-success editarOp" data-toggle="modal" data-target="#editarOp" style="margin-right: 10px"></i>
                    <i title="Excluir Produto" data-toggle="modal" data-target="#deletarOp" class="fas fa-trash text-danger actionDel_op"></i>

                </td>
            </tr>

            <script>

            </script>
        <?php } ?>
<?php }
} ?>


<script>
    $(document).ready(function() {

        $('.imgProd').click(function() {
            var imgIdProd = $(this).closest('.prods').find('.idProd').text()
            var img = $(this).text();
            $('#img').attr('src', 'http://vcomandas.com/views/' + img)
            $('.nomeImg').val(imgIdProd)
        })
        var id_opc
        var n_opc
        var d_opc
        $('.editarOp').click(function() {
            id_opc = $(this).closest('.opc').find('.iOp').text()
            n_opc = $(this).closest('.opc').find('.nOp').text()
            d_opc = $(this).closest('.opc').find('.dOp').text()
            $('.nomeOp_Edit').val(n_opc)
            $('.descricaoOp_Edit').val(d_opc)


        })
        $('.salvarOp_Edit').on('click', function() {
            var n_opc_edit = $('.nomeOp_Edit').val()
            var d_opc_edit = $('.descricaoOp_Edit').val()
            $.ajax({
                url: "views/cruds.php",
                method: 'post',
                data: {
                    idOpc: id_opc,
                    n_opc: n_opc_edit,
                    d_opc: d_opc_edit
                },
                success: function(response) {
                    window.location.reload();
                }
            });

        })



        $('.ver').on('click', function() {
            var classnome = $(this).closest('.prods').attr('id')
            console.log(classnome)
            $('.' + classnome).slideToggle()
        })
        var nome
        var id
        var categoria
        var preco
        var desc
        var destaque
        var id_atual
        var destaque_alterado
        var minOp
        var maxOp

        $('.imgProd').click(function() {

        })
        $('.opcao').on('click', function() {
            id = $(this).closest('.prods').find('.idProd').text()
            $('.produtoSelected').val($(this).closest('.prods').find('.nameProd').text())

        });
        $('.salvarOp').click(function() {
            nome = $('.nomeOp').val()
            desc = $('.descricaoOp').val()
            minOp = $('.minOp').val()
            maxOp = $('.maxOp').val()
            $.ajax({
                url: "views/cruds.php",
                method: 'post',
                data: {
                    idOp: id,
                    nomeOp: nome,
                    descOp: desc,
                    minOp: minOp,
                    maxOp: maxOp
                },
                success: function(response) {
                    $('.close').click();
                    window.location.reload();
                }
            });



        })

        var lista = []
        var valor_1
        var id
        $('.actionDel').on('click', function() {

            valor_1 = $(this).closest('.cats').find('.nameCat').text()
            id = $(this).closest('.prods').find('.idProd').text()

            $('.confirmText').html('Tem certeza que deseja excluir o produto?')
            console.log(valor_1, id)
        })

        $('.excluirProd').on('click', function() {

            window.location.reload()
            $.ajax({
                url: "views/cruds.php",
                method: 'post',
                data: {
                    prodExcluir: id
                },
                success: function(response) {



                }
            });
        })
        $('.actionDel_op').on('click', function() {
            id_opc = $(this).closest('.opc').find('.iOp').text()
        })
        $('.excluirOp').on('click', function() {

            console.log(id_opc)

            $.ajax({
                url: "views/cruds.php",
                method: 'post',
                data: {
                    idop: id_opc
                },
                success: function(response) {
                    $('.fechar').click();
                    $('.dados-categorias').load('/views/produtosMain.php')

                }
            });
        })


        $('.editarProd').on('click', function() {
            nome = $(this).closest('.prods').find('.nameProd').text()
            id = $(this).closest('.prods').find('.idProd').text()
            categoria = $(this).closest('.prods').find('.categoriaProd').text()
            preco = $(this).closest('.prods').find('.precoProd').text()
            desc = $(this).closest('.prods').find('.descProd').text()
            destaque = $(this).closest('.prods').find('.destaqueProd').text()



            if (destaque == 'Não') {
                destaque_alterado = 0
            } else {
                destaque_alterado = 1
            }
            id_atual = $(this).closest('.prods').find('.idProd').text()
            console.log(id_atual)

            $('.nomeProduto_atual').val(nome)
            $('.descricaoProduto_atual').val(desc)
            $('.categoriaProduto_atual').val(categoria)
            $('.precoProduto_atual').val(parseFloat(preco))

        })

        $('.editarProduto').click(function() {
            var nomeProduto_1 = $('.nomeProduto_atual').val()
            var catProduto_1 = $('.categoriaProduto_atual').val()
            var descProduto_1 = $('.descricaoProduto_atual').val()
            var precoProduto_1 = $('.precoProduto_atual').val()
            var destaqueProduto_1 = $('.destacarProduto_atual').val()
            var minP = $('.minProd_edit').val();
            var maxP = $('.maxProd_edit').val();

            if (destaqueProduto_1 == 'Não') {
                destaqueProduto_1 = 0
            } else {
                destaqueProduto_1 = 1
            }
            console.log(nomeProduto_1, catProduto_1, descProduto_1, precoProduto_1, destaqueProduto_1, id_atual)
            window.location.reload()
            $.ajax({
                url: "/views/editarProd.php",
                method: 'post',
                data: {
                    prodId: id_atual,
                    nomeProduto: nomeProduto_1,
                    categoria: catProduto_1,
                    preco: precoProduto_1,
                    descricao: descProduto_1,
                    destaque: destaqueProduto_1,
                    min: minP,
                    max: maxP
                },
                success: function(response) {

                    alert(response)

                }
            });


        })






    })
</script>