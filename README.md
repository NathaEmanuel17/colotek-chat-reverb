# Colotek Chat Reverb

Este é o projeto **Colotek Chat Reverb**, uma aplicação desenvolvida em Laravel.

## Requisitos

- **PHP**: 8.2 ou superior
- **Node.js**: 18 ou superior

## Instalação

Siga os passos abaixo para configurar e executar a aplicação localmente.

### 1. Clone o repositório

```bash
git clone https://github.com/NathaEmanuel17/colotek-chat-reverb.git
cd colotek-chat-reverb

2. Copie o arquivo de exemplo de ambiente
cp .env.example .env

3. Instale as dependências do PHP
composer install

4. Instale as dependências do Node.js e compile os ativos
npm install
npm run dev
npm run build

5. Execute as migrações do banco de dados
php artisan migrate

6. Gere a chave da aplicação
php artisan key:generate

7. Inicie o servidor de desenvolvimento
php artisan serve

8. Inicie o serviço do Reverb
php artisan reverb:start
