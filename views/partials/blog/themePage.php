<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 280px;
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
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Left Sidebar -->
        <nav class="sidebar min-vh-100 p-3 d-none d-lg-block">
            <div class="mb-4">
                <select class="form-select theme-selector">
                    <option selected>Select Theme</option>
                    <option value="dark">Dark Theme</option>
                    <option value="light">Light Theme</option>
                    <option value="custom">Custom Theme</option>
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
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Sort Options -->
                        <div class="d-flex align-items-center mb-3">
                            <button class="btn btn-outline-secondary me-2">
                                <i class="fas fa-rocket me-2"></i> Best
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-clock me-2"></i> New
                            </button>
                        </div>

                        <!-- Posts -->
                        <article class="post-card p-3" onclick="window.location.href='post-detail.html'">
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
                                        <span class="me-2">r/Morocco</span>
                                        <span class="text-muted">• 4 days ago</span>
                                    </div>
                                    <h2 class="h5 mb-2">Can I transit through spain without Visa?</h2>
                                    <p class="mb-2">Hello all, I could really use some advice or clarifications from moroccans who've already transited through Spain...</p>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-link text-muted me-3">
                                            <i class="far fa-comment me-1"></i> 13 comments
                                        </button>
                                        <button class="btn btn-link text-muted">
                                            <i class="fas fa-share me-1"></i> Share
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="post-card p-3" onclick="window.location.href='post-detail.html'">
                            <div class="d-flex">
                                <div class="d-flex flex-column align-items-center me-3">
                                    <button class="vote-button"><i class="fas fa-arrow-up"></i></button>
                                    <span class="my-1">25</span>
                                    <button class="vote-button"><i class="fas fa-arrow-down"></i></button>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="community-icon"></div>
                                        <span class="me-2">r/algeria</span>
                                        <span class="text-muted">• 20 hr. ago</span>
                                    </div>
                                    <h2 class="h5 mb-2">Live in luxury in Algeria or live like any normal person in Europe or abroad</h2>
                                    <p class="mb-2">Hey ! I just want to ask you Algerian people what would you choose...</p>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-link text-muted me-3">
                                            <i class="far fa-comment me-1"></i> 87 comments
                                        </button>
                                        <button class="btn btn-link text-muted">
                                            <i class="fas fa-share me-1"></i> Share
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- Right Sidebar -->
                    <aside class="col-lg-4 d-none d-lg-block">
                        <div class="card border-secondary">
                            <div class="card-header border-secondary">
                                <h5 class="card-title mb-0">Recent Posts</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="community-icon small"></div>
                                    <div>
                                        <h6 class="mb-0">r/Morocco</h6>
                                        <small class="text-muted">How big is your ego?</small>
                                    </div>
                                </div>
                                <div class="text-muted small">
                                    25 upvotes • 87 comments
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>