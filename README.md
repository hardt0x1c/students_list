Основная цель приложения - предоставить пользователям возможность подачи заявок в абитуренты. Ниже представлено обновленное описание доступных конечных точек API и дополнительная информация о приложении.

# Запуск проекта

* Создать файл .env из .env.example
* В .env вставить эти строки `DB_CONNECTION=mysql DB_HOST=db DB_PORT=3306 DB_DATABASE=laravel DB_USERNAME=root DB_PASSWORD=root`
* В папке проекта запустить `docker compose up -d`
* Прописать команду для входа в контейнер `docker exec -it app bash`
    * `composer install`
    * `php artisan key:generate`
    * `php artisan optimize`
    * `php artisan migrate`
    * `php artisan db:seed`

После этого приложение готово к работе.
Для проверки можно запустить тесты: `php artisan test`
Если в тестах падает ошибка 419: `php artisan config:clear`

## Эндпоинты:
### Получить список всех абитуриентов

- **Конечная точка:** `GET /abiturents`
- **Описание:** Получить список всех абитуриентов.
- **Запрос:**
    - Заголовки:
        - Content-Type: application/json
    - Тело: (пусто)
- **Ответ:**
    - Код состояния: 200 OK
    - Тело: Список абитуриентов в формате JSON.

### Получить абитуриента по ID

- **Конечная точка:** `GET /abiturents/{id}`
- **Описание:** Получить подробную информацию о конкретном абитуриенте, указав его ID.
- **Запрос:**
    - Заголовки:
        - Content-Type: application/json
    - Тело: (пусто)
- **Ответ:**
    - Код состояния: 200 OK
    - Тело: Подробности об абитуриенте в формате JSON.

### Создать нового абитуриента

- **Конечная точка:** `POST /abiturents`
- **Описание:** Создать нового абитуриента.
- **Запрос:**
    - Заголовки:
        - Content-Type: application/json
        - Authorization: Bearer {access_token} (если требуется аутентификация)
    - Тело: JSON-пакет, содержащий данные абитуриента.
- **Ответ:**
    - Код состояния: 201 Created
    - Тело: Подробности абитуриента о вновь созданном абитуриенте в формате JSON.

### Обновить данные абитуриента

- **Конечная точка:** `PUT /abiturents/{id}`
- **Описание:** Обновить данные конкретного абитуриента, указав его ID.
- **Запрос:**
    - Заголовки:
        - Content-Type: application/json
        - Authorization: Bearer {access_token} (если требуется аутентификация)
    - Тело: JSON-пакет, содержащий обновленные данные абитуриента.
- **Ответ:**
    - Код состояния: 200 OK
    - Тело: Подробности обновленного абитуриента в формате JSON.

### Удалить абитуриента

- **Конечная точка:** `DELETE /abiturents/{id}`
- **Описание:** Удалить конкретного абитуриента, указав его ID.
- **Запрос:**
    - Заголовки:
        - Content-Type: application/json
        - Authorization: Bearer {access_token} (если требуется аутентификация)
    - Тело: (пусто)
- **Ответ:**
    - Код состояния: 200 OK
