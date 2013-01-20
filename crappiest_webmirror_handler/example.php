<?
    error_reporting(0);

	// n2n supernodes
	$servers = array( array("host1", "port"),
					  array("host2", "port"),
					  array("host3", "port"),
					  array("host4", "port"),
					);
	// checking time limit (in sec)
	$limit = 5;

	$i = 0;
	echo '<p>Supernode #'.$i.': Хост: <b>'.$servers[$i][0].'</b>.'.' Порт: <b>'.$servers[$i][1].'</b>. Жив? '.check_server($servers[$i][0], $servers[$i][1], $limit).'<br />';
	echo 'Описание: <span style="color:blue">трафик: безлимитный, предпочтительный сервер для подключения.</span><br />';
	echo 'Supernode #'.++$i.': Хост: <b>'.$servers[$i][0].'</b>.'.' Порт: <b>'.$servers[$i][1].'</b>. Жив? '.check_server($servers[$i][0], $servers[$i][1], $limit).'<br />';
	echo 'Описание: <span style="color:blue">трафик: лимитированный*, резервный сервер.</span><br />';
	//echo 'Supernode #3: Хост: <b>'.$servers[2].'</b>.'.' Порт: <b>'.$port.'</b>. Жив? '.check_server($servers[2], $port, $limit).'<br />';
	//echo 'Описание: <span style="color:blue">трафик: лимитированный*, резервный сервер.</span><br />';
	echo 'Supernode #'.++$i.': Хост: <b>'.$servers[$i][0].'</b>.'.' Порт: <b>'.$servers[$i][1].'</b>. Жив? '.check_server($servers[$i][0], $servers[$i][1], $limit).'<br />';
	echo 'Описание: <span style="color:blue">трафик: безлимитный, 10 Мб/c канал, предпочтительный сервер для подключения.</span><br />';
	echo 'Supernode #'.++$i.': Хост: <b>'.$servers[$i][0].'</b>.'.' Порт: <b>'.$servers[$i][1].'</b>. Жив? '.check_server($servers[$i][0], $servers[$i][1], $limit).'<br />';
	echo 'Описание: <span style="color:blue">трафик: безлимитный, 10 Мб/с канал, предпочтительный сервер для подключения.</span><br />';
	
	function check_server($s, $p, $l)
	{
		$cp = fsockopen($s, $p, $errno, $errstr, $l);
	
		if(!$cp)	
		{
			$ret_str = '<img src="./media/sad.png" alt="Dead. Sad smile." title="Dead" />';
			
			if($errno && $errstr)
				$ret_str .= 'Номер ошибки: '.$errno.', описание ошибки: '.$errstr.'.';
			else
				$ret_str .= 'Описание ошибки: Not fsockopen() error.';
				
			return $ret_str;
		}
		else {
			fsockclose($cp);
	        return '<img src="./media/gay.png" alt="Alive! Gay smile." title="Alive!" />';
		}		
	}
?>