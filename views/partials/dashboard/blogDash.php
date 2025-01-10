
<?php 
require_once '../../../models/Article.php';
require_once '../../../models/themes.php';
require_once '../../../models/tag.php';
require_once '../../../models/comment.php';

$articles = new article();
$themes = new Theme();
$tags = new tag();
$comments = new Comment();

$affArticles = $articles->getAllArticles();
$affThemes = $themes->getAllThemes();
$affComments = $comments->getAllComments();
$affTags = $tags->getAllTags();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case '':
        }
    }
}
// var_dump();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 56px;
            background-color: #f8f9fa;
            z-index: 100;
            width: 250px;
        }

        .main-content {
            margin-left: 250px;
            padding: 56px 20px 20px 20px;
        }

        .statistics-card {
            transition: transform 0.3s;
            background: white;
            border: 1px solid rgba(0,0,0,.125);
            height: 100%;
        }

        .statistics-card:hover {
            transform: scale(1.02);
        }

        .statistics-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: static;
                height: auto;
                width: 100%;
                padding-top: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }

        .table-responsive {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Blog Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="adminDash.php">Location</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blogDash.php">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="position-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#statistics">
                        <i class="bi bi-graph-up"></i> Statistics
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#articles">
                        <i class="bi bi-file-text"></i> Articles
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#comments">
                        <i class="bi bi-chat"></i> Comments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#themes">
                        <i class="bi bi-palette"></i> Themes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tags">
                        <i class="bi bi-tags"></i> Tags
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Statistics Section -->
        <div class="statistics-section">
            <h2 class="mb-4">Dashboard Overview</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="statistics-card">
                        <div class="card-body">
                            <h5 class="card-title text-muted">Total Articles</h5>
                            <p class="card-text display-4">150</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="statistics-card">
                        <div class="card-body">
                            <h5 class="card-title text-muted">Approved Articles</h5>
                            <p class="card-text display-4">120</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="statistics-card">
                        <div class="card-body">
                            <h5 class="card-title text-muted">Pending Articles</h5>
                            <p class="card-text display-4">30</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="statistics-card">
                        <div class="card-body">
                            <h5 class="card-title text-muted">Total Comments</h5>
                            <p class="card-text display-4">500</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Articles Section -->
        <div class="table-responsive">
            <div class="section-header">
                <h2>Articles</h2>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Creation Date</th>
                        <th>Author Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Getting Started with Bootstrap</td>
                        <td>2024-01-10</td>
                        <td>John Doe</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>
                            <button class="btn btn-sm btn-success accept-btn">Accept</button>
                            <button class="btn btn-sm btn-danger decline-btn">Decline</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Comments Section -->
        <div class="table-responsive">
            <div class="section-header">
                <h2>Comments</h2>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Content</th>
                        <th>User ID</th>
                        <th>Article ID</th>
                        <th>Creation Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Great article! Very helpful.</td>
                        <td>10</td>
                        <td>1</td>
                        <td>2024-01-10</td>
                        <td>
                            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Themes Section -->
        <div class="table-responsive">
            <div class="section-header">
                <h2>Themes</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addThemeModal">
                    <i class="bi bi-plus-circle"></i> Add Theme
                </button>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Technology</td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateThemeModal">Update</button>
                            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tags Section -->
        <div class="table-responsive">
            <div class="section-header">
                <h2>Tags</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTagModal">
                    <i class="bi bi-plus-circle"></i> Add Tag
                </button>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Web Development</td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateTagModal">Update</button>
                            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Theme Modal -->
    <div class="modal fade" id="addThemeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Theme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addThemeForm" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="themeName" class="form-label">Theme Name</label>
                            <input type="text" class="form-control" id="themeName" required>
                            <div class="invalid-feedback">Please provide a theme name.</div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Theme</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Theme Modal -->
    <div class="modal fade" id="updateThemeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Theme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="updateThemeForm" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="updateThemeName" class="form-label">Theme Name</label>
                            <input type="text" class="form-control" id="updateThemeName" required>
                            <div class="invalid-feedback">Please provide a theme name.</div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Theme</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Tag Modal -->
    <div class="modal fade" id="addTagModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addTagForm" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="tagName" class="form-label">Tag Name</label>
                            <input type="text" class="form-control" id="tagName" required>
                            <div class="invalid-feedback">Please provide a tag name.</div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Tag Modal -->
    <div class="modal fade" id="updateTagModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="updateTagForm" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="updateTagName" class="form-label">Tag Name</label>
                            <input type="text" class="form-control" id="updateTagName" required>
                            <div class="invalid-feedback">Please provide a tag name.</div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        const forms = document.querySelectorAll('.needs-validation');
        forms.forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault();
                    const modalId = form.closest('.modal').id;
                    const action = modalId.startsWith('add') ? 'added' : 'updated';
                    const type = modalId.includes('Theme') ? 'Theme' : 'Tag';
                    alert(`${type} ${action} successfully!`);
                    bootstrap.Modal.getInstance(form.closest('.modal')).hide();
                    form.reset();
                }
                form.classList.add('was-validated');
            });
        });

        // Button actions
        document.querySelectorAll('.accept-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');
                const statusCell = row.querySelector('td:nth-child(5)');
                statusCell.innerHTML = '<span class="badge bg-success">Approved</span>';
                this.closest('td').innerHTML = '<span class="text-muted">Processed</span>';
            });
        });

        document.querySelectorAll('.decline-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');
                const statusCell = row.querySelector('td:nth-child(5)');
                statusCell.innerHTML = '<span class="badge bg-danger">Declined</span>';
                this.closest('td').innerHTML = '<span class="text-muted">Processed</span>';
            });
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this item?')) {
                    this.closest('tr').remove();
                }
            });
        });

        // Pre-fill update modals
        document.querySelectorAll('[data-bs-target="#updateThemeModal"]').forEach(btn => {
            btn.addEventListener('click', function() {
                const themeName = this.closest('tr').querySelector('td:nth-child(2)').textContent;
                document.getElementById('updateThemeName').value = themeName;
            });
        });

        document.querySelectorAll('[data-bs-target="#updateTagModal"]').forEach(btn => {
            btn.addEventListener('click', function() {
                const tagName = this.closest('tr').querySelector('td:nth-child(2)').textContent;
                document.getElementById('updateTagName').value = tagName;
            });
        });
    </script>
</body>
</html>