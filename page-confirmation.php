<?php 
    require "reserv_function.php";
    define( "FILE_DIR", realpath(dirname(__FILE__)));

    $ctype = "";//一般orレンタル
    $name = "";//名前
    $nameKn = "";//フリガナ
    $mail = "";//メルアド
    $date = "";//利用日
    $opentime = "";//開始時間
    $member = "";//利用人数
    $studioPrice = 0;//スタジオ料金
    $opentimeNormal = "";//一般開始時間 
    $closetimeNormal = "";//一般終了時間
    $opentimeEvent = "";//イベント開始時間
    $eventstudio = "";//イベント利用スタジオ
    $opentimeH = "";
    $useTimeH = "";//利用時間
    $useTimeM = "";//利用分
    $notTime = true;//利用分
    $closetimePack = "";//Cパック終了時間用変数 
    $checkbox = "";//利用人数
    $begginercheck = "";
    if (isset($_POST["pack"])) {
        $checkbox = $_POST["pack"];
    }
    if (isset($_POST["begginercheck"])) {
        $begginercheck = $_POST["begginercheck"];
    }
    $date = $_POST["cdate"];//利用日
    $file = $_FILES['file']['name'];
    $clean = array();
    $extension = true;
    $studioPrice = "";
    $memberPrice = "";
    $tortalPrice = "";
    $holiday = holidayPrice($date);
    $datetime = new DateTime($date);
    $week = array('日','月','火','水','木','金','土');
    $w = (int)$datetime->format('w');
    
    // ファイルのアップロード
    if( !empty($_FILES['file']['tmp_name']) ) {
        if(preg_match('/\.png$|\.jpg$|\.jpeg$/i', $file)) {
            $uniq_file_name = date("YmdHis") . "_" . $file;
            $upload_res = move_uploaded_file( $_FILES['file']['tmp_name'], FILE_DIR."/src/images/card/".$uniq_file_name);
            if( $upload_res !== true ) {
                $extension = false;
            } else {
                $clean['file'] = $_FILES['file']['name'];
                $extension = true;
            }
        }else{
            $extension = false;

        }
    } 

    // フォームのボタンが押されたら
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $ctype = $_POST["ctype"];//一般orレンタル
        $name = $_POST["cname"];//名前
        $nameKn = $_POST["cnameKn"];//フリガナ
        $mail = $_POST["cemail"];//メルアド
        $tel = $_POST["ctel"];//電話番号
        $address = $_POST["caddress"];//住所
        
        $studioname = $_POST["studioSelect"];//一般利用スタジオ
        $eventstudio = $_POST["eventstudio"];//イベント利用スタジオ
        $member = $_POST["cmember"];//利用人数
        
        if ($ctype == 1) {//一般レンタルなら
            
            $opentimeNormal = $_POST["opentimeNormal"];//開始時間
            $closetimeAdvance = "";//終了時間30分用変数
            
            /*---- 一般レンタル ----*/
            if ($opentimeNormal != "23:00" && !isset($_POST["pack"])) {
                $closetimeNormal = $_POST["closetimeNormal"];//終了時間
                if ($opentimeNormal > $closetimeNormal) {
                    $notTime = false;
                }
                
            }
            $closetimeM = substr($closetimeNormal, -2);

            /*---- 終了時間30分なら繰り上げ ----*/
            if ($closetimeM == "30") {
                $closetimeAdvance = date("H:i", strtotime("+30 minute",strtotime($closetimeNormal)));
                $useTimeH = $closetimeAdvance - $opentimeNormal;//利用時間
            }else{
                $useTimeH = $closetimeNormal - $opentimeNormal;//利用時間
            }            
            $opentimeH = substr($opentimeNormal, 0, 2);
            $closetimeH = substr($closetimeNormal, 0, 2);
        }else{//イベントレンタルなら
            $opentimeEvent = $_POST["opentimeEvent"];//開始時間
            $opentime = substr($opentimeEvent, 0, 2);
        }  
    }
    $memberPrice = $member * 200;
    
    //1時間半の場合2時間料金にする
    $closetimeMinute = ToMin($closetimeNormal);
    $opentimeMinute = ToMin($opentimeNormal);
    $useMinute = $closetimeMinute - $opentimeMinute;
    if ($useMinute % 60 == 0) {
        $useMinute = $useMinute;
    }elseif ($useMinute % 90 == 0 || $useMinute == 30) {    
        if (substr($opentimeNormal, -2, 2) == "00") {
            $useMinute += 30; 
        }
    }
    $open = substr($opentimeNormal, 0, 2);
    $close = substr($closetimeNormal, 0, 2);
    
    if ($ctype == 1) {//一般利用料金
        
        if ($studioname == "c" && $checkbox == "1") {// スタジオC3時間パックなら
            if ($week[$w] == "土" || $week[$w] == "日" || !$holiday){
                $totalPrice = 4500;
            }else{
                $totalPrice = studioPriceCpack($opentimeH);
            }     
            $studioPrice = floor(($studioPrice/100))*100;
            $studioPrice = $totalPrice;
            $memberPrice = 0;
            
        }elseif ($opentimeH == "23") {// 深夜レンタルなら
            $studioPrice += studioPriceNormal($studioname,$open);

            $studioPrice = floor(($studioPrice/100))*100;
            $totalPrice = $studioPrice + $memberPrice;  
        }elseif ($week[$w] == "土" || $week[$w] == "日" || !$holiday) {// 土日祝日なら
            $useTime = $useMinute / 60;
            for ($i=0; $i < $useTime; $i++) { 
                $studioPrice += studioPriceHoliday($studioname,$open);
                $open++;
            }
            $totalPrice = $studioPrice + $memberPrice;

        }elseif ($opentimeH != "23") {// 深夜レンタルじゃなければ
            $useTime = $useMinute / 60;
            for ($i=0; $i < $useTime; $i++) { 
                $studioPrice += studioPriceNormal($studioname,$open);
                
                $open++;
            }
            $totalPrice = $studioPrice + $memberPrice;

        }else{
            $totalPrice = $studioPrice + $memberPrice;
        }
    }elseif($ctype == 2){//イベント利用料金
      $studioPrice = studioPriceEvent($eventstudio,$opentime);
      $totalPrice = $studioPrice;
    }

?>
<?php get_header(); ?>
<!-- Header -->
<section class="Carendar Confilm" style="position: static;">
    <h2 class="Section__title">Studio Reservation<span>- レンタルスタジオ予約 -</span></h2>
        <?php if (!$extension): ?>
                <p class="extension_err">画像ファイルの拡張子が正しくありません。<br>
                jpg,jpeg,pngのいずれかを選択してください。</p>
                <input class="extension_input AX__Input" type="button" value="内容を修正する" onclick="history.back(-1)">
        <?php elseif(!$notTime):?>
                <p class="extension_err">入力された利用時間が正しくありません。</p>
                <input class="extension_input AX__Input" type="button" value="内容を修正する" onclick="history.back(-1)">
        <?php else:?>
                
        <form class="Carendar__form Confirm" action='/reserv_db?ctype=<?php echo $ctype ?>&amp;studio=<?php echo $studioname ?>&amp;eventstudio=<?php echo $eventstudio ?>&amp;totalPrice=<?php echo $totalPrice ?>&amp;begginercheck=<?php echo $begginercheck ?>' method="post" enctype="multipart/form-data">
        <h3>予約内容確認</h3>
        <p>予約内容はこちらで宜しいでしょうか？<br>よろしければ「送信する」ボタンを押して下さい。</p>
        <div class="Confirm__form__body">
            <dl class="Crd__fm__dl first">
                <dt class="Crd__fm__dt">レンタル方法</dt>
                <dd class="Crd__fm__dd">
                    <div>
                        <?php 
                            if ($ctype == 1) {
                                echo '<input id="radio1" class="Input__radio" type="radio" name="ctype" value="1" disabled checked>一般レンタル';
                            }else{
                                echo '<input id="radio1" class="Input__radio" type="radio" name="ctype" value="1" disabled>一般レンタル';
                            }
                        ?>
                    </div>
                    <div>
                        <?php 
                            if ($ctype == 2) {
                                echo '<input id="radio2" class="Input__radio" type="radio" name="ctype" value="2" disabled checked>イベントレンタル';
                            }else{
                                echo '<input id="radio2" class="Input__radio" type="radio" name="ctype" value="2" disabled>イベントレンタル';
                            }
                        ?>
                    </div>
                </dd>
            </dl> 
            
    <?php 
        if($ctype == 2){
          echo '<dl class="Crd__fm__dl first choice">
              <dt class="Crd__fm__dt">スタジオ選択
              </dt>
              <dd class="Crd__fm__dd">';
          switch ($eventstudio) {
            case '1':
                echo '<div class="Radio__div stselect">
                <input id="radio1" class="Input__radio" type="radio" name="eventstudio" value="1" disabled checked>St.1
                </div>
                <div class="Radio__div">
                <input id="radio2" class="Input__radio" type="radio" name="eventstudio" value="2" disabled>St.2
                </div>
                <div class="Radio__div">
                <input id="radio3" class="Input__radio" type="radio" name="eventstudio" value="12" disabled>St.1&2
                </div>
                <div class="Radio__div">
                <input id="radio4" class="Input__radio" type="radio" name="eventstudio" value="ab" disabled>St.AB
                </div>
                <div class="Radio__div">
                <input id="radio5" class="Input__radio" type="radio" name="eventstudio" value="abc" disabled>St.AB&C
                </div>';
            break;
            case '2':
                echo '<div class="Radio__div stselect">
                <input id="radio1" class="Input__radio" type="radio" name="eventstudio" value="1" disabled>St.1
                </div>
                <div class="Radio__div">
                <input id="radio2" class="Input__radio" type="radio" name="eventstudio" value="2" disabled checked>St.2
                </div>
                <div class="Radio__div">
                <input id="radio3" class="Input__radio" type="radio" name="eventstudio" value="12" disabled>St.1&2
                </div>
                <div class="Radio__div">
                <input id="radio4" class="Input__radio" type="radio" name="eventstudio" value="ab" disabled>St.AB
                </div>
                <div class="Radio__div">
                <input id="radio5" class="Input__radio" type="radio" name="eventstudio" value="abc" disabled>St.AB&C
                </div>';
            break;
            case '12':
            echo '<div class="Radio__div stselect">
                <input id="radio1" class="Input__radio" type="radio" name="eventstudio" value="1" disabled>St.1
                </div>
                <div class="Radio__div">
                <input id="radio2" class="Input__radio" type="radio" name="eventstudio" value="2" disabled>St.2
                </div>
                <div class="Radio__div">
                <input id="radio3" class="Input__radio" type="radio" name="eventstudio" value="12" disabled checked>St.1&2
                </div>
                <div class="Radio__div">
                <input id="radio4" class="Input__radio" type="radio" name="eventstudio" value="ab" disabled>St.AB
                </div>
                <div class="Radio__div">
                <input id="radio5" class="Input__radio" type="radio" name="eventstudio" value="abc" disabled>St.AB&C
                </div>';
            break;
            case 'ab':
                echo '<div class="Radio__div stselect">
                <input id="radio1" class="Input__radio" type="radio" name="eventstudio" value="1" disabled>St.1
                </div>
                <div class="Radio__div">
                <input id="radio2" class="Input__radio" type="radio" name="eventstudio" value="2" disabled>St.2
                </div>
                <div class="Radio__div">
                <input id="radio3" class="Input__radio" type="radio" name="eventstudio" value="12" disabled>St.1&2
                </div>
                <div class="Radio__div">
                <input id="radio4" class="Input__radio" type="radio" name="eventstudio" value="ab" disabled checked>St.AB
                </div>
                <div class="Radio__div">
                <input id="radio5" class="Input__radio" type="radio" name="eventstudio" value="abc" disabled>St.AB&C
                </div>';
            break;
            case 'abc':
                echo '<div class="Radio__div stselect">
                <input id="radio1" class="Input__radio" type="radio" name="eventstudio" value="1" disabled>St.1
                </div>
                <div class="Radio__div">
                <input id="radio2" class="Input__radio" type="radio" name="eventstudio" value="2" disabled>St.2
                </div>
                <div class="Radio__div">
                <input id="radio3" class="Input__radio" type="radio" name="eventstudio" value="12" disabled>St.1&2
                </div>
                <div class="Radio__div">
                <input id="radio4" class="Input__radio" type="radio" name="eventstudio" value="ab" disabled>St.AB
                </div>
                <div class="Radio__div">
                <input id="radio5" class="Input__radio" type="radio" name="eventstudio" value="abc" disabled checked>St.AB&C</div>';
            break;
        }
            echo '</dd></dl>';
        }
    ?> 
        <dl class="Crd__fm__dl">
            <dt class="Crd__fm__dt">ご希望日*
                <div class="err" id="err_date"></div>
            </dt>
            <dd class="Crd__fm__dd">
                <input class="Contact__form__name" type="date" name="cdate" value="<?php echo $date; ?>" readonly>
            </dd>
        </dl>   
        <?php 
            if($ctype == 1){
              echo "<dl class='Crd__fm__dl first'>
                        <dt class='Crd__fm__dt'>スタジオ選択
                            <div class='err' id='err_email'></div>
                         </dt>
                         <dd class='Crd__fm__dd'>
                            <input class='Contact__form__name' type='text' name='studio' value='St.".$studioname."' readonly>
                        </dd>
                     </dl>";
            }
        ?>
        <dl class="Crd__fm__dl">
            <dt class="Crd__fm__dt">ご利用時間</dt>
            <dd class="Crd__fm__dd selectWrap">
                <?php
                    if ($ctype == 1) {
                       if ($studioname == "c" && $checkbox == "1") {
                          $closetimeCpack = date("H:i", strtotime("+3 hour",strtotime($opentimeNormal)));
                          echo '<div id="tr1">
                          <input type="time" name="opentimeNormal" step="1800" value="'.$opentimeNormal.'" readonly> ~ <input type="time" name="closetimeNormal" step="1800" value="'.$closetimeCpack.'" readonly>
                          </div>';
                        }else{
                          echo '<div id="tr1">
                          <input type="time" name="opentimeNormal" step="1800" value="'.$opentimeNormal.'" readonly> ~ <input type="time" name="closetimeNormal" step="1800" value="'.$closetimeNormal.'" readonly>
                          </div>';
                        }
                    }else {
                        echo '<input type="text" name="copentime" value="'.$opentimeEvent.'"" readonly>';
                    }
                ?>
            </dd>
        </dl>
        <dl class="Crd__fm__dl">
            <dt class="Crd__fm__dt">お名前*
                <div class="err" id="err_cname"></div>
            </dt>
            <dd class="Crd__fm__dd">
                <input class="Contact__form__name" type="text" name="cname" value="<?php echo $name; ?>" readonly>
            </dd>
        </dl>
        <dl class="Crd__fm__dl">
            <dt class="Crd__fm__dt">フリガナ
                <div class="err" id="err_nameKn"></div>
            </dt>
            <dd class="Crd__fm__dd">
                <input class="Contact__form__name" type="text" name="cnameKn" value="<?php echo $nameKn; ?>" readonly>
            </dd>
        </dl>
        <dl class="Crd__fm__dl">
            <dt class="Crd__fm__dt">住所*
                <div class="err" id="err_caddress"></div>
            </dt>
            <dd class="Crd__fm__dd">
                <input class="Contact__form__name" type="text" name="caddress" value="<?php echo $address; ?>" readonly>
            </dd>
        </dl>
        <dl class="Crd__fm__dl">
            <dt class="Crd__fm__dt">電話番号
                <div class="err" id="err_ctel"></div>
            </dt>
            <dd class="Crd__fm__dd">
                <input class="Contact__form__mail" type="number" name="ctel" value="<?php echo $tel; ?>" readonly>
            </dd>
        </dl>  
        <dl class="Crd__fm__dl">
            <dt class="Crd__fm__dt">メールアドレス*
                <div class="err" id="err_email"></div>
            </dt>
            <dd class="Crd__fm__dd">
                <input class="Contact__form__mail" type="text" name="cemail" value="<?php echo $mail; ?>" readonly>
            </dd>
        </dl>
        <dl class="Crd__fm__dl">
            <dt class="Crd__fm__dt">ご利用人数
                <div class="err" id="err_member"></div>
            </dt>
            <dd class="Crd__fm__dd">
                <input class="Contact__form__mail" type="text" name="cmember" value="<?php echo $member; ?>" readonly>
            </dd>
        </dl>  
        <dl class="Crd__fm__dl" id="packcheck">  
            <dt class="Crd__fm__dt">ご本人様確認
                <div class="err" id="err_date"></div>
            </dt>
            <dd class="Crd__fm__dd checkbox">
                <?php 
                
                    if ($begginercheck == 1) {
                        echo '<input class="Contact__form__name beginnercheck" type="checkbox" name="begginercheck" value="1" checked disabled>初めての方はチェックしてください。';
                    }else{
                        echo '<input class="Contact__form__name beginnercheck" type="checkbox" name="begginercheck" value="0" disabled>初めての方はチェックしてください。';
                    }
                ?>
            </dd>
        </dl> 
        <?php 
            if ($begginercheck == 1) {
                echo '<dl class="Crd__fm__dl">  
                <dt class="Crd__fm__dt">身分証の添付
                </dt>
                <dd class="Crd__fm__dd checkbox file">';
                echo '<p><img src="/wp-content/themes/studio-ax/src/images/card/'.$uniq_file_name.'"></p>';         
                echo '</dd></dl>';
            }            
        ?>
        <?php 
            if( !empty($clean['file']) ){
                echo '<input type="hidden" name="file" value="'.$uniq_file_name.'">';
            }
        ?>
        <div class="totalprice">
            <p>ご利用料金は<?php echo $totalPrice;?>円です。</p>  
            <p>スタジオ料金 <?php echo $studioPrice; ?>円(税込)</p>
            <p>設備料 <?php echo $memberPrice; ?>円(<?php echo $member; ?>名様)</p>
        </div>  
            <div class="Confirm__form__button">
                <input class="AX__Input" type="button" value="内容を修正する" onclick="history.back(-1)">
                <button class="AX__Input" type="submit" name="csubmit">送信する</button>
            </div>
        </div>
    </form>
<?php endif;?>
</section>
<?php get_footer(); ?>