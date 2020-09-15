<?php


include 'config.php';
session_start();
$id = $_SESSION['id'];
$sql = "SELECT * FROM pedidos where user_id = '$id'";
$result = $db->query($sql);

?>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><a href="#"><?php echo $row['id']?></a></td>
    <td class="btn btn-danger rounded "><?php echo $row['mesa']?></td>
    <td><?php echo $row['cliente']?></td>

    <td><span class="label label-success">COMPLETED</span></td>
    <td>Oct 21, 2016</td>
    <td><i class="fas fa-pen text-success"></i><i data-toggle="modal" data-target="#deletarProd" class="fas fa-trash text-danger"></i></td>
</tr>
<?php } ?>

<script>
    $(document).ready(function(){
        
    })
</script>