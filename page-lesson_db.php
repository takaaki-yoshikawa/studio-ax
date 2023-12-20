<?php

	require "reserv_function.php";

// try {

	/*-----------------------------------
	--------------- 値取得 ---------------
	-----------------------------------*/
	$reservedOk = "";
	$ResurrectionOk = "";
	$date = $_POST['date'];//日付
	$opentime = $_POST['opentime'];//開始時間
	$studio = $_POST['studio'];//添付画像
	/*-----------------------------------
	------- 予約の有無確認&DB書き込み ------
	-----------------------------------*/
	if ($_POST['open'] == '休講にする') {
		var_dump("休講にする");
	  $reservedOk = deleteLesson($date,$opentime,$studio);
	} else if ($_POST['release'] == '休講解除する') {
		var_dump("休講にしない");
	  $ResurrectionOk = resurrectionLesson($date,$opentime,$studio);
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
		// var_dump($reservedOk);
		// var_dump($ResurrectionOk);
		// var_dump(isset($reservedOk));
		// var_dump(isset($ResurrectionOk));
		if ($reservedOk) {
			if ($reservedOk) {
				echo '<h2 class="Section__title">BOOKING IS DONE<span>休講設定完了</span></h2>
		<p>休講設定が完了しました。</p>
		<a href="/lessondelete" class="AX__Button Center">休講設定に戻る<i class="fa fa-angle-right"></i></a>';
			}else{
				echo '<h2 class="Section__title">BOOKING IS FAILURE<span>休講設定失敗</span></h2>
		<p>予約に失敗しました。<br>
		既に休講設定済みです。</p>
		<a href="/lessondelete" class="AX__Button Center">休講設定に戻る<i class="fa fa-angle-right"></i></a>';
			}
		}elseif ($ResurrectionOk) {
			if ($ResurrectionOk) {
				echo '<h2 class="Section__title">BOOKING IS DONE<span>休講設定完了</span></h2>
		<p>休講取り消しが完了しました。</p>
		<a href="/lessondelete" class="AX__Button Center">休講設定に戻る<i class="fa fa-angle-right"></i></a>';
			}else{
				echo '<h2 class="Section__title">BOOKING IS FAILURE<span>休講設定失敗</span></h2>
		<p>休講取り消しに失敗しました。<br>
		既に休講取り消し済みです。</p>
		<a href="/lessondelete" class="AX__Button Center">休講設定に戻る<i class="fa fa-angle-right"></i></a>';
			}
		}
			
		?>
		
	</section>
</main>
<?php get_footer(); ?>