<?= $this->extend('empty') ?>

<?= $this->section('content') ?>

<div class="login-form-col">
    <?= form_open('login', ['class' => 'login-form']); ?>
        <fieldset class="form-group">
            <h2 class="login-form-heading">
                Login
            </h2>

            <div class="form-item">
                <div class="form-item-group">
                    <input class="form-control" type="email" id="email" name="email" placeholder="E-mail address">
                    <p class="form-error-box"></p>
                </div>
            </div>
            <div class="form-item">
                <div class="form-item-group">
                    <input class="form-control" type="password" id="password" name="password" autocomplete="new-password" placeholder="Password">
                    <p class="form-error-box"></p>
                </div>
            </div>
            <div class="form-item double">
                <div class="form-item-group">
                    <div class="login-checkbox-wrap">
                        <label class="circle-checkbox" for="remember">
                            <input type="checkbox" id="remember" name="remember" value="1"/>
                            <div class="circle-checkbox-visuals"></div>
                            <p class="circle-checkbox-desc">
                                Remember me
                            </p>
                        </label>
                    </div>
                </div>
                <div class="form-item-group">
                    <a href="<?= base_url('remind_password') ?>" class="regular-link color-blue-6">Forgot your password?</a>
                </div>
            </div>

            <div class="form-item larger-margin">
                <div class="form-item-group login-button-wrapper">
                    <button class="button btn btn-light" type="submit" role="button">
                        Login
                    </button>
                </div>
            </div>

        </fieldset>
    <?= form_close() ?>
</div>

<?= $this->endSection() ?>
