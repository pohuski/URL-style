<?php

/*
	// Get the URL query
			?p-bgc=fcc&p-c=00f&b-bgc=f00&b-c=fff

	// Break it up into an array with "&" being the delimitor --> Brandon said to use array($_GET)
			p-bgc=fcc, p-c=00f, b-bgc=f00, b-c=fff

	// Foreach of those items in the array, distinguish into key / value pairs
		 
			p-bgc 	=> fcc
			p-c 	=> 00f
			b-bgc 	=> f00
			b-c 	=> fff

	// Explode each key before dash ("-") into array (call using $arr[0] or $arr[1])
			p, bgc
			p, c
			b, bgc
			b, c

	// Look at $arr[0] of each key --> If first letter is foo, do this; else, do bar
			if ($arr[0] == p), 		associate as page
			elseif ($arr[0] == b), 	associate as button

	// Look at $arr[1] of each key --> If first letter is foo, do this; else, do bar
			if ($arr[1] == bgc), 	associate as background-color
			elseif ($arr[1] == c), 	associate as color


*/


function debug_to_console( $d, $t = "title" ) {
    
    if ( is_array( $d ) )
        $output = "<script>console.log( '$t: " . implode( ',', $d) . "' );</script>";
    else
        $output = "<script>console.log( '$t: " . $d . "' );</script>";

    echo $output;

}


$abbreviations  = array( 
	//Elements
	"p" 	=> "body",
	"b"		=> "button",
	"i"		=> "input",

	//Properties
	"c"		=> "color",
	"bgc"	=> "background-color",
	"bdw"	=> "border-width",
	"fs"	=> "font-size"
);


//Gets the URL, takes the keys and explodes them into two parts with the "-" being the separator
function output_styles () {
	
	foreach ($_GET as $key => $value) { 
		$segment 	= explode("-", $key, 2);
		$selector 	= $segment[0];
		$property 	= $segment[1];
		$value		= $value;
		
		global $abbreviations;

		$selector = $abbreviations[$selector];
		$property = $abbreviations[$property];

		//DEBUGGING
		//echo "<br />\$selector: " 	. $selector;
		//echo "<br />\$property: " 	. $property;
		//echo "<br />\$value: " 		. $value;
		//echo "<br />";

		build_styles($selector, $property, $value); //USES build_styles() FUNCTION
	}

}


// Creates the style annotations based on type of selector
function build_styles($selector, $property, $value) {

	switch($property) {
		case 	$property === "color" || 
				$property === "background-color":
					$value = "#".$value;
					break;

		case 	$property === "border-width" ||
				$property === "width" ||
				$property === "font-size":
					$value = $value."px";
					break;
	}

	$output = "<style>" . $selector . "{" . $property . ":" . $value . "}</style>"; // Standard CSS Output
	echo $output;

}







