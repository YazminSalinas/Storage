<?php
require_once _APP . '/components/file-manager.component.php';

class MigracionDomain extends BaseDomain {
    public function migrar( string $pCarpetaSistema, ?array $pData ) {
        $currentPage = isset($pData['page']) ? ($pData['page'] - 1) : 0;
        $pages = null;
        $table = $pData['table'];

        do {
            $now = (new DateTime())->format('Y-m-d H:i:s.u');
            $archivos = null;
            $fncGetOneFile = null;
            $fncUpdate = null;

            switch( $table ) {
                case 'Archivos_Compras_Nacionales':
                    $archivos = $this->getModel('abaco/archivos-compras-nacionales')->obtenerPaginado( ++$currentPage, 500, 'Id_Archivo', 'Id_Archivo AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'Archivo',
                        'fecha' => 'FechaAdjunto',
                        'ruta' => 'ArchivoRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/archivos-compras-nacionales')->getOne([
                            'Id_Archivo' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/archivos-compras-nacionales')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id_Archivo' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'ArchivosCompras':
                    $archivos = $this->getModel('abaco/archivos-compras')->obtenerPaginado( ++$currentPage, 500, 'Id_Archivo', 'Id_Archivo AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'Archivo',
                        'fecha' => 'FechaAdjunto',
                        'ruta' => 'ArchivoRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/archivos-compras')->getOne([
                            'Id_Archivo' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/archivos-compras')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id_Archivo' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'tblArchivos_SolicitudesExportacion':
                    $archivos = $this->getModel('abaco/tbl-archivos-solicitudes-exportacion')->obtenerPaginado( ++$currentPage, 500, 'Id_Archivo', 'Id_Archivo AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'Archivo',
                        'fecha' => 'FechaAdjunto',
                        'ruta' => 'ArchivoRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/tbl-archivos-solicitudes-exportacion')->getOne([
                            'Id_Archivo' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/tbl-archivos-solicitudes-exportacion')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id_Archivo' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'AnticiposNacionales':
                    $archivos = $this->getModel('abaco/anticipos-nacionales')->obtenerPaginado( ++$currentPage, 500, 'Id_AnticiposNacionales', 'Id_AnticiposNacionales AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'PagoAnticipo',
                        'fecha' => 'FechaSolicitada',
                        'ruta' => 'PagoAnticipoRuta'
                    ], [
                        'archivo' => 'AnticipoCargado',
                        'fecha' => 'FechaSolicitada',
                        'ruta' => 'PagoAnticipoRuta'
                    ], [
                        'archivo' => 'ReporteOrdenAnticipo',
                        'fecha' => 'FechaSolicitada',
                        'ruta' => 'ReporteOrdenAnticipoRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/anticipos-nacionales')->getOne([
                            'Id_AnticiposNacionales' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/anticipos-nacionales')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id_AnticiposNacionales' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'ProblemasCalidad':
                    $archivos = $this->getModel('abaco/problemas-calidad')->obtenerPaginado( ++$currentPage, 500, 'Id', 'Id AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'AccionCorrectiva',
                        'fecha' => 'FechaCreacionTicket',
                        'ruta' => 'AccionCorrectivaRuta'
                    ], [
                        'archivo' => 'NotaCredito',
                        'fecha' => 'FechaCreacionTicket',
                        'ruta' => 'NotaCreditoRuta'
                    ], [
                        'archivo' => 'RevisionCorrecta',
                        'fecha' => 'FechaCreacionTicket',
                        'ruta' => 'RevisionCorrectaRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/problemas-calidad')->getOne([
                            'Id' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/problemas-calidad')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'AnticiposOC':
                    $archivos = $this->getModel('abaco/anticipos-oc')->obtenerPaginado( ++$currentPage, 500, 'Id_Anticipo', 'Id_Anticipo AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'AnticipoCargado',
                        'fecha' => 'FechaSolicitada',
                        'ruta' => 'AnticipoCargadoRuta'
                    ], [
                        'archivo' => 'ComprobacionAnticipos',
                        'fecha' => 'FechaSolicitada',
                        'ruta' => 'ComprobacionAnticiposRuta'
                    ], [
                        'archivo' => 'PagoAnticipo',
                        'fecha' => 'FechaSolicitada',
                        'ruta' => 'PagoAnticipoRuta'
                    ], [
                        'archivo' => 'ReporteOrdenAnticipo',
                        'fecha' => 'FechaSolicitada',
                        'ruta' => 'ReporteOrdenAnticipoRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/anticipos-oc')->getOne([
                            'Id_Anticipo' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/anticipos-oc')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id_Anticipo' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'RecotizacionesProveedorAccionCorrectiva':
                    $archivos = $this->getModel('abaco/recotizaciones-proveedor-accion-correctiva')->obtenerPaginado( ++$currentPage, 500, 'ID', 'ID AS IdArchivo, Fecha AS FecRegistro' );
                    $camposArchivos = [[
                        'archivo' => 'Archivo',
                        'fecha' => 'Fecha',
                        'ruta' => 'ArchivoRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/recotizaciones-proveedor-accion-correctiva')->getOne([
                            'ID' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/recotizaciones-proveedor-accion-correctiva')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'ID' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'CartasAlmacenadas':
                    $archivos = $this->getModel('abaco/cartas-almacenadas')->obtenerPaginado( ++$currentPage, 500, 'Id_Carta', 'Id_Carta AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'Archivo',
                        'fecha' => null,
                        'ruta' => 'ArchivoRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/cartas-almacenadas')->getOne([
                            'Id_Carta' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/cartas-almacenadas')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id_Carta' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'FichasTecnicas':
                    $archivos = $this->getModel('abaco/fichas-tecnicas')->obtenerPaginado( ++$currentPage, 500, 'Id_Ficha', 'Id_Ficha AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'Imagen',
                        'fecha' => null,
                        'ruta' => 'ImagenRuta'
                    ], [
                        'archivo' => 'Plano',
                        'fecha' => null,
                        'ruta' => 'PlanoRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/fichas-tecnicas')->getOne([
                            'Id_Ficha' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/fichas-tecnicas')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id_Ficha' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'FichasTecnicasNuevosArticulos':
                    $archivos = $this->getModel('abaco/fichas-tecnicas-nuevos-articulos')->obtenerPaginado( ++$currentPage, 500, 'Id_Ficha', 'Id_Ficha AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'Imagen',
                        'fecha' => 'FechaRequerida',
                        'ruta' => 'ImagenRuta'
                    ], [
                        'archivo' => 'Plano',
                        'fecha' => 'FechaRequerida',
                        'ruta' => 'PlanoRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/fichas-tecnicas-nuevos-articulos')->getOne([
                            'Id_Ficha' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/fichas-tecnicas-nuevos-articulos')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id_Ficha' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'ArchivosMuestrasArticulosNuevos':
                    $archivos = $this->getModel('abaco/archivos-muestras-articulos-nuevos')->obtenerPaginado( ++$currentPage, 500, 'Id_Archivo', 'Id_Archivo AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'Archivo',
                        'fecha' => 'FechaAdjunto',
                        'ruta' => 'ArchivoRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/archivos-muestras-articulos-nuevos')->getOne([
                            'Id_Archivo' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/archivos-muestras-articulos-nuevos')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id_Archivo' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'ArchivosCotizacionesServicios':
                    $archivos = $this->getModel('abaco/archivos-cotizaciones-servicios')->obtenerPaginado(++$currentPage, 500, 'Id_Archivo', 'Id_Archivo AS IdArchivo', [
                        'idArchivo' => $pData['idArchivo'] ?? null
                    ]);
                    $camposArchivos = [[
                        'archivo' => 'Archivo',
                        'fecha' => 'FechaAdjunto',
                        'ruta' => 'ArchivoRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/archivos-cotizaciones-servicios')->getOne([
                            'Id_Archivo' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/archivos-cotizaciones-servicios', 'loginComprasDest')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id_Archivo' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'CotizacionesxRecotizacion':
                    $archivos = $this->getModel('abaco/cotizaciones-x-recotizacion')->obtenerPaginado( ++$currentPage, 500, 'ID', 'ID AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'Archivo',
                        'fecha' => 'FechaCreacion',
                        'ruta' => 'ArchivoRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/cotizaciones-x-recotizacion')->getOne([
                            'ID' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/cotizaciones-x-recotizacion')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'ID' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'CotejoAnticiposOrden':
                    $archivos = $this->getModel('abaco/cotejo-anticipos-orden')->obtenerPaginado( ++$currentPage, 500, 'Id', 'Id AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'ArchivoComprobante',
                        'fecha' => 'FechaComprobacion',
                        'ruta' => 'ArchivoComprobanteRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/cotejo-anticipos-orden')->getOne([
                            'Id' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/cotejo-anticipos-orden')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'SolicitudesAltaProveedores':
                    $archivos = $this->getModel('abaco/solicitudes-alta-proveedores')->obtenerPaginado( ++$currentPage, 500, 'Id', 'Id AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'ArchivoSolicitud',
                        'fecha' => 'FechaCreacion',
                        'ruta' => 'ArchivoSolicitudRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/solicitudes-alta-proveedores')->getOne([
                            'Id' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/solicitudes-alta-proveedores')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'SolicitudesCabecero':
                    $archivos = $this->getModel('abaco/solicitudes-cabecero')->obtenerPaginado( ++$currentPage, 500, 'Id_Header', 'Id_Header AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'PDF1',
                        'fecha' => 'FechaCreacion',
                        'ruta' => 'PDF1Ruta'
                    ], [
                        'archivo' => 'PDF2',
                        'fecha' => 'FechaCreacion',
                        'ruta' => 'PDF2Ruta'
                    ], [
                        'archivo' => 'PDF3',
                        'fecha' => 'FechaCreacion',
                        'ruta' => 'PDF3Ruta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/solicitudes-cabecero')->getOne([
                            'Id_Header' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/solicitudes-cabecero')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id_Header' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'FacturasRetenidas':
                    $archivos = $this->getModel('abaco/facturas-retenidas')->obtenerPaginado( ++$currentPage, 500, 'ID', 'ID AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'FacturaArchivo',
                        'fecha' => 'FechaOrden',
                        'ruta' => 'FacturaArchivoRuta'
                    ], [
                        'archivo' => 'FacturaArchivoXML',
                        'fecha' => 'FechaOrden',
                        'ruta' => 'FacturaArchivoXMLRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/facturas-retenidas')->getOne([
                            'ID' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/facturas-retenidas')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'ID' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'ControlPagos':
                    $archivos = $this->getModel('abaco/control-pagos')->obtenerPaginado( ++$currentPage, 500, 'Id', 'Id AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'ArchivoPago',
                        'fecha' => 'Fecha',
                        'ruta' => 'ArchivoPagoRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('abaco/control-pagos')->getOne([
                            'Id' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('abaco/control-pagos')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id' => $pIdArchivo
                        ]);
                    };
                    break;
                case 'Documentos_Capacitacion':
                    $archivos = $this->getModel('rh/documentos-capacitacion')->obtenerPaginado( ++$currentPage, 500, 'Id', 'Id AS IdArchivo' );
                    $camposArchivos = [[
                        'archivo' => 'archivo',
                        'fecha' => null,
                        'ruta' => 'archivoRuta'
                    ]];
                    $fncGetOneFile = function( int $pIdArchivo ) {
                        return $this->getModel('rh/documentos-capacitacion')->getOne([
                            'Id' => $pIdArchivo
                        ]);
                    };
                    $fncUpdate = function( int $pIdArchivo, string $pRutaArchivo, string $pCampoRuta ) {
                        $this->getModel('rh/documentos-capacitacion')->update([
                            $pCampoRuta => $pRutaArchivo
                        ], [
                            'Id' => $pIdArchivo
                        ]);
                    };
                    break;
            }

            $pages = $archivos['pages'];

            echo PHP_EOL . '[' . $now . '][' . $table . '] Page: ' . $currentPage . ' of ' . $pages . PHP_EOL;

            //Recorre todos los registros con archivos.
            foreach( $archivos['pageData'] as $idx => $archivo ) {
                $now = (new DateTime())->format('Y-m-d H:i:s.u');
                $idArchivo = $archivo['IdArchivo']; 
                $archivoData = $fncGetOneFile($idArchivo);
                
                foreach( $camposArchivos as $campoArchivo ) {
                    $nombreCampoArchivo = $campoArchivo['archivo'];
                    $nombreCampoFecha = $campoArchivo['fecha'];
                   
                    if( $archivoData[ $nombreCampoArchivo ] ) {
                        $archivoBase64 = base64_encode( $archivoData[ $nombreCampoArchivo ] );
                        $rutaArchivo = 'SIN_FECHA';

                        if( !is_null($nombreCampoFecha) && $archivoData[ $nombreCampoFecha ] ) {
                            $date = strtotime( $archivoData[ $nombreCampoFecha ] ? $archivoData[ $nombreCampoFecha ] : date('Ymd H:i:s') );
                            $year = (int)date('Y', $date);
                            $month = (int)date('m', $date);

                            $rutaArchivo = $year . '/' . $month;
                        }

                        try {
                            $fileData = $this->getDomain('archivos/archivos')->agregar( 'abaco', $archivoBase64, $pCarpetaSistema . '/' . $rutaArchivo, md5( $table . '_' . $nombreCampoArchivo . '_' . $idArchivo ) );

                            if( !is_null($fncUpdate) ) {
                                $fncUpdate( 
                                    $idArchivo, 
                                    $fileData['path'] . '/' . $fileData['name'] . ( $fileData['ext'] ? '.' . $fileData['ext'] : $fileData['ext'] ), 
                                    $campoArchivo['ruta'] 
                                );
                            }
                        } catch( Exception $e ) {}
                    }
                }

                echo PHP_EOL . '[' . $now . '][' . $table . '] ' . $currentPage . '/' . $pages . '-' . ($idx+1) .  ' File ' . $idArchivo . ' downloaded' . PHP_EOL;
            }

            DBAccess::commit();
        } while( $currentPage < $pages );
    }
}