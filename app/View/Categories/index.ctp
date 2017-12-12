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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5a2bde5dc7cbb300136d9670&product=inline-share-buttons' async='async'></script>
</head>
<body>
	<div class="container-fluid" style="background:#343434;border-top:5px solid #404040;"> 
		<?= $this -> element("header"); ?>
	</div>

	<div class="container">
		<div class="row adSpace" style="border:1px solid #fff;margin-top:1%">
			
		</div>
	</div>

	<div class="container" style="margin-top:1%">
		<div class="row">
			<div class="col-lg-8" style="border:1px solid #fff;padding:1%">
<?php
	
				if(!empty($articles))
				{
					foreach($articles as $article)
					{
?>
						<div class="row" style="margin:1%;border-bottom:1px solid #eee">
							<div class="col-lg-3" style="border:1px solid #fff;padding:3%">
								<img style="border:5px solid #fff;box-shadow:0px 1px 1px" width="160" height="160" src="<?=$this->webroot.'images/articles/'.$article['a']['photo']?>">
							</div>
							<div class="col-lg-9" style="border:1px solid #fff;padding:4%">
								<h5>
									<a style="text-decoration: none; color: #000;" target="_blank" href='<?=$this -> webroot . "homes/article/" . $article["a"]["id"]?>'>
										<b><?=$article["a"]["title"]; ?></b>
									</a>	
								</h5>
								<p style="text-align:justify;">		
									<span class="help-block" style="font-size:80%;color:#aaa">
										<?=date("F jS",strtotime($article["a"]["created"])); ?>
									</span><br>
									<?=substr($article["a"]["content"],0,250)." ..." ?>
									<div class="row">
										<div class="col-lg-12">
											<div class="sharethis-inline-share-buttons"></div>
										</div>
									</div>
								</p>
							</div>
						</div>
<?php
					}
				}
?>
			</div>
			<div class="col-lg-4" style="border:1px solid #fff;padding:2%;border-left:1px solid #eee">
<?php
				
				if(!empty($ads))
				{
					foreach($ads as $ad)
					{
?>
						<div class="row" style="margin:1%;padding:4%">
							<div class="col-lg-12">
								<a target="blank" href="<?=$ad['ads']['link']?>">
									<img class="img-thumbnail" src="<?=$this -> webroot.'images/ads/'.$ad['ads']['photo'];?>">
								</a>
							</div>
						</div>
<?php
					}
				}
?>


			</div>
		</div>
	</div>

	<!-- FOOTER SECTION -->
	<div class="container-fluid" style="margin-top:5%"> 
		<?=$this -> element("footer"); ?>
	</div>
	<!-- FOOTER SECTION -->
</body>
</html>  