jQuery(function(){var k="形式が正しくありません。";var g="カタカナで入力してください。";var c="半角数字で入力してください。";var f="必須項目です。";var a=false;var j=false;var i=false;var e=false;var h=false;var b=false;jQuery(".check").click(function(){if(jQuery(".check").prop("checked")==true){b=true;d()}else{b=false;d()}});d();function d(){if(a&&j&&i&&e&&h&&b){jQuery("input[name='submit']").attr("disabled",false);jQuery("input[name='submit']").css("color","#000")}else{jQuery("input[name='submit']").attr("disabled",true);jQuery("input[name='submit']").css("color","#E0E0E0");jQuery("input[name='submit']").css("background","fff")}}jQuery("input[name='date']").blur(function(){if(jQuery(this).val()==""){jQuery(this).css("background-color","#FEF4F8");jQuery(this).css("border","solid 3px #FA5858");jQuery("#err_date").html(f);a=false;d()}else{jQuery(this).css("background-color","#FaFEFF");jQuery(this).css("border","solid 1px #bdbdbd");jQuery("#err_date").html("");a=true;d()}});jQuery("input[name='name']").blur(function(){if(jQuery(this).val()==""){jQuery(this).css("background-color","#FEF4F8");jQuery(this).css("border","solid 3px #FA5858");jQuery("#err_name").html(f);j=false;d()}else{jQuery(this).css("background-color","#FaFEFF");jQuery(this).css("border","solid 1px #bdbdbd");jQuery("#err_name").html("");j=true;d()}});jQuery("input[name='nameKn']").blur(function(){if(jQuery(this).val()==""){jQuery(this).css("background-color","#FEF4F8");jQuery(this).css("border","solid 3px #FA5858");jQuery(this).css("margin-bottom","unset");jQuery("#err_nameKn").html(f);i=false;d()}else{jQuery(this).css("background-color","#FaFEFF");jQuery(this).css("border","solid 1px #bdbdbd");jQuery("#err_nameKn").html("");i=true;d()}});jQuery("input[name='nameKn']").on("blur",function(l){if(!jQuery(this).val().match(/^[ァ-ヶー　]*$/)){jQuery(this).css("background-color","#FEF4F8");jQuery(this).css("border","solid 3px #FA5858");jQuery(this).css("margin-bottom","unset");jQuery("#err_nameKn").html(g);i=false;d()}});jQuery("input[name='email']").on("blur",function(l){if(jQuery(this).val().length<=0){jQuery(this).css("background-color","#FEF4F8");jQuery(this).css("border","solid 3px #FA5858");jQuery("#err_email").html(f);e=false;d()}else{if(!jQuery(this).val().match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/)){jQuery(this).css("background-color","#FEF4F8");jQuery(this).css("border","solid 3px #FA5858");jQuery("#err_email").html(k);e=false;d()}else{jQuery(this).css("background-color","#FaFEFF");jQuery(this).css("border","solid 1px #bdbdbd");jQuery("#err_email").html("");e=true;d()}}});jQuery("textarea[name='message']").blur(function(){if(jQuery(this).val()==""){jQuery(this).css("background-color","#FEF4F8");jQuery(this).css("border","solid 3px #f44336");jQuery("#err_message").html(f);h=false;d()}else{jQuery(this).css("background-color","#FaFEFF");jQuery(this).css("border","solid 1px #bdbdbd");jQuery("#err_message").html("");h=true;d()}})});