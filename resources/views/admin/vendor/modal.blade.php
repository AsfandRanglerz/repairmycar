<!-- Comment Edit Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editStudentModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rejection Reason</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-comment" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="id" id="edit_stud_id" class="form-control">
                            <input type="text" name="comment" id="edit_comment" class="form-control"
                                placeholder="Reason For Rejection">
                        </div>
                    </div>
                    <a class="btn btn-primary update_student mt-2 btn-bg text-white a-disabled" style="cursor: pointer" disabled>Send <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></a>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!--Comment edit Modal End-->
