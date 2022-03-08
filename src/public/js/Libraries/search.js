// リンクの処理開始
function search(url){

	if(!window.opener || window.opener.closed){ // メインウィンドウの存在をチェック

		window.alert('メインウィンドウがありません'); // 存在しない場合は警告ダイアログを表示

	}
	else{

		window.opener.location.href = url; // 存在する場合はページを切りかえる

	}

}

/**
 * 追加ボタンの情報をメイン画面に送るメソッド
 * @param string value カード名
 * @param int cardID カードID
 * 
 * @var string opener メイン画面
 * @var string doc メイン画面のドキュメント
 * @var string divList card-listのdiv要素
 * @var string tbl テーブル要素
 * @var string tblBody テーブルのボディ要素
 * @var string row テーブルの列要素
 * @var string cell 一列目のセル
 * @var string cellText 一列目のセルテキスト
 * @var string hiddenInput hidden形式のinput要素
 * @var string cell2　二列目一行目のセル
 * @var string input  二列目一行目のinput
 * @var string cell3　二列目二行目のセル
 * @var string inputDestory  取消ボタン設置するinput
 * @var string docDestory　削除ドキュメント
 * @const string element 削除エレメント
 *  
 */

function add(value,cardId){

	if(!window.opener || window.opener.closed){ // メインウィンドウの存在をチェック

		window.alert('メインウィンドウがありません'); // 存在しない場合は警告ダイアログを表示

	}
	else{
        var opener = window.opener;
        var doc = opener.document;

        //追加する場所のdivを取得
        const divList = doc.getElementById("card-list");

        //div の生成
        const divAddCard = document.createElement('div');
        var tbl = document.createElement("table");
        var tblBody = document.createElement("tbody");

        // 列の生成
        var row = document.createElement("tr");

        //一列の中のセル生成
        var cell = document.createElement("td");
        var cellText = document.createTextNode(value);

        //input生成
        var hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.value = cardId;
        hiddenInput.name = 'id[]';

        cell.appendChild(hiddenInput);
        cell.appendChild(cellText);
        row.appendChild(cell);

        // 列の追加
        tblBody.appendChild(row);

        //2列目の生成
        var row = document.createElement("tr");

        //1つ目のセル生成
        var cell2 = document.createElement("td");
        cell2.style = 'width:50%';

        //inputの生成
        var input = document.createElement('input');
        input.type = 'number';
        input.name = 'number[]';
        input.id = 'card_' + cardId;
        input.style = 'width:50px';
        input.max = 4;
        input.min = 1;
        cell2.appendChild(input);
        row.appendChild(cell2);

        //2つ目のセル生成
        var cell3 = document.createElement("td");
        cell3.style = 'width:50%';
        //inputの生成
        var inputDestory = document.createElement('input');
        inputDestory.type = 'button';
        inputDestory.id = 'delete_' + cardId;
        inputDestory.className = 'delete';
        inputDestory.value = '取消';
        inputDestory.onclick = function(){
            var docDestory = "delete"+cardId
            const element = doc.getElementById(docDestory); 
            element.remove();
        };

        cell3.appendChild(inputDestory);
        row.appendChild(cell3);

        tblBody.appendChild(row);

        // テーブルの生成
        tbl.appendChild(tblBody);
        // テーブル内のボディの生成
        divAddCard.appendChild(tbl);
        // 各種設定
        cell.setAttribute("colSpan", "2");
        cell2.setAttribute("align", "center");
        cell3.setAttribute("align", "center");
        tbl.setAttribute("border", "2");
        tbl.setAttribute("class","table table-bordered border-primary");
        divAddCard.setAttribute("id","delete"+cardId);
        //ブートストラップの設定
        divAddCard.className = "col-3";

        divList.appendChild(divAddCard);
    }

}

/**selectタグの個数を取得するメソッド
 *
 * @var elmSelect 
 * @var int length タグの個数
 * @var int count パックの個数 
 * 
 */

window.onload = function count(){
    // selectエレメント取得
    var elmSelect = document.getElementById("pack-number");
 
    // optionタグの数を取得
    var length = elmSelect.length;
    var count = --length;
    document.getElementById("packs").value = count;
}



