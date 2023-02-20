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
    <h3 class=" text-center">Update Details</h3>
    <?php
    if(isset($_REQUEST['edit'])){
        $sql="SELECT * FROM `doctor_tb` WHERE dr_id={$_REQUEST['id']}" ;
        $result = $conn->query($sql);
        $row=$result->fetch_assoc();
     }
        //for updating
        if(isset($_REQUEST['requestupdate'])){
            if(($_REQUEST['dr_name']=="" ||$_REQUEST['dr_email']=="")){
                $regmsg = '<div class="alert alert-danger mt-2" role="alert">Fill all fields...</div>';
        
            }else{
            $rid = $_REQUEST['dr_id'];
            $rname = $_REQUEST['dr_name'];
            $remail = $_REQUEST['dr_email'];
            $rsp = $_REQUEST['dr_sp'];
            $rmobile = $_REQUEST['dr_mobile'];
            $sql = "UPDATE `doctor_tb` SET dr_id = '$rid', dr_name='$rname',dr_email='$remail' ,dr_sp='$rsp' ,dr_mobile='$rmobile' WHERE dr_id= '$rid'";
            if($conn->query($sql) == TRUE){
                $regmsg = '<div class="alert alert-success  mt-2" role="alert">Updation Successful...</div>';

            }
        }
    }
        
   
    ?>
    <form action="" method="post">
        <div class="form-group mb-4">
            <label for="r_login_id">Doctor ID</label>
            <input type="text" class="form-control mb-2" name="dr_id" value= "<?php if(isset($row['dr_id'])){echo $row['dr_id'];} ?>" readonly>
        </div>

        <div class="form-group mb-4">
            <label for="r_name">Name</label>
            <input type="text" class="form-control mb-2" name="dr_name" value= "<?php if(isset($row['dr_name'])){echo $row['dr_name'];} ?>">
        </div>

       

        <div class="form-group mb-4">
            <label for="r_sp">Speciality</label>
            <input type="text" class="form-control mb-2" name="dr_sp" value= "<?php if(isset($row['dr_sp'])){echo $row['dr_sp'];} ?>">
        </div>

        <div class="form-group mb-4">
            <label for="r_mobile">Mobile</label>
            <input type="text" class="form-control mb-2" name="dr_mobile" value= "<?php if(isset($row['dr_mobile'])){echo $row['dr_mobile'];} ?>">
        </div>
        
        <div class="form-group mb-4" >
            <label for="r_email">Email</label>
            <input type="email" class="form-control mb-2" name="dr_email" value= "<?php if(isset($row['dr_email'])){echo $row['dr_email'];} ?>" >
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger" name="requestupdate">Update</button>
            <a href="doctor.php" class="btn btn-secondary">Close</a>
        </div>
        <?php
                            if(isset($regmsg)){echo $regmsg ;}
                            
                            ?>
    </form>

<?php
include('includes/footer.php');

?>