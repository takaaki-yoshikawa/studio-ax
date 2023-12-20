//ナビボタン  
jQuery(function(){   
  jQuery('.drbtn').on('click', function () {
    jQuery(this).toggleClass('action');
    jQuery('.drbtn').toggleClass('action');
    jQuery('.Header__nav__ulayer').toggleClass('action');
    jQuery('.Header__nav__mobile').toggleClass('action');
  });
});
//first-viewフェードイン
jQuery(window).on('load',function(){
    jQuery('#body').animate({
        opacity: 1
    },500,'easeInSine',function(){
        jQuery('#header').animate({
            opacity: 1
        },100,'easeInSine',function(){
            jQuery('#second-view2').animate({
                opacity: 1
            });
        });
    });
});
jQuery(function(){
//スマホ用 触れてる間だけhover
jQuery('a, input[type="button"], input[type="submit"], button, .touch-hover,.Scaleup,figure')
  .on('touchstart', function(){
    jQuery(this).addClass('hover');
}).on('touchend', function(){
    jQuery(this).removeClass('hover');
});

// ページ内リンクへのスクロール
jQuery('a[href^=#]'+'#wplink').click(function() {
    // スクロールの速度
    var speed = 1000; // ミリ秒
    // アンカーの値取得
    var href= jQuery(this).attr("href");
    // 移動先を取得
    var target = jQuery(href == "#" || href == "" ? 'html' : href);
    // 移動先を数値で取得
    var position = target.offset().top;
    // スムーススクロール
    jQuery('body,html').animate({scrollTop:position}, speed, "easeInExpo");
    return false;
});
});
//firstviewの高さ固定
jQuery(function(){
  if(!navigator.userAgent.match(/(iPad)/)){
    console.log("ipadじゃないよ");
    //#first-viewに画像の高さを設定
    var wheight=jQuery(window).height();
    var height= wheight - 20 - jQuery("#header").height();

    jQuery("#first-view1").css("height",wheight+"px")

        //ウィンドウサイズが変わるたびに#first-viewを変更
    jQuery(window).resize(function(){
      var height=jQuery(window).height();
      jQuery("#first-view1").css("height",wheight+"px")
    });    
  }else{
    console.log("ipadだよ");
    //#first-viewに画像の高さを設定
    var wheight=jQuery(window).height();
    var height= wheight - 20 - jQuery("#header").height();;

    jQuery(".first-view-top").css("height",wheight+"px")

        //ウィンドウサイズが変わるたびに#first-viewを変更
    jQuery(window).resize(function(){
      var height=jQuery(window).height();
      jQuery(".first-view-top").css("height",wheight+"px")
    });  
  }
  //iPad 横向きCSS
  if(navigator.userAgent.match(/(iPad)/)){
    if(window.innerHeight < window.innerWidth) {
        jQuery("section").css("margin-bottom","-5px");
        jQuery(".Header__nav__1").css("margin-right","11%");
        jQuery(".Header__nav ul li").css("margin-right","15px");
        jQuery(".AboutSlideshow__head__item").css("width","950px");
        jQuery(".Career__year").css("font-size","18px");
        jQuery(".Career__box__wrap p").css("font-size","14px");
        jQuery(".AboutSlideshow__nav__prev").css("left","-510px");
        jQuery(".AboutSlideshow__nav__next").css("right","-510px");
        jQuery(".Top__img__1").css("background-position-x","35%");
        
        jQuery(".Blog__wrap").css("padding-left","150px");
        jQuery(".Blog__wrap").css("padding-right","150px");
        jQuery(".Related__post ol li").css("width","34%");
        jQuery(".Single__body .AX__Button").css("width","32%");  
        
        jQuery(".Members__under__item>div:nth-child(1)").css("margin-left","15%");  
        jQuery(".Members__under__item>div:nth-child(1), .Members__under__item>div:nth-child(2)").css("margin-right","unset");  

        jQuery(".Footer__ul__1_1").css("margin-left","8%");
        jQuery(".Footer__ul__1_2").css("margin-right","8%");
        jQuery(".Footer__ul__2_1").css("margin-left","160px");
        jQuery(".Footer__ul__2_2").css("margin-right","160px");
    }   
  }
  //iPad 横向きCSS
  if(navigator.userAgent.match(/(iPhone)/)){
    if(window.innerHeight < window.innerWidth) {
        jQuery(".Top__img__1").css("background","url(/wp-content/themes/studio-ax/src/images/top/20thPC.jpg)");
        jQuery(".Top__img__1").css("background-size","cover");
    }   
  }

});    

jQuery(function(){
  jQuery('.faqs dd').hide();
  jQuery('.faqs dt').hover(function(){jQuery(this).addClass('hover')},function(){jQuery(this).removeClass('hover')}).click(function(){
  jQuery(this).next().slideToggle('normal');
  }); 
});
//footerでナビ非表示
jQuery(window).on('load',function(){
  // fadein-left
  jQuery(window).scroll(function (){
    jQuery('.Nav__button__off').each(function(){
      var POS = jQuery(this).offset().top;
      var scroll = jQuery(window).scrollTop();
      var windowHeight = jQuery(window).height();

      if (scroll > POS - windowHeight){
        jQuery('.Header__nav__button,.Header__nav__button_top ').css({
          'display':'none',
          'transition': 'all .3s ease-in'
        });
      } else {
        jQuery('.Header__nav__button,.Header__nav__button_top').css({
          'display':'block',
          'transition': 'all .3s ease-in',
        });
      }
    });
  }); 
});
// fade-in
jQuery(window).on('load',function(){
  // fadein-left
  jQuery(window).scroll(function (){
    jQuery('.fade-in').each(function(){
      var POS = jQuery(this).offset().top;
      var scroll = jQuery(window).scrollTop();
      var windowHeight = jQuery(window).height();

      if (scroll > POS - windowHeight + 300){
        jQuery(this).css({
          'opacity':'1',
          'transition': 'all .3s ease-in'
        });
      } else {
        jQuery(this).css({
          'opacity':'0',
          'transition': 'all .3s ease-in'
        });
      }
    });
  }); 
});
// ==============================
// Slideshow
// ==============================
jQuery(function(){  
jQuery('.Slideshow').each(function() {
  
  var $slideshow  = jQuery(this),
    $slideGroup = $slideshow.find('.Slideshow__head'),
    $slides     = $slideGroup.find('.Slideshow__head__item'),
    $nav        = jQuery('#Slideshow__nav'),
    $indicator  = jQuery('#Slideshow__indicator'),

    slideCount    = $slides.length,
    indicatorHTML = '',
    currentIndex  = 0,
    duration    = 1200,
    easing      = 'easeInOutCubic',
    interval    = 7500,
    timer;

// HTML要素の配置、生成、挿入(インジケーターの生成)
// ---------------------------
  $slides.each(function(i) {
    if (i === 0){
      jQuery(this).css({left: 100*i + '%'});//i=0ならSlideshow__head__itemにleft: 0%;
      // indicatorHTML += '<a class="active" href="#">' + (i+1) + '</a>';
    } else {
      jQuery(this).css({left: 100 * i + '%'});//i>0ならSlideshow__head__itemにleft: ~~%;
      // indicatorHTML += '<a href="#">' + (i+1) + '</a>';
    }
    
  });
  //indicatorにコンテンツを挿入
  // $indicator.html(indicatorHTML);

// Function
// ---------------------------
  function goToSlide(index) {
    $slideGroup.animate({ left: -100*index + '%' },duration, easing);
    currentIndex = index;
    updateNav();
  }

  function updateNav() {
    var $navPrev = jQuery('#prev'),
      $navNext = jQuery('#next');

    //　もし最初のスライドならPrevを無効 
    if (currentIndex === 0) {
      $navPrev.addClass('disabled');
    } else {
      $navPrev. removeClass('disabled');
    }

    //　もし最後のスライドならNextを無効
    if (currentIndex === slideCount-1) {
      $navNext.addClass('disabled');
    } else {
      $navNext.removeClass('disabled');
    }

    // 現在のスライドのインジケーターを無効
    $indicator.find('a').removeClass('active')
      .eq(currentIndex).addClass('active');
  }

// Events
// ---------------------------
  // navがクリックされたら該当するスライドを表示
  $nav.on('click', 'a', function(event) {
    event.preventDefault();
    if (jQuery(this).hasClass('Slideshow__nav__prev')) {
      goToSlide(currentIndex - 1);
    } else {
      goToSlide(currentIndex + 1);
    }
  });

  // インジケーターがクリックされたら該当するスライドを表示
  $indicator.on('click', 'a', function(event) {
    event.preventDefault();
    if (!jQuery(this).hasClass('active')) {
      goToSlide(jQuery(this).index());
    }
  });
});
});
// ==============================
// About Slideshow
// ==============================
jQuery(function(){  
jQuery('.AboutSlideshow').each(function() {
  
  var $slideshow  = jQuery(this),
    $slideGroup = $slideshow.find('.AboutSlideshow__head'),
    $slides     = $slideGroup.find('.AboutSlideshow__head__item'),
    $nav        = jQuery('#AboutSlideshow__nav'),
    $indicator  = jQuery('#AboutSlideshow__indicator'),

    slideCount    = $slides.length,
    indicatorHTML = '',
    currentIndex  = 0,
    duration    = 1200,
    easing      = 'easeInOutCubic',
    interval    = 7500,
    timer;

// HTML要素の配置、生成、挿入(インジケーターの生成)
// ---------------------------
  $slides.each(function(i) {
    if (i === 0){
      jQuery(this).css({left: 100*i + '%'});//i=0ならSlideshow__head__itemにleft: 0%;
      // indicatorHTML += '<a class="active" href="#">' + (i+1) + '</a>';
    } else {
      jQuery(this).css({left: 100 * i + '%'});//i>0ならSlideshow__head__itemにleft: ~~%;
      // indicatorHTML += '<a href="#">' + (i+1) + '</a>';
    }
    
  });
  //indicatorにコンテンツを挿入
  // $indicator.html(indicatorHTML);

// Function
// ---------------------------
  function goToSlide(index) {
    $slideGroup.animate({ left: -100*index + '%' },duration, easing);
    currentIndex = index;
    updateNav();
  }

  function updateNav() {
    var $navPrev = jQuery('#Aboutprev'),
      $navNext = jQuery('#Aboutnext');

    //　もし最初のスライドならPrevを無効 
    if (currentIndex === 0) {
      $navPrev.addClass('disabled');
    } else {
      $navPrev. removeClass('disabled');
    }

    //　もし最後のスライドならNextを無効
    if (currentIndex === slideCount-1) {
      $navNext.addClass('disabled');
    } else {
      $navNext.removeClass('disabled');
    }

    // 現在のスライドのインジケーターを無効
    $indicator.find('a').removeClass('active')
      .eq(currentIndex).addClass('active');
  }

// Events
// ---------------------------
  // navがクリックされたら該当するスライドを表示
  $nav.on('click', 'a', function(event) {
    event.preventDefault();
    if (jQuery(this).hasClass('AboutSlideshow__nav__prev')) {
      goToSlide(currentIndex - 1);
    } else {
      goToSlide(currentIndex + 1);
    }
  });

  // インジケーターがクリックされたら該当するスライドを表示
  $indicator.on('click', 'a', function(event) {
    event.preventDefault();
    if (!jQuery(this).hasClass('active')) {
      goToSlide(jQuery(this).index());
    }
  });
});
});
