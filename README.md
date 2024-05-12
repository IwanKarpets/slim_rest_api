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

  
```json
{
  "id": 1,
  "name": "Имя человека",
  "amount": 50000,
  "created_at": "2024-05-12T08:45:30Z"
}
```

### POST /loans
Создание нового займа.  
В тело запроса, необходимо передать `name` и `amount`
http://slim-rest-api/api/loans
```json 
{
    "name": "Ivan",
    "amount":20000
}
```
Ответ 
```json
{
    "message": "Loan created",
    "id": "53"
}
```
### GET /loans/{id}
Получение информации о займе. `{id}` должен быть цифрой, представляющей уникальный идентификатор займа.  
http://slim-rest-api/api/loans/53
```json
{
     "id": 53,
    "name": "Ivan",
    "amount": "20000.00",
    "created_at": "2024-05-12 12:09:15"
}
```

### PUT /loans/{id}
Обновление информации о займе. Аналогично, `{id}` должен быть цифрой.  
http://slim-rest-api/api/loans/53, в тело запроса должны быть переданы поля `name` и `amount`, иначе ответ вернет ошибку
```json
{
   "name": "Ivan",
   "amount":20500
}
```
Ответ
```json
{
  "message": "Loan updated",
  "rows": 1
}
```

### DELETE /loans/{id}
Удаление займа. `{id}` также должен быть цифрой.  
http://slim-rest-api/api/loans/53  
Ответ
```json
{
  "message": "Loan deleted",
  "rows": 1
}
```
### GET /loans
Получение списка всех займов с базовыми фильтрами по дате создания и сумме займа.
http://slim-rest-api/api/loans  
```json
[
    {
        "id": 2,
        "name": "Petya",
        "amount": "4000.00",
        "created_at": "2024-05-07 12:05:20"
    },
    {
        "id": 3,
        "name": "Алексей Смирнов",
        "amount": "20000.00",
        "created_at": "2024-05-07 12:05:20"
    },
    {
        "id": 5,
        "name": "Nick233",
        "amount": "200.00",
        "created_at": "2024-05-07 16:25:05"
    }
]
```
Фильтрация данных  
Используются параметры: `start_date`, `end_date`, `max_amount`, `min_amount` 
Если вы хотите фильтровать займы по сумме, чтобы получить те, что больше или меньше указанной суммы, вам нужно будет изменить параметры строки запроса. Вот примеры того, как это можно сделать:

Для получения займов на сумму больше указанной:

GET /loans?min_amount=5000
В этом случае параметр min_amount=5000 означает, что вы хотите получить займы на сумму больше 5000.

Для получения займов на сумму меньше указанной:

GET /loans?max_amount=5000
Здесь параметр max_amount=5000 указывает, что вы хотите получить займы на сумму меньше 5000.


