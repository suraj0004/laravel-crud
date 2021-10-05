<div class="modal-body mx-3">
    <div class="modal fade" id="modalEditSubjectForm">
        <div class="modal-dialog modal-xl">
            <div class="modal-content popup">
                <div class="modal-header popup-header">
                    <h4 class="modal-title popup-header-title">Add Subject </h4>
                    <button type="button" class="close popup-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_subject_form" method="POST" action="{{ route('subject.update',['id' => ':id']) }}">
                        @csrf
                        <div class="row m-2" id="edit_info_response">
                            <div class="col-md-12 ">
                                <div class="card card-primary card-outline h-100 modal-main-card">
                                    <div class="card-body box-profile modal-main-box-profile">

                                        <div class="form-group row mt-2">
                                            <label for="edit_title" class="col col-form-label col-md-3 col-12">Subject Title
                                                <span class="text-danger">*</span> </label>
                                            <div class="col col-md-9 col-12">
                                                <input type="text" class="form-control" name="title" id="edit_title"
                                                    placeholder="Subject Title" >
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="edit_name" class="col col-form-label col-md-3 col-12">Subject Name
                                                <span class="text-danger">*</span> </label>
                                            <div class="col col-md-9 col-12">
                                                <input type="text" class="form-control" name="name" id="edit_name"
                                                    placeholder="Subject Name" >
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="edit_description" class="col col-form-label col-md-3 col-12">Subject
                                                Description <span class="text-danger">*</span> </label>
                                            <div class="col col-md-9 col-12">
                                                <textarea class="form-control" name="description" id="edit_description"
                                                    placeholder="Subject Description" ></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="text-center">
                            <span id="edit_subject_error" class=" p-1  text-center text-danger modal-clear"> </span>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-4"></div>
                            <div class="col-md-4 d-flex justify-content-center">
                                <button type="submit" id="edit_subject_submit_btn"
                                    class="btn btn-primary btn-md btn-block subject_btn"> Add </button>
                                <div class="spinner-border text-success mlaLoader" role="status"
                                    id="edit_subject_loader">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
