<?php
    session_start();
    
    if (isset($_SESSION['adminLoggedin']) && $_SESSION['adminLoggedin'] === false || empty($_SESSION) || empty($_SESSION['adminLoggedin'])) {
        echo "<script>
            location.href='login.php'
        </script>";
    }
    include '../db_connection.php';
    mysqli_select_db($con, 'product');

    $limit = 10;

    if (isset($_GET['page'])) {
        $page_number = $_GET['page'];
    } else {
        $page_number = 1;
    }

    $initial_page = ($page_number - 1) * $limit;

    $filter_category = isset($_GET['filterByCategory']) ? $_GET['filterByCategory'] : '';

    $sql = "SELECT * FROM products";
    
    // Add condition to filter by category if selected
    if (!empty($filter_category)) {
        $sql .= " WHERE Category = '$filter_category'";
    }

    $sql .= " LIMIT $initial_page, $limit";

    $result = mysqli_query($con, $sql);
    
?>
<html>

<head>
    <title>Product List</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700&family=Inter:wght@300; 400;500;600;700&family=Lato:wght@300;400;700;900&family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../styles/dashboardGlobal.css?v=8">
    <link rel="stylesheet" href="../styles/global.css?v=1">
</head>

<body>
    <section id="darkbg" style="display:block"></section>
    <section id="confirmation" style="display:block">
        <div class="success-box-content">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="#172B4D" height="50">
                    <path stroke-linecap="round" fill="" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

            </div>
            <div>
                <h2 id="popupHeader">Successfully Updated!</h2>
                <div class="buttonRow" id="buttonRow">
                    <a href="products.php" class="buttonYes">Close</a>
                </div>
            </div>
        </div>
    </section>

    <section id="dashboard">
        <div class="sidebar">
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
                    <a href="payment-history.php">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                        </svg>

                    </a>
                </a>
                <a href="products-category.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap=" round" stroke-linejoin="round"
                            d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                    </svg>
                </a>
                <a href="products.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="activeSvg" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
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

        </div>
        <div class="content">
            <div class="topbar">
                <?php 
                    $getAdminInfo = "SELECT * FROM user.admin WHERE ID = 1";
                    $admin = mysqli_query($con, $getAdminInfo);
                    if ($row = mysqli_fetch_array($admin)){
                        
                        $AdminName = $row['Name'];
                        $adminProfile = $row['Profile'];
                    }
                ?>
                <div class="dropdown">
                    <div class="currentlyLoggedin">
                        <img src="../public/images/<?php echo $adminProfile; ?>" alt="<?php echo $AdminName;?>"
                            width="45">
                        <p><?php echo $AdminName;?></p>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" height="15">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>

                        </div>
                    </div>

                    <div class="dropdown-content">
                        <a href="account-setting.php">Account Settings</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="content-header">
                    <div>
                        <h2>Products List</h2>
                        <p>View a comprehensive list of all products in the system.</p>
                    </div>
                </div>
                <div class="filterAdd">
                    <form action="">
                        <div class="filterBy">
                            <select name="filterByCategory" id="filterByCategory">
                                <?php
                                    $sqlCategories = "SELECT * FROM category";
                                    $res = mysqli_query($con, $sqlCategories);
                                    if (mysqli_num_rows($res) == 0) {
                                        echo "<option selected disabled>No Categories Found</option>";
                                    } else {
                                      while($row = mysqli_fetch_array($res)) {
                                        $category = $row['Category_name'];
                                        echo "<option value='$category'>$category</option>";
                                      } 
                                    }
                                ?>
                            </select>
                            <button class="">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                                </svg>
                                Filter
                            </button>

                        </div>
                    </form>
                    <div class="button-group">
                        <a href="add-product.php">
                            <button class="button">
                                Add Products
                            </button>
                        </a>
                        <button class="button">Delete</button>
                    </div>

                </div>
                <div class="productsDiv">
                    <form>
                        <table>
                            <thead>
                                <tr>
                                    <th width="10px">
                                        <input type="checkbox" id="header-checkbox">
                                    </th>
                                    <th width="50px">ID</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Color</th>
                                    <th>Category</th>

                                    <th>Description</th>
                                    <th width="90px">Image</th>
                                    <th>Stocks</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($result) == 0) {
                                echo "<td colspan='11'>No records found!</td>";
                            }?>
                                <?php while (
                                $row = mysqli_fetch_array($result)
                            ) { ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="data-checkbox" data-id="<?php echo $row[
                                            'ID'
                                        ]; ?>">
                                    </td>
                                    <td><?php echo $row['ID']; ?></td>
                                    <td><?php echo $row['Name']; ?></td>
                                    <td><?php echo $row['Price']; ?></td>
                                    <td><?php echo $row['Color']; ?></td>
                                    <td><?php echo $row['Category']; ?></td>
                                    <td><?php echo $row['Description']; ?></td>
                                    <td>
                                        <?php
                                            $Image = $row['Image'];
                                            $Name = $row['Name']. "'Image";
                                             echo "<img class='profileImage'  src='../public/images/$Image' alt='$Name' >";
                                    
                                        ?>
                                    </td>
                                    <td><?php echo $row['Stock']; ?></td>

                                    <td>
                                        <div class="actionButton svg-center">
                                            <div class="svgAction" onclick="displayProductsDetails(this)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="#EF7014" class="">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </div>

                                        </div>

                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="pagination">
                    <div>
                        <?php
                        $getQuery = 'SELECT COUNT(*) FROM products';
                        $result = mysqli_query($con, $getQuery);
                        $row = mysqli_fetch_row($result);
                        $total_rows = $row[0];
                        echo '<br>';

                        // get the required number of pages
                        $total_pages = ceil($total_rows / $limit);
                        $pageURL = '';
                        if ($page_number >= 2) {
                            echo "<a href='products.php?page=" .
                                ($page_number - 1) .
                                "'> Prev </a>";
                        }
                        for ($curpage = 1; $curpage <= $total_pages; $curpage++) {
                            if ($curpage == $page_number) {
                                $pageURL .=
                                    "<a class = 'active' href='products.php?page=" .
                                    $curpage .
                                    "'>" .
                                    $curpage .
                                    ' </a>';
                            } else {
                                $pageURL .=
                                    "<a href='products.php?page=" .
                                    $curpage .
                                    "'>" .
                                    $curpage .
                                    ' </a>';
                            }
                        }
                        echo $pageURL;

                        if ($page_number < $total_pages) {
                            echo "<a href='products.php?page=" .
                                ($page_number + 1) .
                                "'> Next </a>";
                        }
                    ?>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Add JavaScript code to handle checkbox functionality -->
    <script src="../javascript/dashboard.js?v=24"></script>

</body>

</html>