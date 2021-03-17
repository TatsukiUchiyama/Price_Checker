
function delete_alert(){
  if(!confirm(`本当に削除しますか？`)){
    /* キャンセルの時の処理 */
    return false;
  }else{
    /*　OKの時の処理 */
    return true;
  }
}

function logOut_alert(){
  if(!confirm(`本当にログアウトしますか？`)){
    /* キャンセルの時の処理 */
    return false;
  }else{
    /*　OKの時の処理 */
    return true;
  }
}

function noShop_alert(){
  alert('先に店舗を登録してください。');
}

