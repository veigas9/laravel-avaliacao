# Requisitos e Arquitetura do Projeto

## 1. Objetivo

Desenvolver uma aplicacao backend em Laravel para processar, transformar e sincronizar dados de produtos e precos, usando Views SQL como camada de normalizacao e expondo apenas API REST.

## 2. Requisitos Funcionais

1. Criar tabelas de origem:
- `produtos_base`
- `precos_base`

2. Criar tabelas de destino:
- `produto_insercao`
- `preco_insercao`

3. Criar Views SQL para transformacao:
- `view_produtos`
- `view_precos`

4. Aplicar normalizacao dos dados nas Views:
- limpeza de espacos (`TRIM`)
- padronizacao de caixa (`UPPER`/`LOWER`)
- conversao de tipos (ex.: valores numericos e datas)
- conversao de strings vazias para `NULL`
- filtro de registros ativos

5. Sincronizar dados a partir das Views para as tabelas de destino com:
- insercao de novos registros
- atualizacao apenas quando houver diferenca
- remocao de registros que nao existem mais na View
- prevencao de duplicidade por chave de negocio

6. Disponibilizar endpoints REST:
- `POST /api/sincronizar/produtos`
- `POST /api/sincronizar/precos`
- `GET /api/produtos-precos` (paginado com `per_page` e `page`)

7. Retornar resposta JSON com status e metricas de sincronizacao:
- `status`
- `total`
- `inseridos`
- `atualizados`
- `removidos`
- `inalterados`

## 3. Requisitos Nao-Funcionais

1. Execucao integral via Docker.
2. Presenca de `docker-compose.yml` na raiz.
3. Projeto API-only (sem interface web).
4. Nao exigir instalacao de PHP/Composer no host.
5. Instrucoes de execucao documentadas em `README.md`.
6. Endpoints documentados em `README.md`.
7. Persistencia em banco SQLite para simplicidade de setup local.
8. Idempotencia de sincronizacao.
9. Escrita minima para reduzir operacoes desnecessarias no banco.

## 4. Requisitos para Execucao do Projeto

1. Docker e Docker Compose instalados.
2. Porta `8000` livre no host.
3. Subir ambiente:

```bash
docker compose up -d --build
```

4. Preparar banco e dados iniciais:

```bash
docker compose exec app php artisan migrate:fresh --seed
```

5. API disponivel em:

```text
http://localhost:8000
```

## 5. Design da Solucao

O design adotado separa responsabilidades em tres camadas:

1. Camada SQL (Views):
- concentra transformacao e normalizacao.
- define o formato final dos dados consumidos pela aplicacao.

2. Camada de Sincronizacao (Services):
- consome dados ja normalizados das Views.
- aplica regras de sincronizacao (insert/update/delete e idempotencia).

3. Camada de Exposicao (API Controllers):
- recebe chamadas HTTP.
- dispara os servicos.
- retorna respostas JSON.

## 6. Arquitetura Usada

### 6.1 Componentes

1. `Docker`
- container `app` com PHP/Laravel.

2. `Laravel API`
- rotas em `src/routes/api.php`.
- controllers em `src/app/Http/Controllers`.
- servicos de sincronizacao em `src/app/Services`.

3. `Banco SQLite`
- migrations em `src/database/migrations`.
- views em `src/database/views`.
- seeders em `src/database/seeders`.

### 6.2 Fluxo de Dados

1. Seed/Migrations populam `produtos_base` e `precos_base`.
2. Views (`view_produtos`, `view_precos`) padronizam os dados.
3. Endpoints de sincronizacao executam Services.
4. Services sincronizam dados para `produto_insercao` e `preco_insercao`.
5. Endpoint de consulta retorna join paginado das tabelas de destino.

### 6.3 Chaves e Integridade

1. `produto_insercao.codigo` com chave unica.
2. `preco_insercao` com chave unica composta:
- `codigo_produto`
- `tipo_cliente`

Essas chaves garantem idempotencia e evitam duplicidade.

## 7. Decisoes Tecnicas

1. Normalizacao na View (SQL) para aderencia ao requisito do desafio.
2. Sincronizacao incremental com comparacao de payload para evitar updates desnecessarios.
3. Remocao de registros obsoletos no destino para manter consistencia.
4. API-only para atender a restricao de nao possuir interface web.

## 8. Endpoints (Resumo)

1. `POST /api/sincronizar/produtos`
- sincroniza produtos.

2. `POST /api/sincronizar/precos`
- sincroniza precos.

3. `GET /api/produtos-precos?per_page=10&page=1`
- lista produtos e precos com paginacao.
