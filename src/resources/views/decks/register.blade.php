
@extends('layouts.app')

@section('script')
    <script src="{{ asset('js/Libraries/register.js') }}" defer></script>
    <script src="{{ asset('js/Libraries/edit.js') }}" defer></script>
@endsection

@section('content')
<div class='title'>
@if(isset($cards))
<h1 class="title-name" id="update">修正</h1>
@else
<h1 class="title-name" id="new">登録</h1>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>

    <div class="content register-form">
            <div class="row">
                <div class="col">
                    <p>
                        カード名検索:
                        <input type="text" id="search" name="name">
                        <input type="image" height="30px" src="../../png/search.png" art="検索" style="margin-bottom:-10px" onclick="search()">
                    </p>
                </div>
            </div>
        @if(isset($cards))
        <form action="{{route('decks.update',$deck)}}" method="post">
        @csrf
        @method('PATCH')
        @else
        <form action="{{route('decks.store')}}" method="post">
        @csrf
        @endif

            <div class="row">
                <div class="col">
                    <p>
                        デッキ登録名:
                        <input type="text" name="deck" aria-describedby="validateDeck"
                        @if(isset($decks)) value="{{$decks[0]->name}}" @else value="{{old('deck')}}" @endif>
                    </p>
                </div>
            </div>
            @if(isset($cards))
            <!-- デッキ更新時の表示 -->
            <div id="card-list" class="row">
                @foreach($cards as $card)
                <div id="delete_{{$card->card_id}}" class="col-3">
                    <table class="table table-bordered border-primary" border="2">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <input type="hidden" id="my_{{$loop->iteration}}" value="{{$card->card_id}}" name="id[]">{{$card->name}}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;" align="center">
                                    <input type="number" name="number[]" id="card_{{$card->card_id}}" value="{{$card->number}}"style="width: 50px;" max="4" min="1">
                                </td>
                                <td style="width: 50%;" align="center">
                                    <input type="button" id="delete_{{$card->card_id}}" value="取消" onclick="(function(){ var val = document.getElementById('my_{{$loop->iteration}}').value;destory(val);})();">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>
            @else
            <!-- デッキ新規登録時の表示 -->
            <div id="card-list" class="row">
            
            </div>
            @endif
        
            <div class="form-group row">
                <div class="submit offset-1 col-6">
                    <button class="btn btn-primary" type="submit">送信</button>
                    @if(isset($decks))
                    <a href="{{route('decks.check')}}" class="btn btn-secondary">戻る</a>
                    @else 
                    <a href="{{route('decks.index')}}" class="btn btn-secondary">戻る</a>
                    @endif
                </div>
            </div>
        </form>
    </div>

@endsection('content')