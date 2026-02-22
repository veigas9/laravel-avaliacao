CREATE VIEW view_precos AS
SELECT
    NULLIF(TRIM(UPPER(prc_cod_prod)), '') AS codigo_produto,

    CASE
        WHEN prc_valor GLOB '*[0-9]*'
        THEN CAST(
            REPLACE(
                REPLACE(prc_valor, '.', ''),
                ',', '.'
            ) AS REAL
        )
        ELSE NULL
    END AS valor,

    NULLIF(LOWER(TRIM(prc_moeda)), '') AS moeda,

    CASE
        WHEN prc_promo IS NOT NULL
        THEN CAST(
            REPLACE(
                REPLACE(prc_promo, '.', ''),
                ',', '.'
            ) AS REAL
        )
        ELSE NULL
    END AS valor_promocional,

    DATE(prc_dt_ini_promo) AS inicio_promocao,
    DATE(prc_dt_fim_promo) AS fim_promocao,
    DATE(prc_dt_atual)     AS data_atualizacao,

    NULLIF(TRIM(UPPER(prc_tipo_cli)), '') AS tipo_cliente,
    NULLIF(TRIM(prc_origem), '')          AS origem,
    NULLIF(TRIM(prc_vend_resp), '')       AS vendedor,
    NULLIF(TRIM(prc_obs), '')             AS observacao,
    CASE
        WHEN
            CASE
                WHEN prc_valor GLOB '*[0-9]*'
                THEN CAST(
                    REPLACE(
                        REPLACE(prc_valor, '.', ''),
                        ',', '.'
                    ) AS REAL
                )
                ELSE NULL
            END IS NOT NULL
        THEN 1
        ELSE 0
    END AS ativo
FROM precos_base
WHERE prc_status = 'ativo';
