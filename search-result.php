<?php
// Include config file
require_once "assets/action/config.php";

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_GET["cat"]) && isset($_GET["search"])){
    $category = trim($_GET["cat"]);
    $search = trim($_GET["search"]);

    $query = $link->prepare ("SELECT * FROM transactions WHERE ? LIKE ?");
	$query->bind_param ('ss', $category, $search);

	//Updated Here
	$query -> execute();
	$tableArray = array();
    $counter = 0;

	$result = $query->get_result();
	while ($row = $result->fetch_assoc()) {
		$tableArray[$counter]['name'] = $row['name'];
        $tableArray[$counter]['citizenID'] = $row['citizenID'];
        $tableArray[$counter]['phone'] = $row['phone'];
    	$tableArray[$counter]['licensePlate'] = $row['licensePlate'];
        $tableArray[$counter]['vehicle'] = $row['vehicle'];
        $counter++;
	}


//Close Connection
mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $_GET["cat"]; ?> Results - <?php echo $_GET["search"]; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main-search.css?ver=1.0">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
					<div class="table">

						<div class="row header">
							<div class="cell">
								Name
							</div>
							<div class="cell">
								Citizen ID
							</div>
							<div class="cell">
								Phone
							</div>
							<div class="cell">
								License Plate
                            </div>
                            <div class="cell">
								Vehicle
							</div>
						</div>
                        <?php $i = 1; foreach($tableArray as $row) {?>
						<div class="row">
							<div class="cell" data-title="Name">
                            <?php echo $row['name'] ?>
							</div>
							<div class="cell" data-title="Citizen ID">
							<?php echo $row['citizenID'] ?>
							</div>
							<div class="cell" data-title="Phone">
							<?php echo $row['phone'] ?>
							</div>
							<div class="cell" data-title="License Plate">
							<?php echo $row['licensePlate'] ?>
                            </div>
                            <div class="cell" data-title="vehicle">
							<?php echo $row['vehicle'] ?>
							</div>
                        </div>
                        <?php } ?>
					</div>
			</div>
		</div>
	</div>


	

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main-search.js"></script>

</body>
</html>