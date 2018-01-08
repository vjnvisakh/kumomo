<?php

	$renderHTML = "<ul id='featured' class='list-group'>";
	$renderHTML .= "<div class='row'>";

	if(!empty($featuredSectionList))
	{
		$i = 1;

		foreach($featuredSectionList as $item)
		{
			if($i % 2 == 0)
			{
				$renderHTML .= "<div style='margin-left:-3%' class='col-sm-6'>";
			}
			else
			{
				$renderHTML .= "<div class='col-sm-6'>";
			}
			
			$renderHTML .= "<li class='list-group-item' style='border:0px'>";
			$renderHTML .= "<h3><b>" . $item["category"]["title"] . "</b></h3>";
			$renderHTML .= "<div class='row'>";
			$renderHTML .= "<div class='col-sm-4'>";
			$renderHTML .= "<img style='border-top:1px solid #222;border-left:1px solid #222;border-bottom:1px solid #222;width:180px;height:150px' src='" . $this -> webroot . 'images/articles/' . $item["articles"][0]["a"]["photo"]. "'>";
			$renderHTML .= "</div>";
			$renderHTML .= "<div class='col-sm-8' style='font-size:80%;padding-top:2%;border-top:1px solid #222;border-bottom:1px solid #222;border-right:1px solid #222;padding-left:5%'>";
			$renderHTML .= "<ul style='list-style-type:square;'>";

			foreach($item["articles"] as $article)
			{
				$renderHTML .= "<a style='color:#222' href='" . $this -> webroot . 'Homes/article/' . $article["a"]["id"] . "'><li>" . $article["a"]["title"] . "</li></a>";
			}
			
			$renderHTML .= "</ul>";
			$renderHTML .= "</div>";
			$renderHTML .= "</div>";
			$renderHTML .= "</li>";
			$renderHTML .= "</div>";

			$i++;
		}
	}

	$renderHTML .= "</div>";
	$renderHTML .= "</ul>";

	echo $renderHTML;
	exit();

?>