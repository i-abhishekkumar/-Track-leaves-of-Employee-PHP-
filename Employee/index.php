<?php
require_once("config/dbconnect.php");
// header("Content-Type: application/json;charset=utf-8", true);

function sett($msgg="",$class=""){
  $GLOBALS['msg'] =$msgg;
  $GLOBALS['msgClass'] =$class;
}
function settRight($msgg="",$class=""){
  $GLOBALS['msgRight'] =$msgg;
  $GLOBALS['msgClassRight'] =$class;
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Employee Demo</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <!-- link CSS -->
  <link rel="stylesheet" href="css/style.css">

</head>
<body>
  <header>
    <h1>Employee Details</h1>
    <!-- error messages -->
  
  <?php if($GLOBALS['msg'] !=''):?>
      <div style="text-align: center; font-size:1.7rem;" class="alert <?php echo $GLOBALS['msgClass'];?> ">
      <?php echo $GLOBALS['msg'];?>
    </div>
  <?php endif;?>
  </header>


  <div class="container">
    
  <div class="row">
    <?php require('helpers/leftside.php');?>
    <?php require('helpers/rightside.php');?>
  </div>

  
  </div>

  

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  <!-- Custom Javascript -->
  <script src="js/app.js"></script>
  
</body>

</html>