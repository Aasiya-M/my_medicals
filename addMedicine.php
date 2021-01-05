<!DOCTYPE html>
<?php

$conn = new mysqli('localhost','admin','admin','medicalStore');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $med_name =$_POST['Med_name'];
  $med_type =$_POST['Med_type'];
  $company_name =$_POST['Company_name'];
  $manf_date =$_POST['Manf_date'];
  $exp_date =$_POST['Exp_date'];
  $price =$_POST['Price'];

  $q = "INSERT INTO Medicines (Med_name, Med_type, Company_name, Manf_date, Exp_date, Price)
VALUES ('$med_name', '$med_type', '$company_name', '$manf_date', '$exp_date', '$price')";
  if (empty($_POST)) {
    echo $q;
  } else {
    if ($conn->query($q) === TRUE) {
    echo "New record created successfully";
   } else {
    echo "Error: " . $q . "<br>" . $conn->error;
   }
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
			
		</div>
	</div>
  <div class="row">
     <div class="col-md-2"></div>
     <div class="col-md-8">
       <div class="row">
     		<div class="col-md-12">

 			<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
 				<div class="form-group">

 					<label for="med_name">
 						Medicine name
 					</label>
 					<input type="text" name="Med_name"  required class="form-control" id="med_name" />
 				</div>
 				<div class="form-group">

 					<label for="med_type">
 						Medicine Type
 					</label>
 					<input type="text" name="Med_type" required class="form-control" id="med_type" />
 				</div>
        <div class="form-group">

 					<label for="company_name">
 						Company name
 					</label>
 					<input type="text" name="Company_name" required class="form-control" id="company_name" />
 				</div>
        <div class="form-group">

 					<label for="manf_date">
 						Manufacturing Date
 					</label>
 					<input type="date" name="Manf_date" required class="form-control" id="manf_date" />
 				</div>
        <div class="form-group">

 					<label for="expiry_date">
 						expiry Date
 					</label>
 					<input type="date" name="Exp_date" required class="form-control" id="expiry_date" />
 				</div>
        <div class="form-group">

 					<label for="price">
 						Price
 					</label>
 					<input type="number" name="Price" required class="form-control" id="price" />
 				</div>
 				<button type="submit" class="btn btn-primary">
 					add
 				</button>
 			</form>

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
