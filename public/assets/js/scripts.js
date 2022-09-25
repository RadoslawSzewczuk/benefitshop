$(function(){
    $(document).on('click', '.modal-dialog button[data-dismiss]', function(){
        $(this).closest('.modal').modal('toggle');
    });
});