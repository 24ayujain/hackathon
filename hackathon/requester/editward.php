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

//define('TITLE', 'Update Employee');
include('includes/header.php');

?>
<!-- start 2nd column  -->
<div class="col-sm-6 mx-3  jumbotron"  style="margin-top:80px;">
    <h3 class=" text-center">Update Ward Details</h3>
    <?php
    if(isset($_REQUEST['edit'])){
        $sql="SELECT * FROM `ward_tb` WHERE w_id={$_REQUEST['id']}" ;
        $result = $conn->query($sql);
        $row=$result->fetch_assoc();
     }
        //for updating
        if(isset($_REQUEST['requestupdate'])){
            if(($_REQUEST['w_type']=="" ||$_REQUEST['w_avail']==""||$_REQUEST['w_charges']=="")){
                $regmsg = '<div class="alert alert-danger mt-2" role="alert">Fill all fields...</div>';
        
            }else{
            $rid = $_REQUEST['w_id'];
            $rtype = $_REQUEST['w_type'];
            $rcharges = $_REQUEST['w_charges'];
            $ravail = $_REQUEST['w_avail'];
            $sql = "UPDATE `ward_tb` SET w_id = '$rid', w_type='$rtype',w_charges='$rcharges' ,w_avail='$ravail' WHERE w_id= '$rid'";
            if($conn->query($sql) == TRUE){
                $regmsg = '<div class="alert alert-success  mt-2" role="alert">Updation Successful...</div>';

            }
        }
    }
        
   
    ?>
    <form action="" method="post">
        <div class="form-group mb-4">
            <label for="r_login_id">Ward ID</label>
            <input type="text" class="form-control mb-2" name="w_id" value= "<?php if(isset($row['w_id'])){echo $row['w_id'];} ?>" readonly>
        </div>

        <div class="form-group mb-4">
            <label for="r_name">Ward Type</label>
            <input type="text" class="form-control mb-2" name="w_type" value= "<?php if(isset($row['w_type'])){echo $row['w_type'];} ?>">
        </div>

       

        <div class="form-group mb-4">
            <label for="r_sp">Charges</label>
            <input type="text" class="form-control mb-2" name="w_charges" value= "<?php if(isset($row['w_charges'])){echo $row['w_charges'];} ?>">
        </div>

        <div class="form-group mb-4">
            <label for="r_mobile">Availablity</label>
            <input type="text" class="form-control mb-2" name="w_avail" value= "<?php if(isset($row['w_avail'])){echo $row['w_avail'];} ?>">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger" name="requestupdate">Update</button>
            <a href="ward.php" class="btn btn-secondary">Close</a>
        </div>
        <?php
                            if(isset($regmsg)){echo $regmsg ;}
                            
                            ?>
    </form>

<?php
include('includes/footer.php');

?>