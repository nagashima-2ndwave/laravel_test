@extends('layouts.app')

@section('title','記事編集')

@section('content')
<div class="container">
<h1>記事編集</h1>

<!-- hasメソッド：値がある場合にtrueを返す -->
@if($errors->has('title'))
<!-- 指定したフィールドの最初のエラーメッセージを取得するには、firstメソッドを使います。 -->
<span class="alert alert-danger">{{ $errors->first('title') }}</span>
@endif
<br>
@if($errors->has('content'))
<span class="alert alert-danger">{{ $errors->first('content') }}</span>
@endif

{{ Form::open(['route'=>['posts.update',$post->id], 'method'=>'put']) }}
{{ csrf_field() }}
<p>
  タイトル：<br>
  {{ Form::text('title',$post->title) }}
</p>
<p>
  本文：<br>
  {{ Form::textarea('content',$post->content) }}
</p>
{{ Form::submit('更新',['class'=>'btn btn-primary btn-sm']) }}
{{ Form::close() }}

{{ link_to_route('posts.index','記事一覧へ戻る') }}

</div>
@endsection
