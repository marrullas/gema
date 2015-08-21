<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Files extends Model
{

    protected $fillable = [
        'id',
        'tarea_id',
        'mime', //tipo de archivo que se sube
        'filename',
        'size',
        'storage_path',
        'status',
        'descripcion'
    ];
    public function tarea()
    {
        return $this->belongsTo('\App\Tarea');
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
