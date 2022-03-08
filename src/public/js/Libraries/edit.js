
/**
 * カード登録欄を消すメソッド
 * 
 * @param int val 選択したDOMの番号
 * 
 * @var string docDestory 削除ドキュメント
 * @var string element 対象のエレメント
 */
function destory(val){
    
    var docDestory = "delete_"+val; 
    const element = document.getElementById(docDestory); 
    element.remove();

}