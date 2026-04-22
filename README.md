# Biletcell API - Etkinlik ve Biletleme Platformu

Biletcell, kullanıcıların etkinlikleri keşfetmesini ve kolayca bilet almasını sağlayan, özellikle Turkcell abonelerine özel avantajlar sunan bir API projesidir.

## 🚀 Projenin Mevcut Durumu
Bugün itibarıyla projenin temel altyapısı ve güvenli giriş sistemi başarıyla kurulmuştur:

- **Dockerize Altyapı:** PHP 8.2-CLI ve MySQL 8.0 servisleri Docker Compose ile ayağa kaldırıldı.
- **Genişletilmiş Veritabanı Şeması:** Laravel'in varsayılan `users` tablosu; `gsm`, `role`, `is_turkcell` ve `api_token` alanlarıyla modernize edildi.
- **GSM Tabanlı Kimlik Doğrulama:**
  - `POST /register`: Kullanıcıların GSM ve isim bilgisiyle sisteme dahil edilmesi.
  - `POST /verify-otp`: 1234 simüle OTP kodu ile doğrulama ve kullanıcıya özel 60 karakterlik güvenli `access_token` üretimi.
- **Manuel Token Yönetimi:** Sanctum bağımlılıklarından arındırılmış, yüksek performanslı ve özelleştirilmiş bir API Token sistemi.

## 🛠 Kullanılan Teknolojiler
- **Backend:** Laravel 11
- **Database:** MySQL
- **DevOps:** Docker & Docker Compose
- **Test:** Thunder Client
