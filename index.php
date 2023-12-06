<?php
    include 'db_connection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Eye Vision</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700&family=Lato:wght@300;400;700;900&family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- homepage styles/css -->
    <link rel="stylesheet" href="styles/index.css?v=3" />

    <!-- global styles/css -->
    <link rel="stylesheet" href="styles/global.css?v=1" />

    <!-- swiper styles/css -->
    <link rel="stylesheet" href="styles/swiper.css?v=1" />

    <!-- slider styles/css -->
    <link rel="stylesheet" href="styles/SliderWithButton.css?v=2" />

</head>

<body>
    <section id="navigation-bar">
        <div class="navbar">
            <div>
                <a href="index.php" class="logo">
                    <?php
                        mysqli_select_db($con, 'cms');
                        $getLogo = "SELECT * FROM logo WHERE id = '1'";
                        $logo = mysqli_query($con, $getLogo);
                        while ($row = mysqli_fetch_array($logo)){
                            $image = $row['Image'];
                            echo "<img src='public/images/$image' alt='Logo' height='85px'>";
                        }
                    ?>
                </a>
            </div>
            <div class="nav-items">
                <a href="shop/index.php">Shop</a>
                <a href="about.php">about</a>
                <div class="dropdown">
                    <a>Contact</a>
                    <div class="dropdown-content">
                        <a href="shop/appointment.php">Book an appointment</a>
                        <a href="contact.php">Ask a question</a>

                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="hero-section-landing" id="hero-section-landing">

        <div class="dark"></div>
        <div class="hero">
            <h1 class="light">Personalized Eye Care for you and your family</h1>
            <button class="hero-btn" onclick="scrollToAbout()">See More</button>
        </div>
    </section>
    <?php
        mysqli_select_db($con, 'cms');
        $getLogo = "SELECT * FROM background WHERE id = '1'";
        $logo = mysqli_query($con, $getLogo);
        while ($row = mysqli_fetch_array($logo)){
            $image = $row['Image'];
            echo "<script>
                document.getElementById('hero-section-landing').style.backgroundImage = 'url(\'public/images/$image\')';
            </script>";
        }
    ?>
    <section id="about">
        <div class="container about-cont">
            <div class="about-desc">
                <h2 class="dark-text section-header">ABOUT</h2>
                <div class="">
                    <h3 class="dark-text about-header">Eye Vision: Your Vision, Our Passion</h3>
                    <p class="about-description">
                        At Eye Vision Clinic, we believe in the transformative power of clear vision.
                        Our journey began with a simple but profound mission: to provide exceptional
                        eye care and vision solutions that change lives for the better. With a
                        team of dedicated professionals, cutting-edge technology, and a
                        commitment to your well-being, we've become a trusted partner in your
                        vision health.
                    </p>

                    <div>
                        <a href="about.php" class="aboutbtn">About Us</a>

                    </div>
                </div>
            </div>

            <div>
                <img src="public/images/backgrounds/bg-4.jpg" alt="" class="about-image" />
            </div>
        </div>
    </section>

    <section id="testimonials">
        <div class="container">
            <p class="section-title">TESTIMONIALS</p>
            <h2 class="dark-text title-bold">Real People. Real Talk. <br>
                Eye Care Like No Other Defined.
            </h2>
            <div class="slider-container">
                <div class="slider">
                    <div class="slide">
                        <div class="testimonial">
                            <div class="customerTestimonial">
                                <p>
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                    Obcaecati sit doloribus, vero pariatur vel laboriosam. Dolor
                                    tempora doloribus quod deserunt officiis laborum illo labore,
                                    inventore illum sunt odio, tenetur saepe.
                                </p>
                            </div>
                            <div class="customerName">
                                <h2 class="dark-text">John M.</h2>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="testimonial">
                            <div class="customerTestimonial">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum nemo aperiam,
                                    veniam nihil magni, suscipit recusandae ut laboriosam, unde ipsam corrupti in modi
                                    quam. Repudiandae ad dolores temporibus dicta repellat atque a magni similique? Odit
                                    ducimus tempore molestias delectus molestiae.
                                </p>
                            </div>
                            <div class="customerName">
                                <h2 class="dark-text">John M.</h2>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="testimonial">
                            <div class="customerTestimonial">
                                <p>
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                    Obcaecati sit doloribus, vero pariatur vel laboriosam. Dolor
                                    tempora doloribus quod deserunt officiis laborum illo labore,
                                    inventore illum sunt odio, tenetur saepe.
                                </p>
                            </div>
                            <div class="customerName">
                                <h2 class="dark-text">John M.</h2>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="testimonial">
                            <div class="customerTestimonial">
                                <p>
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                    Obcaecati sit doloribus, vero pariatur vel laboriosam. Dolor
                                    tempora doloribus quod deserunt officiis
                                </p>
                            </div>
                            <div class="customerName">
                                <h2 class="dark-text">John M.</h2>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="testimonial">
                            <div class="customerTestimonial">
                                <p>
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                    Obcaecati sit doloribus, vero pariatur vel laboriosam. Dolor
                                    tempora doloribus quod deserunt officiis laborum illo labore,
                                    inventore illum sunt odio, tenetur saepe.
                                </p>
                            </div>
                            <div class="customerName">
                                <h2 class="dark-text">John M.</h2>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="testimonial">
                            <div class="customerTestimonial">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Accusamus sed tempora nam officia! Vel distinctio aliquid dolore
                                    similique quod id mollitia quia corporis officiis rem.
                                </p>
                            </div>
                            <div class="customerName">
                                <h2 class="dark-text">John M.</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-controls">
                    <button class="prev-slide">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="#5775B7" width="24" height="24">
                            <path stroke="black" stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <button class="next-slide">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            width="24" height="24" stroke="white">
                            <path stroke="black" stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

    </section>

    <section id="shop">
        <div class="container shop-cont">
            <div class="shop-image">
                <img src="public/images/about.jpg" alt="" />
            </div>
            <div class="shop-desc">
                <p class="section-header">SHOP</p>
                <div class="">
                    <h3 class="dark-text shop-header">Shop Now for Clear Vision</h3>
                    <p class="shop-description">
                        Elevate your vision and style with our exclusive online store.
                        At Eye Vision, we've made it easy for you to access premium eyewear,
                        contact lenses, and eye care essentials from the comfort of your own
                        home. Step into a world of clarity and convenience.
                    </p>
                    <div>
                        <a href="shop/index.php" class="shopbtn">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="appointment">
        <div class="container">
            <div class="appointment">
                <div class="appointment-img">
                    <img src="public/images/backgrounds/homepage-appointment.png" alt="">
                </div>
                <div class="appointment-banner-content">
                    <p class="section-title">ELEVATE YOUR EYE CARE EXPERIENCE</p>
                    <h2 class="light">Experience Eye Care Like No Other.</h2>
                    <p>Take charge of your health. Don’t delay, book your eye check-up now
                        and discover exceptional eye care with us.
                    </p>
                    <a href="appointment.php" class="appointment-btn">Schedule Your Appointment Now</a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="backToTop">
                <p onclick="scrollToTop()" class="scroll">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20" width="auto" stroke-width="1.5"
                        stroke="black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                    </svg>
                </p>
            </div>
            <div class="footer-content">
                <div class="footer-logo">
                    <a href="index.php">
                        <?php
                        mysqli_select_db($con, 'cms');
                        $getLogo = "SELECT * FROM logo WHERE id = '1'";
                        $logo = mysqli_query($con, $getLogo);
                        while ($row = mysqli_fetch_array($logo)){
                            $image = $row['Image'];
                            echo "<img src='public/images/$image' alt='Logo' height='150px'>";
                        }
                    ?>
                    </a>
                </div>
                <div class="two-column">
                    <div>
                        <h3 class="dark-text">Products</h3>
                        <div class="footer-item">
                            <a href="shop/index.php">Shop</a>
                        </div>
                    </div>
                    <div>
                        <h3 class="dark-text">About</h3>
                        <div class="footer-item">
                            <a href="about.php">About Us</a>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="dark-text">Help</h3>
                    <div class="footer-item">
                        <a href="shop/appointment.php">Book an appointment</a>
                        <a href="contact.php">Ask a question</a>
                    </div>
                </div>
                <div class="two-column">
                    <div>
                        <h3 class="dark-text">Terms & Conditions</h3>
                        <div class="footer-item">
                            <a href="">Terms & Conditions</a>
                        </div>
                    </div>
                    <div>
                        <h3 class="dark-text">Privacy Policy</h3>
                        <div class="footer-item">
                            <a href="">Privacy Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="footer-bottom">
        <div class="footer-container">
            <p>© 2023. Eye Vision. All right reserved.</p>
        </div>
    </div>

    <script src="javascript/slider.js?v=1"></script>
    <script src="javascript/account.js"></script>
    <script src="javascript/displayContent.js?v=1"></script>
</body>

</html>

<?php
    mysqli_select_db($con, 'cms');
    $getColor = "SELECT * FROM color WHERE id = '1'";
    $color = mysqli_query($con, $getColor);
    while ($row = mysqli_fetch_array($color)){
        $darkColor = $row['darkColor'];
        $lightColor = $row['lightColor'];
    }
    echo "<script>
        let elementsWithDarkClass = document.getElementsByClassName('dark-text');
        for (var i = 0; i < elementsWithDarkClass.length; i++) {
            elementsWithDarkClass[i].style.color = '$darkColor';
        }

        let elementsWithLightClass = document.getElementsByClassName('light');
        for (var i = 0; i < elementsWithLightClass.length; i++) {
            elementsWithLightClass[i].style.color = '$lightColor';
        }
    </script>";
?>