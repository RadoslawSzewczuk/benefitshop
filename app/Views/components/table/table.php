<div class="table-component">

    <!-- Search -->
    <div class="table-search-container">
        <div class="separator-search">
            <span class="button-icon icon-search"></span>
            <input type="search" name="searchInput" placeholder="<?= $table['search_placeholder'] ?? 'Szukaj...'; ?>" value="<?= $table['search_value'] ?? ''; ?>">
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
            <div class="content-table-search-output-text">Brak wyników</div>
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
    $output = '';

    if( !( empty( $tableHeader['mapped_field'] ) || empty( $entity[$tableHeader['mapped_field']] ) ) )
        $output .= $entity[$tableHeader['mapped_field']];

    return $output;
}
