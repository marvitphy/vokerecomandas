<?php


include 'config.php';
session_start();
$id = $_SESSION['id'];
$sql = "SELECT * FROM categorias where user_id = '$id'";
$result = $db->query($sql);
$result2 = $db->query($sql);

$sql_prods = "SELECT * FROM produtos where user_id = '$id'";
$result_prods = $db->query($sql_prods);

$sql_prods_2 = "SELECT * FROM produtos where user_id = '$id'";
$result_prods_2 = $db->query($sql_prods);
$data = mysqli_fetch_assoc($result_prods_2);


?>

<div class="col pedidos-main">
  <!-- RECENT PURCHASES -->
  <div class="panel">
    <div class="panel-heading">
      <h3 class="panel-title" style="font-size: 22px; font-weight: 600">Gerenciar Produtos <i class="fas fa-shopping-basket"></i></h3>
      <select style="border: 2px solid gray; border-radius: 20px; margin-top: 10px; width: 150px" class="organizar form-control">
        <label>Ver</label>
        <option>Tudo</option>
        <option>Por Categoria</option>
      </select>
      <span class="btn btn-secondary startab shadow-lg" style="display: none; margin-top: 10px; border-radius: 20px; border: 1px solid gray">Filtragem feita...</span>
      <div class="right">
        <button type="button" style="background: #123ba3; padding: 10px; border-radius: 500px; color: white" data-toggle="modal" data-target="#exampleModal">Cadastrar Produtos</button>



      </div>
    </div>
    <div class="panel-body no-padding">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Descrição</th>
            <th>Foto</th>
            <th>Destaque</th>
            <th>Min - Max</th>
            <th>Ações</th>

          </tr>
        </thead>
        <tbody class="dados-categorias">

        </tbody>
        <script>
          $(document).ready(function() {
            $('.actionDel').on('click', function() {
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
          <h5 class="modal-title" id="exampleModalLabel">Adicionar Produto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="submit-form">
            <span>Digite o nome:</span>
            <input type="text" name="nomeProduto" class="form-control nomeProduto" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
            <span>Digite a descrição:</span>
            <input type="text" name="descricaoProduto" class="form-control descricaoProduto" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
            <span>Selecione a categoria</span>
            <select name="categoriaProduto" class="form-control categoriaProduto" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
              <?php while ($row = $result->fetch_assoc()) { ?>
                <option><?php echo $row['nome'] ?></option>

              <?php } ?>
            </select>
            <span>Preço do produto</span>
            <input name="precoProduto" class="form-control precoProduto" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px" type="number">
            <span style="margin-top: 15px">Este produto tem opções de escolha? Caso sim, defina o mínimo e o máximo de escolhas que o cliente poderá fazer.</span>
            <div style="flex-direction: row; display: flex; margin-top: 10px">
              <div style="flex: 1; margin-right: 5px;">
                <label>Mínimo</label>
                <input name="minProd" required type="number" class="minProd form-control " placeholder="1" style=" border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
              </div>
              <div style="flex: 1;">
                <label>Máximo</label>
                <input name="maxProd" required type="number" class="maxProd form-control" placeholder="2" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="fechar btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary salvarProduto">Salvar</button>
          <button type="button" class="btn btn-primary testeB">Salva2r</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="ftProd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cadastrar Opções</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <span>Imagem do produto</span>
          <div style="text-align: center; margin-top: 10px">
            <img width="180px" id="img" style="border-radius: 15px; object-fit: cover; border: 2px solid gray" src="/views/imgs/"></div>

          <span>Adicionar imagem:</span>
          <form action="views/addImg.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" class="nomeImg">
            <input type="file" name="arquivo" style="border-radius: 25px; border: 2.2px solid gray;" class="imgP form-control" id="upload">
            <button type="submit" name="submit" class="btn btn-primary">Salvar</button>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="fechar btn btn-secondary" data-dismiss="modal">Cancelar</button>

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="cadOp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cadastrar Opções</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <span>Digite o nome da opção:</span>
          <input type="text" class="form-control nomeOp" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
          <span>Digite a descrição da opção:</span>
          <input type="text" class="form-control descricaoOp" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
          <span>Produto Selecionado:</span>
          <input type="text" class="form-control produtoSelected" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px" disabled value="">



        </div>
        <div class="modal-footer">
          <button type="button" class="fechar btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary salvarOp">Salvar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editarOp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cadastrar Opções</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <span>Editar o nome da opção:</span>
          <input type="text" class="form-control nomeOp_Edit" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
          <span>Editar a descrição da opção:</span>
          <input type="text" class="form-control descricaoOp_Edit" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">

        </div>
        <div class="modal-footer">
          <button type="button" class="fechar btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary salvarOp_Edit">Salvar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deletarProd" tabindex="-1" role="dialog" aria-labelledby="deletar" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Excluir Produto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <span class="confirmText">Tem certeza que deseja excluir o produto?</span>

        </div>
        <div class="modal-footer">
          <button type="button" class="fechar btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger excluirProd">Excluir</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deletarOp" tabindex="-1" role="dialog" aria-labelledby="deletar" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Excluir Opção</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <span>Tem certeza que deseja excluir a opção?</span>

        </div>
        <div class="modal-footer">
          <button type="button" class="fechar btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger excluirOp">Excluir</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editarProduto" tabindex="-1" role="dialog" aria-labelledby="deletar" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Produto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <span>Digite o nome:</span>
          <input type="text" class="form-control nomeProduto_atual" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
          <span>Digite a descrição:</span>
          <input type="text" class="form-control descricaoProduto_atual" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
          <span>Selecione a categoria</span>
          <select class="form-control categoriaProduto_atual" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
            <?php while ($row2 = $result2->fetch_assoc()) { ?>
              <option><?php echo $row2['nome'] ?></option>

            <?php } ?>
          </select>
          <span>Preço do produto</span>
          <input class="form-control precoProduto_atual" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px" type="number">
          <div style="flex-direction: row; display: flex; margin-top: 10px">
            <div style="flex: 1; margin-right: 5px;">
              <label>Mínimo</label>
              <input name="minProd" required type="number" class="minProd_edit form-control " placeholder="1" style=" border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
            </div>
            <div style="flex: 1;">
              <label>Máximo</label>
              <input name="maxProd" required type="number" class="maxProd_edit form-control" placeholder="2" style="border: 2.2px solid gray; margin-top: 10px; border-radius: 25px">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="fechar btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary editarProduto">Editar</button>
        </div>
      </div>
    </div>
  </div>
</div>


</div>
</div>
<script>
  $(document).ready(function() {


    $('.organizar').on('change', function() {
      if ($(this).val() == 'Por Categoria') {
        $(".startab").show('slow')
        setTimeout(function() {
          $(".startab").hide('slow')
        }, 3000);

        $('.dados-categorias').load('/views/produtosMain.php?categoria=1')
      } else {
        $(".startab").show('slow')
        setTimeout(function() {
          $(".startab").hide('slow')
        }, 3000);
        $('.dados-categorias').load('/views/produtosMain.php')
      }
    })



    function salvarProduto(nome, descricao, categoria, preco, min, max) {

      $.ajax({
        url: "views/cruds.php",
        method: 'post',
        data: {
          nomeProd: nome,
          descricao: descricao,
          categoria: categoria,
          preco: preco,
          minProd: min,
          maxProd: max
        },
        success: function(response) {
          alert(response)

        }
      });
    }
    var destacar
    var file


    $('.testeB').click(function() {

      console.log($('#submit-form').serialize())
    });

    $('#upload').change(function() {
      file = $(this)[0].files[0]
      console.log(file)
      const fileReader = new FileReader()
      fileReader.onloadend = function() {

        $('#img').attr('src', fileReader.result)
      }
      fileReader.readAsDataURL(file)
    })

    if ($('.option').text() == 'Não') {
      $('.dProd').val(0)
    }

    $('.option').click(function() {
      if ($(this).text() == 'Não') {
        $('.dProd').val(0)
      } else {
        $('.dProd').val(1)
      }
    })



    $('.salvarProduto').on('click', function() {
      var nomeProduto = $('.nomeProduto').val()
      var descricaoProduto = $('.descricaoProduto').val()
      var categoriaProduto = $('.categoriaProduto').val()
      var precoProduto = $('.precoProduto').val()
      var minProd = $('.minProd').val()
      var maxProd = $('.maxProd').val()
      destacar = $('.destacarProduto').val()
      if (destacar == 'Não') {
        destacar = 0
      } else {
        destacar = 1
      }
      console.log(destacar)
      if ($('.nomeProduto').val() == '') {
        alert('Preencha todos os campos')
      } else {
        $('.fechar').click();
        $('.app').load('/views/produtos.php')
        salvarProduto(nomeProduto, descricaoProduto, categoriaProduto, precoProduto, minProd, maxProd)

      }


    })




    $(document).ready(function() {
      $('.dados-categorias').load('/views/produtosMain.php')

    })
  })
</script>