<div id="geolocations">
<h1>Current visitors</h1>
	<?php 
	$n = 1;
        echo '<ul>';
		if(!$geolocations) 
		{
			echo '<li>Not available.</li>';			
		} 
		else 
		{
			foreach($geolocations as $geol) 
			{
				
					if($n < count($geolocations)) 
					{
						echo '<div class="geodatas">';
					} 
					else 
					{
						echo '<div class="geodatas_last">';
					}
					echo '<li>IP Address: '.$geol['ip'].'</li>';
					echo (isset($geol['country_name']) && $geol['country_name'] != '') ? '<li>Country: '.utf8_encode($geol['country_name']).'</li>' : '<li>Country: no data'.'</li>';	
					echo (isset($geol['city']) && $geol['city'] != '') ? '<li>City: '.utf8_encode($geol['city']).'</li>' : '<li>City: no data'.'</li>';
					echo '</div>';
				$n++;
			}
		}
	echo '</ul>';
    	?>
</div>
