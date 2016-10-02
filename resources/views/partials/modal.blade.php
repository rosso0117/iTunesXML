<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="reviewLabel">レビュー</h4>
      </div>
      <div class="modal-body">
        <canvas id="radarChartCanvas" width="210" height="280">
        <script id="radarChartScript" src="/js/radarChart.js" review-jsons=" <?php $review_jsons; ?>">
        </script>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->
