$(function(){

  let html = `
  <div class="pulldown_list no_link">${username}さん </div>
  <div class="pulldown_list"><a href="/Users/show.php"><span class="overlink"></span>マイページ</a></div>
  <div class="pulldown_list"><a href="/Items/new.php"><span class="overlink"></span>商品登録</a></div>
  <div class="pulldown_list"><a href="/Shops/index.php"><span class="overlink"></span>店舗一覧</a></div>
  <div class="pulldown_list"><a href="/Users/log_out.php" onClick="return logOut_alert()"><span class="overlink"></span>ログアウト</a></div>
  `;
  
  $('#pulldown').hover(function(){
    $(".pulldown_menu").remove();
    $("<div class='pulldown_menu'></div>").appendTo('#pulldown').hide().fadeIn(300);
    $(html).appendTo('.pulldown_menu').hide().fadeIn(300);

    
  },
  // マウスポインタが外れた時の処理
    function() {
    $(".pulldown_menu").remove();
    });


  let html_noShop = `
  <div class="pulldown_list">${username}さん</div>
  <div class="pulldown_list"><a href="/Users/show.php">マイページ</a></div>
  <div class="pulldown_list"><a href="/Shops/new.php" onClick="return noShop_alert()">商品登録</a></div>
  <div class="pulldown_list"><a href="/Shops/index.php">店舗一覧</a></div>
  <div class="pulldown_list"><a href="/Users/log_out.php" onClick="return logOut_alert()">ログアウト</a></div>
  `;
  
  $('#pulldown_noShop').hover(function(){
    $(".pulldown_menu").remove();
    $("<div class='pulldown_menu'></div>").appendTo('#pulldown_noShop').hide().fadeIn(300);
    $(html).appendTo('.pulldown_menu').hide().fadeIn(300);

  },
  // マウスポインタが外れた時の処理
    function() {
    $(".pulldown_menu").remove();
    });
})

