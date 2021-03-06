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
				include('db_con.php');

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
			<label for="file" class="custom-file">Vælg Billede</label><br />
			<span id="file-selected"></span><br />
			<input type="submit" value="Upload" class="submit" />
		</div>
		<div id="message"></div>
	</form>

	
	<div id="image-container">

		<?php
			include('db_con.php');

			$sql = 'SELECT * FROM image LIMIT 6';
			//$stmt = $con->prepare($sql);
			//$stmt->execute();
			//$stmt->bind_result($id, $name, $url);

			$result = mysqli_query($con, $sql);

			if(mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)){
		?>
					<div class="uploadedImg">
						<img id="my-img<?=$row['id']?>" src="<?=$row['url']?>" class="preview-img" data-toggle="modal" data-target="#exampleModal<?=$row['id']?>" />
					</div>
					
					<div class="modal fade" id="exampleModal<?=$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<img id="my-img<?=$row['id']?>" src="<?=$row['url']?>" class="modal-img"/>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
							</div>
						</div>
					</div>
			<?php }

			} else {
				echo "Der er ingen billeder!";
			}
			?>
			
	</div>

		<button class="show-more" id="show-more">Vis flere</button>
	</body>
</html>