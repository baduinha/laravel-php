## Rotas do Projeto

A seguir estão todas as rotas HTTP configuradas no projeto, com seus caminhos, métodos, nomes, controladores e links diretos para acesso local.

> Base local de exemplo: `http://127.0.0.1:8000`

### `routes/web.php`

- [GET /](http://127.0.0.1:8000/)
  - Redireciona para a rota nomeada `posts.index`

- [GET /dashboard](http://127.0.0.1:8000/dashboard)
  - Retorna a view `dashboard`
  - Middleware: `auth`, `verified`
  - Nome: `dashboard`

- [GET /posts](http://127.0.0.1:8000/posts)
  - `PostController@index`
  - Nome: `posts.index`

- [GET /posts/{post}](http://127.0.0.1:8000/posts/{post})
  - `PostController@show`
  - Nome: `posts.show`

Rotas protegidas por `auth`:

- [GET /profile](http://127.0.0.1:8000/profile)
  - `ProfileController@edit`
  - Nome: `profile.edit`

- [PATCH /profile](http://127.0.0.1:8000/profile)
  - `ProfileController@update`
  - Nome: `profile.update`

- [DELETE /profile](http://127.0.0.1:8000/profile)
  - `ProfileController@destroy`
  - Nome: `profile.destroy`

- [GET /posts/create](http://127.0.0.1:8000/posts/create)
  - `PostController@create`
  - Nome: `posts.create`

- [POST /posts](http://127.0.0.1:8000/posts)
  - `PostController@store`
  - Nome: `posts.store`

- [GET /posts/{post}/edit](http://127.0.0.1:8000/posts/{post}/edit)
  - `PostController@edit`
  - Nome: `posts.edit`

- [PUT /posts/{post}](http://127.0.0.1:8000/posts/{post})
- [PATCH /posts/{post}](http://127.0.0.1:8000/posts/{post})
  - `PostController@update`
  - Nome: `posts.update`

- [DELETE /posts/{post}](http://127.0.0.1:8000/posts/{post})
  - `PostController@destroy`
  - Nome: `posts.destroy`

- [POST /posts/{post}/comments](http://127.0.0.1:8000/posts/{post}/comments)
  - `CommentController@store`
  - Nome: `comments.store`

### `routes/auth.php`

Rotas de autenticação para usuários convidados (`guest`):

- [GET /register](http://127.0.0.1:8000/register)
  - `RegisteredUserController@create`
  - Nome: `register`

- [POST /register](http://127.0.0.1:8000/register)
  - `RegisteredUserController@store`

- [GET /login](http://127.0.0.1:8000/login)
  - `AuthenticatedSessionController@create`
  - Nome: `login`

- [POST /login](http://127.0.0.1:8000/login)
  - `AuthenticatedSessionController@store`

- [GET /forgot-password](http://127.0.0.1:8000/forgot-password)
  - `PasswordResetLinkController@create`
  - Nome: `password.request`

- [POST /forgot-password](http://127.0.0.1:8000/forgot-password)
  - `PasswordResetLinkController@store`
  - Nome: `password.email`

- [GET /reset-password/{token}](http://127.0.0.1:8000/reset-password/{token})
  - `NewPasswordController@create`
  - Nome: `password.reset`

- [POST /reset-password](http://127.0.0.1:8000/reset-password)
  - `NewPasswordController@store`
  - Nome: `password.store`

Rotas protegidas por `auth`:

- [GET /verify-email](http://127.0.0.1:8000/verify-email)
  - `EmailVerificationPromptController`
  - Nome: `verification.notice`

- [GET /verify-email/{id}/{hash}](http://127.0.0.1:8000/verify-email/{id}/{hash})
  - `VerifyEmailController`
  - Middleware: `signed`, `throttle:6,1`
  - Nome: `verification.verify`

- [POST /email/verification-notification](http://127.0.0.1:8000/email/verification-notification)
  - `EmailVerificationNotificationController@store`
  - Middleware: `throttle:6,1`
  - Nome: `verification.send`

- [GET /confirm-password](http://127.0.0.1:8000/confirm-password)
  - `ConfirmablePasswordController@show`
  - Nome: `password.confirm`

- [POST /confirm-password](http://127.0.0.1:8000/confirm-password)
  - `ConfirmablePasswordController@store`

- [PUT /password](http://127.0.0.1:8000/password)
  - `PasswordController@update`
  - Nome: `password.update`

- [POST /logout](http://127.0.0.1:8000/logout)
  - `AuthenticatedSessionController@destroy`
  - Nome: `logout`

### `routes/console.php`

- Define o comando Artisan `inspire`
  - `Artisan::command('inspire', ...)`
  - Não é uma rota HTTP, é um comando de console.
