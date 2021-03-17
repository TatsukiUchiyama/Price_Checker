$(function(){
  let number = 1;

  function add_html(number){
    const js = `<script type="text/javascript">
                  $(document).ready(
                      function() {
                      $.fn.autoKana('.name${number}', '.kana${number}', {
                          katakana : true
                          });
                      });
                 
                    $(document).on("click", "#plus_tax_${number}", function() {
                      let price_${number} = $('#price_${number}').val();
                      price_${number} = Math.round(price_${number}*tax);
                      $('#price_${number}').val(price_${number});
                    })
                </script>`

    const html =`<div class="one_item">
                  <div class="input_contents">
                    <div class="input_content">
                      <p class="label_text">品名</p>
                      <input tabindex="${number}1" id="name_${number}" class="text_box name${number}" name="item[name][]">
                      <p class="err_message red"><?php if(isset($err['name'][${number}])){ echo $err['name'][${number}]; } ?> </p>
                      <p class="err_name_${number} red text_center"></p>
                    </div>
                    <div class="input_content">
                      <p class="label_text">品名(カナ)</p>
                      <input tabindex="${number}2" id="kana_${number}" class="text_box kana${number}" name="item[kana][]">
                      <p class="err_message ${number} red"><?php if(isset($err['kana'][${number}])){ echo $err['kana'][${number}]; } ?> </p>
                      <p class="err_kana_${number} red text_center"></p>
                    </div>
                  </div>


                  <div  class="input_contents">
                    <div class="input_content">
                      <p class="label_text">商品名称</p>
                      <input tabindex="${number}3" id="item_name_${number}" class="text_box" name="item[item_name][]">
                      <p class="err_messagen ${number} red"><?php if(isset($err['item_name'][${number}])){ echo $err['item_name'][${number}]; } ?> </p>
                      <p class="err_item_name_${number} red text_center"></p>
                    </div>
                    <div class="input_content">
                      <p class="label_text">金額(税込)</p>
                      <div class="price_area"><input  tabindex="${number}4" id="price_${number}" class="text_box price" name="item[price][]"><p class="yen">円</p><button tabindex="${number}5" type="button" id="plus_tax_${number}" class="btn btn--orange tax_btn">+tax</div>
                      <p class="err_message ${number} red"><?php if(isset($err['price'][${number}])){ echo $err['price'][${number}]; } ?> </p>
                      <p class="err_price_${number} red text_center"></p>
                    </div>
                  </div>


                  <div class="input_content">
                    <p class="label_text">コメント</p>
                    <textarea  tabindex="${number}6" id="comment_${number}" class="textarea" name="item[comment][]" cols="30" rows="10"></textarea>
                    <p class="err_message ${number} red"><?php if(isset($err['comment'][${number}])){ echo $err['comment'][${number}]; } ?> </p>
                    <p class="err_comment_${number} red text_center"></p>
                  </div>
                </div>`
                  
      $(js).appendTo('.items')
    $(html).appendTo('.items').hide().fadeIn(500);
      
  }
  let item_count = $(".items").children("div").length;
  $('#delete_item').css('display','none');
  // 削除ボタンの表示   のこり一つになると非表示

  // 追加ボタンをおすと入力欄がひとつ追加になる
  $(document).on("click", "#add_item", function() {
    add_html(number);
    number += 1;
    item_count = $(".items").children("div").length;
    if(item_count > 1){
      $('#delete_item').css('display','block');
    }
  });
  // 削除ボタンを押すと確認後入力卵をひとつ削除　autoKanaもひとつ削除
  $('#delete_item').on('click', function(){
      $.when(
        $('.items > :last').fadeOut(500)
      ).done(function(){ 
        $('.items > :last').remove();
        $('.items > :last').remove();
        item_count = $(".items").children("div").length;
        if(item_count <= 1 ){
          $('#delete_item').css('display','none');
        }
        console.log(item_count);     

      });
  });


  $(document).on("keyup", ".one_item", function() {
    $("#add_item").attr('tabindex', number*10);
  })




  
})