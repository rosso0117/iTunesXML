@extends('layouts.app')

@section('content')
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('reviews.store') }}" method="post">
    {{ csrf_field() }}
    <div class="row">
      <div class="form-group col-sm-6">
        <label for="title">タイトル</label>
        <input type="text" class="form-control" name="title" id="title">
      </div>
    </div>
    <div class="form-group">
      <div class="row">
        <label for="body">レビュー</label>
      </div>
      <textarea name="body" id="body" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="artistic">芸術的</label>
      </div>
      <input id="artistic" type="text" name="artistic" data-slider-id="volumeSlider" data-slider-min="0" data-slider-max="5" data-slider-step="1" data-slider-value="3" />
    </div>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="exciting">エキサイティング</label>
      </div>
      <input id="exciting" type="text" name="exciting" data-slider-id="volumeSlider" data-slider-min="0" data-slider-max="5" data-slider-step="1" data-slider-value="3" />
    </div>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="pop">ポップ</label>
      </div>
      <input id="pop" type="text" name="pop" data-slider-id="volumeSlider" data-slider-min="0" data-slider-max="5" data-slider-step="1" data-slider-value="3" />
    </div>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="fun">楽しい</label>
      </div>
      <input id="fun" type="text" name="fun" data-slider-id="volumeSlider" data-slider-min="0" data-slider-max="5" data-slider-step="1" data-slider-value="3" />
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
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
@endsection
