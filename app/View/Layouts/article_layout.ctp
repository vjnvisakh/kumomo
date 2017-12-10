<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
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

<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
  <a class="navbar-brand" href="#">Logo</a>
  <ul class="navbar-nav">
	<li class="nav-item">
	  <a class="nav-link" href="#">Link</a>
	</li>
	<li class="nav-item">
	  <a class="nav-link" href="#">Link</a>
	</li>
  </ul>
</nav>


<div class="container-fluid">
	<div class="row">

	  <div class="col-lg-9" style="padding:2%">        
		<?= $this->fetch('content'); ?>
	  </div>

	  <div class="col-lg-3" style="border:1px solid #eee">
		<h2>AD SPACE 1</h2>
	  </div>
	</div>	
</div>


<div class="container-fluid" style="margin-top:10%">
	<!-- FOOTER SECTION -->
	<?= $this -> element("footer"); ?>	
	<!-- FOOTER SECTION -->
</div>

</body>