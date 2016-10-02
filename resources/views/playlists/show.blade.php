@extends('layouts.app')

@section('content')
<div>
        <table class="table">
          <thead>
            <tr>
              <th></th>
              <th>タイトル</th>
              <th>アーティスト</th>
              <th>アルバム</th>
              <th>ジャンル</th>
              <th>再生回数</th>
            </tr>
          </thead>
          <tbody>
      <?php $i=1; ?>
    @foreach ($playlist->songs as $song)
          <tr>
            <th scope="row">{{ $i }}</th>
            <td>{{ $song->title }}</td>
            <td>{{ $song->artist }}</td>
            <td>{{ $song->album }}</td>
            <td>{{ $song->genre }}</td>
            <td>{{ $song->play_count }}</td>
          </tr>
          <?php $i += 1; ?>
    @endforeach
          </tbody>
        </table>
      </div>

      <form action="{{ route('playlists.destroy', $playlist) }}" method="post">
        {{ csrf_field() }}
        <a href="{{ route('playlists.index') }}" class="btn btn-primary">戻る</a>
        <input type="hidden" name="_method" id="_method" value="DELETE">
        <button type="submit" class="btn btn-danger">削除</button>
      </form>
@endsection
