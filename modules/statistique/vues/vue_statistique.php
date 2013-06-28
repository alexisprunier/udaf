<?php
/**
 * @file      vue_statistiques.php
 * @author    Alexis PRUNIER
 * @version   1.0
 * @date      16 Avril 2013
 */
?>
<div id="champs_recherche" class="recherche">
    <h3>Légende</h3>
    <form method="GET" action="accueil.php?module=recherche&action=rechercher_dossier">
        <div id="col1" class="col">
            1. Alimentation-Agriculture</br>
            2. Assurance</br>
            3. Automobile-Transport</br>
            4. Banque-Argent</br>
        </div>

        <div id="col2" class="col">
            5. Commerce</br>
            6. Consumérisme</br>
            7. Droit-Justice</br>
            8. Economie</br>
        </div>

        <div id="col3" class="col" >
            9. Education-Société</br>
            10. Energie(Electricité-Gaz)</br>
            11. Environnement-Dévelopement durable</br>
            12. Internet-Image-Son</br>
        </div>

        <div id="col4" class="col">
            13. Logement-Immobilier</br>
            14. Loisir-Tourisme</br>
            15. Santé</br>
            16. Sécurité domestique</br>
        </div>
    </form>
</div>
<div id="tab_stats">
    <a class="btn" href="libs/excel/export/statistiques.xlsx">Exporter au format Excel</a>
    <table class="scroll_tab">
        <thead>
            <tr class="head_tab">
                <th  align="center">ID</th>
                <th  align="center">Date</th>
                <th  align="center">Date clôture</th>
                <th  align="center">RV</th>
                <th  align="center">Tel</th>
                <th  align="center">Mail</th>
                <th  align="center">Courrier</th>
                <th  align="center">1</th>
                <th  align="center">2</th>
                <th  align="center">3</th>
                <th  align="center">4</th>
                <th  align="center">5</th>
                <th  align="center">6</th>
                <th  align="center">7</th>
                <th  align="center">8</th>
                <th  align="center">9</th>
                <th  align="center">10</th>
                <th  align="center">11</th>
                <th  align="center">12</th>
                <th  align="center">13</th>
                <th  align="center">14</th>
                <th  align="center">15</th>
                <th  align="center">16</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            for ( $i=0 ; $i<count($tableau) ; $i++ ) {
                $ligne = $tableau[$i];
            ?>
                <tr>
                    <td  class="cell_result" align="center"><?php echo ($ligne['dossier_id']!=null ? $ligne['dossier_id'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['date_crea']!=null ? $ligne['date_crea'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['date_clot']!=null ? $ligne['date_clot'] : '' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['Rendez-vous']!=null ? $ligne['Rendez-vous'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['Téléphone']!=null ? $ligne['Téléphone'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['Mail']!=null ? $ligne['Mail'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['Courrier']!=null ? $ligne['Courrier'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['1']!=null ? $ligne['1'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['2']!=null ? $ligne['2'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['3']!=null ? $ligne['3'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['4']!=null ? $ligne['4'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['5']!=null ? $ligne['5'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['6']!=null ? $ligne['6'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['7']!=null ? $ligne['7'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['8']!=null ? $ligne['8'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['9']!=null ? $ligne['9'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['10']!=null ? $ligne['10'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['11']!=null ? $ligne['11'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['12']!=null ? $ligne['12'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['13']!=null ? $ligne['13'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['14']!=null ? $ligne['14'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['15']!=null ? $ligne['15'] : '0' ); ?></td>
                    <td  class="cell_result" align="center"><?php echo ($ligne['16']!=null ? $ligne['16'] : '0' ); ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>