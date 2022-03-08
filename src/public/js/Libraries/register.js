
/**
 *ページを離れる時の動作 
 * 
 * 
 */

$(window).on('beforeunload', function() {
   saveDom();
});

/**
 * 要素の復元
 * 
 * @const divList カードリストのdiv
 * @var  data　遷移前のdiv
 * @var  deleteClass i番目のdeleteクラス
 * @var  event i番目のdeleteクラスの削除ボタン
 * @var  nameEvent 'delete'
 * @var  nameID 削除予定のID番号
 * @var  docDestory 削除予定のID
 */
window.onload = function(){

    if( ! window.localStorage ){ return }

    //追加する場所のdivを取得
    const divList = document.getElementById("card-list");

    data = JSON.parse(localStorage.getItem("divData"));

    //最後に内容をidの中身に追加
    for(i=0;i<data.length;i++){
        divList.innerHTML = divList.innerHTML+data[i];
        divList.innerHTML+data[i];
    }

    for(j=0;j<data.length;j++){
        var deleteClass = document.getElementsByClassName('delete')[j];
        var event = document.getElementById(deleteClass.id);

        //イベントの追加
        event.addEventListener( "click" , function () {
            var destory = document.getElementById(this.id).id;
            nameEvent = destory.substr( 0,6 );
            nameID = destory.substr( 7,1 );
            var docDestory = nameEvent+nameID ;
            const element = document.getElementById(docDestory); 
            element.remove();
        });
    }
}
        

/** 
 * 検索画面を別ウィンドウで開くメソッド
 * 
 * @var txt 入力されたテキスト
 * 
 */

function search(url){

    var txt = document.getElementById("search").value;

    var url = '/decks/search/index?search='+txt;

    window.open(url, null, 'top=100,left=100,width=850,height=600');

}

/**
 * DOMを保存するメソッド
 * 
 * @var div 保存する場所のDiv
 * @var html 各種カードのHTML
 */
function saveDom(){

    var div = document.getElementById('card-list');

    let html = [];

    for(var i=0; i<div.childElementCount; i++) {	

        html.push(div.children[i].outerHTML);
    }

    //登録画面か修正画面かどうか判断して保存先を変更　titleの取得
    var title = document.getElementsByClassName('title-name');
    var titleId = title[0].id;
    console.log(titleId);
    if(titleId == 'new'){
        localStorage.setItem( "divData", JSON.stringify(html) );
    }else{
        localStorage.removeItem("divData");
    }
}
    