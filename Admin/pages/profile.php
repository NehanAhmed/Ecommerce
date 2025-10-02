<?php
session_start();

include "./include/db.php";


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != TRUE) {
    header("location: auth/sign-in.php");
    exit();
}
?>

<?php
$user_id = $_SESSION['id'];

$sql = "SELECT username, email, address, city, state, zipcode FROM `user` WHERE id = ?";
$stmt = $conn->prepare($sql);   // prepare query
$stmt->bind_param("i", $user_id); // bind ? with value
$stmt->execute();                 // run query
$result = $stmt->get_result();    // get data
$user = $result->fetch_assoc();   // fetch row
?>
<?php
if (isset($_POST['update'])) {
   $new_username = trim($_POST['username']);
   $new_email = trim($_POST['email']);
   $new_address = trim($_POST['address']);
   $new_city = trim($_POST['city']);
   $new_state = trim($_POST['state']);
   $new_zipcode = trim($_POST['zipcode']);

     //  Check if email already exists (except for current user)
    $check = $conn->prepare("SELECT id FROM `user` WHERE email = ? AND address = ?  AND id != ?");
    $check->bind_param("ssi", $new_email, $new_address, $user_id);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {
        echo "<div class='alert alert-danger text-center'>❌ This email is already registered with another account.</div>";
    }
    else {
         $update = $conn->prepare("UPDATE `user` SET `username`= ?,`email`= ?,`address`= ?,`city`= ?,`state`= ?,`zipcode`= ? WHERE `id` = ?");
    $update->bind_param("ssssssi", $new_username, $new_email, $new_address, $new_city, $new_state, $new_zipcode, $user_id);


   if ($update->execute()) {
        echo "<div class='alert alert-success'>Profile updated successfully!</div>";
        // Refresh karne ke liye:
        header("Refresh:1");
    } 
  else {
        echo "<div class='alert alert-danger'>Error updating profile.</div>";
    }
    }


}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile Settings</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <style>
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

    body {
      font-family: "Inter", sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      padding: 2rem 0;
    }
    .profile-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .profile-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 2rem;
      border-radius: 20px 20px 0 0;
      text-align: center;
    }
    .avatar {
      width: 100px;
      height: 100px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1rem;
      font-size: 3rem;
    }
    .form-control {
      border-radius: 12px;
      border: 2px solid #e9ecef;
      padding: 0.75rem 1rem;
      transition: all 0.3s ease;
    }
    .form-control:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      border-radius: 12px;
      padding: 0.75rem 2rem;
      font-weight: 500;
      transition: transform 0.2s ease;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
    }
    .btn-outline-primary {
      border: 2px solid #667eea;
      color: #667eea;
      border-radius: 12px;
      padding: 0.75rem 2rem;
      font-weight: 500;
    }
    .nav-pills .nav-link {
      border-radius: 12px;
      font-weight: 500;
      padding: 0.75rem 1.5rem;
      margin: 0 0.25rem;
      transition: all 0.3s ease;
    }
    .nav-pills .nav-link.active {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="profile-card">
          <div class="profile-header">
            <div class="avatar">
              <i class="bi bi-person-circle"></i>
            </div>
            <h2 class="mb-0">Profile Settings</h2>
            <p class="mb-0 opacity-75">Manage your account information</p>
          </div>

          <div class="p-4">
            <!-- Navigation Tabs -->
            <ul class="nav nav-pills justify-content-center mb-4" role="tablist">
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#profile-tab">
                  <i class="bi bi-person me-2"></i>Profile Info
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#password-tab">
                  <i class="bi bi-shield-lock me-2"></i>Change Password
                </button>
              </li>
            </ul>

            <div class="tab-content">
              <!-- Profile Tab -->
              <div class="tab-pane fade show active" id="profile-tab">
                <form method="POST" action="">
                  <div class="row g-3">
                    <div class="col-12">
                      <label class="form-label fw-semibold">
                        <i class="bi bi-envelope me-2"></i>Email Address
                      </label>
                      <input type="text" class="form-control" name="username" placeholder="Enter your email" value="<?php echo htmlspecialchars($user['username']);?>" required />
                    </div>
                    <div class="col-12">
                      <label class="form-label fw-semibold">
                        <i class="bi bi-envelope me-2"></i>Email Address
                      </label>
                      <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($user['email']);?>" required />
                    </div>
                    <div class="col-12">
                      <label class="form-label fw-semibold">
                        <i class="bi bi-house me-2"></i>Address
                      </label>
                      <input type="text" class="form-control" name="address" placeholder="Enter your address" value="<?php echo htmlspecialchars($user['address']);?>"  />
                    </div>
                    <div class="col-md-6">
                      <label class="form-label fw-semibold">
                        <i class="bi bi-building me-2"></i>City
                      </label>
                      <input type="text" class="form-control" name="city" placeholder="Enter your city" value="<?php echo htmlspecialchars($user['city']);?>" />
                    </div>
                    <div class="col-md-6">
                      <label class="form-label fw-semibold">
                        <i class="bi bi-map me-2"></i>State
                      </label>
                      <input type="text" class="form-control" name="state" placeholder="Enter your state" value="<?php echo htmlspecialchars($user['state']);?>" />
                    </div>
                    <div class="col-12">
                      <label class="form-label fw-semibold">
                        <i class="bi bi-mailbox me-2"></i>Zip Code
                      </label>
                      <input type="text" class="form-control" name="zipcode" placeholder="Enter your zip code" value="<?php echo htmlspecialchars($user['zipcode']);?>"/>
                    </div>
                    <div class="col-12 pt-3">
                      <button type="submit" name="update" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i>Update Profile
                      </button>
                    </div>
                  </div>
                </form>
              </div>

              <!-- Password Tab -->
              <div class="tab-pane fade" id="password-tab">
                <form method="POST" action="" id="passwordForm" novalidate>
                  <div class="row g-3">
                    <div class="col-12">
                      <label class="form-label fw-semibold">
                        <i class="bi bi-key me-2"></i>Current Password
                      </label>
                      <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Enter current password" required />
                    </div>
                    <div class="col-12">
                      <label class="form-label fw-semibold">
                        <i class="bi bi-shield-check me-2"></i>New Password
                      </label>
                      <input type="password" class="form-control" name="new_password" id="new_password" minlength="8" placeholder="Enter new password" required />
                      <div class="form-text">Password must be at least 8 characters long.</div>
                    </div>
                    <div class="col-12">
                      <label class="form-label fw-semibold">
                        <i class="bi bi-shield-check me-2"></i>Confirm New Password
                      </label>
                      <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm new password" required />
                      <div id="password-match" class="form-text"></div>
                    </div>
                    <div class="col-12">
                      <div style="background: rgba(102, 126, 234, 0.05); border: 1px solid rgba(102, 126, 234, 0.1); border-radius: 8px; padding: 12px; margin-top: 8px; font-size: 0.85rem; color: #64748b;">
                        <strong>Password Requirements:</strong>
                        <ul style="margin: 8px 0 0 0; padding: 0; list-style: none;">
                          <li style="padding: 2px 0; display: flex; align-items: center;">
                            <span style="color: #667eea; margin-right: 8px; font-weight: bold;">•</span>At least 8 characters long
                          </li>
                          <li style="padding: 2px 0; display: flex; align-items: center;">
                            <span style="color: #667eea; margin-right: 8px; font-weight: bold;">•</span>Mix of letters, numbers, and symbols recommended
                          </li>
                          <li style="padding: 2px 0; display: flex; align-items: center;">
                            <span style="color: #667eea; margin-right: 8px; font-weight: bold;">•</span>Must enter current password to change
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-12 pt-3">
                      <button type="submit" class="btn btn-primary" id="changePasswordBtn">
                        <i class="bi bi-shield-lock me-2"></i>Change Password
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const passwordForm = document.getElementById("passwordForm");
      const changePasswordBtn = document.getElementById("changePasswordBtn");

      if (passwordForm) {
        passwordForm.addEventListener("submit", function (e) {
          const currentPassword = document.getElementById("current_password");
          const newPassword = document.getElementById("new_password");
          const confirmPassword = document.getElementById("confirm_password");

          let isValid = true;

          [currentPassword, newPassword, confirmPassword].forEach((input) => {
            input.classList.remove("is-invalid", "is-valid");
          });

          if (!currentPassword.value.trim()) {
            currentPassword.classList.add("is-invalid");
            isValid = false;
          } else {
            currentPassword.classList.add("is-valid");
          }

          if (!newPassword.value.trim() || newPassword.value.length < 8) {
            newPassword.classList.add("is-invalid");
            isValid = false;
          } else {
            newPassword.classList.add("is-valid");
          }

          if (!confirmPassword.value.trim() || newPassword.value !== confirmPassword.value) {
            confirmPassword.classList.add("is-invalid");
            isValid = false;
          } else {
            confirmPassword.classList.add("is-valid");
          }

          if (!isValid) {
            e.preventDefault();
            return false;
          }

          changePasswordBtn.disabled = true;
          changePasswordBtn.innerHTML =
            '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Changing Password...';
        });
      }

      document.getElementById("confirm_password").addEventListener("input", function () {
        const newPass = document.getElementById("new_password").value;
        const confirmPass = this.value;
        const matchDiv = document.getElementById("password-match");

        if (confirmPass === "") {
          matchDiv.textContent = "";
          this.classList.remove("is-valid", "is-invalid");
          return;
        }

        if (newPass === confirmPass && newPass.length >= 8) {
          matchDiv.textContent = "✓ Passwords match";
          matchDiv.className = "form-text text-success";
          this.classList.remove("is-invalid");
          this.classList.add("is-valid");
        } else {
          matchDiv.textContent = "✗ Passwords do not match";
          matchDiv.className = "form-text text-danger";
          this.classList.remove("is-valid");
          this.classList.add("is-invalid");
        }
      });

      document.getElementById("new_password").addEventListener("input", function () {
        const confirmPass = document.getElementById("confirm_password");

        if (this.value.length >= 8) {
          this.classList.remove("is-invalid");
          this.classList.add("is-valid");
        } else if (this.value.length > 0) {
          this.classList.remove("is-valid");
          this.classList.add("is-invalid");
        }

        if (confirmPass.value) {
          confirmPass.dispatchEvent(new Event("input"));
        }
      });
    });
  </script>
</body>
</html>
