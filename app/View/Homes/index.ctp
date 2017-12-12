<!DOCTYPE html>
<html lang="en">
<head>
  <title>Khashkhobar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
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

	<style>
		
		::-webkit-scrollbar 
		{ 
    		display: none; 
		}

		.dropdown-menu
		{
			background-color: #286090 !important;
		}

	</style>


</head>
<body>

<div class="container-fluid" style="background:#343434;border-top:5px solid #404040"> 
	<?= $this -> element("header"); ?>
</div>

<?php
$html = "";
$parent = 0;
$parentStack = array();

// $navbarElements contains the results of the SQL query
$children = array();
//print_r($navbarElements);

	if(!empty($navbarElements))
	{
?>
		<nav style="background:#286090" class="navbar navbar-expand-sm navbar-dark sticky-top navbar-toggleable-md">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myNavbar">
					<span class="navbar-toggler-icon"></span>
				</button>
				<a class="navbar-brand" href="#">Khashkhobar</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
<?php
	}
	foreach ( $navbarElements as $navbarElement)
	{
		$children[$navbarElement["categories"]["parent_id"]][] = $navbarElement["categories"];
	}
	//pr($children);
	while(($option = each($children[$parent])) || ($parent > 0))
	{
		//print_r($option);
			if (!empty($option))
			{
					// 1) The item contains children:
					// store current parent in the stack, and update current parent
					if(!empty($children[$option["value"]["id"]]))
					{
?> 						
						<li class="dropdown">
							<a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">
								<?=$option["value"]["title"]?>
								<span class="caret"></span></a>
							</a>
						<ul class="dropdown-menu">
<?php
							array_push($parentStack, $parent);
							$parent = $option["value"]["id"];
					}
					// 2) The item does not contain children
					else
					{
?>
						<li class="nav-item">
						<a href="#" class="nav-link">
								<?=$option["value"]["title"]?>
						</a>
						</li>
<?php
					}
							
			}
			// 3) Current parent has no more children:
			// jump back to the previous menu level
			else
			{
?>
				</ul>
				</li>
<?php
					$parent = array_pop($parentStack);
			}
	}
?>
	</ul>
	</div>
	</div>
	
</nav>


<div class="container-fluid">

	<div class="row">
	<!-- THE LEFT AD PANEL -->
		<div class="col-lg-2" style="padding:1%">
<?php
			if(isset($adList[1]))
			{
				$currAd = $adList[1];
?>
				<a href="javascript:void(0);" onclick="registerClick('<?=$currAd["link"]?>', <?=$currAd["id"]?>);">
					<img style="max-width : 100%; max-height: 100%; min-width : 100%; min-height: 100%;" src="<?php echo $this -> webroot. 'images/ads/' . $currAd["photo"]?>" alt='<?=$currAd["alt"]?>' />
				</a>
<?php
			}
			else 
			{
				echo "<h3>AD SPACE 1</h3>";
			}
?>
		</div>
	<!-- THE LEFT AD PANEL -->


	<!-- THE CENTER PANEL -->
		<div id="carouselDiv" class="col-lg-7 text-center"style="padding:1%">
			<!-- CAROUSEL GOES HERE -->
		</div>
	<!-- THE CENTER PANEL -->


	<!-- THE RIGHT DETAILS PANEL -->
		<div class="col-lg-3">

				<!-- THE DETAILS BOX -->
				<div class="row" style="background:#E4E4E4;padding-top:5%;">					
					<ul style="list-style-type:none">
						<h4>Get in Touch</h4>
						<li>Home</li>
						<li>About Us</li>
						<li>Khaskhobor</li>
						<li>Advertisement</li>
						<li>Contact</li>
					</ul>
				</div>
				<!-- THE DETAILS BOX -->			

		</div>
	<!-- THE RIGHT DETAILS PANEL -->
	</div>


	<br />
	<div class="row" style="padding:1%">

			<div class="col-lg-8" style="border:1px solid #eee;color:#fff">
				<div class="row" style="background:#286090;padding:1%;">
					<div class="col-lg-10">
						<span>Popular Categories</span>
					</div>
					<div class="col-lg-2 text-right">
						<span style="font-size:90%">more</span>
					</div>
				</div>				
				<div class="row" style="padding:2%" id="latest_categories">
					
				</div>
			</div>
			
			<div class="col-lg-1"></div>
			<!-- THE RIGHT SIDE AD -->
			<div class="col-lg-3" style="padding:1%;border:1px solid #eee">
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
				echo "<h3>AD SPACE 2</h3>";
			}
?>
			</div>
			<!-- THE RIGHT SIDE AD -->

	</div>

	<br />
	<!-- THE NEWS IN BRIEF  -->
<?php
	if(!empty($articleList))
	{
		//pr($articleList);
		$articleCount = count($articleList);
?>
		<div class="row">
		<div class="col-lg-9" style="border:1px solid #222;padding:3%">
			<h3 align="center">Latest News</h3>
			<div class="row" style="margin-bottom:1%">				
				<div class="col-lg-2" style="padding:1%">
					<a target="_blank" href="<?php echo $this -> webroot . 'homes/article/' . $articleList[0]["a"]["id"] ?>">
						<img 
							style="max-width : 100%; max-height: 100%; min-width : 100%; min-height: 100%;" 
							src="<?php echo $this -> webroot . 'images/articles/' . $articleList[0]["a"]["photo"]?>" 
							alt='<?=$articleList[0]["a"]["title"]?>' />
					</a>
				</div>
				<div class="col-lg-10" style="padding:5%">
					<ul>
<?php
				for($index = 0; $index < $articleCount; $index++)
				{
?>
					<li type="square"><h6>
						<a style="color:black;" target="_blank" href="<?php echo $this -> webroot . 'homes/article/' . $articleList[$index]["a"]["id"] ?>">
							<?=$articleList[$index]["a"]["title"]?>
						</a>
					</h6></li>
<?php
				}
?>
				</ul>
				</div>
			</div>
<!-- COMMENTED OUT CODE IN CASE WE NEED THE ARTICLES IN SEPARATE DIVS -->
<!-- <?php
		for($index = 1; $index < $articleCount; $index++)
		{
?>
			<div class="row" style="margin-bottom:1%">				
					<div class="col-lg-2" style="padding:5%;"></div>
					<div class="col-lg-10" style="padding:5%">
					<h6>
						<a style="color:black;" target="_blank" href="<?php echo $this -> webroot . 'homes/articles/' . $articleList[$index]["a"]["id"] ?>">
							<?=$articleList[$index]["a"]["title"]?>
						</a>
					</h6>
				</div>
			</div>
<?php
		}
?> -->
		</div>
<?php
	}
?>
	

		<div class="col-lg-3 text-center" style="padding:1%">
<?php
			if(isset($adList[3]))
			{
				$currAd = $adList[3];
?>
				<a href="javascript:void(0);" onclick="registerClick('<?=$currAd["link"]?>', <?=$currAd["id"]?>);">
					<img style="max-width : 100%; max-height: 100%; min-width : 100%; min-height: 100%;" src="<?php echo $this -> webroot. 'images/ads/' . $currAd["photo"]?>" alt='<?=$currAd["alt"]?>' />
				</a>
<?php
			}
			else 
			{
				echo "<h3>AD SPACE 3</h3>";
			}
?>
		</div>
	</div>
	<!-- THE NEWS IN BRIEF  -->
	
	<br />





	<?= $this -> element("footer"); ?>






</div>
</body>
<script>

	function registerClick(url, adId)
	{
		$.ajax
		(
			{
				type:"POST",
				data: {adId: adId},
				url: <?=json_encode($this -> webroot . "ads/registerClick");?>,
				success: function (res) 
				{
					window.open(url).focus();
				},
				error: function()
				{
					
				}
			}
		); 
	}
</script>
</html>
