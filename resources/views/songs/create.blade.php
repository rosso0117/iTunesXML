@extends('layouts.app')

@section('content')
  <form action="{{ route('songs.store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
      <div class="form-group col-sm-6">
        <label for="name">名前</label>
        <input type="text" class="form-control" name="name" id="name">
      </div>
    </div>
    <div class="form-group">
      <label for="songs_xml">Upload File</label>
      <input type="file" class="form-control-file" name="songs_xml" id="songs_xml">
    </div>
    <a href="{{ route('playlists.index') }}" class="btn btn-primary">戻る</a>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
