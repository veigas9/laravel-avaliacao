<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrecosBaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement("
            INSERT INTO precos_base (
                prc_cod_prod,
                prc_valor,
                prc_moeda,
                prc_desc,
                prc_acres,
                prc_promo,
                prc_dt_ini_promo,
                prc_dt_fim_promo,
                prc_dt_atual,
                prc_origem,
                prc_tipo_cli,
                prc_vend_resp,
                prc_obs,
                prc_status
            ) VALUES
            (' PRD001 ', ' 499,90 ', 'brl', '5%', '0', '474,90', '2025/10/10', '2025-10-20', '2025-10-15', 'SISTEMA ERP', 'VAREJO', 'Marcos Silva', 'Produto em destaque', 'ativo'),
            ('prd002', '120.50', 'BRL ', ' 0', '0', '120.50', '10-10-2025', NULL, '2025-10-16', 'MIGRACAO', 'ATACADO', ' Julia S.', NULL, 'ativo'),
            ('PRD003', '1.099,00', 'brl ', '10%', NULL, '989,10', '2025.10.10', '2025.10.25', '16/10/2025', 'API INTERNA', 'VAREJO', ' Carlos Souza ', 'Desconto aplicado via API', 'ativo'),
            (' prd004', ' 899.99', 'brl', NULL, '5%', NULL, '15/10/2025', '30/10/2025', '2025/10/16', 'ERP LEGADO', 'VAREJO', 'Jéssica M.', 'Campanha de Outubro', 'ativo'),
            ('PRD005 ', 'sem preço', 'BRL', NULL, NULL, NULL, NULL, NULL, '2025-10-10', 'ERP LEGADO', 'VAREJO', 'Pedro L.', 'Sem preço cadastrado', 'inativo'),
            ('PRD006', '389,90', 'BRL', '15%', '2%', '331,42', '2024.06.01', '2024.06.30', '2024-05-28', 'SISTEMA ERP', 'VAREJO', 'Ana Costa', 'Promoção semestral', 'ativo'),
            ('PRD007', '2.899,00', 'brl', '8%', NULL, '2.667,08', '2024/04/15', '2024/05/15', '2024-04-10', 'API INTERNA', 'ATACADO', 'Roberto Lima', 'Desconto por volume', 'ativo'),
            ('PRD008', '1.899,00', 'BRL', '12%', '3%', '1.671,12', '2024-03-01', '2024-03-31', '2024.02.25', 'ERP LEGADO', 'VAREJO', 'Fernanda R.', 'Liquidação estoque', 'ativo'),
            ('PRD009', '299,90', 'brl', '20%', '0', '239,92', '2024.05.20', '2024.06.20', '2024/05/15', 'SISTEMA ERP', 'ATACADO', 'Carlos Santos', 'Queima de estoque', 'ativo'),
            ('PRD010', '699,00', 'BRL', '5%', '1%', '664,05', '2024-04-01', '2024-04-30', '2024-03-28', 'API INTERNA', 'VAREJO', 'Mariana O.', 'Promoção relâmpago', 'ativo'),
            ('PRD011', '450,00', 'brl', '25%', NULL, '337,50', '2024/06/10', '2024/07/10', '2024.06.05', 'ERP LEGADO', 'VAREJO', 'Paulo H.', 'Dia dos namorados', 'ativo'),
            ('PRD012', '0', 'BRL', NULL, NULL, NULL, NULL, NULL, '2024-03-20', 'SISTEMA ERP', 'VAREJO', 'Lucas T.', 'Produto descontinuado', 'inativo')
        ");
    }
}