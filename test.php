<?php 
		/* $mystring = exec('python statesmpage.py', $output);
		$contents = file_get_contents('statsageoutput.json');
		$contents = utf8_encode($contents);
		$results3 = json_decode($contents,true); */
		var_dump($results3); 

	$mystring = exec('python statstatescities.py', $output, $val);
	$contents = file_get_contents('statescitiesoutput.json');
	$contents = utf8_encode($contents);
	$results4 = json_decode($contents,true);
	//var_dump($results4);
var_dump($output);
echo $val;


	/* $mystring = exec('python dummy.py', $output); 
				$writeJson = file_put_contents('searchname.json', $arr);
				$mystring = exec('python searchmpname.py', $output, $return_var);
				var_dump($output);
echo $return_var;
				//Fetch Missing Person Details
				$contents = file_get_contents('searchnameoutput.json');
				$contents = utf8_encode($contents);
				$results = json_decode($contents,true);
				//var_dump($results);
