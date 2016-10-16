@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Playlists</div>
        <div class="panel-body">
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
                      <th scope="row"><input type="checkbox" name="checked_id"></th>
                      <td><a href="{{ route('playlists.show', $playlist) }}">{{ $playlist->name }}</a></td>
                      <td><button type="submit" class="btn btn-danger">Delete</button></td>
                    </tr>
                    <?php $i += 1; ?>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
          <a href="{{ route('playlists.create')}}" class="btn btn-primary">Upload XML</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
