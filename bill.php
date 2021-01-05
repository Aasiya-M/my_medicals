<!DOCTYPE html>
<?php
$error = "";
$success = "";
require 'auth.php';
$conn = new mysqli('localhost','admin','admin','medicalStore');
if($conn->connect_error) {
die('Could not connect:'.$conn->connect_error);
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
				</div>
			</nav>
		</div>
	</div>
  <div class="row">
     <div class="col-md-2"></div>
     <div class="col-md-8">
     <div class="row">
      <div class="col-md-12">
        <?php if(!empty($error)) { ?>
          <div class="alert alert-dismissable alert-danger">

          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×
          </button>
           <?= $error ?>
        </div>
        <?php } ?>
        <?php if(!empty($success)) { ?>
        <div class="alert alert-success alert-dismissable">

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
          ×
        </button>
         <?= $success ?>
      </div>
    <?php } ?>
      </div>
     </div>


       <div class="row">
     		<div class="col-md-12">


        <table class="table">
  				<thead>
  					<tr>
  						<th>
  							Order Id
  						</th>
  						<th>
  							Order date
  						</th>
  						<th>
  							Amount
  						</th>
  						<th>
  							Ordered Item
  						</th>
  					</tr>
  				</thead>
  				<tbody>
            <?php

              $cust_id = $_SESSION["user"]['cust_id'];

              $q = "SELECT * FROM `Bill` WHERE 1";

              $result = $conn->query($q);

              if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                  ?>

                  <tr>
        						<td>
        							 <?= $row['Order_id'] ?>
        						</td>
        						<td>
        							<?= $row['Order_date'] ?>
        						</td>
        						<td>
        							<?= $row['Amt_to_pay'] ?>
        						</td>
        						<td>
        							<?php
                          $data = unserialize($row['items']);
                          foreach($data as $value){

                              echo $value['Med_name'].", Qty:-".$value['Quantity']."\n";
                          }
                      ?>
        						</td>
        					</tr>

                  <?php


                }
              }





            ?>


  				</tbody>
  			</table>



     		</div>
     	</div>


     </div>
     <div class="col-md-2"></div>
  </div>

</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js "></script>

  </body>
</html>
