<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* background-color: black; */
        }
        nav {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            /* background-color: black; */
            display: transparent;
        }

        .nav-logo {
            font-size: 24px;
            font-weight: bold;
        }
        .logo{
            width: 100px;
            height: auto;
        }
        ul {
            list-style: none;
            display: flex;
            margin-left: 30%;
            gap: 25px;
            /* margin: 0; */
            padding: 0;
        }
        ul li {
            display: inline;
            color: white;
        }
        ul li a {
            text-decoration: none;
            color: white;
            transition: 1s;
            font-size: 18px;

        }
        ul li a:hover {
            text-decoration: underline;
            font-size: 20px;
        }
    </style>
</head>
<body>
<nav>
    <div class="nav-logo"><img class="logo" src="sources/logo-removebg-preview.png" alt="Logo"></div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="contact-us.php">Contact Us</a></li>
    </ul>
   
</nav>
</body>
</html>