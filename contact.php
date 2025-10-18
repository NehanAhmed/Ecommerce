<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* 🌟 Hero Section */
    .hero-section {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 140px 0 80px 0;
      margin-top: -80px;
      position: relative;
      overflow: hidden;
      text-align: center;
    }

    .hero-section::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 80px;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23f5f7fa" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
      background-size: cover;
    }

    .hero-section h1 {
      font-size: 3rem;
      font-weight: 800;
      margin-bottom: 10px;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.2);
    }

    .hero-section p {
      font-size: 1.1rem;
      opacity: 0.95;
    }

    /* 🌟 Contact Container */
    .contact-container {
      padding: 60px 0;
    }

    .contact-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.12);
      padding: 40px;
      transition: all 0.3s ease;
    }

    .contact-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 35px rgba(0,0,0,0.18);
    }

    .contact-card h2 {
      color: #2d3748;
      font-weight: 700;
      margin-bottom: 25px;
    }

    .form-control {
      border-radius: 50px;
      padding: 12px 20px;
      border: 2px solid #e2e8f0;
      font-size: 1rem;
      transition: border 0.3s ease;
    }

    .form-control:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    }

    .btn-submit {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #fff;
      padding: 12px 35px;
      border-radius: 50px;
      font-weight: 600;
      border: none;
      width: 100%;
      transition: all 0.3s ease;
    }

    .btn-submit:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    /* 🌟 Contact Info Boxes */
    .info-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.12);
      padding: 30px;
      text-align: center;
      transition: all 0.3s ease;
      height: 100%;
    }

    .info-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 35px rgba(0,0,0,0.18);
    }

    .info-card i {
      font-size: 2rem;
      color: #667eea;
      margin-bottom: 15px;
    }

    .info-card h5 {
      font-weight: 700;
      color: #2d3748;
      margin-bottom: 10px;
    }

    .info-card p {
      color: #4a5568;
      font-size: 1rem;
      margin: 0;
    }
    .error {
      color: red;
      font-size: 14px;
      margin-top: 5px;
    }
  </style>
</head>
<body>

<?php include("includes/header.php"); ?>

<!-- 🌟 Hero Section -->
<div class="hero-section">
  <div class="container">
    <h1><i class="fas fa-envelope-open-text me-2"></i>Contact Us</h1>
    <p>We’d love to hear from you. Get in touch with us anytime!</p>
  </div>
</div>

<!-- 🌟 Contact Section -->
<?php include ("admin/include/db.php");?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $number = htmlspecialchars($_POST['number']);
  $subject = htmlspecialchars($_POST['subject']);
  $message = htmlspecialchars($_POST['message']);

  $sql = "INSERT INTO `contact`(`name`, `email`, `number`, `subject`, `message`) VALUES ('$name','$email','$number','$subject','$message')";

  $result = $conn->query($sql);

  if ($result === TRUE) {
echo '<div class="alert alert-success text-center" role="alert">
            Your message has been sent successfully. We will get back to you soon!
          </div>';
    echo "<script>
            setTimeout(() => {
              window.location.href = 'contact.php';
            }, 1000);
          </script>";


  } else {
      echo '<div class="alert alert-danger text-center" role="alert">
              There was an error sending your message. Please try again later.
            </div>';
  }


}
?>

<div class="container contact-container">
  <div class="row g-5">
    <!-- Contact Form -->
    <div class="col-lg-7">
      <div class="contact-card">
        <h2>Send Us a Message</h2>
        <form id="contactForm" method="POST" action="" novalidate>
    <div class="mb-3">
      <label class="form-label">Full Name</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Your full name">
      <div id="nameError" class="error"></div>
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Your email">
      <div id="emailError" class="error"></div>
    </div>

    <div class="mb-3">
      <label class="form-label">Phone Number (Optional)</label>
      <input type="text" class="form-control" name="number" id="number" placeholder="Your phone number (digits only)">
      <div id="numberError" class="error"></div>
    </div>

    <div class="mb-3">
      <label class="form-label">Subject</label>
      <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
      <div id="subjectError" class="error"></div>
    </div>

    <div class="mb-3">
      <label class="form-label">Message</label>
      <textarea class="form-control" name="message" id="message" rows="5" placeholder="Write your message"></textarea>
      <div id="messageError" class="error"></div>
    </div>

    <button type="submit" class="btn btn-primary w-100">Send Message</button>
  </form>
      </div>
    </div>

    <!-- Contact Info -->
    <div class="col-lg-5">
      <div class="row g-4">
        <div class="col-12">
          <div class="info-card">
            <i class="fas fa-map-marker-alt"></i>
            <h5>Our Address</h5>
            <p>123 Ecommerce Street, Suite 500<br>New York, USA</p>
          </div>
        </div>
        <div class="col-12">
          <div class="info-card">
            <i class="fas fa-envelope"></i>
            <h5>Email Us</h5>
            <p>support@yourstore.com</p>
          </div>
        </div>
        <div class="col-12">
          <div class="info-card">
            <i class="fas fa-phone"></i>
            <h5>Call Us</h5>
            <p>+1 (555) 123-4567</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("includes/footer.php"); ?>
<script>
document.getElementById("contactForm").addEventListener("submit", function(e) {
  let isValid = true;

  let name = document.getElementById("name").value.trim();
  let email = document.getElementById("email").value.trim();
  let number = document.getElementById("number").value.trim();
  let subject = document.getElementById("subject").value.trim();
  let message = document.getElementById("message").value.trim();

  // Reset errors
  document.getElementById("nameError").textContent = "";
  document.getElementById("emailError").textContent = "";
  document.getElementById("numberError").textContent = "";
  document.getElementById("subjectError").textContent = "";
  document.getElementById("messageError").textContent = "";

  // ✅ Name validation
  if (name === "") {
    document.getElementById("nameError").textContent = "Please enter your name";
    isValid = false;
  }

  // ✅ Email validation
  let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (email === "") {
    document.getElementById("emailError").textContent = "Please enter your email";
    isValid = false;
  } else if (!emailPattern.test(email)) {
    document.getElementById("emailError").textContent = "Please enter a valid email";
    isValid = false;
  }

  // ✅ Phone validation (optional but must be digits)
  let numberPattern = /^[0-9]+$/;
  if (number !== "" && !numberPattern.test(number)) {
    document.getElementById("numberError").textContent = "Phone number must contain digits only";
    isValid = false;
  }

  // ✅ Subject validation
  if (subject === "") {
    document.getElementById("subjectError").textContent = "Please enter a subject";
    isValid = false;
  }

  // ✅ Message validation
  if (message.length < 10) {
    document.getElementById("messageError").textContent = "Message must be at least 10 characters";
    isValid = false;
  }

  if (!isValid) {
    e.preventDefault();
  }
});

</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
