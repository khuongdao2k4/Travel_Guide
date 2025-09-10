<?php
include 'connectDB.php';

$regionId = $_GET['region'] ?? '';
$cityId = $_GET['city'] ?? '';
$placeId = $_GET['place'] ?? '';
$categoryId = $_GET['category'] ?? '';

$sql = "
    SELECT locations.*, cities.name AS city_name, regions.name AS region_name, categories.name AS category_name
    FROM locations
    JOIN cities ON locations.city_id = cities.id
    JOIN regions ON cities.region_id = regions.id
    JOIN categories ON locations.category_id = categories.id
    WHERE 1
";

if (!empty($regionId)) {
  $sql .= " AND regions.id = " . intval($regionId);
}
if (!empty($cityId)) {
  $sql .= " AND cities.id = " . intval($cityId);
}
if (!empty($placeId)) {
  $sql .= " AND locations.id = " . intval($placeId);
}
if (!empty($categoryId)) {
  $sql .= " AND categories.id = " . intval($categoryId);
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <title>Pacific - Free Bootstrap 4 Template by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="css/animate.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">


  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html">Pacific<span>Travel Agency</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
        aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
          <li class="nav-item active"><a href="destination.php" class="nav-link">Destination</a></li>
          <li class="nav-item"><a href="hotel.html" class="nav-link">Hotel</a></li>
          <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
        <div class="col-md-9 ftco-animate pb-5 text-center">
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home
                <i class="fa fa-chevron-right"></i></a></span> <span>Tour List <i
                class="fa fa-chevron-right"></i></span>
          </p>
          <h1 class="mb-0 bread">Tours List</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-no-pb">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="search-wrap-1 ftco-animate">
            <?php
            $regions = $conn->query("SELECT id, name FROM regions");
            $cities = $conn->query("SELECT id, name, region_id FROM cities");
            $locations = $conn->query("SELECT id, name, city_id FROM locations");
            $categories = $conn->query("SELECT id, name FROM categories");

            $citiesArray = [];
            while ($row = $cities->fetch_assoc()) {
              $citiesArray[] = $row;
            }

            $locationsArray = [];
            while ($row = $locations->fetch_assoc()) {
              $locationsArray[] = $row;
            }

            ?>
            <form action="destination.php" class="search-property-1" method="GET">
              <div class="row no-gutters">

                <!-- Miền -->
                <div class="col-md d-flex">
                  <div class="form-group p-4 border-0">
                    <label for="region">MIỀN</label>
                    <div class="form-field">
                      <div class="icon"><span class="fa fa-search"></span></div>
                      <select name="region" id="region" class="form-control">
                        <option value="">Chọn Theo Miền</option>
                        <?php foreach ($regions as $row): ?>
                          <option value="<?= $row['id'] ?>">
                            <?= htmlspecialchars($row['name']) ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Tỉnh/Thành phố -->
                <div class="col-md d-flex">
                  <div class="form-group p-4">
                    <label for="province">THÀNH PHỐ</label>
                    <div class="form-field">
                      <div class="icon"><span class="fa fa-search"></span></div>
                      <select name="city" id="city" class="form-control">
                        <option value="">Chọn Theo Thành Phố</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Địa Điểm -->
                <div class="col-md d-flex">
                  <div class="form-group p-4">
                    <label for="place">ĐỊA ĐIỂM</label>
                    <div class="form-field">
                      <div class="icon"><span class="fa fa-search"></span></div>
                      <select name="place" id="place" class="form-control">
                        <option value="">Chọn Theo Địa Điểm</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Thể Loại -->
                <div class="col-md d-flex">
                  <div class="form-group p-4">
                    <label for="category">THỂ LOẠI</label>
                    <div class="form-field">
                      <div class="select-wrap">
                        <div class="icon"><span class="fa fa-chevron-down"></span>
                        </div>
                        <select name="category" id="category" class="form-control">
                          <option value="">Du Lịch Nghỉ Dưỡng</option>
                          <?php foreach ($categories as $row): ?>
                            <option value="<?= $row['id'] ?>">
                              <?= htmlspecialchars($row['name']) ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Nút tìm kiếm -->
                <div class="col-md d-flex">
                  <div class="form-group d-flex w-100 border-0">
                    <div class="form-field w-100 align-items-center d-flex">
                      <input type="submit" value="SEARCH" class="align-self-stretch form-control btn btn-primary">
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <script>
              const cities = <?= json_encode($citiesArray ?? []) ?>;        // lấy từ bảng cities
              const locations = <?= json_encode($locationsArray ?? []) ?>;  // lấy từ bảng locations

              const regionSelect = document.getElementById('region');
              const citySelect = document.getElementById('city');   // combobox thành phố (giữ id="province" nếu HTML chưa đổi)
              const locationSelect = document.getElementById('place');  // combobox địa điểm

              // Khi chọn Miền -> lọc Thành phố
              regionSelect.addEventListener('change', function () {
                const regionId = this.value;
                citySelect.innerHTML = '<option value="">Chọn Theo Thành Phố</option>';
                locationSelect.innerHTML = '<option value="">Chọn Theo Địa Điểm</option>';

                cities.forEach(c => {
                  if (c.region_id == regionId) {
                    const option = document.createElement('option');
                    option.value = c.id;
                    option.textContent = c.name;
                    citySelect.appendChild(option);
                  }
                });
              });

              // Khi chọn Thành phố -> lọc Địa điểm
              citySelect.addEventListener('change', function () {
                const cityId = this.value;
                locationSelect.innerHTML = '<option value="">Chọn Theo Địa Điểm</option>';

                locations.forEach(loc => {
                  if (loc.city_id == cityId) {
                    const option = document.createElement('option');
                    option.value = loc.id;
                    option.textContent = loc.name;
                    locationSelect.appendChild(option);
                  }
                });
              });
            </script>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section">
    <div class="container">
      <div class="row">
        <?php if ($result && $result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 ftco-animate mb-4">
              <div class="project-wrap shadow-sm rounded overflow-hidden h-100">
                <!-- Ảnh -->
                <a href="place_details.php?id=<?= $row['id'] ?>" class="img d-block"
                  style="background-image: url('<?= htmlspecialchars($row['main_image'] ?? "uploads/default.jpg") ?>'); height:220px; background-size:cover; background-position:center;">
                  <span class="price badge bg-danger position-absolute m-2">Hot</span>
                </a>

                <!-- Nội dung -->
                <div class="text p-3 bg-white">
                  <!-- Tên -->
                  <h3 class="mb-2 fw-bold">
                    <a href="place_details.php?id=<?= $row['id'] ?>" class="text-dark">
                      <?= htmlspecialchars($row['name']) ?>
                    </a>
                  </h3>

                  <!-- Địa chỉ -->
                  <?php if (!empty($row['address'])): ?>
                    <p class="location mb-2 text-muted small">
                      <span class="fa fa-map-marker text-danger me-1"></span>
                      <?= htmlspecialchars($row['address']) ?>
                    </p>
                  <?php endif; ?>

                  <!-- Đánh giá + Thời gian tham quan -->
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="rating text-warning">
                      <i class="fa fa-star"></i> <?= number_format($row['rating'], 1) ?>/5
                    </span>
                    <span class="visit-time text-primary small">
                      <i class="fa fa-clock"></i> <?= $row['visit_time'] ?> giờ
                    </span>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="text-center text-muted">Không tìm thấy kết quả phù hợp.</p>
        <?php endif; ?>
      </div>

      <div class="row mt-5">
        <div class="col text-center">
          <div class="block-27">
            <ul>
              <li><a href="#">&lt;</a></li>
              <li class="active"><span>1</span></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">&gt;</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>




  <section class="ftco-intro ftco-section ftco-no-pt">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 text-center">
          <div class="img" style="background-image: url(images/bg_2.jpg);">
            <div class="overlay"></div>
            <h2>We Are Pacific A Travel Agency</h2>
            <p>We can manage your dream building A small river named Duden flows by their place</p>
            <p class="mb-0"><a href="#" class="btn btn-primary px-4 py-3">Ask For A Quote</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="ftco-footer bg-bottom ftco-no-pt" style="background-image: url(images/bg_3.jpg);">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md pt-5">
          <div class="ftco-footer-widget pt-md-5 mb-4">
            <h2 class="ftco-heading-2">About</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the
              blind texts.</p>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft">
              <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md pt-5 border-left">
          <div class="ftco-footer-widget pt-md-5 mb-4 ml-md-5">
            <h2 class="ftco-heading-2">Infromation</h2>
            <ul class="list-unstyled">
              <li><a href="#" class="py-2 d-block">Online Enquiry</a></li>
              <li><a href="#" class="py-2 d-block">General Enquiries</a></li>
              <li><a href="#" class="py-2 d-block">Booking Conditions</a></li>
              <li><a href="#" class="py-2 d-block">Privacy and Policy</a></li>
              <li><a href="#" class="py-2 d-block">Refund Policy</a></li>
              <li><a href="#" class="py-2 d-block">Call Us</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md pt-5 border-left">
          <div class="ftco-footer-widget pt-md-5 mb-4">
            <h2 class="ftco-heading-2">Experience</h2>
            <ul class="list-unstyled">
              <li><a href="#" class="py-2 d-block">Adventure</a></li>
              <li><a href="#" class="py-2 d-block">Hotel and Restaurant</a></li>
              <li><a href="#" class="py-2 d-block">Beach</a></li>
              <li><a href="#" class="py-2 d-block">Nature</a></li>
              <li><a href="#" class="py-2 d-block">Camping</a></li>
              <li><a href="#" class="py-2 d-block">Party</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md pt-5 border-left">
          <div class="ftco-footer-widget pt-md-5 mb-4">
            <h2 class="ftco-heading-2">Have a Questions?</h2>
            <div class="block-23 mb-3">
              <ul>
                <li><span class="icon fa fa-map-marker"></span><span class="text">203 Fake St. Mountain View, San
                    Francisco, California, USA</span></li>
                <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                <li><a href="#"><span class="icon fa fa-paper-plane"></span><span
                      class="text">info@yourdomain.com</span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">

          <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;
            <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with
            <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
              target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </p>
        </div>
      </div>
    </div>
  </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
        stroke="#F96D00" />
    </svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

</body>

</html>