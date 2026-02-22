CREATE VIEW view_produtos AS
SELECT
    NULLIF(TRIM(UPPER(prod_cod)), '')    AS codigo,
    NULLIF(TRIM(prod_nome), '')          AS nome,
    NULLIF(TRIM(UPPER(prod_cat)), '')    AS categoria,
    NULLIF(TRIM(UPPER(prod_subcat)), '') AS subcategoria,
    NULLIF(TRIM(prod_desc), '')          AS descricao,
    NULLIF(TRIM(prod_fab), '')           AS fabricante,
    NULLIF(TRIM(prod_mod), '')           AS modelo,
    NULLIF(TRIM(prod_cor), '')           AS cor,
    NULLIF(TRIM(UPPER(prod_und)), '')    AS unidade,
    DATE(prod_dt_cad)                    AS data_cadastro,
    1                                    AS ativo
FROM produtos_base
WHERE prod_atv = 1;
