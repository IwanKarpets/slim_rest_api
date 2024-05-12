# Настройка проекта

Для запуска проекта с использованием OpenServer или других аналогов, выполните следующие шаги:

1. Поместите проект в папку, доступную из веб-сервера.
2. Настройте хост так, чтобы корневой папкой была папка `public`.

## Точка входа

Точка входа в приложение находится в папке `public`, файл `index.php`.

## Установка зависимостей

Для работы приложения необходимо установить зависимости, используя Composer. Выполните команду:

```bash
composer install
Файл composer.json
Файл composer.json определяет зависимости и параметры автозагрузки для вашего PHP-проекта.

Require
Раздел require перечисляет пакеты, необходимые для работы вашего приложения:

slim/slim: Фреймворк Slim версии 4.13, легковесный фреймворк для создания веб-приложений и API.
slim/psr7: Реализация PSR-7, стандарта HTTP сообщений для PHP.
php-di/php-di: Контейнер зависимостей PHP-DI версии 7.0.
vlucas/valitron: Валидатор Valitron для PHP.
Autoload
В разделе autoload указывается стандарт автозагрузки PSR-4, который определяет, как Composer будет автоматически загружать классы:

psr-4: Автозагрузка классов из каталога src/.
Require-dev
Раздел require-dev содержит пакеты, которые используются только во время разработки:

phpunit/phpunit: Фреймворк PHPUnit для модульного тестирования PHP-приложений.
squizlabs/php_codesniffer: Инструмент PHP_CodeSniffer для проверки стиля кодирования PHP.
```
## API методы

Приложение поддерживает следующие методы RESTful API для работы с займами:  
Для тестирования запросов, я рекоммендую использовать POSTMAN

## Сущность Loan

Сущность `loan` представляет собой займ или кредит и содержит следующие поля:

- `id`: Уникальный идентификатор займа.
- `name`: Имя или наименование займа.
- `amount`: Сумма займа в выбранной валюте.
- `created_at`: Дата и время создания записи о займе.

### POST /loans
Создание нового займа.

### GET /loans/{id}
Получение информации о займе. `{id}` должен быть цифрой, представляющей уникальный идентификатор займа.

### PUT /loans/{id}
Обновление информации о займе. Аналогично, `{id}` должен быть цифрой.

### DELETE /loans/{id}
Удаление займа. `{id}` также должен быть цифрой.

### GET /loans
Получение списка всех займов с базовыми фильтрами по дате создания и сумме займа.

