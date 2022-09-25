<div class="table-component">

    <!-- Search -->
    <div class="table-search-container">
        <div class="separator-search">
            <span class="button-icon icon-search"></span>
            <input class="form-control" type="search" name="searchInput" placeholder="<?= $table['search_placeholder'] ?? 'Search...'; ?>" value="<?= $table['search_value'] ?? ''; ?>">
        </div>

        <div class="table-action">
            <span>Add user</span>
        </div>
    </div>


    <!-- Table -->
    <div class="content-table-wrap">
        <div class="content-table">

            <!-- Headings -->
            <div class="content-table-row headings">

                <?php foreach( $table['headers'] ?? [] as $tableHeader ) : ?>
                    <div class="content-table-col">
                        <p>

                            <?php if( empty( $tableHeader['sortable'] ) ) : ?>
                                <?= $tableHeader['title'] ?? '' ?>
                            <?php else : ?>
                                <a href="javascript:void(0);"
                                    <?= empty( $tableHeader['mapped_field'] ) ? '' : 'data-field="' . $tableHeader['title'] . '"' ?>
                                   class="sortHandleButton"
                                   role="button"
                                >
                                    <?= $tableHeader['title'] ?? '' ?><span class="sort-handle"></span>
                                </a>
                            <?php endif; ?>

                        </p>
                    </div>
                <?php endforeach; ?>

            </div>

            <!-- Rows -->
            <?php foreach( $table['data'] ?? [] as $entity ) : ?>
                <div class="content-table-row">

                    <?php foreach( $table['headers'] ?? [] as $tableHeader ) : ?>
                        <div class="content-table-col">
                            <?= get_table_field( $entity, $tableHeader ) ?>
                        </div>
                    <?php endforeach; ?>

                </div>
            <?php endforeach; ?>

        </div>

        <?php if( empty( $table['data'] ) ) : ?>
            <div class="content-table-search-output-text">No results.</div>
        <?php endif; ?>

    </div>


    <!-- Pagination -->
    <div class="pagination">
        <?= $table['pager']->links() ?>
    </div>
</div>

<?php
function get_table_field( array $entity, array $tableHeader ) : string
{
    if( !empty( $tableHeader['type'] ) )
        return get_table_field_based_on_type( $entity, $tableHeader );

    if( !( empty( $tableHeader['mapped_field'] ) || empty( $entity[$tableHeader['mapped_field']] ) ) )
        return $entity[$tableHeader['mapped_field']];

    return '{no-mapped-field}';
}

function get_table_field_based_on_type( array $entity, array $tableHeader ) : string
{
    switch( $tableHeader['type'] ) :

        case 'actions':

            $output = '
                <div class="content-table-link-row">';

            foreach( $tableHeader['actions'] as $action ) :

                if( empty( $action['mods'] ) ) :

                    $data_params = '';
                    if( !empty( $action['data-params'] ) ) :
                        foreach( $action['data-params'] as $data_param ) :
                            $data_params .= ' data-' . $data_param['title'] . '="' . $entity[$data_param['mapped_field']] . '" ';
                        endforeach;
                    endif;

                    $output .= '
                                <div class="content-table-link-item">
                                    <a 
                                        ' . ( empty( $action['blank'] ) ? '' : 'target="_blank" ' ) .
                        'href="' . (
                        empty( $action['url'] )
                            ? 'javascript:void(0);'
                            : replace_action_anchor_url( $action['url'], $entity )
                        ) . '" 
                                        class="content-table-button-link' . (
                        empty( $action['additional-class'] )
                            ? ''
                            : ' ' . $action['additional-class']
                        ) .'"'
                        . $data_params . '
                                    >
                                        <span class="content-table-button-icon ' . $action['icon'] . '"></span>
                                        ' . ( !empty( $action['tooltip'] )
                            ? '<div class="content-table-button-tooltip"><p>' . $action['tooltip'] . '</p></div>'
                            : ''
                        ) . '
                                    </a>
                                </div>
                            ';

                else :

                    switch( $action['mods']['type'] ) :

                        case 'switch':
                            $data = $action['mods']['data'];

                            $data_params = '';
                            if( !empty( $data['data-params'] ) ) :
                                foreach( $data['data-params'] as $data_param ) :
                                    $data_params .= ' data-' . $data_param['title'] . '="' . $entity[$data_param['mapped_field']] . '" ';
                                endforeach;
                            endif;

                            $state_value = (string)$entity[$data['mapped_field']];
                            $state = array_values( array_filter( $data['state'], function( $state ) use ($state_value) {
                                return  $state_value == $state['value'];
                            }));

                            $additional_class   = empty( $state ) ? '' : ( $state[0]['additional-class'] ?? '' );
                            $icon               = empty( $state ) ? '' : ( $state[0]['icon'] ?? '' );
                            $tooltip            = empty( $state ) ? '' : ( $state[0]['tooltip'] ?? '' );
                            $url                = empty( $state ) ? '' : ( $state[0]['url'] ?? '' );

                            $output .= '
                                        <div class="content-table-link-item">
                                            <a 
                                                href="' . ( empty( $url )
                                    ? 'javascript:void(0);'
                                    : replace_action_anchor_url( $url, $entity )
                                ) . '" 
                                                class="content-table-button-link ' . $additional_class  .'"'
                                . $data_params . '
                                            >
                                                <span class="content-table-button-icon ' . $icon . '"></span>
                                                ' . ( !empty( $tooltip )
                                    ? '<div class="content-table-button-tooltip"><p>' . $tooltip . '</p></div>'
                                    : ''
                                ) . '
                                            </a>
                                        </div>
                                    ';

                            break;

                        default:

                    endswitch;

                endif;

            endforeach;

            $output .='
                </div>
            ';

            return $output;

        default:
            return '';
    endswitch;
}

function replace_action_anchor_url( string $url, array $entity ): string
{
    list( $start, $end ) = ['{','}'];

    $string = ' ' . $url;
    $ini = strpos( $string, $start );

    if ($ini == 0)
        return '';

    $ini += strlen( $start );
    $len = strpos( $string, $end, $ini ) - $ini;

    $field_slug = substr( $string, $ini, $len );

    return !empty( $entity[$field_slug] )
        ? str_replace( $start . $field_slug . $end, $entity[$field_slug], $string )
        : '';
}
