# AutoAtendimento de Fast Food

Este é um sistema de AutoAtendimento de Fast Food construído com Laravel, Docker e Swagger UI.

## Pré-requisitos

Para instalar e rodar este sistema no Windows usando WSL (Windows Subsystem for Linux) e Docker, você precisará dos seguintes componentes:

1. **Windows 10 ou superior**
2. **WSL 2**: [Guia de instalação do WSL 2](https://docs.microsoft.com/en-us/windows/wsl/install)
3. **Docker Desktop**: [Baixar Docker Desktop](https://www.docker.com/products/docker-desktop) (Certifique-se de habilitar a integração com WSL 2 durante a instalação)
4. **Git**: [Baixar Git](https://git-scm.com/downloads)

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

1. **Clone o projeto** ```git clone``` [Repositorio](https://github.com/seu-usuario/autoatendimento-fastfood.git)
2. **Entre no projeto** ```cd autoatendimento-fastfood```
3. (Opicional)**Crie o .env** ```cp .env.example .env```
4. (Opicional)**Altere as variaveis necessarias no .env**
5. (Opicional)**Gere a chave do sistemas** ```php artisan key:generate```
6. (Opicional)**Instale as dependencias** ```composer install && npm install```
7. **Inicie os conteiners** ```docker-compose up -d```
8. (Opicional)**Desligue os conteiners** ```docker-compose down```

## Swagger UI

Para acessar a documentação das APIs usando Swagger UI, abra seu navegador e vá para:

http://localhost:8000/api