<?php
ini_set('memory_limit', '512M');

class MigracionController extends BaseController {
    public function migrarAbaco( $pData ) {
        $carptaSistema = 'ABACO';

        if( !(isset( $pData['table'] ) && $pData['table']) ) {
            throw new ErrorsController('Debe enviar el nombre de la tabla');
        }
        return $this->getDomain('archivos/migracion')->migrar( $carptaSistema, $pData );
    }

    public function migrarRH( $pData ) {
        $carptaSistema = 'RH';

        if( !(isset( $pData['table'] ) && $pData['table']) ) {
            throw new ErrorsController('Debe enviar el nombre de la tabla');
        }
        return $this->getDomain('archivos/migracion')->migrar( $carptaSistema, $pData );
    }
}