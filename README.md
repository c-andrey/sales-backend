# 📦 Backend - Laravel API

Este projeto é uma API REST desenvolvida com Laravel para a gestão de vendas e cálculo de comissões.

## 📌 Tecnologias Utilizadas

- **PHP 8.x**
- **Laravel 10.x**
- **MySQL**
- **Docker**
- **PHPUnit** (para testes automatizados)
- **Arquitetura Limpa (Clean Architecture)** com Repositories e Services

---

## 📂 Estrutura do Projeto

```
backend/
│── app/
│   ├── Models/         # Modelos do banco de dados (Seller, Sale)
│   ├── Repositories/   # Interface e implementação dos repositórios
│   ├── Services/       # Lógica de negócios para vendedores e vendas
│── routes/
│   ├── api.php         # Rotas da API
│── database/
│   ├── migrations/     # Arquivos para criação de tabelas no banco
│── tests/              # Testes automatizados
│── docker-compose.yml  # Configuração do Docker
│── .env.example        # Arquivo de exemplo de configuração do ambiente
```

---

## ⚙️ Configuração e Instalação

### 1️⃣ Clonar o repositório
```sh
git clone https://github.com/seu-usuario/backend.git
cd backend
```

### 2️⃣ Configurar o ambiente
Copie o arquivo `.env.example` para `.env` e edite conforme necessário.
```sh
cp .env.example .env
```

### 3️⃣ Subir os containers com Docker
```sh
docker-compose up -d
```

### 4️⃣ Instalar dependências
```sh
composer install
```

### 5️⃣ Gerar chave da aplicação
```sh
php artisan key:generate
```

### 6️⃣ Rodar as migrations e popular o banco
```sh
php artisan migrate --seed
```

### 7️⃣ Iniciar o servidor Laravel
```sh
php artisan serve
```
A API estará disponível em `http://localhost:8000`.

---

## 📌 Endpoints da API

### 🔹 **Vendedores**
- `GET /api/sellers` → Listar todos os vendedores
- `POST /api/sellers` → Criar um novo vendedor
- `PUT /api/sellers/{seller_id}` -> Editar um vendedor
- `DELETE /api/sellers/{seller_id}`-> Deletar um vendedor
- `GET /api/sellers/{seller_id}` -> Listar um vendedor
- `GET /api/sellers/{seller_id}/sales`-> Listar as vendas de um vendedor

### 🔹 **Vendas**
- `GET /api/sales` → Listar todas as vendas
- `POST /api/sales` → Registrar uma nova venda
- `PUT /api/sales/{sale_id}` -> Editar uma venda
- `DELETE /api/sales/{sale_id}`-> Deletar uma venda
- `GET /api/sales/{sale_id}` -> Listar uma venda

---

## 🔍 Executando Testes

Para rodar os testes unitários e de integração:
```sh
php artisan test
```

---

