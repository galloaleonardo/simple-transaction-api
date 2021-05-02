## simple-transaction-api

#### Requisitos:
- Docker `>=` 20.10
- Docker Compose `>=` 1.29

--- 
#### Docker:
- Imagem [PHP 8.0.5](https://github.com/galloaleonardo/docker-php-fpm-8.0.5)
- Imagem [NGINX](https://github.com/galloaleonardo/docker-nginx-stable)
---

#### Instalação
- Subir o ambiente:
```shell
docker-compose up -d nginx
```

- Instalar dependências:
```shell
docker-compose run --rm composer install
```

- Copiar .env:
```shell
cp .env.example .env
```

- Gerar `APP_KEY`:
```shell
docker-compose run --rm artisan key:generate
```

- Gerar `migrations` e `seeds`:
```shell
docker-compose run --rm artisan migrate --seed
```

- Iniciar serviço de filas:
```shell
docker-compose run -d queue-work
```

---

#### Endpoints:
Transaction
```shell
POST api/transaction


// Payload Example

{
  "payer_id": 1,
  "payee_id": 2,
  "value": 100
}
```

Users  
````shell
GET|HEAD api/users 
````

````shell
GET|HEAD api/users/{user}
````

````shell
POST api/users


// Payload Example

{
  "full_name": "Google",
  "user_type": "company",
  "document": "83834383000120",
  "email": "google@google.com",
  "password": "12345678"
}
````



````shell
PUT|PATCH api/users/{user}

// Payload Example

{
  "full_name": "Christian Bale",
  "user_type": "person",
  "document": "33850997065",
  "email": "c.bale@gmail.com",
  "password": "12345678"
}
````

````shell
DELETE api/users/{user}
````

---

#### Testes
```shell
docker-compose run --rm test
```