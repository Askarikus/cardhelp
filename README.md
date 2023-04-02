Инструкция по запуску


Интерфейс документации для клиента
``` /swagger-ui ```

## [Guides](docs/guide)
Инструкции по проекту и нструментам разработки вы можете найти по пути ```docs/guide```

## Инструкция по регистарции/авторизации

***Для регистрации нового пользователя необходимо выполнить запрос на маршрут***
```/api/v1/auth/register```:

**Параметры запроса в формате json:**

``` json
{
    "email": "user@email",
    "phone": 111111',
    "password": "password",
    "name": "user name"
}
```

**201 Created - response body**
``` json
{
    "message": "User created successfully"
}
```
---
***Для авторизации пользователя необходимо выполнить запрос на маршрут***
```/api/v1/auth/token/login```:

**Параметры запроса в формате json:**

``` json
{
    "email": "user@email",
    "password": "password",
}
```

**200 OK - response body**
``` json
{
    "token": "access_token_jwt",
    "refresh_token": "refresh_token"
}
```

---
***Для обновления токена пользователя необходимо выполнить запрос на маршрут***
```/api/v1/auth/token/refresh```:

**Параметры запроса в формате json:**

``` json
{
    "refresh_token": "refresh token",
}
```

**200 OK - response body**
``` json
{
    "token": "access_token_jwt",
    "refresh_token": "refresh_token"
}
```

---
***Для инвалидации токена пользователя необходимо выполнить запрос на маршрут***
```/api/v1/auth/token/logout```:

**200 OK - response body**
``` json
{
    "code": 200,
    "message": "The supplied refresh_token is already invalid."
}
```

---
***Для получения данных текущего пользователя выполнить запрос на маршрут***
```/api/v1/users/me```:

**В заголовках данного запроса необходимо отправить параметр ```Authorization: Bearer <access_token>```:**

**200 OK - response body**
``` json
{
    "id": "0186a37e-4dc8-7a04-9f0a-a1b44111ad08",
    "name": "user name",
    "email": "user@email",
    "phone": 11111,
    "roles": [
        "ROLE_USER"
    ]
}
```
