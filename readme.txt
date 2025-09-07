Pacific - README
Pacific

**Pacific** là một dự án website (hoặc ứng dụng) được phát triển nhằm quản lý và hiển thị thông tin theo nhu cầu của cửa hàng/doanh nghiệp.  
Dự án được xây dựng bằng **PHP**, **MySQL**, **HTML/CSS/JavaScript** và hoạt động tốt trên môi trường XAMPP, Laragon hoặc OpenServer.

🎯 Giới thiệu
Pacific cung cấp các trang giao diện trực quan, cho phép quản lý sản phẩm/dữ liệu, hỗ trợ đăng nhập, đăng ký, tìm kiếm và hiển thị nội dung.  
Dự án hướng đến mục đích học tập, thử nghiệm và triển khai các chức năng cơ bản của một website.

⚙️ Công nghệ sử dụng
- **Ngôn ngữ**: PHP 7.4+, HTML5, CSS3, JavaScript
- **Cơ sở dữ liệu**: MySQL/MariaDB
- **Máy chủ phát triển**: XAMPP / OpenServer / Laragon
- **Trình duyệt hỗ trợ**: Chrome, Edge, Firefox

🔑 Tính năng chính
- Trang chủ hiển thị dữ liệu/sản phẩm
- Tìm kiếm, lọc nội dung
- Đăng ký & đăng nhập tài khoản
- Quản trị (thêm, sửa, xóa) nội dung
- Quản lý đơn hoặc thông tin liên quan (nếu có)

📦 Cài đặt

### 1. Chuẩn bị môi trường
- Cài đặt **XAMPP** (hoặc OpenServer, Laragon)
- Bật **Apache** và **MySQL**

### 2. Tải và triển khai dự án
1. Clone hoặc tải project từ GitHub:
   git clone https://github.com/<tên-user>/<repo>.git
   hoặc giải nén vào:
   C:\xampp\htdocs\Pacific

2. Tạo database:
   CREATE DATABASE pacific CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

3. Import file SQL (nếu có):
   mysql -u root -p pacific < database.sql

4. Cấu hình kết nối DB trong file config.php (hoặc tương tự):
   $db_host = "localhost";
   $db_user = "root";
   $db_pass = "";
   $db_name = "pacific";

▶️ Chạy dự án
1. Khởi động Apache & MySQL.
2. Mở trình duyệt và truy cập:
   http://localhost/Pacific
3. Đăng ký hoặc đăng nhập để sử dụng.

📂 Gợi ý cấu trúc thư mục
Pacific/
├── assets/        # CSS, JS, hình ảnh
├── database/      # File SQL
├── layout/        # Header, Footer
├── pages/         # Các trang giao diện
├── utils/         # Hàm tiện ích
└── index.php      # Trang chính

📝 Ghi chú
- Chỉnh sửa config.php nếu thay đổi thông tin kết nối DB.
- Kiểm tra quyền ghi thư mục nếu gặp lỗi upload.

📜 License
Dự án phục vụ học tập và phát triển cá nhân.
