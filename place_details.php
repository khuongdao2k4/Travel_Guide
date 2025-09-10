<?php
include 'connectDB.php';

$placeId = $_GET['id'] ?? '';
if (empty($placeId)) {
  echo "Không tìm thấy địa điểm.";
  exit;
}

// Truy vấn chi tiết địa điểm (locations) + thông tin liên quan
$sql = "
    SELECT l.*, 
           c.name AS city_name, 
           r.name AS region_name, 
           cat.name AS category_name
    FROM locations l
    JOIN cities c ON l.city_id = c.id
    JOIN regions r ON c.region_id = r.id
    JOIN categories cat ON l.category_id = cat.id
    WHERE l.id = " . intval($placeId);

// Debug nếu cần
// echo "<pre>$sql</pre>";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
  $place = $result->fetch_assoc();
  // Debug: print_r($place);
} else {
  echo "Không tìm thấy thông tin chi tiết.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Pacific</title>
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
  <style>
    body {
      background-color: #f8f9fa;
    }

    .place-header {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      margin-bottom: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .map-responsive {
      overflow: hidden;
      padding-bottom: 56.25%;
      position: relative;
      height: 0;
    }

    .map-responsive iframe {
      left: 0;
      top: 0;
      height: 100%;
      width: 100%;
      position: absolute;
    }

    .ftco-section.detail {
      padding-top: 0px !important
    }
  </style>
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
          <li class="nav-item active"><a href="about.php" class="nav-link">About</a></li>
          <li class="nav-item"><a href="destination.php" class="nav-link">Destination</a></li>
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
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
                  class="fa fa-chevron-right"></i></a></span> <span>Place Detail <i
                class="fa fa-chevron-right"></i></span>
          </p>
          <h1 class="mb-0 bread">Place Detail</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section services-section">
    <div class="container">
      <div class="row d-flex">
        <div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
          <div class="w-100">
            <span class="subheading">Welcome to Pacific</span>
            <h2 class="mb-4">It's time to start your adventure</h2>
            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a
              paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the
              blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language
              ocean.
              A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            <p><a href="#" class="btn btn-primary py-3 px-4">Search Destination</a></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
              <div class="services services-1 color-1 d-block img"
                style="background-image: url(images/services-1.jpg);">
                <div class="icon d-flex align-items-center justify-content-center"><span
                    class="flaticon-paragliding"></span></div>
                <div class="media-body">
                  <h3 class="heading mb-3">Activities</h3>
                  <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
              <div class="services services-1 color-2 d-block img"
                style="background-image: url(images/services-2.jpg);">
                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span>
                </div>
                <div class="media-body">
                  <h3 class="heading mb-3">Travel Arrangements</h3>
                  <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
              <div class="services services-1 color-3 d-block img"
                style="background-image: url(images/services-3.jpg);">
                <div class="icon d-flex align-items-center justify-content-center"><span
                    class="flaticon-tour-guide"></span></div>
                <div class="media-body">
                  <h3 class="heading mb-3">Private Guide</h3>
                  <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
              <div class="services services-1 color-4 d-block img"
                style="background-image: url(images/services-4.jpg);">
                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-map"></span>
                </div>
                <div class="media-body">
                  <h3 class="heading mb-3">Location Manager</h3>
                  <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-about img" style="background-image: url(images/bg_4.jpg);">
    <div class="overlay"></div>
    <div class="container py-md-5">
      <div class="row py-md-5">
        <div class="col-md d-flex align-items-center justify-content-center">
          <a href="https://vimeo.com/45830194"
            class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
            <span class="fa fa-play"></span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-about ftco-no-pt img">
    <div class="container">
      <div class="row d-flex">
        <div class="col-md-12 about-intro">
          <div class="row">
            <div class="col-md-6 d-flex align-items-stretch">
              <div class="img d-flex w-100 align-items-center justify-content-center"
                style="background-image:url(images/about-1.jpg);">
              </div>
            </div>
            <div class="col-md-6 pl-md-5 py-5">
              <div class="row justify-content-start pb-3">
                <div class="col-md-12 heading-section ftco-animate">
                  <span class="subheading">About Us</span>
                  <h2 class="mb-4">Make Your Tour Memorable and Safe With Us</h2>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                    the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large
                    language ocean.</p>
                  <p><a href="#" class="btn btn-primary">Book Your Destination</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section detail">
    <div class="container my-5">
      <div class="place-header">
        <h2><?= htmlspecialchars($place['name']) ?></h2>
        <p><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($place['address']) ?></p>
        <?php if (!empty($place['main_image'])): ?>
          <img src="<?= htmlspecialchars($place['main_image']) ?>" alt="Ảnh đại diện" class="img-fluid rounded mb-3">
        <?php endif; ?>

        <?php if (!empty($place['content'])): ?>
          <h4>Giới thiệu</h4>
          <p><?= nl2br(htmlspecialchars($place['content'])) ?></p>
        <?php endif; ?>

        <?php if (!empty($place['audio_url'])): ?>
          <h4>Audio hướng dẫn</h4>
          <audio controls class="mb-4">
            <source src="<?= htmlspecialchars($place['audio_url']) ?>" type="audio/mpeg">
            Trình duyệt không hỗ trợ phát audio.
          </audio>
        <?php endif; ?>

        <?php if (!empty($place['article_link'])): ?>
          <h4>Bài viết liên quan</h4>
          <a href="<?= htmlspecialchars($place['article_link']) ?>" class="btn btn-primary" target="_blank">Xem bài
            viết</a>
        <?php endif; ?>

        <br>
        <br>

        <?php if (!empty($place['iframe_map'])): ?>
          <div class="map-responsive mb-4">
            <?= $place['iframe_map'] ?>
          </div>
        <?php endif; ?>
      </div>
      <!-- Form chọn số địa điểm -->
      <form method="POST" class="itinerary-form">
        <div class="form-group-row">
          <label for="num_places" class="form-label">Số địa điểm muốn đi:</label>
          <select name="num_places" id="num_places" class="form-select">
            <?php for ($i = 2; $i <= 10; $i++): ?>
              <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
          </select>
          <button type="submit" name="generate_plan" class="btn-plan">
            🚀 Lên lịch trình
          </button>
        </div>
      </form>

      <?php
      // --- Hàm Haversine ---
      function haversineDistance($lat1, $lon1, $lat2, $lon2)
      {
        $R = 6371; // km
        if ($lat1 === null || $lon1 === null || $lat2 === null || $lon2 === null)
          return INF;
        $lat1 = deg2rad((float) $lat1);
        $lon1 = deg2rad((float) $lon1);
        $lat2 = deg2rad((float) $lat2);
        $lon2 = deg2rad((float) $lon2);
        $dLat = $lat2 - $lat1;
        $dLon = $lon2 - $lon1;
        $a = sin($dLat / 2) * sin($dLat / 2) + cos($lat1) * cos($lat2) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $R * $c;
      }

      // --- Xử lý khi bấm "Lên lịch trình" ---
      $plan = []; // sẽ chứa thứ tự các điểm (mỗi phần tử là associative array)
      if (isset($_POST['generate_plan'])) {
        $num_places = max(1, intval($_POST['num_places'] ?? 1));

        // Lấy tất cả locations khác (bỏ những bản ghi không có lat/lon)
        $sqlAll = "SELECT * FROM locations WHERE id != " . intval($place['id']);
        $resAll = $conn->query($sqlAll);
        $allPlaces = [];
        while ($r = $resAll->fetch_assoc()) {
          if ($r['latitude'] === null || $r['longitude'] === null || $r['latitude'] === '' || $r['longitude'] === '') {
            continue;
          }
          $allPlaces[] = $r;
        }

        // Điểm bắt đầu = $place (đảm bảo có lat/lon)
        $start = $place;
        $start['distance_from_prev'] = 0.0; // gán rõ cho điểm đầu
        $plan[] = $start;

        $currentLat = $start['latitude'];
        $currentLon = $start['longitude'];

        // Lặp greedy chọn điểm gần nhất
        while (count($plan) < $num_places && count($allPlaces) > 0) {
          $nearestIndex = null;
          $minDist = INF;

          foreach ($allPlaces as $idx => $p) {
            $dist = haversineDistance($currentLat, $currentLon, $p['latitude'], $p['longitude']);
            if ($dist < $minDist) {
              $minDist = $dist;
              $nearestIndex = $idx;
            }
          }

          if ($nearestIndex === null)
            break;

          // Lấy và gán distance_from_prev cho phần tử được chọn
          $nearest = $allPlaces[$nearestIndex];
          $nearest['distance_from_prev'] = $minDist;
          $plan[] = $nearest;

          // cập nhật current và xóa khỏi allPlaces
          $currentLat = $nearest['latitude'];
          $currentLon = $nearest['longitude'];
          array_splice($allPlaces, $nearestIndex, 1);
        }

        // Lưu ý: nếu user chọn số lớn hơn số địa điểm có lat/lon, plan sẽ ngắn hơn yêu cầu
      }

      ?>
      <?php if (!empty($plan)): ?>
  <div class="itinerary-result mt-4" style="background-color: #ffffffff; border-radius: 10px; padding: 20px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
    <h2 class="mb-4" style="text-align: center; padding-top: 20px; font-weight: bold;"><i class="fas fa-route"></i> Lịch trình gợi ý</h2>

    <div class="timeline" style="left: 10vw">
      <?php foreach ($plan as $index => $p): ?>
        <div class="timeline-item" >
          <div class="timeline-marker"><?= $index + 1 ?></div>
          <div class="timeline-card">
            
            <?php if (!empty($p['main_image'])): ?>
              <img src="<?= htmlspecialchars($p['main_image']) ?>" 
                   alt="<?= htmlspecialchars($p['name']) ?>" 
                   class="timeline-img-top">
            <?php endif; ?>

            <div class="timeline-body">
              <h5 class="mb-2"><?= htmlspecialchars($p['name']) ?></h5>

              <?php if ($index === 0): ?>
                <p class="small text-muted">🚩 Điểm bắt đầu</p>
              <?php else: ?>
                <p class="small text-muted">
                  📍 Cách điểm trước ~
                  <?= isset($p['distance_from_prev']) ? round($p['distance_from_prev'], 2) . ' km' : 'N/A' ?>
                </p>
              <?php endif; ?>

              <?php if (!empty($p['address'])): ?>
                <p class="small text-muted">
                  <i class="fa fa-map-marker text-danger"></i>
                  <?= htmlspecialchars($p['address']) ?>
                </p>
              <?php endif; ?>

              <?php if (!empty($p['iframe_map'])): ?>
                <a href="#" 
                   class="btn btn-sm btn-outline-primary"
                   onclick="showMap('<?= htmlspecialchars($p['iframe_map']) ?>')">
                  Xem bản đồ
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>

      <!-- Modal xem bản đồ -->
      <div class="modal fade" id="mapModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div id="mapContainer"></div>
            </div>
          </div>
        </div>
      </div>

      <script>
        function showMap(iframe) {
          document.getElementById('mapContainer').innerHTML = iframe;
          new bootstrap.Modal(document.getElementById('mapModal')).show();
        }
      </script>


    </div>
  </section>

  <section class="ftco-section testimony-section bg-bottom" style="background-image: url(images/bg_1.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row justify-content-center pb-4">
        <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
          <span class="subheading">Testimonial</span>
          <h2 class="mb-4">Tourist Feedback</h2>
        </div>
      </div>
      <div class="row ftco-animate">
        <div class="col-md-12">
          <div class="carousel-testimony owl-carousel">
            <div class="item">
              <div class="testimony-wrap py-4">
                <div class="text">
                  <p class="star">
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                  </p>
                  <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and
                    Consonantia, there live the blind texts.</p>
                  <div class="d-flex align-items-center">
                    <div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
                    <div class="pl-3">
                      <p class="name">Roger Scott</p>
                      <span class="position">Marketing Manager</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap py-4">
                <div class="text">
                  <p class="star">
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                  </p>
                  <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and
                    Consonantia, there live the blind texts.</p>
                  <div class="d-flex align-items-center">
                    <div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
                    <div class="pl-3">
                      <p class="name">Roger Scott</p>
                      <span class="position">Marketing Manager</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap py-4">
                <div class="text">
                  <p class="star">
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                  </p>
                  <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and
                    Consonantia, there live the blind texts.</p>
                  <div class="d-flex align-items-center">
                    <div class="user-img" style="background-image: url(images/person_3.jpg)"></div>
                    <div class="pl-3">
                      <p class="name">Roger Scott</p>
                      <span class="position">Marketing Manager</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap py-4">
                <div class="text">
                  <p class="star">
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                  </p>
                  <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and
                    Consonantia, there live the blind texts.</p>
                  <div class="d-flex align-items-center">
                    <div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
                    <div class="pl-3">
                      <p class="name">Roger Scott</p>
                      <span class="position">Marketing Manager</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap py-4">
                <div class="text">
                  <p class="star">
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                  </p>
                  <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and
                    Consonantia, there live the blind texts.</p>
                  <div class="d-flex align-items-center">
                    <div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
                    <div class="pl-3">
                      <p class="name">Roger Scott</p>
                      <span class="position">Marketing Manager</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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

  <style>
    .itinerary-form {
      background: #f9fafc;
      border: 1px solid #ddd;
      padding: 15px 20px;
      border-radius: 12px;
      margin-top: 30px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .form-group-row {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .form-label {
      font-weight: bold;
      margin: 0;
      white-space: nowrap;
    }

    .form-select {
      flex: 1;
      padding: 8px 12px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .btn-plan {
      background: linear-gradient(45deg, #06b6d4, #3b82f6);
      border: none;
      color: white;
      padding: 8px 16px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      transition: 0.3s;
    }

    .btn-plan:hover {
      background: linear-gradient(45deg, #3b82f6, #06b6d4);
    }
  </style>
  <style>
    .timeline {
  position: relative;
  margin-left: 50px;
  border-left: 3px solid #06b6d4;
  padding-left: 30px;
}

.timeline-item {
  position: relative;
  margin-bottom: 40px;
}

.timeline-marker {
  position: absolute;
  left: -50px;
  top: 0px;
  background: #06b6d4;
  color: #fff;
  font-weight: bold;
  width: 38px;
  height: 38px;
  line-height: 38px;
  text-align: center;
  border-radius: 50%;
  font-size: 16px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}

.timeline-card {
  background: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
  max-width: 550px;
}

.timeline-img-top {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.timeline-body {
  padding: 15px;
}

  </style>
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