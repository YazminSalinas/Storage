<?php
ini_set('memory_limit', '256M');

class ArchivosController extends BaseController {
    public function agregar() {
        $bucket = $this->getBody('bucket');
        $archivoBase64 = $this->getBody('base64');
        $rutaArchivo = $this->getBody('path');
        $nombreArchivo = $this->getBody('name');

        if( !$bucket ) {
            throw new ErrorsController('El nombre del bucket es requerido');
        }

        if( !$archivoBase64 ) {
            throw new ErrorsController('El archivo en base64 es requerido');
        }

        if( !$rutaArchivo ) {
            throw new ErrorsController('La ruta del archivo es requerida');
        }

        return $this->getDomain('archivos/archivos')->agregar( trim($bucket), trim($archivoBase64), trim($rutaArchivo), $nombreArchivo );
    }

    public function eliminar() {
        $bucket = $this->getBody('bucket');
        $rutaArchivo = $this->getBody('path');

        if( !$bucket ) {
            throw new ErrorsController('El nombre del bucket es requerido');
        }

        if( !$rutaArchivo ) {
            throw new ErrorsController('La ruta del archivo es requerida');
        }

        $this->getDomain('archivos/archivos')->eliminar( trim($bucket), trim($rutaArchivo) );
    }

    public function descargar() {
        $bucket = $this->getQuery('bucket');
        $rutaArchivo = $this->getQuery('path');

        if( !$bucket ) {
            throw new ErrorsController('El nombre del bucket es requerido');
        }

        if( !$rutaArchivo ) {
            throw new ErrorsController('La ruta del archivo es requerida');
        }

        $this->getDomain('archivos/archivos')->descargar( trim($bucket), trim($rutaArchivo) );
    }
}