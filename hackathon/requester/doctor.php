<?php
include('../dbConnection.php');

?>
<?php

session_start();

if(isset($_SESSION['is_login'])) {
    $rEmail = $_SESSION['rEmail'];
}else{
    echo "<script>  location.href = 'RequesterLogin.php'</script>";
}
?>
<?php

//define('TITLE', 'Technician');
include("includes/header.php");

?>
<br>
<br>
<!-- start 2nd column  -->
<div class="col-sm-9 col-md-10 text-center" style="margin-top:80px;">
    <p class="bg-dark text-white">List of Doctors</p>
<?php
$sql="SELECT * FROM `doctor_tb` ";
$result = $conn->query($sql);
    if($result->num_rows>0){
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Dr. ID </th>';
        echo '<th scope="col">Name </th>';
        echo '<th scope="col">Speciality </th>';
        echo '<th scope="col">Mobile </th>';
        echo '<th scope="col">Email </th>';
        echo '<th scope="col">Action </th>';
        
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()){
        echo '<tr>';
        echo '<td>'.$row['dr_id'].'</td>';
        echo '<td>'.$row['dr_name'].'</td>';
        echo '<td>'.$row['dr_sp'].'</td>';
        echo '<td>'.$row['dr_mobile'].'</td>';
        echo '<td>'.$row['dr_email'].'</td>';
        

        echo '<td>';
        echo '<form action="editdr.php" method="post" class="d-inline mr-2" style="margin-right:6px;">';
        echo '<input type="hidden" name="id" value='.$row['dr_id'].'><button type="submit" class="btn btn-warning" name="edit" value="Edit"><i class="fas fa-1x fa-sign-out-alt"></i></button>';
        echo '</form>';

        echo '<form action="" method="post" class="d-inline">';
        echo '<input type="hidden" name="delete" value='.$row['dr_id'].'><button type="submit" class="btn btn-secondary" name="close" value="Delete"><i class="fas fa-1x fa-align-center"></i></button>';
        echo '</form>';
        echo '</td>';
    }
        echo '<tbody>';
        echo '</table>';
    
    }
?>
<?php
if(isset($_REQUEST['close'])){
    $sql = "DELETE FROM `doctor_tb` WHERE `dr_id` = {$_REQUEST['delete']}";
    if($conn->query($sql)==TRUE){
        echo '<meta htttp-equiv="refresh" content="0;URL?closed" />';
    }else{
        echo "Unable to delete";
    }
}

?>
<!-- adding insertion button -->
<div class="float-right" style="float: right; margin-top:140px;" ><a href="insertdr.php" class="btn btn-danger float-right"><i class="fas fa-2x fa-user"></i></a></div>




<?php
include('includes/footer.php');

?>