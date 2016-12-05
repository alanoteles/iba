<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use PDO;

class Project extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['title', 'summary', 'comment', 'results', 'locale'];
    protected $guarded = ['id'];

    protected $fillable = ['number', 'meeting_date', 'implementation_period_start', 'implementation_period_end', 'project_value', 'status', 'project_type_id', 'project_activity_id', 'project_situation_id'];

    public function project_type()
    {
        return $this->belongsTo('\Iba\Models\ProjectType');
    }


    public function project_situation()
    {
        return $this->belongsTo('\Iba\Models\ProjectSituation');
    }


//    public function user()
//    {
//        return $this->belongsTo('Iba\Models\User');
//    }

//
//    public function project_activities()
//    {
//        return $this->belongsTo('\Iba\Models\ProjectActivities');
//    }
//
//
//    public function project_translation()
//    {
//        return $this->hasMany('\Iba\Models\ProjectTranslation');
//    }


    public function translation()
    {
        return $this->hasMany('\Iba\Models\ProjectTranslation');
    }


    public function cms_highlights()
    {
        return $this->hasMany('\Iba\Models\CmsHighlight', 'record_id', 'project_id');
    }


    public function project_year()
    {
        return $this->hasMany('\Iba\Models\ProjectYear');
    }


    public function project_partner()
    {
        return $this->belongsToMany('\Iba\Models\Partner')->withPivot('type');
    }


    public function partners()
    {
        return $this->belongsToMany('\Iba\Models\Partner')->withPivot('type');
    }


    public function cms_object_attachments()
    {
        return $this->belongsToMany('\Iba\Models\Object', 'cms_object_attachments', 'fk_id')->withPivot('type');

    }


    public function partner_project()
    {
        return $this->hasMany('\Iba\Models\Partner');
    }


    public function project_attachment()
    {
        return $this->hasMany('\Iba\Models\CmsObjectAttachment', 'fk_id'); //->withPivot('module');
    }


    public static function busca($request, $termo, $itens_por_pagina)
    {

        $query_projetos = 'select DISTINCT(A.id)
                        from projects A,
                            project_translations B,
                            partners C,
                            partner_project D,
                            partner_translations E
                        where A.id = B.project_id
                        and   A.id = D.project_id
                        and   B.locale = \'' . app()->getLocale() . '\'
                        and   C.id = D.partner_id
                        and   C.id = E.partner_id
                        and A.status = \'1\'
                        and C.status = \'1\'
                        and (   B.title     LIKE \'%' . $termo . '%\'
                            or	B.summary   LIKE \'%' . $termo . '%\'
                            or	A.number    LIKE \'%' . $termo . '%\'
                            or	B.comment   LIKE \'%' . $termo . '%\'
                            or	B.results   LIKE \'%' . $termo . '%\'
                            or	E.name      LIKE \'%' . $termo . '%\'
                            or	E.acronym   LIKE \'%' . $termo . '%\'
                            or	E.summary   LIKE \'%' . $termo . '%\'
                            or	E.url       LIKE \'%' . $termo . '%\'
                            or	E.content_data   LIKE \'%' . $termo . '%\'
                            )
                  ';

        $resultado_projetos = DB::select($query_projetos);
        $id_projetos = array();
        foreach ($resultado_projetos as $r) {
            $id_projetos[] = $r->id;
        }

        $projetos = Project::whereIn('id', $id_projetos)->paginate($itens_por_pagina);
//
//        if($request->ajax()){
////echo 'vvv';die;
//            return [
//                'resultados'      => view('includes.ajax_projetos')->with(compact('projetos'))->render(),
//                'proxima_pagina'    => $projetos->nextPageUrl()
//            ];
//        }else{
//echo 'ccc';die;
        return $projetos;

        //}


    }

    /**
     * Retorna todos os projetos, com filtros por associada, situação e atividade
     * Nomes dos campos de acordo com os usados para os gráficos de linha IBA
     * @param int $associada
     * @param int $situacao
     * @param int $atividade
     * @return array
     */
    public static function buscaProjetosSituacaoAtividade($associada = 0, $situacao = 0, $atividade = 0)
    {
        //Apenas parceiros do tipo proponente
        $where = 'WHERE partner.type=\''.\Config::get('constants.PARTNERS_TYPE_EXECUTOR').'\'';

        //Construindo clásusula where
        if ($situacao != 0) $where .= ' AND project_situation_id=' . $situacao;
        if ($associada != 0) $where .= ' AND partner.partner_id=' . $associada;
        if ($atividade != 0) $where .= ' AND project_activity_id=' . $atividade;


        //SQL de consulta - para variáveis padrão do gráfico d3
        $sql = "SELECT SUM(project_value) AS `Line 1`,
                'val1' AS `type`,  CONCAT('1/1/',DATE_FORMAT(implementation_period_end,'%y')) AS `date`
                FROM `projects` p LEFT JOIN `partner_project` partner ON p.id = project_id {$where}
                GROUP BY `date`";

        return DB::select($sql);
    }

    /**
     * Total de projetos por associada agrupados por situação (porcentagem de cada) e valor total
     * Se nenhum parâmetro é fornecido retorna todas associadas
     * @param int $associada
     * @return array
     */
    public static function buscaProjetosAssociadas($associada = 0, $mostra_total = false)
    {

        $where = '';
        if ($associada != 0) ' AND partner.partner_id=' . $associada;

        //Array com situações no idioma
        $valor_associada = [];
        $situacao = ProjectSituation::all();
        foreach ($situacao as $s)
            $valor_associada[$s->name] = 0;

        $sql = "SELECT pt.acronym AS label,  pst.name AS situacao, project_value, pp.partner_id AS partner_id
                FROM project_activity_translations pat, project_situation_translations pst, projects p
                LEFT JOIN partner_project pp ON p.id = pp.project_id
                LEFT JOIN partners ON pp.partner_id = partners.id
                LEFT JOIN partner_translations pt ON partners.id = pt.partner_id
                WHERE pp.type = 'executor' AND pt.locale='" . app()->getLocale() . "' AND pst.locale='" . app()->getLocale() . "'
                {$where}
                AND p.project_activity_id = pat.project_activity_id
                AND p.project_situation_id = pst.project_situation_id
                GROUP BY p.id ORDER BY partners.id";

        $resultado = DB::select($sql);


        /**
         * Cálculo da porcentagem para cada situação
         * e array json no formato para gráfico d3
         */
        //Variáveis iniciais para calculo
        $valor_total_global     = 0;
        $valor_total_associada  = 0;
        $final                  = [];
        $associada_id           = 0;
        $total_resultados       = count($resultado);
        $registros              = 0; //contagem de registros no loop foreach
        $i                      = 0; //variável para interação no array final

        foreach ($resultado as $r) {
            $registros++;
            if ($associada_id == 0) $associada_id = $r->partner_id;//Primeira iteração

            //Mudou de associada
            if (($associada_id <> $r->partner_id)) {

                $final[$i]['label'] = $label; //Nome da associada no resultado final
                //Valores somados por situação dos projetos por Associadas
                foreach ($valor_associada as $key => $value) {
                    if ($value != 0) $value = round(($value * 100) / $valor_total_associada, 2);//% da situação
                    $final[$i][$key] = $value;

                    $valor_associada[$key] = 0; //zera valores para próxima iteração
                }

                //Se opção for verdadeira
                if ($mostra_total)
                    $final[$i]['total_associada'] = $valor_total_associada; //Total de projetos da associada
                $i++; //Próximo registro final
                $associada_id = $r->partner_id; //Próxima associada
                $valor_total_associada = 0; //zera para próxima iteração
            }

            $valor_associada[$r->situacao] += $r->project_value; //Soma o valor do projeto na situação
            $label = $r->label; //Nome da associada

            $valor_total_associada += $r->project_value; //Somatório global para a associada
            $valor_total_global += $r->project_value; //Somatório global para a associada

            //Ultimo registro
            if($total_resultados==$registros){
                $final[$i]['label'] = $label; //Nome da associada no resultado final
                //Valores somados por situação dos projetos por Associadas
                foreach ($valor_associada as $key => $value) {
                    if ($value != 0) $value = round(($value * 100) / $valor_total_associada, 2);//% da situação
                    $final[$i][$key] = $value;

                    $valor_associada[$key] = 0; //zera valores para próxima iteração
                }

                //Se opção for verdadeira
                if ($mostra_total)
                    $final[$i]['total_associada'] = $valor_total_associada; //Total de projetos da associada

            }
        }

        //Se a opção para mostrar total for verdadeira
        if ($mostra_total)
            $final[0]['total_global'] = $valor_total_global;

        return $final;
    }





}
