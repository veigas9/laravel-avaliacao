# Teste Tecnico - Backend Laravel (API Only)

Aplicacao backend para processamento, transformacao e sincronizacao de dados de produtos e precos usando Views SQL.

## Requisitos

- Docker e Docker Compose instalados.
- Nenhuma dependencia de PHP/Composer no host.

## Subir o projeto

1. Build e sobe o container:

```bash
docker compose up -d --build
```

2. Executa migrations e seeders:

```bash
docker compose exec app php artisan migrate:fresh --seed
```

3. API disponivel em:

```text
http://localhost:8000
```

## Endpoints

### 1) Sincronizar Produtos

- Metodo: `POST`
- URL: `/api/sincronizar/produtos`
- Descricao: sincroniza dados da `view_produtos` para `produto_insercao` com insercao, atualizacao e remocao.

Exemplo:

```bash
curl -X POST http://localhost:8000/api/sincronizar/produtos
```

### 2) Sincronizar Precos

- Metodo: `POST`
- URL: `/api/sincronizar/precos`
- Descricao: sincroniza dados da `view_precos` para `preco_insercao` com insercao, atualizacao e remocao.

Exemplo:

```bash
curl -X POST http://localhost:8000/api/sincronizar/precos
```

### 3) Listar Produtos e Precos (Paginado)

- Metodo: `GET`
- URL: `/api/produtos-precos`
- Query params:
- `per_page` (opcional, default `10`)
- `page` (opcional, default `1`)

Exemplo:

```bash
curl "http://localhost:8000/api/produtos-precos?per_page=10&page=1"
```

## Regras de sincronizacao

- Fonte obrigatoria: `view_produtos` e `view_precos`.
- Apenas registros ativos sao considerados nas Views.
- Sem duplicidade:
- Produto: chave de negocio `codigo` (unica).
- Preco: chave de negocio composta `codigo_produto + tipo_cliente` (unica).
- Escrita minima:
- Atualiza apenas quando houver diferenca de dados.
- Remove da tabela de destino o que nao existe mais na respectiva View.

## Arquivo SQL de referencia

O arquivo `script_tabelas_base.sql` na raiz contem o DDL das tabelas base de origem.
