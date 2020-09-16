$(document).ready(function () {

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const link = urlParams.get('link')
    console.log(link);
    var url_to_query = 'http://api.vcomandas.com/v1/produtos?link=' + link;

    axios.get('http://api.vcomandas.com/v1/empresas?link=' + link)
        .then(function (response) {
            console.log(response.data); // ex.: { user: 'Your User'}
            $('.nome-empresa').text(response.data[0].nomeEmpresa)
            var cat
            if (response.data[0].categoria == '') {
                cat = 'Sem categoria'
            } else {
                cat = response.data[0].categoria
            }
            $('.categoria-empresa').text(cat)
        });
    axios.get('http://api.vcomandas.com/v1/categorias?link=' + link)
        .then(function (response) {
            console.log(response.data);
            var cat_nome
            for (var pos in response.data) {
                $('.categorias').append(`<div class="card-scroll">
                <span class="cat-nome">${response.data[pos].nome}</span>
            </div>`)
            }

            $('.cat-nome').click(function () {
                cat_nome = $(this).text()
                console.log(cat_nome)
            })

        });


    (async () => {
        const response = await axios({
            url: url_to_query,
            method: 'get'
        })
        $('.progress-bar').hide();
        var all_produtos = response.data
        var cat_nome_filter
        $('.cat-nome').on('click', function () {
             cat_nome_filter = $(this).text();
            var produtos_filtrados = all_produtos.filter(element => element.categoria == cat_nome_filter)
            console.log(produtos_filtrados)
            $('.produtos-all').html('')
            for (var i = 0; i < produtos_filtrados.length; i++) {
                var foto
                if (produtos_filtrados[i].foto == '') {
                    foto = 'https://www.ferramentastenace.com.br/wp-content/uploads/2017/11/sem-foto.jpg'
                } else {
                    foto = `/views/${produtos_filtrados[i].foto}`
                }
                $('.produtos-all').append(`<ul class="list produtos">

            <li class="list-item produtos-list">
                <div class="list-item__left">
                    <img class="list-item__thumbnail list-item--material__thumbnail" src="${foto}" alt="Cute kitten">
                </div>

                <div class="list-item__center">
                    <div class="list-item__title prod_nome">${produtos_filtrados[i].nome}</div>
                    <div class="list-item__subtitle">${produtos_filtrados[i].descricao}</div>
                </div>
                <div class="list-item__right">
                    <span class="notification preco">${produtos_filtrados[i].preco}</span>
                    <div class="list-item__label addProd" style="font-size: 28px; color: #0fa824; opacity: 100%"><i class=" fas fa-plus-circle "></i></div>
                </div>
            </li>
        </ul>`)
            }
            $('.preco').prepend('R$')

            var prod_nome
            var preco_prod
            var str_preco
            var new_price
            $('.addProd').on('click', function () {
                prod_nome = $(this).closest('.produtos').find('.prod_nome').text();
                preco_prod = $(this).closest('.produtos').find('.preco').text();
                str_preco = parseFloat(preco_prod.replace(/[^0-9\.]+/g, ""));
                $('.modal-vk-body').show();
                $('.nome_produto').text(prod_nome)
                $('.preco_show').text('R$ ' + str_preco.toFixed(2).replace('.', ','))
                $('.preco_show_2').text(str_preco)

            });
            $('.fechar-modal').click(function () {
                $('.modal-vk-body').hide();
                $('.qtd_number').val(1)
            })

            $('.add_qtd').click(function () {
                var qtd_1 = $('.qtd_number').val()
                var qtd_updated = parseInt(qtd_1) + 1
                new_price = str_preco * qtd_updated;
                $('.preco_show').text('R$ ' + new_price.toFixed(2).replace('.', ','))
                $('.preco_show_2').text(new_price)
                $('.qtd_number').val(qtd_updated)
            })

            $('.del_qtd').click(function () {
                var qtd_2 = $('.qtd_number').val()
                var qtd_updated = parseInt(qtd_2) - 1
                new_price = str_preco * qtd_updated;
                if ($('.qtd_number').val() - 1 == 1) {
                    $('.preco_show').text('R$ ' + new_price.toFixed(2).replace('.', ','))
                    $('.preco_show_2').text(new_price)
                }
                if ($('.qtd_number').val() <= 1) {
                    $('.qtd_number').val(1)
                    $('.preco_show').text('R$ ' + new_price.toFixed(2).replace('.', ','))
                    $('.preco_show_2').text(new_price)
                } else {
                    if ($('.qtd_number').val() - 1 == 1) {
                        $('.preco_show').text('R$ ' + new_price.toFixed(2).replace('.', ','))
                        $('.preco_show_2').text(new_price)
                    }
                    $('.qtd_number').val(parseInt(qtd_2) - 1)
                    $('.preco_show').text('R$ ' + new_price.toFixed(2).replace('.', ','))
                    $('.preco_show_2').text(new_price)
                }
            })


        })




        function checar_null() {
            let dados_2 = localStorage.getItem('produtos');
            dados_2 = JSON.parse(dados_2)
            var index = dados_2.findIndex(dados_2 => dados_2 == null);
            delete dados_2[index]
            console.log(dados_2)
        }

        function calcularTotal() {
            let data = localStorage.getItem('produtos');
            data = JSON.parse(data);
            var total = 0;
            for (var i = 0; i < data.length; i++) {
                total += parseFloat(data[i].preco);
            }

            $('.preco-final').text('')
            $('.preco-final').text('R$ ' + total.toFixed(2).replace('.', ','))
        }




        function cadastrarProduto(produto, preco, qtd) {

            let novoProduto = { nome: produto, preco: preco, qtd: qtd }
            let data = localStorage.getItem('produtos');
            data = JSON.parse(data)
            let produtos = localStorage.getItem('produtos');
            if (produtos == null) produtos = [];
            else produtos = JSON.parse(produtos);
            produtos.push(novoProduto);
            localStorage.setItem("produtos", JSON.stringify(produtos));
            console.log(JSON.stringify(produtos))
            calcularTotal()


        }






        $('.add-to-cart').click(function () {

            var nome = $(this).closest('.modal-content').find('.nome_produto').text()
            var qtd = $(this).closest('.modal-content').find('.qtd_number').val()
            var preco = $(this).closest('.modal-content').find('.preco_show_2').text()
            var new_preco = parseFloat(preco)
            $('.fechar-modal').click();
            alert(nome + ' Adicionado ao seu carrinho!')
            cadastrarProduto(nome, new_preco, qtd);
            $('.carrinho-page').find('.list').html('')
            carregarProdutos()
        })

        function carregarProdutos() {

            let dados = localStorage.getItem('produtos');
            if (dados == null) $('.carrinho-page').find('.list').append(`<li class="list-item">
            <div class="list-item__center">Sem itens no carrinho</div>
          </li>`)
            else {
                dados = JSON.parse(dados)
                //console.log(dados[0].nome)

                dados.forEach(produto => {
                    if (produto != null) {
                        var novo_preco = 'R$ ' + produto.preco.toFixed(2).replace('.', ',')

                        $('.carrinho-page').find('.list').append(`<li class="list-item">
                
                    <div class="list-item__center">
                      <div class="list-item__title">${produto.nome}</div>
                      <div class="list-item__subtitle font-weight-bold text-dark">Qtd: ${produto.qtd}</div>
                    </div>

                    <div class="list-item__right ">
                        <span class="notification notification--material" style="font-size: 14px">${novo_preco}</span>
                    </div>

                    <div class="list-item__right del_from_cart">
                        <i class="fas fa-trash-alt text-danger"></i>
                    </div>
                    
                  </li>`)
                    }
                })
            }

            function total_cart() {
                $('.total-cart').text(dados.length)
            }
            if (dados != null) {
                total_cart();

                calcularTotal()

            }

            $('.del_from_cart').on('click', function () {
                $(this).closest('.list-item').fadeOut('slow', function () {
                    $(this).closest('.list-item').remove();
                });


                var nome_prod_cart = $(this).closest('.list-item').find('.list-item__title').text();
                let dados_2 = localStorage.getItem('produtos');
                dados_2 = JSON.parse(dados_2)

                var index = dados_2.findIndex(dados_2 => dados_2.nome == nome_prod_cart);
                delete dados_2[index]
                dados_2 = dados_2.filter(function (x) { return x !== null });
                localStorage.setItem("produtos", JSON.stringify(dados_2));
                //RECHECAR QTD DE ITENS NO CART
                let dados_3 = localStorage.getItem('produtos');
                dados_3 = JSON.parse(dados_3)
                $('.total-cart').text(dados_3.length)
                calcularTotal()

            })



        }


        carregarProdutos();


    })()

    $('.finalizar-pedido').click(function () {
        var tempText = "";
        var pedido_montado = []
        let nome_all = $('.carrinho-page').find('.list-item__subtitle').each(function () {
            var teste = $(this).text();
            teste = teste.replace(/\D/g, '');

            arr = teste + 'un. ' + $(this).closest('.list-item').find('.list-item__title').text()
            pedido_montado.push(arr)
        });
        console.log(pedido_montado)

    })


    $('.carrinho-btn').on('click', function () {
        $('.total-price').fadeIn('slow');
        $('.carrinho-page').css('transform', 'translateX(0px)')
        $('.pedir-page').css('transform', 'translateX(100%)')
        window.location.hash = 'carrinho';
    })

    if (window.location.hash == '#carrinho') {
        $('.carrinho-btn').click()
    }
    if (window.location.hash == '#pedirconta') {
        $('.pedir-btn').click()
    } else {
        $('.cardapio-btn').click()
    }
    $(window).on('hashchange', function (e) {
        var hash = window.location.hash
        console.log('hash mudou ' + window.location.hash)
        if (hash == '#carrinho') {
            $('.carrinho-btn').click()
        } else if (hash == 'undefined') {
            $('.cardapio-btn').click()
        }
    });

    $('.cardapio-btn').on('click', function () {
        $('.total-price').hide();
        $('.carrinho-page').css('transform', 'translateX(100%)')
        $('.pedir-page').css('transform', 'translateX(100%)')
        history.replaceState(null, null, ' ');
    })
    $('.pedir-btn').on('click', function () {
        $('.total-price').hide();
        $('.pedir-page').css('transform', 'translateX(0px)')
        history.replaceState(null, null, ' ');
        window.location.hash = 'pedirconta';
    })
    $('.item-menu').on('click', function () {
        $('.item-menu').removeClass('item-menu-bottom');
        $('.fab').addClass('fab--mini');
        $('.fab').removeClass('item-menu-inside');
        $('.item-menu-text').fadeOut('slow');
        $(this).find('.item-menu-text').fadeIn('slow');
        $(this).addClass('item-menu-bottom');
        $(this).find('.fab').removeClass('fab--mini');
        $(this).find('.fab').addClass('item-menu-inside');
    })


    var $seuCampoCpf = $("#CPF");
    $seuCampoCpf.mask('000.000.000-00', { reverse: true });

    function validateCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g, '');
        if (cpf == '') return false;
        // Elimina CPFs invalidos conhecidos
        if (cpf.length != 11 ||
            cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999")
            return false;
        // Valida 1o digito
        add = 0;
        for (i = 0; i < 9; i++)
            add += parseInt(cpf.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(9)))
            return false;
        // Valida 2o digito
        add = 0;
        for (i = 0; i < 10; i++)
            add += parseInt(cpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(10)))
            return console.log(false);
        return console.log(true);
    }


})