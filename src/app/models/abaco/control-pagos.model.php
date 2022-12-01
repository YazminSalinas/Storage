<?php
    class ControlPagosModel extends BaseModel {
        protected $table = 'ControlPagos';
        protected $fields = '
            Id,
            ArchivoPago,
            Fecha
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
