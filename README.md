# Ticket System
## Установка
1) `composer install`
1) (Windows) `ren .env.example .env` (Linux) `mv .env.example .env` 
1) Настроить параметры БД в `.env`
1) `php artisan migrate`

## Модели
Модели находятся в директории `App\Models`.

## Seeding

Для того чтобы заполнить таблицу тестовыми данными:

`php artisan db:seed`





