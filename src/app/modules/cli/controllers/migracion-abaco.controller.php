<?php
ini_set('memory_limit', '512M');

class MigracionAbacoController extends BaseController {
    const CARPETA_SISTEMA = 'ABACO';

    public function migrar( $pData ) {
        if( !(isset( $pData['table'] ) && $pData['table']) ) {
            throw new Exception('Debe enviar el nombre de la tabla');
        }
        return $this->getDomain('archivos/migracion')->migrar( self::CARPETA_SISTEMA, $pData );
    }
}