<?php 
	require "reserv_function.php";
	$reserv_id = $_GET['reservid'];
	$confirmAdmin = confirmAdmin($reserv_id);
  // var_dump($confirmAdmin[1]);
  // var_dump($confirmAdmin[2]);
  // var_dump($confirmAdmin[3]);
  // var_dump($confirmAdmin[4]);
  // var_dump($confirmAdmin[6]);
  // var_dump($confirmAdmin[7]);
  // var_dump($confirmAdmin[8]);
  $closetime = closetimeReserv($confirmAdmin[1],$confirmAdmin[2],$confirmAdmin[3],$confirmAdmin[4],$confirmAdmin[6],$confirmAdmin[7],$confirmAdmin[8]);
  $opentime = opentimeReserv($confirmAdmin[1],$confirmAdmin[2],$confirmAdmin[3],$confirmAdmin[4],$confirmAdmin[6],$confirmAdmin[7],$confirmAdmin[8]);
?>
<?php get_header(); ?>
<section class="Carendar Confilm" style="position: static;">
    <h2 class="Section__title">Reservation Confilm<span>- 予約確認 -</span></h2>
    <dl class="Crd__fm__dl first">
      <dt class="Crd__fm__dt">レンタル方法
      </dt>
      <dd class="Crd__fm__dd">
        <div>
            <?php 
                if ($confirmAdmin[8] == 1) {
                    echo '<input id="radio1" class="Input__radio" type="radio" name="ctype" value="1" disabled checked>一般レンタル';
                }
                else{
                    echo '<input id="radio1" class="Input__radio" type="radio" name="ctype" value="1" disabled>一般レンタル';
                }
            ?>
        </div>
        <div>
             <?php 
                if ($confirmAdmin[8] == 2) {
                    echo '<input id="radio2" class="Input__radio" type="radio" name="ctype" value="2" disabled checked>イベントレンタル';
                }
                else{
                    echo '<input id="radio2" class="Input__radio" type="radio" name="ctype" value="2" disabled>イベントレンタル';
                }
            ?>
        </div>
      </dd>
    </dl> 
    <?php 
        if($confirmAdmin[8] == 2){
            echo '<dl class="Crd__fm__dl first choice">
              <dt class="Crd__fm__dt">スタジオ選択
              </dt>
              <dd class="Crd__fm__dd">';
              switch ($confirmAdmin[6]) {
                  case '1':
                      echo '<div class="Radio__div">
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
                      echo '<div class="Radio__div">
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
                      echo '<div class="Radio__div">
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
                      echo '<div class="Radio__div">
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
                      echo '<div class="Radio__div">
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
                              <input id="radio5" class="Input__radio" type="radio" name="eventstudio" value="abc" disabled checked>St.AB&C
                            </div>';
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
        <input class="Contact__form__name" type="date" name="cdate" value="<?php echo $confirmAdmin[1]; ?>" readonly>
      </dd>
    </dl>   
    <dl class="Crd__fm__dl">
      <dt class="Crd__fm__dt">ご利用時間</dt>
      <dd class="Crd__fm__dd selectWrap">
        <?php
        if ($confirmAdmin[8] == 1) {
           if ($confirmAdmin[6] == "c" && $confirmAdmin[9] == "1") {//スタジオCで3時間パック利用なら
            
              $closetimeCpack = date("H:i", strtotime("+3 hour",strtotime($opentimeNormal)));
              echo '<div id="tr1">
                      <input type="time" style="width: 40%;" name="opentimeNormal" step="1800" value="'.$opentime[0].'" readonly> ~ <input type="time" style="width: 40%;" name="closetimeNormal" step="1800" value="'.$closetimeCpack.'" readonly>
                    </div>';
            }else{
              $closetime = date("H:i", strtotime("+30 minute",strtotime($closetime[0])));
              // $closetime = date("H:i", strtotime("+30 minute",strtotime($closetime)));
              echo '<div id="tr1">
                      <input type="time" style="width: 40%;" name="opentimeNormal" step="1800" value="'.$opentime[0].'" readonly> ~ <input type="time" style="width: 40%;" name="closetimeNormal" step="1800" value="'.$closetime.'" readonly>
                    </div>';
            }
        }else {
          
            echo '<input type="text" name="copentime" value="'.$opentime[0].'"" readonly>';
        }
        
        ?>
      </dd>
    </dl>
    <dl class="Crd__fm__dl">
      <dt class="Crd__fm__dt">お名前*
        <div class="err" id="err_cname"></div>
      </dt>
      <dd class="Crd__fm__dd">
        <input class="Contact__form__name" type="text" name="cname" value="<?php echo $confirmAdmin[2]; ?>" readonly>
      </dd>
    </dl>
    <dl class="Crd__fm__dl">
      <dt class="Crd__fm__dt">フリガナ
        <div class="err" id="err_nameKn"></div>
      </dt>
      <dd class="Crd__fm__dd">
        <input class="Contact__form__name" type="text" name="cnameKn" value="<?php echo $confirmAdmin[3]; ?>" readonly>
      </dd>
    </dl>
    <dl class="Crd__fm__dl">
      <dt class="Crd__fm__dt">住所*
        <div class="err" id="err_email"></div>
      </dt>
      <dd class="Crd__fm__dd">
        <input class="Contact__form__mail" type="text" name="caddress" value="<?php echo $confirmAdmin[10]; ?>" readonly>
      </dd>
    </dl>
    <dl class="Crd__fm__dl">
      <dt class="Crd__fm__dt">電話番号*
        <div class="err" id="err_email"></div>
      </dt>
      <dd class="Crd__fm__dd">
        <input class="Contact__form__mail" type="text" name="ctel" value="<?php echo $confirmAdmin[11]; ?>" readonly>
      </dd>
    </dl>
    <dl class="Crd__fm__dl">
      <dt class="Crd__fm__dt">メールアドレス*
        <div class="err" id="err_email"></div>
      </dt>
      <dd class="Crd__fm__dd">
        <input class="Contact__form__mail" type="text" name="cemail" value="<?php echo $confirmAdmin[4]; ?>" readonly>
      </dd>
    </dl>
    <dl class="Crd__fm__dl">
      <dt class="Crd__fm__dt">ご利用人数
        <div class="err" id="err_member"></div>
      </dt>
      <dd class="Crd__fm__dd">
        <input class="Contact__form__mail" type="text" name="cmember" value="<?php echo $confirmAdmin[7]; ?>" readonly>
      </dd>
    </dl> 
</section>
<section class="Carendar Change" style="position: static;">
  <form class="Carendar__form Change" action='/reserv_change?date=<?php echo $confirmAdmin[1] ?>&amp;nameKj=<?php echo $confirmAdmin[2] ?>&amp;nameKn=<?php echo $confirmAdmin[3] ?>&amp;mail=<?php echo $confirmAdmin[4] ?>&amp;studio=<?php echo $confirmAdmin[6]?>&amp;member=<?php echo $confirmAdmin[7]?>&amp;type=<?php echo $confirmAdmin[8]?>' method="post">
    <h2 class="Section__title">Reservation Change<span>- 予約変更 -</span></h2>
    <dl class="Crd__fm__dl">
      <dt class="Crd__fm__dt">ご利用時間の削除
        <div class="err" id="err_member"></div>
      </dt>
      <dd class="Crd__fm__dd checkboxarea">
        <?php 

        if ($confirmAdmin[8] == 1) {
          echo '<div><input class="alldelete" type="checkbox" name="changeall" value="all">全て削除する';
          $dopentime = strtotime($opentime[0]);
          $dclosetime = strtotime($closetime);
          $useTimeH = $dclosetime - $dopentime;//利用時間

          $diffTime = date("H:i", $useTimeH);
          $diffMinute = ToMin($diffTime);
          if ($diffMinute > 30) {
            //30分がいくつあるか
            $count = $diffMinute / 30;
            //30分の数だけ回してINSERT
            for ($i=0; $i < $count; ++$i) { 
              echo '<div><input class="timebox" type="checkbox" name="changetime[]" value='.$opentime[0].'>'.$opentime[0].'</div>';
              $opentime[0] = date("H:i", strtotime("+30 minute",strtotime($opentime[0])));
            }
          }
        }else{
          echo '<div><input type="checkbox" name="changeall" value="all">全て削除する';
        }
          
         ?>
      </dd> 
      <script type="text/javascript">
        //チェック入ってたらtrue
        jQuery('.alldelete').click(function() {
          if(jQuery('.alldelete').prop('checked') == true){
            jQuery('.timebox').prop('disabled',true);
          }else{
            jQuery('.timebox').prop('disabled',false);
          }
        });

      </script>
    </dl> 
    <button class="AX__Button" type="submit" name="dsubmit">削除する</button>
  </form>
</section>
<?php get_footer(); ?>