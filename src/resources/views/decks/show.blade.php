@extends('layouts.app')

@section('script')
  <link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class='title'>
        <h1>デッキ閲覧</h1>
    </div>

    @csrf
    <div class="form-group row">
        <div class="col">
            <h3>デッキ名</h3>
        </div>
    </div>

    <div class="row">
        @foreach($decks as $deck)
        <span class="col-3">
            <div class="row">
                <div class="col-4" style="padding-top: 5px;padding-left: 30px;">
                    <li>{{$deck->name}}</li>
                </div>

                <div class="col-8 button_form" style="padding-top: 3px;">
                    <form action="{{route('decks.show',$deck)}}" method="get" style="display:inline-block;">
                    @method('PATCH')
                    @csrf
                    <button type="submit" class="btn-primary button_size">詳細</button>
                    </form>
                    <form action="{{route('decks.edit',$deck)}}" method="get" style="display:inline-block;">
                    @method('PATCH')
                    @csrf
                    <button type="submit" class="btn-warning button_size">修正</button>
                    </form>
                    <form action="{{route('decks.destroy',$deck)}}" method="post" style="display:inline-block;">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn-danger button_size" onclick="return confirm('本当に削除しますか？');">削除</button>
                    </form>
                </div>
            </div>
        </span>
        @endforeach
    </div>

    <div class="row">
        <div class="link p-3" style="margin:0 auto;">
        {{$decks->links()}}
        </div>
    </div>


    <div class="form-group row">
        <div class="submit col-6">
         <a href="{{route('decks.index')}}" class="btn btn-secondary">戻る</a>
        </div>
    </div>
@endsection