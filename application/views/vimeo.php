<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="Browse through the most popular Vimeo videos.">
		<title>Most Popular Vimeo Videos</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/style.css">
	</head>
	<body>
		
		<div class="container">
			<div class="header clearfix">
				<h3 class="text-muted">Most Popular Vimeo Videos</h3>
			</div>
			<div class="row marketing">
				<div class="col-lg-6">
					<h4>Sort</h4>
					<div class="dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuSort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<span id="sort-display" data-sort="popular">Popularity</span>
							<span class="caret"></span>
						</button>
	   					 <ul id="sort-list" class="dropdown-menu" aria-labelledby="dropdownMenuSort">
	   						 <li data-sort="popular"><a href="#">Popularity</a></li>
	   						 <li data-sort="recent"><a href="#">Recently Added</a></li>
	   					 </ul>
					</div>
				</div>
				<div class="col-lg-6">
					<h4>Category</h4>
					<div class="dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuCat" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<span id="cat-display" data-cat="">All</span>
							<span class="caret"></span>
						</button>
						<ul id="cat-list" class="dropdown-menu" aria-labelledby="dropdownMenuCat">
							<li data-cat=""><a href="#">All</a></li>
							<li data-cat="animation"><a href="#">Animation</a></li>
							<li data-cat="art"><a href="#">Arts & Design</a></li>
							<li data-cat="cameratechniques"><a href="#">Cameras & Techniques</a></li>
							<li data-cat="comedy"><a href="#">Comedy</a></li>
							<li data-cat="documentary"><a href="#">Documentary</a></li>
							<li data-cat="experimental"><a href="#">Experimental</a></li>
							<li data-cat="fashion"><a href="#">Fashion</a></li>
							<li data-cat="food"><a href="#">Food</a></li>
							<li data-cat="instructionals"><a href="#">Instructionals</a></li>
							<li data-cat="music"><a href="#">Music</a></li>
							<li data-cat="narrative"><a href="#">Narrative</a></li>
							<li data-cat="personal"><a href="#">Personal</a></li>
							<li data-cat="journalism"><a href="#">Reporting & Journalism</a></li>
							<li data-cat="sports"><a href="#">Sports</a></li>
							<li data-cat="talks"><a href="#">Talks</a></li>
							<li data-cat="travel"><a href="#">Travel</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row marketing">
				<div class="col-lg-6">
					<h4>Tag</h4>
					<div class="input-group">
						<input id="input-tag" type="text" class="form-control" placeholder="Enter tag...">
					</div>
				</div>
				<div class="col-lg-6">
					<h4>Embeddable</h4>
					<input id="embed-check" type="checkbox" name="embed" value="embed" />
				</div>
			</div>
			<div class="row marketing">
				<div class="col-lg-12">
					<p id="show-button"><a class="btn btn-primary btn-lg" href="#" role="button">Show Videos</a></p>
				</div>
			</div>
			<div class="row marketing">
				<div class="col-lg-12">
					<div id="video-list"></div>
				</div>
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="../assets/js/videos.js"></script>
	</body>
</html>