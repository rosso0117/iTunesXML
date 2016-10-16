@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-primary">
        <div class="panel-heading">{{ $playlist->name }}</div>
        <div class="panel-body">
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
            <td><a href="{{ route('playlists.songs.show', [$playlist, $song]) }}">{{ $song->title }}</a></td>
            <td>{{ $song->artist }}</td>
            <td>{{ $song->album }}</td>
            <td>{{ $song->genre }}</td>
            <td>{{ $song->play_count }}</td>
          </tr>
          <?php $i += 1; ?>
    @endforeach
          </tbody>
        </table>

      <form action="{{ route('playlists.destroy', $playlist) }}" method="post">
        {{ csrf_field() }}
        <a href="{{ route('playlists.index') }}" class="btn btn-primary">戻る</a>
        <input type="hidden" name="_method" id="_method" value="DELETE">
        <button type="submit" class="btn btn-danger">削除</button>
      </form>
</div>
</div>
</div>
</div>
</div>
@endsection
