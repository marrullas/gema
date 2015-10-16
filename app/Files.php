<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Files extends Model
{

    protected $fillable = [
        'id',
        //'tarea_id',
        'mime', //tipo de archivo que se sube
        'filename',
        'size',
        'storage_path',
        'status',
        'descripcion',
        'prefijo',
        'codigo',
        'user_id',
        'tipodocumento_id',
        'ambitosxciclo_id',
        'revisado',
        'auditor'


    ];
/*    public function tarea()
    {
        return $this->belongsTo('\App\Tarea');
    }*/
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
    public function tipodocumento()
    {
        return $this->belongsTo('\App\Tipodocumento','tipodocumento_id','id');
    }
    //filtro para seleccionar los archivos que pertenecen a una actividad
    public function scopeFilesactividad($query)
    {
        return $query->where('prefijo','=','AC');
    }
    /**
     * Funcion para eliminar los archivos que pertenecen a una tarea
     * @param $tarea
     */
    public static function destroyxtarea($tarea)
    {
        //

        $files = Files::where('tarea_id','=',$tarea)
            ->get();
        if($files->count() > 0) {
            foreach($files as $file){
                if (File::exists($file->storage_path)) {
                    File::delete($file->storage_path);
                }
            }
        }
    }

    /**
     * Funcion para eliminar los archivos que pertenecen a as tareas de una lists
     * @param $tarea
     */
    public static function destroyxlista($lista)
    {
        //

        $files = Files::where('tarea_id', '=', $tarea)
            ->get();
        if ($files->count() > 0) {
            foreach ($files as $file) {
                if (File::exists($file->storage_path)) {
                    File::delete($file->storage_path);
                }
            }
        }
    }
}
