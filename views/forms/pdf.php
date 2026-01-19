<?php
    $mpdf=new mPDF('','LETTER',0,'',10,10,10,10,4,4,'P');
    $enLetras = NumeroALetras::convertir($invoice->totalValue, 'Pesos', 'Centavos');
    if($invoice->InvoiceUserCreate=='API'){
        $origen="Web";
    }else{
        $origen="Manual";
    }
    $html = '<!DOCTYPE html>
<html>
    <head>
        <title>Factura</title>
        <meta charset="UTF-8">
        <style>
            html {
                font-family: sans-serif;
                line-height: 1.15;
            }
            body {
                margin: 0;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
                font-size: 2rem;
                font-weight: 400;
                line-height: 1.5;
                color: #212529;
                text-align: left;
                background-color: #fff;
            }
            table {
                border-collapse: collapse;
            }

            th {
                text-align: inherit;
            }

            .table {
                width: 100%;
                max-width: 100%;
                /*margin-bottom: 1rem;*/
                background-color: transparent;
            }

            .table th,
            .table td {
                padding: 0.35rem;
                vertical-align: top;
                border-top: 0px solid #dee2e6;
            }

            .table thead th {
                vertical-align: bottom;
                border-bottom: 0px solid #dee2e6;
            }

            .table tbody + tbody {
                border-top: 0px solid #dee2e6;
            }

            .table .table {
                background-color: #fff;
            }

            .table-bordered {
                border: 2px solid #dee2e6;
            }

            .table-bordered th,
            .table-bordered td {
                border: 2px solid #dee2e6;
            }

            .table-bordered thead th,
            .table-bordered thead td {
                border-bottom-width: 2px;
            }

            .table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(0, 0, 0, 0.05);
            }
            #div_totales {
                float: right;
                padding-top: 20px;
                width: 20%;
                text-align: right;
            }
            #div_en_letras {
                float: left;
                padding-top: 20px;
                width: 70%;
                text-align: left;
                font-size: 1.5rem;
            }
            #company-name{
                color:#000;
                font-size: 10px;
            }
            #company-info{
                color:#000;
                font-size: 15px;
            }
        </style>
    </head>
    <body>
        <br>
        <table class="table">
            <tbody>
                <tr>
                    <td style="text-align: center; vertical-align: middle; width: 50%;">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;"><img
                                            src="https://sellercenter.setcolombia.com/ventas/pdfClass/pdfInv/examples/images/tellenzi.jpeg"
                                            alt="" style="width: 850px;"><br>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;"><b>CALZATURE TELLENZI S A S</b><br>
                                        NIT 901.105.680-9<br>
                                        Resolución DIAN Número Autorización
                                        18764002893430 aprobado en 20200824<br>
                                        Prefijo MP desde el número 20001 al 50000<br>
                                        FACTURA POR COMPUTADOR<br>
                                        Tel: (1) 2111653 - 3156120065 - 3204034175 - 3147664925<br>
                                        Calle 53 # 15-24 Local 203<br>
                                        Bogotá - Colombia<br>
                                        Actividad Económica 4791<br>
                                        Tarifa 11,04 x 1000</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 60%;">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: left; font-weight: bold;">Señores:</td>
                                                    <td style="text-align: left;">'.$invoice->firstName." ".$invoice->lastName." ".$invoice->fullName.'</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; font-weight: bold;">Dirección:</td>
                                                    <td style="text-align: left;">'.$invoice->address." ".$invoice->address2.'</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; font-weight: bold;">NIT/CC:</td>
                                                    <td style="text-align: left;">'.$invoice->identificationNumber."-".$invoice->checkDigit.'</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; font-weight: bold;">Teléfono:</td>
                                                    <td style="text-align: left;">'.$invoice->phone." ".$invoice->phone2.'</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; font-weight: bold;">Ciudad:</td>
                                                    <td style="text-align: left;">'.$invoice->nombre.", ".$invoice->nombreDepto.", ".$invoice->codigoPais.'.</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; font-weight: bold;">Correo:</td>
                                                    <td style="text-align: left;">'.$invoice->email.'</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td style="width: 15%;"><br>
                                    </td>
                                    <td>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td rowspan="1" colspan="2" style="height: 38px; font-weight: bold;">FACTURA<br>
                                                        Nº '.$invoice->prefix.$invoice->number.'<br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Fecha Factura:<br>
                                                    </td>
                                                    <td>Fecha Vencimiento:<br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>'.$invoice->date.'<br>
                                                    </td>
                                                    <td>'.$invoice->dueDate.'<br>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table style="width: 30%;" class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="text-align: center; font-weight: bold;">Vendedor</td>
                                    <td style="text-align: center; font-weight: bold;">Orden</td>
                                </tr>
                                <tr>
                                    <td style="width: 350px;">'.$invoice->commerce.'</td>
                                    <td style="width: 50%">'.$invoice->orderNumber.'</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="text-align: center; font-weight: bold;">Item</td>
                                    <td style="text-align: center; font-weight: bold;">Código</td>
                                    <td style="text-align: center; font-weight: bold;">Nombre producto</td>
                                    <td style="text-align: center; font-weight: bold;">Cantidad</td>
                                    <td style="text-align: center; font-weight: bold;">Vr. Bruto</td>
                                    <td style="text-align: center; font-weight: bold;">Impuesto</td>
                                    <td style="text-align: center; font-weight: bold;">Vr. Total</td>
                                </tr>';
                                
    foreach ($items as $key => $item) {
    $consecutive = $key+1;
    $totalItem = ($item->totalValue) * ($item->quantity);
    $html .=                     '<tr>
                                    <td>'.$consecutive.'</td>
                                    <td>'.$item->productCode.'</td>
                                    <td>'.$item->description.'</td>
                                    <td>'.$item->quantity.'</td>
                                    <td>$'.number_format($item->totalBase, '0', ',', '.').'</td>
                                    <td>$'.number_format($item->totalTax, '0', ',', '.').'</td>
                                    <td>$'.number_format($totalItem, '0', ',', '.').'</td>
                                </tr>';
    }
    
    $html .=                 '</tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <div id="div_en_letras" align="left">
            <table class="table" style="font-size: 10px;">
                <tr>
                    <td style="text-align: left; font-weight: bold;">Son (EN LETRAS):</td>
                </tr>
                <tr>
                    <td style="text-align: left;">'.$enLetras.' M/Cte</td>
                </tr>
                <tr>
                    <td style="text-align: left; font-weight: bold;">Condiciones de Pago:</td>
                </tr>
                <tr>
                    <td style="text-align: left;">'.$origen.' - '.$invoice->paymentMethod.' - Vence el '.$invoice->dueDate.' por $'.$invoice->totalValue.'</td>
                </tr>
            </table>
        </div>
        
        <div id="div_totales" align="right">
            <table class="table table-bordered" style="font-weight: bold;">
                <tr>
                    <td style="text-align: right;">SUBTOTAL:</td>
                    <td style="text-align: right;">$'.number_format($invoice->totalBase, '0', ',', '.').'</td>
                </tr>
                <tr>
                    <td style="text-align: right;">IVA 19%:</td>
                    <td style="text-align: right;">$'.number_format($invoice->totalTax, '0', ',', '.').'</td>
                </tr>
                <tr>
                    <td style="text-align: right;">TOTAL:</td>
                    <td style="text-align: right;">$'.number_format($invoice->totalValue, '0', ',', '.').'</td>
                </tr>
            </table>
        </div>
        
        <div style="bottom: 100; position: fixed;">
            <table class="table" style="font-size: 10px;">
                <tr align="justify">
                    <td><p style="text-align: justify; line-height: 1;"><b>Observaciones:</b><br/>'.$invoice->InvoiceObservations.'</p></td>
                </tr>
                <tr>
                    <td align="justify">
                        <p style="text-align: justify; line-height: 1; font-weight: bold;">LA PRESENTE FACTURA SE ASIMILA A UNA LETRA DE CAMBIO (ART 744 C. DE CO.) EL COMPRADOR ACEPTA Y DECLARA RECIBIDOS REAL Y MATERIALMENTE LOS BIENES Y SERVICIOS EN ELLA MENCIONADOS, SI ESTA FACTURA NO ES CANCELADA EN EL PLAZO ESTIPULADO CAUSARÁ INTERESES DE MORA, AL PORCENTAJE AUTORIZADO POR LA SUPER FINANCIERA.</p>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                    	<table style="border-bottom: 1px solid;">
                            <tr>
                                <td width="300" height="80" style="color: #F0F0F0; vertical-align: bottom; text-align: center;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Firma, Nombre y Sello&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
                            </tr>
                    	</table>
                        FIRMA Y SELLO DEL CLIENTE
                    </td>
                </tr>
            </table>
        </div>
       
        <div style="bottom: 0; position: fixed;" align="center">
            <table class="table">
                <tr>
                    <td id="company-info" style="text-align: center;">
                        <p style="font-size: 9px">
                            Calle 53 # 15-24 Local 203 - TELEFONOS: (1) 2111653 - 3156120065 - 3204034175 - 3147664925 - tellenzi.moda@hotmail.com - Bogotá - Colombia
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
';
    //$archivo = file_get_contents('views/invoices/modelo1.html'); // external css
    $mpdf->WriteHTML($html);

    //$mpdf->Output('./generadas/nombre'.time().'.pdf','F');
    $mpdf->Output('nombre'.time().'.pdf','I');
    exit;
?>
