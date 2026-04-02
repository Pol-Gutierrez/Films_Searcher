<?= $this->extend('general_layout') ?>

<?= $this->section('content') ?>    
    <div class="pt-4 ps-4">
        <a href="/movies" class="btn btn-success main_color">Back</a>
    </div>
    <div class="container d-flex flex-column align-items-center justify-content-center gap-5 mt-5">    
        <img src="<?= base_url('images/pet.png') ?>" alt="login" style="width: 150px;">

        <h2>Shared Movies</h2>

        <div id="cards-container" class="w-100">
            <div class="container mt-4">
                <div class="row g-4 justify-content-center">
                    <?php if (!empty($shared)): ?>
                        <?php foreach ($shared as $movie): ?>
                            <div class="col-md-4 mt-4">     
                                <div class="card h-100 shadow border-1 rounded-4 bg-black text-light">
                                    <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster'] ?>" style="height: 300px; object-fit: cover;" class="card-img-top rounded-4">

                                    <div class="card-body bg-black text-light">
                                        <h5 class="card-title"><strong><?= $movie['title'] ?></strong></h5>
                                        <h5 class="card-subtitle mb-2 text-info"><?= $movie['year'] ?></h5>
                                        <p class="card-text mt-3"><strong>Shared by:</strong><br><span class="text-light"><?= $movie['username'] ?></span></p>
                                    </div>                    

                                    <a href="/movie/<?= $movie['api_id'] ?>" class="btn btn-success main_color rounded-4">
                                        See more
                                    </a>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center w-100">No favorites yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
