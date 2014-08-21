<?
	/* crappiest mirror handler */

	error_reporting(0);

	// filename with free hosting mirrors list
	$fname = "./mirrors.txt";
	$sym = ','; // space sym -- tab
	$nac_day = 3; // recheck no avail. mirror after ... days
	$nof_day = 7; // recheck mirror with not found page afer ...
		$eat_only = 610; // eat only first ... for speedup not found check
	$nosock_day = 20; // recheck mirror with blocked socket connections
		$eat_till = 7000; // eat till ... for speedup checking of blocked sockets
	
	$fh = fopen($fname, 'r') or die("Can't load file");
	$mirrors = array(""); $buf_n = array("");
	$buf_s = array("");
	$today = time();
	
	$nac_day *= 86400; $nof_day *= 86400; $nosock_day *= 86400;
	
	// read file
	$i = 0;
	while(!feof($fh)) {
		$buf = fgets($fh, 4096);
		$buf = trim($buf);
		if(!$buf) continue;
		$found = strpos($buf, $sym);
		
		if(!$found)
			$mirrors[$i] = array("name"=>$buf);
		else {
			$expl_ar = explode($sym, $buf);
			$mirrors[$i] = array("name"=>$expl_ar[0], "status"=>$expl_ar[1]);
		}
		
		$i++;
	}
	
	fclose($fh);
	
	if(!$found) {
		// Check by getting page
		for($i = 0; $i < count($mirrors); $i++) {
			$mirrors[$i]["status"] = 0;
			
			// Check for opened http port
			$sect = fsockopen($mirrors[$i]["name"], 80, $errno, $errstr, 10);
			if(!$sect) { $mirrors[$i]["status"] = $today + $nac_day; continue; }
			// Check for page
			$sect = file_get_contents('http://'.$mirrors[$i]["name"], NULL, NULL, 0, $eat_only);
			if(!$sect) { $mirrors[$i]["status"] = $today + $nac_day; continue; }
			$found2 = strpos($sect, "n2n");
			if(!$found2) { $mirrors[$i]["status"] = $today + $nof_day; continue; }
			
			// Check for no allowed socket connections
			$sect = file_get_contents('http://'.$mirrors[$i]["name"], NULL, NULL, $eat_only, $eat_till);
			if(!$sect) { $mirrors[$i]["status"] = $today + $nac_day; continue; }
			$found3 = strpos($sect, "Not fsockopen"); // be warning! utf-8
			if($found3) { $mirrors[$i]["status"] = $today + $nosock_day; continue; }	
		}
	}
	else {
		for($i = 0; $i < count($mirrors); $i++) {
			if($mirrors[$i]["status"] == 0 || $today >= $mirrors[$i]["status"]) { 
				// Check for opened http port
				$sect = fsockopen($mirrors[$i]["name"], 80, $errno, $errstr, 10);
				if(!$sect) { $mirrors[$i]["status"] = $today + $nac_day; continue; }
				// Check for page
				$sect = file_get_contents('http://'.$mirrors[$i]["name"], NULL, NULL, 0, $eat_only);
				if(!$sect) { $mirrors[$i]["status"] = $today + $nac_day; continue; }
				$found2 = strpos($sect, "n2n");
				if(!$found2) { $mirrors[$i]["status"] = $today + $nof_day; continue; }
			
				// Check for no allowed socket connections
				$sect = file_get_contents('http://'.$mirrors[$i]["name"], NULL, NULL, $eat_only, $eat_till);
				if(!$sect) { $mirrors[$i]["status"] = $today + $nac_day; continue; }
				$found3 = strpos($sect, "Not fsockopen"); // be warning! utf-8
				if($found3) { $mirrors[$i]["status"] = $today + $nosock_day; continue; } 
			}
		}
	}
	
	if($fh = fopen($fname, 'w')) {
		for($i = 0; $i < count($mirrors); $i++)
			fwrite($fh, implode($sym, $mirrors[$i])."\r\n");
		fclose($fh);
	}
	
	for($j = 0, $i = 0; $i < count($mirrors); $i++) {
		
		// Creating array of truly working mirrors
		if($mirrors[$i]["status"] == 0 || $today >= $mirrors[$i]["status"]) {
			$mirrors_clean[$j]["name"] = $mirrors[$i]["name"];
			$mirrors_clean[$j]["status"] = $mirrors[$i]["status"];
		}
		$j++;
	}

	if(count($mirrors_clean) == NULL) die("Fuck! All mirrors are dead. Please contact me in hurry (if you know how to reach me)");
	$echo = file_get_contents('http://'.$mirrors_clean[rand(0, count($mirrors_clean)-1)]["name"]) or header("Location: ".$_SERVER['PHP_SELF']);
	echo $echo; 
?>
