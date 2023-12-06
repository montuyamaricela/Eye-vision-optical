<?php
    include 'db_connection.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Privacy Notice</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700&family=Lato:wght@300;400;700;900&family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="styles/privacy-notice.css" />


</head>

<body>
    <section>
        <div class="logo">
            <?php
                mysqli_select_db($con, 'cms');
                $getLogo = "SELECT * FROM logo WHERE id = '1'";
                $logo = mysqli_query($con, $getLogo);
                while ($row = mysqli_fetch_array($logo)){
                    $image = $row['Image'];
                    echo "<img src='public/images/$image' alt='Logo' height='150px'>";
                }
            ?>
            <!-- <img src="public/images/logo/logo.png" alt="Logo" height="150"> -->
        </div>
        <div>
            <p class="description">Welcome to Eye vision! Your privacy is important to us, and we are committed to
                protecting your
                personal
                information. This Privacy Notice explains how we collect, use, disclose, and safeguard your data when
                you use our website. Please take a moment to review the following information:</p>
        </div>
        <div class="content">
            <div>
                <div class="header">
                    <div class="outer-circle">
                        <div class="inner-circle">

                        </div>
                    </div>
                    <h2>Information We Collect:</h2>
                </div>
                <ul>
                    <li class="bold">
                        Personal Information
                        <ul>
                            <li class="no-bullet">
                                We may collect personal information such as your name, email address, address, and phone
                                number when you voluntarily provide it.
                            </li>
                        </ul>
                    </li>
                    <li class="bold">
                        Usage Data
                        <ul>
                            <li class="no-bullet">We collect information about your interactions with our e-commerce
                                platform, including
                                pages viewed, products searched, and items added to your shopping cart.</li>
                            <li class="no-bullet">When you make a purchase, we collect data related to the transaction,
                                such as product
                                details, order total, payment information, and shipping address</li>
                            <li class="no-bullet">If you create an account, we may collect data about your account
                                activity, such as login
                                times, order history, and saved preferences.</li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div>
                <div class="header">
                    <div class="outer-circle">
                        <div class="inner-circle">

                        </div>
                    </div>
                    <h2>Sharing your information</h2>
                </div>
                <ul>
                    <li class="no-bullet">
                        <ul>
                            <li class="no-bullet">
                                We do not sell, trade, or rent your personal information to third parties. However, we
                                may share information with trusted service providers who assist us in operating our
                                website, conducting business, or servicing you.
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <div>
                <div class="header">
                    <div class="outer-circle">
                        <div class="inner-circle">

                        </div>
                    </div>
                    <h2>Your Choices</h2>
                </div>
                <ul>
                    <li class="no-bullet">
                        <ul>
                            <li class="no-bullet">
                                You have the right to control the information you provide. You can update your
                                preferences, request access or deletion of your personal information.
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <div>
                <div class="header">
                    <div class="outer-circle">
                        <div class="inner-circle">

                        </div>
                    </div>
                    <h2>Contact Us</h2>
                </div>
                <ul>
                    <li class="no-bullet">
                        <ul>
                            <li class="no-bullet">
                                If you have any questions, concerns, or requests regarding your privacy, please contact
                                us at optical.eyevisionclinic@gmail.com.
                            </li>
                        </ul>
                    </li>
                    <li class="no-bullet">
                        <ul>
                            <li class="no-bullet">
                                Thank you for trusting Eye Vision Optical. We value your privacy and are dedicated to
                                protecting your personal information.
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</body>

</html>