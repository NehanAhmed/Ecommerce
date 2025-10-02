<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="index.css">
    <style>
      *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Founder Grotesk', sans-serif;

      }
      .hero {
          /* position: relative; */
          /* overflow: hidden; */
      }

      .hero video {
          width: 100%;
          /* height:300px; */
          position: absolute; 
          
          left: 0;
          width: 100%;
          height: 100%;
          object-fit: cover; 
          z-index: -1; /* ye line video ko sab elements ke peeche bhej degi */
          top: 0;
      }
      .hero-content {
        width: 50%;
        position: relative;
          z-index: 1; /* ye line content ko video ke upar la degi */
          color: white;
          text-align: left;
          padding: 20px;
          margin-top: 20%;
          /* background-color: green; */
          top: 50%;
          left: 30%;
          transform: translate(-50%, -50%);
      }
      .hero-content h1 {
          font-size: 48px;
          margin-bottom: 20px;
      }
      .hero-content p {
          font-size: 24px;
          margin-bottom: 30px;
      }
      /* From Uiverse.io by satyamchaudharydev */ 
/* === removing default button style ===*/
.button {
  margin: 0;
  height: auto;
  background: transparent;
  padding: 0;
  border: none;
  cursor: pointer;
}

/* button styling */
.button {
  --border-right: 6px;
  --text-stroke-color: rgba(255,255,255,0.6);
  --animation-color: #f5220bff;
  --fs-size: 2em;
  letter-spacing: 3px;
  text-decoration: none;
  font-size: var(--fs-size);
  font-family: "Arial";
  position: relative;
  text-transform: uppercase;
  color: transparent;
  -webkit-text-stroke: 1px var(--text-stroke-color);
}
/* this is the text, when you hover on button */
.hover-text {
  position: absolute;
  box-sizing: border-box;
  content: attr(data-text);
  color: var(--animation-color);
  width: 0%;
  inset: 0;
  border-right: var(--border-right) solid var(--animation-color);
  overflow: hidden;
  transition: 0.5s;
  -webkit-text-stroke: 1px var(--animation-color);
}
/* hover */
.button:hover .hover-text {
  width: 100%;
  filter: drop-shadow(0 0 23px var(--animation-color))
}
.collection {
background-color: green;
  margin-top: 3.7%;
  width: 100%;
}

.collection h2 {
  font-size: 36px;
  margin-left: 7%;
  /* margin-bottom: 20px; */
  height: 50px;
  text-decoration: underline;
}
/* From Uiverse.io by Tiagoadag */ 
.card {
 width: 190px;
 height: 254px;
 background-image: linear-gradient(163deg, #00ff75 0%, #3700ff 100%);
 border-radius: 20px;
 transition: all .3s;
}

.card2 {
 width: 190px;
 height: 254px;
 background-color: #1a1a1a;
 border-radius:;
 transition: all .2s;
}

.card2:hover {
 transform: scale(0.98);
 border-radius: 20px;
}

.card:hover {
 box-shadow: 0px 0px 30px 1px rgba(0, 255, 117, 0.30);
}
.card-flex{
  display: flex;
  gap: 20px;
  background-color: black;
  /* margin: 15%; */
  /* margin-left: 7%; */
  /* padding: 15px; */
  padding-left: 25%;
  /* margin-top: 20px; */
}

    </style>
</head>
<body>
<?php
include ("includes/header.php");
?>
<!-- HERO VIDEO -->
<div class="hero">
<video autoplay muted loop playsinline src="https://media.istockphoto.com/id/1291254414/video/war-concept-old-military-shoe-in-a-dark-toned-foggy-background-creative-concept-of-conflict.mp4?s=mp4-640x640-is&k=20&c=jmFeJpnd5Mflz7XXxRgTWTNAWkIwGmYB4gzeIpKrOFM="></video>
<!-- HERO CONTENT -->
  <div class="hero-content">
    <h1>Welcome to Our Store</h1>
    <p>Discover the best products at unbeatable prices.</p>
    <!-- From Uiverse.io by satyamchaudharydev --> 
  <!-- HERO BUTTON -->
    <a href="">
    <button class="button" data-text="Awesome">
    <span class="actual-text">&nbsp;Explore&nbsp;</span>
    <span aria-hidden="true" class="hover-text">&nbsp;Explore&nbsp;</span>
    </button></a>
  </div>
</div>

<!-- COLLECTION -->
<div class="collection">
  <h2>Our Collection</h2>
</div>
<!-- COLLECTION CARDS -->

  <div class="card-flex">
 <!-- CARD 1 -->
  <div class="card">
  <div class="card2">
 </div>
</div>

<!-- CARD 2 -->
 <div class="card">
  <div class="card2">
 </div>
</div>

<!-- CARD 3 -->
 <div class="card">
  <div class="card2">
 </div>
</div>
</body>
</html>