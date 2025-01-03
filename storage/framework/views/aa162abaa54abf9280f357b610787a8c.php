<div class="modal-content" id="formHtmlAppend">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Theater Setup</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="javascript:;" method="post" id="timeSlotForm">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item mr-4" role="presentation">
                    <button class="nav-link active link1" id="pills-home-tab" data-toggle="pill" data-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true">Theater Date
                        SetUp</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link link2" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Theater Date
                        Edit</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active datesViewHide" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                        

                        <div class="col-md-12 mb-4">
                            <label for="shows_number">Select Show Date</label>
                            <input name='date_range' class="form-control" id='cal' required readonly
                                data-toggle="tooltip" data-placement="top" title="Select a date range" />
                            <span class="text-danger" hidden id="date_rangeError"></span>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="shows_number">Total Shows</label>
                            <input name='shows_number' type="number" class="form-control" id='shows_number'
                                placeholder="Enter Total Shows For Per Day" oninput="setShowsCount(this)" required />
                            <span class="text-danger" hidden id="shows_numberError"></span>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label for="shows_number">Set Time</label>
                            <div id="timeZoneHtml">

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="setShowsForm">Save changes</button>
                    </div>
    </form>
</div>

<div class="tab-pane fade datesViewShow" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    
</div>
</div>
</div>


</div>

<?php /**PATH C:\xampp\htdocs\nextcinemas\nextcinemas\resources\views/admin/movietheater/slotformblade.blade.php ENDPATH**/ ?>