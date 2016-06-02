jQuery(document).ready( function(){
	jQuery( ".entry-content iframe" )
		.each(
			function(index,value){
				if(jQuery(value).attr("src").indexOf("youtube")!=-1){
					jQuery(value).css("width", "100%");
					jQuery(value).css("background-color", "#000");
				}
			}
		);

	}
);