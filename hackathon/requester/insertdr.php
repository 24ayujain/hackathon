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

if(isset($_REQUEST['requestsubmit'])){
    if(($_REQUEST['rName']=="" || $_REQUEST['rMobile']=="" || $_REQUEST['rSp']=="" || $_REQUEST['rEmail']=="")){
        $regmsg = '<div class="alert alert-danger mt-2" role="alert">Fill all fields...</div>';

    }else{
        $sql = "SELECT dr_email FROM doctor_tb WHERE dr_email= '".$_REQUEST['rEmail']."'";
        $result = $conn->query($sql);
        if($result->num_rows==1){
            $regmsg = '<div class="alert alert-danger mt-2" role="alert">Doctor Already Registered...</div>';

        }else{
            $rname = $_REQUEST['rName'];
            $remail = $_REQUEST['rEmail'];
            $rsp = $_REQUEST['rSp'];
            $rmobile= $_REQUEST['rMobile'];
            $sql = "INSERT INTO `doctor_tb` (`dr_name`, `dr_sp`, `dr_mobile`, `dr_email`) VALUES ('$rname','$rsp','$rmobile','$remail')";
            $result = $conn->query($sql);
            if($result==TRUE){
                $regmsg = '<div class="alert alert-success mt-2" role="alert">User Registered...</div>';

            }else{
                $regmsg = '<div class="alert alert-danger mt-2" role="alert">Try Again!!!!</div>';
            
               }
        }

    }
}

//define('TITLE', 'Insert Employee');
include('includes/header.php');

?>
<!-- 2nd colummn -->
<div class="col-sm-6 mx-3  jumbotron"  style="margin-top:80px;">
    <h3 class=" text-center">Registeration of Doctors</h3>
    <form action="" class="shadow-lg p-4" method="POST">
        <div class="form-group">
            <i class="fas fa-1x fa-user"></i>
            <label for="name" class="font-weight-bold pl-2" style="padding:11px;">Name</label><br>
            <input type="text" class="form-control" placeholder="Dr." name="rName">
        </div>
        <break>
            <div class="form-group">
                <i class="fas fa-1x fa-user"></i>
                <label for="name" class="font-weight-bold pl-2" style="padding:11px;">Speciality</label><br>
                <input type="text" class="form-control" placeholder="Specialization" name="rSp">
            </div>
            <break>
                <div class="form-group">
                    <i class="fas fa-1x fa-user"></i>
                    <label for="email" class="font-weight-bold pl-2" style="padding:11px;">Email</label><br>
                    <input type="email" class="form-control" placeholder="Email" name="rEmail">
                    <small>Wenever share your details with anyone else.</small>
                </div>
                <break>


                    <div class="form-group">
                        <i class="fas fa-1x fa-key"></i>
                        <label for="text" class="font-weight-bold pl-2" style="padding:11px;">Mobile</label><br>
                        <input type="text" class="form-control" placeholder="Mobile" name="rMobile">
                    </div>



                    <div class="text-center" style="margin-top: 30px;">
                        <button type="submit" class="btn btn-danger" name="requestsubmit">Add</button>
                        <a href="doctor.php" class="btn btn-secondary">Close</a>
                    </div><br>
                    <?php
                            if(isset($regmsg)){echo $regmsg ;}
                            
                            ?>
    </form>
</div>



<?php
include('includes/footer.php');

?>