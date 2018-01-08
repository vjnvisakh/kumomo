<!DOCTYPE html>
<html lang="en">
<head>
	<title>Khashkhobar.in</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		
		$(document).ready(function()
			{

				$.ajax
				(
					{
						url: '<?=$this->webroot.'Homes/fetchRecentCategories'?>'            
					}
				)
				.done(function(res) 
				{         
					$("#latest_categories").html(res);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});

		$.ajax
		(
			{
				url: '<?=$this->webroot.'categories/getFeaturedSections'?>'           
			}
		)
		.done(function(res) 
		{         
			$("#featured_categories").html(res);
		})
		.fail(function() 
		{
			console.log("error");
		});

				function reloadCarousel()
			{
				$.ajax
				(
					{
						type:"POST",
						data: {limit : 5},
						url: '<?=$this -> webroot . "homes/getArticlesForCarousel"?>',
						success: function (res) 
						{
							$("#carouselDiv").html(res);
							$(".carousel").carousel({
								interval: 5000
							
							});
						},
						error: function()
						{
						
						}
					}
				);
				}

					reloadCarousel();
					setInterval(reloadCarousel, 120000);        
			});

	</script>
	<style type="text/css">
		
	::-webkit-scrollbar 
	{
		width: 0px;  /* remove scrollbar space */
		background: transparent;  /* optional: just make scrollbar invisible */
	}

	</style>
</head>
<body style="background:#FBFBF1">

	<div class="container-fluid">
		<?= $this -> element("header"); ?>
	</div>

<!-- <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
	<a class="navbar-brand" href="#">Logo</a>
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" href="#">Link</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">Link</a>
		</li>
	</ul>
</nav> -->
	
<div class="container-fluid" style="padding:0px;margin:0px">
	<div class="row" style="background: #fff">
		<div class="col-sm-3 text-center" style="padding:3%;background: #fff">
			<?php
			
			if(isset($adList[1]))
			{
				$currAd = $adList[1];
?>
				<a href="javascript:void(0);" onclick="registerClick('<?=$currAd["link"]?>', <?=$currAd["id"]?>);">
					<img style="height:280px;width:280px;border:1px solid #222" src="<?php echo $this -> webroot. 'images/ads/' . $currAd["photo"]?>" alt='<?=$currAd["alt"]?>' />
				</a>
<?php
			}
			else 
			{
				
			}
?>
		</div>
		<div class="col-sm-6" id="carouselDiv">
			
		</div>
		<div class="col-sm-3" style="background:#FBFBF1">
			<?php
			if(isset($adList[2]))
			{
				$currAd = $adList[2];
?>
				<a href="javascript:void(0);" onclick="registerClick('<?=$currAd["link"]?>', <?=$currAd["id"]?>);">
					<img style="max-width : 100%; max-height: 100%; min-width : 100%; min-height: 100%;" src="<?php echo $this -> webroot. 'images/ads/' . $currAd["photo"]?>" alt='<?=$currAd["alt"]?>' />
				</a>
<?php
			}
			else 
			{
				
			}
?>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-9" style="padding:3%;background:#fff">
			<h2><b>বিভাগ</b></h2>
			<div class="row" id="latest_categories" style="padding:2%">

			</div>
		</div>
		<div class="col-sm-3" style="background:#FBFBF1;padding:2%">
			<?php
			if(isset($adList[3]))
			{
				$currAd = $adList[3];
?>
				<a href="javascript:void(0);" onclick="registerClick('<?=$currAd["link"]?>', <?=$currAd["id"]?>);">
					<img style="border:1px solid #222;height:250px;width:280px" src="<?php echo $this -> webroot. 'images/ads/' . $currAd["photo"]?>" alt='<?=$currAd["alt"]?>' />
				</a>
<?php
			}
			else 
			{
				
			}
?>
		</div>
	</div>

	<!-- THE FEATURED SECTION -->
	<div class="row">
		<div class="col-sm-9" id="featured_categories" style="background:#fff;padding-bottom:5%">
			
		</div>    
		<div class="col-sm-3">
			<!-- AD SPACE -->
		</div>
	</div>
	<!-- THE FEATURED SECTION -->

</div>

<footer>
		<center><?= $this -> element("footer"); ?></center>
</footer>
</body>
</html>
