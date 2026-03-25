# Laravel - Framework Web PHP

## 📌 Sobre Laravel

**Laravel** é um framework web PHP moderno e elegante, projetado para facilitar o desenvolvimento de aplicações web com uma sintaxe expressiva e intuitiva. Ele oferece uma estrutura robusta que acelera o desenvolvimento, reduz código repetitivo e promove boas práticas de engenharia de software.

### Principais Características:
- ✅ Eloquent ORM - Abstração de banco de dados intuitiva
- ✅ Blade - Motor de templates poderoso
- ✅ Routing elegante e semântico
- ✅ Migração de banco de dados automatizada
- ✅ Middleware para controle de requisições
- ✅ Autenticação e autorização integradas
- ✅ API RESTful nativa

---

## 👨‍💻 Criador

**Laravel** foi criado por **Taylor Otwell** em 2011. Taylor desenvolveu o framework como uma alternativa mais intuitiva e "elegante" aos frameworks PHP existentes na época, priorizando a produtividade e a experiência do desenvolvedor.

---

## 🛠️ Linguagem de Programação

- **Linguagem Principal:** PHP 8.0+
- **Banco de Dados:** MySQL, PostgreSQL, SQLite, SQL Server
- **Frontend:** Blade Templates (PHP), pode integrar Vue.js, React, Alpine.js

---

## 🚀 Projeto Exemplo: Sistema de Blog

Para demonstrar as funcionalidades do Laravel, será desenvolvido um **Sistema de Blog Simples** com as seguintes features:

### Funcionalidades:
1. **Autenticação** - Registro e login de usuários
2. **CRUD de Posts** - Criar, ler, atualizar e deletar posts
3. **Comentários** - Adicionar comentários nos posts
4. **Dashboard** - Painel de controle para o autor
5. **Listagem Pública** - Exibição de posts publicados
6. **Busca e Filtros** - Buscar posts por título ou categoria

### Stack Tecnológico:
- Laravel 10+
- MySQL para banco de dados
- Blade para templates
- Bootstrap para styling
- Laravel Eloquent ORM

### Estrutura do Projeto:
```
blog-laravel/
├── app/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Post.php
│   │   └── Comment.php
│   ├── Http/Controllers/
│   │   ├── PostController.php
│   │   ├── CommentController.php
│   │   └── AuthController.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/views/
│   ├── posts/
│   ├── comments/
│   └── auth/
├── routes/
│   └── web.php
└── public/
```

---

## 📚 Resumo do Aprendizado

Este projeto visa explorar:
- Estrutura MVC do Laravel
- Eloquent ORM e relacionamentos
- Migrations para versionamento de banco de dados
- Controllers e Routes
- Autenticação e autorização
- Blade templates
- Validação de dados 
