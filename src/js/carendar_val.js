jQuery(window).load(function() {
  console.log(jQuery("input[name='cdate']").val() );
  if (jQuery("input[name='cdate']").val() == "" || jQuery("input[name='cdate']").val() == "XXXX-XX-XX") {
    var flgType;
    var flgDate;
    var flgOpentime;
    var flgClosetime;
    var flgName;
    var flgNameKn;
    var flgAddress;
    var flgTel;
    var flgMail;
    var flgFile;
    var check;
  }else{
    var flgType = true;
    var flgDate = true;
    var flgOpentime = true;
    var flgClosetime = true;
    var flgName = true;
    var flgNameKn = true;
    var flgAddress = true;
    var flgTel = true;
    var flgMail = true;
    var check = true;
  }
// });
// jQuery(function(){
  // エラーメッセージ
  var ERROR_FORMAT = "形式が正しくありません。";
  var ERROR_FORMATDATE = "XXXX-XX-XXの形式で入力してください。";
  var ERROR_FORMATTIME = "XX:XXの形式で入力してください。";
  var ERROR_FORMATKN = "カタカナで入力してください。";
  var ERROR_FORMATTEL = "半角数字で入力してください。";
  var ERROR_REQUIRE = "必須項目です。";
  var ERROR_SAMETIME = "同じ時間は入力できません。";
  var ERROR_EARLYTIME = "0:00~9:00は入力できません。";
  var ERROR_CLOSELIMIT = "一般レンタルは23:00までです。";
  var ERROR_NOTTIME = "正しく入力してください";
  var ERROR_NORESERV = "予約は1ヶ月以内です。";
  var ERROR_NOPAST = "過去は予約出来ません。";

  // 入力可能フラグ
  // var flgType = false;
  // var flgDate = false;
  // var flgOpentime = false;
  // var flgClosetime = false;
  // var flgName = false;
  // var flgNameKn = false;
  // var flgAddress = false;
  // var flgTel = false;
  // var flgMail = false;
  // var flgFile = false;
  // var check = false;
  
  
  
  //チェック入ってたらtrue
  jQuery('.rentalcheck').click(function() {
    if(jQuery('.rentalcheck').prop('checked') == true){
      check = true;
      enableSubmit();
      console.log(flgType);
      console.log(flgDate);
      console.log(flgOpentime);
      console.log(flgClosetime);
      console.log(flgName);
      console.log(flgNameKn);
      console.log(flgAddress);
      console.log(flgTel);
      console.log(flgMail);
      console.log(flgFile);
    }else{
      check = false;
      enableSubmit();
    }
  });
  //チェック入ってたらtrue
  // jQuery('.beginnercheck').click(function() {
  //   if(jQuery('.beginnercheck').prop('checked') == true){
  //     check = true;
  //     enableSubmit();

  //   }else{
  //     check = false;
  //     enableSubmit();
  //   }
  // });
  enableSubmit();
  
  function enableSubmit(){
    if (jQuery("input[name='ctype']:checked").val() == 1 ) {
      if (flgClosetime && flgOpentime && flgDate && flgName && flgNameKn && flgAddress && flgTel && flgMail && check) {//全部trueなら
        jQuery("input[name='csubmit']").attr("disabled",false);//#submitを活性に
        jQuery("input[name='csubmit']").css("color", "#fff");
        jQuery("input[name='csubmit']").css("border-color", "#fff");
      } else {
        jQuery("input[name='csubmit']").attr("disabled",true);//#submitを非活性に
        jQuery("input[name='csubmit']").css("color", "#666");
        jQuery("input[name='csubmit']").css("border-color", "#666");
      }
      if(jQuery('.beginnercheck').prop('checked') == true){
        if (flgClosetime && flgOpentime && flgDate && flgName && flgNameKn && flgAddress && flgTel && flgMail && check && flgFile) {//全部trueなら
          jQuery("input[name='csubmit']").attr("disabled",false);//#submitを活性に
          jQuery("input[name='csubmit']").css("color", "#fff");
          jQuery("input[name='csubmit']").css("border-color", "#fff");
        } else {
          jQuery("input[name='csubmit']").attr("disabled",true);//#submitを非活性に
          jQuery("input[name='csubmit']").css("color", "#666");
          jQuery("input[name='csubmit']").css("border-color", "#666");
        }
      }
    }else{
      if (flgDate && flgName && flgNameKn && flgAddress && flgTel && flgMail && check) {//全部trueなら
        jQuery("input[name='csubmit']").attr("disabled",false);//#submitを活性に
        jQuery("input[name='csubmit']").css("color", "#fff");
        jQuery("input[name='csubmit']").css("border-color", "#fff");
      } else {
        jQuery("input[name='csubmit']").attr("disabled",true);//#submitを非活性に
        jQuery("input[name='csubmit']").css("color", "#666");
        jQuery("input[name='csubmit']").css("border-color", "#666");
      }
    }
    
  }

  //日付チェック
  jQuery("input[name='cdate']").blur(function(){
    if(jQuery(this).val() == ""){
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_cdate").html(ERROR_REQUIRE);//"必須項目です"を表示
      flgDate = false;
      enableSubmit();
    }else{
      jQuery(this).css("background-color", "#FaFEFF");
      jQuery(this).css("border", "solid 1px #bdbdbd");
      jQuery("#err_cdate").html("");//"必須項目です"を非表示
      flgDate = true;
      enableSubmit();
    }
  });
  //日付正規表現
  jQuery("input[name='cdate']").on("blur",function(event) {
      if (!jQuery(this).val().match(/\d{4}-\d{2}-\d{2}/)) {
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery(this).css("margin-bottom", "unset");
      jQuery("#err_cdate").html(ERROR_FORMATDATE);//"XXXX-XX-XXの形式で入力してください。"
      flgDate = false;
      enableSubmit();
    }
  });
  //過去判定 2ヶ月後チェック
  jQuery("input[name='cdate']").blur(function(){
    
    // Dateインスタンスを生成
    const d = new Date();
    var toDoubleDigits = function(num) {
      num += "";
      if (num.length === 1) {
        num = "0" + num;
      }
     return num;     
    };
    var zeroMonth = toDoubleDigits(d.getMonth() + 1);
    // var zeroTwoMonth = toDoubleDigits(d.getMonth() + 4);
    var zeroDate = toDoubleDigits(d.getDate());
    var nowMonth = d.getFullYear() + "-" + zeroMonth +  "-" + zeroDate;
    // var plusTwoMonth = d.getFullYear() + "-" + zeroTwoMonth +  "-" + zeroDate;
      
    var value = jQuery("input[name='cdate']").val();
    var plusTwovalue = jQuery("input[name='cdate']").val() + (d.getMonth() + 4);

    if (value < nowMonth ) {
        jQuery(this).css("background-color", "#FEF4F8");
        jQuery(this).css("border", "solid 3px #FA5858");
        jQuery("#err_cdate").html(ERROR_NOPAST);//"過去へは予約出来ません。"を表示
        flgDate = false;
        enableSubmit();
      }else{
        jQuery(this).css("background-color", "#FaFEFF");
        jQuery(this).css("border", "solid 1px #bdbdbd");
        jQuery("#err_opentime").html("");//"必須項目です"を非表示
        flgOpentime = true;
        enableSubmit();
    }
  });
  //開始時間チェック
  jQuery("input[name='opentimeNormal']").blur(function(){
    if(jQuery(this).val() == ""){
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_opentime").html(ERROR_REQUIRE);//"必須項目です"を表示
      flgOpentime = false;
      enableSubmit();
    }else if(jQuery(this).val() == jQuery("input[name='closetimeNormal']").val()){
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_opentime").html(ERROR_SAMETIME);//"同じ時間は入力できません。"を表示
      flgOpentime = false;
      enableSubmit();
    }else if(jQuery(this).val().substr(0,2) == "00" || 
      jQuery(this).val().substr(0,2) == "01" || 
      jQuery(this).val().substr(0,2) == "02" || 
      jQuery(this).val().substr(0,2) == "03" || 
      jQuery(this).val().substr(0,2) == "04" || 
      jQuery(this).val().substr(0,2) == "05" || 
      jQuery(this).val().substr(0,2) == "06" || 
      jQuery(this).val().substr(0,2) == "07" || 
      jQuery(this).val().substr(0,2) == "08" || 
      jQuery(this).val().substr(0,2) == "09"){
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_opentime").html(ERROR_EARLYTIME);//"7:00 ~ 9:00は入力できません。"を表示
      flgOpentime = false;
      enableSubmit();
    }else{
      jQuery(this).css("background-color", "#FaFEFF");
      jQuery(this).css("border", "solid 1px #bdbdbd");
      jQuery("#err_opentime").html("");//"必須項目です"を非表示
      flgOpentime = true;
      enableSubmit();
    }
  });
  //時間正規表現
  jQuery("input[name='opentimeNormal']").on("blur",function(event) {
      if (!jQuery(this).val().match(/\d{2}:\d{2}/)) {
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery(this).css("margin-bottom", "unset");
      jQuery("#err_opentime").html(ERROR_FORMATTIME);//"カタカナで入力してください。"
      flgOpentime = false;
      enableSubmit();
    }
  });
  //終了時間チェック
  jQuery("input[name='closetimeNormal']").blur(function(){
    if(jQuery(this).val() == ""){
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_closetime").html(ERROR_REQUIRE);//"必須項目です"を表示
      flgClosetime = false;
      enableSubmit();
    }else if(jQuery(this).val() == jQuery("input[name='opentimeNormal']").val()){
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_closetime").html(ERROR_SAMETIME);//"同じ時間は入力できません。"を表示
      flgClosetime = false;
      enableSubmit();
    }else if(jQuery(this).val() < jQuery("input[name='opentimeNormal']").val()){
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_closetime").html(ERROR_NOTTIME);//"同じ時間は入力できません。"を表示
      flgClosetime = false;
      enableSubmit();
    }else if(jQuery(this).val().substr(0,2) == "00" || 
      jQuery(this).val().substr(0,2) == "01" || 
      jQuery(this).val().substr(0,2) == "02" || 
      jQuery(this).val().substr(0,2) == "03" || 
      jQuery(this).val().substr(0,2) == "04" || 
      jQuery(this).val().substr(0,2) == "05" || 
      jQuery(this).val().substr(0,2) == "06" || 
      jQuery(this).val().substr(0,2) == "07" || 
      jQuery(this).val().substr(0,2) == "08" || 
      jQuery(this).val().substr(0,2) == "09"){
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_closetime").html(ERROR_EARLYTIME);//"7:00 ~ 9:00は入力できません。"を表示
      flgOpentime = false;
      enableSubmit();
    }else if(jQuery(this).val() == "23:30"){
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_closetime").html(ERROR_CLOSELIMIT);//"一般レンタルは23:00までです。"を表示

    }else{
      jQuery(this).css("background-color", "#FaFEFF");
      jQuery(this).css("border", "solid 1px #bdbdbd");
      jQuery("#err_closetime").html("");//"必須項目です"を非表示
      flgClosetime = true;
      enableSubmit();
    }
  });
  //時間正規表現
  jQuery("input[name='closetimeNormal']").on("blur",function(event) {
      if (!jQuery(this).val().match(/\d{2}:\d{2}/)) {
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery(this).css("margin-bottom", "unset");
      jQuery("#err_opentime").html(ERROR_FORMATTIME);//"カタカナで入力してください。"
      flgClosetime = false;
      enableSubmit();
    }
  });
  //終了時間非活性
  jQuery("#time1").blur(function(){
    if (jQuery('.check').prop('checked') == true) {
      jQuery("#time2").prop('disabled', true);
      jQuery("#time2").css('background', '#666');
      jQuery("#time2").css("border", "none");
      jQuery("#err_closetime").html("");//"必須項目です"を非表示
      flgClosetime = true;
    }else if (jQuery(this).val() == "23:00") {
      jQuery("#time2").prop('disabled', true);
      jQuery("#time2").css('background', '#666');
      jQuery("#time2").css("border", "none");
      jQuery("#err_closetime").html("");//"必須項目です"を非表示
      flgClosetime = true;
    }else{
      jQuery("#time2").prop('disabled', false);
      jQuery("#time2").css('background', '#fff');

    }
  });
  //3時間パック終了時間非活性
  jQuery('.check').click(function() {
    if(jQuery('.check').prop('checked') == true){
      jQuery("#time2").prop('disabled', true);
      jQuery("#time2").css('background', '#666');
      jQuery('.stc_text').removeClass('invisible');
      jQuery("#time2").css("border", "none");
      jQuery("#err_closetime").html("");//"必須項目です"を非表示
      flgClosetime = true;
    }else if(jQuery('#time1').val() == "23:00"){
      jQuery("#time2").prop('disabled', true);
      jQuery("#time2").css('background', '#666');
      jQuery('.stc_text').removeClass('invisible');
      jQuery("#time2").css("border", "none");
      jQuery("#err_closetime").html("");//"必須項目です"を非表示
      flgClosetime = true;
    }else{
      jQuery("#time2").prop('disabled', false);
      jQuery("#time2").css('background', '#fff');
      jQuery('.stc_text').addClass('invisible');
    }
  });

  //名前チェック
  jQuery("input[name='cname']").blur(function(){
    if(jQuery(this).val() == ""){
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_cname").html(ERROR_REQUIRE);//"必須項目です"を表示
      flgName = false;
      enableSubmit();
    }else{
      jQuery(this).css("background-color", "#FaFEFF");
      jQuery(this).css("border", "solid 1px #bdbdbd");
      jQuery("#err_cname").html("");//"必須項目です"を非表示
      flgName = true;
      enableSubmit();
    }
  });

  //フリガナチェック
  jQuery("input[name='cnameKn']").blur(function(){
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
  jQuery("input[name='cnameKn']").on("blur",function(event) {
      if (!jQuery(this).val().match(/^[ァ-ヶー　]*$/)) {
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery(this).css("margin-bottom", "unset");
      jQuery("#err_nameKn").html(ERROR_FORMATKN);//"カタカナで入力してください。"
      flgNameKn = false;
      enableSubmit();
    }
  });

  //住所チェック
  jQuery("input[name='caddress']").blur(function(){
    if(jQuery(this).val() == ""){
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_caddress").html(ERROR_REQUIRE);//"必須項目です"を表示
      flgAddress = false;
      enableSubmit();
    }else{
      jQuery(this).css("background-color", "#FaFEFF");
      jQuery(this).css("border", "solid 1px #bdbdbd");
      jQuery("#err_caddress").html("");//"必須項目です"を非表示
      flgAddress = true;
      enableSubmit();
    }
  });
  
  //電話番号正規表現
  jQuery("input[name='ctel']").on("blur",function(event) {
    if (jQuery(this).val().length <= 0) {//nameが0文字以下なら
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_ctel").html(ERROR_REQUIRE);//"必須項目です"を表示
      flgTel = false;
      enableSubmit();
    } else if (!jQuery(this).val().match( /^\d{7,12}$/ )) {
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_ctel").html(ERROR_FORMAT);//"形式が正しくありません"
      flgTel = false;
      enableSubmit();
    } else {
      jQuery(this).css("background-color", "#FaFEFF");
      jQuery(this).css("border", "solid 1px #bdbdbd");
      jQuery("#err_ctel").html("");
      flgTel = true;
      enableSubmit();
    }
  });

  //メールアドレス正規表現
  jQuery("input[name='cemail']").on("blur",function(event) {
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
  //人数正規表現
  jQuery("input[name='cmember']").on("blur",function(event) {
    if (jQuery(this).val().length <= 0) {//nameが0文字以下なら
      jQuery(this).css("background-color", "#FEF4F8");
      jQuery(this).css("border", "solid 3px #FA5858");
      jQuery("#err_cmember").html(ERROR_REQUIRE);//"必須項目です"を表示
      flgmember = false;
      enableSubmit();
    }else {
      jQuery(this).css("background-color", "#FaFEFF");
      jQuery(this).css("border", "solid 1px #bdbdbd");
      jQuery("#err_cmember").html("");
      flgmember = true;
      enableSubmit();
    }
  });
  //添付ファイルチェック
  jQuery('.rentalcheck').click(function() {
    // console.log(flgFile);
    if(jQuery('.beginnercheck').prop('checked') == true){
      // jQuery('.rentalcheck').blur(function(){
        if(jQuery("input[name='file']").val() == ""){
          jQuery("#err_cfile").html(ERROR_REQUIRE);//"必須項目です"を表示
          flgFile = false;
          console.log(flgFile);
          enableSubmit();
        }else{
          jQuery("#err_cfile").html("");//"必須項目です"を非表示
          flgFile = true;
          console.log(flgFile);
          enableSubmit();
        }
  }
});
});


