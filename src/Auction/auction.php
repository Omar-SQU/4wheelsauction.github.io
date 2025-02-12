<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- link stylesheet -->
  <link href="style.css" rel="stylesheet" />
  <!-- Link Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <!-- Reactjs framework -->
  <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  <!--Link font Awesome for icons use -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>4WheelsAuction: Bid on Vehicles with Real-Time Auction Insights</title>
  <link rel="icon" type="image/png" href="./img/logo2.png">
  <style>
    .table-spacing{
      padding-top: 2.5em;
    }

    #header-style-table{
      background-color: #192039;
      color: whitesmoke;
      text-align: center;
    }

  </style>

</head>

<body>
  <!-- The navigation bar HEADER -->
  <div class="container-fluid" id="nav_custom">
    <nav class="navbar navbar-expand-sm bg-dark-custom navbar-dark">
      <!-- Navigation Layout justify to the left -->
      <div class="container-fluid">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><img src="logo.png" alt="logo" width="50px" height="50px" /></li>
          <li class="nav-item"><a class="nav-link" href="..\index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="..\Car Listings\car_listings.html">Car Listings</a></li>
          <li class="nav-item"><a class="nav-link active" href="#">Auction</a></li>
          <li class="nav-item"><a class="nav-link" href="..\Car Details\car_details.html">Car Detail</a></li>
          <li class="nav-item"><a class="nav-link" href="..\Sell or Auction Car\sell_auction.html">Sell/Auction Your Car</a></li>
        </ul>
        <!-- Navigation Layout justify to the right -->
        <ul class="navbar-nav">
          <a href="../Register/login.html"><li class="nav-item"><button type="button" class="btn btn-outline-light me-2" style="margin-left: 10px;">Login</button></li></a>
          <a href="../Register/sign_up.html"><li class="nav-item"><button type="button" class="btn btn-light" style="margin-left: 10px;">Sign-up</button></li></a>
        </ul>
      </div>
    </nav>
  </div>

  <main>

    <!-- Search Form that will be used to search for specific keyword using bootstrap -->
    <div class="container my-3"> 
      <form id="search_form" method="post" action="auction.php">
        <div class="input-group">
          <input type="text" name="search_text" class="form-control" id="search_input" placeholder="Search by Keyword">
          <button class="btn btn-primary" type="submit" id="search_button">Search</button>
        </div>
      </form>
    </div>

    <div class="container table-spacing">
      <table class="table">
        <thead class="thead-dark test">
          <tr>
            <th id="header-style-table"  scope="col">image</th>
            <th id="header-style-table"  scope="col">Lot Info</th>
            <th id="header-style-table"  scope="col">Vehicle Info</th>
            <th id="header-style-table"  scope="col">Sale Info</th>
            <th id="header-style-table"  scope="col">Condition</th>
            <th id="header-style-table"  scope="col">Bid</th>
          </tr>
        </thead>

  <!-- PHP source code -->
  <?php

    class Car_Auction{
      public $sale_info;
      public $image_src;
      public $lot_info;
      public $vehicle_info;
      public $car_condition;
      public $current_bid;

      function __construct($sale_info, $image_src, $lot_info, $vehicle_info, $car_condition, $current_bid){
        $this->sale_info = $sale_info;
        $this->image_src = $image_src;
        $this->lot_info = $lot_info;
        $this->vehicle_info = $vehicle_info;
        $this->car_condition = $car_condition;
        $this->current_bid = $current_bid;
      }

      /*
      * Method to display all the fetched data from the database.
      * @return: html code for single row in string format.
      */
      function get_table_row(){
        return "<tr>".
              "<th scope='row' style='width:200px'>".
              "<img src='{$this->image_src}' width='160' height='120' alt='car image' />".
              "</th>".
              "<td>{$this->lot_info}</td>".
              "<td>{$this->vehicle_info}</td>".
              "<td>{$this->sale_info}<span id='auction-date-text' class='text-danger'><br/>Auction Ends at <br/>2hr and 40min</span></td>".
              "<td>{$this->car_condition}</td>".
              "<td>".
              "Current Bid:<br/>".
              "{$this->current_bid} OMR<br/>".
              "<div style='margin-top: 1em'>".
              "<input type='number' name='bid_value' style='width: 105px'  value='{$this->current_bid}' min='{$this->current_bid}' /><label style='text-indent: 4px'> OMR</label><br/>".
              "<span id='bidding-hint'>Bid according to increment rule</span><br />".
              "<button type='button' class='btn btn-primary' style='margin-top: 0.45em; width: 88px'>Bid</button>".
              "<a href='..\Car Details\car_details.html'><button type='button' class='btn btn-warning' style='margin-top: 0.45em; width: 120px'>More Detail</button></a>".
              "<a href='..\Car Details\car_details.html'><button type='button' class='btn btn-success btn-sm' style='margin-top: 0.45em; width: 140px'>Add to watchlist</button></a>".
              "</div>".
              "</td>".
              "</tr>";
      }
    }

    // server information 
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $db_name = "4wheelsauction";
    $conn = "";

    // connecting to mysql server
    $conn = mysqli_connect($server_name, $username, $password, $db_name);
    
    // Check connection
    if (!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }

    // SQL commands
    $sql = "SELECT * FROM auction_cars";
    $result = mysqli_query($conn, $sql);

    // Will search the database for all the keyword and return an array of car id which will be used later 
    // to display only the searched results/filtered
    $search_bar = $_POST["search_text"];
    $sql_search = "SELECT car_id FROM auction_cars WHERE lot_info LIKE '%$search_bar%' OR vehicle_info LIKE '%$search_bar%' OR sale_info LIKE '%$search_bar%' OR car_condition LIKE '%$search_bar%'";
    $search_result = mysqli_query($conn, $sql_search);
    $car_id = [];
    while($row = mysqli_fetch_assoc($search_result)){
      $car_id[] = $row["car_id"];
    }

    // Creating an array for the row data
    $auction_cars = [];
    
    // Fetch and create object.
    while($row = mysqli_fetch_assoc($result)){ 
      if (in_array($row['car_id'], $car_id)){ // only displays the search result
        $car = new Car_Auction(
          $row['sale_info'],
          $row['img_src'],
          $row['lot_info'],
          $row['vehicle_info'],
          $row['car_condition'],
          $row['Bid_amount']
        );
        $auction_cars[] = $car; // append created object into the array
      }
    }

    // Display all the rows
    foreach ($auction_cars as $car){
      echo $car->get_table_row();
    }

  ?>
  
      </table>
    </div>
  </main>

  <!-- Up Arrow Button -->
  <button id="scrollUpBtn" style="display: none;">
    <i class="fa-solid fa-circle-up"></i>
  </button>


  <!-- Footer Start -->
  <footer class="text-light footer_box" style="background-color: #192039;">
    <div class="container py-5">
      <div class="row">
        <!-- Get to Know Us Section -->
        <div class="col-sm-6 col-md-3 mb-3">
          <h5>Get to Know Us</h5>
          <ul class="list-unstyled">
            <li><a href="..\About Us\about.html" style="color:#9598a6" class="footer-links">About 4 Wheels Auction</a></li>
            <li><a href="..\About Us\about.html#mission" style="color:#9598a6" class="footer-links">Our Mission</a></li>
            <li><a href="..\About Us\about.html" style="color:#9598a6" class="footer-links">The Team</a></li>
          </ul>
        </div>

        <!-- Find a Vehicle Section -->
        <div class="col-sm-6 col-md-3 mb-3">
          <h5>Find a Vehicle</h5>
          <ul class="list-unstyled">
            <li><a href="..\Car Listings\car_listings.html" style="color:#9598a6" class="footer-links">Search Vehicles</a></li>
            <li><a href="..\Car Listings\car_listings.html" style="color:#9598a6" class="footer-links">Car Listings</a></li>
          </ul>
        </div>

        <!-- Services Section -->
        <div class="col-sm-6 col-md-3 mb-3">
          <h5>Services</h5>
          <ul class="list-unstyled">
            <li><a href="..\Sell or Auction Car\sell_auction.html" style="color:#9598a6" class="footer-links">Sell/Auction</a></li>
            <li><a href="..\Sell or Auction Car\sell_auction.html" style="color:#9598a6" class="footer-links">Shipping Options</a></li>
          </ul>
        </div>

        <!-- Support Section -->
        <div class="col-sm-6 col-md-3 mb-3">
          <h5>Support</h5>
          <ul class="list-unstyled">
            <li><a href="..\About Us\about.html" style="color:#9598a6" class="footer-links">FAQs</a></li>
            <li><a href="..\About Us\about.html" style="color:#9598a6" class="footer-links">How to Buy</a></li>
            <li><a href="..\Contact Us\contact.html" style="color:#9598a6" class="footer-links">Contact Us</a></li>
          </ul>
        </div>
      </div>

      <hr class="my-4">

      <!-- Social Media & Copyright -->
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="text-center text-md-start mb-3 mb-md-0">
          <p class="mb-0">©2024 4 Wheels Auction. All Rights Reserved</p>
        </div>

        <div class="text-center">
          <a href="#" class="text-light me-3"><i class="fa-brands fa-linkedin Social-icons"></i></a>
          <a href="#" class="text-light me-3"><i class="fa-brands fa-instagram Social-icons"></i></a>
          <a href="#" class="text-light me-3"><i class="fa-solid fa-x Social-icons"></i></a>
          <a href="#" class="text-light  me-3"><i class="fa-brands fa-youtube Social-icons"></i></a>
          <a href="mailto:info@4wheelsauction.com" class="text-light"><i
              class="fa-solid fa-envelope Social-icons"></i></a>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer End -->

  <script type="text/javaScript" src="script.js"></script>

</body>

</html>