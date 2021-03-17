$(function(){

  function add_price(year, month, monthly_price){
  html = `<div class="select_month">
            <div id="left">◀︎</div>
            <p class="month">${year}年${month}月の出費</p>
            <div id="right">▶︎</div>
          </div>
          <p class="price">${monthly_price}円</p>`;

  $('.spending').children().remove();
  $(html).appendTo('.spending').hide().fadeIn(500);

  }

  function No_item(year, month){
    html = `<div class="select_month">
              <div id="left">◀︎</div>
              <p class="month">${year}年${month}月の出費</p>
              <div id="right">▶︎</div>
            </div>
            <p class="No_item">商品を登録していません。</p>`;
  
    $('.spending').children().remove();
    $(html).appendTo('.spending').hide().fadeIn(500);

  
    }
  




  $today = new Date();
  let year = $today.getFullYear();
  let month = $today.getMonth() +1;
  let count = String(month).length;
  if(count <= 1){
    month2 = `0${month}`;
  }

  let user = user_id;
  let path = "/Users/monthly_sum.php";
  data = {year: year, month: month2, user_id: user };


  $.ajax({
    url: path,
    type: 'GET',
    data: {data: data,},
    dataType: 'json'
  })
  .done(function(price){
    if(price == "なし"){
      No_item(year, month);
    }else{
    monthly_price = price['sum']
    add_price(year, month, monthly_price);
    }
  })
  .fail(function(){
    alert('通信エラーです。ユーザーを表示できません。');
  });


  // リロード処理
// ------------------------------------------------------------------------------------
  // クリック処理


  $(document).on("click", "#left", function(){
    month -= 1;
    if(month == 0){
      month = 12;
      year -= 1;
    }
    count = String(month).length;
    if(count <= 1){
      month2 = `0${month}`;
    }

    data = {year: year, month: month2, user_id: user };
  
  
    $.ajax({
      url: path,
      type: 'GET',
      data: {data: data,},
      dataType: 'json'
    })
    .done(function(price){
      if(price == "なし"){
        No_item(year, month);
      }else{
      monthly_price = price['sum']
      add_price(year, month, monthly_price);
      }
    })
    .fail(function(){
      alert('通信エラーです。ユーザーを表示できません。');
    });
  })

  $(document).on("click", "#right", function(){
    month += 1;
    if(month == 13){
      month = 1;
      year += 1;
    }
    count = String(month).length;
    if(count <= 1){
      month2 = `0${month}`;
    }

    data = {year: year, month: month2, user_id: user };
  
  
    $.ajax({
      url: path,
      type: 'GET',
      data: {data: data,},
      dataType: 'json'
    })
    .done(function(price){
      if(price == "なし"){
        No_item(year, month);
      }else{
      monthly_price = price['sum']
      add_price(year, month, monthly_price);
      }
    })
    .fail(function(){
      alert('通信エラーです。ユーザーを表示できません。');
    });
  })



})