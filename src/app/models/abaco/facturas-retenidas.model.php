<?php
    class FacturasRetenidasModel extends BaseModel {
        protected $table = 'FacturasRetenidas';
        protected $fields = '
            ID,
            FacturaArchivo,
            FacturaArchivoXML,
            FechaOrden
        ';

        public function __construct() {
            parent::__construct('jde');
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
?>
