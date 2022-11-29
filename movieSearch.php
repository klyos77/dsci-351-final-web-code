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








	// genres
$sql_genres = "SELECT * FROM genre;";

$results_genres = $mysqli->query($sql_genres);

if ($results_genres == false){
	echo $mysqli->error;
	$mysqli->close();
	exit();
}

$sql_mpaa = "SELECT * FROM mpaa;";

$results_mpaa = $mysqli->query($sql_mpaa);

if ($results_mpaa == false){
	echo $mysqli->error;
	$mysqli->close();
	exit();
}

// 	//rating
// $sql_ratings = "SELECT * FROM ratings;";

// $results_ratings = $mysqli->query($sql_ratings);

// if ($results_ratings == false){
// 	echo $mysqli->error;
// 	$mysqli->close();
// 	exit();
// }



	//close db
$mysqli->close();


?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search Movie API</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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

	footer {
		text-align: center;
		padding: 3px;
		background-color: #343a40;
		height: 60px;
		color: white;
	}

	h1{
		margin: 0px;
		padding-top: 260px;
	}

	.footertext{
		margin: 0px;
		padding-top: 15px;
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



				<div class="container mt-5">

				</div> <!-- .container -->
				<div class="container">
					<form action="movieResult.php" method="GET">
						<div class="form-group row text-light">
							<label for="title-id" class="col-sm-3 col-form-label text-sm-right">title:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="title-id" name="title">
							</div>
						</div> <!-- .form-group -->
						<div class="form-group row text-light">
							<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
							<div class="col-sm-9">
								<select name="genre-id" id="genre-id" class="form-control">
									<option value="" selected>-- All --</option>

									<?php while ( $row = $results_genres->fetch_assoc() ) : ?>

										<option value='<?php echo $row['genre']; ?>'>
											<?php echo $row['genre']; ?>


										</option>

									<?php endwhile; ?>
								</select>
							</div>
						</div> <!-- .form-group -->


						<div class="form-group row text-light">
							<label for="mpaa-id" class="col-sm-3 col-form-label text-sm-right">MPAA Rating:</label>
							<div class="col-sm-9">
								<select name="mpaa-id" id="mpaa-id" class="form-control">
									<option value="" selected>-- All --</option>

									<?php while ( $row = $results_mpaa->fetch_assoc() ) : ?>

										<option value='<?php echo $row['mpaa']; ?>'>
											<?php echo $row['mpaa']; ?>


										</option>

									<?php endwhile; ?>
								</select>
							</div>
						</div> <!-- .form-group -->


						<div class="form-group row text-light">
							<label for="order-id" class="col-sm-3 col-form-label text-sm-right">Order By:</label>
							<div class="col-sm-9">
								<select name="order-id" id="order-id" class="form-control">
									<option value="" selected>-- All --</option>

									
									<option value='production_cost asc'>
										<?php echo 'production cost ascending'; ?>
									</option>

									<option value='rank asc'>
										<?php echo 'rank ascending'; ?>
									</option>

									<option value='worldwide_gross asc'>
										<?php echo 'worldwide box office ascending'; ?>
									</option>

									<option value='production_cost desc'>
										<?php echo 'production cost descending'; ?>
									</option>

									<option value='rank desc'>
										<?php echo 'rank descending'; ?>
									</option>

									<option value='worldwide_gross desc'>
										<?php echo 'worldwide box office descending'; ?>
									</option>

								</select>
							</div>
						</div> <!-- .form-group -->



						<div class="form-group row mt-5 mb-5">
							<div class="col-sm-3"></div>
							<div class="col-sm-9 mt-4">
								<button type="submit" class="btn btn-warning">Search</button>
								<button type="reset" class="btn btn-danger">Reset</button>
							</div>
						</div> <!-- .form-group -->
					</form>
				</div> <!-- .container -->

				<footer class="mt-5" >
					<p class="footertext">Author: Adrian Yang Email: aoboyang@usc.edu</p>
					
				</footer>








				

			</body>
			</html>




