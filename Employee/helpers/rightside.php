<?php 
$errmsg = "";
$errclass = "";
require_once("config/dbconnect.php");
if(filter_has_var(INPUT_POST,'clearRight')){
  unset($_POST['employee_id']);
}
?>
<!-- Html of right side -->

<div class="container right col-md-6" style="margin-top:2rem;">
<!-- php File to add Employee -->
   <?php require('addEmployee.php');?>


    <form action="index.php" method="post" style="margin: 1rem;">
      <div class="form-group">
        <label for="employee-id">Enter Employee Id</label>
        <input type="number" name="employee_id" id="" placeholder="Enter employee Id" class="form-control"
        value = "<?php if(isset($_POST['employee_id'])) echo $_POST['employee_id'];?>">
      </div>
      <div class="flex-right" 
      style="
         display: flex;
        justify-content:space-between;" >
      <button type="submit" class="btn btn-info" name="submitright">Get Employee Leaves Records</button>
      <button class="clear btn btn-danger" name="clearRight">CLEAR</button>
      </div>
    </form>
    <hr>
    <!-- Show TAble  -->
    
      <?php
      if(isset($_POST['submitright'])){
      $emp_id = '';
      if(empty($_POST['employee_id'])){
        $errmsg = "Please Enter Employee Id";
        $errclass = "bg-danger";
          
          echo "<div class=\"alert bg-danger\">{$errmsg}</div>";
        
        exit();

       
      }
      else{
        $emp_id = $_POST['employee_id'];
        
       
      }
      $sqlRight = "SELECT emp.employee_id ,emp.name , lv.leave_id , lv.leave_reason , lv.leave_type_id, l.leave_type  
      from employee emp   RIGHT JOIN leave_balance lv ON emp.employee_id = lv.emp_id LEFT JOIN leave_type l ON lv.leave_type_id = l.leave_type_id where emp.employee_id = {$emp_id};";
      if (mysqli_connect_errno()) {
  
        
        $errmsg = 'Problem connecting Database';
        echo "<div class=\"alert bg-danger\">{$errmsg}</div>";
        exit();
        
      }
      $resultsRight = mysqli_query($conn,$sqlRight) ;
      if(!mysqli_error($conn)){
        $resultCheckRight = mysqli_num_rows($resultsRight);
      }else{
        die(mysqli_error($conn));
      }
      mysqli_close($conn);
      
      if($resultCheckRight<=0 ){
        $errmsg ="Please enter valid employee Id <Br> Or This Employee not have any Leave";
        $errclass ="bg-danger";
      }
      else{

      
      if($resultCheckRight>0){
        // Fetching all the data of the employee
        $temp = [];
         while($t = mysqli_fetch_assoc($resultsRight)){ 
           $temp[] = $t;
              }
         mysqli_free_result($resultsRight); 
              // SHow data
      $nameRight = $temp[0]["name"];
      $id = $temp[0]["employee_id"];
      
      echo "<table class=\"table cleartable table-striped\">
      <h4> Employee Id: ".$id." |  Name: ".$nameRight."</h4><br>
      <thead>
        <tr>
        <th>#</th>
        <th>Leave Id</th>
        <th>Leave Type</th>
        <th>Leave Reason</th>
        </tr>
      </thead>
      <tbody>
      ";
      $count = 0;
        
      foreach($temp as $row){
        echo "<tr>
        <th scope=\"row\">".++$count."</th>
        <td>".$row['leave_id']."</td>
        <td>".ucwords($row['leave_type'])."</td>
        <td>".$row['leave_reason']."</td>
      </tr>";
      }
      echo "</tbody> 
      </table>";

      // close Connection and empty array 
      $temp = [];
      
    
      
    }else{
        $errmsg ="Something went wrong Please contect to the Devloper!";
        $errclass ="bg-danger";
        
      }



      }

    }
    
    ?>

    
    <?php if($errmsg !=''):?>
      <div class="alert <?php echo $errclass;?> ">
      <?php echo $errmsg;?>
    </div>
    <?php endif;?>

    </div>