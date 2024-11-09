# Projeto de Cadastro de Notícias - Investidor10

Este projeto foi desenvolvido como parte de um teste técnico para a Investidor10. A aplicação permite o cadastro e a visualização de notícias e categorias. 

## Pré-requisitos

Antes de iniciar, certifique-se de que você possui os seguintes softwares instalados em sua máquina:

- **Docker** 
- **Git** 

## Configuração

Para configurar o ambiente de desenvolvimento, siga as instruções abaixo. Utilizamos o [Laravel Sail](https://laravel.com/docs/11.x/sail) para gerenciamento de containers Docker, simplificando a configuração de banco de dados e serviços auxiliares.

### Passo a Passo

1. **Clone o Repositório**

   ```bash
   git clone https://github.com/diogolacerda/news-app.git
   cd news-app

2. **Instalando as Dependências**

   Para instalar as dependências do projeto sem precisar do Composer na máquina local, execute o comando abaixo. Este comando utiliza um container Docker contendo PHP e Composer para instalar as dependências diretamente no projeto:

    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php83-composer:latest \
        composer install --ignore-platform-reqs
    
3. **Configure do Ambiente**

    - Copie o arquivo `.env.example` para `.env`:
        ```bash
        cp .env.example .env
    - Suba o ambiente de desenvolvimento:
        ```bash
        ./vendor/bin/sail up -d 
    - Gere a chave da aplicação:
        ```bash
        ./vendor/bin/sail artisan key:generate 
    - Instale as dependências do Node.js
        ```bash
        ./vendor/bin/sail npm install 
    - Compile os assets
        ```bash
        ./vendor/bin/sail npm run build 
    - Migre o banco de dados:
        ```bash
        ./vendor/bin/sail artisan migrate 
4. **Execute o Seed**
    ```bash 
    ./vendor/bin/sail artisan db:seed
5. **Rode os Testes**
    ```bash
    ./vendor/bin/sail test
6. **Para finalizar o ambiente**
    ```bash
    ./vendor/bin/sail down

