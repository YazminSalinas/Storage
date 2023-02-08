<?php
    class DocumentosCapacitacionModel extends BaseModel {
        protected $table = 'Documentos_Capacitacion';
        protected $fields = '
            Id,
            archivo
        ';

        public function __construct() {
            parent::__construct('rh');
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