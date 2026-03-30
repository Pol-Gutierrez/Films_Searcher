<?= $this->extend('general_layout') ?>

<?= $this->section('content') ?>
    <div class="container position-relative">
        <form action="favorites.php" method="POST">
            <input type="hidden" name="return_url" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
            <button class="btn btn-succes position-absolute top-20 start-10 translate-middle main_color" name="action">See favorites</button>
        </form>
        <a href="/logout"class="btn btn-succes position-absolute top-20 start-100 translate-middle main_color">Logout</a>
    </div>
        
    <div class="container d-flex flex-column align-items-center justify-content-center gap-5 mt-5">
        <img src="<?= base_url('images/pet.png') ?>" alt="login" style="width: 150px;">

        <div class="search-container" style="width: 100%; max-width: 400px;">
            <form method="GET" action="/movies">
                <input type="text" name="searchbar" id="searchbar" class="form-control search-input" placeholder="Search...">
            </form>
        </div>

        <div id="cards-container" class="w-100">
            <div class="container mt-4">
                <div class="row g-4 justify-content-center">
                    <?php if (empty($data['error'])): ?>
                        <?php if (!empty($data['results'])): ?>
                            <?php foreach ($data['results'] as $movie): ?>
                                <div class="col-md-4 mt-4">     
                                    <div class="card h-100 shadow border-1 rounded-4">
                                        <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path'] ?>" style="height: 300px; object-fit: cover;" class="card-img-top rounded-4" alt="Imagen receta">

                                        <div class="card-body">
                                            <h5 class="card-title"><?= $movie['title'] ?></h5>
                                            <h5 class="card-subtitle mb-2 text-muted"><?= $movie['release_date'] ?></h5>
                                            <p class="card-text"><strong>Overview:<br></strong> <?= $movie['overview'] ?></p>
                                        </div>                    

                                        <a href="recipe.php?id=<?= $movie['id'] ?>&return=<?= urlencode($_SERVER['REQUEST_URI']) ?>" class="btn btn-success main_color rounded-4">
                                            See more
                                        </a>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center w-100">No results were found.</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="text-center w-100"><?= $data['error'] ?></p>
                    <?php endif; ?>                                
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>