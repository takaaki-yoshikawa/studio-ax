jQuery(function(){
  // エラーメッセージ
  var ERROR_FORMAT = "形式が正しくありません。";
  var ERROR_FORMATKN = "カタカナで入力してください。";
  var ERROR_FORMATTEL = "半角数字で入力してください。";
  var ERROR_REQUIRE = "必須項目です。";

  // 入力可能フラグ
  var flgName = false;
  var flgNameKn = false;
  var flgMail = false;
  var flgMessage = false;
  var check = false;
  
  //チェック入ってたらtrue
  jQuery('.check').click(function() {
    if(jQuery('.check').prop('checked') == true){
      check = true;
      enableSubmit();
    }else{
      check = false;
      enableSubmit();
    }
  });
  enableSubmit();


  function enableSubmit(){
    if (flgName && flgNameKn && flgMail && flgMessage && check) {//全部trueなら
      jQuery("input[name='submit']").attr("disabled",false);//#submitを活性に
      jQuery("input[name='submit']").css("color", "#000");
    } else {
      jQuery("input[name='submit']").attr("disabled",true);//#submitを非活性に
      jQuery("input[name='submit']").css("color", "#E0E0E0");
      jQuery("input[name='submit']").css("background", "fff");
    }
  }

  //名前チェック
  jQuery("input[name='nameKj']").blur(function(){
    if(jQuery(this).val() == ""){
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_name").html(ERROR_REQUIRE);//"必須項目です"を表示
      flgName = false;
      enableSubmit();
    }else{
      jQuery(this).css("background-color", "#FaFEFF");
      jQuery(this).css("border", "solid 1px #bdbdbd");
      jQuery("#err_name").html("");//"必須項目です"を非表示
      flgName = true;
      enableSubmit();
    }
  });

  //フリガナチェック
  jQuery("input[name='nameKn']").blur(function(){
    if(jQuery(this).val() == ""){
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery(this).css("margin-bottom", "unset");
      jQuery("#err_nameKn").html(ERROR_REQUIRE);//"必須項目です"を表示
      flgNameKn = false;
      enableSubmit();
    }else{
      jQuery(this).css("background-color", "#FaFEFF");
      jQuery(this).css("border", "solid 1px #bdbdbd");
      jQuery("#err_nameKn").html("");//"必須項目です"を非表示
      flgNameKn = true;
      enableSubmit();
    }
  });

  //セイカタカナ正規表現
  jQuery("input[name='nameKn']").on("blur",function(event) {
      if (!jQuery(this).val().match(/^[ァ-ヶー　]*$/)) {
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery(this).css("margin-bottom", "unset");
      jQuery("#err_nameKn").html(ERROR_FORMATKN);//"カタカナで入力してください。"
      flgNameKn = false;
      enableSubmit();
    }
  });
  //メールアドレス正規表現
  jQuery("input[name='email']").on("blur",function(event) {
    if (jQuery(this).val().length <= 0) {//nameが0文字以下なら
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_email").html(ERROR_REQUIRE);//"必須項目です"を表示
      flgMail = false;
      enableSubmit();
    } else if (!jQuery(this).val().match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/)) {
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_email").html(ERROR_FORMAT);//"形式が正しくありません"
      flgMail = false;
      enableSubmit();
    } else {
      jQuery(this).css("background-color", "#FaFEFF");
      jQuery(this).css("border", "solid 1px #bdbdbd");
      jQuery("#err_email").html("");
      flgMail = true;
      enableSubmit();
    }
  });

  //本文チェック
  jQuery("textarea[name='message']").blur(function(){
    if(jQuery(this).val() == ""){
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #f44336");
      jQuery("#err_message").html(ERROR_REQUIRE);//"必須項目です"を表示
      flgMessage = false;
      enableSubmit();
    }else{
      jQuery(this).css("background-color", "#FaFEFF");
      jQuery(this).css("border", "solid 1px #bdbdbd");
      jQuery("#err_message").html("");//"必須項目です"を非表示
      flgMessage = true;
      enableSubmit();
    };
  });
});


