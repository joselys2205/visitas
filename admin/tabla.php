<div id="listado<?php echo $consulta['ced_usu']; ?>" class="modal">
                            <div class="modal-content">
                                <nav>
                                    <div class="color-antv-1 nav-wrapper">
                                        <a class="brand-logo">Listado de Trabajadores</a>
                                    </div>
                                </nav>
                                <div class="row">
                                    <table class="highlight margin-table" id="Jtabla">
                                        <thead>
                                            <tr>
                                                <div class="controls">
                                                    <label class="checkbox">
                                                    <input name="checkbox" type="checkbox"> 
                                                </label>
                                                </div>
                                                <th>
                                                    <div class="controls">
                                                        <label class="checkbox">
                                                    <input name="checkbox" type="checkbox"> 
                                                </label>
                                                    </div>
                                                </th>
                                                <th>Nº</th>
                                                <th>Cedula</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $formulario_visitas1=mysql_query("SELECT * FROM personal");
                                            while ($consulta1=mysql_fetch_array($formulario_visitas1)){
                                            ?>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <?php echo $consulta1['ide_per']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $consulta1['ced_usu']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $consulta1['nom_per']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $consulta1['ape_per']; ?>
                                                    </td>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 