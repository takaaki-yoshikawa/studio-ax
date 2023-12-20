<?php
	define( "FILE_DIR", realpath(dirname(__FILE__)));
	//本日取得
	function getToday($date = 'Y-m-d') {
			$today = new DateTime();
			return $today->format($date);
	}
	//本日かどうかチェック
	function isToday($year, $month, $day) {
		$today = getToday('Y-n-j');
		if ($today == $year."-".$month."-".$day) {
			return true;
		}
		return false;
	}
	
	//今週の日曜日の日付を返す
	function getSunday() {
	 
		$today = new DateTime();
		$w = $today->format('w');
		$ymd = $today->format('Y-m-d');
	 
		$next_prev = new DateTime($ymd);
		$next_prev->modify("-{$w} day");
		return $next_prev->format('Ymd');
	}
	//今週月曜日の日付を返す
	function getMonday() {
		$today = new DateTime();
		$w = $today->format('w');
		$ymd = $today->format('Y-m-d');
	 
		if ($w == 0) {
			$d = 6;
		}
		else {
			$d = $w - 1 ;
		}
		$next_prev = new DateTime($ymd);
		$next_prev->modify("-{$d} day");
		return $next_prev->format('Ymd');
	}
	//N日（週）+か-する関数
	function getNthDay($year, $month, $day, $n) {
		$next_prev = new DateTime($year.'-'.$month.'-'.$day);
		$next_prev->modify($n);
		return $next_prev->format('Ymd');
	}
	//時間を分に変換
	function ToMin($time){
		$tArry=explode(":",$time);
		$hour=$tArry[0]*60;//時間→分
		$mins=$hour+$tArry[1];//分だけを足す
		return $mins;	
	}
	//時間差を算出
	function time_diff($time_from, $time_to) {
	    // 日時差を秒数で取得
	    $dif = $time_to - $time_from;
	    // 時間単位の差
	    $dif_time = date("H:i", $dif);
	    return "{$dif_time}";
	}
	function confirmAdmin($id) {
		
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		
		$stmt = $db->prepare("SELECT * FROM Reservation where reserv_id = '".$id."'"
		);
		$stmt ->execute();
		$results = $stmt->fetch();

		return $results;
	}
	function closetimeReserv($date,$name,$nameKn,$mail,$studio,$member,$type) {
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		
		$stmt = $db->prepare("SELECT open_time FROM Reservation where name = '".$name."' and date = '".$date."' and nameKn = '".$nameKn."' and mail_address = '".$mail."' and studio = '".$studio."' and member = '".$member."' and type = '".$type."'"
		);

		$stmt ->execute();
		$time = "";
		while($res = $stmt->fetch()){
			$time = $res;
		}

		return $time;
	}
	function opentimeReserv($date,$name,$nameKn,$mail,$studio,$member,$type) {
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		
		$stmt = $db->prepare("SELECT open_time FROM Reservation where name = '".$name."' and date = '".$date."' and nameKn = '".$nameKn."' and mail_address = '".$mail."' and studio = '".$studio."' and member = '".$member."' and type = '".$type."' ORDER BY open_time ASC"
		);

		$stmt ->execute();
		$time = $stmt->fetch();

		return $time;
	}
	function reservConfirm($date,$opentime,$diffMinute,$studioname) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		if ($opentime == "23:00") {
			//日付で予約の有無を確認
			$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND studio = '".$studioname."'"
			);
			$stmt ->execute();
			$results = $stmt->fetch();
		}else{
			//30分がいくつあるか
			$count = $diffMinute / 30;
			// //30分の数だけ回して予約できるか確認
			for ($i=0; $i < $count; ++$i) { 
				//日付で予約の有無を確認
				$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND studio = '".$studioname."'"
				);
				$stmt ->execute();
				$results = $stmt->fetch();
				if (isset($results[0])) {
					$result = false;
				}else{
					$result = true;
				}
				//開始時間の30分後を算出
				$opentime = date("H:i", strtotime("+30 minute",strtotime($opentime)));
			}
		}
		return $result;
	}
	function reservConfirmEvent($date,$opentime,$studioname) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		
		$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND studio = '".$studioname."'"
		);
		$stmt ->execute();
		$results = $stmt->fetch();
		if (isset($results[0])) {
			$result = false;
		}else{
			$result = true;
		}
		return $result;
	}
	function stAConfirm($date,$opentime,$studioname,$diffMinute) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		if ($opentime == "23:00") {
			//日付で予約の有無を確認
			$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = 'ab' OR studio = 'a' OR studio = 'abc')"
			);
			$stmt ->execute();
			$results = $stmt->fetch();
			if (isset($results[0])) {
				$result = false;
			}else{
				$result = true;
			}
		}else{
			//30分がいくつあるか
			$count = $diffMinute / 30;
			// //30分の数だけ回して予約できるか確認
			for ($i=0; $i < $count; ++$i) { 
				//日付で予約の有無を確認
				$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = 'ab' OR studio = 'a' OR studio = 'abc')"
				);
				$stmt ->execute();
				$results = $stmt->fetch();
				if (isset($results[0])) {
					$result = false;
					$i = 100;
					break;
				}else{
					$result = true;
				}
				//開始時間の30分後を算出
				$opentime = date("H:i", strtotime("+30 minute",strtotime($opentime)));
			}
		}
		return $result;
	}
	function stBConfirm($date,$opentime,$studioname,$diffMinute) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		if ($opentime == "23:00") {
			//日付で予約の有無を確認
			$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = 'ab' OR studio = 'b' OR studio = 'abc')"
			);
			$stmt ->execute();
			$results = $stmt->fetch();
			if (isset($results[0])) {
				$result = false;
			}else{
				$result = true;
			}
		}else{
			//30分がいくつあるか
			$count = $diffMinute / 30;
			// //30分の数だけ回して予約できるか確認
			for ($i=0; $i < $count; ++$i) { 
				//日付で予約の有無を確認
				$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = 'ab' OR studio = 'b' OR studio = 'abc')"
				);
				$stmt ->execute();
				$results = $stmt->fetch();
				if (isset($results[0])) {
					$result = false;
					$i = 100;
					break;
				}else{
					$result = true;
				}
				//開始時間の30分後を算出
				$opentime = date("H:i", strtotime("+30 minute",strtotime($opentime)));
			}
		}
		return $result;
	}
	function stCConfirm($date,$opentime,$studioname,$diffMinute) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		if ($opentime == "23:00") {
			//日付で予約の有無を確認
			$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = 'c' OR studio = 'abc')"
			);
			$stmt ->execute();
			$results = $stmt->fetch();
			if (isset($results[0])) {
				$result = false;
			}else{
				$result = true;
			}
		}else{
			//30分がいくつあるか
			$count = $diffMinute / 30;
			// //30分の数だけ回して予約できるか確認
			for ($i=0; $i < $count; ++$i) { 
				//日付で予約の有無を確認
				$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = 'c' OR studio = 'abc')"
				);
				$stmt ->execute();
				$results = $stmt->fetch();

				if (isset($results[0])) {
					$result = false;
					$i = 100;
					break;
				}else{
					$result = true;
				}
				//開始時間の30分後を算出
				$opentime = date("H:i", strtotime("+30 minute",strtotime($opentime)));
			}
		}
		return $result;
	}
	function stABConfirm($date,$opentime,$studioname,$diffMinute) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		if ($opentime == "23:00") {
			//日付で予約の有無を確認
			$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = 'ab' OR studio = 'b' OR studio = 'a' OR studio = 'abc')"
			);
			$stmt ->execute();
			$results = $stmt->fetch();
			if (isset($results[0])) {
				$result = false;
			}else{
				$result = true;
			}
		}else{
			//30分がいくつあるか
			$count = $diffMinute / 30;
			// //30分の数だけ回して予約できるか確認
			for ($i=0; $i < $count; ++$i) { 
				//日付で予約の有無を確認
				$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = 'ab' OR studio = 'b' OR studio = 'a' OR studio = 'abc')"
				);
				$stmt ->execute();
				$results = $stmt->fetch();
				if (isset($results[0])) {
					$result = false;
					$i = 100;
					break;
				}else{
					$result = true;
				}
				//開始時間の30分後を算出
				$opentime = date("H:i", strtotime("+30 minute",strtotime($opentime)));
			}
		}
		return $result;
	}
	function stABCConfirm($date,$opentime,$studioname,$diffMinute) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		if ($opentime == "23:00") {
			//日付で予約の有無を確認
			$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = 'ab' OR studio = 'b' OR studio = 'a' OR studio = 'abc' OR studio = 'c')"
			);
			$stmt ->execute();
			$results = $stmt->fetch();
			if (isset($results[0])) {
				$result = false;
			}else{
				$result = true;
			}
		}else{
			//30分がいくつあるか
			$count = $diffMinute / 30;
			// //30分の数だけ回して予約できるか確認
			for ($i=0; $i < $count; ++$i) { 
				//日付で予約の有無を確認
				$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = 'ab' OR studio = 'b' OR studio = 'a' OR studio = 'abc' OR studio = 'c')"
				);
				$stmt ->execute();
				$results = $stmt->fetch();
				if (isset($results[0])) {
					$result = false;
					$i = 100;
					break;
				}else{
					$result = true;
				}
				//開始時間の30分後を算出
				$opentime = date("H:i", strtotime("+30 minute",strtotime($opentime)));
			}
		}
		return $result;
	}
	function stAConfirmEvent($date,$opentime,$studioname) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = 'ab' OR studio = 'a' OR studio = 'abc')"
		);
		$stmt ->execute();
		$results = $stmt->fetch();
		if (isset($results[0])) {
			$result = false;
		}else{
			$result = true;
		}
		return $result;
	}
	function stBConfirmEvent($date,$opentime,$studioname) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = 'ab' OR studio = 'b' OR studio = 'abc')"
		);
		$stmt ->execute();
		$results = $stmt->fetch();
		if (isset($results[0])) {
			$result = false;
		}else{
			$result = true;
		}
		return $result;
	}
	function stCConfirmEvent($date,$opentime,$studioname) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = 'c' OR studio = 'abc')"
		);
		$stmt ->execute();
		$results = $stmt->fetch();
		if (isset($results[0])) {
			$result = false;
		}else{
			$result = true;
		}
		return $result;
	}
	function stABConfirmEvent($date,$opentime,$studioname) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = 'ab' OR studio = 'b' OR studio = 'a' OR studio = 'abc')"
		);
		$stmt ->execute();
		$results = $stmt->fetch();
		if (isset($results[0])) {
			$result = false;
		}else{
			$result = true;
		}
		return $result;
	}
	function stABCConfirmEvent($date,$opentime,$studioname) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = 'ab' OR studio = 'b' OR studio = 'a' OR studio = 'abc' OR studio = 'c')"
		);
		$stmt ->execute();
		$results = $stmt->fetch();
		if (isset($results[0])) {
			$result = false;
		}else{
			$result = true;
		}
		return $result;
	}
	function numberOneConfirm($date,$opentime,$studioname,$diffMinute) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		if ($opentime == "23:00") {
			//日付で予約の有無を確認
			$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = '1' OR studio = '12')"
			);
			$stmt ->execute();
			$results = $stmt->fetch();
			if (isset($results[0])) {
				$result = false;
			}else{
				$result = true;
			}
		}else{
			//30分がいくつあるか
			$count = $diffMinute / 30;
			// //30分の数だけ回して予約できるか確認
			for ($i=0; $i < $count; ++$i) { 
				//日付で予約の有無を確認
				$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = '1' OR studio = '12')"
				);
				$stmt ->execute();
				$results = $stmt->fetch();
				if (isset($results[0])) {
					$result = false;
					$i = 100;
					break;
				}else{
					$result = true;
				}
				//開始時間の30分後を算出
				$opentime = date("H:i", strtotime("+30 minute",strtotime($opentime)));
			}
		}
		return $result;
	}
	function numberTwoConfirm($date,$opentime,$studioname,$diffMinute) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		if ($opentime == "23:00") {
			//日付で予約の有無を確認
			$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = '2' OR studio = '12')"
			);
			$stmt ->execute();
			$results = $stmt->fetch();
			if (isset($results[0])) {
				$result = false;
			}else{
				$result = true;
			}
		}else{
			//30分がいくつあるか
			$count = $diffMinute / 30;
			// //30分の数だけ回して予約できるか確認
			for ($i=0; $i < $count; ++$i) { 
				//日付で予約の有無を確認
				$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = '2' OR studio = '12')"
				);
				$stmt ->execute();
				$results = $stmt->fetch();
				if (isset($results[0])) {
					$result = false;
					$i = 100;
					break;
				}else{
					$result = true;
				}
				//開始時間の30分後を算出
				$opentime = date("H:i", strtotime("+30 minute",strtotime($opentime)));
			}
		}
		return $result;
	}
	function numberThreeConfirm($date,$opentime,$studioname,$diffMinute) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		if ($opentime == "23:00") {
			//日付で予約の有無を確認
			$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND studio = '3'"
			);
			$stmt ->execute();
			$results = $stmt->fetch();
			if (isset($results[0])) {
				$result = false;
			}else{
				$result = true;
			}
		}else{
			//30分がいくつあるか
			$count = $diffMinute / 30;
			// //30分の数だけ回して予約できるか確認
			for ($i=0; $i < $count; ++$i) { 
				//日付で予約の有無を確認
				$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND studio = '3'"
				);
				$stmt ->execute();
				$results = $stmt->fetch();
				if (isset($results[0])) {
					$result = false;
					$i = 100;
					break;
				}else{
					$result = true;
				}
				//開始時間の30分後を算出
				$opentime = date("H:i", strtotime("+30 minute",strtotime($opentime)));
			}
		}
		return $result;
	}
	function numberOneTwoConfirm($date,$opentime,$studioname,$diffMinute) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		if ($opentime == "23:00") {
			//日付で予約の有無を確認
			$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = '1' OR studio = '2' OR studio = '12')"
			);
			$stmt ->execute();
			$results = $stmt->fetch();
			if (isset($results[0])) {
				$result = false;
			}else{
				$result = true;
			}
		}else{
			//30分がいくつあるか
			$count = $diffMinute / 30;
			// //30分の数だけ回して予約できるか確認
			for ($i=0; $i < $count; ++$i) { 
				//日付で予約の有無を確認
				$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = '1' OR studio = '2' OR studio = '12')"
				);
				$stmt ->execute();
				$results = $stmt->fetch();
				if (isset($results[0])) {
					$result = false;
					$i = 100;
					break;
				}else{
					$result = true;
				}
				//開始時間の30分後を算出
				$opentime = date("H:i", strtotime("+30 minute",strtotime($opentime)));
			}
		}
		return $result;
	}
	function numberOneConfirmEvent($date,$opentime,$studioname) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = '1' OR studio = '12')"
		);
		$stmt ->execute();
		$results = $stmt->fetch();
		if (isset($results[0])) {
			$result = false;
		}else{
			$result = true;
		}
		return $result;
	}
	function numberTwoConfirmEvent($date,$opentime,$studioname) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = '2' OR studio = '12')"
		);
		$stmt ->execute();
		$results = $stmt->fetch();
		if (isset($results[0])) {
			$result = false;
		}else{
			$result = true;
		}
		return $result;
	}
	function numberThreeConfirmEvent($date,$opentime,$studioname) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND studio = '3'"
		);
		$stmt ->execute();
		$results = $stmt->fetch();
		if (isset($results[0])) {
			$result = false;
		}else{
			$result = true;
		}
		return $result;
	}
	function numberOneTwoConfirmEvent($date,$opentime,$studioname) {
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $db->prepare("SELECT reserv_id FROM Reservation where date = '" . $date . "' AND open_time = '".$opentime."'" . " AND (studio = '1' OR studio = '2' OR studio = '12')"
		);
		$stmt ->execute();
		$results = $stmt->fetch();
		if (isset($results[0])) {
			$result = false;
		}else{
			$result = true;
		}
		return $result;
	}
	function updatePin($date, $pin){
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';

		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		//プリペアドステートメントを作成
		$stmt = $db->prepare("UPDATE UpdatePin SET date='" . $date . "', pincode=" . $pin . " WHERE id = 1");
		//書き込み
		$insertJudge = $stmt ->execute();
		if ($insertJudge) {
			$result = true;
		}else{
			$result = false;
		}	
		return $result;
	}
	function selectPin(){
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';

		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		//プリペアドステートメントを作成
		$stmt = $db->prepare("select pincode from UpdatePin WHERE id = 1");
		//書き込み
		$stmt ->execute();
		$results = $stmt->fetch();

		return $results[0];
	}
	function insertDb($date,$name,$nameKn,$mail,$studio,$open_time,$member,$type,$address,$tel){
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';

		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		//プリペアドステートメントを作成
		$stmt = $db->prepare("
			INSERT INTO Reservation (date, name,nameKn, mail_address,open_time,studio,member,type,address,tel)
			VALUES (:date, :name,:nameKn , :mail_address,:open_time,:studio,:member,:type,:address,:tel)"
		);
		//パラメーター割り当て
		$stmt -> bindParam(':date', $date, PDO::PARAM_STR);
		$stmt -> bindParam(':name', $name, PDO::PARAM_STR);
		$stmt -> bindParam(':nameKn', $nameKn, PDO::PARAM_STR);
		$stmt -> bindParam(':mail_address', $mail, PDO::PARAM_STR);
		$stmt -> bindParam(':studio', $studio, PDO::PARAM_STR);
		$stmt -> bindParam(':open_time', $open_time, PDO::PARAM_STR);
		$stmt -> bindParam(':member', $member, PDO::PARAM_STR);
		$stmt -> bindParam(':type', $type, PDO::PARAM_STR);
		$stmt -> bindParam(':address', $address, PDO::PARAM_STR);
		$stmt -> bindParam(':tel', $tel, PDO::PARAM_STR);

		//書き込み
		$insertJudge = $stmt ->execute();
		if ($insertJudge) {
			$result = true;
		}else{
			$result = false;
		}	
		return $result;
	}
	function deleteDb($date,$name,$nameKn,$mail,$studio,$timeSql,$member,$type){
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';

		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		//プリペアドステートメントを作成
		$stmt = $db->prepare("DELETE FROM Reservation where name = '".$name."' and date = '".$date."' and nameKn = '".$nameKn."' and mail_address = '".$mail."' and studio = '".$studio."' and member = '".$member."' and type = '".$type."'".$timeSql
		);
		//書き込み
		$stmt ->execute();

	}
	function deleteLesson($date,$opentime,$studio){
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';

		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		//プリペアドステートメントを作成
		$stmt = $db->prepare("
			INSERT INTO LessonDelete (date,opentime,studio)
			VALUES (:date,:open_time,:studio)"
		);
		//パラメーター割り当て
		$stmt -> bindParam(':date', $date, PDO::PARAM_STR);
		$stmt -> bindParam(':open_time', $opentime, PDO::PARAM_STR);
		$stmt -> bindParam(':studio', $studio, PDO::PARAM_STR);

		//書き込み
		$insertJudge = $stmt ->execute();
		if ($insertJudge) {
			$result = true;
		}else{
			$result = false;
		}	
		return $result;
	}
	function resurrectionLesson($date,$opentime,$studio){
		$result = true;
		//DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		//プリペアドステートメントを作成
		$stmt = $db->prepare("
			DELETE FROM `LessonDelete` WHERE date = '" . $date . "' AND opentime = '" . $opentime . "' AND studio = '" . $studio  . "'"
		);
		//書き込み
		$insertJudge = $stmt ->execute();
		if (isset($insertJudge)) {
			$result = true;
		}else{
			$result = false;
		}	
		return $result;
	}
	function lectureCancell($db, $date,$opentime,$studio){
		$result = true;

		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $db->prepare("SELECT * FROM LessonDelete where date = '" . $date . "' AND opentime = '".$opentime."'" . " AND studio = '".$studio."'" 
		);

		$stmt ->execute();
		$results = $stmt->fetch();

		//休講ならfalse
		if (isset($results[0])) {
			$result = false;
		}else{
			$result = true;
		}
		// exit("result: " . $result);
		return $result;
	}
	function sunLesson($studio,$time){
		$noRental = "";
		switch ($studio) {
			case '1':
	            $noRental = "true";
	            break;
	        case '2':
	            $noRental = "true";
	            break;
	   //      case '3':
	   //          if ($time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00") {
				// 	$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				// }else{
				// 	$noRental = "true";
				// }
	   //          break;
	        case 'ab':
	          	$noRental = "true";
	            break;
            default:
	        	$noRental = "true";
	        	break;
		}
		return $noRental;
	}
	function monLesson($studio,$time){
		$noRental = "";
		switch ($studio) {
			case '1':
	            if ($time == "14:00" || $time == "14:30" ||  $time == "15:00" || $time == "15:30" || $time == "16:00" || $time == "16:30" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case '2':
	            if ($time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case '3':
	            if ($time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
			case '12':
	            if ($time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30" || $time == "22:00" || $time == "22:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case 'ab':
	          	if ($time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case 'a':
	          	if ($time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case 'b':
	          	if ($time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case 'abc':
	          	if ($time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            default:
	        	$noRental = "true";
	        	break;
		}
		return $noRental;
	}
	function tueLesson($studio,$time){
		$noRental = "";
		switch ($studio) {
			case '1':
	            if ($time == "12:30" || $time == "13:00" ||  $time == "13:30" || $time == "14:00" || $time == "14:30" || $time == "15:00"|| $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case '2':
	            if ($time == "15:30" || $time == "16:00" || $time == "16:30" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case '3':
	            if ($time == "11:00" || $time == "11:30" || $time == "12:00" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case '12':
	            if ($time == "14:00" || $time == "14:30" || $time == "15:00" || $time == "15:30" || $time == "16:00" || $time == "16:30" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
           	case 'ab':
	          	if ($time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
           	case 'a':
	          	if ($time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case 'b':
	          	if ($time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case 'abc':
	          	if ($time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            default:
	        	$noRental = "true";
	        	break;
		}
		return $noRental;
	}
	function wedLesson($studio,$time){
		$noRental = "";
		switch ($studio) {
			case '1':
	            if ($time == "14:00" || $time == "14:30" || $time == "15:00" || $time == "15:30" || $time == "16:00" || $time == "16:30" || $time == "17:00" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;

			case '2':
	            if ($time == "10:30" || $time == "11:00" || $time == "11:30" || $time == "15:30" || $time == "16:00" || $time == "16:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        
	        case '3':
	            if ($time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "20:30"  || $time == "21:00"  || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case '12':
	            if ($time == "10:30" || $time == "11:00" || $time == "11:30" || $time == "12:00" || $time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "14:00" || $time == "14:30" || $time == "15:00" || $time == "15:30" || $time == "16:00" || $time == "16:30" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case 'ab':
	          	if ($time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
           	case 'a':
	          	if ($time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case 'b':
	          	if ($time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case 'abc':
	          	if ($time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        default:
	        	$noRental = "true";
	        	break;
		}
		return $noRental;
	}
	function thuLesson($studio,$time){
		$noRental = "";
		switch ($studio) {
			case '1':
	            if ($time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "14:00" || $time == "14:30" || $time == "15:00" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case '2':
	            if ($time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30" || $time == "22:00") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case '3':
	            if ($time == "10:30" || $time == "11:00" || $time == "11:30" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case '12':
	            if ($time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "14:00" || $time == "14:30" || $time == "15:00" || $time == "15:30" || $time == "16:00" || $time == "16:30" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30" || $time == "22:00") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case 'ab':
	          	if ($time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case 'a':
	          	if ($time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case 'b':
	          	if ($time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case 'abc':
	          	if ($time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        default:
	        	$noRental = "true";
	        	break;
		}
		return $noRental;
	}
	function friLesson($studio,$time){
		$noRental = "";
		switch ($studio) {
			case '1':
	            if ($time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "14:00" || $time == "14:30" || $time == "15:00" || $time == "15:30" || $time == "16:00" || $time == "16:30" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case '2':
	            if ($time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "14:00" || $time == "14:30" || $time == "15:00" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case '3':
	            if ($time == "10:30" || $time == "11:00" || $time == "11:30" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30" || $time == "22:00") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case '12':
	            if ($time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "14:00" || $time == "14:30" || $time == "15:00" || $time == "15:30" || $time == "16:00" || $time == "16:30" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case 'ab':
	          	if ($time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case 'a':
	          	if ($time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case 'b':
	          	if ($time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	   //      case 'c':
	   //        	if ($time == "18:00" || $time == "18:30") {
				// 	$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				// }else{
				// 	$noRental = "true";
				// }
	   //          break;
            case 'abc':
	          	if ($time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        default:
	        	$noRental = "true";
	        	break;
		}
		return $noRental;
	}
	function sutLesson($studio,$time){
		$noRental = "";
		switch ($studio) {
			case '1':
	            if ($time == "11:30" || $time == "12:00" || $time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "14:00" || $time == "14:30" || $time == "15:00" || $time == "15:30" || $time == "16:00" || $time == "16:30" || $time == "17:00" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case '2':
	            if ($time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "14:00" || $time == "16:00" || $time == "16:30" || $time == "17:00" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case '3':
	            if ($time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "14:00" || $time == "14:30" || $time == "15:00" || $time == "15:30" || $time == "16:00" || $time == "16:30" || $time == "17:00" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case '12':
	            if ($time == "11:30" || $time == "12:00" || $time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "14:00" || $time == "14:30" || $time == "15:00" || $time == "15:30" || $time == "16:00" || $time == "16:30" || $time == "17:00" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00" || $time == "20:30" || $time == "21:00" || $time == "21:30") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        case 'ab':
	          	if ($time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "14:00" || $time == "14:30" || $time == "15:00" || $time == "15:30" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case 'a':
	          	if ($time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "14:00" || $time == "14:30" || $time == "15:00" || $time == "15:30" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case 'b':
	          	if ($time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "14:00" || $time == "14:30" || $time == "15:00" || $time == "15:30" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
            case 'abc':
	          	if ($time == "12:30" || $time == "13:00" || $time == "13:30" || $time == "14:00" || $time == "14:30" || $time == "15:00" || $time == "15:30" || $time == "17:30" || $time == "18:00" || $time == "18:30" || $time == "19:00" || $time == "19:30" || $time == "20:00") {
					$noRental = '<td class="lessontime">Lesson</td>'.PHP_EOL;
				}else{
					$noRental = "true";
				}
	            break;
	        default:
	        	$noRental = "true";
	        	break;
		}
		return $noRental;
	}
	//一般利用時間帯によるスタジオ料金を算出
	function studioPriceNormal($studioname,$opentime){
		$studioPriceNormal = 0;
		switch ($studioname) {
	        case '1':
	            if ($opentime == '10' || $opentime == '11' || $opentime == '12' || $opentime == '13' || $opentime == '14' || $opentime == '15' || $opentime == '16' || $opentime == '17') {
	                $studioPriceNormal = 1500 * 1.1;
	            }elseif($opentime == '18' || $opentime == '19' || $opentime == '20' || $opentime == '21' || $opentime == '22'){
	                $studioPriceNormal = 2000 * 1.1;
	            }elseif($opentime == '23'){
	            	$studioPriceNormal = 5560 * 1.08;
	            }
	            break;
	        case '2':
	            if ($opentime == '10' || $opentime == '11' || $opentime == '12' || $opentime == '13' || $opentime == '14' || $opentime == '15' || $opentime == '16' || $opentime == '17') {
	                $studioPriceNormal = 1200 * 1.1;
	            }elseif($opentime == '18' || $opentime == '19' || $opentime == '20' || $opentime == '21' || $opentime == '22'){
	                $studioPriceNormal = 1700 * 1.1;
	            }elseif($opentime == '23'){
	            	$studioPriceNormal = 4630 * 1.08;
	            }
	            break;
	        case '3':
	            if ($opentime == '10' || $opentime == '11' || $opentime == '12' || $opentime == '13' || $opentime == '14' || $opentime == '15' || $opentime == '16' || $opentime == '17') {
	                $studioPriceNormal = 1000 * 1.1;
	            }elseif($opentime == '18' || $opentime == '19' || $opentime == '20' || $opentime == '21' || $opentime == '22'){
	                $studioPriceNormal = 1500 * 1.1;
	            }elseif($opentime == '23'){
	            	$studioPriceNormal = 4630 * 1.08;
	            }
	            break;
	        case 'a':
	            if ($opentime == '10' || $opentime == '11' || $opentime == '12' || $opentime == '13' || $opentime == '14' || $opentime == '15' || $opentime == '16' || $opentime == '17') {
	                $studioPriceNormal = 800 * 1.1;
	            }elseif($opentime == '18' || $opentime == '19' || $opentime == '20' || $opentime == '21' || $opentime == '22'){
	                $studioPriceNormal = 1300 * 1.1;
	            }elseif($opentime == '23'){
	            	$studioPriceNormal = 2780 * 1.08;
	            }
	            break;
	        case 'b':
	            if ($opentime == '10' || $opentime == '11' || $opentime == '12' || $opentime == '13' || $opentime == '14' || $opentime == '15' || $opentime == '16' || $opentime == '17') {
	                $studioPriceNormal = 1500 * 1.1;
	            }elseif($opentime == '18' || $opentime == '19' || $opentime == '20' || $opentime == '21' || $opentime == '22'){
	                $studioPriceNormal = 2000 * 1.1;
	            }elseif($opentime == '23'){
	            	$studioPriceNormal = 5560 * 1.08;
	            }
	            break;
	        case 'c':
	            if ($opentime == '10' || $opentime == '11' || $opentime == '12' || $opentime == '13' || $opentime == '14' || $opentime == '15' || $opentime == '16' || $opentime == '17') {
	                $studioPriceNormal = 900 * 1.1;
	            }elseif($opentime == '18' || $opentime == '19' || $opentime == '20' || $opentime == '21' || $opentime == '22'){
	                $studioPriceNormal = 1400 * 1.1;
	            }elseif($opentime == '23'){
	            	$studioPriceNormal = 3250 * 1.08;
	            }
	            break;
	        case 'ab':
	            if ($opentime == '10' || $opentime == '11' || $opentime == '12' || $opentime == '13' || $opentime == '14' || $opentime == '15' || $opentime == '16' || $opentime == '17') {
	                $studioPriceNormal = 2200 * 1.1;
	            }elseif($opentime == '18' || $opentime == '19' || $opentime == '20' || $opentime == '21' || $opentime == '22'){
	                $studioPriceNormal = 2700 * 1.1;
	            }elseif($opentime == '23'){
	            	$studioPriceNormal = 7410 * 1.08;
	            	
	            }
	            break;
    	}
    	return $studioPriceNormal;
	}
	function studioPriceEvent($studioname,$opentime){
		$studioPriceEvent = 0;
		switch ($studioname) {
	        case '1':
	            if ($opentime == '10') {
	                $studioPriceEvent = 20000 * 1.1;
	            }else{
	                $studioPriceEvent = 14000 * 1.1;
	            }
	            break;
	        case '2':
	            if ($opentime == '10') {
	                $studioPriceEvent = 15000 * 1.1;
	            }else{
	                $studioPriceEvent = 12000 * 1.1;
	            }
	            break;
	        case '12':
	            if ($opentime == '10') {
	                $studioPriceEvent = 30000 * 1.1;
	            }else{
	                $studioPriceEvent = 20000 * 1.1;
	            }
	            break;
	        case 'ab':
	            if ($opentime == '10') {
	                $studioPriceEvent = 35000 * 1.1;
	            }else{
	                $studioPriceEvent = 30000 * 1.1;
	            }
	            break;
	        case 'abc':
	            if ($opentime == '10') {
	                $studioPriceEvent = 42000 * 1.1;
	            }else{
	                $studioPriceEvent = 35000 * 1.1;
	            }
	            break;
    	}
    	return $studioPriceEvent;
	}
	function studioPriceHoliday($studioname,$opentime){
		$studioPriceHoliday = 0;
		switch ($studioname) {
	        case '1':
	            if($opentime != '23'){
	                $studioPriceHoliday = 2000 * 1.1;
	            }else{
	            	$studioPriceHoliday = 5560 * 1.1;
	            }
	            break;
	        case '2':
	            if($opentime != '23'){
	                $studioPriceHoliday = 1700 * 1.1;
	            }else{
	            	$studioPriceHoliday = 4630 * 1.1;
	            }
	            break;
	        case '3':
	        	if($opentime != '23'){
	                $studioPriceHoliday = 1500 * 1.1;
	            }else{
	            	$studioPriceHoliday = 4630 * 1.1;
	            }
	            break;
	        case 'a':
	        	if($opentime != '23'){
	                $studioPriceHoliday = 1300 * 1.1;
	            }else{
	            	$studioPriceHoliday = 2780 * 1.1;
	            }
	            break;
	        case 'b':
	        	if($opentime != '23'){
	                $studioPriceHoliday = 2000 * 1.1;
	            }else{
	            	$studioPriceHoliday = 5560 * 1.1;
	            }
	            break;
	        case 'c':
	        	if($opentime != '23'){
	                $studioPriceHoliday = 1400 * 1.1;
	            }else{
	            	$studioPrstudioPriceHolidayiceNormal = 7410 * 1.1;
	            }
	            break;
	        case 'ab':
	        	if($opentime != '23'){
	                $studioPriceHoliday = 2700 * 1.1;
	            }else{
	            	$studioPriceHoliday = 3500 * 1.1;
	            }
	            
	            break;
    	}
    	return $studioPriceHoliday;
	}
	function studioPriceCpack($opentime){
		$studioPriceCpack = 0;
			if ($opentime == '10' || $opentime == '11' || $opentime == '12' || $opentime == '13' || $opentime == '14' || $opentime == '15' || $opentime == '16' || $opentime == '17') {
                $studioPriceCpack = 3000;
            }elseif($opentime == '18' || $opentime == '19' || $opentime == '20' || $opentime == '21' || $opentime == '22' || $opentime == '23'){
                $studioPriceCpack = 4500;
            }
    	return $studioPriceCpack;
	}

	function sendMail($name,$nameKn,$date,$studio,$type,$opentime,$closetime,$mail,$member,$totalPrice,$begginercheck,$clean,$address,$tel){
		$secret = "1028";
		// 日本語をメールで送る場合のおまじない
        mb_language("ja");
        mb_internal_encoding("UTF-8");

		$subject = "";
		$subject2 = "";
		$text = "";
		$text2 = "";
		$body = "";
		$body2 = "";
		$status = "false";
        $status2 = "false";
        $pageUrl = "http://studio-ax.co.jp/howuse/";
        switch ($studio) {
        	case '1':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#st1";
        		break;
        	case '2':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#st2";
        		break;
        	case '3':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#st3";
        		break;
        	case '12':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#st1";
        		break;
        	case 'a':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#sta";
        		break;
        	case 'b':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#stb";
        		break;
        	case 'a':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#sta";
        		break;
        	case 'c':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#stc";
        		break;
        	case 'ab':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#stab";
        		break;
        	default:
        		$pageUrl = "http://studio-ax.co.jp/howuse/";
        		break;
        }
		//初回か初回じゃないかでメール内容を分岐
		if ($begginercheck == 0) {
			// 件名を変数subjectに格納
		        $subject = "[Studio AX]新規予約通知";

		        // メール本文を変数bodyに格納
		        //管理者宛
		        $text = <<< EOM

				新規予約がありました。
				以下の予約内容を、メールにて確認させていただきました。

				【 お名前 】 
				{$name}

				【 フリガナ 】 
				{$nameKn}

				【 住所 】 
				{$address}

				【 電話番号 】 
				{$tel}

				【 予約日 】 
				{$date}

				【 スタジオ 】 
				St.{$studio}

				【 レンタル種別 】 
				{$type}

				【 利用時間 】 
				{$opentime}~{$closetime}

				【 メールアドレス 】 
				{$mail}

				【 利用人数 】 
				{$member}

				【 料金 】 
				{$totalPrice}円

				

				【 キーストック暗証番号 】 
				$secret
EOM;

				// 件名を変数subjectに格納
				$subject2 = "[Studio AX]ご予約頂きありがとうございます。";

				//ユーザー宛
				$text2 = <<< EOM

				{$name}　様

				この度はご予約いただき、ありがとうございます。
				以下、スタジオレンタルの詳細となります。
				必ずご確認いただきますよう、お願い致します。
				こちらのメールはレンタル当日まで破棄なさらぬようお願い致します。

				【 お名前 】 
				{$name}

				【 フリガナ 】 
				{$nameKn}

				【 住所 】 
				{$address}

				【 電話番号 】 
				{$tel}

				【 予約日 】 
				{$date}

				【 スタジオ 】 
				St.{$studio}

				【 レンタル種別 】 
				{$type}

				【 ご利用時間 】 
				{$opentime}~{$closetime}

				【 メールアドレス 】 
				{$mail}

				【 利用人数 】 
				{$member}

				【 料金 】 
				{$totalPrice}円

				【 キーストック暗証番号 】 
				$secret
				※万が一、暗証番号が変更になった場合は、ご連絡させていただきます。

				【 スタジオご利用方法 】 
				{$pageUrl}


				お支払いは当日フロントにて受付しております。
EOM;

		}else{//初回用メール

			// 件名を変数subjectに格納
		        $subject = "[Studio AX]新規予約通知";

		        // メール本文を変数bodyに格納
		        //管理者宛
		        $text = <<< EOM

				新規予約がありました。
				以下の予約内容を、メールにて確認させていただきました。

				【 お名前 】 
				{$name}

				【 フリガナ 】 
				{$nameKn}

				【 住所 】 
				{$address}

				【 電話番号 】 
				{$tel}

				【 予約日 】 
				{$date}

				【 スタジオ 】 
				St.{$studio}

				【 レンタル種別 】 
				{$type}

				【 利用時間 】 
				{$opentime}~{$closetime}

				【 メールアドレス 】 
				{$mail}

				【 利用人数 】 
				{$member}

				【 料金 】 
				{$totalPrice}円

				【 キーストック暗証番号 】 
				$secret
EOM;

				// 件名を変数subjectに格納
				$subject2 = "[Studio AX]ご予約頂きありがとうございます。";

				//ユーザー宛
				$text2 = <<< EOM
	
				{$name}　様

				この度はご予約いただき、ありがとうございます。
				以下、スタジオレンタルの詳細となります。
				必ずご確認いただきますよう、お願い致します。
				こちらのメールはレンタル当日まで破棄なさらぬようお願い致します。

				【 お名前 】 
				{$name}

				【 フリガナ 】 
				{$nameKn}

				【 住所 】 
				{$address}

				【 電話番号 】 
				{$tel}

				【 予約日 】 
				{$date}

				【 スタジオ 】 
				St.{$studio}

				【 レンタル種別 】 
				{$type}

				【 ご利用時間 】 
				{$opentime}~{$closetime}

				【 メールアドレス 】 
				{$mail}

				【 利用人数 】 
				{$member}

				【 料金 】 
				{$totalPrice}円

				【 キーストック暗証番号 】 
				$secret
				※万が一、暗証番号が変更になった場合は、ご連絡させていただきます。

				【 スタジオご利用方法 】 
				{$pageUrl}


				お支払いは当日フロントにて受付しております。
EOM;

		}
		// 送信元のメールアドレスを変数fromEmailに格納
        $fromEmail = "Reservation@studio-ax.com";

        // 送信元の名前を変数fromNameに格納
        $fromName = "ホームページからのスタジオ予約";

        // ヘッダー設定
        $header = "Mime-Version: 1.0\n";
        $header .= "Content-Type: multipart/mixed;boundary=\"__BOUNDARY__\"\n";
		$header .= "From: ".mb_encode_mimeheader($fromName)." <".$fromEmail.">";

        if ($begginercheck == 0) {
			// 管理者用
			$body = "--__BOUNDARY__\n";
			$body .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n\n";
			$body .= $text . "\n";
			$body .= "--__BOUNDARY__\n";

			// 利用者用
			$body2 = "--__BOUNDARY__\n";
			$body2 .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n\n";
			$body2 .= $text2 . "\n";
			$body2 .= "--__BOUNDARY__\n";

		}else{
			// 管理者用
			$body = "--__BOUNDARY__\n";
			$body .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n\n";
			$body .= $text . "\n";
			$body .= "--__BOUNDARY__\n";
			// ファイルを添付
			$body .= "Content-Type: application/octet-stream; name=\"{$clean}\"\n";
			$body .= "Content-Disposition: attachment; filename=\"{$clean}\"\n";
			$body .= "Content-Transfer-Encoding: base64\n";
			$body .= "\n";
			$body .= chunk_split(base64_encode(file_get_contents(FILE_DIR."/src/images/card/".$clean)));
			$body .= "--__BOUNDARY__--";


			// 利用者用
			$body2 = "--__BOUNDARY__\n";
			$body2 .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n\n";
			$body2 .= $text2 . "\n";
			$body2 .= "--__BOUNDARY__\n";
			
			
		}
		
        // メール送信を行う
        //axkanri@studio-ax.co.jp
        //
        //管理者用
        if(mb_send_mail("rental@studio-ax.co.jp",$subject ,$body,$header)){
            $status = "true";
        }else{
            $status = "false";
        }
        //利用者用
        if(mb_send_mail($mail,$subject2 ,$body2,$header)){
            $status2 = "true";
        }else{
            $status2 = "false";
        }
        if ($status == "true" && $status2 == "true") {
			return true;
		}else{
			return false;
		}
	}
	function holiday($db, $year,$month,$day){
		$result = true;

		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $db->prepare("SELECT date FROM Lesson_Holiday where date = '" . $year . "-" . $month . "-" . $day . "'"
		);
		$stmt ->execute();
		$results = $stmt->fetch();
		return $results;
	}
	function holiday2($date){
		$result = true;
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $db->prepare("SELECT date FROM Lesson_Holiday where date = " . "'" . $date . "'"
		);
		$stmt ->execute();
		$results = $stmt->fetch();
		if (!$results) {
			return true;
		}else{
			return false;
		}
		
	}
	function holidayPrice($date){
		$result = true;
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';
		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$stmt = $db->prepare("SELECT date FROM HolidayPriceUp where date = " . "'" . $date . "'"
		);
		$stmt ->execute();
		$results = $stmt->fetch();
		if (!$results) {
			return true;
		}else{
			return false;
		}
		
	}
	function sendMailNoFile($name,$nameKn,$date,$studio,$type,$opentime,$closetime,$mail,$member,$totalPrice,$begginercheck,$address,$tel){
		// $secret = selectPin();
		$secret = "1028";
		// 日本語をメールで送る場合のおまじない
        mb_language("ja");
        mb_internal_encoding("UTF-8");

		$subject = "";
		$subject2 = "";
		$text = "";
		$text2 = "";
		$body = "";
		$body2 = "";
		$status = "false";
        $status2 = "false";
        $pageUrl = "http://studio-ax.co.jp/howuse/";
        switch ($studio) {
        	case '1':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#st1";
        		break;
        	case '2':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#st2";
        		break;
        	case '3':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#st3";
        		break;
        	case '12':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#st1";
        		break;
        	case 'a':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#sta";
        		break;
        	case 'b':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#stb";
        		break;
        	case 'c':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#stc";
        		break;
        	case 'ab':
        		$pageUrl = "http://studio-ax.co.jp/howuse/#stab";
        		break;
        	default:
        		$pageUrl = "http://studio-ax.co.jp/howuse/";
        		break;
        }
		//初回か初回じゃないかでメール内容を分岐
		if ($begginercheck == 0) {
			// 件名を変数subjectに格納
		        $subject = "[Studio AX]新規予約通知";

		        // メール本文を変数bodyに格納
		        //管理者宛
		        $text = <<< EOM

				新規予約がありました。
				以下の予約内容を、メールにて確認させていただきました。

				【 お名前 】 
				{$name}

				【 フリガナ 】 
				{$nameKn}

				【 住所 】 
				{$address}

				【 電話番号 】 
				{$tel}

				【 予約日 】 
				{$date}

				【 スタジオ 】 
				St.{$studio}

				【 レンタル種別 】 
				{$type}

				【 利用時間 】 
				{$opentime}~{$closetime}

				【 メールアドレス 】 
				{$mail}

				【 利用人数 】 
				{$member}

				【 料金 】 
				{$totalPrice}円

				【 キーストック暗証番号 】 
				$secret
EOM;

				// 件名を変数subjectに格納
				$subject2 = "[Studio AX]ご予約頂きありがとうございます。";

				//ユーザー宛
				$text2 = <<< EOM

				{$name}　様

				この度はご予約いただき、ありがとうございます。
				以下、スタジオレンタルの詳細となります。
				必ずご確認いただきますよう、お願い致します。
				こちらのメールはレンタル当日まで破棄なさらぬようお願い致します。

				【 お名前 】 
				{$name}

				【 フリガナ 】 
				{$nameKn}

				【 住所 】 
				{$address}

				【 電話番号 】 
				{$tel}

				【 予約日 】 
				{$date}

				【 スタジオ 】 
				St.{$studio}

				【 レンタル種別 】 
				{$type}

				【 ご利用時間 】 
				{$opentime}~{$closetime}

				【 メールアドレス 】 
				{$mail}

				【 利用人数 】 
				{$member}

				【 料金 】 
				{$totalPrice}円

				【 キーストック暗証番号 】 
				$secret
				※万が一、暗証番号が変更になった場合は、ご連絡させていただきます。

				【 スタジオご利用方法 】 
				{$pageUrl}

				▲△▲△▲△▲△▲△▲△▲△▲△▲△
				注意事項
				・レンタルのキャンセルや予約内容変更は、お電話のみでの受付となります。
				・レンタルのキャンセルは24時間前までとなります。24時間を過ぎた場合は、レンタル料全額お支払いとなります

				※このメールは送信専用です。
				ご返信いただいてもお答えできません。
				予約内容変更・キャンセル・お問い合わせ等は、下記の電話番号またはメールアドレスにご連絡いただきますようお願いいたします。

				□■――――――――――――――――――――

				株式会社AX スタジオAX

				〒542-0086

				大阪市中央区西心斎橋1-12-8大美建築ビル3F

				TEL：06(6241)8303

				FAX：06(6241)8304

				📨：axkanri@studio-ax.co.jp

				HP：www.studio-ax.co.jp

				――――――――――――――――――――■□
EOM;

		}else{//初回用メール

			// 件名を変数subjectに格納
		        $subject = "[Studio AX]新規予約通知";

		        // メール本文を変数bodyに格納
		        //管理者宛
		        $text = <<< EOM

				新規予約がありました。
				以下の予約内容を、メールにて確認させていただきました。

				【 お名前 】 
				{$name}

				【 フリガナ 】 
				{$nameKn}

				【 住所 】 
				{$address}

				【 電話番号 】 
				{$tel}

				【 予約日 】 
				{$date}

				【 スタジオ 】 
				St.{$studio}

				【 レンタル種別 】 
				{$type}

				【 利用時間 】 
				{$opentime}~{$closetime}

				【 メールアドレス 】 
				{$mail}

				【 利用人数 】 
				{$member}

				【 料金 】 
				{$totalPrice}円

				【 キーストック暗証番号 】 
				$secret
EOM;

				// 件名を変数subjectに格納
				$subject2 = "[Studio AX]ご予約頂きありがとうございます。";

				//ユーザー宛
				$text2 = <<< EOM
	
				{$name}　様

				この度はご予約いただき、ありがとうございます。
				以下、スタジオレンタルの詳細となります。
				必ずご確認いただきますよう、お願い致します。
				こちらのメールはレンタル当日まで破棄なさらぬようお願い致します。

				【 お名前 】 
				{$name}

				【 フリガナ 】 
				{$nameKn}

				【 住所 】 
				{$address}

				【 電話番号 】 
				{$tel}

				【 予約日 】 
				{$date}

				【 スタジオ 】 
				St.{$studio}

				【 レンタル種別 】 
				{$type}

				【 ご利用時間 】 
				{$opentime}~{$closetime}

				【 メールアドレス 】 
				{$mail}

				【 利用人数 】 
				{$member}

				【 料金 】 
				{$totalPrice}円

				【 キーストック暗証番号 】 
				$secret
				※万が一、暗証番号が変更になった場合は、ご連絡させていただきます。

				【 スタジオご利用方法 】 
				{$pageUrl}

				▲△▲△▲△▲△▲△▲△▲△▲△▲△
				注意事項
				・レンタルのキャンセルや予約内容変更は、お電話のみでの受付となります。
				・レンタルのキャンセルは24時間前までとなります。24時間を過ぎた場合は、レンタル料全額お支払いとなります

				※このメールは送信専用です。
				ご返信いただいてもお答えできません。
				予約内容変更・キャンセル・お問い合わせ等は、下記の電話番号またはメールアドレスにご連絡いただきますようお願いいたします。

				□■――――――――――――――――――――

				株式会社AX スタジオAX

				〒542-0086

				大阪市中央区西心斎橋1-12-8大美建築ビル3F

				TEL：06(6241)8303

				FAX：06(6241)8304

				📨：axkanri@studio-ax.co.jp

				HP：www.studio-ax.co.jp

				――――――――――――――――――――■□
EOM;

		}
		// 送信元のメールアドレスを変数fromEmailに格納
        $fromEmail = "Reservation@studio-ax.com";

        // 送信元の名前を変数fromNameに格納
        $fromName = "ホームページからのスタジオ予約";

        // ヘッダ情報を変数headerに格納する      
        // $header = "From: " .mb_encode_mimeheader($fromName) ."<{$fromEmail}>";

        // ヘッダー設定
        $header = "Mime-Version: 1.0\n";
		$header .= "Content-Transfer-Encoding: 7bit\n";
		$header .= "From: ".mb_encode_mimeheader($fromName)." <".$fromEmail.">";

        if ($begginercheck == 0) {
			// 管理者用
			$body = $text . "\n";
			// 利用者用
			$body2 = $text2 . "\n";
		}else{
			// 管理者用
			$body = $text . "\n";

			// 利用者用
			$body2 = $text2 . "\n";
			
		}
		
        //管理者用
        if(mb_send_mail("rental@studio-ax.co.jp",$subject ,$body,$header)){
            $status = "true";
        }else{
            $status = "false";
        }
        //利用者用
        if(mb_send_mail($mail,$subject2 ,$body2,$header)){
            $status2 = "true";
        }else{
            $status2 = "false";
        }
        if ($status == "true" && $status2 == "true") {
			return true;
		}else{
			return false;
		}
	}

	
?>