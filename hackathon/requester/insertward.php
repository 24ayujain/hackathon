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
    if(($_REQUEST['w_type']=="" || $_REQUEST['w_avail']=="" || $_REQUEST['w_charges']=="")){
        $regmsg = '<div class="alert alert-danger mt-2" role="alert">Fill all fields...</div>';

    }else{
        $sql = "SELECT w_type FROM ward_tb WHERE w_type= '".$_REQUEST['w_type']."'";
        $result = $conn->query($sql);
        if($result->num_rows==1){
            $regmsg = '<div class="alert alert-danger mt-2" role="alert">Ward Already Exists...</div>';

        }else{
            $wtype = $_REQUEST['w_type'];
            $wcharges = $_REQUEST['w_charges'];
            $wavail = $_REQUEST['w_avail'];
           
            $sql = "INSERT INTO `ward_tb` (`w_type`, `w_charges`, `w_avail`) VALUES ('$wtype','$wcharges','$wavail')";
            $result = $conn->query($sql);
            if($result==TRUE){
                $regmsg = '<div class="alert alert-success mt-2" role="alert">Ward Added...</div>';

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
    <h3 class=" text-center">Addition of Beds</h3>
    <form action="" class="shadow-lg p-4" method="POST">
        <div class="form-group">
            <i class="fas fa-1x fa-user"></i>
            <label for="name" class="font-weight-bold pl-2" style="padding:11px;">Ward Type</label><br>
            <input type="text" class="form-control" placeholder="type" name="w_type">
        </div>
        <break>
            <div class="form-group">
                <i class="fas fa-1x fa-user"></i>
                <label for="name" class="font-weight-bold pl-2" style="padding:11px;">Charges(Rs.)</label><br>
                <input type="text" class="form-control" placeholder="Specialization" name="w_charges">
            </div>
            <break>
                <div class="form-group">
                    <i class="fas fa-1x fa-user"></i>
                    <label for="email" class="font-weight-bold pl-2" style="padding:11px;">Availablity</label><br>
                    <input type="text" class="form-control" placeholder="Available number" name="w_avail">
                    
                </div>
                <break>



                    <div class="text-center" style="margin-top: 30px;">
                        <button type="submit" class="btn btn-danger" name="requestsubmit">Add</button>
                        <a href="ward.php" class="btn btn-secondary">Close</a>
                    </div><br>
                    <?php
                            if(isset($regmsg)){echo $regmsg ;}
                            
                            ?>
    </form>
</div>



<?php
include('includes/footer.php');

?>