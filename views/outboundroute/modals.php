<!-- Modal Ayuda -->
<div class="modal fade" id="modalAyuda" tabindex="-1" role="dialog" aria-labelledby="modalAyudaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg mw-100 w-30" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAyudaLabel">Ayuda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Los patrones de marcación son las reglas de asociación que le permiten al sistema telefónico interpretar y asociar la numeración recibida con su respectivo grupo de reglas de marcación. En SETCRM, SETPBX, ROBODIALER y todos los productos de telefonía de SETCOLOMBIA SAS, estos patrones se roganizar de forma intuitiva en tres Secciones: "Anteponer", "Prefijo" y "Patrón".</p>
                <p><strong>Anteponer:</strong> Indica una cadena numérica que se anexará al número marcado antes de ser enrutado al destino, esta cadena numérica NO debe ser digitada por el usuario y será concatenada al inicio de forma automática por el sistema.</p>
                <p><strong>Prefijo:</strong> Indica una cadena numérica que el usuario u origen de la llamada debe enviar al marcar, pero que será eliminada automáticamente por el sistema antes de ser enviada al destino.</p>
                <p><strong>Patrón:</strong> Indica una cadena numérica que se asociará a la marcación para definir las reglas correctas de salida de llamadas. Los patrones debe seguir las siguientes reglas basadas en los patrones de marcación de Asterisk:</p>
                <h5>Reglas:</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>X</strong></td>
                            <td>Cualquier dígito de 0 a 9 (Solo uno)</td>
                        </tr>
                        <tr>
                            <td><strong>Z</strong></td>
                            <td>Cualquier dígito de 1 a 9 (Solo uno)</td>
                        </tr>
                        <tr>
                            <td><strong>N</strong></td>
                            <td>Cualquier dígito de 2 a 9 (Solo uno)</td>
                        </tr>
                        <tr>
                            <td><strong>[1 2 4 7-9] (Solo uno)</strong></td>
                            <td>Cualquier dígito o rango de los que se listan en los paréntesis cuadrados. Para el ejemplo: 1, 2, 4, 7, 8 y 9</td>
                        </tr>
                        <tr>
                            <td><strong>.</strong></td>
                            <td>Cualquier dígito y cualquier cantidad de dígitos-</td>
                        </tr>
                    </tbody>
                </table>
                <p><strong>Ejemplo: 60[124]NXXXXXX </strong>Asociaría números de 10 dígitos, iniciando por 601, 602 o 604, seguidos de un digito de 2 a 9 y seguidos de seis digitos de 0 a 9. (Fijos en Colombia unicamente para Cudinamarca, Valle y Antioquia).</p>
            </div>            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>