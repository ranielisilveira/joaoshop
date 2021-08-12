# Desafio Técnico 215 - Backend PHP Jr

## Instruções
Conforme solicitado foi utilizada a plataforma PHP (Laravel 8).

O primeiro passo para rodar a api é, após clonar este repositório, copiar o arquivo `.env.example` e salve como `.env`.

Devem ser adicionadas/modificadas as seguintes informações:
- "DB_HOST"=db (container mysql dentro do docker)
- "DB_PORT"=3306 (porta padrão dentro do docker)
- "DB_DATABASE"=joaoshop_api (nome do banco de dados inicial)
- "DB_USERNAME"=root
- "DB_PASSWORD"=root

Para verificar se a solução está funcionando, utilize o comando `docker-compose up --build` a partir do diretório raiz do projeto. 
A API estará mapeada para a porta `8001` do seu host local. Uma requisição `GET localhost:8001/` vai retornar a versão do Laravel em execução.

**IMPORTANTE:** após a execução do `docker-compose up -d`, na pasta do projeto, execute o comando `docker-compose run web composer install`.
Quando o volume atual é mapeado para dentro do container, ele sobrescreve a pasta com as dependências instaladas pelo composer, por isso o comando é necessário. 

**DEVE SER EXECUTADO O COMANDO DE MIGRAÇÃO** antes de testar o funcionamento da aplicação, para isso execute o comando `docker-compose run web php artisan migrate --seed`. Após a execução serão criadas as tabelas e dados básicos de categorias.

