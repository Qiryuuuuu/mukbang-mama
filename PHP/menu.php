<?php 
    session_start();

        include("connection.php");
        include("functions.php");

        //check if the user is logged in//
        $user_data = check_login($conn);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menu</title>
        <link rel ="stylesheet" href="../CSS/menu.css">
        <link rel="shorcut icon" type="img/png" href="../img/logoSD_V2.png">
    </head>
    <body>
       <header class="navbar">
            <a href="home.php"><img src="../img/logoSD_V2.png" class="logo"></a>
                    
            <div class="toggle-btn" onclick="toggleNavLinks()">=</div>
                <ul class="navlinks">
                        <li><a href="home.php">Home</a></li>
                        <li class="m-active"><a href="menu.php"></a>Menu</li>
                        <li><a href="location.php">Location</a></li>
                        <li><a href="contact.php">Review</a></li>
                        <li><a href="mytable.php">My Table</a></li>
                    </ul>
                    <div class="overlay" onclick="toggleNavLinks()"></div>
                <a href="reservation.php" class="ctn">Reservation</a>
       </header>
       
        
        <!-- Menu Slider Start -->
      <div class="slides">   
          
            <h1>Explore Our Menu</h1>
            <div class="line"></div>
            <h2>Enjoy the feast only at Mukbang Mama</h2>
        
      <div class="img-slider">
      <div class="slide active">
        <img src="../img/m1.gif" alt="">
      </div>

      <div class="slide">
        <img src="../img/m2.gif" alt="">
      </div>
      
      <div class="slide">
        <img src="../img/m3.gif" alt="">
      </div>

      <div class="slide">
        <img src="../img/m4.gif" alt="">
      </div>

      <div class="slide">
        <img src="../img/m5.gif" alt="">
      </div>

      <div class="navigation">
        <div class="btn active"></div>
        <div class="btn"></div>
        <div class="btn"></div>
        <div class="btn"></div>
        <div class="btn"></div>
      </div>

      </div>
    
    </div>

    <script type="text/javascript">
    var slides = document.querySelectorAll('.slide');
    var btns = document.querySelectorAll('.btn');
    let currentSlide = 1;

    // Javascript for image slider manual navigation
    var manualNav = function(manual){
      slides.forEach((slide) => {
        slide.classList.remove('active');

        btns.forEach((btn) => {
          btn.classList.remove('active');
        });
      });

      slides[manual].classList.add('active');
      btns[manual].classList.add('active');
    }

    btns.forEach((btn, i) => {
      btn.addEventListener("click", () => {
        manualNav(i);
        currentSlide = i;
      });
    });

    // Javascript for image slider autoplay navigation
    var repeat = function(activeClass){
      let active = document.getElementsByClassName('active');
      let i = 1;

      var repeater = () => {
        setTimeout(function(){
          [...active].forEach((activeSlide) => {
            activeSlide.classList.remove('active');
          });

        slides[i].classList.add('active');
        btns[i].classList.add('active');
        i++;

        if(slides.length == i){
          i = 0;
        }
        if(i >= slides.length){
          return;
        }
        repeater();
      }, 10000);
      }
      repeater();
    }
    repeat();
    </script>

<script src="../JavaScript/navoption.js"></script>
    </body>
</html>