# 📘 Laravel Unit & Feature Testing Playground

<p align="center">
<a href="https://laravel.com" target="_blank">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</a>
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions">
<img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
</a>
<a href="https://packagist.org/packages/laravel/framework">
<img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Version">
</a>
<a href="https://packagist.org/packages/laravel/framework">
<img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
</a>
<a href="https://opensource.org/licenses/MIT">
<img src="https://img.shields.io/badge/license-MIT-green.svg" alt="License">
</a>
</p>

---

## 🚀 About This Project

This repository is a **Laravel testing playground** focused on mastering:

- 🧪 Unit Testing  
- 🌐 Feature Testing  
- 📦 Form Request Validation Testing  
- 🗄️ Database Testing  
- 🔁 CRUD Testing (Create, Read, Update, Delete)

It demonstrates how to properly test real-world Laravel applications using **PHPUnit / Laravel testing tools**.

---

## 🎯 What You Will Learn

### ✅ Feature Testing
- HTTP requests (`GET`, `POST`, `PUT`, `DELETE`)
- Controller responses
- Status codes & redirects
- View assertions

### ✅ Form Request Validation
- Required fields validation
- Email validation
- Password rules
- Unique constraints

### ✅ Database Testing
- `assertDatabaseHas()`
- `assertDatabaseMissing()`
- Fresh database per test (`RefreshDatabase`)

### ✅ CRUD Workflow Testing
- Create user
- List users
- Update user
- Delete user

---

## 🧪 Example Test Case

```php
public function test_can_create_user()
{
    $response = $this->post('/users', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(302);

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
    ]);
}
```
## ⚙️ Installation
```php
git clone https://github.com/your-username/laravel-unit-feature-testing.git
cd laravel-unit-feature-testing

composer install
cp .env.example .env
php artisan key:generate
```


### 🧪 Running Tests
- Run all tests:
```php
php artisan test
```

- Run specific file:
```php
php artisan test tests/Feature/UserCrudTest.php
```

- Run specific test:
```php
php artisan test --filter=test_can_create_user
```


# 📜 License

- This project is open-sourced under the MIT license.
