# Projeto Cadastro de Produtos (Full Stack) 🚀

Este é um sistema completo de cadastro de produtos desenvolvido com **Laravel** no backend, **Vue.js + Quasar** no frontend e **Docker** para orquestração de ambiente.

O projeto foi construído focado em boas práticas de desenvolvimento, utilizando uma arquitetura de API REST e SPA (Single Page Application).

## 🛠️ Tecnologias Utilizadas

* **Backend:** Laravel 12 (PHP 8.2+)
* **Frontend:** Vue 3 + Quasar Framework
* **Banco de Dados:** MySQL 8.0
* **Ambiente:** Docker & Docker Compose
* **Comunicação:** Axios (API REST)

---

## 📦 Como Rodar o Projeto

Siga os passos abaixo para subir o ambiente no seu notebook:

### 1. Clonar o Repositório
```bash
git clone [https://github.com/JefersonGarcia2018/projeto-docker-cadastro-de-produtos.git](https://github.com/JefersonGarcia2018/projeto-docker-cadastro-de-produtos.git)
cd projeto-docker-cadastro-de-produtos
````

### 2\. Configurar o Ambiente (Docker)

Certifique-se de que o Docker e o Docker Compose estão instalados. Suba os contêineres:

```bash
docker-compose up -d --build
```

### 3\. Configurar o Backend (Laravel)

O Git não envia o arquivo `.env`. Você precisará criá-lo:

```bash
# Entre na pasta da API
cd api
cp .env.example .env
# Se necessário, ajuste as credenciais do DB no .env (DB_HOST=db, DB_PASSWORD=root)
```

Agora, instale as dependências e rode as migrações para criar as tabelas:

```bash
docker exec -it laravel_api composer install
docker exec -it laravel_api php artisan key:generate
docker exec -it laravel_api php artisan migrate
```

### 4\. Configurar o Frontend (Quasar)

O contêiner do Quasar já deve estar rodando, mas caso as dependências não tenham sido instaladas:

```bash
docker exec -it vue_spa npm install
```

-----

## 🌐 Acesso ao Sistema

Após seguir os passos acima, você poderá acessar o sistema nos seguintes endereços:

  * **Frontend (Quasar):** [http://localhost:9000](https://www.google.com/search?q=http://localhost:9000)
  * **Backend (API Laravel):** [http://localhost:8000/api/products](https://www.google.com/search?q=http://localhost:8000/api/products)

-----

## 🛠️ Funcionalidades (CRUD)

  - [x] **Create:** Cadastro de novos produtos com validação.
  - [x] **Read:** Listagem de produtos em tempo real via Axios.
  - [x] **Update:** Edição de produtos existentes.
  - [x] **Delete:** Exclusão de registros com confirmação (Dialog).

-----

## 📄 Licença

Este projeto foi desenvolvido para fins de estudo e prática de desenvolvimento Full Stack.

````

---

### Como salvar isso no GitHub agora?

1.  Crie o arquivo: `touch README.md` (ou use o VS Code).
2.  Cole o texto acima e salve.
3.  No terminal, envie a atualização:

```bash
git add README.md
git commit -m "docs: adicionando documentação do projeto no README"
git push origin main
````