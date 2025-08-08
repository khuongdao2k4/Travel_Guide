<?php
session_start();
include 'connectDB.php';

$regions = $conn->query("SELECT id, name FROM regions");
$provinces = $conn->query("SELECT id, name, region_id FROM provinces");
$places = $conn->query("SELECT id, name, province_id FROM places");
$categories = $conn->query("SELECT id, name FROM categories");

$provincesArray = [];
while ($row = $provinces->fetch_assoc()) {
    $provincesArray[] = $row;
}

$placesArray = [];
while ($row = $places->fetch_assoc()) {
    $placesArray[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

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
			<a class="navbar-brand" href="index.html">Thái Bình Dương<span>Công ty du lịch</span></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
				aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active"><a href="index.php" class="nav-link">Trang Chủ</a></li>
					<li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
					<li class="nav-item"><a href="destination.php" class="nav-link">Điểm Đến</a></li>
					<li class="nav-item"><a href="hotel.html" class="nav-link">Khách Sạn</a></li>
					<li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
					<li class="nav-item"><a href="contact.html" class="nav-link">Liên Hệ</a></li>
					<?php if (isset($_SESSION['full_name'])): ?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user"></i> Hello, <?php echo htmlspecialchars($_SESSION['full_name']); ?>
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="logout.php">Đăng xuất</a>
							</div>
						</li>
					<?php else: ?>
						<li class="nav-item dropdown">
							<a class="nav-link" href="#" data-toggle="modal" data-target="#authModal">
								<i class="fa fa-user"></i>
							</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</nav>
	<!-- END nav -->
	<div class="modal fade" id="authModal" tabindex="-1" role="dialog" aria-labelledby="authModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="authModalLabel">Tài khoản</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<ul class="nav nav-tabs" id="authTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab">Đăng
								nhập</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab">Đăng
								ký</a>
						</li>
					</ul>
					<div class="tab-content mt-3" id="authTabContent">

						<div class="tab-pane fade show active" id="login" role="tabpanel">
							<form action="login.php" method="POST">
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" name="email" required>
								</div>
								<div class="form-group">
									<label>Mật khẩu</label>
									<input type="password" class="form-control" name="password" required>
								</div>
								<button type="submit" class="btn btn-primary">Đăng nhập</button>
							</form>
						</div>

						<div class="tab-pane fade" id="register" role="tabpanel">
							<form action="register.php" method="POST">
								<div class="form-group">
									<label>Họ và tên</label>
									<input type="text" class="form-control" name="full_name" required>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" name="email" required>
								</div>
								<div class="form-group">
									<label>Số điện thoại</label>
									<input type="text" class="form-control" name="phone_number">
								</div>
								<div class="form-group">
									<label>Mật khẩu</label>
									<input type="password" class="form-control" name="password" required>
								</div>
								<div class="form-group">
									<label>Nhập lại mật khẩu</label>
									<input type="password" class="form-control" name="confirm_password" required>
								</div>
								<button type="submit" class="btn btn-success">Đăng ký</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="hero-wrap js-fullheight" style="background-image: url('images/bg_5.jpg');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
				<div class="col-md-7 ftco-animate">
					<span class="subheading">Chào mừng đến với Thái Bình Dương</span>
					<h1 class="mb-4">Khám phá địa điểm yêu thích của bạn cùng chúng tôi</h1>
					<p class="caps">Du lịch đến bất kỳ nơi nào trên thế giới mà không cần phải đi vòng quanh</p>
				</div>
				<a href="https://vimeo.com/45830194"
					class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
					<span class="fa fa-play"></span>
				</a>
			</div>
		</div>
	</div>

	<section class="ftco-section ftco-no-pb ftco-no-pt">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="ftco-search d-flex justify-content-center">
						<div class="row">
							<div class="col-md-12 nav-link-wrap">
								<div class="nav nav-pills text-center" id="v-pills-tab" role="tablist"
									aria-orientation="vertical">
									<a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill"
										href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Tìm
										Kiếm Tour</a>

									<a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2"
										role="tab" aria-controls="v-pills-2" aria-selected="false">Nhà Nghỉ</a>

								</div>
							</div>
							<div class="col-md-12  tab-wrap">

								<div class="tab-content" id="v-pills-tabContent">

									<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
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
																	<?= htmlspecialchars($row['name']) ?></option>
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
														<select name="province" id="province" class="form-control">
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
																		<?= htmlspecialchars($row['name']) ?></option>
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
														<input type="submit" value="SEARCH"
															class="align-self-stretch form-control btn btn-primary">
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>

								<script>
									const provinces = <?= json_encode($provincesArray) ?>;
									const places = <?= json_encode($placesArray) ?>;

									document.getElementById('region').addEventListener('change', function () {
										const regionId = this.value;
										const provinceSelect = document.getElementById('province');
										provinceSelect.innerHTML = '<option value="">Chọn Theo Thành Phố</option>';

										provinces.forEach(p => {
											if (p.region_id == regionId) {
												const option = document.createElement('option');
												option.value = p.id;
												option.textContent = p.name;
												provinceSelect.appendChild(option);
											}
										});

										document.getElementById('place').innerHTML = '<option value="">Chọn Theo Địa Điểm</option>';
									});

									document.getElementById('province').addEventListener('change', function () {
										const provinceId = this.value;
										const placeSelect = document.getElementById('place');
										placeSelect.innerHTML = '<option value="">Chọn Theo Địa Điểm</option>';

										places.forEach(pl => {
											if (pl.province_id == provinceId) {
												const option = document.createElement('option');
												option.value = pl.id;
												option.textContent = pl.name;
												placeSelect.appendChild(option);
											}
										});
									});
								</script>


								<div class="tab-pane fade" id="v-pills-2" role="tabpanel"
									aria-labelledby="v-pills-performance-tab">
									<form action="#" class="search-property-1">
										<div class="row no-gutters">
											<div class="col-lg d-flex">
												<div class="form-group p-4 border-0">
													<label for="#">Destination</label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-search"></span></div>
														<input type="text" class="form-control"
															placeholder="Search place">
													</div>
												</div>
											</div>
											<div class="col-lg d-flex">
												<div class="form-group p-4">
													<label for="#">Check-in date</label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-calendar"></span></div>
														<input type="text" class="form-control checkin_date"
															placeholder="Check In Date">
													</div>
												</div>
											</div>
											<div class="col-lg d-flex">
												<div class="form-group p-4">
													<label for="#">Check-out date</label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-calendar"></span></div>
														<input type="text" class="form-control checkout_date"
															placeholder="Check Out Date">
													</div>
												</div>
											</div>
											<div class="col-lg d-flex">
												<div class="form-group p-4">
													<label for="#">Price Limit</label>
													<div class="form-field">
														<div class="select-wrap">
															<div class="icon"><span class="fa fa-chevron-down"></span>
															</div>
															<select name="" id="" class="form-control">
																<option value="">$100</option>
																<option value="">$10,000</option>
																<option value="">$50,000</option>
																<option value="">$100,000</option>
																<option value="">$200,000</option>
																<option value="">$300,000</option>
																<option value="">$400,000</option>
																<option value="">$500,000</option>
																<option value="">$600,000</option>
																<option value="">$700,000</option>
																<option value="">$800,000</option>
																<option value="">$900,000</option>
																<option value="">$1,000,000</option>
																<option value="">$2,000,000</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg d-flex">
												<div class="form-group d-flex w-100 border-0">
													<div class="form-field w-100 align-items-center d-flex">
														<input type="submit" value="Search"
															class="align-self-stretch form-control btn btn-primary p-0">
													</div>
												</div>
											</div>
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

	<section class="ftco-section services-section">
		<div class="container">
			<div class="row d-flex">
				<div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
					<div class="w-100">
						<span class="subheading">Chào mừng đến với Thái Bình Dương</span>
						<h2 class="mb-4">Đã đến lúc bắt đầu cuộc phiêu lưu của bạn</h2>
						<p>Một con sông nhỏ tên là Duden chảy qua nơi họ ở và cung cấp cho nó những regelialia cần
							thiết.
							Đó là một đất nước thiên đường, nơi những phần câu rang xay bay vào miệng bạn.</p>
						<p>Xa xa, đằng sau những ngọn núi chữ, xa khỏi các quốc gia Vokalia và Consonantia, có những văn
							bản mù sống.
							Tách biệt, chúng sống trong Bookmarksgrove ngay tại bờ biển của Semantics, một đại dương
							ngôn ngữ rộng lớn.
							Một con sông nhỏ tên là Duden chảy qua nơi của chúng và cung cấp cho chúng những regelialia
							cần thiết.</p>
						<p><a href="#" class="btn btn-primary py-3 px-4">Tìm kiếm Điểm Đến</a></p>
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
									<h3 class="heading mb-3">Các hoạt động</h3>
									<p>Một con sông nhỏ tên là Duden chảy qua nơi của họ và cung cấp cho họ những thứ
										cần thiết
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
							<div class="services services-1 color-2 d-block img"
								style="background-image: url(images/services-2.jpg);">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-route"></span></div>
								<div class="media-body">
									<h3 class="heading mb-3">Sắp xếp chuyến đi</h3>
									<p>Một con sông nhỏ tên là Duden chảy qua nơi của họ và cung cấp cho họ những thứ
										cần thiết
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
							<div class="services services-1 color-3 d-block img"
								style="background-image: url(images/services-3.jpg);">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-tour-guide"></span></div>
								<div class="media-body">
									<h3 class="heading mb-3">Hướng dẫn viên riêng</h3>
									<p>Một con sông nhỏ tên là Duden chảy qua nơi của họ và cung cấp cho họ những thứ
										cần thiết
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
							<div class="services services-1 color-4 d-block img"
								style="background-image: url(images/services-4.jpg);">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-map"></span></div>
								<div class="media-body">
									<h3 class="heading mb-3">Quản lý vị trí</h3>
									<p>Một con sông nhỏ tên là Duden chảy qua nơi của họ và cung cấp cho họ những thứ
										cần thiết
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section img ftco-select-destination" style="background-image: url(images/bg_3.jpg);">
		<div class="container">
			<div class="row justify-content-center pb-4">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<span class="subheading">Thái Bình Dương Cung Cấp Địa Điểm</span>
					<h2 class="mb-4">Chọn Điểm Đến Của Bạn</h2>
				</div>
			</div>
		</div>
		<div class="container container-2">
			<div class="row">
				<div class="col-md-12">
					<div class="carousel-destination owl-carousel ftco-animate">
						<div class="item">
							<div class="project-destination">
								<a href="#" class="img"
									style="background-image: url(https://i.pinimg.com/736x/eb/42/7f/eb427f232e558550f31eaa195e4c8a13.jpg)">
									<div class="text">
										<h3>Vịnh Hạ Long</h3>
										<span>8 Tours</span>
									</div>
								</a>
							</div>
						</div>
						<div class="item">
							<div class="project-destination">
								<a href="#" class="img"
									style="background-image: url(https://i.pinimg.com/736x/8f/52/99/8f529918cf4112c936d7f12cd7eb4d7e.jpg);">
									<div class="text">
										<h3>Cố Đô Huế</h3>
										<span>2 Tours</span>
									</div>
								</a>
							</div>
						</div>
						<div class="item">
							<div class="project-destination">
								<a href="#" class="img"
									style="background-image: url(https://i.pinimg.com/736x/62/d6/79/62d679b686233f12e53e78910e73d2a6.jpg);">
									<div class="text">
										<h3>Hội An</h3>
										<span>5 Tours</span>
									</div>
								</a>
							</div>
						</div>
						<div class="item">
							<div class="project-destination">
								<a href="#" class="img"
									style="background-image: url(https://i.pinimg.com/736x/96/0f/aa/960faa736baa9e4949bcd6d3d1597c27.jpg);">
									<div class="text">
										<h>Hồ Gươm</h>
										<span>5 Tours</span>
									</div>
								</a>
							</div>
						</div>
						<div class="item">
							<div class="project-destination">
								<a href="#" class="img"
									style="background-image: url(https://i.pinimg.com/736x/95/e9/88/95e988bb76a6d4cb12056dcabd17cb68.jpg);">
									<div class="text">
										<h3>Đà Lạt</h3>
										<span>7 Tours</span>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center pb-4">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<span class="subheading">Điểm đến</span>
					<h2 class="mb-4">Điểm đến của chuyến du lịch</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 ftco-animate">
					<div class="project-wrap">
						<a href="#" class="img" style="background-image: url(images/destination-1.jpg);">
							<span class="price">$550/person</span>
						</a>
						<div class="text p-4">
							<span class="days">8 Days Tour</span>
							<h3><a href="#">Banaue Rice Terraces</a></h3>
							<p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
							<ul>
								<li><span class="flaticon-shower"></span>2</li>
								<li><span class="flaticon-king-size"></span>3</li>
								<li><span class="flaticon-mountains"></span>Near Mountain</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-4 ftco-animate">
					<div class="project-wrap">
						<a href="#" class="img" style="background-image: url(images/destination-2.jpg);">
							<span class="price">$550/person</span>
						</a>
						<div class="text p-4">
							<span class="days">10 Days Tour</span>
							<h3><a href="#">Banaue Rice Terraces</a></h3>
							<p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
							<ul>
								<li><span class="flaticon-shower"></span>2</li>
								<li><span class="flaticon-king-size"></span>3</li>
								<li><span class="flaticon-sun-umbrella"></span>Near Beach</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-4 ftco-animate">
					<div class="project-wrap">
						<a href="#" class="img" style="background-image: url(images/destination-3.jpg);">
							<span class="price">$550/person</span>
						</a>
						<div class="text p-4">
							<span class="days">7 Days Tour</span>
							<h3><a href="#">Banaue Rice Terraces</a></h3>
							<p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
							<ul>
								<li><span class="flaticon-shower"></span>2</li>
								<li><span class="flaticon-king-size"></span>3</li>
								<li><span class="flaticon-sun-umbrella"></span>Near Beach</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-md-4 ftco-animate">
					<div class="project-wrap">
						<a href="#" class="img" style="background-image: url(images/destination-4.jpg);">
							<span class="price">$550/person</span>
						</a>
						<div class="text p-4">
							<span class="days">8 Days Tour</span>
							<h3><a href="#">Banaue Rice Terraces</a></h3>
							<p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
							<ul>
								<li><span class="flaticon-shower"></span>2</li>
								<li><span class="flaticon-king-size"></span>3</li>
								<li><span class="flaticon-sun-umbrella"></span>Near Beach</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-4 ftco-animate">
					<div class="project-wrap">
						<a href="#" class="img" style="background-image: url(images/destination-5.jpg);">
							<span class="price">$550/person</span>
						</a>
						<div class="text p-4">
							<span class="days">10 Days Tour</span>
							<h3><a href="#">Banaue Rice Terraces</a></h3>
							<p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
							<ul>
								<li><span class="flaticon-shower"></span>2</li>
								<li><span class="flaticon-king-size"></span>3</li>
								<li><span class="flaticon-sun-umbrella"></span>Near Beach</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-4 ftco-animate">
					<div class="project-wrap">
						<a href="#" class="img" style="background-image: url(images/destination-6.jpg);">
							<span class="price">$550/person</span>
						</a>
						<div class="text p-4">
							<span class="days">7 Days Tour</span>
							<h3><a href="#">Banaue Rice Terraces</a></h3>
							<p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
							<ul>
								<li><span class="flaticon-shower"></span>2</li>
								<li><span class="flaticon-king-size"></span>3</li>
								<li><span class="flaticon-sun-umbrella"></span>Near Beach</li>
							</ul>
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
									<span class="subheading">Giới thiệu về chúng tôi</span>
									<h2 class="mb-4">Hãy làm cho chuyến đi của bạn đáng nhớ và an toàn cùng chúng tôi
									</h2>
									<p>Xa xa, đằng sau những ngọn núi chữ, xa khỏi các quốc gia Vokalia và Consonantia,
										có những văn bản mù sống. Tách biệt chúng sống trong Bookmarksgrove ngay tại bờ
										biển của Semantics,
										một đại dương ngôn ngữ rộng lớn.</p>
									<p><a href="#" class="btn btn-primary">Đặt Điểm Đến Của Bạn</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section testimony-section bg-bottom" style="background-image: url(images/bg_1.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row justify-content-center pb-4">
				<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
					<span class="subheading">Lời chứng thực</span>
					<h2 class="mb-4">Phản hồi của khách du lịch</h2>
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
									<p class="mb-4">Far far away, behind the word mountains, far from the countries
										Vokalia and Consonantia, there live the blind texts.</p>
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
									<p class="mb-4">Far far away, behind the word mountains, far from the countries
										Vokalia and Consonantia, there live the blind texts.</p>
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
									<p class="mb-4">Far far away, behind the word mountains, far from the countries
										Vokalia and Consonantia, there live the blind texts.</p>
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
									<p class="mb-4">Far far away, behind the word mountains, far from the countries
										Vokalia and Consonantia, there live the blind texts.</p>
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
									<p class="mb-4">Far far away, behind the word mountains, far from the countries
										Vokalia and Consonantia, there live the blind texts.</p>
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


	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center pb-4">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<span class="subheading">Blog của chúng tôi</span>
					<h2 class="mb-4">Bài viết gần đây</h2>
				</div>
			</div>
			<div class="row d-flex">
				<div class="col-md-4 d-flex ftco-animate">
					<div class="blog-entry justify-content-end">
						<a href="blog-single.html" class="block-20"
							style="background-image: url('images/image_1.jpg');">
						</a>
						<div class="text">
							<div class="d-flex align-items-center mb-4 topp">
								<div class="one">
									<span class="day">11</span>
								</div>
								<div class="two">
									<span class="yr">2020</span>
									<span class="mos">September</span>
								</div>
							</div>
							<h3 class="heading"><a href="#">Nơi phổ biến nhất trên thế giới này</a></h3>
							<!-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p> -->
							<p><a href="#" class="btn btn-primary">Read more</a></p>
						</div>
					</div>
				</div>
				<div class="col-md-4 d-flex ftco-animate">
					<div class="blog-entry justify-content-end">
						<a href="blog-single.html" class="block-20"
							style="background-image: url('images/image_2.jpg');">
						</a>
						<div class="text">
							<div class="d-flex align-items-center mb-4 topp">
								<div class="one">
									<span class="day">11</span>
								</div>
								<div class="two">
									<span class="yr">2020</span>
									<span class="mos">September</span>
								</div>
							</div>
							<h3 class="heading"><a href="#">Most Popular Place In This World</a></h3>
							<!-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p> -->
							<p><a href="#" class="btn btn-primary">Read more</a></p>
						</div>
					</div>
				</div>
				<div class="col-md-4 d-flex ftco-animate">
					<div class="blog-entry">
						<a href="blog-single.html" class="block-20"
							style="background-image: url('images/image_3.jpg');">
						</a>
						<div class="text">
							<div class="d-flex align-items-center mb-4 topp">
								<div class="one">
									<span class="day">11</span>
								</div>
								<div class="two">
									<span class="yr">2020</span>
									<span class="mos">September</span>
								</div>
							</div>
							<h3 class="heading"><a href="#">Most Popular Place In This World</a></h3>
							<!-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p> -->
							<p><a href="#" class="btn btn-primary">Read more</a></p>
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
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
							there live the blind texts.</p>
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
								<li><span class="icon fa fa-map-marker"></span><span class="text">203 Fake St. Mountain
										View, San Francisco, California, USA</span></li>
								<li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+2 392 3929
											210</span></a></li>
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
						<script>document.write(new Date().getFullYear());</script> All rights reserved | This template
						is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
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