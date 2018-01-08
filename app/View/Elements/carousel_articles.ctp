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
							<img src="/images/articles/<?=$value["Article"]["photo"]?>" alt="<?=$value["Article"]["title"]?>" style="height:350px; width:620px;border:10px solid #eee">
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