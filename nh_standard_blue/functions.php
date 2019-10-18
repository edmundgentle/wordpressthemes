<?php
if ( function_exists('register_sidebar') )
    register_sidebar();
if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'main-menu', 'Main navigation menu across the top of the page.' );
}
function nhSubstr($text,$maxchar,$end='...') {
	if(strlen($text)>$maxchar) {
		$words=explode(" ",$text);
		$output = '';
		$i=0;
		while(1){
			$length = (strlen($output)+strlen($words[$i]));
			if($length>$maxchar){
				break;
			}else{
				$output=$output." ".$words[$i];
				++$i;
			};
		};
	}else{
		$output=$text;
		$end="";
	}
	return $output.$end;
}

?>
