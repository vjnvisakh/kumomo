<script>

    var articleId = 0;

    $(document).ready(function()
    {
        articleId = <?= json_encode($ID); ?>

        $.ajax
        (
            {
                type:"POST",
                data:
                {					
                    id:articleId                         
                },
                url: <?=json_encode($this->webroot.'Homes/fetchRelatedArticles');?>,
                success: function (res) 
                {
                    $("#r_news").html(JSON.parse(res));
                },
                error: function()
                {
                    
                }
            }
        );

        getAllComments();
        
    });


    // THIS METHOD IS USED TO FETCH ALL THE COMMENTS FOR THIS ARTICLE
    function getAllComments()
    {
        $.ajax
        (
            {
                url: '<?=$this->webroot.'Homes/fetchArticleComments'?>',
                type: "POST",                
                data: 
                {
                    articleId:articleId
                },
            }
        )
        .done(function(res) 
        {
            $("#div_comments").html(res);
        })
        .fail(function() 
        {
            alert("Oops");
        })
        .always(function() 
        {
            console.log("complete");
        });
    }

    function commentOnArticle()
    {
        if($("#inp_name").val() == undefined || $("#inp_name").val() == "")
        {
            $("#inp_name").focus();
            return;
        }

        if($("#inp_email").val() == undefined || $("#inp_email").val() == "")
        {
            $("#inp_email").focus();
            return;
        }

        if($("#txt_comment").val() == undefined || $("#txt_comment").val() == "")
        {
            $("#txt_comment").focus();
            return;
        }

        var name = $("#inp_name").val();
        var email = $("#inp_email").val();
        var comment = $("#txt_comment").val();
        var url = '<?=$this->webroot.'Homes/commentOnArticle'?>';

        $.ajax
        (
            {
                url: url,
                data: 
                {
                    name: name,
                    email: email,
                    articleId: articleId,
                    comment:comment
                },
                type: "POST"
            }
        )
        .done(function() 
        {
            getAllComments();

            $("#inp_name").val('');
            $("#inp_email").val('');
            $("#txt_comment").val('');
        })
        .fail(function() 
        {
            alert("error");
        })
        .always(function() 
        {
            console.log("complete");
        });        
    }

</script>
<div class="container-fluid">
    <!-- TITLE OF THE ARTICLE -->
    <div id="title" class="row" style="padding-top:5%">
        <div class="col-lg-12">
        <h1>            
            <?=$TITLE?>
        </h1>        
        </div>
    </div>
    
    <!-- AREA FOR THE VIEWS AND OTHER META DATA -->
    <div id="meta" class="row">                
        <div class="col-lg-2">
            <small><?=date("d-M-Y",strtotime($CREATED))?></small>
        </div>
        <div class="col-lg-2">
            <small><b>Views: </b>200</small>
        </div> 
    </div>

    <br/>
    <!-- AREA FOR THE PIC -->
    <div id="cover" class="row">
        <div class="col-lg-12">        
        <img height="500" width="950" src="<?=$this->webroot.'images/articles/'.$PIC?>" style="border:4px solid #eee;margin-bottom:2%;box-shadow:0px 1px 1px" />
        </div>
    </div>

    <!-- AREA FOR THE TEXT -->
    <div id="txtBox" class="row" style="padding:2%">
        <div class="col-lg-12">
            <div class="row">
                <p style="text-align:justify">  
                    <?=$CONTENT?>
                </p>
            </div>
            <div class="row" style="width: 20%">
                <div class="sharethis-inline-share-buttons"></div>
            </div>
        </div>
    </div>


    <!-- RELATED NEWS -->
    <div id="related" class="row" style="background:#eee;padding:2%;margin:0.5%">        
        <div class="col-lg-12">
            <h3>Related News</h3>
            <div id="r_news">
                
            </div>
        </div>
    </div>


    <!-- AREA FOR THE COMMENT BOX -->
    <div id="comments" class="row" style="padding:2%">
        <textarea id="txt_comment" class="form-control" rows="4" cols="135"></textarea>
    </div>    

    <div class="row" style="padding:0.5%">
        <div class="col-lg-3">
            <input id="inp_name" type="text" name="" class="form-control" placeholder="Name">
        </div>
        <div class="col-lg-3">
            <input id="inp_email" type="text" name="" class="form-control" placeholder="Email">
        </div>                
        <div class="col-lg-3">
            <button onclick="commentOnArticle()" type="button" class="btn btn-danger">Comment</button>
        </div>
    </div>

    <br><br><br>
    <!-- AREA FOR THE COMMENT BOX -->

    <!-- AREA FOR PREVIOUS COMMENTS -->
    <div id="div_comments" style="height:500px;overflow-y: scroll;">

    </div>
    <!-- AREA FOR PREVIOUS COMMENTS -->    

</div>