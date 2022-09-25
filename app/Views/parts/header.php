<?php

use App\Libraries\Breadcrumb;

?>
<!-- Navbar -->
<header>
    <nav class="navbar-wrapper">
        <div class="navbar-container">
            <div class="navbar-row">

                <!-- Navbar logo -->
                <div class="navbar-logo hoverable-logo">
                    <a href="<?= base_url() ?>">
                        <h1>
                            <img style="max-width: 40px;" src="<?= base_url('/assets/images/logo.svg') ?>" alt="Logo">
                        </h1>
                    </a>
                </div>

                <!-- Navbar content -->
                <div class="navbar-content">
                    <div class="navbar-content-row">

                        <div class="navbar-items hide-mobile">
                            <ul class="navbar-items-wrap">
                                <li>
                                    <a href="javascript:void(0);">
                                        <span class="button-icon icon-rocket no-margin"></span>
                                    </a>
                                </li>
                                <li>
                                    <a onclick="$('#accPassChangeModal input').val('');$('#accPassChangeModal').modal('toggle');" href="javascript:void(0);">
                                        Change password
                                    </a>
                                </li>
                                <li class="button-logout">
                                    <a href="<?= base_url('logout') ?>">
                                        <span class="button-icon icon-logout"></span>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Toggler -->
                        <div class="navbar-toggler-nobs">
                            <div class="toggler-bar"></div>
                            <div class="toggler-bar"></div>
                            <div class="toggler-bar"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
