# Laravel Imagache
Hỗ trợ API để cache ảnh trong Laravel.

## Cài đặt cho nhà phát triển

Tại thư mục gốc của dự án Laravel, chạy dòng lệnh bên dưới để clone gói này.

```sh
git clone https://github.com/lechihuy/laravel-imagache.git
```

Tiếp đến, bạn có thể sử dụng câu lệnh CLI sau để thêm repository vào file `composer.json`:

```sh
composer config repositories."laravel-imagache" '{"type": "path", "url": "./laravel-imagache"}' --file composer.json
```

Thêm gói `lechihuy/laravel-imagache` trong mục `require` của file `composer.json` :

```json
"require": {
    "lechihuy/laravel-imagache": "@dev"
},
```

Sau đó chạy lệnh bên dưới để cập nhật `composer.json`

```
composer update
```

### Redis
Vì package sử dụng Redis để cache nên ta cần phải cài đặt nó trên hệ điều hành, tải [tại đây](https://redis.io/).

Tiếp đến thay đổi driver Predis để tương tác với Redis bằng cách khai báo khóa `REDIS_CLIENT` trong file `.env`

```
REDIS_CLIENT=predis
```