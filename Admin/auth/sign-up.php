<?php
// include DB connection (case-sensitive filesystem on Linux)
include '../include/db.php';

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $zipcode = trim($_POST['zipcode']);
    $password = $_POST['pass'];
    
    // Validate input
    if (empty($name) || empty($email) || empty($address) || empty($city) || empty($state) || empty($zipcode) || empty($password)) {
        $error_message = "All fields are required!";
    } elseif (strlen($password) < 8) {
        $error_message = "Password must be at least 8 characters long.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address.";
    } else {
        // Check if email already exists
        $email_check = "SELECT * FROM `user` WHERE email = ?";
        $stmt = $conn->prepare($email_check);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        
        if ($res->num_rows > 0) {
            $error_message = "Email already exists! Please use a different email address.";
        } else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Use prepared statement for insert
            $sql = "INSERT INTO `user`(`username`, `email`, `address`, `city`, `state`, `zipcode`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $name, $email, $address, $city, $state, $zipcode, $hashed_password);
            
            if ($stmt->execute()) {
                $success_message = "Account created successfully! Redirecting to login...";
                // Add a small delay before redirect to show success message
                echo "<script>
                    setTimeout(function() {
                        window.location.href = '../';
                    }, 2500);
                </script>";
            } else {
                $error_message = "Registration failed! Please try again later.";
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Your Account - SignUp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Create your account to get started">
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

    .signup-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      box-shadow: var(--card-shadow);
      border: 1px solid rgba(255, 255, 255, 0.2);
      overflow: hidden;
      max-width: 480px;
      width: 100%;
      margin: 0 auto;
    }

    .signup-header {
      text-align: center;
      padding: 40px 40px 20px;
      background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    }

    .signup-header h1 {
      font-size: 2rem;
      font-weight: 700;
      color: var(--text-primary);
      margin-bottom: 8px;
      letter-spacing: -0.02em;
    }

    .signup-header p {
      color: var(--text-secondary);
      font-size: 0.95rem;
      margin: 0;
      font-weight: 400;
    }

    .signup-body {
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

    .row-compact .col-md-6,
    .row-compact .col-md-4,
    .row-compact .col-md-2 {
      padding-left: 8px;
      padding-right: 8px;
    }

    .row-compact {
      margin-left: -8px;
      margin-right: -8px;
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
    }

    .btn-primary-modern:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px 0 rgba(99, 102, 241, 0.4);
      background: linear-gradient(135deg, var(--primary-hover), var(--primary-color));
    }

    .btn-primary-modern:active {
      transform: translateY(0);
    }

    .login-link {
      text-align: center;
      margin-top: 24px;
      padding-top: 24px;
      border-top: 1px solid rgba(226, 232, 240, 0.6);
    }

    .login-link span {
      color: var(--text-secondary);
      font-size: 0.95rem;
    }

    .login-link a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 600;
      margin-left: 6px;
      transition: color 0.2s ease;
    }

    .login-link a:hover {
      color: var(--primary-hover);
      text-decoration: underline;
    }

    .password-requirements {
      background: rgba(99, 102, 241, 0.05);
      border: 1px solid rgba(99, 102, 241, 0.1);
      border-radius: 8px;
      padding: 12px;
      margin-top: 8px;
      font-size: 0.85rem;
      color: var(--text-secondary);
    }

    .requirement-list {
      margin: 8px 0 0 0;
      padding: 0;
      list-style: none;
    }

    .requirement-list li {
      padding: 2px 0;
      display: flex;
      align-items: center;
    }

    .requirement-list li::before {
      content: '•';
      color: var(--primary-color);
      margin-right: 8px;
      font-weight: bold;
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
      .signup-container {
        margin: 10px;
        border-radius: 16px;
      }
      
      .signup-header,
      .signup-body {
        padding-left: 24px;
        padding-right: 24px;
      }
      
      .signup-header h1 {
        font-size: 1.75rem;
      }
      
      .row-compact .col-md-6,
      .row-compact .col-md-4,
      .row-compact .col-md-2 {
        margin-bottom: 16px;
      }
    }

    /* Loading state */
    .btn-loading {
      position: relative;
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
  </style>
</head>
<body>
<div class="container">
  <div class="signup-container">
    <div class="signup-header">
      <h1>Create Account</h1>
      <p>Join us today and get started in minutes</p>
    </div>
    
    <div class="signup-body">
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

      <form method="post" action="" id="signupForm" novalidate>
        <div class="form-floating">
          <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name"
                 value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>" required>
          <label for="fullname">Full Name</label>
        </div>

        <div class="form-floating">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email Address"
                 value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
          <label for="email">Email Address</label>
        </div>

        <div class="form-floating">
          <input type="text" class="form-control" id="address" name="address" placeholder="Street Address"
                 value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>" required>
          <label for="address">Street Address</label>
        </div>

        <div class="row row-compact">
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="city" name="city" placeholder="City"
                     value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : ''; ?>" required>
              <label for="city">City</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-floating">
              <input type="text" class="form-control" id="state" name="state" placeholder="State"
                     value="<?php echo isset($_POST['state']) ? htmlspecialchars($_POST['state']) : ''; ?>" required>
              <label for="state">State</label>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-floating">
              <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="ZIP"
                     value="<?php echo isset($_POST['zipcode']) ? htmlspecialchars($_POST['zipcode']) : ''; ?>" required>
              <label for="zipcode">ZIP Code</label>
            </div>
          </div>
        </div>

        <div class="form-floating">
          <input type="password" class="form-control" id="password" name="pass" placeholder="Password" required>
          <label for="password">Password</label>
        </div>
        
        <div class="password-requirements">
          <strong>Password Requirements:</strong>
          <ul class="requirement-list">
            <li>At least 8 characters long</li>
            <li>Mix of letters, numbers, and symbols recommended</li>
          </ul>
        </div>

        <button type="submit" class="btn btn-primary-modern w-100" id="submitBtn">
          <i class="bi bi-person-plus me-2"></i>Create Account
        </button>

        <div class="login-link">
          <span>Already have an account?</span>
          <a href="sign-in.php">Sign in here</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('signupForm');
    const submitBtn = document.getElementById('submitBtn');
    const inputs = form.querySelectorAll('input[required]');

    // Add loading state on form submission
    form.addEventListener('submit', function(e) {
        // Basic client-side validation
        let isValid = true;
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

        // Password validation
        const password = document.getElementById('password');
        if (password.value && password.value.length < 8) {
            isValid = false;
            password.classList.add('is-invalid');
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
});
</script>
</body>
</html>