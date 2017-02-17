
<?php

if (empty($collection)){
	echo "There are no projects to display";
}

else{
	foreach ($collection as $item){

		echo '
		<table class="table table-striped">
			<tr>
				<td><b>Title:</b></td>
				<td>'.$item->title.'</td>
				

			</tr>
			
			<tr>
				<td><b>Description:</b></td>
				<td>'.$item->description.'</td>

			</tr>
		</table>	
		';
	}
}
?>


















<?php






