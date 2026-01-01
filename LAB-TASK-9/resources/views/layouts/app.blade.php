<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Movie Hub') - Lab Task 9</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #ff6b35;  /* Orange */
            --secondary-color: #00bbf9; /* Blue */
            --accent-color: #9d4edd;    /* Purple */
            --dark-bg: #121212;
            --card-bg: #1e1e1e;
            --text-light: #f5f5f5;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--dark-bg) 0%, #2a2a2a 100%);
            color: var(--text-light);
            min-height: 100vh;
        }
        
        .navbar-brand {
            font-family: 'Cinzel', serif;
            font-weight: 700;
            font-size: 1.8rem;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        .movie-card {
            background: var(--card-bg);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 107, 53, 0.2);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        
        .movie-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(255, 107, 53, 0.4);
            border-color: var(--primary-color);
        }
        
        .movie-poster {
            height: 300px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .movie-card:hover .movie-poster {
            transform: scale(1.05);
        }
        
        .rating-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(45deg, var(--accent-color), #ff9e00);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(157, 78, 221, 0.4);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
        }
        
        .btn-danger {
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 500;
        }
        
        .search-box {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255, 107, 53, 0.3);
            border-radius: 25px;
            padding: 10px 20px;
            color: white;
            backdrop-filter: blur(10px);
        }
        
        .search-box:focus {
            box-shadow: 0 0 15px rgba(255, 107, 53, 0.5);
            border-color: var(--primary-color);
        }
        
        .form-control, .form-select {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            border-radius: 10px;
            padding: 12px 15px;
        }
        
        .form-control:focus, .form-select:focus {
            background: rgba(255,255,255,0.15);
            border-color: var(--primary-color);
            box-shadow: 0 0 15px rgba(255, 107, 53, 0.3);
            color: white;
        }
        
        /* UPDATED HERO SECTION WITH NEW MOVIE THEATER BACKGROUND */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.75)),
                        url('https://images.unsplash.com/photo-1536440136628-849c177e76a1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            padding: 120px 0;
            border-radius: 0 0 30px 30px;
            margin-bottom: 50px;
            position: relative;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }
        
        .hero-title {
            font-family: 'Cinzel', serif;
            font-size: 4rem;
            font-weight: 700;
            color: white;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.7);
            letter-spacing: 2px;
            margin-bottom: 1rem;
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            color: var(--text-light);
            margin-bottom: 1.5rem;
            font-weight: 400;
        }
        
        .hero-description {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            max-width: 600px;
            margin: 0 auto 2.5rem;
            line-height: 1.6;
        }
        
        .hero-search-container {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .hero-search-box {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 30px;
            padding: 15px 25px;
            font-size: 1.1rem;
            color: var(--dark-bg);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        
        .hero-search-box:focus {
            box-shadow: 0 8px 30px rgba(255, 107, 53, 0.4);
            background: white;
        }
        
        .hero-search-btn {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 30px;
            padding: 15px 30px;
            color: white;
            font-weight: 600;
            margin-left: -60px;
            transition: all 0.3s ease;
        }
        
        .hero-search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.4);
        }
        
        .movie-detail-card {
            background: var(--card-bg);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        
        .genre-tag {
            display: inline-block;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            margin-right: 10px;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }
        
        .footer {
            background: rgba(20, 20, 20, 0.9);
            padding: 30px 0;
            margin-top: 50px;
            border-top: 1px solid rgba(255, 107, 53, 0.3);
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        
        .empty-state i {
            font-size: 4rem;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .hero-description {
                font-size: 1rem;
                padding: 0 20px;
            }
            
            .hero-search-container {
                padding: 0 20px;
            }
            
            .hero-search-box {
                font-size: 1rem;
                padding: 12px 20px;
            }
            
            .hero-search-btn {
                padding: 12px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('movies.index') }}">
                <i class="fas fa-film me-2"></i>MovieHub
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('movies.index') }}">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('movies.create') }}">
                            <i class="fas fa-plus-circle me-1"></i> Add Movie
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer
    <footer class="footer">
        <div class="container text-center">
            <h5 class="mb-3">Movie Management System</h5>
            <p class="mb-0 text-muted">L Complete CRUD with Search & File Upload</p>
            <p class="text-muted">Built with Laravel & Bootstrap</p>
        </div>
    </footer> -->

    <!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <h5 class="mb-3">🎬 MovieHub</h5>
                <p class="text-muted small">Your personal movie collection management system with advanced tracking and analytics.</p>
                <div class="mt-3">
                    <span class="badge bg-primary me-2">Laravel</span>
                    <span class="badge bg-success me-2">Bootstrap 5</span>
                    <span class="badge bg-warning">CRUD</span>
                </div>
            </div>
            
            <div class="col-md-4 mb-4 mb-md-0">
                <h5 class="mb-3">📊 Movie Statistics</h5>
                <div class="row">
                    <div class="col-6">
                        <div class="text-center">
                            <div class="fs-3 fw-bold text-primary">{{ $totalMovies ?? '0' }}</div>
                            <div class="text-muted small">Total Movies</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <div class="fs-3 fw-bold text-success">{{ $avgRating ?? '0.0' }}/10</div>
                            <div class="text-muted small">Avg Rating</div>
                        </div>
                    </div>
                </div>
                @if(isset($latestMovie))
                <div class="mt-3">
                    <small class="text-muted">Latest: {{ $latestMovie->title ?? 'No movies yet' }}</small>
                </div>
                @endif
            </div>
            
            <div class="col-md-4">
                <h5 class="mb-3">🔧 System Info</h5>
                <div class="mb-2">
                    <small class="text-muted">Lab Task 9</small>
                </div>
                <div class="mb-2">
                    <small class="text-muted">Complete CRUD with Search & File Upload</small>
                </div>
                <div class="mb-2">
                    <small class="text-muted">Version: 1.0.0</small>
                </div>
                <div class="mt-3">
                    <small class="text-muted">📅 Last Updated: {{ date('Y-m-d') }}</small>
                </div>
            </div>
        </div>
        
        <hr class="my-4 opacity-25">
        
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0 text-muted small">
                    <i class="fas fa-code me-1"></i> Built with Laravel & Bootstrap
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0 text-muted small">
                    <i class="fas fa-database me-1"></i> Movies in Collection: {{ $totalMovies ?? '0' }}
                </p>
            </div>
        </div>
    </div>
</footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Confirm delete
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this movie? This action cannot be undone.')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
        
        // Preview image before upload
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
            }
        }
    </script>
    
    @yield('scripts')
</body>
</html>