<?php
/**
 * @Author: Albert
 * @Date:   2022-04-06 03:17:52
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-06 03:44:10
 */
?>

<script id="table_template" type="text/x-jsrender">
<table id="guilds" class="">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Preferencias</th>
            <th>Actividad</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</script>

<script id="row_template" type="text/x-jsrender">
<tr><td>{{:name}}</td><td>{{:preferences}}</td><td>{{:activity}}</td></tr>
</script>