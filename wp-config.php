<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'udpm2' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ']!g6xUY<;9o5|9isq<c0Jc=fa8b?jCEQYF#71}5xI9j=1@YMF]v5AV13F*,,#P6p' );
define( 'SECURE_AUTH_KEY',  'ga@c&i*]w^GnnUzuq(Y#rf#Yml yAF[@PmO[@A3EuA6,NO[md5nH/;8OAO{5pFGx' );
define( 'LOGGED_IN_KEY',    'A9uTm2J/H`[s-AO-oe7c{@f@Y?m4DIggG>[E29rbQrBV!a[1i|j~0cpLl9%#IiRF' );
define( 'NONCE_KEY',        '4&94ZWT8]dXIEdVs+G_$BY8M]cCbya2e6~j:BD<+Ghn*][+>Ik/rl.=[N*T&Eqc6' );
define( 'AUTH_SALT',        '#.*lv74$*i~quV0[*(VFE&_+@.x%VDID/j#x3mj,9)]Y}P/IHzTEc@9}E3^:blv9' );
define( 'SECURE_AUTH_SALT', 'FH21ZyXK: secC%^KN[X2BH};EaB_]XFB7l=L&pBR7[w0(rBIJLD7fE=@,ivo9pB' );
define( 'LOGGED_IN_SALT',   '1qMwV0 c18Nv.-8No^tk f.@54R):Feq ;>8)1zJX~@L &N_SmI%;xHT_V)br0?Y' );
define( 'NONCE_SALT',       '[z]65@H8SV=F9L]gf5f#,R 2JYd1;`rxA;^M9K/]o1eR[#(v(0=0| i!6AMU@I-[' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'udpm2_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
