<?php
	include("config/conf.php");
	$keyword = $_POST['data'];
	$sql = "select product_name, product_id from ".$db_table." where ".$db_column." like '".$keyword."%' limit 0,20";
	//$sql = "select name from ".$db_table."";
	$result = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($result))
	{
		echo '<ul class="list">';
		while($row = mysql_fetch_array($result))
		{
			$str = strtolower($row['product_name']);
			$start = strpos($str,$keyword); 
			$end   = similar_text($str,$keyword); 
			$last = substr($str,$end,strlen($str));
			$first = substr($str,$start,$end);
			
			$final = '<span class="bold">'.$first.'</span>'.$last;
		
			echo '<li><a href="/product.php?product_id='.$row['product_id'].'">'.$final.'</a></li>';
		}
		echo "</ul>";
	}
	else
		echo 0;
?>	   
