<?php
class ArchivosComprasModel extends BaseModel {
    protected $table = 'ArchivosCompras';
    protected $fields = '
        Id_Archivo,
        Archivo,
        FechaAdjunto
    ';

    public function __construct() {
        parent::__construct('loginCompras');
    }

    public function obtenerPaginado( int $pPage, int $pRows, string $pOrderBy, ?string $pSlt = null ) {
        return $this->connection
            ->select($pSlt ?? '*')
            ->from($this->table)
            ->exec([
                '_paginate' => true,
                '_page' => $pPage,
                '_rows' => $pRows,
                '_orderBy' => $pOrderBy
            ]);
    }
}
