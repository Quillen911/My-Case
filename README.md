## Admin Paneli 

Admin Girişi ile Müşteri(kullanıcı) ekleme, Kategori Ekleme ve Ürün ekleme yapan akıcı bir arayüzü bulunan admin panelidir.

---

## Kurulum Adımları

Aşağıdaki adımları izleyerek projeyi kendi bilgisayarınızda çalıştırabilirsiniz:

### 1. Projeyi Klonlayın
```bash
git clone https://github.com/Quillen911/My-Case.git
cd My-Case
```
### 2. Composer Bağımlılıklarını Kurun
```bash
composer install
```
## 3. Ortam Değişkenleri Dosyasını Oluşturun
```bash
copy .env.example .env
```
## 4. Uygulama Anahtarını Oluşturun
```bash
php artisan key:generate
```
## 5. Session driver dosyası ayarlanmalı

```env
SESSION_DRIVER=file
```

## 5. Veritabanı Ayarlarını Yapın

.env dosyasına gerekli bilgiler girilmeli. Örnek:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=notlar
DB_USERNAME=root
DB_PASSWORD=
```

## 6. Veritabanını Kurun
Migration'ları çalıştırarak tablolar oluşturulmalı.
```bash
php artisan migrate
```
## 7. (Opsiyonel) Seeder Dosyalarını Çalıştırın
Örnek verileri veritabanına eklemek isterseniz:
```bash
php artisan db:seed
```
## 8. Laravel servis sağlayıcısını başlatın
```bash
php artisan serve
```
http://127.0.0.1:8000  Tarayıcıya bu adresten ulaşılır.
admin giriş bilgisi 
database\seeders\UserSeeder.php dosyasından ulaşılabilir
---

## Kullanılan Teknolojiler

- Laravel 12.x
- PHP 8.x
- PostgreSQL
- Composer
- Blade Template Engine
- CSS
- JavaScript

---

##  Özellikler

- Ürün ekleme, düzenleme, silme
- Kategori ekleme, düzenleme, silme
- Admin yönetimi (admin paneli)
- Soft delete (silinen kayıtları geri getirme)
- Gelişmiş doğrulama ve hata yönetimi

  
