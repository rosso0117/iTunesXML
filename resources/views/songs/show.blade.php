@extends('layouts.app')

@section('content')
  {{-- <div height="300" width="400"> --}}
    {{-- <canvas id="radarChartCanvas" height="210" width="280"></canvas> --}}
  {{-- </div> --}}
  {{ $song->title }}
  @if($reviews)
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
      <td><a href="{{ route('reviews.show', $review) }}" >{{ $review->title }}</a></td>
          </tr>
          <?php $i += 1; ?>
    @endforeach
          </tbody>
        </table>
      </div>
  @endif
  <a href="{{ route('reviews.create') }}" class="btn btn-primary">新規投稿</a>
@endsection
