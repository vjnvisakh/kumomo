<?php 
	if(!empty($featuredSectionList))
	{
		$categoryCount = 0;

		$renderHTML = "";
		foreach($featuredSectionList as $key => $featuredSection)
		{
			if($key != 0)
			{
				$renderHTML .= "</div>";

				if($categoryCount % 2)
				{
					$renderHTML .= "<div class='col-sm-6'>";
				}
				else
				{
					$renderHTML .= "</div><div class='row' ><div class='col-sm-6'>";
				}
			}
			else 
			{
				$renderHTML .= "<div class='row' ><div class='col-sm-6'>";
			}

			$renderHTML .= "<table class='table table-bordered table-hover'>";
			$renderHTML .= "<tr class='panel-heading1 ui-sort-disabled'>";
			$renderHTML .= "<th colspan='4' style='text-align:center;'>";
			$renderHTML .= "<a style='text-decoration: none; color: #000' href='" . $this -> webroot . "categories/index/" . $featuredSection["category"]["id"] . "'>";
			$renderHTML .= $featuredSection["category"]["title"] . "</a></th>";

			$articleCount = 0;

			foreach($featuredSection["articles"] as $article)
			{
				$articleRow = "";
				$articleRow .= "<tr><td>";
				$articleRow .= "<a style='text-decoration: none; font-weight: 500; color: #000' href='" . $this -> webroot . "homes/article/" . $article["a"]["id"] . "'>";

				if(!$articleCount && !empty($article["a"]["photo"]))
				{
						$articleRow .= "<figure class='figure'><img src='" . $this -> webroot . "images/articles/" . $article["a"]["photo"] . "' class='figure-img img-fluid rounded'";
						$articleRow .= "alt='" . $article["a"]["title"] . "'>";
						$articleRow .= "<figcaption class='figure-caption'>" . $article["a"]["title"] . "</figcaption></figure>";
				}
				else 
				{
					$articleRow .= $article["a"]["title"];
				}

				$articleRow .= "</a></td></tr>";
				

				$renderHTML .= $articleRow;
				$articleCount ++;

			}

			$renderHTML .= "</tr></table>";
										  	
			$categoryCount += 1;
		}

		if(!empty($renderHTML))
		{
			$renderHTML .= "</div></div>";
		}

		
		echo $renderHTML;
	}
?>