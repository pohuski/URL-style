<!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Style Form</title>
		<link rel="stylesheet" href="styles.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<?php include_once ('encodings.php'); ?>
		<?php include_once ('parsley.php'); ?>
		<?php output_styles(); ?>
	</head>
	<body>

		<a href="../URL-style/form.php" id="RESET">RESET STYLES</a>

		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, repellat, sunt maxime vitae ratione dignissimos iure cupiditate rerum tempora nemo velit delectus suscipit vel neque incidunt nobis ad mollitia ipsa.</p>

		<form action="">
			<section id="page-styles" class="toggle-content closed">
				<h2>Page Styles</h2>
				<div class="content" style="display:none;">
					<label for="page-background">Background</label>
					<input id="page-background" name="p-bgc" type="text" class="uppercase">

					<label for="page-color">Text Color</label>
					<input id="page-color" name="p-c" type="text" class="uppercase">

					<label for="page-font-size">Font Size</label>
					<span class="units">px</span>
					<input type="text" id="textInput" class="range-total" name="p-fs" value="16" disabled="disabled" readonly>
					<input id="page-font-size" class="range" type="range" name="p-fs" value="16" min="8" max="48">
				</div>
			</section>


			<section id="button-styles" class="toggle-content closed">
				<h2>Button Styles</h2>
				<div class="content" style="display:none;">
					<label for="button-background">Background</label>
					<input id="button-background" name="b-bgc" type="text" class="uppercase">

					<label for="button-color">Color</label>
					<input id="button-color" name="b-c" type="text" class="uppercase">

					<label for="button-border-width">Stroke Width</label>
					<span class="units">px</span>
					<input type="text" id="textInput" class="range-total" name="b-bwv" value="0" disabled="disabled" readonly>
					<input id="button-border-width" class="range" type="range" name="b-bdw" value="0" min="0" max="20">
				</div>
				</section>


			<section id="input-styles" class="toggle-content closed">
				<h2>Input Styles</h2>
				<div class="content" style="display:none;">
					<label for="input-background">Background</label>
					<input id="input-background" name="i-bgc" type="text" class="uppercase">
				</div>
			</section>
			
		</form>
		<button onclick="update_total();">Generate</button>

		<textarea name="total" id="" cols="30" rows="10"></textarea>


		<script type="text/javascript">
			//Handles Range Value updating
		    $('.range').on('change', function() {
			  var totalvalue = $(this).val();
			 $(this).siblings(".range-total").val(totalvalue)
			});

		    //Toggle Content Sections
			$('h2').click(function() {
				var parent_content = $(this).parents('.toggle-content');
				$(parent_content).children(".content").toggle("fast");
				if (parent_content.hasClass('closed')){
					(parent_content).removeClass('closed');
				} else {
					(parent_content).addClass('closed');
				}
			});
		    

		</script>


		<script>
		var outputCode = [];

		function clear_values() {
			outputCode = [];
		}

		function get_values () {
			console.log("get_values starting");

			$('input').each(function(index){

				//Name Attribute | Exploded and delineated
				var inputname 		= $(this).attr("name"); //Gets Name
				var splitparts		= inputname.split('-');
				//splitparts[0];
				//splitparts[1];

				//Value
				var inputvalue 		= $(this).val();
				
				//Total # of inputs on page
				var numberOfItems 	= $('input').length; // Gets # of inputs on page

				if (inputvalue != "" && this.disabled != true && this.readOnly != true) { //If the input is not blank, we will use it

					if (index === numberOfItems - 1) { // If the input that is running in the loop is not the last # of inputs on page (last in loop)
						outputCode.push(inputname + '=' + inputvalue); // Do not include an "&" at the end peice
					}

					else { // otherwise
						outputCode.push(inputname + '=' + inputvalue + "&"); // Put an "&" at the end of that sting peice
					}
				} else { // If the input is blank
					return; // Move on to next input
				}
				
			});
		}

		function update_total() {
			clear_values();
			console.log("clicked button");
			get_values();
			$('textarea').val("?" + outputCode.join('')); //.join('') puts the avlues together without a comma
			console.log("?" + outputCode.join('')); 
		}



		</script>

	</body>
	</html>	