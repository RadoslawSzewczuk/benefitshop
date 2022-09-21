<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(1);

?>

<nav class="content-table-pagination" aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination">

        <?php if( $pager->hasPreviousPage() ) : ?>

            <li>
                <a href="javascript:void(0);" data-page="prev" aria-label="<?= lang('Pager.previous') ?>">
                    <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
                </a>
            </li>

            <?php if( $pager->getFirstPageNumber() >= 2 ) : ?>

                <li>
                    <a href="javascript:void(0);" data-page="1">
                        <?= 1 ?>
                    </a>
                </li>

                <?php if( $pager->getFirstPageNumber() >= 3 ) : ?>
                    <li class="dots">
                        <a href="javascript:void(0);">
                            ...
                        </a>
                    </li>
                <?php endif; ?>

            <?php endif; ?>

        <?php endif; ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li <?= $link['active'] ? 'class="active"' : '' ?>>
                <a href="javascript:void(0);" data-page="<?= $link['title'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if( $pager->hasNextPage() ) : ?>

            <?php if( $pager->getPageCount() - $pager->getLastPageNumber() >= 1 ) : ?>

                <?php if( $pager->getPageCount() - $pager->getLastPageNumber() >= 2 ) : ?>
                    <li class="dots">
                        <a href="javascript:void(0);">
                            ...
                        </a>
                    </li>
                <?php endif; ?>

                <li>
                    <a href="javascript:void(0);" data-page="<?= $pager->getPageCount() ?>">
                        <?= $pager->getPageCount() ?>
                    </a>
                </li>

            <?php endif; ?>

            <li>
                <a href="javascript:void(0);" data-page="next"  aria-label="<?= lang('Pager.next') ?>">
                    <span aria-hidden="true"><?= lang('Pager.next') ?></span>
                </a>
            </li>

        <?php endif; ?>

    </ul>
</nav>
