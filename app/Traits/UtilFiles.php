<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 12/20/19
 * Time: 2:41 PM
 */

namespace Serbinario\Traits;


use Illuminate\Contracts\Filesystem\FileNotFoundException;
use PHPJasper\PHPJasper;

trait UtilFiles
{



    public function ImageStore($request, String $field, $nameFile = null)
    {

        // Define o valor default para a variável que contém o nome da imagem
        //dd($nameFile);
        // Verifica se informou o arquivo e se é válido
        if ($request->file($field) != null ){
            $file = $request->file($field);
            //dd($file);

            try {
                // File Details
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $tempPath = $file->getRealPath();
                $fileSize = $file->getSize();
                $mimeType = $file->getMimeType();

                if($nameFile){
                    $nameFile = "{$nameFile}";
                }else{
                    $name = uniqid(date('HisYmd'));
                    $nameFile = "{$name}.{$extension}";
                }

                $fileStatus = $file->move("storage",$nameFile);
                if ( $fileStatus ){
                    return $nameFile;
                }
            } catch (FileNotFoundException $e) {
                dd("Errro", $e);
            }
        }else{
            return $nameFile;
        }
    }

}