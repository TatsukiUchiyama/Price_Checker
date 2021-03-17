
$(function(){

    $('#item_new').submit(function(){

      let submit_flg = true;
      let number = $(".items").children("div").length;

      $('.err_shop').text('');
      $('.err_date').text('');
      for (let i = 0; i < number; i++) {
        $(`.err_name_${i}`).text('');
        $(`.err_kana_${i}`).text('');
        $(`.err_price_${i}`).text('');
      }

      // 店舗名
      if($('.select_box').val() === ''){
        $('.err_shop').text('店舗は必須項目です。');
        submit_flg = false;
      }

      // 購入日
      if($('.date_input').val() === ''){
        $('.err_date').text('購入日は必須項目です。');
        submit_flg = false;
      }


      for (let i = 0; i < number; i++) {
        // 品名
        if($(`#name_${i}`).val() === ''){
          $(`.err_name_${i}`).text('品名は必須項目です。');
          submit_flg = false;
        }else if($(`#name_${i}`).val().length > 20){
          $(`.err_name_${i}`).text('品名は20文字以内です。');
          submit_flg = false;
        }
      // カナ
        if($(`#kana_${i}`).val() === ''){
          $(`.err_kana_${i}`).text('品名(カナ)は必須項目です。');
          submit_flg = false;
        }else if($(`#kana_${i}`).val().length > 50){
          $(`.err_kana_${i}`).text('品名(カナ)は50文字以内です。');
          submit_flg = false;
        }

        let price_pattern = /^[0-9]+$/;
        if($(`#price_${i}`).val() === ''){
          $(`.err_price_${i}`).text('金額は必須項目です。');
          submit_flg = false;
        }else if(!$(`#price_${i}`).val().match(price_pattern)){
          $(`.err_price_${i}`).text('半角数字で入力してください。');
          submit_flg = false;
        }
      }

      return submit_flg;
  });

  $('#item_edit').submit(function(){

    let submit_flg = true;

    $('.err_shop').text('');
    $('.err_date').text('');
    $('.err_name').text('');
    $('.err_kana').text('');
    $('.err_price').text('');

    // 店舗名
    if($('.select_box').val() === ''){
      $('.err_shop').text('店舗は必須項目です。');
      submit_flg = false;
    }

    // 購入日
    if($('.date_input').val() === ''){
      $('.err_date').text('購入日は必須項目です。');
      submit_flg = false;
    }

    // 品名
    if($('#name').val() === ''){
      $('.err_name').text('品名は必須項目です。');
      submit_flg = false;
    }else if($('#name').val().length > 20){
      $('.err_name').text('品名は20文字以内です。');
      submit_flg = false;
    }

    // カナ
    if($('#kana').val() === ''){
      $('.err_kana').text('品名(カナ)は必須項目です。');
      submit_flg = false;
    }else if($('#kana').val().length > 50){
      $('.err_kana').text('品名(カナ)は50文字以内です。');
      submit_flg = false;
    }

    // 金額
    let price_pattern = /^[0-9]+$/;
    if($('#price').val() === ''){
      $('.err_price').text('金額は必須項目です。');
      submit_flg = false;
    }else if(!$('#price').val().match(price_pattern)){
      $('.err_price').text('半角数字で入力してください。');
      submit_flg = false;
    }

    return submit_flg;
  });

  $('#shop').submit(function(){

    let submit_flg = true;

    $('.err_name').text('');
    $('.err_prefecture').text('');
    $('.err_city').text('');
    $('.err_block_number').text('');


    // 店名
    if($('#name').val() === ''){
      $('.err_name').text('店名は必須項目です。');
      submit_flg = false;
    }else if($('#name').val().length > 20){
      $('.err_name').text('店名は20文字以内です。');
      submit_flg = false;
    }

    // カナ
    if( $('#prefecture').val() === '' && $('#city').val() === '' && $('#block_number').val() === ''){
    }else if( $('#prefecture').val() >= 1 && $('#city').val() !== '' && $('#block_number').val() !== ''){
    }else{
      if($('#prefecture').val() === ''){
        $('.err_prefecture').text('都道府県を入力してください。');
        submit_flg = false;
      }
      if($('#city').val() === ''){
        $('.err_city').text('市区町村を入力してください。');
        submit_flg = false;
      }
      if($('#block_number').val() === ''){
        $('.err_block_number').text('所番地を入力してください。');
        submit_flg = false;
      }
    }

    console.log($('#prefecture').val());

    return submit_flg;
  });


  $('#log_in').submit(function(){

    let submit_flg = true;

    $('.err_name').text('');
    $('.err_email').text('');
    $('.err_message').text('');

    // ニックネーム
    if($('#email').val() === ''){
      $('.err_email').text('メールアドレスを入力してください。');
      submit_flg = false;
    }

    // メールアドレス
    if($('#password').val() === ''){
      $('.err_password').text('パスワードを入力してください。');
      submit_flg = false;
    }

    return submit_flg;
  });



  $('#sign_up').submit(function(){


    let submit_flg = true;

    $('.err_name').text('');
    $('.err_email').text('');
    $('.err_password').text('');
    $('.err_check_password').text('');


    // ニックネーム
    if($('#name').val() === ''){
      $('.err_name').text('ニックネームは必須項目です。');
      submit_flg = false;
    }else if($('#name').val().length > 10){
      $('.err_name').text('ニックネームは10文字以内です。');
      submit_flg = false;
    }

    // メールアドレス
    if($('#email').val() === ''){
      $('.err_email').text('メールアドレスは必須項目です。');
      submit_flg = false;
    }
    // ぱすわーど
    if($("#password").val() === ""){
      $('.err_password').text('パスワードを入力してください。');
      submit_flg = false;
    }

    if($("#check_password").val() !== $("#password").val()){
      $('.err_check_password').text('パスワードと違います。');
      submit_flg = false;
    }
  

    return submit_flg;
  });


  $('#user_edit').submit(function(){

    let submit_flg = true;

    $('.err_name').text('');
    $('.err_email').text('');
    $('.err_before_password').text('');
    $('.err_new_password').text('');
    $('.err_check_password').text('');


    // ニックネーム
    if($('#name').val() === ''){
      $('.err_name').text('ニックネームは必須項目です。');
      submit_flg = false;
    }else if($('#name').val().length > 10){
      $('.err_name').text('ニックネームは10文字以内です。');
      submit_flg = false;
    }

    // メールアドレス
    if($('#email').val() === ''){
      $('.err_email').text('メールアドレスは必須項目です。');
      submit_flg = false;
    }

    // ぱすわーど
    if($("#new_password").val() !== "" || $("#before_password").val() !== "" || $("#check_password").val() !== ""){
      if($("#before_password").val() === ""){
        $('.err_before_password').text('以前のパスワードを入力してください。');
        submit_flg = false;
      }
      if($("#new_password").val() === ""){
        $('.err_new_password').text('新しいパスワードを入力してください。');
        submit_flg = false;
      }
      if($("#check_password").val() !== $("#new_password").val()){
        $('.err_check_password').text('新しいパスワードと違います。');
        submit_flg = false;
      }
    }
      return submit_flg;

  });
  



  $('#reset_password').submit(function(){

    let submit_flg = true;

    $('.err_email').text('');

    // メールアドレス
    if($('#reset_password_email').val() === ''){
      $('.err_email').text('メールアドレスは必須項目です。');
      submit_flg = false;
    }
    return submit_flg;
  })


  $('#change_password').submit(function(){

    let submit_flg = true;
    let input_password = $('#new_password').val();
    let password_pattern = /^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,50}$/i;

    $('.err_new_password').text('');
    $('.err_check_password').text('');

    // メールアドレス
    if(input_password === ''){
      $('.err_new_password').text('新しいパスワードを入力して下さい');
      submit_flg = false;
    }else if(!input_password.match(password_pattern)){
      $('.err_new_password').text('パスワードは8文字以上の半角英数字で構成してください。');
      submit_flg = false;
    }else if( input_password != $('#check_password').val()){
      $('.err_check_password').text('確認用パスワードが違います。');
      submit_flg = false;
    }

    return submit_flg;
  });


})