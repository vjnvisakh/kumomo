<div class="container-fluid" style="background:#f8f8f8">
  <br>
  <div class="row">
    <div class="col-lg-3">
      <a href=""><h3>Khaskhobor.in</h3></a>
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