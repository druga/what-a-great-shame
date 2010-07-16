<?echo '<'.'?'?>xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link rel="shortcut icon" href="./media/favicon.ico" /> 
<title>n2n: идеальный игровой VPN. Комьюнити «playpus»</title>
<style type="text/css"> 
body{background-color:#fff;margin:0px;}
p{margin:10px;}
span{margin:0px;}
hr{border:1px;height:1px;color:gray;background-color:gray;margin:3px;}
<!-- img.center{display:block;margin-left:auto;margin-right:auto;} -->
pre{margin:10px;}
</style> 
</head>
<body>
<table width="100%"><tr align="center"><td><a href="http://ntop.org/n2n"><img src="./media/ntop.gif" alt="ntop.org logo" title="ntop.org" style="border:0px" /></a></td></tr></table>
<p><b><span style="color:gray">Навигация</span></b><br /></p>
<ul>
<li><a href="#about">Что это?</a></li>
<li><a href="#how">Как оно работает?</a></li>
<li><a href="#speed">Какова скорость соединения?</a></li>
<li><a href="#servers">Наши сервера (и чекалка их работоспособности)</a></li>
<li><a href="#choice">Какой сервер выбрать?</a></li>
<li><a href="#client">Клиент для Windows</a></li>
<li><a href="#whatnow">Что дальше?</a></li>
<li><a href="#where">Где взять ПО для UNIX-мира</a></li>
<li><a href="#links">Другие полезные файлы и документация</a></li>
<li><a href="#concl">Вместо заключения. Осторожно мат!</a></li>
</ul>
<p><b><a id="about"><span><a href="#about" style="color:gray">Что это?</a></span></a></b><br />
Это страница комьюнити «playpus» VPN-сети, создаваемой с помощью опен-сорцевого ПО n2n.
n2n позволяет создавать VPN-сети без шифрования между узлами (если не пускать дополнительно туннель) куда
более эффективнее, чем другой софт (проприетарное: Hamachi, Leaf, NeoRouter, или бесплатное, как то Wippien), и
следовательно идеально подходит для создания области видимости для пиратских игр, дозволяющих играть по LAN,
при желании сыграть с друзьями по сети Интернет.<br /></p>
<table width="100%"><tr align="center"><td><img src="http://www.ntop.org/n2n/2.png" alt="n2n architecture" title="n2n architecture" /></td></tr></table><p style="text-align:center;color:gray">Архитектура n2n</p><p><br />
<b><a id="how"><span><a href="#how" style="color:gray">Как оно работает?</a></span></a></b><br />
n2n использует архитектуру p2p для сообщений между участниками и роутинга. n2n может обеспечивать соединение между двумя
машинами, даже если они обе находятся за NAT'ами. Но в эпоху быстрых и дешевых интернетов, выделенных внешних IP эта функция
больше нагрузочная, чем необходимая постоянно, т.к. в этом случае обе пользовательские ноды обязаны обмениваться трафиком через
superedge-сервер, и следовательно предъявляет серьезные требования к ширине его канала и трафику.
Огромный плюс также и в том, что это проект с исходными кодами, имеющий чистую раздельную реализацию сервера (supernode)
и клиента (edge node). Уникальность архитектуры в том, что сервер не хранит статические данные о ее членах и логины/пароли для входа.
Сервер не содержит функций клиента, и не является edge node ни в каком из ее проявлений, члены сети сами авторизуются используя комбинацию
из логина и пароля, и в случае их совпадения на обеих сторонах, между клиентами устанавливается туннель. В безNAT'овом варианте supernode служит лишь
для установления связи между ее нодами, но трафик идет напрямую между клиентами. Посему можно иметь множество серверов и по умиранию одного
использовать другой. Поэтому проблем с логином, как в случае Hamachi возникнуть не может. Децентрализованная система есть и у проприетарных бесплатных
решений вроде NeoRouter, но в случае с ним, нужно каждый раз передобавлять членов сети при падении сервера с информацией домена.<br />
Реализация первой версии проекта supernode в бинарном стрипнутом виде крошечна, что вкупе с открытостью позволяет запихнуть ее на массу устройств:<br /><br /></p>
<pre>dukzcry@p2 ~/n2n $ du -h ./supernode
32K     ./supernode
</pre>
<p><span style="color:gray">Вес динамически линкуемого бинарника под x86 Linux 2.6</span><br /><br />
<b><a id="speed"><span><a href="#speed" style="color:gray">Какова скорость соединения?</a></span></a></b><br />
При отсутсвии NAT такая же как при прямом соединении, но ограничивается скоростью более медленного соединения одного из участников.<br /><br />
<b><span style="color:gray;text-align:center">Так ли уж хорошо это решение? Подходит ли оно абсолютно всем?</span></b><br />
Разумеется НЕТ. Среди замеченных мною недостатков по сравнению с платными и проприетарными решениями можно выделить следущие:</p>
<ol>
<li>Отсутствие графического клиента как такового, а именно функций показа членов сети и информации о них;</li>
<li>Нет возможности найти других членов сети без связи с ними или сканирования сети;</li>
<li>Скудные функции шифрования сети;</li>
<li>Отстутствие официальных публичных серверов, и следовательно необходимость иметь как минимум одну машину с внешним IP для сервера;</li> 
<li>Отсутствие официального Виндового решения с гуевой мордой и возможности работать приложению-клиенту как сервиса Винды без танцев с бубном;</li>
<li>Использование TAP-устройства от проекта OpenVPN вместо проприетарного оптимизированного сетевого устройства, как у некоторых других проектов.</li> 
</ol>
<p><b><a id="servers"><span><a href="#servers" style="color:gray">Наши сервера:</a></span></a></b></p>
<hr />
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
<br />
<b>Параметры подключения</b>: <b>Group name</b>: playpus. <b>Password</b>: [default].<br /> 
Пароль необходимо выбрать совместно. При несовпадении пароля у N-го участника, подключившегося
к серверу с остальными, он оказывается в своей отдельной сети.<br />
</p><hr />
<p><span style="color:blue">*</span> — Рекомендуется использовать только в случае прямой видимости между нодами, дабы не сожрать кучу драгоценного трафика.<br /><br />
<b><a id="choice"><span><a href="#choice" style="color:gray">Какой сервер выбрать?</a></span></a></b><br />
Алгоритм выбора сервера всегда таков, что подключаться нужно к <i>первому действующему серверу с безлимитным каналом</i>. Если таковых не имеется, то приоритетным становится
первый по списку сервер с платным трафиком.<br />
<b><i>Внимание!</i></b> Практически невозможна ситуация когда <i>все</i> серверы лягут, поэтому если Вы видите вместо залихвацки подмигивающей пидорской мордашки 
надувшуюся, попробуйте обновить страницу, это подгрузит контент с другого зеркала. Ситуация, когда хостер режет подключения к определенных портам удаленных серверов нередка. Также хостер может на свое 
усмотрение включить safe_mode и/или отключить сокеты (функцию fsockopen()).<br /><br />
<b><a id="client"><span><a href="#client" style="color:gray">Клиент для Windows</a></span></a></b><br />
Так как основной контингент — игровая аудитория, будем рассматривать процесс установки клиента под Винду.<br />
Консольный вариант edge node можно найти <a href="http://luca.ntop.org/n2nWin32/binary/">здесь</a>. Но он имееет некоторые ограничения и не очень удобен, поэтому я рекомедую
скачать прекрасную утилиту — n2n gui, собранную проектом <a href="http://vpnhosting.cz">VPNHosting.cz</a>, включающую в себя кроме самодельного UI edge node и TAP-драйвер виртуального
интерфейса от проекта OpenVPN.<br /><br />
<b>Особенности</b>:<br />
<b>+</b> Сохраняет настройки в .ini-формате<br />
<b>-</b> Не ведет лог<br />
<b>-</b> Не дает настроить параметры командной строки<br /><br />
<b>Скачать</b>:<br />
<a href="./distrib/n2nguien.exe">n2n gui v0.35</a> / <i>официальное <a href="http://www.vpnhosting.cz/n2nguien.exe">зеркало</a> (более свежая версия)</i><br />
<a href="./distrib/n2nguienamd64.exe">n2n gui v0.35 для Windows x64</a> / <i>официальное <a href="http://www.vpnhosting.cz/n2nguienamd64.exe">зеркало</a> (более свежая версия)</i><br /><br />
Теперь рассмотрим процесс установки и настройки приложения.<br /><br /></p>
<table width="100%"><tr align="center"><td><img src="./media/install.png" alt="Install window" title="Отметьте галкой для установки TAP-устройства" /></td></tr></table><p style="text-align:center;color:gray">Если у Вас не было установлено никакого TAP-уйстройства (например, созданного Hamachi), отметьте галкой. Желательно удалить устройство оставленное сторонним софтом.<br /><br /></p>
<table width="100%"><tr align="center"><td><img src="./media/trayicon.png" alt="Tray icon" title="Войдите в меню настроек" /></td></tr></table><p style="text-align:center;color:gray">Теперь войдите в меню настроек.<br /><br /></p>
<table width="100%"><tr align="center"><td><img src="./media/settingswindow.png" alt="Settings window" title="Окно настроек" /></td></tr></table><p style="text-align:center;color:gray">Далече настраиваем по пунктам.</p>
<ol>
	<li>Вписываем сервер, выбранный, как указывалось <a href="#servers">выше</a>;</li>
	<li>Указываем порт сервера;</li>
	<li>Выбираем себе IP адрес, софт не умеет использовать DHCP (хотя эта возможность реализована в edge node).
	В нашем комьюнити принято выбирать подсеть 5.1.1.*, т.е. C-класса, которая не пересекается с распространенными 192.168/* и 10/*.
	Поэтому изменяем (в обязательном порядке) только последнюю часть, отделенную точкой.
	Опросите других членов сети, не занят ли придуманный Вами адрес. Это должно быть число от 1 до 254;</li>
	<li>Введите название комьюнити. В нашем случае это «playpus»;</li>
	<li>Введите условленный пароль.</li>
</ol>
<p>
Нажмите кнопку «Advanced», <i>если</i> хотите настроить дополнительные опции.<br /><br /></p>
<table width="100%"><tr align="center"><td><img src="./media/advanced.png" alt="Advanced settings window" title="Окно дополнительных настроек" /></td></tr></table><p style="text-align:center;color:gray">Необязательные настройки.</p><p><br />
Из настроек, которые <i>желательно</i> выставить при возможности открывать порты и наличии внешнего IP отметим тут лишь п. №1
</p>
<ol>
<li>Точное назначение неизвестно :) Но по наитию Петра это считается за прямой входящий порт для установления соединений между
нодами, хотя по тому, что там написано это наверняка не так. В любом случае выставьте в нем цыферки;</li>
<li>По желанию отметить для переодического пощупывания сервера;</li>
<li>Вероятнее всего это необходимая опция для заворота пакетов по сети, т.е. тем, кто активно NAT'ит.</li>
</ol>
<p>
Теперь смело тычем «Ok», опосля чего смело выходим по «Quit» и запускаем программу заново. Настройки должны применится, но
проверив реальную работоспособность сети можно вычитав написанное <a href="#whatnow">ниже</a>.<br />
Теперь переименуем соединение «Подключение по локальной сети» в «n2n», это понадобится для игр на базе <a href="#links">XLive</a>, да и с эстетической точки зрения пользователя Винды не помешает.<br /><br /></p>
<table width="100%"><tr align="center"><td><img src="./media/connections.png" alt="Windows connections" title="Сетевые соединения в Винде" /></td></tr></table><p style="text-align:center;color:gray">Для инвалидов: <i>Пуск (Start)</i> &rarr; <i>Настройки (Settings)</i> &rarr; <i>Панель управления (Control Panel)</i> &rarr; <i>Сетевые подключения (Network Connections)</i>
</p><p><br />
<b><a id="whatnow"><span><a href="#whatnow" style="color:gray">Что дальше?</a></span></a></b><br />
Проверить работу сети можно узнав адрес члена сети и пропинговав его, и во что-нибудь сыграв в конце концов :-)<br /><br />
</p><table width="100%"><tr align="center"><td><img src="./media/ping_for_morons.png" alt="Windows Ping command for morons" title="Виндовая команда ping для слабоумных" /></td></tr></table><p style="text-align:center;color:gray">Повторно для идиотов: <i>Пуск (Start)</i> &rarr; <i>Выполнить (Run) (или Win + R вместо предыдущих двух команд)</i> &rarr; <i>cmd</i> &rarr; <i>ping [IP_друга]</i><br /><br /></p><p>
<b><a id="where"><span><a href="#where" style="color:gray">Где взять ПО для UNIX-мира?</a></span></a></b><br />
Раньше были доступны готовые бинарные сборки под FreeBSD x86, но теперь ресурс, на котором они хостились безвозвратно помер.
Готовые бинарники для Linux под кучу архитектур можно взять <a href="http://packages.debian.org/squeeze/n2n">тут</a>.
Они для Debian, но при потрошении .deb-пакета подходят и к чему угодно другому, лишь бы динамические зависимости были бы удовлетворены.<br />
Также предлагаю готовые бинарники <i>только</i> supernode-сервера под <a href="./distrib/supernode-only-linux-x86-dynamic-and-mips-static.tar.gz">Linux для x86 (динамический слинкованный) и MIPS (статически слинкованный, подойдет для роутеров на базе Broadcom MIPS процессоров)</a>.<br />
Если у Вас не Linux, и Вам нужен edgenode и даже supernode, то нужно лишь стянуть сорцы через subversion командой <i>svn co https://svn.ntop.org/svn/ntop/trunk/n2n</i> и затем сделать <i>make</i>.<br />
У нас в комьюнити используется <i>n2n_v1</i>, который не имеет портов для управления. Не забывайте, что для edgenode Вам понадобится tun/tap устройство! Что значит, что с нерутовыми правами Вам не удастся сделать клиент на Вашей любимой UNIX-системе.
<br /><br />
<b><a id="links"><span><a href="#links" style="color:gray">Другие полезные файлы и документация:</a></span></a></b></p>
<hr /><p>
<a href="./distrib/remove-tap-adapter.zip">Убивает TAP-устройство, оставленное в системе после удаления n2n gui</a>. Удаляет только V9 TAP, но при желании исправляется ручками. Для Win32 и x64.<br />
<a href="./distrib/tap-win64.zip">TAP V8 драйвер для WinXP x64</a>. На всякий случай. <a href="http://openvpn.se/files/xp64/tap-win64.zip">Офзеркало</a>.<br />
<a href="./distrib/XLive-n2n.reg">Файл реестра для XLive-игр</a>. <b>Must wanted</b> тем, <b>кто хочет поиграть в XLive</b>-игры. Замещает соединение по умолчанию соединением n2n.<br />
<a href="http://www.ntop.org/n2n/">Офсайт</a>.<br />
<a href="./distrib/supernode-freebsd-x86.gz">Бинарник supernode для FreeBSD x86 (динамически слинкованный).</a><br />
<a href="http://virtualmultiplayerlan.blogspot.com/2009/03/playing-lan-games-online.html">Другой вариант оболочки для n2n со встроенным DHCP-сервером, но залоченностью на сервер и комьюнити автора</a>.
</p><hr /><h2 style="text-align:right;margin:9px"><a href="." style="text-decoration:none" title="В начало">&uarr;</a></h2><p>
<b><a id="concl"><span><a href="#concl" style="color:gray">Вместо заключения</a></span></a></b><br />
Я так заебался мерзко верстать и мерзко писать этот премерзкий гайд, что я Вас всех ненавижу. Надеюсь это мой последний бесполезный туториал :D
<br /><br />
<b>Кнопки-хуепки (код страницы валиден не на всех зеркалах)</b>:<br />
 <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml11-blue"
        alt="Valid XHTML 1.1" height="31" width="88" style="border:0" /></a> <a href="http://jigsaw.w3.org/css-validator/check/referer">
    <img style="border:0;width:88px;height:31px"
        src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
        alt="Правильный CSS!" />
</a>
</p>
</body>
</html>