<?php

use Illuminate\Database\Seeder;

class LicensesTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO license_translations(id,name,summary,locale, license_id, created_by) VALUES (?,?,?,?)', ['1', 'Atribuição CC BY', 'Esta licença permite que outros distribuam, remixem, adaptem e criem a partir do seu trabalho, mesmo para fins comerciais, desde que lhe atribuam o devido crédito pela criação original. É a licença mais flexível de todas as licenças disponíveis. É recomendada para maximizar a disseminação e uso dos materiais licenciados.', 'pt_br', '1', '1']);
        DB::insert('INSERT INTO license_translations(id,name,summary,locale, license_id, created_by) VALUES (?,?,?,?)', ['2', 'Atribuição-CompartilhaIgual CC BY-SA', 'Esta licença permite que outros remixem, adaptem e criem a partir do seu trabalho, mesmo para fins comerciais, desde que lhe atribuam o devido crédito e que licenciem as novas criações sob termos idênticos. Esta licença costuma ser comparada com as licenças de software livre e de código aberto "copyleft". Todos os trabalhos novos baseados no seu terão a mesma licença, portanto quaisquer trabalhos derivados também permitirão o uso comercial. Esta é a licença usada pela Wikipédia e é recomendada para materiais que seriam beneficiados com a incorporação de conteúdos da Wikipédia e de outros projetos com licenciamento semelhante.', 'pt_br', '2', '1']);
        DB::insert('INSERT INTO license_translations(id,name,summary,locale, license_id, created_by) VALUES (?,?,?,?)', ['3', 'Atribuição-SemDerivações CC BY-ND', 'Esta licença permite a redistribuição, comercial e não comercial, desde que o trabalho seja distribuído inalterado e no seu todo, com crédito atribuído a você.', 'pt_br', '3', '1']);
        DB::insert('INSERT INTO license_translations(id,name,summary,locale, license_id, created_by) VALUES (?,?,?,?)', ['4', 'Atribuição-NãoComercial CC BY-NC', 'Esta licença permite que outros remixem, adaptem e criem a partir do seu trabalho para fins não comerciais, e embora os novos trabalhos tenham de lhe atribuir o devido crédito e não possam ser usados para fins comerciais, os usuários não têm de licenciar esses trabalhos derivados sob os mesmos termos.', 'pt_br', '4', '1']);
        DB::insert('INSERT INTO license_translations(id,name,summary,locale, license_id, created_by) VALUES (?,?,?,?)', ['5', 'Atribuição-NãoComercial-CompartilhaIgual CC BY-NC-SA', 'Esta licença permite que outros remixem, adaptem e criem a partir do seu trabalho para fins não comerciais, desde que atribuam a você o devido crédito e que licenciem as novas criações sob termos idênticos.', 'pt_br', '5', '1']);
        DB::insert('INSERT INTO license_translations(id,name,summary,locale, license_id, created_by) VALUES (?,?,?,?)', ['6', 'Atribuição-SemDerivações-SemDerivados CC BY-NC-ND', 'Esta é a mais restritiva das nossas seis licenças principais, só permitindo que outros façam download dos seus trabalhos e os compartilhem desde que atribuam crédito a você, mas sem que possam alterá-los de nenhuma forma ou utilizá-los para fins comerciais.', 'pt_br', '6', '1']);
    }
}
