<?php
class ArchivosCotizacionesServiciosModel extends BaseModel {
    protected $table = 'Archivos_Cotizaciones_Servicios';
    protected $fields = '
        Id_Archivo,
        Archivo,
        FechaAdjunto
    ';

    public function __construct( ?string $pIdConnection = null ) {
        parent::__construct( is_null($pIdConnection) ? 'loginCompras' : $pIdConnection );
    }

    public function obtenerPaginado( int $pPage, int $pRows, string $pOrderBy, ?string $pSlt = null, array $pFiltros ) {
        return $this->connection
            ->select($pSlt ?? '*')
            ->from($this->table)
            ->where('id_Archivo')->eq('idArchivo')
            ->exec([
                '_paginate' => true,
                '_page' => $pPage,
                '_rows' => $pRows,
                '_orderBy' => $pOrderBy,
                'idArchivo' => $pFiltros['idArchivo'] ?? null
            ]);
    }
}