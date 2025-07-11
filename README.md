## Admin Paneli 

Admin Girişi ile Müşteri(kullanıcı) ekleme, Kategori Ekleme ve Ürün ekleme yapan akıcı bir arayüzü bulunan admin panelidir.

---

## Kurulum Adımları

Aşağıdaki adımları izleyerek projeyi kendi bilgisayarınızda çalıştırabilirsiniz:

### 1 Projeyi Klonlayın

git clone https://github.com/Quillen911/My-Case.git
cd My-Case

### 2 Composer Bağımlılıklarını Kurun

composer install

## 3Ortam Değişkenleri Dosyasını Oluşturun

copy .env.example .env

## 4 Veritabanı Ayarlarını Yapın

.env dosyasına gerekli bilgiler girilmeli. Örnek

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=notlar
DB_USERNAME=root
DB_PASSWORD=


## 5 Veritabanını Kurun
Migration'ları çalıştırarak tablolar oluşturulmalı

php artisan migrate

## 6 (Opsiyonel) Seeder Dosyalarını Çalıştırın
Örnek verileri veritabanına eklemek isterseniz:

php artisan db:seed

## 8 Laravel servis sağlayıcısını başlatın

php artisan serve

http://127.0.0.1:8000  Tarayıcıya bu adresten ulaşılır.

---

##  Kullanılan Teknolojiler

Laravel 12.x
PHP 8.x
PostgreSql
Composer
Blade Template Engine
CSS, JavaScript

---

##  Özellikler

- Ürün ekleme, düzenleme, silme
- Kategori ekleme, düzenleme, silme
- Admin yönetimi (admin paneli)
- Soft delete (silinen kayıtları geri getirme)
- Gelişmiş doğrulama ve hata yönetimi

  
