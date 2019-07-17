@extends('layouts.app')

@section('title','記事一覧')

@if(Session::has('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@section('content')

@section('left')
    {{ Form::open(['route'=>'posts.index','method'=>'get']) }}
    {{ csrf_field() }}
    {{ Form::text('keyword','',['type'=>'search','placeholder'=>'タイトルまたは本文から検索','style'=>'width: 250px']) }}
    {{ Form::submit('検索',['class'=>'btn btn-primary btn-sm']) }}
    {{ Form::close() }}
    <span>日付絞り込み：</span>
    {{ Form::open(['route'=>'posts.index','method'=>'get']) }}
    {{ Form::selectRange('from_year', 2000, 2019, '', ['placeholder' => '年']) }}年
    {{ Form::selectRange('from_month', 1, 12, '', ['placeholder' => '月']) }}月
    {{ Form::selectRange('from_day', 1, 31, '', ['placeholder' => '日']) }}日
    <span>〜</span>
    <p></p>
    {{ Form::selectRange('to_year', 2000, 2019, '', ['placeholder' => '年']) }}年
    {{ Form::selectRange('to_month', 1, 12, '', ['placeholder' => '月']) }}月
    {{ Form::selectRange('to_day', 1, 31, '', ['placeholder' => '日']) }}日
    {{ Form::submit('絞り込み',['class'=>'btn btn-primary btn-sm']) }}
    {{ Form::close() }}
    {{ link_to_route('posts.create','[記事作成]') }}
@endsection

@section('right')
      <table class="table">
        <tr>
            <th>投稿者</th>
            <th>タイトル</th>
            <th>本文</th>
            <th>投稿時間</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <!-- コントローラーから受け取った$postsをforeach文で$postに取り出し -->
          @foreach($posts as $post)
          <tr>
            {{-- 投稿者 --}}
            <td>{{ $post->name }}</td>
            <!-- url, 表示するタイトル名, URLに付与するパラメーター -->
            <td>{{ link_to_route('posts.show',$post->title,[$post->id]) }}</td>
            {{-- コンテンツ --}}
            <td>{{ $post->content }}</td>
            {{-- 作成日 --}}
            <td>{{ $post->created_at }}</td>
            {{-- コメント --}}
            <td>@if ($post->comments->count())
                    <span class="badge badge-primary">
                        コメント {{ $post->comments->count() }}件
                    </span>
                @endif</td>
            @if (Auth::check())
            <td>{{ link_to_route('posts.edit','編集',[$post->id],['class'=>'btn btn-primary btn-sm']) }}</td>
            <td>
              {{ Form::open(['route'=>['posts.destroy', $post->id],'onSubmit'=>'return delPostConfirm();','method'=>'delete']) }}
              {{ Form::submit('削除',['class'=>'btn btn-danger btn-sm']) }}
              {{ Form::close() }}
            </td>
            @endif
          </tr>
          @endforeach
      </table>
    <div class="d-flex justify-content-center mb-5">
        {{ $posts->links() }}
    </div>
@endsection
@endsection


@section('script')
<script>
function delPostConfirm() {
  if(confirm('削除しますか？')) {
  } else {
      return false;
  }
}
</script>
@endsection
