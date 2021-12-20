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

> Hiện hỗ trợ các file ảnh jpg, jpeg, png, bmp, gif, svg, và webp.
> 
> Nếu file ảnh gửi có tên trùng với file đã tồn tại trong hệ thống thì file cũ sẽ bị override.
>
> Tên ảnh chỉ hỗ trợ trong phạm vi `[A-Za-z0-9\.\_\/\-]+` để bảo mật.

```
POST /{prefix}/upload
```
* `{prefix}`: Prefix của API trong file cấu hình

**Header**
```
Content-Type: multipart/form-data
Accept: application/json
```

**Form data**
```
images[]: Danh sách các file ảnh upload lên hệ thống
```

**Response**
* 200 OK
    ```json
    {
        "urls": [
            "http://localhost:8000/images/IMG_1672.JPG",
            "http://localhost:8000/images/IMG_1678.JPG"
        ]
    }
    ```

* 422 Unprocessable Content
    ```json
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

### API lấy hình ảnh

> Hỗ trợ tự động giữ tỉ lệ của ảnh khi resize
>
> Không upsize khi kích thước nhập vào vượt quá kích thước gốc
>
> Cache ảnh vĩnh viễn

```
POST /{prefix}/{image}
```
* `{prefix}`: Prefix của API trong file cấu hình
* `{image}`: Tên ảnh cần lấy

**Header**
```
Accept: application/json
```

**Query parameter**
```
w: Chiều dài của ảnh (optional)
h: Chiều cao của ảnh (optional)
```

**Response**
* 200 OK
* 404 Not found

