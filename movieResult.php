<?php 

$host = "303.itpwebdev.com";
$user = "aoboyang_user1";
$pass = "yab1999yab!";
$db = "aoboyang_dsci351";

$mysqli = new mysqli($host, $user, $pass, $db);


if($mysqli->connect_errno){
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

	//sql queries


$sql1 = "SELECT *

FROM movie1

WHERE 1 = 1";



if (isset($_GET['title']) && !empty($_GET['title'])) {
	$title = $_GET['title'];
	$sql1 = $sql1 . " AND title LIKE '%$title%'";
}


if (isset($_GET['genre-id']) && !empty($_GET['genre-id'])) {
	$genre = $_GET['genre-id'];
	$sql1 = $sql1 . " AND genre = '$genre'";
}

if (isset($_GET['mpaa-id']) && !empty($_GET['mpaa-id'])) {
	$mpaa = $_GET['mpaa-id'];
	$sql1 = $sql1 . " AND mpaa = '$mpaa'";
}

if (isset($_GET['order-id']) && !empty($_GET['order-id'])) {
	$order = $_GET['order-id'];
	$sql1 = $sql1 . " order by $order";
}


// if(isset($_GET['release_date_from']) && !empty($_GET['release_date_from']) && isset($_GET['release_date_to']) && !empty($_GET['release_date_to'])){
// 		$release_date_from = $_GET['release_date_from'];
// 		$release_date_to = $_GET['release_date_to'];
// 		$sql1 = $sql1 . " AND worldwide_gross between $release_date_from and $release_date_to";
// }else if (isset($_GET['release_date_from']) && !empty($_GET['release_date_from'])) {
// 		$release_date = $_GET['release_date_from'];
// 		$sql1 = $sql1 . " AND worldwide_gross = $release_date";
// }else if (isset($_GET['release_date_to']) && !empty($_GET['release_date_to'])){
// 		$release_date = $_GET['release_date_to'];
// 		$sql1 = $sql1 . " AND worldwide_gross = $release_date";
// }else{

// }


$sql1 = $sql1 . ";";










$results1 = $mysqli->query($sql1);




$sql2 = "SELECT *

FROM movie2

WHERE 1 = 1";



if (isset($_GET['title']) && !empty($_GET['title'])) {
	$title = $_GET['title'];
	$sql2 = $sql2 . " AND title LIKE '%$title%'";
}


if (isset($_GET['genre-id']) && !empty($_GET['genre-id'])) {
	$genre = $_GET['genre-id'];
	$sql2 = $sql2 . " AND genre = '$genre'";
}


if (isset($_GET['mpaa-id']) && !empty($_GET['mpaa-id'])) {
	$mpaa = $_GET['mpaa-id'];
	$sql2 = $sql2 . " AND mpaa = '$mpaa'";
}


if (isset($_GET['order-id']) && !empty($_GET['order-id'])) {
	$order = $_GET['order-id'];
	$sql2 = $sql2 . " order by $order";
}


// if(isset($_GET['release_date_from']) && !empty($_GET['release_date_from']) && isset($_GET['release_date_to']) && !empty($_GET['release_date_to'])){
// 		$release_date_from = $_GET['release_date_from'];
// 		$release_date_to = $_GET['release_date_to'];
// 		$sql2 = $sql2 . " AND worldwide_gross between $release_date_from and $release_date_to";
// }else if (isset($_GET['release_date_from']) && !empty($_GET['release_date_from'])) {
// 		$release_date = $_GET['release_date_from'];
// 		$sql2 = $sql2 . " AND worldwide_gross = $release_date";
// }else if (isset($_GET['release_date_to']) && !empty($_GET['release_date_to'])){
// 		$release_date = $_GET['release_date_to'];
// 		$sql2 = $sql2 . " AND worldwide_gross = $release_date";
// }else{





$sql2 = $sql2 . ";";



$results2 = $mysqli->query($sql2);

$sql1 = substr($sql1, 0, -1);


if (isset($_GET['order-id']) && !empty($_GET['order-id'])) {
	$sql1 = rtrim($sql1, "order by $order");
}


$sql3 = $sql1 . ' union all ' . $sql2;

$results3 = $mysqli->query($sql3);





if(!$results1){
	echo $mysqli->error;
	$mysqli->close();
	exit();
}

if(!$results2){
	echo $mysqli->error;
	$mysqli->close();
	exit();
}


if (isset($_GET['order-id']) && !empty($_GET['order-id'])) {
	$sql1 = $sql1." order by $order;";
}else{
	$sql1 = $sql1.";";
}


	//close db
$mysqli->close();


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DVD Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style>
	


	#header{
		background-image: url('https://s3-us-west-2.amazonaws.com/prd-rteditorial/wp-content/uploads/2018/03/13153742/RT_300EssentialMovies_700X250.jpg');
		height: 400px;
		background-size: cover;
		background-position: center;
		color: #FFF;
		text-align: center;
		line-height: 300px;
		text-shadow: 0px 0px 10px #000;



	}

	h1{
		margin: 0px;
		padding-top: 260px;
	}

	footer {
		text-align: center;
		padding: 3px;
		background-color: #343a40;
		height: 60px;
		color: white;
	}
	

	body{
		margin: 0px;
		background-color: #212529;
	}



	

	#whitespace{
		opacity: 0;
	}




</style>
<body>
	<div id="header" class="container-fluid text-center">
		<h1>Top 500 Movies </h1>
	</div> <!-- #header -->




	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="movieSearch.php">Movie Searcher</a>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="movieSearch.php">Home</a>
					</li>


				</nav>

				<div class="container text">
					<div class="row mb-4">
						<div class="col-12 mt-4">
							<a href="movieSearch.php" role="button" class="btn btn-warning">Back to Form</a>
						</div> <!-- .col -->
					</div> <!-- .row -->
					<div class="row text-light">
						<div class="col-12">

							Showing <?php $resultNum1 =  $results1->num_rows;

							$resultNum2 =  $results2->num_rows;

							$resultNumTotal = $resultNum1 + $resultNum2;


							echo $resultNumTotal;

						?> result(s) from 500 results.

					</div> <!-- .col -->

					<div class="col-12">

						Showing <?php $resultNum1 =  $results1->num_rows;


						echo $resultNum1;

					?> result(s) from movie1.

					Showing <?php $resultNum2 =  $results2->num_rows;


					echo $resultNum2;

				?> result(s) from movie2.

			</div> <!-- .col -->

			<div class="col-12 text-light">

				Movie1 query: <?php 


				echo $sql1;

				?> 



			</div> <!-- .col -->

			<div class="col-12 text-light">

				Movie2 query: <?php 


				echo $sql2;

				?> 

			</div> <!-- .col -->

			<div class="col-12 text-light">

				Movie3 query: <?php 


				echo $sql3;

				?> 

			</div> <!-- .col -->




			<div class="col-12 text-center">
				<table class="table table-hover table-responsive table-striped table-dark mt-4">
					<thead>
						<tr>

							<th>Rank</th>

							<th>DVD Title</th>

							<th>Release Date</th>

							<th>Production Cost</th>

							<th>Worldwide Box Office</th>

							<th>Genre</th>

							<th>MPAA Rating</th>

							<th>URL</th>

						</tr>
					</thead>
					<tbody>
						<?php while ( $row = $results3->fetch_assoc() ) : ?>
							<tr>

								<td>

									<?php echo $row['rank']; ?>

								</td>

								<td>

									<?php echo $row['title']; ?>

								</td>


								<td>

									<?php echo $row['release_date']; ?>

								</td>


								

								<td>

									<?php echo $row['production_cost']; ?>

								</td>

								<td>

									<?php echo $row['worldwide_gross']; ?>

								</td>


								<td>
									<?php echo $row['genre']; ?>
								</td>

								<td>
									<?php echo $row['mpaa']; ?>
								</td>


								<td>
									<?php echo 'https://www.the-numbers.com/'.$row['url']; ?>
								</td>


							</tr>
						<?php endwhile; ?>




					</tbody>
				</table>
			</div> <!-- .col -->

		</div> <!-- .row -->


		




		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="movieSearch.php" role="button" class="btn btn-warning">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->

	
		<footer class="mt-5" >
			<p class="footertext">Author: Adrian Yang Email: aoboyang@usc.edu</p>
			
		</footer>
</body>
</html>