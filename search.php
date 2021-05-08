<?php
    $con=mysqli_connect("localhost","root","","interapt");
	$query = $_GET['query']; 
	
	$min_length = 2;
	
	if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
		
		
		$raw_results = "SELECT * FROM info
			WHERE (`Name` LIKE '%".$query."%') OR (`Role` LIKE '%".$query."%') OR (`Location` LIKE '%".$query."%')" or die(mysql_error());
			
		// * means that it selects all fields, you can also write: `id`, `title`, `text`
		// articles is the name of our table
		
		// '%$query%' is what we're looking for, % means anything, for example if $query is Hello
		// it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
		// or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
		
		$run=mysqli_query($con,$raw_results);
        $found=mysql_num_rows($run);
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
			
			while($results = mysql_fetch_array($raw_results)){
			// $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
			
				echo "<p><h3>".$results['title']."</h3>".$results['text']."</p>";
				// posts results gotten from database(title and text) you can also show id ($results['id'])
			}
			
		}
		else{ // if there is no matching rows do following
			echo "No results";
		}
		
	}
	else{ // if query length is less than minimum
		echo "Minimum length is ".$min_length;
	}
?>