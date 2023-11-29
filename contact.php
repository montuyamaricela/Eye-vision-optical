<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700&family=Lato:wght@300;400;700;900&family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Contact page styles/css -->
    <link rel="stylesheet" href="styles/contactUs.css?v=1" />

    <!-- global styles/css -->
    <link rel="stylesheet" href="styles/global.css" />
</head>

<body>
    <section id="navigation-bar">
        <div class="navbar">
            <div>
                <a href="index.php" class="logo">
                    <img src="public/images/logo/logo-no-bg.png" alt="" height="85px">
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


    <section id="dark" class="bg-dark"></section>
    <section id="sent" class="sent">
        <div class="content">
            <!-- <p>Thanks for contacting us! We will get in touch with you shortly.</p> -->
            <p id="message"></p>
            <div class="closebtn" onClick="hidePopupMessage()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </section>



    <section class="container">
        <div class="contact-content">
            <div class="content">
                <h2 class="section-title">Contact Us</h2>
                <p class="div-title">Location & Details</p>
                <div class="contact-item">
                    <div class="textWithIcon">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#666666" width="20">
                                <path fill-rule="evenodd"
                                    d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p>Address:</p>
                    </div>
                    <p class="contact-detail">
                        Lorem ipsum dolor sit amet #321, adipisicing elit. Fuga,
                        dignissimos
                    </p>
                </div>
                <div class="contact-item">
                    <div class="textWithIcon">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#666666" width="20">
                                <path fill-rule="evenodd"
                                    d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p>Phone:</p>
                    </div>
                    <p class="contact-detail">
                        0927-656-5832, 0927-656-5832, 0927-656-5832, 0927-656-5832,
                    </p>
                </div>
                <div class="contact-item">
                    <div class="textWithIcon">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#666666" width="20">
                                <path
                                    d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                                <path
                                    d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                            </svg>
                        </div>
                        <p>E-mail:</p>
                    </div>
                    <a class="contact-detail" href="mailto:tjuicyhatdog@gmail.com">tjuicyhatdog@gmail.com</a>
                </div>
            </div>
            <div class="contact-form">
                <h2 class="section-title">&nbsp;</h2>
                <p class="div-title">Send us a message</p>
                <form name="questionForm" action="contact.php" method="POST">
                    <div class="form-input">
                        <label for="name">Your Name:</label>
                        <input type="text" id="name" name="name" required />
                    </div>
                    <div class="form-input">
                        <label for="name">Your E-mail:</label>
                        <input type="email" id="email" name="email" required />
                    </div>
                    <div class="form-input">
                        <label for="name">Your Message:</label>
                        <textarea name="message" id="message" name="message" rows="4" cols="50" required></textarea>
                    </div>
                    <div class="check">
                        <input type="checkbox" required />
                        <p class="span">
                            By ticking this box, you consent to the collection and
                            processing of your personal data, and you confirm that you have
                            read and understood our
                            <a href="privacy-notice.php" target="_blank" class="colored-link">Privacy Notice</a>
                        </p>
                    </div>
                    <button class="submit">Submit</button>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">

            <div class="footer-content">
                <div class="footer-logo">
                    <a href="index.php">
                        <img src="public/images/logo/logo-no-bg.png" alt="" width="150">
                    </a>
                </div>
                <div class="two-column">
                    <div>
                        <h3>Products</h3>
                        <div class="footer-item">
                            <a href="shop/index.php">Shop</a>
                        </div>
                    </div>
                    <div>
                        <h3>About</h3>
                        <div class="footer-item">
                            <a href="about.php">About Us</a>
                        </div>
                    </div>
                </div>
                <div>
                    <h3>Help</h3>
                    <div class="footer-item">
                        <a href="shop/appointment.php">Book an appointment</a>
                        <a href="contact.php">Ask a question</a>
                    </div>
                </div>
                <div class="two-column">
                    <div>
                        <h3>Terms & Conditions</h3>
                        <div class="footer-item">
                            <a href="">Terms & Conditions</a>
                        </div>
                    </div>
                    <div>
                        <h3>Privacy Policy</h3>
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
    <script src="javascript/global.js"></script>

</body>

</html>


<?php 
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $customerName = $_POST["name"];
      $customerEmail = $_POST["email"];
      $customerMessage = $_POST["message"];

      if (empty($customerName) || empty($customerEmail) || empty($customerMessage)){
        echo "<script>alert('All fields are required. Please fill out the form completely.')</script>";
      } else {
        include('db_connection.php'); // Include the database connection script
        mysqli_select_db($con, "Contact");

        $sql = "INSERT INTO QUESTIONS (Name, Email, Message) VALUES ('$customerName', '$customerEmail', '$customerMessage')";
        if (mysqli_query($con, $sql)) {
            echo "<script>
                document.getElementById('dark').style.display = 'flex';
                document.getElementById('sent').style.display = 'flex';
                document.getElementById('message').innerHTML = 'Thanks for contacting us! We will get in touch with you shortly.';
            </script>";
        } else {
            echo "<script>
                document.getElementById('dark').style.display = 'flex';
                document.getElementById('sent').style.display = 'flex';
                document.getElementById('message').innerHTML = 'An error occurred while processing your request. Please try again later.';
            </script>";
          } 
        mysqli_close($con);
      }
  }
?>