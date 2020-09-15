<?php 

include('config.php');
session_start();
$id = $_SESSION['id'];
$q_user = mysqli_query($db,"SELECT * from users where id = '$id'");
$rows_user = mysqli_fetch_array($q_user);
$link = $rows_user['link'];
$sql_mesas = mysqli_query($db, "SELECT * from mesas where user_id = '$id' and qrCode = '$link' order by numero_mesa asc")

?>

<?php while($rows_mesas = $sql_mesas->fetch_assoc()){
    $nMesa = $rows_mesas['numero_mesa'];
    $sql_requests = mysqli_query($db, "SELECT * from requests where num_mesa = '$nMesa ' and qrCode = '$link' and status = 1");
?>
<div class="col-sm-3">
    <div id="id-<?php echo $rows_mesas['numero_mesa']?>" class="card" style="border-radius: 10px; margin-bottom: 10px; border: 2px solid gray; height: 130px; padding-top: 50px">
      <div class="card-body text-center text-dark">
        Mesa <?php echo $rows_mesas['numero_mesa'];?>
      </div>
    </div>
    <span class="<?php echo $rows_mesas['numero_mesa']?>"></span> <br><br>
    <?php while($rows_requests = $sql_requests->fetch_assoc()){
    $numeroMesa = $rows_requests['num_mesa'];
    if($rows_requests['status'] = 1){
    ?>
    <script>
    $(document).ready(function(){ 
        $('#id-<?php echo $numeroMesa; ?>').css({
            'background':'#e1e80e',
            'color': 'black',
            'font-weight': 'bold',
            'animation' : 'border-pulsate 2s infinite'
            
        }) 
        $('.<?php echo $numeroMesa?>').html('<span class="bg-warning" style="color: black; border-radius: 15px; padding: 3px">Garçom Solicitado na <b>Mesa <?php echo $numeroMesa?></b></span><span class="bg-success id-<?php echo $numeroMesa ?>" style="cursor: pointer; color: black; border-radius: 15px; margin-left: 3px; padding: 5px">Ok!</span>')
        
        $('.id-<?php echo $numeroMesa?>').on('click', function(){
            var user = '<?php echo $_SESSION['id']?>'
            var mesa = '<?php echo $numeroMesa ?>'
            

             $.ajax({
                url: "views/cruds.php",
                method: 'post',
                data: {mesaNumero: mesa },
                success: function (response) {
                    $('.mesasAll').load('/views/mesasAll.php')
                }
            }); 
        
        })
        
    })
    
    
    </script>
<?php }} ?>

</div>

<?php } ?>