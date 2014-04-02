<style>

<?php 
//Legacy Style inclusions -- this will iterate through so hard-coded markup won't be needed (future)
?>
/* PAGE STYLES */
/*
	<?php if(isset($_GET['p-bgc'])){ ?>
		body{
		background: #<?php echo $_GET['p-bgc']?>;
		}
	<?php } ?>

	<?php if(isset($_GET['p-c'])){ ?>
		body{
		color: #<?php echo $_GET['p-c']?>;
		}
	<?php } ?>
*/

/* BUTTON STYLES */
/*
	<?php if(isset($_GET['b-bgc'])){ ?>
		button{
		background: #<?php echo $_GET['b-bgc']?>;
		}
	<?php } ?>

	<?php if(isset($_GET['b-c'])){ ?>
		button{
		color: #<?php echo $_GET['b-c']?>;
		}
	<?php } ?>

	<?php if(isset($_GET['b-bdw'])){ ?>
		button{
		border-width: <?php echo $_GET['b-bdw']?>px;
		}
	<?php } ?>
*/
</style>


<?php 

	// Each item in array --> do a CSS key with a value
	// E.g.: 
	// 		for input, button, and select
	//		make color, #000


	//Need Functions
	//	1. Takes URL parse key and makes it equal to css selector 
	//		`--  	bg=000  --> bg = 'background'
	//				cl=fff 	--> cl = 'color'
	//	1. Takes URL parse value and makes it equal to css selector 
	//		`--  	bg=000  --> '$value' = $_GET['bg']
	//				cl=fff 	--> '$value' = $_GET['cl']
	//
	//	2. For each selector in the previous array, assign a css property and css value

	
	

	//BORDER
	//$bdr 	= "border-radius";
	//$bds 	= "border-style";
	//$bdw 	= "border-width";

	//COLOR
	//$c 		= "color";

	//BACKGROUND
	//$bgc = "background-color";
	//$bgi = "background-image";

	//Page Styles Prefix
	//$value1 = $_GET["p-bgc"].split("-")[0];
	//$value2 = $_GET["p-bgc"].split("-")[1];


	//echo "$value1";
	//echo "$value2";

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

	?>





	<?php 

$abbreviations  = array( 

	"p" 	=> "body",
	"b"		=> "button",
	"c"		=> "color",
	"bgc"	=> "background-color",
	"bdw"	=> "border-width"

);


//Gets the URL, takes the keys and explodes them into two parts with the "-" being the separator
function explodeURL () {
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


function build_styles($selector, $property, $value) {

	switch($property) {
		case 	$property === "color" || 
				$property === "background-color":
					$value = "#".$value;
					break;

		case 	$property === "border-width" ||
				$property === "width":
					$value = $value."px";
					break;
	}

	$output = "<style>" . $selector . "{" . $property . ":" . $value . "}</style>"; // Standard CSS Output
	echo $output;
}


explodeURL();


	
	

	$fooz = "c";

	//echo $abbreviations[$fooz];

/*
	print_r($abbreviations);


	function decodingStyles() {
		
		explodeURL();

	}
*/


/*
	function decodingController( $selector, $property ) {
		
		if(isset($_GET['p-bgc'])){
			decodingStyles($property) {

			}
		}

	}

*/


	?>






