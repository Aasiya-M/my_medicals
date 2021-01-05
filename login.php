<!DOCTYPE html>
<?php


$error = '';
$conn = new mysqli('localhost','admin','admin','medicalStore');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $email =$_POST['email'];
  $password =$_POST['password'];

   $q = "SELECT * FROM `Customer` WHERE `email`='".$email."' ";
  if (empty($_POST)) {
    echo $q;
  } else {
    $result = $conn->query($q);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if($row['password'] === $password) {
           session_start();
           $_SESSION['user'] = $row;
           $_SESSION['user']['cart'] = [];
            echo "session created";
            if(isset($_SESSION['user'])) {

              header("Location: http://localhost/medicalstore/index.php");
            }
        } else {

           $error = "invalid email or password";
        }


   } else {
    $error = "Error: " . $q . "<br>" . $conn->error;
   }
  }

} else {
  if(!empty($_GET['logout'])){
    session_destroy();
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
					<form class="form-inline">
						<input class="form-control mr-sm-2" type="text">
						<button class="btn btn-primary my-2 my-sm-0" type="submit">
							Search
						</button>
					</form>

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
        </div>
       </div>
       <div class="row">
     		<div class="col-md-12">

 			<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
 				<div class="form-group">

 					<label for="email">
 						Email
 					</label>
 					<input type="text" name="email"  required class="form-control" id="email" />
 				</div>
 				<div class="form-group">

 					<label for="password">
 						Password
 					</label>
 					<input type="password" name="password" required class="form-control" id="password" />
 				</div>

 				<button type="submit" class="btn btn-primary">
 				Login
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
