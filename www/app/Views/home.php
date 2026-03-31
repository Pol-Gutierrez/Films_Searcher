<?= $this->extend('general_layout') ?>

<?= $this->section('content') ?>
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-dark header_custom">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">🎬 MovieVerse</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navMenu">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                        <form action="" method="POST" class="d-flex gap-2">
                            <button class="btn btn-outline-light" type="submit" id="sign_up" name="action" value="sign_up">Sign up</button>
                            <button class="btn btn-outline-light" type="submit" id="sign_in" name="action" value="sign_in">Sign in</button>
                        </form>
                    </ul>
                </div>
            </div>
        </nav>

        <header class="py-5 text-center bg-dark">
            <div class="container">
                <div class="d-flex align-items-center justify-content-center">
                    <h1 class="display-4 fw-bold">Hello <?php echo isset($name) ? $name : 'Stranger'; ?></h1>
                    <img src="<?= base_url('images/pet.png') ?>" alt="login" style="width: 150px;">
                </div>
                <p class="lead mt-4">Explore new releases, classics, and personalized recommendations</p>
            </div>
        </header>

        <section class="container">
            <h2 class="mb-4">✨ Featured Movies</h2>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card bg-black text-light">
                        <img class="card-img-top" src="<?= base_url('images/movie4.png') ?>" alt="Movie">
                        <div class="card-body">
                            <h5 class="card-title">The City of Whispers</h5>
                            <p class="card-text">A shy young girl discovers a hidden city deep within the 
                                foundations of a bustling metropolis. There, the inhabitants are beings made entirely of paper, 
                                and their histories are told only in hushed tones, as if they were precious secrets.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card bg-black text-light">
                        <img class="card-img-top" src="<?= base_url('images/movie2.png') ?>" alt="Movie">
                        <div class="card-body">
                            <h5 class="card-title">The Wandering Stars</h5>
                            <p class="card-text">Two children—a boy and a girl—pilot a small, makeshift airship through a vast sea of clouds. 
                                Their mission is to find the "Wandering Stars," ancient fragments of power that are the only hope to save their 
                                world from an encroaching darkness.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container my-5">
            <h2 class="mb-4">🔥 Trending Now</h2>

            <div class="row row-cols-2 row-cols-md-4 g-4">
                <div class="col">
                    <div class="card bg-black text-light h-100">
                        <img class="card-img-top" src="<?= base_url('images/movie4.png') ?>" alt="Movie">
                        <div class="card-body">
                            <h6 class="card-title">The City of Whispers</h6>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card bg-black text-light h-100">
                        <img class="card-img-top" src="<?= base_url('images/movie3.png') ?>" alt="Movie">
                        <div class="card-body">
                            <h6 class="card-title">Song of the Iron Whale</h6>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card bg-black text-light h-100">
                        <img class="card-img-top" src="<?= base_url('images/movie1.png') ?>" alt="Movie">
                        <div class="card-body">
                            <h6 class="card-title">The Wind That Weaves Tales</h6>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card bg-black text-light h-100">
                        <img class="card-img-top" src="<?= base_url('images/movie2.png') ?>" alt="Movie">
                        <div class="card-body">
                            <h6 class="card-title">The Wandering Stars</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="py-4 bg-black text-center">
            <p class="mb-0">© 2026 MovieVerse — Films Project</p>
        </footer>

<?= $this->endSection() ?>


