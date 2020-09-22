## Introdução
Back-end do sistema de agendamentos desenvolvido em PHP com Laravel 5.7.

## Requisitos
- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension
- fileinfo PHP Extension

## Instalação
- Clone o projeto
- Instale o projeto
```
composer install
```
- Copie o arquivo .env.example e renomeie para .env
- Configure a conexão com o banco no arquivo .env
- Gere uma chave para o projeto
```
php artisan key:generate
```
- Gere uma chave para o jwt
```
php artisan jwt:secret
```
- Execute as migrations
```
php artisan migrate
```
- Execute as Seeds
```
php artisan db:seed
```
Será criado um usuário padrão
```
email: maximo@teste.com
senha: 123456
```
