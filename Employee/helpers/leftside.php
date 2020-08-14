<?php require_once('config/dbconnect.php');
$msgclass = '';
$msgShow = '';

if (filter_has_var(INPUT_POST, 'submitRight')) {
  $msgclass = "bg-success";
  $msgShow = "Success!";

  $employeeId = intval(filter_var($_POST['employeeId'], FILTER_SANITIZE_NUMBER_INT));


  $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

  $leaveType = intval(filter_var($_POST['leaveType'], FILTER_SANITIZE_NUMBER_INT));


  $leaveReason = filter_var($_POST['leaveReason'], FILTER_SANITIZE_STRING);


  //Check require fileds
  if (!empty($employeeId) && !empty($leaveReason)) {
    
    // check valid id

    if (floor(log10($employeeId) + 1) <= 11) {
      $sqlName = "SELECT name FROM `employee` WHERE employee_id = {$employeeId}";
      $resultsName = mysqli_query($conn, $sqlName);


      if (!mysqli_error($conn)) {
        $resultCheckName = mysqli_num_rows($resultsName);
      } else {
        die(mysqli_error($conn));
      }

      if ($resultCheckName > 0) {
        $employee = mysqli_fetch_assoc($resultsName);
        $resultsName = '';
        $name = trim($name);
        $employee = trim($employee['name']);
        $name = strtolower($name);
        $employee = strtolower($employee);

        if ($employee === $name) {


          $leaveType = intval($leaveType);


          $sqlInsert = "INSERT INTO `leave_balance` (`emp_id`, `leave_type_id`, `leave_reason`) VALUES ({$employeeId},{$leaveType},\"{$leaveReason}\");";
          mysqli_query($conn, $sqlInsert);
          

          if (!mysqli_error($conn)) {
            $last_id = mysqli_insert_id($conn);
            $msgShow = "Succesfully Added!<br>Your Unique Leave Id is: <strong style='font-size: 2rem;' >" . $last_id . "</strong><p>Keep your Leave Id Safe for Future Referance.</p>";
            $msgclass = "bg-success";
            unset($_POST['name']);
            unset($_POST['leaveType']);
            unset($_POST['employeeId']);
            unset($_POST['leaveReason']);
            $employeeId = '';
            $name = '';
            $leaveReason = '';
            $leaveType = '';
            $employee = '';
            $last_id = '';
          } else {

            $msgShow = "Problem connecting Database!" . die(mysqli_error($conn));
            $msgclass = "bg-danger";
            unset($_POST['employeeId']);
          }
        } else {


          $msgShow = " Employee Name and Id Doesn't match in Database";
          $msgclass = "bg-warning";
          // unset($_POST['employeeId']);
        }
      } else {

        $msgShow = "Invalied Employee Id : <strong style='font-size: 2rem;' >"
        .$_POST['employeeId']."</strong>";
        $msgclass = "bg-danger";
        unset($_POST['employeeId']);
      }
    } else {
      $msgShow = "Enter Valid employee_id";
      $msgclass = "bg-danger";
      unset($_POST['employeeId']);
    }
  } else {
    // failed
    $msgShow = "Please Enter the Required Fileds!";
    $msgclass = "bg-danger";
    unset($_POST['employeeId']);
  }
}
?>

<!-- Html of the left side TODO Form To make leave application -->


<div class="container left col-md-6">
  <h3>Make a Leave Application</h3>
  <?php if ($msgShow != "") {
    echo "<div class='" . $msgclass . " alert'>" . $msgShow . "</div>";
  } ?>
  <form action="index.php" method="post">
    <div class="form-group">
      <label for="employeeId" class="req" id="req">Employee Id * </label>
      <input type="number" maxlength="11" class="form-control" placeholder="Employee Id" value="<?php if (isset($_POST['employeeId'])) {echo $_POST['employeeId'];} ?>"name="employeeId">
    </div>
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" maxlength="50" placeholder="Name" 
      value="<?php if (isset($_POST['name'])) { echo $_POST['name'];} ?>" name="name">
    </div>
    <div class="form-group">
      <label for="leaveType">Leave Type</label>
      <select class="form-control" name="leaveType">
        <?php
        $sql = "SELECT * FROM `leave_type`;";
        $results = mysqli_query($conn, $sql);
        if (!mysqli_error($conn)) {
          $resultCheck = mysqli_num_rows($results);
        } else {
          die(mysqli_error($conn));
        }
        // mysqli_close($conn);
        if ($resultCheck > 0) {

          while ($each = mysqli_fetch_assoc($results)) {

            echo "<option value=" . $each['leave_type_id'] . ">" .ucwords($each['leave_type']). "</option>";
          }
        }

        ?>
        <option value="1" selected>None</option>
      </select>
    </div>
    <div class="form-group">
          <label for="leaveReason">Leave Reason * </label>
           <textarea class="form-control" rows="3" name="leaveReason" id="" cols="30" placeholder="Enter a valid Reason.."><?php
            if (isset($_POST['leaveReason'])){echo $_POST['leaveReason'];} 
            ?></textarea>

    </div>
      <button type="submit" name="submitRight" class="btn btn-primary ">SUBMIT</button>
   </form>

</div>