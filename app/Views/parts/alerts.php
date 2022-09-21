<script>

    // notifications
    function notify( msg, error = false, timeout = 3000 )
    {
        let random_id = 1 + Math.floor(Math.random() * 1000000),
            output = `<div id="${random_id}" class="notification-item notification-${error ? 'bad' : 'good'}"><p>${msg}</p></div`,
            $notify_wrapper = $('.notifications-wrapper'),
            $notify_container = $('.notifications-wrapper .notification-items');

        $notify_container.append( output );

        if( !$notify_wrapper.is(':visible') )
            $notify_wrapper.show();

        setTimeout(function(){

            $(`#${random_id}`).fadeOut();
            setTimeout(function(){
                $(`#${random_id}`).remove();

                if( !$notify_container.find('.notification-item').length )
                    $notify_wrapper.hide();

            }, 400);

        }, timeout);
    }

    document.addEventListener("DOMContentLoaded", function(){

        function parse_data( $data )
        {
            if( !$data )
                return "";

            return JSON.parse( $data );
        }

        const notification_errors = parse_data('<?= empty( session()->getFlashdata('notification_errors') ) ? "" : json_encode( session()->getFlashdata('notification_errors') ) ?>');
        const notification_success = parse_data('<?= empty( session()->getFlashdata('notification_success') ) ? "" : json_encode( session()->getFlashdata('notification_success') ) ?>');

        // console.log('notification_errors', notification_errors);
        // console.log('notification_success', notification_success);

        if( notification_success ){
            $.each( notification_success, (key, msg)=>{
                if( 'notification' === key )
                    notify( msg );
            });
        }

        if( notification_errors ){

            let scrolled_to_first_error_msg = false;
            $.each( notification_errors, (key, msg) => {

                if( 'notification' === key ){
                    notify( msg, 1);

                    return; // equvalent of continue;
                }

                if( key.includes(".") ){
                    let key_parts = key.split("."),
                        closing_brackets = "";

                    key = "";
                    $.each( key_parts, (index, part) => {
                        key += index ? `[${part}` : part;
                        closing_brackets += index ? "]" : "";
                    });
                    key += closing_brackets;
                }

                // ewentualnie switch dla przypadkow od rodzaju pola
                let $field = $(`[name="${key}"]`);
                $field.siblings('.form-error-box').text(msg).show();

                if( !scrolled_to_first_error_msg ){
                    scrolled_to_first_error_msg = true;

                    $([document.documentElement, document.body]).animate({
                        scrollTop: $field.offset().top
                    }, 500);
                }
            });

        }
    });
</script>