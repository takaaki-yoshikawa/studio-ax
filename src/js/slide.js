jQuery(function(){


//（１）ページの概念・初期ページを設定
var page=0;

//（２）イメージの数を最後のページ数として変数化
var lastPage =parseInt(jQuery("#slide div").length-1);

//（３）最初に全部のイメージを一旦非表示にします
     jQuery("#slide div").css("display","none");

//（４）初期ページを表示
          jQuery("#slide div").eq(page).css("display","block");

//（５）ページ切換用、自作関数作成
function changePage(){
                         jQuery("#slide div").fadeOut(400);
                         jQuery("#slide div").eq(page).fadeIn(400);
};

//（６）～秒間隔でイメージ切換の発火設定
var Timer;
function startTimer(){
Timer =setInterval(function(){
          if(page === lastPage){
                         page = 0;
                         changePage();
               }else{
                         page ++;
                         changePage();
          };
     },400);
}
//（７）～秒間隔でイメージ切換の停止設定
function stopTimer(){
clearInterval(Timer);
}

//（８）タイマースタート
startTimer();

/*オプションを足す場合はここへ記載*/

});
jQuery(function(){


//（１）ページの概念・初期ページを設定
var page=0;

//（２）イメージの数を最後のページ数として変数化
var lastPage =parseInt($("#slide-mobile img").length-1);

//（３）最初に全部のイメージを一旦非表示にします
     jQuery("#slide-mobile img").css("display","none");

//（４）初期ページを表示
          jQuery("#slide-mobile img").eq(page).css("display","block");

//（５）ページ切換用、自作関数作成
function changePage(){
                         jQuery("#slide-mobile img").fadeOut(400);
                         jQuery("#slide-mobile img").eq(page).fadeIn(400);
};

//（６）～秒間隔でイメージ切換の発火設定
var Timer;
function startTimer(){
Timer =setInterval(function(){
          if(page === lastPage){
                         page = 0;
                         changePage();
               }else{
                         page ++;
                         changePage();
          };
     },400);
}
//（７）～秒間隔でイメージ切換の停止設定
function stopTimer(){
clearInterval(Timer);
}

//（８）タイマースタート
startTimer();

/*オプションを足す場合はここへ記載*/

});