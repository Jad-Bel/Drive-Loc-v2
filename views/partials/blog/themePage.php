<?php
require_once '../../../includes/session_check.php';
require_once '../../../models/themes.php';
require_once '../../../models/Article.php';
require_once '../../../models/comment.php';


$articles = new article();
$theme = new theme();
$comments = new Comment();

// print_r($_GET['art_id']);
$thm_id = isset($_GET['thm_id']) ? $_GET['thm_id'] : null;
$art_id = isset($_GET['art_id']) ? $_GET['art_id'] : null;

if ($thm_id) {
    $affArticlesByCat = $articles->getArticlesByTheme($thm_id);
}

$commentCount = ($art_id) ? $comments->countComm($art_id) : 0;

function truncateText($text, $limit = 20)
{
    if (!is_string($text)) {
        return '';
    }
    $words = str_word_count($text, 1);
    if (count($words) > $limit) {
        return implode(' ', array_slice($words, 0, $limit)) . '...';
    }
    return $text;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
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

        :root {
            --sidebar-width: 280px;
            --primary-color: #FF4D30;
            --dark-bg: #191C24;
            --secondary-text: #6C757D;
        }

        body {
            background-color: #F9FAFB;
            color: #d7dadc;
        }

        .sidebar {
            width: var(--sidebar-width);
            background-color: #F9FAFB;
            border-right: 1px solid #343536;
        }

        .nav-link {
            color: #d7dadc;
            padding: 0.75rem 1rem;
            border-radius: 0.25rem;
        }

        .nav-link:hover {
            background-color: #272729;
            color: #d7dadc;
        }

        .nav-link.active {
            background-color: #272729;
        }

        .post-card {
            background-color: #F9FAFB;
            border: 1px solid #343536;
            color: black;
            margin-bottom: 1rem;
            transition: border-color 0.2s;
        }

        .post-card:hover {
            border-color: #1a1a1b;
            cursor: pointer;
        }

        .vote-button {
            background: none;
            border: none;
            color: #818384;
            padding: 4px;
        }

        .vote-button:hover {
            color: #d7dadc;
            background-color: #272729;
            border-radius: 4px;
        }

        .community-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #ff4500;
            margin-right: 8px;
        }

        .theme-selector {
            background-color: #F9FAFB;
            border: 1px solid #343536;
            color: #1a1a1b;
        }

        .theme-selector:focus {
            background-color: #272729;
            border-color: #d7dadc;
            color: #d7dadc;
            box-shadow: none;
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
    </style>
</head>

<body>

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
                    <a href="../../../includes/logout.php">log out</a>
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

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">ROYAL CARS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="../../layouts/main.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../vehicules/vehiculePage.php">Vehicule Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="themePage.php">Blogs</a>
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
    <div class="d-flex">
        <!-- Left Sidebar -->
        <nav class="sidebar min-vh-100 p-3 d-none d-lg-block">
            <div class="mb-4">
                <select class="form-select theme-selector" onchange="window.location.href=this.value">
                    <option selected>Select Theme</option>
                    <?php
                    $themes = new theme();
                    $allThemes = $themes->getAllThemes();
                    foreach ($allThemes as $theme):
                    ?>
                        <option value="?thm_id=<?php echo $theme['thm_id']; ?>">
                            <?php ($thm_id == $theme['thm_id']) ? 'selected' : ''; ?>
                            <?php echo htmlspecialchars($theme['thm_nom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                
            </div>
            <div class="nav flex-column">
                <a href="#" class="nav-link active mb-1">
                    <i class="fas fa-home me-2"></i> Home
                </a>
                <a href="#" class="nav-link mb-1">
                    <i class="fas fa-fire me-2"></i> Popular
                </a>
                <a href="#" class="nav-link mb-1">
                    <i class="fas fa-compass me-2"></i> Explore
                </a>
                <a href="#" class="nav-link mb-1">
                    <i class="fas fa-globe me-2"></i> All
                </a>
            </div>

            <div class="mt-4">
                <h6 class="text-uppercase text-muted mb-3">Custom Feeds</h6>
                <button class="btn btn-outline-secondary w-100">
                    <i class="fas fa-plus me-2"></i> Create a custom feed
                </button>
            </div>

            <div class="mt-4">
                <h6 class="text-uppercase text-muted mb-3">Communities</h6>
                <button class="btn btn-outline-secondary w-100">
                    <i class="fas fa-plus me-2"></i> Create a community
                </button>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow-1 p-3">
            <div class="container-fluid">
                <h1 class="mb-4">
                    <?php
                    if ($thm_id) {
                        $currentTheme = array_filter($allThemes, function ($t) use ($thm_id) {
                            return $t['thm_id'] == $thm_id;
                        });
                        echo htmlspecialchars(current($currentTheme)['thm_nom']);
                    } else {
                        echo "All Articles";
                    }
                    ?>
                </h1>

                <?php if (empty($affArticlesByCat)): ?>
                    <div class="alert alert-info">
                        <?php
                        if (!$thm_id) {
                            "No articles found for this theme.";
                        } else {
                            "Please select a theme to view articles.";
                        }
                        ?>
                    </div>
                <?php else: ?>
                    <!-- Posts -->
                    <?php foreach ($affArticlesByCat as $article): ?>
                        <article class="post-card p-3" onclick="window.location.href='articlePage.php?art_id=<?php echo intval($article['art_id']) ?>&user_id=<?= intval($article['user_id']) ?>'">
                            <div class="d-flex">
                                <!-- Vote Buttons -->
                                <div class="d-flex flex-column align-items-center me-3">
                                    <button class="vote-button"><i class="fas fa-arrow-up"></i></button>
                                    <span class="my-1">1</span>
                                    <button class="vote-button"><i class="fas fa-arrow-down"></i></button>
                                </div>
                                <!-- Post Content -->
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="community-icon"></div>
                                        <span class="me-2"><?= htmlspecialchars($article['author_name']) ?></span>
                                        <span class="text-muted">
                                            • <?php
                                                $date = new DateTime($article['creation_date']);
                                                echo $date->format('M j, T');
                                                ?>
                                        </span>
                                    </div>
                                    <h2 class="h5 mb-2"><?= htmlspecialchars(truncateText($article['title'])); ?></h2>
                                    <p class="mb-2"><?= htmlspecialchars(truncateText($article['content'])); ?></p>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-link text-muted me-3">
                                            <?php
                                            $commentCount = $comments->countComm($article['art_id']);
                                            ?>
                                            <i class="far fa-comment me-1"></i><?= htmlspecialchars($commentCount) ?> comments
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
            </div>
        <?php endif; ?>



        <!-- Right Sidebar -->
        <aside class="col-lg-4 d-none d-lg-block">
            <div class="card border-secondary">
                <div class="card-header border-secondary">
                    <h5 class="card-title mb-0">Recent Posts</h5>
                </div>
                <?php

                if ($_SERVER['REQUEST_METHOD'] == "GET") {

                    if ($_SESSION['user_id']) {
                        $user_id = $_SESSION['user_id'];

                        $article = $articles->getLatestArticle($user_id);

                        if ($article) {
                            $art_id = $article['art_id'];

                            $comments = new Comment();
                            $commentCount = $comments->countComm($art_id);
                        } else {
                            $commentCount = 0;
                        }
                    }
                }
                ?>
                <div class="card-body">
                    <?php if (!empty($article)): ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="community-icon small"></div>
                            <div>
                                <h6 class="mb-0"><?= htmlspecialchars($article['title']) ?></h6>
                                <small class="text-muted"><?= htmlspecialchars(truncateText($article['content'])) ?></small>
                            </div>
                        </div>
                        <div class="text-muted small">
                            • <?= htmlspecialchars($commentCount) ?> comments
                        </div>
                    <?php else: ?>
                        <p class="text-muted">No recent posts available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </aside>

        <div class="modal fade" id="createPostModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create a Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <?php
                    $articles = new article();


                    if ($_SERVER['REQUEST_METHOD'] === "POST") {
                        $user_id = $_SESSION['user_id'];
                        $title = $_POST['title'];
                        $content = $_POST['content'];
                        $tags = $_POST['tags'];
                        $img = $_POST['img'];
                        $thm_id = 1;

                        $articleInsert = $articles->addArticle($title, $content, $user_id, $thm_id);
                    }
                    ?>
                    <div class="modal-body">
                        <form id="createPostForm" method="POST">
                            <input type="hidden" name="user_id" value="<?php echo intval($user_id); ?>">
                            <div class="mb-3">
                                <label for="postTitle" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="postTitle" required>
                            </div>
                            <div class="mb-3">
                                <label for="postContent" class="form-label">Content</label>
                                <textarea class="form-control" name="content" id="postContent" rows="5" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="postTags" class="form-label">Tags</label>
                                <input type="text" class="form-control" name="tags" id="postTags" placeholder="Separate tags with commas">
                            </div>
                            <!-- <div class="mb-3">
                            <label for="postTags" class="form-label">Theme</label>
                            <select type="text" class="form-control" name="theme" id="postTheme" placeholder="">
                        </div> -->
                            <div class="mb-3">
                                <label for="postImage" class="form-label">Image (optional)</label>
                                <input type="file" class="form-control" name="img" id="postImage" accept="image/*">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn create-post-btn" id="submitPost">Create Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>