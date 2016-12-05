<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use PDO;

class Object extends Model
{

    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['title', 'preamble', 'source', 'locale'];
    protected $guarded = ['id'];

    protected $fillable = ['issn','starred','faved','shared','access_count','active','allow_seals','allow_collab',
    'public','license_id','type_id','filetype_id','thread_id','topic_id','subtopic_id','banner_id','created_by'];


    public function thread()
    {
        return $this->belongsTo('\Iba\Models\Thread');
    }


    public function topic()
    {
        return $this->belongsTo('\Iba\Models\Topic');
    }

    public function subtopic()
    {
        return $this->belongsTo('\Iba\Models\Topic', 'subtopic_id');
    }


    public function attachment()
    {
        return $this->belongsToMany('\Iba\Models\Attachment');
    }


//    public function object_author()
//    {
//        return $this->hasMany('\Iba\Models\ObjectAuthor');
//    }


    public function object_author()
    {
        return $this->belongsToMany('\Iba\Models\Author', 'object_authors', 'object_id', 'author_id' )->withPivot('created_by');

    }


    public function attachment_object()
    {
        return $this->belongsToMany('\Iba\Models\Attachment', 'attachment_object', 'object_id', 'attachment_id')->withPivot('created_by');

    }


    public function object_certification()
    {
        return $this->hasMany('\Iba\Models\ObjectCertification');
    }


    public function object_discussion()
    {
        return $this->hasOne('\Iba\Models\ObjectDiscussion');
    }


    public function object_faved()
    {
        return $this->hasMany('\Iba\Models\ObjectFaved');
    }


    public function object_levels()
    {
        return $this->belongsToMany('\Iba\Models\Level', 'object_levels');
    }


    public function object_objectives()
    {
        return $this->hasMany('\Iba\Models\ObjectObjective');
    }


    public function object_objects()
    {
        return $this->hasMany('\Iba\Models\ObjectObject');
    }


    public function object_summaries()
    {
        return $this->hasMany('\Iba\Models\ObjectSummary');
    }


    public function object_tags()
    {
        //return $this->hasMany('\Iba\Models\ObjectTag');
        return $this->belongsToMany('\Iba\Models\Tag', 'object_tags', 'object_id', 'tag_id');
    }


    public function object_translation()
    {
        return $this->hasMany('\Iba\Models\ObjectTranslation');
    }

    public function translation()
    {
        return $this->hasMany('\Iba\Models\ObjectTranslation');
    }



    public function images()
    {
        return $this->hasOne('\Iba\Models\ObjectImage');
    }


    public function object_cms_attachment()
    {
        return $this->hasMany('\Iba\Models\CmsObjectAttachment');
    }


    public static function busca($request, $termo, $itens_por_pagina = 5){

        $params = $request->all();

//        echo '<pre>';
//        print_r($params);die;

        $query_biblioteca = 'select DISTINCT(A.id)
                        from objects A,
                            object_translations B,
                            threads C,
                            thread_translations D,
                            topics E,
                            topic_translations F,
                            types G,
                            type_translations H
                        where A.id = B.object_id
                        and   B.locale = \''. app()->getLocale() . '\'
                        and   C.id = A.thread_id
                        and   C.id = D.thread_id
                        and   E.id = A.topic_id
                        and   F.locale = \''. app()->getLocale() . '\'
                        and   E.id = F.topic_id

                        and A.active = \'1\'
                        and (   B.title     LIKE \'%'   . $termo . '%\'
                            or	B.preamble  LIKE \'%'   . $termo . '%\'
                            or	B.source    LIKE \'%'   . $termo . '%\'
                            )
                  ';

        $resultado_biblioteca       = DB::select($query_biblioteca);
        $id_biblioteca = array();
        foreach($resultado_biblioteca as $r){
            $id_biblioteca[] = $r->id;
        }
        $biblioteca = Object::whereIn('id', $id_biblioteca)->orderBy('date', 'desc')->paginate($itens_por_pagina);

//
//        if($request->ajax()){
////echo 'vvv';die;
//            return [
//                'resultados'      => view('includes.ajax_projetos')->with(compact('projetos'))->render(),
//                'proxima_pagina'    => $projetos->nextPageUrl()
//            ];
//        }else{
//echo 'ccc';die;
        return $biblioteca;

        //}



    }
}
