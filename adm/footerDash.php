
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>
	<script src="https://raw.github.com/cowboy/jquery-hashchange/v1.3/jquery.ba-hashchange.js"></script>
	<script>
    $(document).ready(function(){

        
        console.log(window.location.hash)
        
        if(window.location.hash == '#qrcode'){

        $( ".app" ).load('views/qrCode.php' );
        }
        if(window.location.hash == '#categorias'){

        $( ".app" ).load('views/categorias.php' );
        }
        if(window.location.hash == '#mesas'){

        $( ".app" ).load('views/mesas.php' );
        }
        if(window.location.hash == '#produtos'){

        $( ".app" ).load('views/produtos.php' );
        }
        if(window.location.hash == '#mesasAdmin'){

        $( ".app" ).load('views/gerenciarMesas.php' );
        }
        
	     
	   $.ajax({
    type: "GET",
    beforeSend: function(){
        $('.pedidos_ver').html('<div class="spinner"></div>')
    },
    url: 'views/pedidos.php',
    success: function(data)
    {
        $(".pedidos_ver").load('views/pedidos.php');
        /*setInterval(function(){
            $('.dados-pedidos').load('views/pedidosMain.php')
        }, 3000)*/

         
    }
});

/////////////
    const urlParams = new URLSearchParams(window.location.search);
    console.log('aqui', window.location.hash)

    if (window.location.hash == '#/dashboard' ) {
        $('#home').find('a').addClass('active');
    }else if(window.location.hash != '#/dashboard'){
        $('#home').find('a').removeClass('active')
    }
    ///////////
	          
	          
	          $('#pedidos').on('click', function() {
        $(this).find('a').toggleClass('active')
            $.ajax({
    type: "GET",
    beforeSend: function(){
        $('.app').html('<div class="spinner"></div>')
    },
    url: 'views/pedidos.php',
    success: function(data)
    {
        $(".app").load('/views/pedidos.php');

    }
    });
      
      
    })
	          $('#gerenciarMesas').on('click', function() {
        $(this).find('a').toggleClass('active')
            $.ajax({
    type: "GET",
    beforeSend: function(){
        $('.app').html('<div class="spinner"></div>')
    },
    url: 'views/pedidos.php',
    success: function(data)
    {
        $(".app").load('/views/gerenciarMesas.php');

    }
    });
      
      
    })
	    
	    $('#registrarMesas').on('click', function() {
        $(this).find('a').toggleClass('active')
            $.ajax({
    type: "GET",
    beforeSend: function(){
        $('.app').html('<div class="spinner"></div>')
    },
    url: 'views/mesas.php',
    success: function(data)
    {
        $(".app").load('/views/mesas.php');

    }
    });
      
      
    })
    
    $('#categorias').on('click', function() {
        $(this).find('a').toggleClass('active')
    $.ajax({
    type: "GET",
    beforeSend: function(){
        $('.app').html('<div class="spinner"></div>')
    },
    url: '/views/categorias.php',
    success: function(data)
    {
        $(".app").load('/views/categorias.php');

    }
    });
    });
    
    $('#produtos').on('click', function() {
        $(this).find('a').toggleClass('active')
            $.ajax({
    type: "GET",
    beforeSend: function(){
        $('.app').html('<div class="spinner"></div>')
    },
    url: 'views/produtos.php',
    success: function(data)
    {
        $(".app").load('/views/produtos.php');

    }
    });
      
    })
    
     $('#qr').on('click', function() {
        $(this).find('a').toggleClass('active')
            $.ajax({
    type: "GET",
    beforeSend: function(){
        $('.app').html('<div class="spinner"></div>')
    },
    url: 'views/qrCode.php',
    success: function(data)
    {
        $(".app").load('/views/qrCode.php');

    }
    });
      
    })
    
    $('#comandas').on('click', function() {
        pedidos = 1
        $(this).find('a').toggleClass('active')
        $.ajax({
    type: "GET",
    beforeSend: function(){
        $('.app').html('<div class="spinner"></div>')
    },
    url: 'views/mainGerenciarComandas.php',
    success: function(data)
    {
        $('.app').html('')
        $(".app").load('/views/mainGerenciarComandas.php');
         
         
    }
});
        
    })
    $('#home').on('click', function() {
        $(this).find('a').toggleClass('active')
        window.location.href = '/dashboard.php'
        
    })
    
    


      
 

    })
</script>




	</body>

	</html>