<?php get_header(); ?>
<main class="Page__main Contact__main">
  <section id="first-view1">
   <img class="Pc__on nonenone" src="/wp-content/themes/studio-ax/src/images/contact/contact_hd.png">
   <img class="Tablet__on" src="/wp-content/themes/studio-ax/src/images/contact/contact_hd_tb.png">
   <img class="Mobile__on" src="/wp-content/themes/studio-ax/src/images/contact/contact_sp_bg.png">
    <div class="Section__wrap Firstview__wrap">
      <div class="Firstview__body">
        <div class="Section__title">
          <h1 class="Section__title__h2 Section__title__vw">CONTACT</h1>
          <div class="Section__title__mirror Section__title__vw">CONTACT</div>
        </div>
          <p class="Firstview__body__text Pc__on">
            弊社にご関心をお持ちいただきまして、ありがとうございます。<br>&nbsp;&nbsp;入会のご相談、スタジオレンタルなどお気軽にお問い合わせくだ<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;さい。また、スタジオAXでは、法人様向けのインストラクター委<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;託を承っております。 詳細に関しましては、下記フォームよりお問<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;合わせ下さい。
          </p>
          <p class="Firstview__body__text Mobile__on">
            弊社にご関心をお持ちいただきまして、ありがとうございます。入会のご相談、スタジオレンタルなどお気軽にお問い合わせください。また、スタジオAXでは、法人様向けのインストラクター委託を承っております。 詳細に関しましては、下記フォームよりお問合わせ下さい。
          </p>        
      </div>      
    </div>
  </section>
  <section id="contact" class="ContactAccess">
    <!-- <img class="Max__img Pc__on" src="/wp-content/themes/studio-ax/src/images/contact/contact_bg.png"> -->
    <div class="ContactAccess__wrap">
      <section class="Contact section-area" id="Contact">
        <h2 style="display: none;">CONTACT</h2>
        <div class="Contact__wrap">
          <form class="Contact__form" action="/sending" method="post" onSubmit="return check()">
            <dl class="Contact__form__dl">
              <dt class="Contact__form__dt">資料請求
              </dt>
              <dd class="Contact__form__dd">
                <div>
                  <input class="Input__radio" type="radio" name="type" value="1">する
                </div>
                <div>
                  <input class="Input__radio" type="radio" name="type" checked value="2">しない
                </div>
              </dd>
            </dl>
            <dl class="Contact__form__dl">
              <dt class="Contact__form__dt">お名前*
                <div class="err" id="err_name"></div>
              </dt>
              <dd class="Contact__form__dd">
                <input class="Contact__form__name" type="text" name="nameKj" placeholder="山田　太郎">
              </dd>
            </dl>
            <dl class="Contact__form__dl">
              <dt class="Contact__form__dt">フリガナ
                <div class="err" id="err_nameKn"></div>
              </dt>
              <dd class="Contact__form__dd">
                <input class="Contact__form__name" type="text" name="nameKn" placeholder="山田　太郎">
              </dd>
            </dl>
            <dl class="Contact__form__dl">
              <dt class="Contact__form__dt">郵便番号
                <div class="err address">ハイフン不要</div>
              </dt>
              <dd class="Contact__form__dd">
                <input type="text" name="zip11" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');">
              </dd>
            </dl>
            <dl class="Contact__form__dl">
              <dt class="Contact__form__dt">住所
                <div class="err" id="err_name"></div>
              </dt>
              <dd class="Contact__form__dd">
                <input type="text" name="addr11" size="60">
              </dd>
            </dl>
            <dl class="Contact__form__dl">
              <dt class="Contact__form__dt">メールアドレス*
                <div class="err" id="err_email"></div>
              </dt>
              <dd class="Contact__form__dd">
                <input class="Contact__form__mail" type="text" name="email" placeholder="example@example.com">
              </dd>
            </dl>
            <dl class="Contact__form__dl">
              <dt class="Contact__form__dt">電話番号
                <div class="err" id="err_email"></div>
              </dt>
              <dd class="Contact__form__dd">
                <input class="Form__input" type="text" name="tel">
              </dd>
            </dl>
            <dl class="Contact__form__dl">
              <dt class="Contact__form__dt">タイトル</dt>
              <dd class="Contact__form__dd selectWrap">
                <select name="subject" class="Contact__title__select">
                  <option selected>資料請求の依頼</option>
                  <option>新規入会についてのお問い合わせ</option>
                  <option>レンタルスタジオについてのお問い合わせ</option>
                  <option>その他お問合せ</option>
                </select>
              </dd>
            </dl>
            <dl class="Contact__form__dl">
              <dt class="Contact__form__dt">メッセージ
                <div class="err lasterr" id="err_message"></div>
              </dt>
              <dd class="Contact__form__dd">
                <textarea class="Contact__form__message" name="message" placeholder="ここにメッセージを入力してください。"></textarea>
              </dd>
            </dl>  
            <div class="Form__privacy">
              <h4>個人情報の取扱いについて</h4>
              <p>皆様からお預かりした個人情報は、採用に関する情報を確実に提供する為に使用し、この目的以外には使用いたしません。また、漏洩、紛失、改竄、不正使用等のない様適切に管理いたします。<br>
                お問合せにあたり、<a href="/privacy" target="_brank">個人情報の取り扱い</a>を必ずご確認ください。</p>
              <input class="check" type="checkbox" name="privacy" value="true">個人情報の取扱いについて同意する
            </div>       
            <input class="Contact__form__send section-botton" name="submit" type="submit" value="SEND">
          </form>
          <!-- <script type="text/javascript">
            jQuery(function(){
              console.log(jQuery("input[name='name']"));
              console.log(jQuery("input[name='nameKn']"));
            });
          </script> -->
        </div>
      </section>
      <section id="access" class="Access">
        <div class="Section__title">
          <h1 class="Section__title__h2">ACCESS</h1>
          <div class="Section__title__mirror About__title">ACCESS</div>
        </div>
        <p class="schooltitle">- 心斎橋校 -</p>
        <div class="Googlemap" id="map_canvas1">
          <article>
              <h2 id="ttl01">フロント,St.3</h2>
              <p>この文章はダミーです。…</p>
          </article>
          <article>
              <h2 id="ttl02">St.1,St.2</h2>
              <p>この文章はダミーです。…</p>
          </article>
          <article>
              <h2 id="ttl03">St.A,St.B,St.C</h2>
              <p>この文章はダミーです。…</p>
          </article>
        </div>
        <div class="Access__wrap">
          <div class="Access__item">
            <div class="Access__item__left">
              <h2>Front, St.3</h2>
              <p>〒542-0086<br>大阪市中央区西心斎橋1-12-8<br>大美建築ビル3F</p>
            </div>
            <div class="Access__item__right">
              <img src="/wp-content/themes/studio-ax/src/images/contact/frontst3.JPG">
            </div>
          </div>
          <hr>
          <div class="Access__item">
            <div class="Access__item__left">
              <h2>St.1, St.2</h2>
              <p>〒542-0086<br>大阪市中央区西心斎橋1-10-33<br>ミューズビル3F,4F</p>
            </div>
            <div class="Access__item__right">
              <img src="/wp-content/themes/studio-ax/src/images/contact/st12.JPG">
            </div>
          </div>
          <div class="Access__item">
            <div class="Access__item__left">
              <p>St.2へは、St.1の中階段を経由します。</p>
            </div>
            <div class="Access__item__right">
              <img src="/wp-content/themes/studio-ax/src/images/contact/floor.svg">
            </div>
          </div>
          <hr>
          <div class="Access__item">
            <div class="Access__item__left">
              <h2>St.A, St.B, St.C</h2>
              <p>〒542-0086<br>大阪市中央区西心斎橋1-9-16<br>大京心斎橋第2ビル4F</p>
            </div>
            <div class="Access__item__right">
              <img src="/wp-content/themes/studio-ax/src/images/contact/stabc.JPG">
            </div>
          </div>
          <hr>
          <div class="Access__Tel">
            <a href="tel:06-6241-8303">TEL:06-6241-8303</a>
            <a href="tel:06-6241-8303">FAX:06-6241-8304</a>
          </div>
            <a class="Access__mail" href="#">axkanri@studio-ax.co.jp</a>
        </div>
        <p class="schooltitle">- 天王寺MIO校 -</p>
        <div class="Googlemap" id="map_canvas2"></div>
        <div class="Access__wrap">
          <div class="Access__item school">
            <p>〒543-0055<br>大阪市天王寺区悲田院町10-39<br>天王寺MIO PKビル1F(NHC内)</p>
          </div>
          <div class="Access__Tel school">
            <a href="tel:06-6773-8861">TEL:06-6773-8861</a>
          </div>
        </div>

         <p class="schooltitle">- PRONO緑地公園校 -</p>
        <div class="Googlemap" id="map_canvas3"></div>
        <div class="Access__wrap">
          <div class="Access__item school">
            <p>〒565-0851<br>大阪府吹田市千里山西4-37-5</p>
          </div>
          <div class="Access__Tel school">
            <a href="tel:06-6330-5000">TEL:06-6330-5000</a>
          </div>
        </div>
      </section>
    </div>
  </section>
</main>
<div class="Fix_reserv Header__nav__button">
  <a href="/contact">
    <img src="/wp-content/themes/studio-ax/src/images/common/axcontacton.svg">
  </a>
</div>
<div class="Fix_reserv_2 Header__nav__button">
  <a href="/rentalstudio">
    <img src="/wp-content/themes/studio-ax/src/images/common/axreserv.svg">
  </a>
</div>
<div class="Fix_reserv_3 Header__nav__button_top">
  <a href="https://studio-ax.hacomono.jp/" target="_blank">
    <img src="/wp-content/themes/studio-ax/src/images/common/axlesson.svg">
  </a>
</div>
<?php get_footer(); ?>
