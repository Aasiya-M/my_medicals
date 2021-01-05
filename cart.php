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


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   $cust_id = $_SESSION['user']['cust_id'];
   $Amt_to_pay = $_POST['Amt_to_pay'];
   $items = $_POST['items'];

   $insert_query = "INSERT INTO `Bill`(`Cust_id`, `Amt_to_pay`, `items`) VALUES ($cust_id,$Amt_to_pay,'$items')";


if ($conn->query($insert_query) === TRUE) {
 $success = "New record created successfully";
 $_SESSION['user']['cart'] = [];
} else {
$error = "Error: " . $insert_query . "<br>" . $conn->error;
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
      <? if(empty($_SESSION['user']['cart'])) {
          echo "No items in cart";
       } ?>
       <? if(!empty($_SESSION['user']['cart'])) { ?>
       <div class="row">
     		<div class="col-md-12">

 			<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
        <table class="table">
  				<thead>
  					<tr>
  						<th>
  							Medicine Id
  						</th>
  						<th>
  							Medicine name
  						</th>
  						<th>
  							Qty
  						</th>
  						<th>
  							Price
  						</th>
  					</tr>
  				</thead>
  				<tbody>
            <?php

               $total = 0;
               $med_id_list = [];
              // collect value of input field
              $cust_id = $_SESSION["user"]['cust_id'];

              $q = "SELECT * FROM `Cart` INNER JOIN `Medicines` ON Cart.Med_id = Medicines.Med_id WHERE Cart.Cust_id= '$cust_id'";

              $result = $conn->query($q);

              if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                  ?>

                  <tr>
        						<td>
        							 <?= $row['Med_id'] ?>
        						</td>
        						<td>
        							<?= $row['Med_name'] ?>
        						</td>
        						<td>
        							<?= $row['Quantity'] ?>
        						</td>
        						<td>
        							<?= $row['Quantity'] * $row['Price'] ?>
        						</td>
        					</tr>

                  <?php

                  $total = ($row['Quantity'] * $row['Price']) + $total;
                  $med = [];
                  $med['Med_id'] = $row['Med_id'];
                  $med['Med_name'] = $row['Med_name'];
                  $med['Quantity'] = $row['Quantity'];
                  array_push($med_id_list,$med);
                }
              }





            ?>


  				</tbody>
  			</table>
      <div class="col-md-12">
        <h4>Total:<?= $total ?> </h4>
      </div>
        <input type="hidden" name="Amt_to_pay" value="<?= $total ?>" />
        <input type="hidden" name="items"  value='<?= serialize($med_id_list) ?>' />
 				<button type="submit" class="btn btn-primary">
 					purchase
 				</button>
 			</form>

     		</div>
     	</div>
    <? } ?>

     </div>
     <div class="col-md-2"></div>
  </div>

</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js "></script>

  </body>
</html>
