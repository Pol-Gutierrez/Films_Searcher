<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Films Searcher</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="<?= base_url('styles.css') ?>">
    </head>

    <body class="bg-image" style="background-image: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), url('https://image.tmdb.org/t/p/original<?= $data['backdrop_path'] ?>');">
        <?php $errors = session('errors'); ?>
        <div class="pt-4 ps-4">
            <a href="/movies" class="btn btn-success main_color">Back</a>
        </div>
        <div class="card container bg-black mt-3">
            <div class="d-flex w-100 p-4 gap-3">
                <?php if (empty($data['error'])): ?>
                    <div class="d-flex flex-column gap-4">
                        <div>
                            <?php if (!empty($data['poster_path'])): ?>
                                <img src="https://image.tmdb.org/t/p/w500<?= $data['poster_path']?>" class="img-fluid rounded" alt="Poster">
                                
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-between">
                            <form method="POST" action="/favorites"> 
                                <input type="hidden" name="movie_id" value="<?= $data['id'] ?>">                               
                                <button class="btn btn-success main_color" name="action" value="<?= $btnText ?>"><?= $btnText ?></button>
                            </form>
                            <form method="POST" action="/shared">    
                                <input type="hidden" name="movie_id" value="<?= $data['id'] ?>">                            
                                <button class="btn btn-success main_color" name="action" value="btn">Share</button>
                            </form>                   
                        </div>
                    </div>
            
                    <div class="card bg-dark text-white w-100">
                        <div class="d-flex flex-column justify-content-between card-body">
                            <div class="d-flex gap-3 align-items-center mb-3">
                                <h5 class="display-3 fw-bold m-0"><?= $data['title']?></h5>
                                <h6 class="display-6 m-0">(<?= $data['release_date']?>)</h6>
                            </div>

                            <div class="container text-center">
                                <div class="row">
                                    <?php foreach ($data['genres'] as $genre): ?>
                                        <div class="col">
                                            <span class="badge bg-secondary"><?= $genre['name'] ?></span>
                                        </div>
                                    <?php endforeach; ?>                                
                                </div>
                            </div>
                
                            <div>
                                <p class="fw-bold mt-4 mb-1">Overview</p>
                                <p><?= $data['overview']?></p>                        
                            </div>

                            <div class="container text-center">
                                <div class="row">
                                    <div class="col">
                                        <?php foreach ($data['credits']['crew'] as $member): ?>
                                            <?php if ($member['job'] === 'Director'): ?>
                                                <p><strong>Director:</strong> <?= $member['name'] ?></p>
                                            <?php endif; ?>
                                        <?php endforeach; ?>                               
                                    </div>

                                    <?php 
                                        $limit = 5;
                                        $count = 0;
                                    ?>

                                    <div class="col">
                                        <p><strong>Actors:</strong></p>
                                        <?php foreach ($data['credits']['cast'] as $actor): ?>
                                            <?php if ($count >= $limit) break; ?>
                                            <ul>
                                                <li><?= $actor['name'] ?></li>
                                            </ul>
                                            <?php $count++; ?>
                                        <?php endforeach; ?>
                                       
                                    </div>                                                                           
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <?php else: ?>
                    <p><?= $data['error'] ?></p>
                <?php endif; ?>              
            </div>
        </div>

        <div class="card bg-dark text-white mt-4 p-4">
            <h4 class="mb-3">Comments</h4>
            
            <!-- form to add a new comment -->
            <form method="POST" action="/movie/<?= $data['id'] ?>">
                <div class="mb-3">
                    <label class="form-label">Your comment</label>
                    <textarea class="form-control bg-secondary text-white" name="comment" rows="3" required></textarea>
                    <?php if (isset($errors['comment'])): ?>
                        <p class="error"><?= $errors['comment'] ?></p> 
                    <?php endif; ?>                
                    <?php if (isset($errors['success'])): ?>
                        <div class="text-success"><?= esc($errors['success']) ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-success main_color">Submit</button>
            </form>

            <hr class="border-secondary my-4">

            <!-- list of comments -->
            <div class="d-flex flex-column gap-3">

                <?php if (empty($comments)): ?>
                    <p>No comments yet. Be the first to comment!</p>
                <?php else: ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="d-flex gap-3">                        
                            <img src="<?= base_url('images/profile.png') ?>" 
                                class="rounded-circle" width="50" height="50">
                            <div>
                                <h6 class="m-0 fw-bold"><?= $comment['username'] ?></h6>
                                <small class="text-secondary"><?= $comment['created_at'] ?></small>
                                <p class="m-0 mt-1"><?= $comment['comment'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>    
                <?php endif; ?>                  
            </div>
        </div>
    </body>
</html>