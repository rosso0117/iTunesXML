@extends('layouts.app')

@section('content')
  @if (!$playlists)
  @else
    <div>
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
            <td><a href="{{ route('playlists.show', $playlist) }}">{{ $playlist->name }}</a></td>
          </tr>
          <?php $i += 1; ?>
    @endforeach
          </tbody>
        </table>
      </div>
  @endif
      <a href="{{ route('playlists.create')}}" class="btn btn-primary">Upload XML</a>
@endsection
