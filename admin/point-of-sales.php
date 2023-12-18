<?php
    session_start();
    
    if (isset($_SESSION['adminLoggedin']) && $_SESSION['adminLoggedin'] === false || empty($_SESSION) || empty($_SESSION['adminLoggedin'])) {
        echo "<script>
            location.href='login.php'
        </script>";
    }
    include '../db_connection.php';
    mysqli_select_db($con, 'product');

    $filter_category = isset($_GET['category']) ? $_GET['category'] : '';
    $search_item = isset($_GET['product-name']) ? $_GET['product-name'] : '';

    $sql = "SELECT * FROM products";

    // Add condition to filter by category if selected
    if (!empty($filter_category)) {
        $sql .= " WHERE Category = '$filter_category'";
    }

    // Add condition to filter by product name if provided
    if (!empty($search_item)) {
        // If there is already a WHERE clause, use AND; otherwise, add WHERE
        $sql .= empty($filter_category) ? " WHERE" : " AND";
        $sql .= " Name = '$search_item'";
    }

    $result = mysqli_query($con, $sql);

?>
<html>

<head>
    <title>Reports</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700&family=Inter:wght@300; 400;500;600;700&family=Lato:wght@300;400;700;900&family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../styles/dashboardGlobal.css?v=38">
    <link rel="stylesheet" href="../styles/global.css?v=1">
</head>

<body>
    <section id="darkbg"></section>
    <section id="confirmation">
        <div class="box-content">
            <div>
                <img src="../public/images/icons/warning.png" alt="warning">
            </div>
            <div>
                <h2 id="popupHeader">Do you want void items?</h2>
                <div id="enterPassword" style="display:none">
                    <p class="popuptext">Please enter admin password</p>
                    <form action="point-of-sales.php" id="verify-admin" method="POST">
                        <div class="form-input">
                            <label class="error" id="error"></label>
                            <input type="password" name="password" id="password" required>
                        </div>
                    </form>

                </div>

                <div class="buttonRow" id="buttonRow">
                    <button class="buttonYes" id="buttonSubmit" onclick="submit()" style="display:none">Submit</button>
                    <button class="buttonYes" id="buttonYes" onclick="verifyAdmin()">Yes</button>
                    <button class="buttonNo" id="buttonNo" onclick="closePopup()">No</button>
                </div>
            </div>
    </section>
    <section id="dashboard">
        <!-- <div class="sidebar">
            <div class="logo">
                <img src="../public/images/logo/logo-no-bg.png" alt="logo" width="100px">
            </div>
            <div class="sidebar-items">
                <a href="index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </a>
                <a href="users-account.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </a>
                <a href="appointment.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                    </svg>
                </a>
                <a href="patient-history.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                    </svg>

                </a>
                <a href="payment-history.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                    </svg>

                </a>
                <a href="products-category.php
                ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap=" round" stroke-linejoin="round"
                            d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                    </svg>
                </a>
                <a href="products.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                    </svg>
                </a>

                <a href="modify-customer-page.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                    </svg>
                </a>
                <a href="point-of-sales.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="activeSvg" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                    </svg>
                </a>
                <a href="logout.php" class="logout-admin">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </a>
            </div>

        </div> -->
        <div class="content">
            <!-- <div class="topbar">Top bar</div> -->
            <div class="main-content">
                <div class="content-header">
                    <div class="pos">
                        <!-- items -->
                        <div class="pos-item">
                            <!-- search bar -->
                            <div class="upper">
                                <form action="point-of-sales.php" method="GET">
                                    <div class="search-item">
                                        <input type="text" name="product-name" placeholder="Search items here..">
                                        <button type="submit" class="search-prod">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" width="20">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>

                            </div>

                            <!-- filters -->
                            <div class="filterSection">
                                <p class="section-header">Filters</p>
                                <div class="filters">
                                    <a href="point-of-sales.php"
                                        class="<?php echo empty($_GET['category']) ? 'active' : ''?>">All</a>

                                    <?php
                                        $getCategories = "SELECT * FROM category";
                                        $categories = mysqli_query($con, $getCategories);
                                        while ($row = mysqli_fetch_array($categories)) { 
                                            $categoryName = $row['Category_name'];
                                            $isActive = isset($_GET['category']) && $_GET['category'] == $categoryName;
                                            ?>

                                    <a href=" point-of-sales.php?category=<?php echo $row['Category_name']?>"
                                        class="<?php echo $isActive ? 'active' : ''; ?>">
                                        <?php echo $row['Category_name']?>
                                    </a>

                                    <?php } ?>

                                </div>
                            </div>

                            <!-- products -->
                            <div class="product-list">
                                <?php if (mysqli_num_rows($result) === 0){
                                    echo "<h3>Product Not Available</h3>";

                                }?>
                                <!-- eto na 'yung naka while loop -->
                                <?php while($row = mysqli_fetch_array($result)){ 
                                    $categ = $row['Category'];
                                    if ($row['Stock'] != 0) {?>
                                <div class="product-card"
                                    onclick="addProductToCheckout('<?php echo $row['ID']; ?>', '<?php echo $row['Name']; ?>', <?php echo $row['Price']; ?>, <?php echo $row['Stock']; ?>)">
                                    <div>
                                        <?php  if ($categ === 'Contact Lenses') {
                                            echo "<img src='../public/images/products/Contactlens.jpeg' alt='Contact Lens' width='200'/>";
                                        } else { ?>
                                            <img src="../public/images/<?php echo $row['Image']?>" alt="<?php echo $row['Name'];?>">
                                        <?php } ?>
                                    </div>
                                    <p class="product-name"><?php echo $row['Name']?></p>
                                    <p class="product-price">₱<?php echo $row['Price']?></p>
                                </div>



                                <?php } } ?>

                            </div>

                        </div>


                        <!-- transaction -->
                        <div class="pos-transaction">
                            <h3>Checkout</h3>
                            <div class="pos-trans">
                                <div class="table">

                                    <table>
                                        <tr>
                                            <th width="50px">&nbsp; </th>
                                            <th width="180px">Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                        <tbody id="checkout-table-body">

                                        </tbody>

                                    </table>
                                </div>
                                <div class="transaction">
                                    <div class="row-total">
                                        <p>Total</p>
                                        <p id="total">₱0</p>
                                    </div>
                                    <form action="transaction-success.php" method="POST" id="transaction-success">
                                        <input type="hidden" id="data-field" name="data" value="">

                                        <div class="row">
                                            <p>Payment</p>
                                            <input type="number" id="paymentInput" min="0">
                                        </div>
                                        <div class="row">
                                            <p>Change</p>
                                            <input id="changeInput" placeholder="0" readonly>
                                        </div>
                                        <div class="row">
                                            <button class="button" type="button" onclick="displayPopup()">Void
                                            </button>
                                            <button class="button" type="button" id="calculate"
                                                onclick="calculateChange()">Calculate
                                                Change</button>

                                            <button class="button" id="print" type="button"
                                                onclick="checkoutProduct()">Print Receipt
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="../javascript/point-of-sales.js?v=11"></script>
</body>

</html>

<?php
    $getAdminInfo = "SELECT * FROM user.admin WHERE ID = 1";
    $admin = mysqli_query($con, $getAdminInfo);
    if ($row = mysqli_fetch_array($admin)){
                        
        $adminPassword = $row['Password'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $password = $_POST['password'];
        if ($password === $adminPassword){
            echo "<script>
            voidTransaction();
            </script>";
        } else {
            echo "<script>
            displayPopup();
            verifyAdmin();
            document.getElementById('error').style.display='block';
            document.getElementById('error').innerHTML='Incorrect password! Please try again';
            </script>";
        }
    }

?>