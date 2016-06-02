<?PHP

	if(get_theme_mod("pagination")=="on"){

		$links = paginate_links( array( "prev_text" => _x("Previous", "passeridae"), "next_text" => _x("Next", "passeridae") ));
		
		if($links!=""){ ?>
			<footer class="page-footer">
				<h1 class="pagination"><span class='more'><?PHP
					echo _x('More content', 'passeridae');
				?></span><?PHP
			
				echo $links;
				
				?></h1>
			</footer><?PHP
			
		}
		
	}
