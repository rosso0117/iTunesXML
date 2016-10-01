@extends('layouts.app')

@section('content')
  @if ($songs)
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
    <?php $i = 1; ?>
    @foreach ($songs as $song)
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
  @endif
  <form action="{{ route('songs.upload') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="songs_xml" id="songs_xml">
    <input type="submit" value="Upload">
  </form>
@endsection
