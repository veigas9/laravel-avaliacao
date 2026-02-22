-- Tabelas base de origem

CREATE TABLE IF NOT EXISTS produtos_base (
    prod_id INTEGER PRIMARY KEY AUTOINCREMENT,
    prod_cod VARCHAR(30),
    prod_nome VARCHAR(150),
    prod_cat VARCHAR(50),
    prod_subcat VARCHAR(50),
    prod_desc TEXT,
    prod_fab VARCHAR(100),
    prod_mod VARCHAR(50),
    prod_cor VARCHAR(30),
    prod_peso TEXT,
    prod_larg TEXT,
    prod_alt TEXT,
    prod_prof TEXT,
    prod_und VARCHAR(10),
    prod_atv BOOLEAN DEFAULT 1,
    prod_dt_cad TEXT
);

CREATE TABLE IF NOT EXISTS precos_base (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    prc_cod_prod VARCHAR(255),
    prc_valor VARCHAR(255),
    prc_moeda VARCHAR(255),
    prc_desc VARCHAR(255),
    prc_acres VARCHAR(255),
    prc_promo VARCHAR(255),
    prc_dt_ini_promo VARCHAR(255),
    prc_dt_fim_promo VARCHAR(255),
    prc_dt_atual VARCHAR(255),
    prc_origem VARCHAR(255),
    prc_tipo_cli VARCHAR(255),
    prc_vend_resp VARCHAR(255),
    prc_obs VARCHAR(255),
    prc_status VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME
);
