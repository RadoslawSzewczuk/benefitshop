<!-- excluded routes -->
<?php if( !in_array( uri_string() , SCRIPT_EXCLUDED_ROUTES ) ) : ?>

    <script src="<?=base_url('/assets/js/libraries/jquery.min.js')?>"></script>
    <script src="<?=base_url('/assets/js/libraries/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('/assets/js/libraries/select2.full.min.js')?>"></script>

    <script src="<?=base_url('/assets/js/component_table.js')?>"></script>

    <script src="<?=base_url('/assets/js/scripts.js')?>"></script>
    <script src="<?=base_url('/assets/js/test.js')?>"></script>
    <script src="<?=base_url('/assets/js/custom.js')?>"></script>

<?php endif; ?>