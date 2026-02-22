<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutosBaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement("
            INSERT INTO produtos_base (
                prod_cod, prod_nome, prod_cat, prod_subcat, prod_desc, prod_fab,
                prod_mod, prod_cor, prod_peso, prod_larg, prod_alt, prod_prof,
                prod_und, prod_atv, prod_dt_cad
            ) VALUES
            (' PRD001', '   Teclado  Mecânico   RGB  ', 'PERIFERICOS', 'TECLADOS', 'Teclado com iluminação RGB e switches azuis', 'HyperTech', 'HT-KEY-RGB', 'Preto', '1,2kg ', '45 cm', '5 CM ', '15cm ', 'UN ', 1, '2025/10/10'),
            ('prd002 ', ' Mouse óptico  sem fio', 'Periféricos ', 'Mouses', 'Mouse com conexão wireless 2.4GHz', 'TechPro', 'TP-MOUSE-X', ' Preto ', ' 95g ', '6cm', '3 CM', '10cm', ' un', 1, '10-10-2025'),
            ('PRD003', 'Monitor 24\" Full HD', 'MONITORES', 'LCD', 'Monitor 1080p HDMI e VGA', 'ViewBest', 'VB-24HD', 'Preto', '3.5 KG', '53,2cm ', '32cm ', ' 12 cm ', 'un', 1, '2025-10-12'),
            ('PRD004', 'Cadeira gamer Reclinável ', 'Móveis ', 'Cadeiras', 'Cadeira ergonômica com apoio de braço', 'ComfortSeat', 'CS-GAMER-R', 'Vermelha', ' 16,3 kg', '70 CM ', ' 120 cm', '60 CM', 'UN', 1, '15/10/2025'),
            (' PRD005', 'HEADSET gamer 7.1', 'Periféricos', 'Headsets', 'Headset com som surround 7.1 e microfone retrátil', 'SoundMax', 'SM-HS71', ' Preto ', ' 350G ', '18cm', '20 CM ', '10 cm', 'UN', 0, '2025.10.09'),
            ('PRD006', 'SSD 1TB NVMe', 'COMPONENTES', 'ARMAZENAMENTO', 'SSD NVMe M.2 2280, leitura 3500MB/s', 'DataFast', 'DF-NV1TB', 'Prata', '8g', '8cm', '0,2cm', '2,2cm', 'UN', 1, '2023-05-20'),
            ('PRD007', 'Placa de Vídeo RTX 4060', 'COMPONENTES', 'GPUS', '8GB GDDR6, 3072 cores CUDA', 'GraphiCore', 'GC-RTX4060', 'Preto', '1.2kg', '24cm', '11.5cm', '4cm', 'UN', 1, '2024/01/15'),
            ('PRD008', 'Processador Core i7', 'COMPONENTES', 'CPUS', '12ª geração, 12 núcleos, 4.9GHz', 'ChipTech', 'CT-I712700', 'Prata', '50g', '4.5cm', '4.5cm', '0.5cm', 'UN', 1, '2023.11.30'),
            ('PRD009', 'Memória RAM 16GB', 'COMPONENTES', 'MEMORIAS', 'DDR4 3200MHz, CL16', 'MemSpeed', 'MS-D416G', 'Preta', '40g', '13.3cm', '3cm', '0.8cm', 'UN', 1, '2023/08/22'),
            ('PRD010', 'Fonte 750W 80 Plus', 'COMPONENTES', 'FONTES', 'Modular, certificação Gold', 'PowerMax', 'PM-750G', 'Preta', '2.1kg', '16cm', '15cm', '8.6cm', 'UN', 1, '2024-02-10'),
            ('PRD011', 'Gabinete Gamer', 'ACESSORIOS', 'GABINETES', 'Mid Tower, com lateral em vidro', 'CaseMaster', 'CM-T500', 'Branco', '6.5kg', '47cm', '50cm', '22cm', 'UN', 1, '2023.12.05'),
            ('PRD012', 'Water Cooler 240mm', 'COMPONENTES', 'REFRIAMENTO', 'Radiador duplo, RGB', 'CoolFlow', 'CF-W240', 'Preto', '1.1kg', '27.5cm', '12cm', '5.2cm', 'UN', 0, '2024/03/18')
        ");
    }
}