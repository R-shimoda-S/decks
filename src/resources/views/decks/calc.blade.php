@extends('layouts.app')

@section('content')

<div class='title'>
  <h1>確率計算</h1>
</div>

<div class="row">
  
  @if(count($errors)>0)
  <div class="alert alert-danger col">
    <ul>
    @foreach($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
    </ul>
  </div>
  @endif
  
</div>  


<form action="{{route('decks.calc')}}" method="post">
@csrf
<div class='row' style="padding-bottom: 5px;">
 <div class='input-group col-2'>
    <div class="d-flex align-items-center">
     <p>マリガン</p>
    </div>
  <div class="input-group-prepend offset-1">
    <div class="input-group-text">
      <input type="radio" name="mulligan" aria-label="Checkbox for following text input"
      value="1" checked="checked">無
      <input type="radio" name="mulligan" aria-label="Checkbox for following text input"
      value="2">有
    </div>
  </div>
 </div>

 <div class='input-group col-2'>
    <div class="d-flex align-items-center">
     <p>手順</p>
    </div>
  <div class="input-group-prepend offset-1">
    <div class="input-group-text">
      <input type="radio" name="pro" aria-label="Checkbox for following text input"
      value="1" checked="checked">先行
      <input type="radio" name="pro" aria-label="Checkbox for following text input"
      value="2">後攻
    </div>
  </div>
 </div>

  <div class='input-group col-2'>
    <div class="d-flex align-items-center">
     <p>デッキ枚数</p>
    </div>
   <div class="input-group-prepend offset-1">
    <div class="input-group-text">
      <input type="text" name="number" style="width:40px;" aria-label="Checkbox for following text input"
      value="48">
    </div>
   </div>
  </div>

  <div class='input-group col-2' style="padding-left: 0px;padding-right: 0px;">
    <div class="d-flex align-items-center">
     <p>カード枚数</p>
    </div>
   <div class="input-group-prepend offset-1">
    <div class="input-group-text">
      <input type="text" name="card" style="width:40px;" aria-label="Checkbox for following text input"
      value="1">枚
    </div>
   </div>
  </div>
  <div class='input-group col-2'>
    <div class="d-flex align-items-center">
     <p>初手枚数</p>
    </div>
   <div class="input-group-prepend offset-1">
    <div class="input-group-text">
      <input type="text" name="draw" style="width:40px;" aria-label="Checkbox for following text input"
      value="4">枚
    </div>
   </div>
  </div>

  <div class='input-group col-2'>
    <div class="input-group-text">
      <input type="submit" aria-label="Checkbox for following text input"
      value="計算">
    </div>
 </div>
</div>
</form>

@if(isset($answers))

<div class=" row">
    <div style="width:100%">
        <canvas id="myChart" width="500px" height="100px"></canvas>
    </div>
    
    <script>
      let answers = [
        @foreach($answers as $answer)
        {{$answer}},
        @endforeach
      ];
    </script>
    <script src="{{ asset('js/glaf.js') }}">
    </script>
</div>
@endif
@endsection