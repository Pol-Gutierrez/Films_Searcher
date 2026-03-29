<?= $this->extend('general_layout') ?>

<?= $this->section('content') ?>
    <?php $validation = session('validation'); ?>
    <?php $errors = session('errors'); ?>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="rounded-5 card p-4 shadow-lg" style="width: 30rem;">
            
            <div class="text-center">
                <img src="<?= base_url('images/pet.png') ?>" alt="login" style="width: 150px;">
            </div>
            <h3 class="text-center mb-3">Sign In</h3>
            <?php if (isset($errors['general'])): ?>
                <p class="error"><?= $errors['general'] ?></p>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="example@gmail.com" name="email" value="<?= old('email') ?>">
                </div>
                <?php if (isset($errors['email'])): ?>
                    <p class="error"><?= $errors['email'] ?></p>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="••••••••" name="password">
                </div>           
                <?php if (isset($errors['password'])): ?>
                    <p class="error"><?= $errors['password'] ?></p>
                <?php endif; ?>                  

                <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="submit" class="btn btn-success w-100 main_color" name="action" value="sign_in">Log in</button>
                    <button type="submit" class="btn btn-success w-100 main_color" name="action" value="sign_up">Sign up</button>
                </div>

            </form>

        </div>
    </div>
<?= $this->endSection() ?>