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
  <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5a2bde5dc7cbb300136d9670&product=inline-share-buttons"></script>

	<style>
		
		::-webkit-scrollbar 
		{ 
			display: none; 
		}

	</style>

</head>
<body>

<div class="container-fluid">
	<?= $this -> element("header"); ?>
</div>

<div class="container-fluid" style="margin:0px;padding:0px">
	<div class="row">
	  <div class="col-lg-9" style="padding:5%">        
		<?= $this->fetch('content'); ?>
	  </div>
	  <div class="col-lg-3" style="border:1px solid #eee">
		
	  </div>
	</div>	
</div>

<footer>
		<center><?= $this -> element("footer"); ?></center>
</footer>
</body>