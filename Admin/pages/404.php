<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ef 100%);
            min-height: 100vh;
        }
        .error-container {
            margin-top: 10vh;
        }
        .error-code {
            font-size: 8rem;
            font-weight: 700;
            color: #0d6efd;
            text-shadow: 2px 2px 8px #b6c6e0;
        }
        .error-message {
            font-size: 2rem;
            font-weight: 500;
        }
        .btn-home {
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="container error-container text-center">
        <div class="error-code">404</div>
        <div class="error-message mb-3">Oops! Page Not Found</div>
        <p class="text-muted mb-4">
            The page you are looking for might have been removed,<br>
            had its name changed, or is temporarily unavailable.
        </p>
        <a href="/Ecommerce/Admin" class="btn btn-primary btn-home">
            <i class="bi bi-house-door"></i> Back to Dashboard
        </a>
    </div>
    <!-- Bootstrap JS and icons (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>