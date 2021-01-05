<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--title>Hon Bookstore</title-->
    <title>Books Information management</title>
    <!--CSS File-->
    <link rel="stylesheet" href="./css/display.css">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
    <!--JS files-->
    <!--script src="data/books.js"></script-->
    <script src="js/common.js"></script>
</head>

<body>
    <!--Code from bootstrap-->
    <!--Navbar-->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background: darkslategrey">
        <button type="button" id="sidebarCollapse" class="btn btn-link d-block d-md-none">
            <i class="bx bx-menu icon-single"></i>
        </button>

        <img src="./images/hon1.jpg" alt="hon1" class="logo"></imag>

        <ul class="navbar-nav mr-auto" id="navleft">
            <li class="nav-item active">
                <a class="nav-link" href="./Honbookstore.html">Home <span class="sr-only">(current)</span></a>
            </li>

            <!-- Categories -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Art & Photography</a>
                    <a class="dropdown-item" href="#">Children's Boos</a>
                    <a class="dropdown-item" href="#">History</a>
                    <a class="dropdown-item" href="#">Literature & Fiction</a>
                    <a class="dropdown-item" href="#">Romance</a>
                    <a class="dropdown-item" href="#">Science Fiction & Fantasy</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Sales</a>
                </div>
            </li>

        </ul>

        <!-- Search Bar -->
        <div class="collapse navbar-collapse">
            <form class="form-inline my-2 my-lg-0" id="searchbox">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" id="searchBar">
                <button class="btn btn-success my-2 my-sm-0" type="submit" id="search"
                    onclick="searchFunc(event)">search</button>
            </form>

            <ul class="navbar-nav" id="navright">
                <!-- View cart -->
                <!-- Icon from font-awesome -->
                <li class="nav-item" id="cart">
                    <a href="#!" class="nav-link navbar-link-2 waves-effect">
                        <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
                    </a>
                </li>
                <!-- Sign up link -->
                <li class="nav-item pl-2 mb-2 mb-md-0 d-md-none d-xl-inline-block" id="signup">
                    <a href="#!" type="button"
                        class="btn btn-outline-info btn-md btn-rounded btn-navbar waves-effect waves-light">Sign
                        up</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--Navbar End-->
    <center>
        <h3 class="header">Display New Books Information</h3>
        <table class="table table-hover table-sm" style="width: 800px;">
            <?php
            // connect database
            $conn = mysqli_connect('localhost', 'root', '', 'bookstore');
            // mysqli_select_db($link,DBNAME);

            // $id = $_POST["id"];
            $title = $_POST["title"];
            $description = mysqli_real_escape_string($conn, $_POST['description']);

            $price = $_POST["price"];
            $rating =  $_POST["rating"];
            $imageUrl = './images/' . $_FILES['imageUrl']['name'];
            $slide1 = './images/' . $_FILES["slide1"]['name'];
            $slide2 = './images/' . $_FILES["slide2"]['name'];

            // query books
            $sql = "INSERT INTO allbook(title, description, price, rating, imageUrl, slide1, slide2) VALUES(\"$title\", \"$description\", $price, $rating, \"$imageUrl\", \"$slide1\", \"$slide2\")";
            $result = mysqli_query($conn, $sql);

            // move uploaded images to the imagePath
            $imagePath = "./images/" . $_FILES["imageUrl"]["name"];
            move_uploaded_file($_FILES["imageUrl"]["tmp_name"], $imagePath);
           
            $slide1Path = "./images/" . $_FILES["slide1"]["name"];
            move_uploaded_file($_FILES["slide1"]["tmp_name"], $slide1Path);
            
            $slide2Path = "./images/" . $_FILES["slide2"]["name"];
            move_uploaded_file($_FILES["slide2"]["tmp_name"], $slide2Path);

            ?>

            <!-- Display the added book information -->
            <tr>
                <th scope="row">Title </th>
                <td><?php echo $title ?></td>
            </tr>
            <tr class="table-active">
                <th cope="row">Description </th>
                <td><?php echo $description; ?> </td>
            </tr>
            <tr>
                <th scope="row">Price </th>
                <td><?php echo $price ?></td>
            </tr>
            <tr class="table-active">
                <th scope="row">Rating</th>
                <td><?php echo $rating ?></td>
            </tr>
            <tr>
                <th scope="row">Images</th>
                <td>
                    <?php
                    echo "<img src='$imagePath' style: width=199; height=200; align=center> "
                    ?>
                    <?php
                    echo "<img src='$slide1Path' style: width=199; height=200> "
                    ?>
                    <?php
                    echo "<img src='$slide2Path' style: width=199; height=200> ";
                    ?>
                </td>
            </tr>
        </table>
    </center>

    <!--footer-->
    <div class="footer">
        <div class="footer-bottom">&copy; honbookstore.com | Designed by Hassan Ali , Minghui Liao & Kefen Yan </div>
        <div class="footer-content">
            <div class="footer-section about">
                <h5>About Us</h5>
                <p style="font-family:Arial"> This bookstore offer the best service in purchasing any books by putting
                    customer
                    satisfaction first.</p>
            </div>

            <div class="footer-section contact-form">
                <h5>Contact Us</h5>
                <p style="font-family: 'Arial';">(613)-167-3460</p>
            </div>
        </div>
        <div class="footer-section contact-form"></div>
    </div>
</body>

</html>