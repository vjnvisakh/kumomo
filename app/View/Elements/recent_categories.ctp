<?php

	if(!empty($LATEST_CATEGORIES))
	{
		foreach($LATEST_CATEGORIES as $category)
		{
?>
			<div class="col-lg-2" style="border:1px solid #eee;padding:2%;margin:1%;color:#222 !important;">
			<a style="text:decoration: none; color:#222 !important;" target="_blank" href="<?=$this -> webroot . "categories/index/" . $category["c"]["id"]?>">
				<?= $category["c"]["title"]; ?>
			</a>
			</div>
<?php 			
		}
	}

?>