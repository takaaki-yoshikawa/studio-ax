<?php

	require "reserv_function.php";

try {

	/*-----------------------------------
	--------------- 値取得 ---------------
	-----------------------------------*/
	$reservedOk = "";
	$dateOk = true;
	$date = $_POST['cdate'];
	$nowdate = date("Y-m-d",strtotime("+ 1 month"));
	if ( !current_user_can( 'manage_options' ) ) {
		if ($date > $nowdate) {
			$dateOk = false;
		}
	}
	
	$type = $_GET['ctype'];//一般利用orイベント利用
	$totalPrice = $_GET['totalPrice'];//一般利用orイベント利用
	$name = $_POST['cname'];
	$nameKn = $_POST['cnameKn'];
	$mail = $_POST['cemail'];
	$member = $_POST['cmember'];
	$tel = $_POST["ctel"];//電話番号
    $address = $_POST["caddress"];//住所
    $begginercheck = $_GET['begginercheck'];

	if (isset($_POST['file'])) {
	    $file = $_POST['file'];
	}
	$opentimeNormal = "";
	$closetimeNormal = "";
	if ($type == 1) {
		$studionameNormal = $_GET['studio'];
	}else{
		$studionameEvent = $_GET['eventstudio'];
	}
	$totalPrice = $_GET['totalPrice'];//添付画像
	$abcConfirm = false;
	$numberConfirm = false;
	$cancellConfirm = false;
	$lessonConfirm = true;
	$insertDb = false;
	$nullItem = false;
	$Holiday = holiday2($date);

	// if (!isset($type) || !isset($name) || !isset($address)) {
 //    	$nullItem = false;
 //    }
	/*-----------------------------------
	------- 予約の有無確認&DB書き込み ------
	-----------------------------------*/

	$week = date('w', strtotime($date));

	/*--------------- 一般レンタル ----------------*/
	if ($type == 1) {
		$opentimeNormal = $_POST["opentimeNormal"];//一般開始時間
    	$closetimeNormal = $_POST["closetimeNormal"];//一般終了時間

        $dopentimeNormal = strtotime($opentimeNormal);
        $dclosetimeNormal = strtotime($closetimeNormal);
        $useTimeH = $dclosetimeNormal - $dopentimeNormal;//利用時間
        $diffTime = date("H:i", $useTimeH);
        $diffMinute = ToMin($diffTime);
        //DB接続
		$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
		$user = 'cabkt020_ihaxk';
		$password = 'h43fsaksjr';

		$db = new PDO($dbc,$user,$password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		
        //他スタジオ確認
		switch ($studionameNormal) {
			case '1':
				$stConfirm = numberOneConfirm($date,$opentimeNormal,$studionameNormal,$diffMinute);
				break;
			case '2':
				$stConfirm = numberTwoConfirm($date,$opentimeNormal,$studionameNormal,$diffMinute);
				break;
			case '3':
				$stConfirm = numberThreeConfirm($date,$opentimeNormal,$studionameNormal,$diffMinute);
				break;
			case '12':
				$stConfirm = numberOneTwoConfirm($date,$opentimeNormal,$studionameNormal,$diffMinute);
				break;
			case 'a':
				$stConfirm = stAConfirm($date,$opentimeNormal,$studionameNormal,$diffMinute);
				break;
			case 'b':
				$stConfirm = stBConfirm($date,$opentimeNormal,$studionameNormal,$diffMinute);
				break;
			case 'c':
				$stConfirm = stCConfirm($date,$opentimeNormal,$studionameNormal,$diffMinute);
				break;
			case 'ab':
				$stConfirm = stABConfirm($date,$opentimeNormal,$studionameNormal,$diffMinute);
				break;
			case 'abc':
				$stConfirm = stABCConfirm($date,$opentimeNormal,$studionameNormal,$diffMinute);
				break;
		}
		
		//休館日じゃなければレッスン有無チェック
		if ($Holiday == "false") {
			
        	//30分がいくつあるか
			$count = $diffMinute / 30;
			// //30分の数だけ回して予約できるか確認
			for ($i=0; $i < $count; $i++) { 
        		
        		//休講の有無確認
				//もしAかBの予約ならスタジオABの休講を検索
        		if ($studionameNormal == "a" || $studionameNormal == "b") {
        			$studionameLesson = "ab";
        			$lectureCancell = lectureCancell($db, $date, $opentimeNormal, $studionameLesson);
        		}else{
        			$studionameLesson = $studionameNormal;
        			$lectureCancell = lectureCancell($db, $date, $opentimeNormal, $studionameLesson);
        		}
        		
				if (!$lectureCancell) {//falseなら休講なので、予約できるようlessonConfirmをtrueに
					$lessonConfirm = true;
				}else{
					switch ($week) {
			        	case '0':
			        		$lessonConfirm = sunLesson($studionameNormal,$opentimeNormal);
			        		break;
			        	case '1':
			        		$lessonConfirm = monLesson($studionameNormal,$opentimeNormal);
			        		break;
			        	case '2':
			        		$lessonConfirm = tueLesson($studionameNormal,$opentimeNormal);		        		
			        		break;
			        	case '3':
			        		$lessonConfirm = wedLesson($studionameNormal,$opentimeNormal);
			        		break;
			        	case '4':
			        		$lessonConfirm = thuLesson($studionameNormal,$opentimeNormal);
			        		break;
			        	case '5':
			        		$lessonConfirm = friLesson($studionameNormal,$opentimeNormal);
			        		break;
			        	case '6':
			        		$lessonConfirm = sutLesson($studionameNormal,$opentimeNormal);
			        		break;
			        }
				}
				if ($lessonConfirm != "true") {
		        	$i = 100;
		        	break;
	        	}	
		       	//開始時間の30分後を算出
				$opentimeNormal = date("H:i", strtotime("+30 minute",strtotime($opentimeNormal)));
			}
		}
        if (!$stConfirm) {
        	$reservedOk = false;
        }elseif($lessonConfirm != "true"){
        	$reservedOk = false;
        }else{
        	$reservedOk = true;
        }

        /*----------- DB書き込み -----------*/
        if ($reservedOk && $dateOk) {
			if ($type == 1) {
				$studio = $studionameNormal;
				$open_time = $_POST["opentimeNormal"];//一般開始時間
				if ($open_time != "23:00") {

					if ($diffMinute >= 30) {
						//30分がいくつあるか
						$count = $diffMinute / 30;
						//30分の数だけ回してINSERT
						for ($i=0; $i < $count; $i++) { 
							//DB書き込み
							$insertDb = insertDb($date,$name,$nameKn,$mail,$studio,$open_time,$member,$type,$address,$tel);
							//開始時間の30分後を算出
							$open_time = date("H:i", strtotime("+30 minute",strtotime($open_time)));
						}
					}
				}else{
					//DB書き込み
					$insertDb = insertDb($date,$name,$nameKn,$mail,$studio,$open_time,$member,$type,$address,$tel);
				}
				
			}
		}
    /*--------------- イベントレンタル ----------------*/
	}else{
		$opentimeEvent = $_POST['copentime'];//イベント開始時間
		$opentimeEvents = substr($opentimeEvent, 0, 5);
		$closetimeEvent = "";

		if ($opentimeEvents == "10:00") {
			$closetimeEvent = "23:00";//終了時間
		}
        $dopentimeEvent = strtotime($opentimeEvents);
        $dclosetimeEvent = strtotime($closetimeEvent);
        $useEventTimeH = $dclosetimeEvent - $dopentimeEvent;//利用時間
        $diffTime = date("H:i", $useEventTimeH);
        $diffMinute = ToMin($diffTime);
        //30分がいくつあるか
		$count = $diffMinute / 30;
		//休館日じゃなければレッスン有無チェック
		
		// //30分の数だけ回して予約できるか確認
		for ($i=0; $i < $count; $i++) {

			switch ($studionameEvent) {
				case '1':
					$stConfirm = numberOneConfirmEvent($date,$opentimeEvents,$studionameEvent);
					break;
				case '2':
					$stConfirm = numberTwoConfirmEvent($date,$opentimeEvents,$studionameEvent);
					break;
				case '3':
					$stConfirm = numberThreeConfirmEvent($date,$opentimeEvents,$studionameEvent);
					break;
				case '12':
					$stConfirm = numberOneTwoConfirmEvent($date,$opentimeEvents,$studionameEvent);
					break;
				case 'a':
					$stConfirm = stAConfirmEvent($date,$opentimeEvents,$studionameEvent);
					break;
				case 'b':
					$stConfirm = stBConfirmEvent($date,$opentimeEvents,$studionameEvent);
					break;
				case 'c':
					$stConfirm = stCConfirmEvent($date,$opentimeEvents,$studionameEvent);
					break;
				case 'ab':
					$stConfirm = stABConfirmEvent($date,$opentimeEvents,$studionameEvent);
					break;
				case 'abc':
					$stConfirm = stABCConfirmEvent($date,$opentimeEvents,$studionameEvent);
					break;
			}
			if(!$stConfirm){
	        	$i = 100;
	        	break;
	        }
			if ($Holiday) {
				//レッスン有無確認
		        switch ($week) {
		        	case '0':
		        		$lessonConfirm = sunLesson($studionameEvent,$opentimeEvents);
		        		break;
		        	case '1':
		        		$lessonConfirm = monLesson($studionameEvent,$opentimeEvents);
		        		break;
		        	case '2':
		        		$lessonConfirm = tueLesson($studionameEvent,$opentimeEvents);
		        		break;
		        	case '3':     		
		        		$lessonConfirm = wedLesson($studionameEvent,$opentimeEvents);
		        		break;
		        	case '4':
		        		$lessonConfirm = thuLesson($studionameEvent,$opentimeEvents);
		        		break;
		        	case '5':
		        		$lessonConfirm = friLesson($studionameEvent,$opentimeEvents);
		        		break;
		        	case '6':
		        		$lessonConfirm = sutLesson($studionameEvent,$opentimeEvents);
		        		break;
		        }
		        if($lessonConfirm != "true"){
		        	$i = 100;
		        	break;
		        }

		        //開始時間の30分後を算出
				$opentimeEvents = date("H:i", strtotime("+30 minute",strtotime($opentimeEvents)));
			}

		}
		
		if (!$stConfirm) {
        	$reservedOk = false;
        }elseif($lessonConfirm != "true"){
        	$reservedOk = false;
        }else{
        	$reservedOk = true;
        }

        /*--------- DB書き込み ---------*/
        if ($reservedOk && $dateOk) {
			$studio = $studionameEvent;
			$opentimeEvent = $_POST['copentime'];//イベント開始時間
			$opentimeEvents = substr($opentimeEvent, 0, 5);

			if ($opentimeEvents != "23:00") {
				//30分の数だけ回してINSERT
				for ($i=0; $i < $count; $i++) {

					//DB書き込み
					$insertDb = insertDb($date,$name,$nameKn,$mail,$studio,$opentimeEvents,$member,$type,$address,$tel);
					//開始時間の30分後を算出
					$opentimeEvents = date("H:i", strtotime("+30 minute",strtotime($opentimeEvents)));
				}
			}else{
				//DB書き込み
				$insertDb = insertDb($date,$name,$nameKn,$mail,$studio,$opentimeEvents,$member,$type,$address,$tel);
			}
		}
	}
	$studio = "";
	$closetime = "";
    // 送信ボタンが押されたら
    if (isset($_POST["csubmit"])) {
        // 送信ボタンが押された時に動作する処理をここに記述する
        if ($insertDb != false) {		        
	        if ($type == 1) {
				$studio = $studionameNormal;
				$opentimeNormal = $_POST["opentimeNormal"];
				$opentime = $opentimeNormal;
				$closetime = $closetimeNormal;
				$type = "一般レンタル";
			}else{
				$studio = $studionameEvent;
				$opentime = substr($opentimeEvent, 0, 5);
				$type = "イベントレンタル";

				if ($opentime == "10:00") {
					$closetime = "23:00";
				}else{
					$closetime = "7:00";
				}
			}
			if (isset($_POST['file'])) {
			    //メール送信
				$sendMail = sendMail($name,$nameKn,$date,$studio,$type,$opentime,$closetime,$mail,$member,$totalPrice,$begginercheck,$file,$address,$tel);
			}else{
				//メール送信
				$sendMail = sendMailNoFile($name,$nameKn,$date,$studio,$type,$opentime,$closetime,$mail,$member,$totalPrice,$begginercheck,$address,$tel);
			}
			      
	    }
	}
}catch(PDOException $e){
	die('エラー:' . $e->getMessage());
}
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php get_header(); ?>
<main class="Page__main Reserv__main">
	<section id="first-view1">
		<?php 
			if ($reservedOk && $dateOk) {
				echo '<h2 class="Section__title">BOOKING IS DONE<span>予約完了</span></h2>
		<p>'.$name.'様 ご予約を受け付けました。<br>
		予約内容確認メールを送信しましたのでご確認くださいませ。</p>
		<a href="/index.php" class="AX__Button Center">TOPに戻る<i class="fa fa-angle-right"></i></a>';
			}elseif ($reservedOk && !$dateOk) {
				echo '<h2 class="Section__title">BOOKING IS FAILURE<span>予約失敗</span></h2>
		<p>予約に失敗しました。<br>
		予約は1ヶ月以内です。修正して予約日時を確認し、再度予約してください。</p>
		<a href="/rentalstudio#carendar" class="AX__Button Center">スタジオ予約に戻る<i class="fa fa-angle-right"></i></a>';
			}else{
				echo '<h2 class="Section__title">BOOKING IS FAILURE<span>予約失敗</span></h2>
		<p>予約に失敗しました。<br>
		既に埋まっているか、レッスンが入っているため、もう一度時間をご確認の上ご予約くださいませ。</p>
		<a href="/rentalstudio#carendar" class="AX__Button Center">スタジオ予約に戻る<i class="fa fa-angle-right"></i></a>';
			}
		?>
		<!-- if (!$nullItem) {
				echo '<h2 class="Section__title">BOOKING IS FAILURE<span>予約失敗</span></h2>
		<p>予約に失敗しました。<br>
		入力項目が不足しています。再度ご確認の上、ご予約をお願いします。</p>
		<a href="/rentalstudio#carendar" class="AX__Button Center">スタジオ予約に戻る<i class="fa fa-angle-right"></i></a>';
			}else -->
	</section>
</main>
<?php get_footer(); ?>