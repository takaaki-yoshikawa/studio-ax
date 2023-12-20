<?php get_header(); ?>
<main class="Page__main Blog__main">
  <section id="first-view1">
    <img class="Pc__on nonenone" src="/wp-content/themes/studio-ax/src/images/about/about_bg.png">
    <img class="Tablet__on" src="/wp-content/themes/studio-ax/src/images/about/about_bg_tb.png">
    <img class="Mobile__on" src="/wp-content/themes/studio-ax/src/images/about/about_sp_bg.png">
    <div class="Section__wrap Firstview__wrap">
      <div class="Firstview__body">
        <div class="Section__title Blog__Utitle">
          <h1 class="Section__title__h2 Section__title__vw">BLOG</h1>
          <div class="Section__title__mirror Section__title__vw">BLOG</div>
        </div>
          <p class="Firstview__body__text Pc__on">
            Studio AXブログでは、Workshopや新しくスタートする<br>&nbsp;&nbsp;&nbsp;&nbsp;New Lesson情報、期間限定のキャンペーン情報などを発<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;信しております。記事についてご不明な点などはお気軽に<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/contact">お問い合わせ</a>ください。
          </p>
          <p class="Firstview__body__text Mobile__on">
            Studio AXブログでは、Workshopや新しくスタートするNew Lesson情報、期間限定のキャンペーン情報などを発信しております。記事についてご不明な点などはお気軽に<a href="/contact">お問い合わせ</a>ください。
          </p>        
      </div>
    </div>
  </section>
  <section id="blog" class="Blog">
    <div class="Blog__wrap">
      <?php
      $hogehogehoge = get_posts( array(
              'category' => '2,3,7,8', // 取得したいカテゴリーの ID を入れる
              'posts_per_page' => 12
          ));

      foreach( $hogehogehoge as $post ):
        setup_postdata( $post );

            $cat = get_the_category(); // カテゴリーを配列で取得し
            $cat = $cat[0]; // カテゴリー名（カテゴリースラッグ）を指定し
            $cat_slug = $cat -> slug; // $cat_slug に入れる
            ?>

            <?php get_template_part( 'gaiyou', 'medium' ); ?>

            <?php
        endforeach;
        wp_reset_postdata();
        ?>
      </div>
      <div class="Pagenation">
        <?php
        if ($post->max_num_pages > 1) {
          echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%/',
            'current' => max(1, $paged),
            'total' => $post->max_num_pages,
            'prev_text' => __('«'),
            'next_text' => __('»'),
          ));
        }
        ?>
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

