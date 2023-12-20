<?php get_header(); ?>
<section class="Carendar Confilm" style="position: static; margin-bottom: 100px;">
    <h2 class="Section__title">Lesson Deliete<span>- 休講入力 -</span></h2>
    <form class="Carendar__form" action='/lesson_db' method="post" onSubmit="return check()" enctype="multipart/form-data">
      <dl class="Crd__fm__dl">
        <dt class="Crd__fm__dt">休講レッスンの日付</dt>
        <dd class="Crd__fm__dd">
          <input type="date" name="date">
        </dd>
      </dl>
      <dl class="Crd__fm__dl">
        <dt class="Crd__fm__dt">休講開始時間</dt>
        <dd class="Crd__fm__dd flexdd" id="tr1">
          <div>
            <input type="time" name="opentime" id="time1" step="1800">
            <div class="err" id="err_opentime"></div>
          </div>
        </dd>
      </dl>
      <dl class="Crd__fm__dl">
        <dt class="Crd__fm__dt">スタジオを選択</dt>
        <dd class="Crd__fm__dd">
          <select name="studio">
            <option value="1" selected>St.1</option>
            <option value="2">St.2</option>
            <option value="3">St.3</option>
            <option value="a">St.A</option>
            <option value="b">St.B</option>
            <option value="ab">St.AB</option>
          </select>
        </dd>
      </dl>
      <div class="Confirm__form__button">
        <input class="Crd__fm__send section-botton AX__Input" name="open" type="submit" value="休講にする">
        <input class="Crd__fm__send section-botton AX__Input" name="release" type="submit" value="休講解除する">
      </div>
    </form>
</section>
<?php get_footer(); ?>