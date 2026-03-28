<?= $this->extend('general_layout') ?>

<?= $this->section('content') ?>
    <?php $validation = session('validation'); ?>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="rounded-5 card p-4 shadow-lg" style="width: 30rem;">
            
            <div class="text-center">
                <img src="<?= base_url('images/pet.png') ?>" alt="login" style="width: 150px;">
            </div>
            <h3 class="text-center mb-3">Sign up</h3>
            <?php if (isset($errors['general'])): ?>
                <p class="error"><?= $errors['general'] ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="example@salle.url.edu" name="email" value="<?= old('email') ?>">
                    <?php if ($validation && $validation->getError('email')): ?>
                        <div class="error">
                            <?= $validation->getError('email') ?>
                        </div>
                    <?php endif; ?>
                </div>


                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="••••••••" name="password">
                    <?php if ($validation && $validation->getError('password')): ?>
                        <div class="error">
                            <?= $validation->getError('password') ?>
                        </div>
                    <?php endif; ?>
                </div>               


                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" placeholder="••••••••" name="confirm_password">
                    <?php if ($validation && $validation->getError('confirm_password')): ?>
                        <div class="error">
                            <?= $validation->getError('confirm_password') ?>
                        </div>
                    <?php endif; ?>
                </div>


                <button id="sign-up-btn" type="submit" class="btn btn-success w-100 main_color" name="action" value="register">Sign up</button>

            </form>

        </div>
    </div>
<?= $this->endSection() ?>