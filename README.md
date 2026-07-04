# URL Shortener

Небольшое Laravel-приложение для создания коротких ссылок.

Пользователь может зарегистрироваться, войти в личный кабинет, создать короткую ссылку, открыть ее публично и посмотреть статистику переходов.

## Стек

- Laravel 13
- Filament v3
- MySQL
- PHP 8.3

В текущей конфигурации проект подготовлен для запуска через Laravel Sail с MySQL.

## Возможности

- регистрация и вход;
- личный кабинет на Filament;
- создание коротких ссылок;
- публичный редирект по короткому коду;
- запись статистики переходов;
- просмотр статистики переходов в кабинете;
- удаление своих ссылок;
- пользователь видит только свои ссылки.

## Установка

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Настройте подключение к базе данных в `.env`.

Пример для MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=url_shortener
DB_USERNAME=root
DB_PASSWORD=
```

Важно: значение `APP_URL` должно совпадать с адресом, по которому открыт проект.
Именно из `APP_URL` формируется полный короткий URL в кабинете.

Например, если проект открыт так:

```text
http://127.0.0.1:8000
```

то в `.env` нужно указать:

```env
APP_URL=http://127.0.0.1:8000
```

Если проект запущен через Sail и открыт на `http://localhost`, можно оставить:

```env
APP_URL=http://localhost
```

После изменения `APP_URL` очистите кэш конфигурации:

```bash
php artisan config:clear
```

Затем выполните миграции:

```bash
php artisan migrate
```

Запуск локального сервера:

```bash
php artisan serve
```

Приложение будет доступно по адресу:

```text
http://127.0.0.1:8000
```

## Запуск через Laravel Sail

Если используется Sail:

```bash
vendor/bin/sail up -d
vendor/bin/sail artisan migrate
```

Открыть приложение:

```text
http://localhost
```

Если порт `80` занят, можно указать другой порт в `.env`:

```env
APP_PORT=8080
```

После этого перезапустить Sail:

```bash
vendor/bin/sail down
vendor/bin/sail up -d
```

## Личный кабинет

Кабинет доступен по адресу:

```text
/cabinet
```

Страницы входа и регистрации:

```text
/cabinet/login
/cabinet/register
```
