# Laravel API Dashboard

لوحة تحكم Laravel مع واجهة ويب و REST API لإدارة المنتجات، مع مصادقة عبر Laravel Sanctum.

---

## المتطلبات

قبل البدء، تأكد من توفر ما يلي:

| الأداة | الإصدار المطلوب |
|--------|-----------------|
| XAMPP | Apache + MySQL |
| PHP | 8.2 أو أحدث |
| Composer | 2.x |
| Node.js | 18 أو أحدث |
| npm | 9 أو أحدث |

```

---

## خطوات التشغيل على XAMPP

### 1. تشغيل XAMPP

1. افتح **XAMPP Control Panel**
2. شغّل **Apache**
3. شغّل **MySQL**

---

### 2. إنشاء قاعدة البيانات

1. افتح المتصفح على: `http://localhost/phpmyadmin`
2. أنشئ قاعدة بيانات جديدة باسم: `laravel_api_dashboard`
3. اختر الترميز: `utf8mb4_unicode_ci`

---

### 3. إعداد ملف البيئة `.env`

عدّل القيم التالية في ملف `.env`:

```env
APP_URL=http://localhost/laravel-api-dashboard/public

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_api_dashboard
DB_USERNAME=root
DB_PASSWORD=
```

> **ملاحظة:** كلمة مرور MySQL الافتراضية في
### 5. تثبيت اعتماديات الواجهة وبناء الأصول

```bash
npm install
npm run build
```

> أثناء التطوير يمكنك تشغيل `npm run dev` بدلاً من `npm run build` لتحديث CSS/JS تلقائياً.

---

### 6. أوامر Laravel الأساسية

**macOS:**
```bash
/Applications/XAMPP/xamppfiles/bin/php artisan key:generate
/Applications/XAMPP/xamppfiles/bin/php artisan migrate
/Applications/XAMPP/xamppfiles/bin/php artisan db:seed
/Applications/XAMPP/xamppfiles/bin/php artisan storage:link
```

**Windows:**
```cmd
C:\xampp\php\php.exe artisan key:generate
C:\xampp\php\php.exe artisan migrate
C:\xampp\php\php.exe artisan db:seed
C:\xampp\php\php.exe artisan storage:link
```

| الأمر | الوظيفة |
|-------|---------|
| `key:generate` | إنشاء مفتاح تشفير التطبيق |
| `migrate` | إنشاء جداول قاعدة البيانات |
| `db:seed` | إدخال بيانات تجريبية |
| `storage:link` | ربط مجلد التخزين لعرض صور المنتجات |

---

### 7. صلاحيات المجلدات (macOS / Linux)

```bash
chmod -R 775 storage bootstrap/cache
```

---

### 8. فتح التطبيق

افتح المتصفح على:

```
http://localhost/laravel-api-dashboard/public
```

---

## بيانات الدخول الافتراضية (بعد `db:seed`)

| الحقل | القيمة |
|-------|--------|
| البريد الإلكتروني | `admin@example.com` |
| كلمة المرور | `password` |

> يُنشئ الـ Seeder مستخدماً واحداً و 8 منتجات مرتبطة به.

---

## الصفحات المتاحة (واجهة الويب)

| الصفحة | الرابط |
|--------|--------|
| تسجيل الدخول | `/login` |
| إنشاء حساب | `/register` |
| لوحة التحكم | `/dashboard` |
| المنتجات | `/products` |
| إضافة منتج | `/products/create` |
| الملف الشخصي | `/profile` |

> كل الروابط أعلاه تُضاف بعد `/public` في عنوان XAMPP.

---

## REST API

**Base URL:**
```
http://localhost/laravel-api-dashboard/public/api/v1
```

### تسجيل الدخول والحصول على Token

```http
POST /api/v1/login
Content-Type: application/json

{
  "email": "admin@example.com",
  "password": "password"
}
```

استخدم قيمة `token` من الاستجابة في الطلبات المحمية:

```http
Authorization: Bearer {token}
Accept: application/json
```

### (Endpoints)

| Method | Endpoint | المصادقة |
|--------|----------|----------|
| POST | `/api/v1/register` | عام |
| POST | `/api/v1/login` | عام |
| POST | `/api/v1/logout` | Sanctum |
| GET | `/api/v1/user` | Sanctum |
| GET | `/api/v1/dashboard` | Sanctum |
| GET | `/api/v1/profile` | Sanctum |
| PUT | `/api/v1/profile` | Sanctum |
| GET | `/api/v1/products` | Sanctum |
| GET | `/api/v1/products?search=اسم` | Sanctum |
| POST | `/api/v1/products` | Sanctum |
| GET | `/api/v1/products/{id}` | Sanctum |
| PUT | `/api/v1/products/{id}` | Sanctum |
| DELETE | `/api/v1/products/{id}` | Sanctum |

> كل مستخدم يرى ويدير **منتجاته فقط** المرتبطة بحسابه.

---

## التقنيات المستخدمة

- Laravel 11
- PHP 8.2+
- MySQL
- Laravel Sanctum
- Tailwind CSS + Vite

---

## الترخيص

MIT License
