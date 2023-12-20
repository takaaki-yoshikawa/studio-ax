<?php

	require "reserv_function.php";

	/*-----------------------------------
	--------------- 値取得 ---------------
	-----------------------------------*/
	$changepinOk = false;
	$date = date("Y-m-d");
	$pincode = $_POST['pincode'];//開始時間

	/*-----------------------------------
	------- 予約の有無確認&DB書き込み ------
	-----------------------------------*/
	var_dump($date);
	var_dump($pincode);
	$changepinOk = updatePin($date,$pincode);
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php get_header(); ?>
<main class="Page__main Reserv__main">
	<section id="first-view1">
		<?php 
		if ($changepinOk) {
				echo '<h2 class="Section__title">BOOKING IS DONE<span>暗証番号変更完了</span></h2>
						<p>暗証番号変更が完了しました。</p>
						<a href="/changepin" class="AX__Button Center">暗証番号設定に戻る<i class="fa fa-angle-right"></i></a>';
			
		}else{
				echo '<h2 class="Section__title">BOOKING IS FAILURE<span>暗証番号変更失敗</span></h2>
					<p>暗証番号変更に失敗しました。</p>
					<a href="/changepin" class="AX__Button Center">暗証番号設定に戻る<i class="fa fa-angle-right"></i></a>';
		}			
		?>
	</section>
</main>
<?php get_footer(); ?>