<!-- ALL THE COMMENT GO THROUGH HERE -->
<?php
	
	// Check if the comments are there for an article
	if(!empty($COMMENTS))
	{
		foreach($COMMENTS as $comment)
		{
?>		
			<div class="row" style="padding-left:2%;padding-bottom:1%;padding-top:1%;margin-bottom:1%">
				<!-- THE IMAGE GOES OVER HERE -->
				<!-- <div class="col-lg-1">
					<div style="padding-top:25%;width:50px;height:50px;border-radius:50%;background-color:#eee;color:#222;text-align: center;">
						<?=ucfirst(substr($comment["CommentsToArticle"]["name"],0,1));?>
					</div>
				</div> -->
				<div class="col-lg-11" style="border-bottom:1px solid #eee;">
					<small>
					
					<!-- NAME OF THE PERSON WHO HAS COMMENTED -->
					<p style="font-size:120%">
						<b><?=ucfirst($comment["CommentsToArticle"]["name"]);?></b>
					</p>

					<!-- DATE OF POST -->
					<p style="margin-top: -2%">
						<?=date("d-M-Y",strtotime($comment["CommentsToArticle"]["created"]));?>
					</p>					

					<!-- THE COMMENT -->
					<p style="margin-top:-1%;text-align: justify;">
						<?=$comment["CommentsToArticle"]["comment"];?>
					</p>
					</small>
				</div>
			</div>
<?php			
		}
	}
	else
	{

	}
?>
<!-- ALL THE COMMENT GO THROUGH HERE -->