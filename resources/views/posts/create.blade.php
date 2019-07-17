@extends('layouts.app')

@section('title','記事作成')

@section('content')

<div class="container">
<h1>記事作成</h1>
  <div class="row">
    <div　class="col-4">
    <ul>
      @if($errors->has('title'))
      <li class="alert alert-danger">{{ $errors->first('title') }}</li>
      @endif

      @if($errors->has('content'))
      <li class="alert alert-danger">{{ $errors->first('content') }}</li>
      @endif
    </ul>
    </div>


  {{ Form::open(['route'=>'posts.store']) }}
  {{ csrf_field() }}
  <p>
    タイトル：<br>
    {{ Form::text('title',$post->title) }}
  </p>
  <p>
    本文：<br>
    {{ Form::textarea('content',$post->content) }}
  </p>
  {{ Form::submit('作成',['class'=>'btn btn-primary btn-sm']) }}
  {{ Form::close() }}

  {{ link_to_route('posts.index','記事一覧へ戻る') }}
  </div>
</div>
@endsection
