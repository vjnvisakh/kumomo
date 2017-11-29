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



    <script>
    
        $(document).ready(function()
        {            
            loadAllArticles();

            $("#bpublish").click(function()
            {
                var ttitle = $("#ttitle").val();
                var tcat = $("#tcat").val();
                var ttext = $("#ttext").val();
                //var ttitle = $("#tpic").val();                

                $.ajax
                (
                    {
                        type:"POST",
                        data:
                        {					
                            ttitle:ttitle,
                            tcat:tcat,
                            ttext:ttext                            
                        },
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

            function  loadAllArticles()
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
                            $("#tbody").html(JSON.parse(res));
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

            

        });
    
    </script>



</head>
<body style="padding:4%">

<div class="container-fluid" style="border:1px solid #222">
  
  <div class="row" style="padding:2%">
    <h3>Administrator</h3>
    <p>This is your primary dashboard. All your settings can be tweaked over here</p>
  </div>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">Articles</a></li>
    <li><a data-toggle="tab" href="#menu2">Advertisements</a></li>
    <li><a data-toggle="tab" href="#menu3">Enquiries</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>HOME</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>

    <!-- ARTICLES MENU -->
    <div id="menu1" class="tab-pane fade" style="padding:2%">      
        <h3>Articles</h3>
        
        <!-- SHOW THE ADD NEW ARTICLE -->
        <div class="row">
            <div class="col-lg-12">
            <button data-toggle="collapse" data-target="#demo">New Article</button>

            <div id="demo" class="collapse" style="border-bottom:1px solid #eee">
                <br />
                <div class="row" style="margin-bottom:3%">
                    <div class="col-lg-4">
                        <input id="ttitle" type="text" class="form-control" placeholder="Title of the article" /><br />
                        <input id="tcat" type="text" class="form-control" placeholder="Category to which it belongs" /><br />
                        <input id="tpic" type="file" placeholder="Category to which it belongs" />                                                
                    </div>
                    <div class="col-lg-8">
                        <textarea id="ttext" cols="20" rows="10" class="form-control"></textarea><br />
                        <button id="bpublish" type="button" class="btn btn-default">Publish</button>
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
                        <th>Author</th>
                        <th>Content</th>
                        <th>Picture</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>
            </div>
        </div>
        <!-- THE TABLE OF ARTICLES -->
    </div>
    <!-- ARTICLES MENU -->

    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
</div>

</body>
</html>
