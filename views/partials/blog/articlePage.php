<?php
include "../../../config/connect.php";
require_once '../../../includes/session_check.php';
require_once '../../../models/Article.php';
require_once '../../../models/comment.php';
require_once '../../../models/tag.php';

$comment = new Comment();
$articles = new article();
$tag = new tag();


echo "<pre>";
print_r($_GET);
echo "</pre>";


if (isset($_GET['art_id']) && isset($_GET['user_id'])) {
    $art_id = $_GET['art_id'];
    
    $setArt = $articles->getArticleById($art_id);

    $user = $articles['user_id'];
    
    $tags = $tag->getTagsForArticle($art_id);
}


if (isset($_POST['content']) && isset($_POST['art_id'])) {
    $art_id = $_GET['art_id'];

    $user_id = $_SESSION['user_id'];

    if ($comment->addComment($content, $art_id, $user_id)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Post | Royal Cars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary-color: #FF4D30;
            --dark-bg: #191C24;
            --secondary-text: #6C757D;
        }

        body {
            background-color: #F8F9FA;
        }

        .navbar {
            background-color: var(--dark-bg);
        }

        .navbar-brand {
            color: var(--primary-color) !important;
            font-weight: bold;
            font-size: 24px;
        }

        .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .post-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .tag {
            background-color: #E9ECEF;
            color: var(--secondary-text);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.875rem;
            margin-right: 8px;
            margin-bottom: 8px;
            display: inline-block;
        }

        .create-post-btn {
            background-color: var(--primary-color);
            border: none;
            color: white;
        }

        .create-post-btn:hover {
            background-color: #ff2c06;
            color: white;
        }

        .footer {
            background-color: var(--dark-bg);
            color: white;
        }

        .social-link {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            border-radius: 4px;
            margin-right: 8px;
        }

        .social-link:hover {
            background: var(--primary-color);
            color: white;
        }

        .gallery-img {
            aspect-ratio: 1;
            object-fit: cover;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <!-- Topbar -->
    <div class="bg-dark py-2 d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-start">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-secondary me-3" href="tel:+212693305050">
                            <i class="fas fa-phone-alt me-2"></i>+212 6933 05050
                        </a>
                        <span class="text-secondary">|</span>
                        <a class="text-secondary ms-3" href="mailto:jadthegamer06@gmail.com">
                            <i class="fas fa-envelope me-2"></i>jadthegamer06@gmail.com
                        </a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-secondary px-3" href="#"><i class="fab fa-github"></i></a>
                        <a class="text-secondary px-3" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="text-secondary px-3" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="text-secondary px-3" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">ROYAL CARS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <button class="btn create-post-btn" data-bs-toggle="modal" data-bs-target="#createPostModal">
                            Create Post
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row">
            <!-- Main Post Column -->
            <div class="col-lg-8">
                <article class="post-card p-4 mb-4">
                    <h1 class="h3 mb-3"><?= $setArt['title'] ?></h1>
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Author avatar">
                        <div>
                            <div class="fw-bold"><?= $user['author_name'] ?></div>
                            <div class="text-muted small">Posted: <?= $setArt['creation_date'] ?></div>
                        </div>
                    </div>
                    <img src="https://via.placeholder.com/800x400" class="img-fluid rounded mb-3" alt="Post image">
                    <p><?= $setArt['content'] ?></p>
                    <div class="d-flex gap-2 mb-3">
                        <?php foreach ($tags as $tag) {
                            echo "<span>" . htmlspecialchars($tag['nom']) . "</span>";
                        } ?>
                    </div>
                    <hr>
                    <div class="d-flex gap-3">
                        <button class="btn btn-light btn-sm">
                            <i class="far fa-comment me-1"></i> 24 Comments
                        </button>
                        <button class="btn btn-light btn-sm">
                            <i class="fas fa-share me-1"></i> Share
                        </button>
                    </div>
                </article>

                <!-- Comments Section -->
                <div class="comment-section  p-4">
                    <h3 class="h5 mb-4">Comments</h3>
                    <form class="mb-4" method="POST">
                        <textarea class="form-control mb-3" rows="3" name="content" placeholder="Write a comment..."></textarea>
                        <button type="submit" class="btn create-post-btn">Post Comment</button>
                    </form>

                    <?php
                    $comment = new Comment();
                    $art_id = $_GET['art_id'];

                    $comments = $comment->getCommentsByArticle($art_id);
                    if (empty($comments)) {
                        echo '<p>No comments yet. Be the first to comment!</p>';
                    } else {
                        foreach ($comments as $comment):
                    ?>
                            <div class="comment mb-4">
                                <div class="d-flex mb-3">
                                    <img src="https://via.placeholder.com/32" class="rounded-circle me-2" alt="User avatar">
                                    <div>
                                        <div class="fw-bold"><?= $comment['author_name'] ?></div>
                                        <div class="text-muted small">Posted on: <?= $comment['creation_date'] ?></div>
                                    </div>
                                </div>
                                <p class="mb-2"><?= $comment['content'] ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php } ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="post-card p-4 mb-4">
                    <h4 class="h5 mb-3">Popular Tags</h4>
                    <div>
                        <span class="tag">#WebDev</span>
                        <span class="tag">#JavaScript</span>
                        <span class="tag">#Tutorial</span>
                        <span class="tag">#Programming</span>
                        <span class="tag">#React</span>
                        <span class="tag">#NodeJS</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Post Modal -->
    <div class="modal fade" id="createPostModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create a Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="createPostForm">
                        <div class="mb-3">
                            <label for="postTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="postTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="postContent" class="form-label">Content</label>
                            <textarea class="form-control" id="postContent" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="postTags" class="form-label">Tags</label>
                            <input type="text" class="form-control" id="postTags" placeholder="Separate tags with commas">
                        </div>
                        <div class="mb-3">
                            <label for="postImage" class="form-label">Image (optional)</label>
                            <input type="file" class="form-control" id="postImage" accept="image/*">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn create-post-btn" id="submitPost">Create Post</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer pt-5">
        <div class="container">
            <div class="row pb-4">
                <div class="col-lg-3 mb-4">
                    <h5 class="text-uppercase mb-4">Get In Touch</h5>
                    <p class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> 123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fas fa-phone-alt me-2"></i> +212 6933 05050</p>
                    <p class="mb-4"><i class="fas fa-envelope me-2"></i> jadthegamer06@gmail.com</p>
                    <h6 class="text-uppercase mb-3">Follow Us</h6>
                    <div class="d-flex">
                        <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5 class="text-uppercase mb-4">Useful Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-secondary">Private Policy</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary">Term & Conditions</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary">New Member Registration</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary">Affiliate Programme</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary">Return & Refund</a></li>
                        <li><a href="#" class="text-secondary">Help & FAQs</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5 class="text-uppercase mb-4">Car Gallery</h5>
                    <div class="row g-2">
                        <div class="col-4">
                            <img src="../../../img/gallery-1.jpg" class="gallery-img w-100" alt="Car 1">
                        </div>
                        <div class="col-4">
                            <img src="../../../img/gallery-2.jpg" class="gallery-img w-100" alt="Car 2">
                        </div>
                        <div class="col-4">
                            <img src="../../../img/gallery-3.jpg" class="gallery-img w-100" alt="Car 3">
                        </div>
                        <div class="col-4">
                            <img src="../../../img/gallery-4.jpg" class="gallery-img w-100" alt="Car 4">
                        </div>
                        <div class="col-4">
                            <img src="../../../img/gallery-5.jpg" class="gallery-img w-100" alt="Car 5">
                        </div>
                        <div class="col-4">
                            <img src="../../../img/gallery-6.jpg" class="gallery-img w-100" alt="Car 6">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5 class="text-uppercase mb-4">Newsletter</h5>
                    <p class="text-secondary mb-4">Subscribe to our newsletter for updates</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control bg-dark border-dark text-white" placeholder="Your Email">
                        <button class="btn create-post-btn">Sign Up</button>
                    </div>
                    <p class="text-secondary"><small>We respect your privacy</small></p>
                </div>
            </div>
        </div>
        <div class="text-center py-4 border-top border-secondary">
            <p class="mb-0 text-secondary">&copy; <a href="#" class="text-secondary">Drive-Loc</a>. All Rights Reserved.
                Designed by <a href="https://htmlcodex.com" class="text-secondary">HTML Codex</a></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle post submission
        document.getElementById('submitPost').addEventListener('click', function() {
            const title = document.getElementById('postTitle').value;
            const content = document.getElementById('postContent').value;
            const tags = document.getElementById('postTags').value;
            const image = document.getElementById('postImage').files[0];

            // Here you would typically send this data to your server
            console.log('Creating post:', {
                title,
                content,
                tags,
                image
            });

            // Close the modal
            bootstrap.Modal.getInstance(document.getElementById('createPostModal')).hide();
        });
    </script>
</body>

</html>