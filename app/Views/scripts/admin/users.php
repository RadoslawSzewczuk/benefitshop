<script>
    $(function(){

        $('.table-component .table-action').on('click', function(){
            const $modal = $('#addUserModal');
            $modal.find('input').val("");
            $modal.find('select[name="rank"]').val(4);
            $modal.find('select[name="distributors"]').val("").trigger('change');

            $modal.modal('toggle');
        });

        // init select2
        $('select[name="distributors"]').select2({
            placeholder: 'Signed distributors',
            language: {
                "noResults": function () {
                    return "No results.";
                }
            },
            multiple: true,
            minimumResultsForSearch: 1,
            width: '100%',
            allowClear: true,
            ajax: {
                method: 'POST',
                url: '<?= base_url('admin/get_distributors_for_select'); ?>',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    params.page = params.page || 1;
                    return {
                        ['<?= csrf_token() ?>']: '<?= csrf_hash() ?>',
                        keyword: params.term ? params.term : '',
                        pageSize: 20,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // console.log("result", data.result);

                    params.page = params.page || 1;

                    return {
                        results: data.result,
                        page: params.page,
                        pagination: {
                            more: (params.page * 20) < data.counts
                        }
                    };
                }
            }
        });

        $('#addUserModal [data-submit]').on('click', function(){

            let data = {};
            $.each( $('#addUserModal form').serializeArray(), (index, field) => {
                ( 'undefined' == typeof data[field.name] )
                    ? data[field.name] = field.value
                    : data[field.name] = [ ...[].concat( data[field.name] ), field.value ];
            });

            // TODO: validate fields
            // ---------------

            $('#addUserModal .form-error-box').hide();
            // loaderFsToggle();

            $.ajax({
                method: 'POST',
                url: '<?= base_url('admin/add_user'); ?>',
                dataType: 'json',
                data: {
                    ['<?= csrf_token() ?>']: '<?= csrf_hash() ?>',
                    data
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

                        $('#addUserModal ').modal('toggle');
                        notify( response.message );

                        return;
                    } else if( response.error && response.message ){
                        notify( response.message, 1 );
                    }

                    // show error messages
                    $.each( response.error, (key, value) => {
                        $(`#addUserModal [name="${key}"]`).siblings('.form-error-box').text( value ).show();
                    });
                }
            });
        });
    });
</script>