<script>

    $(document).ready(function()
    {
        var articleId = <?= json_encode($ID); ?>

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
    });

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
        <!-- <div class="col-lg-1">
            <img src="<?=$this->webroot.'images/dummy.png'?>" height="25" width="25" />
        </div> -->
        <!-- <div class="col-lg-1">
            <b>Admin</b>
        </div> -->
        <div class="col-lg-3">
            <small><b>Published:</b> <?=date("d-M-Y",strtotime($CREATED))?></small>
        </div>
        <div class="col-lg-2">
            <small><b>Views: </b>200</small>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"></div>
    </div>

    <br/>
    <!-- AREA FOR THE PIC -->
    <div id="cover" class="row">
        <div class="col-lg-12">
        <img height="400" width="800" src="<?=$this->webroot.'images/articles/'.$PIC?>" style="border:4px solid #eee;margin-bottom:2%;box-shadow:0px 1px 1px" />
        </div>
    </div>

    <!-- AREA FOR THE TEXT -->
    <div id="txtBox" class="row">
        <div class="col-lg-12">
        <p style="text-align:justify">
            <?=$CONTENT?>
        </p>
        </div>
    </div>


    <!-- RELATED NEWS -->
    <div id="related" class="row" style="background:#eee;padding:2%">        
        <div class="col-lg-12">
            <h3>Related News</h3>
            <div id="r_news">
            
            </div>
        </div>
    </div>


    <!-- AREA FOR THE COMMENTS -->
    <div id="comments" class="row">
        <div class="col-lg-12" id="u_comments" style="padding-top:5%">
            <h4>Comments</h4>
        </div>
    </div>
</div>