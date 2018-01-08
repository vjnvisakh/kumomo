<?php

	if(!empty($LATEST_CATEGORIES))
	{
		$i = 0;

		foreach($LATEST_CATEGORIES as $category)
		{
			if($i++ % 2 == 0)
			{
				echo '<div class="col-sm-2" style="background:#FBFBF1;border:1px solid #eee;padding:2%;color:#222 !important;text-align: center;">';
			}
			else
			{
				echo '<div class="col-sm-2" style="border:1px solid #eee;padding:2%;color:#222 !important;text-align: center;">';
			}
?>
			
			<a style="text:decoration: none; color:#222 !important;" target="_blank" href="<?=$this -> webroot . "categories/index/" . $category["c"]["id"]?>">
				<?= $category["c"]["title"]; ?>
			</a>
			</div>
<?php 			
		}
	}

?>