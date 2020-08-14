
<?php
$msgNewEmp = "";
$msgNewEmpClass = "bg-danger";
require_once('config/dbconnect.php');

if (filter_has_var(INPUT_POST, 'submitMake') && isset($_POST['submitMake'])) {
  
  if(!empty($_POST['nameMake'])){
    $nameMake = filter_var($_POST['nameMake'],FILTER_SANITIZE_STRING);
    $nameMake = trim($nameMake);
    $nameMake = strval($nameMake);
    if(strlen($nameMake)<=50){
      $sqlMake = "INSERT INTO `employee`(`name`) VALUES ('{$nameMake}')";
      if (mysqli_connect_errno()) {
  
        
        $msgNewEmp = 'Problem connecting Database';
        
        exit();
        
      }
      $resultsRightMake = mysqli_query($conn,$sqlMake) ;
      
      

      if (!mysqli_error($conn)) {
        $last_id_Make = mysqli_insert_id($conn);
        $nameMake = ucfirst($nameMake);
        $msgNewEmp = " {$nameMake},<br> Succesfully Added!<br>Your Unique Employee Id is: <strong style='font-size: 2rem;' >" . $last_id_Make . "</strong><p>Keep your Employee Id Safe for Future Uses.</p>";
        $msgNewEmpClass = "bg-success";
        $_POST['nameMake'] ="";
        unset($_POST['nameMake']);
        unset($_POST['submitMake']);
        
        
        $nameMake = '';
        
        $last_id_Make = '';
      } else {

        $msgNewEmp = "Problem connecting Database!" . die(mysqli_error($conn));
        $msgNewEmpClass = "bg-danger";
        unset($_POST['nameMake']);
      }








    }else{
      $msgNewEmp = "Enter the Name under 50char!";
      $msgNewEmpClass = "bg_danger";
    }




  }else{
    $msgNewEmp = "Please enter the Field";
    $msgNewEmpClass = "bg-danger";
  }



}else{
  $msgNewEmp = "";
$msgNewEmpClass = "";
unset($_POST['submitMake']);
}


?>

<form action="index.php" method="post" style="margin: 1rem;" >
        <div class="form-group">
          <label for="nameMake">Create new Employee Id</label>
          <input type="text" name="nameMake" maxlength="50" class="form-control" placeholder="Enter Name to register" id="">
        </div>
        <button type="submit" class="btn btn-danger" name="submitMake">Add New Empolyee</button>
</form>


<?php if($msgNewEmp !=''):?>
      <div class="alert <?php echo $msgNewEmpClass;?> ">
      <?php echo $msgNewEmp;?>
    </div>
    <?php endif;?>