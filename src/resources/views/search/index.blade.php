@extends('layouts.app')

@section('script')
  {{-- 下記記述では、viewsフォルダの中に作ったcomponentsフォルダの中にあるjavascript_file.blade.phpを読み込みます。 --}}
  <script src="{{ asset('js/Libraries/search.js') }}" defer></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/css/theme.default.min.css">
  <link href="{{ asset('css/search.css') }}" rel="stylesheet">

  <script>
   $(document).ready(function() {
    $('#card-table').tablesorter({
        headers: {
               5: { sorter: false }
            }
        });
   });
  </script>
@endsection

@section('content')



<div class='title'>
    <h1>検索画面</h1>
</div>

<div class="content search-form">
    <form action="{{route('search.search')}}" method='post'>
    @csrf
    @method('PATCH')
    <input id="packs" name="count" type="hidden" value="">
    <div class="row">
        <div class="col" style="padding-right: 0px;">
            カード名:<input type="text" name="name" style="width:140px;">
        </div>

        <div class="col" style="padding-right: 0px; padding-left: 0px;">
            色:
            赤<input type="checkbox" name="color[]" value="赤">
            青<input type="checkbox" name="color[]" value="青">
            白<input type="checkbox" name="color[]" value="白">
            黒<input type="checkbox" name="color[]" value="黒">
            緑<input type="checkbox" name="color[]" value="緑">
            無<input type="checkbox" name="color[]" value="無">
        </div>

        <div class="col" style="padding-left: 0px;">
            収録弾:
            <select id ="pack-number" name="pack_number">
                <option value="">指定なし</option>
                <option value="B01">B01 異世界との邂逅</option>
                <option value="B02">B02 巨神の方向</option>
                <option value="B03">B03 五帝竜降臨</option>
            </select>
        </div>
    </div>

    <div class="row"style="margin-top:5px">
        <div class="col-5" style="padding-right: 0px;">
            コスト:
            <select name="cost_min">
                <option value="0">下限なし</option>
@for($i=1;$i<=11;$i++)
                <option value="{{ $i }}">{{ $i }}</option>       
@endfor
            </select>
            ～
            <select name="cost_max">
                <option value="12">上限なし</option>
@for($j=1;$j<=11;$j++)
                <option value="{{ $j }}">{{ $j }}</option>
@endfor
            </select>    
        </div>

        <div class="col-5" style="padding-right: 0px; padding-left: 0px;">
        パワー:
        <select name="power_min">
                <option value="0">下限なし</option>
@for($k=500;$k<=11000;$k=$k+500)
                <option value="{{ $k }}">{{ $k }}</option>
@endfor
            </select>
            ～
            <select name="power_max">
                <option value="50000">上限なし</option>
@for($l=500;$l<=11000;$l=$l+500)
                <option value="{{ $l }}">{{ $l }}</option>
@endfor
            </select>    
        </div>

        <div class="col" style="padding-left: 0px;">
            <input type="submit" value="検索">
        </div>
   
    </div>
    </form>
<div class="row" style="padding-top:10px;">

</div>
@if(!empty($lists))

<div class="content search-list">
    
    <div class="row">
        <div class="col">
            <table id="card-table" class="table table-striped table_sticky">
                <thead>
                    <tr>
                        <th width="35%">名前</th>
                        <th width="10%">コスト</th>
                        <th width="10%">色</th>
                        <th width="10%">パワー</th>
                        <th width="20%">種族</th>
                        <th width="10%">追加</th>
                    </tr>
                </thead>
                <tbody>
@foreach($lists as $list)
                    <tr>
                        <td>{{$list->name}}</td>
                        <td>{{$list->cost}}</td>
                        <td>{{$list->color}}</td>
                        <td>{{$list->power}}</td>
                        <td>{{$list->speices}}</td>
                        <td><button value="{{$list->name}}" id="{{$list->id}}" onClick="add(this.value,this.id); return false;">追加</button></td>
                    </tr>
@endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-center">
                {{ $lists->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>
@endif

@endsection