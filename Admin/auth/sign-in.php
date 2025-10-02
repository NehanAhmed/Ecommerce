<?php
session_start();
include "../include/db.php";

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['pass'];
    
    // Validate input
    if (empty($email) || empty($password)) {
        $error_message = "Please enter both email and password.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address.";
    } else {
        // Use prepared statement to prevent SQL injection
        $sql = "SELECT * FROM `user` WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            // Verify password (supports both hashed and plain text for backward compatibility)
            if (password_verify($password, $row['password']) || $row['password'] === $password) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['loggedin'] = TRUE;
                
                $success_message = "Login successful! Redirecting...";
                echo "<script>
                    setTimeout(function() {
                        window.location.href = '../index.php';
                    }, 1500);
                </script>";
            } else {
                $error_message = "Incorrect password. Please try again.";
            }
        } else {
            $error_message = "No account found with this email address.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign In to Your Account</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Sign in to your account to access your dashboard">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #6366f1;
      --primary-hover: #5855eb;
      --secondary-color: #f8fafc;
      --accent-color: #0ea5e9;
      --text-primary: #1e293b;
      --text-secondary: #64748b;
      --border-color: #e2e8f0;
      --success-color: #10b981;
      --error-color: #ef4444;
      --background-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      --card-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
      --input-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      background: var(--background-gradient);
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 20px 0;
      color: var(--text-primary);
    }

    .signin-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      box-shadow: var(--card-shadow);
      border: 1px solid rgba(255, 255, 255, 0.2);
      overflow: hidden;
      max-width: 440px;
      width: 100%;
      margin: 0 auto;
    }

    .signin-header {
      text-align: center;
      padding: 40px 40px 20px;
      background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    }

    .signin-header .logo-icon {
      width: 64px;
      height: 64px;
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 24px;
      color: white;
      box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);
    }

    .signin-header h1 {
      font-size: 2rem;
      font-weight: 700;
      color: var(--text-primary);
      margin-bottom: 8px;
      letter-spacing: -0.02em;
    }

    .signin-header p {
      color: var(--text-secondary);
      font-size: 0.95rem;
      margin: 0;
      font-weight: 400;
    }

    .signin-body {
      padding: 20px 40px 40px;
    }

    .alert-modern {
      border: none;
      border-radius: 12px;
      padding: 16px 20px;
      margin-bottom: 24px;
      font-weight: 500;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      animation: slideInDown 0.3s ease-out;
    }

    .alert-modern.alert-danger {
      background: linear-gradient(135deg, #fee2e2, #fecaca);
      color: #dc2626;
      border-left: 4px solid var(--error-color);
    }

    .alert-modern.alert-success {
      background: linear-gradient(135deg, #d1fae5, #a7f3d0);
      color: #047857;
      border-left: 4px solid var(--success-color);
    }

    .alert-modern i {
      margin-right: 10px;
      font-size: 1.1rem;
    }

    .form-floating {
      margin-bottom: 20px;
      position: relative;
    }

    .form-floating > .form-control {
      height: 58px;
      border: 2px solid var(--border-color);
      border-radius: 12px;
      font-size: 1rem;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
      box-shadow: var(--input-shadow);
    }

    .form-floating > .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
      background: rgba(255, 255, 255, 0.95);
    }

    .form-floating > label {
      font-weight: 500;
      color: var(--text-secondary);
      font-size: 0.9rem;
    }

    .password-toggle {
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: var(--text-secondary);
      cursor: pointer;
      font-size: 1.1rem;
      z-index: 5;
      transition: color 0.2s ease;
    }

    .password-toggle:hover {
      color: var(--primary-color);
    }

    .btn-primary-modern {
      background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
      border: none;
      border-radius: 12px;
      padding: 16px;
      font-weight: 600;
      font-size: 1.05rem;
      transition: all 0.3s ease;
      text-transform: none;
      letter-spacing: 0.01em;
      box-shadow: 0 4px 14px 0 rgba(99, 102, 241, 0.3);
      position: relative;
    }

    .btn-primary-modern:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px 0 rgba(99, 102, 241, 0.4);
      background: linear-gradient(135deg, var(--primary-hover), var(--primary-color));
    }

    .btn-primary-modern:active {
      transform: translateY(0);
    }

    .forgot-password {
      text-align: right;
      margin-top: -10px;
      margin-bottom: 24px;
    }

    .forgot-password a {
      color: var(--primary-color);
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 500;
      transition: color 0.2s ease;
    }

    .forgot-password a:hover {
      color: var(--primary-hover);
      text-decoration: underline;
    }

    .signup-link {
      text-align: center;
      margin-top: 24px;
      padding-top: 24px;
      border-top: 1px solid rgba(226, 232, 240, 0.6);
    }

    .signup-link span {
      color: var(--text-secondary);
      font-size: 0.95rem;
    }

    .signup-link a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 600;
      margin-left: 6px;
      transition: color 0.2s ease;
    }

    .signup-link a:hover {
      color: var(--primary-hover);
      text-decoration: underline;
    }

    .remember-me {
      display: flex;
      align-items: center;
      margin-bottom: 24px;
    }

    .remember-me input[type="checkbox"] {
      margin-right: 10px;
      transform: scale(1.1);
    }

    .remember-me label {
      color: var(--text-secondary);
      font-size: 0.9rem;
      margin: 0;
      cursor: pointer;
    }

    @keyframes slideInDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 576px) {
      .signin-container {
        margin: 10px;
        border-radius: 16px;
      }
      
      .signin-header,
      .signin-body {
        padding-left: 24px;
        padding-right: 24px;
      }
      
      .signin-header h1 {
        font-size: 1.75rem;
      }
    }

    /* Loading state */
    .btn-loading {
      color: transparent;
    }

    .btn-loading::after {
      content: '';
      position: absolute;
      width: 20px;
      height: 20px;
      top: 50%;
      left: 50%;
      margin-left: -10px;
      margin-top: -10px;
      border: 2px solid #ffffff;
      border-radius: 50%;
      border-top-color: transparent;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    .demo-credentials {
      background: rgba(14, 165, 233, 0.05);
      border: 1px solid rgba(14, 165, 233, 0.1);
      border-radius: 12px;
      padding: 16px;
      margin-bottom: 24px;
      text-align: center;
    }

    .demo-credentials h6 {
      color: var(--accent-color);
      margin-bottom: 8px;
      font-weight: 600;
      font-size: 0.85rem;
    }

    .demo-credentials p {
      color: var(--text-secondary);
      font-size: 0.8rem;
      margin: 4px 0;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="signin-container">
    <div class="signin-header">
      <div class="logo-icon">
        <i class="bi bi-shield-lock"></i>
      </div>
      <h1>Welcome Back</h1>
      <p>Sign in to your account to continue</p>
    </div>
    
    <div class="signin-body">
      <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger alert-modern" role="alert">
          <i class="bi bi-exclamation-triangle-fill"></i>
          <?php echo htmlspecialchars($error_message); ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($success_message)): ?>
        <div class="alert alert-success alert-modern" role="alert">
          <i class="bi bi-check-circle-fill"></i>
          <?php echo htmlspecialchars($success_message); ?>
        </div>
      <?php endif; ?>

      <div class="demo-credentials">
        <h6><i class="bi bi-info-circle me-1"></i>Demo Account</h6>
        <p><strong>Email:</strong> demo@example.com</p>
        <p><strong>Password:</strong> demo123</p>
      </div>

      <form method="post" action="" id="signinForm" novalidate>
        <div class="form-floating">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email Address"
                 value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
          <label for="email">Email Address</label>
        </div>

        <div class="form-floating">
          <input type="password" class="form-control" id="password" name="pass" placeholder="Password" required>
          <label for="password">Password</label>
          <button type="button" class="password-toggle" id="togglePassword">
            <i class="bi bi-eye"></i>
          </button>
        </div>

        <div class="remember-me">
          <input type="checkbox" id="remember" name="remember">
          <label for="remember">Remember me for 30 days</label>
        </div>

        <div class="forgot-password">
          <a href="#" onclick="alert('Contact administrator to reset password')">Forgot Password?</a>
        </div>

        <button type="submit" class="btn btn-primary-modern w-100" id="submitBtn">
          <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
        </button>

        <div class="signup-link">
          <span>Don't have an account?</span>
          <a href="sign-up.php">Create account</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('signinForm');
    const submitBtn = document.getElementById('submitBtn');
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const inputs = form.querySelectorAll('input[required]');

    // Password toggle functionality
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        const icon = this.querySelector('i');
        if (type === 'text') {
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    });

    // Form submission handling
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Basic client-side validation
        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        // Email validation
        const email = document.getElementById('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.value && !emailRegex.test(email.value)) {
            isValid = false;
            email.classList.add('is-invalid');
        }

        if (isValid) {
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;
        } else {
            e.preventDefault();
        }
    });

    // Real-time validation feedback
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });

        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid') && this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });

    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert-modern');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.animation = 'slideInDown 0.3s ease-out reverse';
            setTimeout(() => {
                alert.style.display = 'none';
            }, 300);
        }, 5000);
    });

    // Demo credentials quick fill
    const demoCredentials = document.querySelector('.demo-credentials');
    demoCredentials.addEventListener('click', function() {
        document.getElementById('email').value = 'demo@example.com';
        document.getElementById('password').value = 'demo123';
        
        // Add visual feedback
        inputs.forEach(input => {
            input.classList.add('is-valid');
        });
    });
});
</script>
</body>
</html>