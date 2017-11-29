
<div class="container-fluid" style="background:#f8f8f8">
	<br>
	<div class="row">
		<div class="col-lg-3">
			<a href=""><h3>Khashkhabor.in</h3></a> <?php //TANUSHREE - KM1#COMMIT#2 - Corrected the website name ?> 
			<p>Your news corner</p>
		</div>

		<div class="col-lg-9" style="text-align:right">
			<ul style="list-style-type:none">
				<li>Home</li>
				<li>About Us</li>
				<li>Khashkhabor</li>
				<li>Advertisement</li>
				<li>Contact</li>
			</ul>
		</div>
	</div>

	<br />
</div>

<?php
$html = '';
$parent = 0;
$parent_stack = array();

// $navbarElements contains the results of the SQL query
$children = array();
//print_r($navbarElements);

	if(!empty($navbarElements))
	{
?>
		<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				</button>
				<a class="navbar-brand" href="#">Khashkhabor</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
<?php
	}
	foreach ( $navbarElements as $navbarElement)
	{
		$children[$navbarElement["categories"]["parent_id"]][] = $navbarElement["categories"];
	}
	
	while ( ( $option = each( $children[$parent] ) ) || ( $parent > 0 ) )
	{
		//print_r($option);
			if ( !empty( $option ) )
			{
					// 1) The item contains children:
					// store current parent in the stack, and update current parent
					if ( !empty( $children[$option['value']['id']] ) )
					{
?> 						
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<?=$option['value']['title']?>
								<span class="caret"></span></a>
							</a>
						<ul class="dropdown-menu iconNav">
<?php
							array_push( $parent_stack, $parent );
							$parent = $option['value']['id'];
					}
					// 2) The item does not contain children
					else
					{
?>
						<li>
						<a href="#">
								<?=$option['value']['title']?>
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
					$parent = array_pop( $parent_stack );
			}
	}
?>
	</ul>
	</div>
	</div>
	
</nav>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-3">
			Left ad space
		</div>
		
		<!-- THE CENTER SCREEN -->
		<div class="col-lg-6">      
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner">

						<div class="item active">
							<img src="<?=$this->webroot.'images/la.jpg'?>" alt="Los Angeles" style="width:100%;">
							<div class="carousel-caption">
								<h3>Los Angeles</h3>
								<p>LA is always so much fun!</p>
							</div>
						</div>

						<div class="item">
							<img src="<?=$this->webroot.'images/chicago.jpg'?>" alt="Chicago" style="width:100%;">
							<div class="carousel-caption">
								<h3>Chicago</h3>
								<p>Thank you, Chicago!</p>
							</div>
						</div>
					
						<div class="item">
							<img src="<?=$this->webroot.'images/ny.jpg'?>" alt="New York" style="width:100%;">
							<div class="carousel-caption">
								<h3>New York</h3>
								<p>We love the Big Apple!</p>
							</div>
						</div>
				
					</div>

					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>      
		</div>
		
		<div class="col-lg-3">
			Right Ad space
		</div>
	</div>
</div>