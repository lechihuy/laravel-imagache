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

## Cấu hình
Ta có thể cấu hình tại file `config/imagache.php` của package bao gồm các thông tin như prefix uri, middleware...

## Hướng dẫn
Package cung cấp 2 API gồm upload và lấy ảnh.

### API upload ảnh
```
POST /{prefix}/upload
```

**Header**
```
Content-Type: multipart/form-data
Accept: application/json
```

**Form data**
```
images[]: Danh sách các file ảnh upload lên hệ thống
```

> Hiện hỗ trợ các file ảnh jpg, jpeg, png, bmp, gif, svg, và webp.
> Nếu file ảnh gửi có tên trùng với file đã tồn tại trong hệ thống thì file cũ sẽ bị override.

**Response**
<details>
<summary>200 OK</summary>
```
{
    "urls": [
        "http://localhost:8000/images/IMG_1672.JPG",
        "http://localhost:8000/images/IMG_1678.JPG"
    ]
}
```
</details>

<details>
<summary>422 Unprocessable Content</summary>
```
{
    "message": "The given data was invalid.",
    "errors": {
        "images.0": [
            "The images.0 must be an image."
        ],
        "images.1": [
            "The images.1 must be an image."
        ]
    }
}
```
</details>