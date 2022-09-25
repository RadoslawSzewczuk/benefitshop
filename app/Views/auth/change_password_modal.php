<div id="accPassChangeModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p class="modal-heading">Password change</p>
                <div id="passChangeForm" data-action="">
                    <fieldset>
                        <div class="form-item">
                            <div class="form-item-group">
                                <input class="form-control" type="password" id="current_password" name="current_password" placeholder="Old password">
                                <p class="form-error-box"></p>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="form-item-group">
                                <input class="form-control" type="password" id="new_password" name="new_password" placeholder="New password">
                                <p class="form-error-box"></p>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="form-item-group">
                                <input class="form-control" type="password" id="new_password_2" name="new_password_2" placeholder="Repeat new password">
                                <p class="form-error-box"></p>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="modal-footer">
                <div class="modal-footer-buttons-row">
                    <div class="modal-footer-button-col">
                        <button type="button" class="button-modal btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="modal-footer-button-col">
                        <button data-submit type="button" class="button btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function(){

        // change password
        $('#accPassChangeModal .modal-footer [data-submit]').on('click', function(){

            const current_password = $(this).closest('.modal-dialog').find('[name="current_password"]').val();
            const new_password = $(this).closest('.modal-dialog').find('[name="new_password"]').val();
            const new_password_2 = $(this).closest('.modal-dialog').find('[name="new_password_2"]').val();

            $('#accPassChangeModal .form-error-box').hide();
            // loaderFsToggle();

            $.ajax({
                method: 'POST',
                url: '<?= base_url('change_password'); ?>',
                dataType: 'json',
                data: {
                    ['<?= csrf_token() ?>']: '<?= csrf_hash() ?>',
                    'current_password': current_password,
                    'new_password': new_password,
                    'new_password_2': new_password_2
                },
                error: function (response) {
                    console.log('error', response);

                    // loaderFsToggle();
                    notify( "<?= SOMETHING_WENT_WRONG ?>", 1 );
                },
                success: function (response) {
                    // loaderFsToggle();
                    // console.log('succ', response);

                    if( !response.error ){

                        $('#accPassChangeModal ').modal('toggle');
                        notify( response.message );

                        return;
                    } else if( response.error && response.message ){
                        notify( response.message, 1 );
                    }

                    // show error messages
                    $.each( response.error, (key, value) => {
                        $(`#accPassChangeModal [name="${key}"]`).siblings('.form-error-box').text( value ).show();
                    });
                }
            });
        });

    };
</script>