<?php
	require "reserv_function.php";
// try {

	/*-----------------------------------
	--------------- 値取得 ---------------
	-----------------------------------*/
	$reservedOk = "";
	$date = $_GET['date'];
	$name = $_GET['nameKj'];
	$nameKn = $_GET['nameKn'];
	$mail = $_GET['mail'];
	$studio = $_GET['studio'];
	$member = $_GET['member'];
	$type = $_GET['type'];
	$timeSql = "";

	$changetime = $_POST['changetime'];
	if(!isset($_POST['changeall'])){
		$count = count($changetime);
		$timeSql = " and (open_time = '";
		for( $i = 0; $i < $count ;++$i ){
			if ($i != $count - 1) {
				$timeSql .= $changetime[$i]."' or open_time = '";
			}else{
				$timeSql .= $changetime[$i]."')";
			}
	  	}  
	}

	

		
  	
	/*-----------------------------------
	------- 予約の有無確認&DB書き込み ------
	-----------------------------------*/

	$week = date('w', strtotime($date));
	$dbc = 'mysql:host=mysql2205.xserver.jp;dbname=cabkt020_y8dvu;charset=utf8';
	$user = 'cabkt020_ihaxk';
	$password = 'h43fsaksjr';
	$db = new PDO($dbc,$user,$password);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	/*--------------- 一般レンタル ----------------*/
	if ($type == 1) {

        /*----------- DB書き込み -----------*/
		$result = deleteDb($date,$name,$nameKn,$mail,$studio,$timeSql,$member,$type);
		
				
				
    /*--------------- イベントレンタル ----------------*/
	}else{
        /*--------- DB書き込み ---------*/
        $result = deleteDb($date,$name,$nameKn,$mail,$studio,$timeSql,$member,$type);
	}		
	
    
// }catch(PDOException $e){
// 	die('エラー:' . $e->getMessage());
// }
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php get_header(); ?>
<main class="Page__main Reserv__main">
	<section id="first-view1">
		<?php 
			// if ($reservedOk) {
				echo '<h2 class="Section__title">BOOKING IS DONE<span>予約完了</span></h2>
		<p>削除しました。</p>
		<a href="/index.php" class="AX__Button Center">TOPに戻る<i class="fa fa-angle-right"></i></a>';
		// 	}else{
		// 		echo '<h2 class="Section__title">BOOKING IS FAILURE<span>予約失敗</span></h2>
		// <p>削除に失敗しました。<br>
		// 既に埋まっているか、レッスンが入っているため、もう一度時間をご確認の上ご予約くださいませ。</p>
		// <a href="/rentalstudio#carendar" class="AX__Button Center">スタジオ予約に戻る<i class="fa fa-angle-right"></i></a>';
		// 	}
		?>
		
	</section>
</main>
<?php get_footer(); ?>