<!DOCTYPE html>
<html>
<head>
	<title>3B digital interview </title>
	<meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	
</head>
<body>
<header>
	<div class="container">
		<h1>Logo</h1>
		<?php
			$filename = "data/user.json";
			$jsondata = file_get_contents($filename);
			$json = json_decode($jsondata,true);
			$firstName = explode(" ",$json["name"]);
			echo "<div id=user><h4>".$firstName[0]."</h4></div>"
		?>
	</div>
</header>
<main>
	<div class="container">
		<!-- articles section -->
		<section id="Articles">
			<h1>articles</h1>
			<?php
				// this function checks the validity of the image url(the image url with id of 758 in articles.json are not valid) 
				function validImage($file) {
				   $size = getimagesize($file);
				   return (strtolower(substr($size['mime'], 0, 5)) == 'image' ? true : false);  
				}
				// this function divides the content to two parts,first part contains 100 character and second part contains the rest of content.
				function charcount($sting){
					$cnt =0;
					$charnum=100;
					for ( $j=0; $j < strlen($sting);$j++){

						if($cnt > $charnum){
							break;
						}
						if($sting[$j]==="<"){

							while($sting[$j]!==">"){
								$j++;
							}
						}else{
							if($sting[$j]==="&"){

								while($sting[$j]!==";"){
									$j++;

								}
								
							}
							else{
								$cnt++;
							}
						}

					}
					return $j;
				}
				// fetch the json file
				$filename = "data/articles.json";
				$jsondata = file_get_contents($filename);
				$json = json_decode($jsondata,true);
				$charnum=100;
				for ($i=0 ;$i<sizeof($json);$i++){
					$title = $json[$i]["title"];
					$url = $json[$i]["url"];
					$image = $json[$i]["image"];
					$content = $json[$i]["content"];
					$author = $json[$i]["author"];
					$date = $json[$i]["date"];
					
					$headers = @get_headers($image , 1);
					if (strpos($headers['Content-Type'], 'image/') === false) {
					    $image = "";
					    
					}
					
					if ($i%2 == 0) {
						echo "<br>";
					}
				?>
				<!-- print out the article's data -->
				<article>
					<h4> <?php echo "<a href=".$url.">".$title."</a>"; ?> </h4>
					
					<span id="by">by</span>
					<span id ="au"><?php echo $author; ?></span>
					<span id="date"><?php echo $date; ?></span>
					<img src=<?php echo $image; ?>>
					<div id="content">
					<?php
						// the content before clicking show more button
						$substringIndex = charcount($content) ;
						
						if(strpos($content, "<p>") === 0){
							$startP = "<p id='p'>";
							$endP = "</p>";
							
						}
						else{
							$startP = "";
							$endP = "";
						}
						
						if (strlen($content) > $charnum){ // for those content that starts with a p tag
							echo substr($content, 0,$substringIndex)."<span class='dotsShow' id ='dots'>...</span>".$endP."<span class='moreHide' id='more'>".$startP.substr($content,$substringIndex,strlen($content))."</span>";
							

						}else{
							echo $content;
						}
						
					?>
					
					</div>
					<?php
					 if (strlen($content) > $charnum) {
					 	echo "<button id='readMore' onclick='myFunction(this)'>Read more</button>";
					 }
					?>
					
				</article> 

				<?php
					}

				?>
		</section>
		<!-- events section -->
		<section id="Events">

			<h1>events</h1>
			<div id="eventsList">
			<?php
					
					$filename = "data/events.json";
					$jsondata = file_get_contents($filename);
					$json = json_decode($jsondata,true);
					for ($i=0 ;$i<sizeof($json);$i++){
						$title = $json[$i]["title"];
						$location = $json[$i]["location"];
						$date = $json[$i]["date"];
						$url = $json[$i]["url"];

				?>
						<div>
							<h4><a href=<?php echo $url; ?>><?php echo $title; ?></a> </h4>
							<p><span>location : </span><?php echo $location; ?></p>
							<p><span>date : </span><?php echo $date; ?></p>
							
						</div>

				<?php
					}

				?>
				</div>
		</section>
		<div id="mapsection">
			<div id="map"></div>
			<div id="description">
				<p><img src="http://maps.google.com/mapfiles/ms/icons/red-dot.png"><span>Events</span></p>
				<p><img src="http://maps.google.com/mapfiles/ms/icons/green-dot.png"><span>You are here</span></p>
			</div>
		</div>
		
		
	</div>

</main>
<footer>
	<div class="container">
		<p>&copy; 3B digital 2019</p>
	</div>
</footer>
<script type="text/javascript" src = "code.js"></script>
<script type="text/javascript" src = "map.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=
AIzaSyASo3Zb1qwmTPNNGIEWhY47_JpQ_8B__-E
&callback=initMap"></script>
</body>
</html>