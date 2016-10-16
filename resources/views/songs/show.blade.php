@extends('layouts.app')

@section('content')

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-primary">
        <div class="panel-heading">{{ $song->title }}</div>
        <div class="panel-body">
          @if($reviews)
            <h4>レビュー</h4>
            <div>
              <table class="table">
                <thead>
                  <tr>
                    <th></th>
                    <th>タイトル</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; ?>
                  @foreach($reviews as $review)
                    <tr>
                      <th scope="row">{{ $i }}</th>
                      <td><a href="{{ route('playlists.songs.reviews.show', [$playlist, $song, $review]) }}" >{{ $review->title }}</a></td>
                      <td>
                        <button type="button" class="btn btn-primary btn-sm chart-button" id="chartButton" data-toggle="modal" data-target="#reviewModal" value="{{ $i - 1 }}">
                          グラフ
                        </button>
                      </td>
                    </tr>
                    <?php $i += 1; ?>
                  @endforeach
                  @include('partials.modal', ['review_jsons' => $review_jsons])
                </tbody>
              </table>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>

<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading">レビュー投稿</div>
      <div class="panel-body">
        <form action="{{ route('reviews.store') }}" method="post">
          {{ csrf_field() }}
          <div class="row">
            <div class="form-group col-sm-6">
              <label for="title">タイトル</label>
              <input type="text" class="form-control" name="title" id="title">
            </div>
          </div>
          <div class="form-group">
              <label for="body">レビュー</label>
            <textarea class="form-control" name="body" id="body" cols="30" rows="5"></textarea>
          </div>
          <div class="form-group">
            <div class="col-sm-3">
              <label for="artistic">評価基準1</label>
            </div>
            <input id="artistic" type="text" name="artistic" data-slider-id="volumeSlider" data-slider-min="0" data-slider-max="5" data-slider-step="1" data-slider-value="3" />
          </div>
          <div class="form-group">
            <div class="col-sm-3">
              <label for="exciting">評価基準2</label>
            </div>
            <input id="exciting" type="text" name="exciting" data-slider-id="volumeSlider" data-slider-min="0" data-slider-max="5" data-slider-step="1" data-slider-value="3" />
          </div>
          <div class="form-group">
            <div class="col-sm-3">
              <label for="pop">評価基準3</label>
            </div>
            <input id="pop" type="text" name="pop" data-slider-id="volumeSlider" data-slider-min="0" data-slider-max="5" data-slider-step="1" data-slider-value="3" />
          </div>
          <div class="form-group">
            <div class="col-sm-3">
              <label for="fun">評価基準4</label>
            </div>
            <input id="fun" type="text" name="fun" data-slider-id="volumeSlider" data-slider-min="0" data-slider-max="5" data-slider-step="1" data-slider-value="3" />
          </div>
          <input type="hidden" name="playlist_id" id="playlist_id" value="{{ $playlist->id }}">
          <input type="hidden" name="song_id" id="song_id" value="{{ $song->id }}">
          <a href="{{ route('playlists.show', $playlist) }}" class="btn btn-primary">戻る</a>
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script>
  $(function() {
    $('#artistic').slider({
      formatter: function(value) {
        return value;
      }
    });
  });

  $(function() {
    $('#exciting').slider({
      formatter: function(value) {
        return value;
      }
    });
  });


  $(function() {
    $('#pop').slider({
      formatter: function(value) {
        return value;
      }
    });
  });

  $(function() {
    $('#fun').slider({
      formatter: function(value) {
        return value;
      }
    });
  });

  </script>
  <script src="/js/radarChart.js"></script>
@endsection
