<!DOCTYPE html>
<html lang="en">
<head>
  <title>Administrator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/9f1ff0ac9a.js"></script>
	<style>
		
		::-webkit-scrollbar 
		{ 
			display: none; 
		}

		.round
		{
			border-radius:50%;
			border:5px solid #286090;			
			margin:2%;
			height: 140px;
			width: 140px;			
			font-size:200%;
			background:#eee;
			text-align: center;
			padding-top:4%;
			font-weight: bold;			
		}



	</style>


	<script>


		var parentId = 0;

		$(document).ready(function()
		{            
			loadAllArticles();
			loadAllAdvertisements();
			loadStats();
			loadCategories();
			fetchSiteHits();

			$("#bpublish").click(function()
			{
				var articleDetails = {};

				if($.trim($("#ttitle").val()) == "" || $.trim($("#ttext").val()) == "")
				{
					alert("Please enter the title and content for the article.");
					return false;
				}
				
				articleDetails["title"] = $("#ttitle").val();
				articleDetails["content"] = $("#ttext").val();
				articleDetails["categories"] = [];
				articleDetails["caption"] = $("#tcaption").val();

				$("#tcat :selected").each(function()
				{
					articleDetails["categories"].push($(this).val()); 
				});

				if(articleDetails["categories"].length == 0)
				{
					alert("Please select atleast one category.");
					return false;
				}
				var articleJSON = JSON.stringify(articleDetails);

				var articleData = new FormData($("#articleFileUpload")[0]);
				articleData.append("articleJSON", articleJSON);

				$.ajax
				(
					{
						type:"POST",
						data: articleData,
						contentType: false,
						processData: false,
						url: <?=json_encode($this->webroot.'Admins/addArticle');?>,
						success: function (res) 
						{
							console.log(res);
							loadAllArticles();
						},
						error: function()
						{
							
						}
					}
				);
			});

			$("#badvert").click(function()
			{
				// var talt = $("#talt").val();
				// var tlink = $("#tlink").val();
				// var tpos = $("#tsel").val();
				//var ttitle = $("#tpic").val();  
				
				var advert = {};
				advert["alt"] = $("#talt").val();
				advert["link"] = $("#tlink").val();
				advert["position"] = $("#tsel").val();
				
				var advertJSON = JSON.stringify(advert);

				var advertData = new FormData($("#advertFileUpload")[0]);
				advertData.append("advertJSON", advertJSON);

				$.ajax
				(
					{
						type:"POST",
						data: advertData,
						contentType: false,
						processData: false,
						url: <?=json_encode($this->webroot.'Admins/addAdvertisement');?>,
						success: function (res) 
						{
							loadAllAdvertisements();                                                     
						},
						error: function()
						{
							
						}
					}
				);
			});

			$("#bcat").click(function()
			{
				var title = $("#cat_name").val();
				
				$.ajax
				(
					{
						type:"POST",
						data:
						{					
							title:title,
							parent:0
						},
						url: <?=json_encode($this->webroot.'Admins/addCategory');?>,
						success: function (res) 
						{
							$("#cat_name").val('');
							loadCategories();
						},
						error: function()
						{
							
						}
					}
				);
			});            

			$("#bsubcat").click(function()
			{
				var title = $("#sub_cat_name").val();
				
				$.ajax
				(
					{
						type:"POST",
						data:
						{					
							title:title,
							parent:parentId
						},
						url: <?=json_encode($this->webroot.'Admins/addCategory');?>,
						success: function (res) 
						{
							$("#sub_cat_name").val('');
							getAllSubCategories(parentId);
						},
						error: function()
						{
							
						}
					}
				);
			});


			
			


			          

			function  loadAllAdvertisements()
			{
				$.ajax
				(
					{
						type:"POST",
						data:
						{					
							
						},
						url: <?=json_encode($this->webroot.'Admins/getAllAdvertisements');?>,
						success: function (res) 
						{
							$("#adTbody").html(JSON.parse(res));
							// To generate the datatable
							$("#tab_advert").DataTable();
							// To generate the datatable
						},
						error: function()
						{
							
						}
					}
				);
			}
			
			// This method is called to fetch the statistics of the site
			// Called at page load time
			function loadStats()
			{
				$.ajax
				(
					{
						type:"POST",
						url: <?=json_encode($this->webroot.'Admins/stats');?>,
						success: function (res) 
						{							
							res = JSON.parse(res);
							var countArr = res.split("|");
							
							var articles = countArr[0];
							var categories = countArr[1];
							var ads = countArr[2];
							var users = countArr[3];

							$("#div_article").html(articles);
							$("#div_category").html(categories);
							$("#div_ad").html(ads);
							$("#div_user").html(users);
						},
						error: function()
						{
							
						}
					}
				);
			}


			

			
		});
		

		function loadCategories()
		{
			$.ajax
			(
				{
					type:"POST",
					data:
					{					
						
					},
					url: <?=json_encode($this->webroot.'Admins/getAllCategories');?>,
					success: function (res) 
					{
						$("#cat_load").html(JSON.parse(res));
					},
					error: function()
					{
						
					}
				}
			);
		}

		// TO ADD A NEW SUB CATEGORY
		function getAllSubCategories(id)
		{
			parentId = id;
			$("#div_sub").show();

			$.ajax
			(
				{
					type:"POST",
					data:
					{					
						id:id
					},
					url: <?=json_encode($this->webroot.'Admins/getAllSubCategories');?>,
					success: function (res) 
					{
						$("#sub_cat_load").html(JSON.parse(res));
					},
					error: function()
					{
						
					}
				}
			);
		}

		// TO DELETE A CATEGORY
		function delCat(id)
		{                        
			$.ajax
			(
				{
					type:"POST",
					data:
					{					
						id:id
					},
					url: <?=json_encode($this->webroot.'Admins/deleteCategory');?>,
					success: function (res) 
					{
						loadCategories();
						$("#div_sub").hide();
					},
					error: function()
					{
						
					}
				}
			);
		}


		// TO DELETE A SUB-CATEGORY
		function delSubCat(id)
		{                        
			$.ajax
			(
				{
					type:"POST",
					data:
					{					
						id:id
					},
					url: <?=json_encode($this->webroot.'Admins/deleteCategory');?>,
					success: function (res) 
					{
						getAllSubCategories(parentId);
					},
					error: function()
					{
						
					}
				}
			);
		}

		function loadAllArticles()
		{
			$.ajax
			(
				{
					type:"POST",
					data:
					{					
						
					},
					url: <?=json_encode($this->webroot.'Admins/getAllArticles');?>,
					success: function (res) 
					{
						$("#arTbody").html(res);
						// To generate the datatable
						$("#tab_article").DataTable();
						// To generate the datatable
					},
					error: function()
					{
						
					}
				}
			);
		}  

		// This method is used to delete the particular article
		function deleteArticle(articleId)
		{

			$.ajax
			(
				{
					type:"POST",
					data:
					{					
						articleId:articleId
					},
					url: <?=json_encode($this->webroot.'Admins/deleteArticle');?>,
					success: function (res) 
					{
						loadAllArticles();			
					},
					error: function()
					{
						
					}
				}
			);			
		}

		// This method is used to deactivate the particular article
		function deactivateArticle(articleId)
		{

			$.ajax
			(
				{
					type:"POST",
					data:
					{					
						articleId:articleId
					},
					url: <?=json_encode($this->webroot.'Admins/deactivateArticle');?>,
					success: function (res) 
					{
						loadAllArticles();			
					},
					error: function()
					{
						
					}
				}
			);			
		}

		// This method is used to fetch the website hits
		function fetchSiteHits(graphType = "column")
		{			
			$.ajax
			(
				{
					url: <?=json_encode($this->webroot.'Admins/fetchSiteHits');?>						
				}
			)
			.done(function(res) 
			{
				res = JSON.parse(res);
				console.log(res);

				var chart = new CanvasJS.Chart("chartContainer", 
				{
					animationEnabled: true,
					theme: "light2", // "light1", "light2", "dark1", "dark2"
					title:
					{
						text: "Performance"
					},
					axisY: 
					{
						title: "Page hits"
					},
					data: [{        
						type: graphType,  
						showInLegend: true, 
						legendMarkerColor: "grey",
						legendText: "Days",
						dataPoints: res
					}]
				});
				chart.render();
			})
			.fail(function() 
			{
				console.log("error");
			})
			.always(function() 
			{
				console.log("complete");
			});				
		}


		function hitMe(graphType)
		{			
			fetchSiteHits(graphType);
		}

	</script>



</head>
<body style="padding:4%;background:#eee">

<div class="container-fluid" style="border:1px solid #222;background:#fff">
  
  <div class="row" style="padding:2%;background:#286090;color:#fff">    
	<a href="<?=$this->webroot?>Admins/logout"><button class="btn btn-primary btn-sm" style="float:right">Logout</button></a>
	<a href="#"><button class="btn btn-primary btn-sm" style="float:right"><i class="fa fa-cogs" aria-hidden="true"></i></button></a>
	<h2><b>Administrator</b></h2>
	<p><small>This is your primary dashboard. All your settings can be tweaked over here</small></p>
  </div>
  <br />

  <ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" style="border:0px" href="#home">Statistics</a></li>    
	<li><a data-toggle="tab" style="border:0px" href="#menu0">Categories</a></li>
	<li><a data-toggle="tab" style="border:0px" href="#menu1">Articles</a></li>
	<li><a data-toggle="tab" style="border:0px" href="#menu2">Advertisements</a></li>    
  </ul>

<div class="tab-content">  

	<!-- STATISTICS SECTION -->
	<div id="home" class="tab-pane fade in active" style="padding:2%">
		<br><br><br><br>
		<div class="row" style="padding-left:22%">			
			<div class="col-lg-1 round">
				<div id="div_article"></div>
				<div style="font-size:50%">Articles</div>
			</div>			
			<div class="col-lg-1 round">
				<div id="div_category"></div>
				<div style="font-size:50%">Categories</div>
			</div>
			<div class="col-lg-1 round">
				<div id="div_ad"></div>
				<div style="font-size:50%">Ads</div>
			</div>
			<div class="col-lg-1 round">
				<div id="div_user"></div>
				<div style="font-size:50%">Users</div>
			</div>
		</div>

		<div class="row" style="padding-left:15%;padding-right:15%;padding-top:5%">
			<div class="row">
				<div class="col-lg-9"></div>
				<div class="col-lg-3">
					<button style="background:#286090;color:#fff" type="button" onclick="hitMe('bar')" class="btn btn-sm">Bar</button>
					<button style="background:#286090;color:#fff" type="button" onclick="hitMe('pie')" class="btn btn-sm">Pie</button>
					<button style="background:#286090;color:#fff" type="button" onclick="hitMe('column')" class="btn btn-sm">Column</button>
				</div>
				
			</div>
			<div id="chartContainer" style="height: 300px; width: 100%;"></div>
			<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>		
		</div>
	</div>
	


	<!-- CATEGORIES SECTION -->
	<div id="menu0" class="tab-pane fade" style="padding:2%">      
	  <div class="col-lg-4">
			<h3>Categories</h3>               
			<div class="row">
				<div class="col-lg-10">
					<input id="cat_name" type="text" placeholder="Category Name" class="form-control" />    
				</div>
				<div class="col-lg-1" style="margin-left:-6%">
					<button id="bcat" type="button" class="btn btn-sm btn-primary">Add</button>
				</div>
			</div>
			<div class="row" id="cat_load" style="padding:4%;padding-right:9%">
				
			</div>
	  </div>
	  <div class="col-lg-1"></div>
	  <div id="div_sub" class="col-lg-4" style="display:none">
			<h3>Sub-categories</h3>
			<div class="row">
				<div class="col-lg-10">
					<input id="sub_cat_name" type="text" placeholder="Category Name" class="form-control" />    
				</div>
				<div class="col-lg-1" style="margin-left:-6%">
					<button id="bsubcat" type="button" class="btn btn-sm btn-primary">Add</button>
				</div>
			</div>
			<div class="row" id="sub_cat_load" style="padding:4%;padding-right:9%">
				
			</div>
	  </div>
	  <div class="col-lg-4">
	  
	  </div>
	</div>
	<!-- CATEGORIES SECTION -->

	<!-- ARTICLES MENU -->
	<div id="menu1" class="tab-pane fade" style="padding:2%">      
		<h3>Articles</h3>
		
		<!-- SHOW THE ADD NEW ARTICLE -->
		<div class="row">
			<div class="col-lg-12">
			<button class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#demo">New Article</button>

			<div id="demo" class="collapse" style="border-bottom:1px solid #eee">
				<br />
				<div class="row" style="margin-bottom:3%">
					<div class="col-lg-4 form-group">
						<input required id="ttitle" type="text" class="form-control" placeholder="Title of the article" /><br />
						<!-- <input id="tcat" type="text" class="form-control" placeholder="Category to which it belongs" /><br /> -->
						<select id="tcat" class="form-control" name="tcat" required multiple>
<?php
						foreach($categories as $category)
						{
?>
							<option id=<?=$category["categories"]["id"]?> value=<?=$category["categories"]["id"]?>>
								<?=$category["categories"]["title"]?>
							</option>
<?php
						}
?>
						</select>
						<br>
						<!-- <input id="tpic" type="file" placeholder="Category to which it belongs" />    -->
						<form name="articleFileUpload" id="articleFileUpload" enctype="multipart/form-data" method="post" action="">
							<input type="file" name="tpic" id="tpic" /> 
						</form> 
						<input id="tcaption" type="text" class="form-control" placeholder="Caption for the photo" /><br />                                            
					</div>
					<div class="col-lg-8">
						<textarea id="ttext" cols="20" rows="10" class="form-control" placeholder="Content goes here.."></textarea><br />
						<button id="bpublish" type="button" class="btn btn-primary btn-sm">Publish</button>
					</div>
				</div>
			</div>
			</div>
		</div>
		<!-- SHOW THE ADD NEW ARTICLE -->

		<!-- THE TABLE OF ARTICLES -->
		<div class="row">
			<div class="col-lg-12">
				<h3>Active Articles</h3>
				<p>This is the list of all your articles on the website</p>
				<table id="tab_article" class="table table-bordered table-condensed table-striped">
					<thead>
						<th>Id</th>
						<th>Title</th>
						<!-- <th>Author</th> -->
						<th>Content</th>
						<th>Picture</th>
						<th>Created</th>
						<th>Status</th>
						<th style="text-align: center">Action</th>
					</thead>
					<tbody id="arTbody">
					</tbody>
				</table>
			</div>
		</div>
		<!-- THE TABLE OF ARTICLES -->
	</div>
	<!-- ARTICLES MENU -->

	<!-- ADVERTISEMENTS MENU -->
	<div id="menu2" class="tab-pane fade" style="padding:2%">              
		
		<!-- SHOW THE ADD NEW Advertisement -->
		<div class="row">
			<div class="col-lg-3" style="padding:2%">   
				<h3>Add New</h3>                                         
				<input id="talt" type="text" class="form-control" placeholder="Alt Text" style="margin-bottom:1%" />
				<input id="tlink" type="text" class="form-control" placeholder="Link to open" style="margin-bottom:1%" />
				<select class="form-control" id="tsel">
					<option value="1">Space 1</option>
					<option value="2">Space 2</option>
					<option value="3">Space 3</option>
					<option value="4">Space 4</option>
				</select><br />
				<form name="advertFileUpload" id="advertFileUpload" enctype="multipart/form-data" method="post" action="">
							<input type="file" name="tadPic" id="tadPic" /> 
				</form> 
				<br/>
				<button id="badvert" type="button" class="btn btn-primary btn-sm">Upload</button>                                
			</div>    

			<div class="col-lg-9" style="padding:2%">
				<!-- THE TABLE OF ARTICLES -->
				<div class="row">
					<div class="col-lg-12">
						<h3>Active Advertisements</h3>
						<p>This is the list of all your Advertisements on the website</p>
						<table id="tab_advert" class="table table-bordered table-condensed table-striped">
							<thead>
								<th>Id</th>
								<th>Alt</th>                                
								<th>Link</th>
								<th>Picture</th>
								<th>Position</th>                                
								<th>Clicks</th>
								<th>Status</th>
								<th>Created</th>
								<th>Action</th>
							</thead>
							<tbody id="adTbody">
							</tbody>
						</table>
					</div>
				</div>
				<!-- THE TABLE OF ADS -->
			</div>        
		</div>
		<!-- SHOW THE ADD NEW ARTICLE -->

		
	</div>
	<!-- ADVERTISEMENTS MENU -->


	<div id="menu3" class="tab-pane fade">
	  <h3>Menu 3</h3>
	  <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	</div>
  </div>
</div>

</body>
</html>
