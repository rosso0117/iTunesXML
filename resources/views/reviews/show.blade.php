@extends('layouts.app')

@section('content')
  <div class="modal fade" id="calcModal" tabindex="-1" role="dialog" aria-labelledby="calcLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="閉じる"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="calcLabel">計算結果</h4>
        </div>
        <div class="modal-body">
          <div id="resultText" class="col-sm-10 col-sm-offset-2"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.modal -->
@endsection
