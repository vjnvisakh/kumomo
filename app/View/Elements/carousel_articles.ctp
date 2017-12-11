<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script> -->
<?php 
	if(!empty($articleList))
	{
?>
		<div class="container">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
<?php
				foreach($articleList as $key => $value)
				{
					if($key == 0)
					{
?>
					<li data-target="#myCarousel" data-slide-to="<?=$value["Article"]["id"]?>" class="active"></li>
<?php
					}
					else 
					{
?>
						<li data-target="#myCarousel" data-slide-to="<?=$value["Article"]["id"]?>"></li>
<?php
					}

				}
?>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
<?php
					foreach($articleList as $key => $value)
				{
					if($key == 0)
					{
?>
					<div class="carousel-item active">
<?php
					}
					else 
					{
?>
						<div class="carousel-item">
<?php
					}
?>
							<img src="images/articles/<?=$value["Article"]["photo"]?>" alt="<?=$value["Article"]["title"]?>" style="min-height: 400px; width:100%; max-height:400px">
							<div class="carousel-caption">
									<h3><?=$value["Article"]["title"]?></h3>
							</div>
						</div>
<?php
				}
?>

				</div>

				<!-- Left and right controls -->
				<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
					<span class="carousel-control-prev-icon"></span>
				</a>
				<a class="carousel-control-next" href="#myCarousel" data-slide="next">
					<span class="carousel-control-next-icon"></span>
				</a>
			</div>
		</div>
<?php
	}
?>