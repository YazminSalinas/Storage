<?php
require_once _APP . '/components/file-manager.component.php';

class ArchivosDomain extends BaseDomain {
    public function obtenerRutaBucket( string $pBucket ) {
        $rutaDisco = $this->getConfig('buckets')[$pBucket] ?? null;
        
        if( is_null($rutaDisco) ) {
            throw new Exception('No existe una configuración para este bucket (' . $pBucket . ')');
        }

        return _ROOT . '/' . $rutaDisco;
    }

    public function agregar( string $pBucket, string $pArchivoBase64, string $pRutaArchivo, ?string $pNombreArchivo ) {
        $rutaDisco = $this->obtenerRutaBucket($pBucket);
        $nombreArchivo = $pNombreArchivo ? $pNombreArchivo : md5( uniqid($pRutaArchivo) );
        $fileData = FileManagerComponent::decodeBase64File( $pArchivoBase64 );

        if( count($fileData['extensions']) === 0 ) {
            throw new Exception('No se pudo encontrar una extensión válida para este archivo (' . $fileData['mimeType'] . ')');
        }

        $fileExt = $fileData['extensions'][0];
        $file = FileManagerComponent::saveBase64File( $rutaDisco . '/' . $pRutaArchivo, $nombreArchivo, $fileExt, $fileData['content'] );

        if( $file['size'] === 0 ) {
            throw new Exception('El archivo que intenta subir se encuentra vacío');
        }

        return [
            'bucket' => $pBucket,
            'path' => $pRutaArchivo,
            'name' => $nombreArchivo,
            'ext' => $fileExt,
            'size' => $file['size']
        ];
    }

    public function eliminar( string $pBucket, string $pRutaArchivo ) {
        $rutaDisco = $this->obtenerRutaBucket($pBucket);

        if( FileManagerComponent::deleteFile( $rutaDisco . '/' . $pRutaArchivo ) === false ) {
            throw new ErrorsNotFound('El archivo no existe');
        }
    }

    public function descargar( string $pBucket, string $pRutaArchivo ) {
        $rutaDisco = $this->obtenerRutaBucket($pBucket);
        $nombreArchivo = explode( '/', $pRutaArchivo );
        $nombreArchivo = array_pop( $nombreArchivo );
        $rutaArchivo = str_replace( '/' . $nombreArchivo, '', $pRutaArchivo );
        $response = FileManagerComponent::renderFile( $nombreArchivo, $rutaDisco . '/' . $rutaArchivo . '/' . $nombreArchivo );

        if( $response === false ) {
            throw new ErrorsNotFound('El archivo que intenta descargar no existe');
        }
    }
}