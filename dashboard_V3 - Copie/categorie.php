<?php
include_once 'header.php'
?>

            <div class="" style="padding-top: 8rem;">
                <div class="card">
                    <div class="card-header border-bottom" style="background-color: white;margin-bottom: 1rem;">
                        <div class=" d-flex justify-content-between">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0" >All Users</h5>
                            </div>
                            <div class="justify-content-end">
                                <button class="btn  add-btn rounded-pill btn-success px-lg-3" id="add-btn"><i class="uil-plus mr-2"></i>Add User</button>
                            </div>
                        </div>
                    </div>
                    <table id="users-table" class="display">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>username</th>
                                <th>email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: white;">
                        </tbody>
                    </table>
                </div>    
            </div>
    </section>

    <div class="modal" tabindex="-1" role="dialog" id="add-update-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="users-fields">
                    <form>
                        <div class="form-group">
                            <label for="name-input">Name</label>
                            <input type="text" class="form-control" id="name-input" name="name[]">
                        </div>
                        <div class="form-group">
                            <label for="email-input">Email</label>
                            <input type="email" class="form-control" id="email-input" name="email[]">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="add-user-btn"> + User</button>
                    <button type="button" class="btn btn-primary" id="save-btn">Save</button>
                    <button type="button" class="btn btn-primary" id="update-btn">Update</button>
                </div>
            </div>
        </div>
    </div>

<?php
include_once 'footer.php'
?>