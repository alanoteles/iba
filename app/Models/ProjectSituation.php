<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;
use \DB;

class ProjectSituation extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name', 'locale'];
    protected $guarded = ['id'];

    protected $fillable = ['status'];

    public function translation()
    {
        return $this->hasMany('\Iba\Models\ProjectSituationTranslation');
    }


//    public static function project_situation($id = null)
//    {
//        $project_situation = ProjectSituation::where('locale', '=', 'pt_br')
//                            ->join('project_situation_translations',
//                            'project_situation_translations.project_situation_id', '=', 'project_situations.id')->get();
//
//        $query = 'select *
//                  from project_situations A,
//                       project_situation_translations B
//                  where A.id = B.project_situation_id
//                  and B.locale = \'pt_br\'';
//
//        $resultado = DB::select($query);
//        //echo '<pre>';print_r($project_situation);die;
//        return $resultado;
//    }
}
