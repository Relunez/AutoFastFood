# AutoAtendimento de Fast Food

Este é um sistema de AutoAtendimento de Fast Food construído com Laravel, Docker e Swagger UI.

## Pré-requisitos

Para instalar e rodar este sistema no Windows usando WSL (Windows Subsystem for Linux) e Docker, você precisará dos seguintes componentes:

1. **Windows 10 ou superior**
2. **WSL 2**: [Guia de instalação do WSL 2](https://docs.microsoft.com/en-us/windows/wsl/install)
3. **Docker Desktop**: [Baixar Docker Desktop](https://www.docker.com/products/docker-desktop) (Certifique-se de habilitar a integração com WSL 2 durante a instalação)
4. **Git**: [Baixar Git](https://git-scm.com/downloads)
5. **PHP**: ```sudo apt install php php-curl php-fpm php-common libapache2-mod-php php-mbstring php-xmlrpc php-soap php-gd php-xml php-cli php-zip php-bcmath php-tokenizer php-json php-pear```
6. **Composer** [Instalar Composer](https://getcomposer.org/download/)
   1. ```php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"```
   2. ```php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"```
   3. ```php composer-setup.php```
   4. ```php -r "unlink('composer-setup.php');"```
   5. ```sudo mv composer.phar /usr/local/bin/composer```
## Estrutura
Pensando em uma arquitetura hexagonal teremos a pasta Models como o Domain, Services como o Application e Controllers + Repositories como Infrastructure

```
app/
├── Http/
│   ├── Controllers/ - Infrastructure
│   │   ├── Controller.php
│   │   ├── ClienteController.php
│   │   ├── PedidoController.php
│   │   └── ProdutoController.php
│   ├── Repositories/ - Infrastructure
│   │   ├── ClienteRepository.php
│   │   ├── ClienteRepositoryInterface.php
│   │   ├── PedidoRepository.php
│   │   ├── PedidoRepositoryInterface.php
│   │   ├── ProdutoRepository.php
│   │   └── ProdutoRepositoryInterface.php
│   ├── Services/ - Application
│   │   ├── ClienteService.php
│   │   ├── PedidoService.php
│   │   └── ProdutoService.php
└── Models/ - Domain
    ├── Acompanhamento.php
    ├── Bebida.php
    ├── Cliente.php
    ├── Lanche.php
    ├── Pagamento.php
    ├── Pedido.php
    ├── PedidoProduto.php
    ├── Sobremesa.php
    ├── Status.php
    ├── StatusPagamento.php
    └── StatusPedido.php
```

## Variáveis de Ambiente

Você precisará configurar algumas variáveis de ambiente no arquivo `.env` na raiz do projeto. Copie o arquivo `.env.example` para `.env` e ajuste as variáveis de ambiente relacionadas ao banco de dados conforme necessário exemplo:

```env
APP_ENV=local
APP_DEBUG=true
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=AutoFastFood
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

## Passo-a-Passo

Após se certificar de todos os pre-requisitos vamos subir e ligar o sistema.

1. **Clone o projeto** ```git clone``` [AutoFastFood.git](https://github.com/Relunez/AutoFastFood.git)
2. **Entre no projeto** ```cd AutoFastFood```
3. (Opicional)**Crie o .env** ```cp .env.example .env```
4. (Opicional)**Altere as variaveis necessarias no .env**
5. **Instale as dependencias** ```composer install && npm install```
6. (Opicional)**Gere o helper para as IDEs** ```php artisan ide-helper:generate```
7. (Opicional)**Gere a chave do sistemas** ```php artisan key:generate```
8. **Inicie os conteiners** ```docker-compose up -d```
9. (Opicional)**Desligue os conteiners** ```docker-compose down```

## Swagger UI

Para acessar a documentação das APIs usando Swagger UI, abra seu navegador e vá para:

http://localhost:8000/api