<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Partner extends Model
{

    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name', 'acronym', 'summary', 'url', 'content_data'];
    protected $guarded = ['id'];

    protected $fillable = ['status', 'partner_group_id'];

    public function partner_group()
    {
        return $this->belongsTo('\Iba\Models\PartnerGroup');
    }


    public function images()
    {
        return $this->hasOne('\Iba\Models\PartnerImage');
    }


    public function translation()
    {
        return $this->hasMany('\Iba\Models\PartnerTranslation');
    }
    public function project_partner()
    {
        return $this->belongsToMany('\Iba\Models\Project')->withPivot('type');
    }


    public function projects()
    {
        return $this->belongsToMany('\Iba\Models\Project')->withPivot('type');
    }


    public static function retorna_projetos($id_partner, $id_situacao = 0){

        $query = 'select DISTINCT(A.id)
                                from projects A,
                                    project_translations B,
                                    partners C,
                                    partner_project D,
                                    partner_translations E
                                where A.id = B.project_id
                                and   A.id = D.project_id
                                and   B.locale = \''. app()->getLocale() . '\'
                                and   C.id = D.partner_id
                                and   C.id = E.partner_id
                                and A.status = \'1\'
                                and C.status = \'1\'
                                and C.id = ' . $id_partner ;

        //-- Se for informada uma situação, filtra por ela. Se não, traz tudo.
        if($id_situacao != 0){
            $query .= '  and A.project_situation_id = ' . $id_situacao;
        }

//echo $query . '<br><br>';//die;

        $resultado         = DB::select($query);
        $id_projetos = array();
        foreach($resultado as $r){
            $id_projetos[] = $r->id;
        }

        //$projetos = Project::whereIn('id', $id_projetos)->paginate($itens_por_pagina);

        return $id_projetos;
    }
}
