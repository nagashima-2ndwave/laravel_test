@extends('layouts.app')

@section('title','記事詳細')
<!-- messageがあるか確認 -->
@if(Session::has('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@section('content')
<div class="container">
<h1>{{ $post->title }}</h1>
<p>{{ $post->content }}</p>

<form class="mb-4" method="POST" action="{{ route('comments.store') }}">
{{ csrf_field() }}

    <input
        name="post_id"
        type="hidden"
        value="{{ $post->id }}"
    >

    <div class="form-group">
        <label for="body">
            本文
        </label>

        <textarea
            id="body"
            name="body"
            class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
            rows="4"
        >{{ old('body') }}</textarea>
        @if ($errors->has('body'))
            <div class="invalid-feedback">
                {{ $errors->first('body') }}
            </div>
        @endif
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">
            コメントする
        </button>
    </div>
</form>

<section>
    <h2 class="h5 mb-4">コメント</h2>

    @forelse($post->comments as $comment)
        <div class="border-top p-4">
            <time class="text-secondary">
                {{ $comment->created_at->format('Y.m.d H:i') }}
            </time>
            <p class="mt-2">
                {!! nl2br(e($comment->body)) !!}
            </p>
        </div>
    @empty
        <p>コメントはまだありません。</p>
    @endforelse
</section>
{{ link_to_route('posts.index','記事一覧へ戻る') }}
</div>
@endsection
