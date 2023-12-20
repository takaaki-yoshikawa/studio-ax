<?php

	require "reserv_function.php";
try {

	/*-----------------------------------
	--------------- 値取得 ---------------
	-----------------------------------*/
	$pinnumber = $_POST['pinnumber'];
	
    // 送信ボタンが押されたら
    if (isset($_POST["csubmit"])) {
        // 送信ボタンが押された時に動作する処理をここに記述する
        if ($insertDb == null) {
        	# code...
        
        // 日本語をメールで送る場合のおまじない
        mb_language("ja");
        mb_internal_encoding("UTF-8");

        
        // 件名を変数subjectに格納
        $subject = "[Studio AX]新規予約通知";

        // メール本文を変数bodyに格納
        //管理者宛
        $body = <<< EOM


新規予約がありました。
以下の予約内容を、メールにて確認させていただきました。



EOM;

        
        // 送信元のメールアドレスを変数fromEmailに格納
        $fromEmail = "Reservation@studio-ax.com";

        // 送信元の名前を変数fromNameに格納
        $fromName = "ホームページからのスタジオ予約";

        // ヘッダ情報を変数headerに格納する      
        $header = "From: " .mb_encode_mimeheader($fromName) ."<{$fromEmail}>";
        
        $status = "false";
        $status2 = "false";
        
        // メール送信を行う	
        if(mb_send_mail($mail,$subject2 ,$body2)){
            $status2 = "true";
        }else{
            $status2 = "false";
        }
        // サンクスページに画面遷移させる
        // header("Location: /reserv_db?status=$status");        
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
			if ($reservedOk) {
				echo '<h2 class="Section__title">BOOKING IS DONE<span>予約完了</span></h2>
		<p>'.$name.'様 ご予約を受け付けました。<br>
		予約内容確認メールを送信しましたのでご確認くださいませ。</p>
		<a href="/index.php" class="AX__Button Center">TOPに戻る<i class="fa fa-angle-right"></i></a>';
			}else{
				echo '<h2 class="Section__title">BOOKING IS FAILURE<span>予約失敗</span></h2>
		<p>予約に失敗しました。<br>
		既に埋まっているか、レッスンが入っているため、もう一度時間をご確認の上ご予約くださいませ。</p>
		<a href="/rentalstudio#carendar" class="AX__Button Center">スタジオ予約に戻る<i class="fa fa-angle-right"></i></a>';
			}
		?>
		
	</section>
</main>
<?php get_footer(); ?>