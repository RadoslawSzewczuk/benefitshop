<!-- Sidebar -->
<div class="sidebar-wrap col-md-3">

    <div class="separator">
        <div class="separator-text"><?= isAdmin() ? 'Admin' : 'User' ?></div>
    </div>

    <?php if( !empty( $menu_items = get_sidebar_menu() ) ) : ?>
        <ul>
            <?php foreach( $menu_items as $menu_item ) : ?>

                <li>
                    <a class="sidebar-item" href="<?= base_url( $menu_item['route'] ) ?>"><?= $menu_item['title'] ?></a>
                </li>

            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</div>