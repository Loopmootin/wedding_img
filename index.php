<!DOCTYPE html>
<html>
	<head>

		<title>G&J Bryllup</title>

		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<link rel="stylesheet" type="text/css" media="screen" href="main.css" />
		<script src="main.js"></script>

	</head>

	<body>

	<div class="jumbotron">
		<h1>G&J Bryllupsbilleder</h1>
	</div>

	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">

			<div class="carousel-item active">
				<img class="d-block h-100" src="img/9.jpeg" alt="First slide">
			</div>

			<?php
				require_once('db_con.php');

				$sql = 'SELECT * FROM image WHERE id!=4';
				$stmt = $con->prepare($sql);
				$stmt->execute();
				$stmt->bind_result($id, $name, $url);

				while($stmt->fetch()){?>
					<div class="carousel-item">
						<img class="d-block h-100" src="<?=$url?>" alt="slide">
					</div>
			<?php }?>
	
		</div>
		<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

	<form id="uploadimage" class="uploadimage" action="" method="post" enctype="multipart/form-data">
		<div id="selectImage">
			<label>Her kan du uploade et nyt billede!</label>
			<input type="file" name="file" id="file" required /><br />
			<label for="file" class="custom-file">Upload Billede</label><br />
			<span id="file-selected"></span><br />
			<input type="submit" value="Upload" class="submit" />
		</div>
	</form>

	<div id="message"></div>

	<?php
	require_once('db_con.php');

    $sql = 'SELECT * FROM image';
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($id, $name, $url);

    while($stmt->fetch()){?>
            <div class="uploadedImg">
                <img src="<?=$url?>" class="preview-img" />
            </div>
    <?php }?>
</html>