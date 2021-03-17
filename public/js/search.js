$(function(){

  function add_table_top(){
    html = `<div class="index_name_area">
              <div class="index_name shop">購入店舗</div>
              <div class="index_name name">品名</div>
              <div class="index_name price">金額</div>
              <div class="index_name null_area"></div>
            </div>`;
    $(".item_index").prepend(html);
  }

  function addItems(item){
        html = `<div class="item_data">
                  <div class="item_list shop">${item['shop']}　${item['branch']}</div>
                  <div class="item_list name">${item['name']}</div>
                  <div class="item_list price">${item['price']}円</div>
                  <div class="item_list show_btn"><a href="show.php?id=${item['id']}">詳細</a></div>
                </div>`;

  $(".item_lists").append(html);

  }

  function addNoItem(){
    html = `<div class="no_item">
              商品が見つかりません。
            </div> 
    `;
  
    $(".item_lists").append(html);
  
  }

  let input = Object();
  input['name'] = $("#search_name").val();
  input['address'] = $("#search_address").val();
  if($('#search_MyItem').prop('checked') == true){
    input['MyItem'] = 1;
  }else{
    input['MyItem'] = 2;
  }
  if( $('#search_close').prop('checked') == false){
    input['close'] = 1;
  }else{
    input['close'] = 2;
  }
  if($('#search_asc').prop('checked') == true){
    input['asc'] = 1;
  }else{
    input['asc'] = 2;
  }
  input['user_id'] = user_id;
  let path = "/Items/search_item.php";
  $.ajax({
    url: path,
    type: 'GET',
    data: { input: input },
    dataType: 'json'
  })
  .done(function(items){
    $(".index_name").remove();
    $(".item_lists").children().remove();
    if (items.length !== 0){
      add_table_top();
      items.forEach(function(item){
        addItems(item);
      });

  } else if (input.length == 0) {
    return false;
  }else{
    addNoItem();
  }
    
  })
  .fail(function(){
    alert('通信エラーです。');
  });


  $("#search_name").on("keyup",function(){
    input = Object();
    input['name'] = $("#search_name").val();
    input['address'] = $("#search_address").val();
    if($('#search_MyItem').prop('checked') == true){
      input['MyItem'] = 1;
    }else{
      input['MyItem'] = 2;
    }
    if( $('#search_close').prop('checked') == false){
      input['close'] = 1;
    }else{
      input['close'] = 2;
    }
    if($('#search_asc').prop('checked') == true){
      input['asc'] = 1;
    }else{
      input['asc'] = 2;
    }
    input['user_id'] = user_id;
    path = "/Items/search_item.php";
    $.ajax({
      url: path,
      type: 'GET',
      data: { input: input },
      dataType: 'json'
    })
    .done(function(items){
      $(".index_name_area").remove();
      $(".item_lists").children().remove();
      if (items.length !== 0){
        add_table_top();
        items.forEach(function(item){
          addItems(item);
        });
  

    } else if (input.length == 0) {
      return false;
    }else{
      addNoItem();
    }
      
    })
    .fail(function(){
      alert('通信エラーです。');
    });
  });


  $("#search_address").on("keyup",function(){
    input = Object();
    input['name'] = $("#search_name").val();
    input['address'] = $("#search_address").val();
    if($('#search_MyItem').prop('checked') == true){
      input['MyItem'] = 1;
    }else{
      input['MyItem'] = 2;
    }
    if( $('#search_close').prop('checked') == false){
      input['close'] = 1;
    }else{
      input['close'] = 2;
    }
    if($('#search_asc').prop('checked') == true){
      input['asc'] = 1;
    }else{
      input['asc'] = 2;
    }
    input['user_id'] = user_id;
    path = "/Items/search_item.php";
    $.ajax({
      url: path,
      type: 'GET',
      data: { input: input },
      dataType: 'json'
    })
    .done(function(items){
      $(".index_name_area").remove();
      $(".item_lists").children().remove();
      if (items.length !== 0){
        add_table_top();
        items.forEach(function(item){
          addItems(item);
        });
  

    } else if (input.length == 0) {
      return false;
    }else{
      addNoItem();
    }
      
    })
    .fail(function(){
      alert('通信エラーです。');
    });
  });


  $('#search_MyItem').change(function(){
    input = Object();
    input['name'] = $("#search_name").val();
    input['address'] = $("#search_address").val();
    if($('#search_MyItem').prop('checked') == true){
      input['MyItem'] = 1;
    }else{
      input['MyItem'] = 2;
    }
    if( $('#search_close').prop('checked') == false){
      input['close'] = 1;
    }else{
      input['close'] = 2;
    }
    if($('#search_asc').prop('checked') == true){
      input['asc'] = 1;
    }else{
      input['asc'] = 2;
    }
    input['user_id'] = user_id;
    path = "/Items/search_item.php";
    $.ajax({
      url: path,
      type: 'GET',
      data: { input: input },
      dataType: 'json'
    })
    .done(function(items){
      $(".index_name_area").remove();
      $(".item_lists").children().remove();
      if (items.length !== 0){
        add_table_top();
        items.forEach(function(item){
          addItems(item);
        });
  

    } else if (input.length == 0) {
      return false;
    }else{
      addNoItem();
    }
      
    })
    .fail(function(){
      alert('通信エラーです。');
    });
  });

  $('#search_asc').change(function(){
    input = Object();
    input['name'] = $("#search_name").val();
    input['address'] = $("#search_address").val();
    if($('#search_MyItem').prop('checked') == true){
      input['MyItem'] = 1;
    }else{
      input['MyItem'] = 2;
    }
    if( $('#search_close').prop('checked') == false){
      input['close'] = 1;
    }else{
      input['close'] = 2;
    }
    if($('#search_asc').prop('checked') == true){
      input['asc'] = 1;
    }else{
      input['asc'] = 2;
    }
    input['user_id'] = user_id;
    path = "/Items/search_item.php";
    $.ajax({
      url: path,
      type: 'GET',
      data: { input: input },
      dataType: 'json'
    })
    .done(function(items){
      $(".index_name_area").remove();
      $(".item_lists").children().remove();
      if (items.length !== 0){
        add_table_top();
        items.forEach(function(item){
          addItems(item);
        });
  

    } else if (input.length == 0) {
      return false;
    }else{
      addNoItem();
    }
      
    })
    .fail(function(){
      alert('通信エラーです。');
    });
  });


  $('#search_close').change(function(){
    input = Object();
    input['name'] = $("#search_name").val();
    input['address'] = $("#search_address").val();
    if($('#search_MyItem').prop('checked') == true){
      input['MyItem'] = 1;
    }else{
      input['MyItem'] = 2;
    }
    if( $('#search_close').prop('checked') == false){
      input['close'] = 1;
    }else{
      input['close'] = 2;
    }
    if($('#search_asc').prop('checked') == true){
      input['asc'] = 1;
    }else{
      input['asc'] = 2;
    }
    input['user_id'] = user_id;
    path = "/Items/search_item.php";
    $.ajax({
      url: path,
      type: 'GET',
      data: { input: input },
      dataType: 'json'
    })
    .done(function(items){
      $(".index_name_area").remove();
      $(".item_lists").children().remove();
      if (items.length !== 0){
        add_table_top();
        items.forEach(function(item){
          addItems(item);
        });
  

    } else if (input.length == 0) {
      return false;
    }else{
      addNoItem();
    }
      
    })
    .fail(function(){
      alert('通信エラーです。');
    });
  });

})
