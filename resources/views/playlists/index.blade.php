@extends('layouts.app')

@section('content')
  @if ($playlists)
    <table class="table">
          <thead>
            <tr>
              <th></th>
              <th>名前</th>
            </tr>
          </thead>
          <tbody>
      <?php $i=1; ?>
    @foreach ($playlists as $playlist)
          <tr>
            <th scope="row">{{ $i }}</th>
            <td>{{ $playlist->name }}</td>
          </tr>
          <?php $i += 1; ?>
    @endforeach
          </tbody>
        </table>
      </div>
  @endif
      {{-- <div>
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
    @foreach ($playlists as $playlist)
          <tr>
            <th scope="row">{{ $i }}</th>
            <td>{{ $song->title }}</td>
            <td>{{ $song->artist }}</td>
            <td>{{ $song->album }}</td>
            <td>{{ $song->genre }}</td>
            <td>{{ $song->play_count }}</td>
          </tr>
    @endforeach
          </tbody>
        </table>
      </div> --}}
      <a href="{{ route('playlists.create')}}" class="btn btn-primary">Upload XML</a>
@endsection
