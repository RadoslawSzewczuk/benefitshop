$(function (){

    // table search input event
    $('.table-component input[name="searchInput"]').on('keypress', (e) => {
        if (13 !== e.which)
            return;

        const urlParams = new URLSearchParams( window.location.search ),
            prevSeaachValue = urlParams.get('search');

        if ( '' === $(e.currentTarget).val() && !prevSeaachValue )
            return;

        window.location.search = $(e.currentTarget).val() ? `?search=${ encodeURIComponent($(e.currentTarget).val()) }` : '';
    });

    // table pagination events
    $('[data-page]').not('.dots, .active').on('click', function(){
        let page = $(this).data('page'),
            $pagination = $(this).closest('.content-table-pagination'),
            currentPage = parseInt( $pagination.find('li.active>a').data('page') );

        if ( 'prev' === page ) {
            if ( 1 === currentPage )
                return;

            page = --currentPage;
        }

        if ( 'next' === page ) {
            if( currentPage === parseInt( $(this).prev().data('page') ) )
                return;

            page = ++currentPage;
        }

        let urlParams = new URLSearchParams(window.location.search);
        urlParams.set('page', page);

        window.location.search = `?${urlParams.toString()}`
    });

    // table sorting events
    $('.table-component a.sortHandleButton[data-field]').on('click', function(){

        let urlParams = new URLSearchParams(window.location.search),
            field = $(this).data('field');

        urlParams.get('order_by') !== field
            ? urlParams.set('order_by', field)
            : urlParams.get('reversed')
                ? urlParams.delete('reversed')
                : urlParams.set('reversed', 'true');

        window.location.search = `?${urlParams.toString()}`
    });
});