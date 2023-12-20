<?php 
    ini_set('display_errors', 1);
    $type = $_POST["type"];
    if(isset($_POST["type"]) && $_POST["type"]=="1"){
        $type = "資料請求を希望";
    }else if(isset($_POST["type"]) && $_POST["type"]=="2"){
        $type = "資料請求無し";
    }
    $nameKj = $_POST["nameKj"];
    $nameKn = $_POST["nameKn"];
    $postalcode = $_POST["zip11"];
    $address = $_POST["addr11"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $title = $_POST["subject"];
    $message = $_POST["message"];
    $spam = false;

    // 日本語をメールで送る場合のおまじない
    mb_language("ja");
    mb_internal_encoding("UTF-8");

    // メール本文を変数bodyに格納
    $body = <<< EOM

ホームページよりお問い合わせが送信されました。

===================================================
【 タイトル 】
{$title}

【 資料請求の有無 】 
{$type}

【 お客様のお名前 】 
{$nameKj}

【 メールアドレス 】 
{$email}

【 電話番号 】 
{$tel}

【 郵便番号 】
{$postalcode}

【 住所 】
{$address}

【 内容 】 
{$message}
===================================================

内容を確認のうえ、回答してください。

EOM;
  
        // 送信元のメールアドレスを変数fromEmailに格納
        $fromEmail = "contact@studio-ax.com";

        // 送信元の名前を変数fromNameに格納
        $fromName = "Studio AX ホームページからのお問い合わせ";

        // ヘッダ情報を変数headerに格納する      
        $header = "From: " .mb_encode_mimeheader($fromName) ."<{$fromEmail}>";
        
        $status = "false";
        //axkanri@studio-ax.co.jp
        $mailTo = "axkanri@studio-ax.co.jp";
        
        if ($title == "資料請求の依頼" ||
            $title == "新規入会についてのお問い合わせ" ||
            $title == "レンタルスタジオについてのお問い合わせ" ||
            $title == "その他お問合せ") {
            $spam = true;
        }else{
            $spam = false;
        }
        if ($spam) {
           // メール送信を行う
            if(mb_send_mail($mailTo,$type ,$body,$header)){
                $status = "true";
            }else{
                $status = "false";
            }
        }else{
            $status = "false";
        }
        
?>
<?php get_header(); ?>
<div class="Ignition__block Ignition__contact1" id="fade-top-1"></div>
<main class="Page__main">
<section id="first-view1">
    <img class="Pc__on nonenone" src="/wp-content/themes/studio-ax/src/images/about/about_bg.png">
    <img class="Tablet__on" src="/wp-content/themes/studio-ax/src/images/about/about_bg_tb.png">
    <img class="Mobile__on" src="/wp-content/themes/studio-ax/src/images/about/about_sp_bg.png">
    <div class="Section__wrap Firstview__wrap Max__width">
      <div class="Firstview__body">
        <div class="Section__title">
          <h2 class="Section__title__h2 Section__title__vw">CONTACT</h2>
          <div class="Section__title__mirror About__title Section__title__vw">CONTACT</div>
        </div>
        <div class="Firstview__body__text">
          <p class="Pc__on">
            弊社にご関心をお持ちいただきまして、ありがとうございます。<br>&nbsp;&nbsp;入会のご相談、スタジオレンタルなどお気軽にお問い合わせくだ<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;さい。また、スタジオAXでは、法人様向けのインストラクター委<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;託を承っております。 詳細に関しましては、下記フォームよりお問<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;合わせ下さい。
          </p>
          <p class="Mobile__on">
            弊社にご関心をお持ちいただきまして、ありがとうございます。入会のご相談、スタジオレンタルなどお気軽にお問い合わせください。また、スタジオAXでは、法人様向けのインストラクター委託を承っております。 詳細に関しましては、下記フォームよりお問合わせ下さい。
          </p> 
        </div>
      </div>
    </div>
  </section>
    <!-- Header -->
	<section class="Mail__article">
    <?php if($status=="true"){
        echo '
                <p>《メッセージが送信されました》</p>
                <p class="Mail__Message">この度はお問い合わせメールをお送り頂き、ありがとうございます。後ほど、担当者よりご連絡をさせて頂きますので、今しばらくお待ち下さいますよう宜しくお願い申し上げます。なお、暫く経っても弊社スタッフより返答がない場合は、お客様によりご入力頂いたメールアドレスに誤りがある場合がございます。その際は、お手数ですが再度送信頂くか、お電話にてご連絡いただけますと幸いです。</p>';
    }else{
        echo '<p class="Mail__Message">送信に失敗しました。</p>';
    }?>
    </section>
</main>
		<!-- Contact -->
<?php get_footer(); ?>