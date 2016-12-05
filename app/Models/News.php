<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use PDO;

class News extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['title', 'featured_title', 'source', 'content_data', 'locale'];
    protected $guarded = ['id'];

    protected $fillable = ['status', 'date', 'news_editorial_id'];


//    public function news_translation()
//    {
//        return $this->hasMany('\Iba\Models\NewsTranslation');
//    }


    public function translation()
    {
        return $this->hasMany('\Iba\Models\NewsTranslation');
    }

    public function images()
    {
        return $this->hasOne('\Iba\Models\NewsImage');
    }


    public function news_editorial()
    {
        return $this->belongsTo('\Iba\Models\NewsEditorial');
    }


    public function news_attachment()
    {
        return $this->hasMany('\Iba\Models\CmsObjectAttachment', 'fk_id'); //->withPivot('module');
    }
    public function cms_highlights()
    {
        return $this->hasMany('\Iba\Models\CmsHighlight', 'record_id');
    }


    public function cms_object_attachments()
    {
        return $this->belongsToMany('\Iba\Models\Object', 'cms_object_attachments', 'fk_id')->withPivot('type');

    }



    public function news_tags()
    {
        return $this->belongsToMany('\Iba\Models\Tag', 'news_tags', 'news_id', 'tag_id');
    }

    public static function busca($request, $termo, $itens_por_pagina){

        $query_noticias = 'select DISTINCT(A.id)
                            from news A,
                                news_translations B,
                                news_editorials C,
                                news_editorial_translations D
                            where A.id = B.news_id
                            and   C.id = A.news_editorial_id
                            and   B.locale = \''. app()->getLocale() . '\'
                            and A.status = \'1\'
                            and C.status = \'1\'
                            and (   B.title             LIKE \'%'   . $termo . '%\'
                             or	B.featured_title    LIKE \'%'   . $termo . '%\'
                             or	B.source            LIKE \'%'   . $termo . '%\'
                             or	B.content_data      LIKE \'%'   . $termo . '%\'
                             or	D.name              LIKE \'%'   . $termo . '%\'
                            )
                      ';

        $resultado_noticias         = DB::select($query_noticias);
        $id_noticias = array();
        foreach($resultado_noticias as $r){
            $id_noticias[] = $r->id;
        }
        $noticias = News::whereIn('id', $id_noticias)->paginate($itens_por_pagina);

//
//        if($request->ajax()){
////echo 'vvv';die;
//            return [
//                'resultados'      => view('includes.ajax_projetos')->with(compact('projetos'))->render(),
//                'proxima_pagina'    => $projetos->nextPageUrl()
//            ];
//        }else{
//echo 'ccc';die;
        return $noticias;

        //}



    }
}
