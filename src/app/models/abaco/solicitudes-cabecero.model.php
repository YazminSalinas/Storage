<?php
    class SolicitudesCabeceroModel extends BaseModel {
        protected $table = 'SolicitudesCabecero';
        protected $fields = '
            Id_Header,
            PDF1,
            PDF2,
            PDF3,
            FechaCreacion
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
