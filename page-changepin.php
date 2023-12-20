<?php

  require "reserv_function.php";

  $pincode = selectPin();
?>
<?php get_header(); ?>
<section class="Carendar Confilm" style="position: static; margin-bottom: 100px;">
    <h2 class="Section__title">Change Pincode<span>- 暗証番号変更 -</span></h2>
    <form class="Carendar__form" action='/changepin_db' method="post" onSubmit="return check()" enctype="multipart/form-data">
      <?php echo '<p style="text-align: center; color: #fff;margin-bottom: 20px;">現在の暗証番号：' . $pincode . "</p>";?>
      <dl class="Carendar__form__dl">
        <dt class="Carendar__form__dt">暗証番号変更</dt>
        <dd class="Carendar__form__dd flexdd" id="tr1">
          <div>
            <input type="number" name="pincode" id="pincode">
            <div class="err" id="err_opentime"></div>
          </div>
        </dd>
      </dl>
      <div class="Confirm__form__button">
        <input class="Carendar__form__send section-botton AX__Input" name="open" type="submit" value="変更">
      </div>
    </form>
</section>
<?php get_footer(); ?>