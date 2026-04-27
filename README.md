# 🧪 Laravel Testing Playground (Unit & Feature Testing)

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="420" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/Asjadgit/laravel-unit-feature-testing/actions">
    <img src="https://github.com/Asjadgit/laravel-unit-feature-testing/actions/workflows/tests.yml/badge.svg" alt="Tests Status">
  </a>
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/Laravel-10+-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/Tests-PHPUnit-green.svg" alt="PHPUnit">
  <img src="https://img.shields.io/badge/license-MIT-green.svg" alt="License">
</p>

---

## 📘 Overview

This project is a **hands-on Laravel testing playground** designed to demonstrate how to write **reliable, maintainable, and production-ready tests**.

It focuses on real-world testing scenarios including **CRUD operations, validation, and database assertions**, backed by an automated **CI pipeline**.

---

## 🚀 Key Features

- 🧪 **Unit Testing** — Isolated logic validation  
- 🌐 **Feature Testing** — End-to-end HTTP testing  
- 🗄️ **Database Testing** — Assertions with fresh state  
- 📦 **Form Request Validation Testing**  
- 🔁 **Full CRUD Workflow Testing**  
- ⚙️ **CI/CD Integration (GitHub Actions)**  

---

## 🛠️ Tech Stack

- **Backend:** Laravel  
- **Testing:** PHPUnit (Laravel Testing Utilities)  
- **Database:** SQLite (Testing) / MySQL  
- **CI/CD:** GitHub Actions  
- **Version Control:** Git & GitHub  

---

## 📂 Project Structure

```bash
tests/
├── Feature/
│   └── UserCrudTest.php
├── Unit/
│   └── ExampleTest.php
---
```


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

## ⚙️ CI/CD Pipeline

This project uses GitHub Actions for automated Quality Assurance.

- ✔ On every push / pull request:
- Install dependencies
- Setup environment
- Run all tests

#### 🔍 Outcome:

✅ Passing → Code is stable
❌ Failing → Issues detected before merge

> This ensures code reliability and production safety
---


# 📜 License

- This project is open-sourced under the MIT license.
