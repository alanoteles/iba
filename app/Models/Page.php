<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use PDO;

class Page extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['title', 'content_data', 'locale'];
    protected $guarded = ['id'];


    public static function busca($request, $termo, $itens_por_pagina){

        $query_institucional = 'select DISTINCT(A.id)
                            from pages A,
                                page_translations B
                            where A.id = B.page_id
                            and   B.locale = \''. app()->getLocale() . '\'
                            and ( B.title         LIKE \'%'   . $termo . '%\'
                             or	B.content_data    LIKE \'%'   . $termo . '%\'
                             )
                      ';


        $resultado_institucional    = DB::select($query_institucional);
        $id_institucional = array();
        foreach($resultado_institucional as $r){
            $id_institucional[] = $r->id;
        }
        $institucional = Page::whereIn('id', $id_institucional)->paginate($itens_por_pagina);
//
//        if($request->ajax()){
////echo 'vvv';die;
//            return [
//                'resultados'      => view('includes.ajax_projetos')->with(compact('projetos'))->render(),
//                'proxima_pagina'    => $projetos->nextPageUrl()
//            ];
//        }else{
//echo 'ccc';die;
        return $institucional;

        //}



    }

    public function cms_object_attachments()
    {
        return $this->belongsToMany('\Iba\Models\Object', 'cms_object_attachments', 'fk_id')->withPivot('type');

    }

    public function translation()
    {
        return $this->hasMany('\Iba\Models\PageTranslation');
    }


    public function attachment()
    {
        return $this->hasMany('\Iba\Models\CmsObjectAttachment', 'fk_id'); //->withPivot('module');
    }

    public function images()
    {
        return $this->hasOne('\Iba\Models\PageImage');
    }
}
