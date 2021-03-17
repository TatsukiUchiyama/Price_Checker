$(function(){

  $('#plus_tax_0').on('click',function(){
    let price_0 = $('#price_0').val();
    price_0 = Math.round(price_0*tax);

    $('#price_0').val(price_0);
  })
})