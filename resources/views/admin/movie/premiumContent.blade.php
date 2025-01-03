<div class="modal-body" id="premiumContentForm">
    <form action="javascript:;" id="premiumForm">
        <input type="text" value="{{@$movieId ?? null}}" name="movie_id" hidden id="movieId">
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="is_premium" id="is_premium"  value="1" {{@$premiumContent->is_premium=='1' ? 'checked':''}}>
            <label class="form-check-label" for="is_premium">Is Premium</label>
            <span class="text-danger is_premiumError"  hidden></span>
        </div>
        
        <div class="form-group">
          <label for="from">Price</label>
          <input type="number" min="1" class="form-control" name="price" id="price" value="{{@$premiumContent->price}}">
          <small id="emailHelp" class="form-text text-muted">Price must be in $.</small>
          <span class="text-danger priceError"  hidden></span>
        </div>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" name="duration" id="duration"  value="yes" {{@$premiumContent->duration=='yes' ? 'checked':''}}>
          <label class="form-check-label" for="duration">Duration</label>
        </div>
        <div id="durationData" {{@$premiumContent->duration=='yes' ? '':'hidden'}}>
          <div class="form-group">
            <label for="from">From Date</label>
            <input type="date" class="form-control" name="from" id="from" value="{{@$premiumContent->from}}">
            <span class="text-danger fromError"  hidden></span>
          </div>
          <div class="form-group">
            <label for="to">To Date</label>
            <input type="date" class="form-control" name="to" id="to" value="{{@$premiumContent->to}}">
            <span class="text-danger toError"  hidden></span>
          </div>
        </div>
      
</div>