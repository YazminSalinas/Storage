<?php
    class CotejoAnticiposOrdenModel extends BaseModel {
        protected $table = 'CotejoAnticiposOrden';
        protected $fields = '
            Id,
            ArchivoComprobante,
            FechaComprobacion
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
?>
