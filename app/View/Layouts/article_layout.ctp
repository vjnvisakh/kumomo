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

	<style>
		
		::-webkit-scrollbar 
		{ 
    		display: none; 
		}

	</style>


</head>
<body style="height:1500px;margin:3%">

<div class="container-fluid">  
  <div class="row" style="padding:2%;border:1px solid #222">
	<div class="col-lg-4">
		<h3>Khaskhobor.in</h3>
	</div>
	<div class="col-lg-6 text-center">
		<a href="#">Home</a> |
		<a href="#">About Us</a> |
		<a href="#">Khaskhobor</a> |
		<a href="#">Advertisement</a> |
		<a href="#">Contact</a>
	</div>
	<div class="col-lg-2">

	</div>
  </div>
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
      <div class="col-lg-8">
        <?= $this->fetch('content'); ?>
      </div>
      <div class="col-lg-1"></div>
      <div class="col-lg-3" style="border:1px solid #eee">
        <h2>AD SPACE 1</h2>
      </div>
    </div>