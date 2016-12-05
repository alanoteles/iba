<?php

use Illuminate\Database\Seeder;
use Iba\Models\State;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create(['id'=>'1', 'name'=>'Acre', 'code'=>'AC','country_id'=>'1']);
        State::create(['id'=>'2', 'name'=>'Alagoas', 'code'=>'AL','country_id'=>'1']);
        State::create(['id'=>'3', 'name'=>'Amazonas', 'code'=>'AM','country_id'=>'1']);
        State::create(['id'=>'4', 'name'=>'Amapá', 'code'=>'AP','country_id'=>'1']);
        State::create(['id'=>'5', 'name'=>'Bahia', 'code'=>'BA','country_id'=>'1']);
        State::create(['id'=>'6', 'name'=>'Ceará', 'code'=>'CE','country_id'=>'1']);
        State::create(['id'=>'7','name'=>'Distrito Federal','code'=>'DF','country_id'=>'1']);
        State::create(['id'=>'8','name'=>'Espírito Santo','code'=>'ES','country_id'=>'1']);
        State::create(['id'=>'9', 'name'=>'Goiás', 'code'=>'GO','country_id'=>'1']);
        State::create(['id'=>'10', 'name'=>'Maranhão', 'code'=>'MA','country_id'=>'1']);
        State::create(['id'=>'11','name'=>'Minas Gerais','code'=>'MG','country_id'=>'1']);
        State::create(['id'=>'12','name'=>'Mato Grosso do Sul','code'=>'MS','country_id'=>'1']);
        State::create(['id'=>'13','name'=>'Mato Grosso','code'=>'MT','country_id'=>'1']);
        State::create(['id'=>'14', 'name'=>'Pará', 'code'=>'PA','country_id'=>'1']);
        State::create(['id'=>'15', 'name'=>'Paraíba', 'code'=>'PB','country_id'=>'1']);
        State::create(['id'=>'16', 'name'=>'Pernambuco', 'code'=>'PE','country_id'=>'1']);
        State::create(['id'=>'17', 'name'=>'Piauí', 'code'=>'PI','country_id'=>'1']);
        State::create(['id'=>'18', 'name'=>'Paraná', 'code'=>'PR','country_id'=>'1']);
        State::create(['id'=>'19','name'=>'Rio de Janeiro','code'=>'RJ','country_id'=>'1']);
        State::create(['id'=>'20','name'=>'Rio Grande do Norte','code'=>'RN','country_id'=>'1']);
        State::create(['id'=>'21', 'name'=>'Rondônia', 'code'=>'RO','country_id'=>'1']);
        State::create(['id'=>'22', 'name'=>'Roraima', 'code'=>'RR','country_id'=>'1']);
        State::create(['id'=>'23','name'=>'Rio Grande do Sul','code'=>'RS','country_id'=>'1']);
        State::create(['id'=>'24','name'=>'Santa Catarina','code'=>'SC','country_id'=>'1']);
        State::create(['id'=>'25', 'name'=>'Sergipe', 'code'=>'SE','country_id'=>'1']);
        State::create(['id'=>'26','name'=>'São Paulo','code'=>'SP','country_id'=>'1']);
        State::create(['id'=>'27', 'name'=>'Tocantins', 'code'=>'TO','country_id'=>'1']);
    }
}
