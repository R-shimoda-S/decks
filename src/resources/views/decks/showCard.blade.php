@extends('layouts.app')

@section('script')
  {{-- 下記記述では、viewsフォルダの中に作ったcomponentsフォルダの中にあるjavascript_file.blade.phpを読み込みます。 --}}
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
    <h1>カード一覧</h1>
</div>

    
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
                        <th width="10%">枚数</th>
                    </tr>
                </thead>
                <tbody>
@foreach($cards as $card)
                    <tr>
                        <td>{{$card->name}}</td>
                        <td>{{$card->cost}}</td>
                        <td>{{$card->color}}</td>
                        <td>{{$card->power}}</td>
                        <td>{{$card->speices}}</td>
                        <td>{{$card->number}}</td>
                    </tr>
@endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

    <div class="form-group row">
        <div class="submit col-6">
         <a href="{{route('decks.check')}}" class="btn btn-secondary">戻る</a>
        </div>
    </div>
@endsection