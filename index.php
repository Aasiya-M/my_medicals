<!DOCTYPE html>
<?php

   require './auth.php';
   $searchQuery = '';
 $conn = new mysqli('localhost','admin','admin','medicalStore');
 if($conn->connect_error) {
   die('Could not connect:'.$conn->connect_error);
 }
   //print_r($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

   $cust_id = $_SESSION['user']['cust_id'];
   $med_id = $_POST['Med_id'];

   $q1 = "select * from `Cart` where `Med_id`='".$med_id."'";

$result = $conn->query($q1);
if($result->num_rows > 0) {
    $row1 = $result->fetch_assoc();
   $update_query = "UPDATE `Cart` SET `Quantity`= ".($row1['Quantity']+1)." WHERE `Med_id`='".$med_id."'";
   $result = $conn->query($update_query);
} else {
   $insert_query = "INSERT INTO `Cart`(`Med_id`, `Quantity`, `Cust_id`) VALUES ('$med_id',1,'$cust_id')";
   $result = $conn->query($insert_query);
}

} else {
  if(!empty($_GET['search'])){
    $searchQuery = $_GET['search'];
  }
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>My medicals</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<nav  class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark">

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="navbar-toggler-icon"></span>
				</button> <a class="navbar-brand" href="#">My medicals</a>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="navbar-nav">
						<li class="nav-item active">
							 <a class="nav-link" href="/medicalstore/index.php">Home</a>
						</li>
            <li class="nav-item">
               <a class="nav-link" href="/medicalstore/cart.php">Cart</a>
            </li>
						<li class="nav-item">
							 <a class="nav-link" href="/medicalstore/bill.php">Invocies</a>
						</li>
					</ul>
					<form class="form-inline" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
						<input class="form-control mr-sm-2" name="search" type="text">
						<button class="btn btn-primary my-2 my-sm-0" type="submit">
							Search
						</button>
					</form>
          <ul class="navbar-nav ml-md-auto">
						<li class="nav-item">
							 <a class="nav-link" href="/medicalstore/login.php?logout=true">Logout</a>
						</li>
          </ul>
				</div>
			</nav>
		</div>
	</div>
  <div class="row">
     <div class="col-md-2"></div>
     <div class="col-md-8">
       <div class="row">
         <?php




         $q = "SELECT * FROM `Medicines`";

         if(!empty($searchQuery)){
           $q = "SELECT * FROM `Medicines` WHERE `Med_name` LIKE '%".$searchQuery."%' ";
         }


         $result = $conn->query($q);

         if($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {




         ?>
         <div class="col-md-4">
           <h2>
              <?= $row['Med_name'] ?>
           </h2>
           <p>
             <dl>
         <dt>
          Company Name
         </dt>
         <dd>
           <?= $row['Company_name'] ?>
         </dd>
         <dt>
           Manufacturing Date
         </dt>
         <dd>
           <?= $row['Manf_date'] ?>
         </dd>
         <dt>
          Expiry Date
         </dt>
         <dd>
            <?= $row['Exp_date'] ?>
         </dd>
         <dt>
           Price
         </dt>
         <dd>
           <?= $row['Price'] ?>
         </dd>
       </dl>
           </p>
           <p>
             <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
              <input type="hidden" name="Med_id" value="<?= $row['Med_id'] ?>" />
             <button type="submit" class="btn btn-success">
               add to cart
             </button>
           </form>
           </p>

         </div>
         <?php
         }
         }

         $conn->close(); ?>
     	</div>

     </div>
     <div class="col-md-2"></div>
  </div>

</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js "></script>

  </body>

</html>
