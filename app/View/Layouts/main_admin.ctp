<!DOCTYPE html>
<html>
<head>	
	<title>		
		<?php echo $this->fetch('title'); ?>
	</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="<?=$this->webroot.'css/style.css'?>">

</head>
<body>
	<div id="container">
		<div id="header">
			
		</div>

		<div id="content">

			<?php echo $this->Flash->render(); ?>
			<?php echo $this->fetch('content'); ?>

		</div>

		<div id="footer">
			<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    		<script  src="<?=$this->webroot.'js/index.js'?>"></script>
		</div>		
	</div>
</body>
</html>
