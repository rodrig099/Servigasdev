<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acta de Entrega</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #000;
        }

        .header,
        .section,
        .footer {
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .header {
            border-bottom: 3px solid #000;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            background-color: #e3f2fd; /* Fondo azul claro */
            padding: 10px; /* Espaciado adicional */
        }

        .header .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #0056b3;
        }

        .header .acta-num {
            text-align: right;
            font-weight: bold;
        }

        .header .sub-title {
            text-align: center;
            color: #0056b3;
            font-size: 12px;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .checkbox-container label {
            margin-right: 15px;
        }

        .form-check-input:checked {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .footer {
            border-top: 3px solid #000;
            padding-top: 10px;
            text-align: center;
        }

        .section {
            border: 1px solid #000;
            padding: 10px;
            border-radius: 5px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #000 !important;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header d-flex justify-content-between align-items-center">
            <img src="logo.png" alt="Logo" style="width: 100px;">
            <div class="title">SERVIGAS del Huila</div>
            <div class="acta-num">ACTA N°</div>
        </div>
        <div class="sub-title text-center">Rodrigo González Rodríguez <br> Regente SLC 788 ENIT 73612845 <br> ACTA DE ENTREGA DE INSTALACIONES PARA SUMINISTRO DE GAS <br> FORMATO PARA INSTALACIONES TIPO RESIDENCIAL Y COMERCIAL</div>

        <div class="section mt-4">
            <div class="section-title">INFORMACIÓN DEL USUARIO</div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="nombre_usuario">Nombre</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control">
                </div>
                <div class="col-md-2 mb-3">
                    <label for="cc_usuario">C.C.</label>
                    <input type="text" id="cc_usuario" name="cc_usuario" class="form-control">
                </div>
                <div class="col-md-2 mb-3">
                    <label for="tel_usuario">Tel.</label>
                    <input type="text" id="tel_usuario" name="tel_usuario" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="direccion_usuario">Dirección</label>
                    <input type="text" id="direccion_usuario" name="direccion_usuario" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="barrio_usuario">Barrio</label>
                    <input type="text" id="barrio_usuario" name="barrio_usuario" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="municipio_usuario">Municipio</label>
                    <input type="text" id="municipio_usuario" name="municipio_usuario" class="form-control">
                </div>
                <div class="col-md-2 mb-3">
                    <label for="depto_usuario">Depto.</label>
                    <input type="text" id="depto_usuario" name="depto_usuario" class="form-control">
                </div>
            </div>
        </div>

        <div class="section mt-4">
            <div class="section-title">INFORMACIÓN DEL INSTALADOR</div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="nombre_instalador">Nombre</label>
                    <input type="text" id="nombre_instalador" name="nombre_instalador" class="form-control" value="Rodrigo González Rodríguez">
                </div>
                <div class="col-md-2 mb-3">
                    <label for="cc_instalador">C.C.</label>
                    <input type="text" id="cc_instalador" name="cc_instalador" class="form-control" value="7.232.125">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="codigo_instalador">Código</label>
                    <input type="text" id="codigo_instalador" name="codigo_instalador" class="form-control" value="MLF-ID 3464">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="expedido_por">Expedido Por</label>
                    <input type="text" id="expedido_por" name="expedido_por" class="form-control" value="MLF COLOMBIA SAS">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="vigencia_instalador">Vigencia</label>
                    <input type="date" id="vigencia_instalador" name="vigencia_instalador" class="form-control" value="2025-08-19">
                </div>
            </div>
        </div>

        <div class="section mt-4">
            <div class="section-title">TIPO DE SERVICIO</div>
            <div class="checkbox-container">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="servicio_residencial" value="residencial">
                    <label class="form-check-label" for="servicio_residencial">Residencial</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="servicio_comercial" value="comercial">
                    <label class="form-check-label" for="servicio_comercial">Comercial</label>
                </div>
            </div>

            <div class="section-title">TIPO DE TUBERÍA</div>
            <div class="checkbox-container">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="tuberia_pe_al_pe" value="pe-al-pe">
                    <label class="form-check-label" for="tuberia_pe_al_pe">PE-AL-PE</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="tuberia_cobre" value="cobre">
                    <label class="form-check-label" for="tuberia_cobre">Cobre</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="tuberia_galvanizado" value="galvanizado">
                    <label class="form-check-label" for="tuberia_galvanizado">Galvanizado</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="tuberia_polietileno" value="polietileno">
                    <label class="form-check-label" for="tuberia_polietileno">Polietileno</label>
                </div>
            </div>
        </div>

        <div class="section mt-4">
            <div class="section-title">PRUEBA ISOMÉTRICA</div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="hora_inicio">Hora Inicio</label>
                    <input type="time" id="hora_inicio" name="hora_inicio" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="hora_finalizacion">Hora Finalización</label>
                    <input type="time" id="hora_finalizacion" name="hora_finalizacion" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="presion_prueba">Presión de Prueba</label>
                    <input type="text" id="presion_prueba" name="presion_prueba" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="resultado_prueba">Resultado</label>
                    <select id="resultado_prueba" name="resultado_prueba" class="form-select">
                        <option value="positivo">Positivo</option>
                        <option value="negativo">Negativo</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="fecha_prueba">Fecha de Prueba</label>
                    <input type="date" id="fecha_prueba" name="fecha_prueba" class="form-control">
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="row">
                <div class="col-md-6 text-center">
                    <label for="firma_usuario">Firma del Usuario</label>
                    <br>
                    <input type="text" id="firma_usuario" name="firma_usuario" class="form-control" style="display: inline-block; width: 200px;">
                </div>
                <div class="col-md-6 text-center">
                    <label for="firma_instalador">Firma del Instalador</label>
                    <br>
                    <input type="text" id="firma_instalador" name="firma_instalador" class="form-control" style="display: inline-block; width: 200px;">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
