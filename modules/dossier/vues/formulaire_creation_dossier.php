﻿<?php
/**
 * @file      formulaire_creation_client.php
 * @author    Jocelyn SIMON
 * @version   1.0
 * @date      30 janvier 2013
 * @brief     Definit l'IHM de la page d'ajout d'un client.
 */
print_r($_POST["commentaire_event"]);
?>

<script type="text/javascript">

    $(document).ready( function () {
        
        $("a#click_modifier_event").click(function(e){
            e.preventDefault();
            window.location.href = $(this).attr("href");
        });
        
        
        var theHREF;
        
        $( "#dialog-confirm-dossier" ).dialog({
            resizable: false,
            height:200,
            width:500,
            autoOpen: false,
            modal: true,
            buttons: {
                "Oui": function() {
                    $( this ).dialog( "close" );
                    window.location.href = theHREF;
                },
                "Annuler": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        $( "#dialog_dossier_cree" ).dialog({
                                modal: true,
                                buttons: {
                                  Ok: function() {
                                    $( this ).dialog( "close" );
                                  }
                                }
                              });
        
        $("a.supprimer_ligne").click(function(e) {
            e.preventDefault();
            theHREF = $(this).attr("href");
            $("#dialog-confirm-dossier").dialog("open");
        });
      $(".check_rdv").change(function(){
        var val = $(this).is(":checked");       
        var eventId = $(this).attr("id");
        var request = $.ajax({
          url: "accueil.php?module=dossier&action=creer_dossier",
          type: "GET",
          data: {traite : val, id_event : eventId},
          dataType: "html"
        });
      

        request.done(function(msg) {
          alert("Événement mis a jour.");         
        });
 
        request.fail(function(jqXHR, textStatus) {
          alert( "Erreur de la requete Ajax " + textStatus );
        });
                        
        });
        
        
        $("#form_creer_dossier").submit(function(){
            if(!(($("#nom_f").val()!="" && $("#prenom_f").val()!="") || $("#raison_sociale_f").val()!=""))  {
                alert("Le nom et le prenom du fournisseur ou sa raison sociale doit être rempli");
                $("#nom_f, #prenom_f, #raison_sociale_f").css("border","1px solid #aa0000");
                $("#nom_f, #prenom_f, #raison_sociale_f").css("box-shadow","0px 0px 5px 1px #ff0000");
                return(false);
            }
            return(true);
        });

    });
                        
        
   //Préparation des données
    
    personnes = <?php  echo json_encode($tab_personne) ?>;
    fournisseurs = <?php echo json_encode($tab_fournisseur) ?>;
    soustheme = <?php echo json_encode($tab_sstheme) ?>;
    
     function changeSousTheme(selectedInd) {
        var form1 = document.getElementById("form_creer_dossier");
        document.form_creer_dossier.soustheme.options.length = 0;
        y = 0;
        for (var i = 0; i < soustheme.length; i++) {
            if (soustheme[i].theme_id == parseInt(selectedInd) + 1) {
                form1.soustheme.options[y] = new Option(soustheme[i].nom, soustheme[i].soustheme_id);
                y++;
            }
        }
    }
    
    function changePersonne(selectedInd) {
        selectedInd = selectedInd - 1;
        window.document.getElementById("nom").value = personnes[selectedInd].nom;
        window.document.getElementById("prenom").value = personnes[selectedInd].prenom;
        window.document.getElementById("adresse").value = personnes[selectedInd].adr_postale;
        window.document.getElementById("codepostal").value = personnes[selectedInd].code_postal;
        window.document.getElementById("ville").value = personnes[selectedInd].ville;
        window.document.getElementById("mail").value = personnes[selectedInd].mail;
        window.document.getElementById("telephone").value = personnes[selectedInd].tel_fixe;
        window.document.getElementById("mobile").value = personnes[selectedInd].tel_port;
        if (personnes[selectedInd].sexe == 1) {
            document.getElementById("mr").checked = "checked";
        } else {
            document.getElementById("mme").checked = "checked";
        }
    }
    function changeFournisseur(selectedInd) {
        selectedInd = selectedInd - 1;
        window.document.getElementById("nom_f").value = fournisseurs[selectedInd].nom;
        window.document.getElementById("prenom_f").value = fournisseurs[selectedInd].prenom;
        window.document.getElementById("raison_sociale_f").value = fournisseurs[selectedInd].raison_sociale;
        window.document.getElementById("adresse_f").value = fournisseurs[selectedInd].adr_postale;
        window.document.getElementById("codepostal_f").value = fournisseurs[selectedInd].code_postal;
        window.document.getElementById("ville_f").value = fournisseurs[selectedInd].ville;
        window.document.getElementById("mail_f").value = fournisseurs[selectedInd].mail;
        window.document.getElementById("telephone_f").value = fournisseurs[selectedInd].tel;
        window.document.getElementById("commentaire_f").value = fournisseurs[selectedInd].comment_fournisseur;
    }
    function save_fields(lien) {
        if (document.getElementById('mr').checked == true || document.getElementById('mme').checked == true) {
            if ( document.getElementById('mr').checked == true ){
                document.cookie = "sexe=" + '0';
            }else{
                document.cookie = "sexe=" + '1';
            }
        } else {
            document.cookie = "sexe=";
        }
        if (document.getElementById('nom').value != null) {
            document.cookie = "nom=" + document.getElementById('nom').value;
        } else {
            document.cookie = "nom=";
        }
        if (document.getElementById('prenom').value != null) {
            document.cookie = "prenom=" + document.getElementById('prenom').value;
        } else {
            document.cookie = "prenom=";
        }
        if (document.getElementById('adresse').value != null) {
            document.cookie = "adresse=" + document.getElementById('adresse').value;
        } else {
            document.cookie = "adresse=";
        }
        if (document.getElementById('codepostal').value != null) {
            document.cookie = "codepostal=" + document.getElementById('codepostal').value;
        } else {
            document.cookie = "codepostal=";
        }
        if (document.getElementById('ville').value != null) {
            document.cookie = "ville=" + document.getElementById('ville').value;
        } else {
            document.cookie = "ville=";
        }
        if (document.getElementById('mail').value != null) {
            document.cookie = "mail=" + document.getElementById('mail').value;
        } else {
            document.cookie = "mail=";
        }
        if (document.getElementById('telephone').value != null) {
            document.cookie = "telephone=" + document.getElementById('telephone').value;
        } else {
            document.cookie = "telephone=";
        }
        if (document.getElementById('mobile').value != null) {
            document.cookie = "mobile=" + document.getElementById('mobile').value;
        } else {
            document.cookie = "mobile=";
        }
        if (document.getElementById('nom_f').value != null) {
            document.cookie = "nom_f=" + document.getElementById('nom_f').value;
        } else {
            document.cookie = "nom_f=";
        }
        if (document.getElementById('prenom_f').value != null) {
            document.cookie = "prenom_f=" + document.getElementById('prenom_f').value;
        } else {
            document.cookie = "prenom_f=";
        }
        if (document.getElementById('raison_sociale_f').value != null) {
            document.cookie = "raison_sociale_f=" + document.getElementById('raison_sociale_f').value;
        } else {
            document.cookie = "raison_sociale_f=";
        }
        if (document.getElementById('adresse_f').value != null) {
            document.cookie = "adresse_f=" + document.getElementById('adresse_f').value;
        } else {
            document.cookie = "adresse_f=";
        }
        if (document.getElementById('codepostal_f').value != null) {
            document.cookie = "codepostal_f=" + document.getElementById('codepostal_f').value;
        } else {
            document.cookie = "codepostal_f=";
        }
        if (document.getElementById('ville_f').value != null) {
            document.cookie = "ville_f=" + document.getElementById('ville_f').value;
        } else {
            document.cookie = "ville_f=";
        }
        if (document.getElementById('mail_f').value != null) {
            document.cookie = "mail_f=" + document.getElementById('mail_f').value;
        } else {
            document.cookie = "mail_f=";
        }
        if (document.getElementById('telephone_f').value != null) {
            document.cookie = "telephone_f=" + document.getElementById('telephone_f').value;
        } else {
            document.cookie = "telephone_f=";
        }
        if (document.getElementById('commentaire_f').value != null) {
            document.cookie = "commentaire_f=" + escape(document.getElementById('commentaire_f').value);
        } else {
            document.cookie = "commentaire_f=";
        }

	if (document.getElementById("theme").selectedIndex != null) {
            document.cookie = "theme=" + document.getElementById("theme").selectedIndex;
        } else {
            document.cookie = "theme=";
        }
        if (document.getElementById("soustheme").selectedIndex != null) {
            document.cookie = "soustheme=" + document.getElementById("soustheme").selectedIndex;
        } else {
            document.cookie = "soustheme=";
        }
        if (document.getElementById('txt_problematique').value != null) {
            document.cookie = "txt_problematique=" + escape(document.getElementById('txt_problematique').value);
        } else {
            document.cookie = "txt_problematique=";
        }
        window.location = lien;
        return true;
    }
    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ')
                c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0)
                return unescape(c.substring(nameEQ.length, c.length));
        }
        return null;
    }
</script>
<?php

if (isset($_GET['info'])) {
    ?>	
    <div id="dialog_dossier_cree" title="Dossier mis à jour" style="display : none;">
        <p>
          Dossier mis à jour avec succès !
        </p>
    </div>

    <?php
}
?>
<?php
if (isset($_GET['erreur']) && $_GET['erreur']=="upload") {
    ?>	
    <div id="dialog_dossier_cree" title="Erreur upload fichier" style="display : none;">
        <p>
          Erreur lors de l'envoi du fichier! Veuillez rééssayer.
        </p>
    </div>

    <?php
}
?>
<?php
if (isset($_GET['erreur']) && $_GET['erreur']=="nom") {
    ?>	
    <div id="dialog_dossier_cree" title="Erreur upload fichier" style="display : none;">
        <p>
          Une erreur est survenue lors de l'envoi du fichier, vérifier que le nom du fichier n'excède pas 50 caractères.
        </p>
    </div>

    <?php
}
?>
<?php
if (isset($_GET['erreur']) && $_GET['erreur']=="taille") {
    ?>	
    <div id="dialog_dossier_cree" title="Erreur upload fichier" style="display : none;">
        <p>
          Une erreur est survenue lors de l'envoi du fichier.
          Vérifier la taille de votre fichier (maximum : 5Mo).
        </p>
    </div>

    <?php
}
?>
<?php
if (isset($_GET['erreur']) && $_GET['erreur']=="extension") {
    ?>	
    <div id="dialog_dossier_cree" title="Erreur upload fichier" style="display : none;">
        <p>
          Une erreur est survenue lors de l'envoi du fichier.
          Type de fichier pris en compte : ('.png', '.gif', '.jpg', '.jpeg', '.pdf','.xls','.xlsx','.doc', '.docx','.txt').
        </p>
    </div>

    <?php
}
?>

 <div id="dialog_maj_event" title="Evenement mis à jour" style="display : none;">
    <p>
      Mise a jour de l'evenement pris en compte.
    </p>
</div>
<!--DIV gérant les popup-->
<!--PopUp création site web-->

<div id="dialog-confirm-dossier" style="display : none;" title="Attention !">
    <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Vous allez supprimer la ligne. Etes vous s&ucirc;r?</p>
</div>



<div id="creer_dossier">

    <form id="form_creer_dossier" name="form_creer_dossier" action="accueil.php?module=dossier&amp;action=creer_dossier&<?php if(isset($_GET['id'])) echo "modifier"; else echo 'ajout';?>=dossier" method="post" onsubmit="return verifierInfoFournisseur();" enctype="multipart/form-data">
        <div id="gauche_dossier">

            <div id="identite_client">        
                <fieldset class="ogconso" id="client">
                    <legend>Identit&eacute; du client</legend>

                    <label for="liste_client" class="lab_txt">Liste clients :</label> 
                    <select id="liste_client" class="inputfield" onChange="changePersonne(this.selectedIndex)">
                        <option value="<?php if(isset($_GET['id'])) echo $client['nom'] ?>"><?php if(isset($_GET['id'])) echo ($client['nom'] . ' ' . $client['prenom']); ?></option> 
                        <?php
                        foreach ($tab_personne as $key => $value) {
                            if($tab_personne[$key]->nom != $client['nom'])
                            echo '<option value="' . $tab_personne[$key]->personne_id . '" >' . $tab_personne[$key]->nom . ' ' . $tab_personne[$key]->prenom . '</option>';
                        }
                        ?>
                    </select>

                    <!--<div class="clear_form"></div>-->
                    <label for="id_dossier" class="lab_txt">Num&eacute;ro du dossier :</label>   
                    <input type="text" class="inputfield" id="id_dossier" name="id_dossier" disabled maxlength="45" value="<?php echo $_GET["id"];  ?>"/>

                    <div id="radio_button">
                        <input type="radio" id="mr" value="1" name="sexe" required  title="Sexe du client" <?php if ((isset($_GET['id'])) && ($client["sexe"] == 1)) echo 'checked="checked"'; else if (isset($_SESSION['sexe']) == '1') echo 'checked="checked"';  ?> />
                        <label for="mr" class="label_radio">Monsieur</label> 
                        <input type="radio" id="mme" value="2" name="sexe" required  title="Sexe du client" <?php if ((isset($_GET['id'])) && ($client["sexe"] == 2)) echo 'checked="checked"'; else if (isset($_SESSION['sexe']) == '2') echo 'checked="checked"';  ?> />
                        <label for="mme" class="label_radio">Madame</label>    
                    </div>

                    <label for="nom" class="lab_txt">Nom <span class="require">*</span> :</label>   
                    <input type="text" class="inputfield" id="nom" name="nom" maxlength="45" required title="Nom de famille du client"
                           value="<?php if(isset($_GET['id'])) echo $client['nom']?>"/>

                    <label for="prenom" class="lab_txt">Pr&eacute;nom <span class="require">*</span> :</label>   
                    <input type="text" class="inputfield" id="prenom" name="prenom" maxlength="45" required title="Pr&eacute;nom du client" 
                           value="<?php if(isset($_GET['id'])) echo $client['prenom']?>"/>
                    
                 
                    <label for="adresse" class="lab_txt">Adresse :</label>   
                    <input type="text" class="inputfield" id="adresse" name="adresse" maxlength="80" title="Adresse du client" 
                        value="<?php if(isset($_GET['id'])) echo $client['adr_postale']?>"/>


                    <label for="codepostal" class="lab_txt">Code Postal :</label>   
                    <input type="text" class="inputfield" id="codepostal" name="codepostal" maxlength="5" title="Code postale du client" 
                        value="<?php if(isset($_GET['id'])) echo $client['code_postal']?>"/>


                    <label for="ville" class="lab_txt">Ville :</label>   
                    <input type="text" class="inputfield" id="ville" name="ville" maxlength="45" title="Ville du client" 
                        value="<?php if(isset($_GET['id'])) echo $client['ville']?>"/>
  

                    <label for="mail" class="lab_txt">Mail :</label>   
                    <input type="email" class="inputfield" id="mail" name="mail" maxlength="45" title="Adresse mail du client (exemple@exemple.ex)" 
                        value="<?php if(isset($_GET['id'])) echo $client['mail']?>"/>
                           

                    <label for="telephone" class="lab_txt">T&eacute;l&eacute;phone <span class="require">*</span> :</label>   
                    <input type="text" class="inputfield" id="telephone" name="telephone" maxlength="10" required title="T&eacute;l&eacute;phone du client" 
                        value="<?php if(isset($_GET['id'])) echo $client['tel_fixe']?>"/>
                    

                    <label for="mobile" class="lab_txt">T&eacute;l&eacute;phone Mobile :</label>   
                    <input type="text" class="inputfield" id="mobile" name="mobile" maxlength="10" title="Autre numero de t&eacute;l&eacute;phone du client" 
                        value="<?php if(isset($_GET['id'])) echo $client['tel_port']?>"/>
                        
                </fieldset >
            </div>

            <div id="identite_fournisseur">
                <fieldset class="ogconso" id="fournisseur">
                    <legend>Identit&eacute; du fournisseur</legend>

                    <label for="liste_fournisseur" class="lab_txt">Liste fournisseurs :</label> 
                    <select id="liste_fournisseur" class="inputfield" onChange="changeFournisseur(this.selectedIndex)">
                        <option value="<?php if(isset($_GET['id'])) echo $fournisseur['id'];?>">         
                            <?php 
                                echo $fournisseur['nom'] . " " . $fournisseur['prenom'] . '(' . $fournisseur['raison_sociale'] . ')';?>
                           
                        </option>
                      
                        
<?php

foreach ($tab_fournisseur as $key => $value) {
    echo '<option value="' . $tab_fournisseur[$key]->fournisseur_id . '">' . $tab_fournisseur[$key]->nom . ' ' .  $tab_fournisseur[$key]->prenom . '(' . $tab_fournisseur[$key]->raison_sociale . ')</option>';
}
?>
                    </select>
                    <!--<div class="clear_form"></div>-->
                    <label for="nom_f" class="lab_txt">Nom <span class="require">*</span> :</label>   
                    <input type="text" class="inputfield" id="nom_f" name="nom_f" maxlength="45" title="Obligatoire si pas de raison sociale" 
                        value="<?php if(isset($_GET['id'])) echo $fournisseur['nom']?>"/>
                           

                    <label for="prenom_f" class="lab_txt">Pr&eacute;nom <span class="require">*</span> :</label>   
                    <input type="text" class="inputfield" id="prenom_f" name="prenom_f" maxlength="45" title="Obligatoire si pas de raison sociale" 
                        value="<?php if(isset($_GET['id'])) echo $fournisseur['prenom']?>"/>


                    <label for="raison_sociale_f" class="lab_txt">Raison Sociale <span class="require">*</span> :</label>   
                    <input type="text" class="inputfield" id="raison_sociale_f" name="raison_sociale_f" maxlength="45" title="Obligatoire si le nom et/ou le prénom vide" 
                        value="<?php if(isset($_GET['id'])) echo $fournisseur['raison_sociale']?>"/>
                          

                    <label for="adresse_f" class="lab_txt">Adresse :</label>   
                    <input type="text" class="inputfield" id="adresse_f" name="adresse_f" maxlength="80" title="Adresse du fournisseur" 
                        value="<?php if(isset($_GET['id'])) echo $fournisseur['adr_postale']?>"/>
                      

                    <label for="codepostal_f" class="lab_txt">Code Postal :</label>   
                    <input type="text" class="inputfield" id="codepostal_f" name="codepostal_f" maxlength="5" title="Code postale du fournisseur" 
                        value="<?php if(isset($_GET['id'])) echo $fournisseur['code_postal']?>"/>
                       

                    <label for="ville_f" class="lab_txt">Ville :</label>   
                    <input type="text" class="inputfield" id="ville_f" name="ville_f" maxlength="45" title="Ville du fournisseur" 
                        value="<?php if(isset($_GET['id'])) echo $fournisseur['ville']?>"/>
                               

                    <label for="mail_f" class="lab_txt">Mail :</label>   
                    <input type="email" class="inputfield" id="mail_f" name="mail_f" maxlength="45" title="Adresse e-mail du fournisseur (exemple@exemple.ex)" 
                        value="<?php if(isset($_GET['id'])) echo $fournisseur['mail']?>"/>
                                

                    <label for="telephone_f" class="lab_txt">T&eacute;l&eacute;phone :</label>   
                    <input type="text" class="inputfield" id="telephone_f" name="telephone_f" maxlength="10" title="T&eacute;l&eacute;phone du fournisseur"
                        value="<?php if(isset($_GET['id'])) echo $fournisseur['tel']?>"/>
                                        

                    <label for="commentaire_f" class="lab_txt">Commentaire :</label>   
                    <textarea class="comment" rows="4" cols="50" id="commentaire_f" name="commentaire_f" title="Commentaire sur le fournisseur"><?php if(isset($_GET['id'])) echo $fournisseur['comment_fournisseur'] ?></textarea>
                </fieldset>
            </div>

            <div id="problematique">		
                <fieldset class="ogconso" id="problematique">
                    <legend>Probl&eacute;matique <span class="require">*</span> </legend>

                    <div id="form_problematique">
                        <label id="lab_theme" class="lab_txt">Th&egrave;me :</label>
                        <div id="div_theme">
                            <select class="liste_problematique" id="theme" name="theme" title="Choisir un th&egrave;me" onChange="changeSousTheme(this.selectedIndex-1)" required >
                                    <?php
                                    echo '<option value=""></option>';
                                    foreach ($tab_theme as $key => $value) {
                                        echo '<option value="' . $tab_theme[$key]->theme_id . '" ';
                                        if ($tab_theme[$key]->theme_id == $dossier_select['theme_id']){
                                            echo ' selected="selected"';
                                        }
                                        echo '>' . $tab_theme[$key]->nom . '</option>';
                                    }
                                    ?>
                            </select>
                        </div>

                        <label id="lab_soustheme" class="lab_txt">Sous-Th&egrave;me :</label>
                        <div id="div_soustheme">
                            <select class="liste_problematique" id="soustheme" name="soustheme" title="Choisir un sous-th&egrave;me" >
                                <?php
                                foreach ($tab_sstheme as $key => $value) {
                                    if ($tab_sstheme[$key]->theme_id == $dossier_select['theme_id']){
                                        echo '<option value="';
                                        if (isset($_GET['id'])){
                                            echo $tab_sstheme[$key]->soustheme_id;
                                        }
                                        echo '"';
                                        if ($tab_sstheme[$key]->soustheme_id == $dossier_select['soustheme_id']){
                                            echo ' selected="selected"';
                                        }
                                        echo ">";
                                        if (isset($_GET['id'])){
                                            echo $tab_sstheme[$key]->nom;
                                        }                                 
                                        echo '</option>'; 
                                    }
                                }
                                ?> 
                            </select>
                        </div>
                    </div>

                    <textarea id="txt_problematique" name="txt_problematique" required placeholder="D&eacute;tail de la probl&eacute;matique des deux parties"><?php echo $dossier_select['problematique']?></textarea>
                </fieldset>
            </div>

            <div id="gestion_fichier">
                <fieldset class="ogconso" id="fichier">
                    <legend>Fichiers</legend>
                    <br />
                    <div id="liste_fichiers">
                        <table class="scroll_tab"  id="tab_fichier">
                            <thead>
                                <tr>
                                    
                                    <th  align="left">Nom du fichier</th>
                                    <th  align="left">Format</th>
                                    <th align="center">Supprimer</th>

                            </thead>
                            <tbody>
                                
                                   <?php   
                                   $i=0;
                                   
                                   foreach ($tab_fichier as &$fichier) {
                                        if($fichier->dossier_id == $_SESSION['dossier_ref'])
                                        {
                                        if (($i % 2) == 0)
                                        echo "<tr class=\"even\">";
                                        else
                                        echo "<tr class=\"odd\">";
                                        $i += 1;
                                        $id_fichier = $fichier->fichier_id; 
                             
                                    

                                 ?>
                                    
                                        <td align="left"><a href="uploads/<?php echo $_SESSION['dossier_ref'] . '/' .  ($fichier->nom)?>" target="_blank"><?php echo $fichier->nom; ?></a></td>
                                        <td align="left"><?php echo $fichier->type_fichier ?></td>
                                        <td align="center">
                                            <a class="supprimer_ligne" href="accueil.php?module=dossier&amp;action=creer_dossier&amp;suppr=fichier&id=<?php echo $id_fichier; ?>"><img src="images/icon/icon_delete.png"/></a>
                                        </td>                                   
                                   
                                </tr>
                                <?php 
                                    }
                                }?>
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <div id="bouton_fichier">
                       
                           <!-- <span class="btn btn-primary fileinput-button" >
                                <i class="icon-plus icon-white"></i>
                                <span>Ajouter fichier...</span>
                                <input type="file" name="fichier" >
                                <input type="hidden" name="MAX_FILE_SIZE" value="500000000"> <!--5Mo max
                            </span> -->
                            
                            <button id="ajouter_fichier" type="button" class="btn"  onclick="javascript:void(save_fields('accueil.php?module=dossier&action=uploader_fichier&id=<?php echo $_SESSION['dossier_ref']; ?>'));">
                                 <i class="icon-plus icon-white"></i>
                                <span>Ajouter fichier...</span>
                            </button>
                        
                       
                     
                    </div>
                
                </fieldset>
            </div>
        </div>
		
        <div id="milieu">
            <div id="website">
                <fieldset class="ogconso">
                    <legend>Site WEB</legend>
                    <div class="tab_site">
                    <table class="scroll_tab"  id="head_sites">
                        <thead>
                            <tr>
                                <th  align="left">Nom</th>
                                <th  align="left">Gestion</th>
                        </thead>
                        <tbody>                         
                                <?php
                                $i=0;
                                foreach ($tab_site as &$site) {
                                    if ($site->dossier_id == $_SESSION['dossier_ref']) {
                                        
                                        if (($i % 2) == 0)
                                        echo "<tr class=\"even\">";
                                        else
                                        echo "<tr class=\"odd\">";
                                        $i += 1;
                                        ?>
                                        <tr class="odd">
                                            <td class="td_nom"><a href="<?php echo $site->lien; ?>" target="_blank"><?php echo $site->nom; ?></a></td>
                                            <td align="center">
                                            <a class="supprimer_ligne" href="accueil.php?module=dossier&amp;action=creer_dossier&amp;suppr=site&id=<?php echo $site->site_id; ?>"><img src="images/icon/icon_delete.png"/></a>
                                            </td>
                                        </tr>
                                            <?php
                                        }
                                    }
                                    ?>                           
                    
                       </tbody>
                    </table>
                    </div>
                    <a id="ajouter_site" class="btn desactiver" onClick="javascript:void(save_fields('accueil.php?module=dossier&action=creer_site&id=<?php echo $_SESSION['dossier_ref']; ?>'));">Ajouter</a>
                </fieldset>			
            </div>

            <div id="cloturer">
                <fieldset class="ogconso">
                    <legend>Cl&ocirc;ture</legend>
                    <label for="list_cloture" class="lab_txt">Raison de la cl&ocirc;ture :</label>
                    <select id="list_cloture" name="list_cloture" class="inputfield_cloture" title="Choisir une cause de cl&ocirc;ture" placeholder="Cause" required>
<?php if(isset($_GET['id']) && $dossier_select['raison_cloture'] != null ) {?>
                        <option value="<?php echo $dossier_select['raison_cloture'];?>"><?php echo $dossier_select['raison_cloture'];?></option>
                        <?php } ?>
                        <?php if($dossier_select['raison_cloture'] != "En cours"){ ?><option value="En cours">En cours</option><?php } ?>
                        <?php if($dossier_select['raison_cloture'] != "Terminé") { ?><option value="Terminé">Terminé</option><?php } ?>
                        <?php if($dossier_select['raison_cloture']!= "Transféré") { ?><option value="Transféré">Transféré</option><?php } ?> 
                        <?php if($dossier_select['raison_cloture'] != "échec") { ?><option valie="échec">Echec</option><?php } ?>
                    </select>
                    <label for="date_cloture" class="lab_txt">Date de cl&ocirc;ture :</label>
                    <input type="text" class="datepicker inputfield_cloture" placeholder="Selectionner date" id="date_cloture" name="date_cloture"
                        value="<?php if(isset($_GET['id'])) echo $dossier_select['date_cloture']; ?>" />
                    </input>
                    <label for="comment_cloture" class="lab_txt">Commentaire :</label>
                    <textarea id="comment_cloture" name="comment_cloture" placeholder="(facultatif)"><?php if(isset($_GET['id'])) echo $dossier_select['comment_cloture']; ?></textarea>
                </fieldset>
            </div>

            <div id="validation">
                <fieldset class="ogconso">

                    <legend>Validation</legend>
                    <label for="list_users" class="lab_txt">Propri&eacute;taire :</label>
                    <select id="list_users" name="list_users" class="inputfield" required>
                       
<?php
if(isset($_GET['id']) && $dossier_select['user_id'] != null ) echo '<option value="' . $dossier_select['user_id'] . '" >' . $utilisateur['nom'] . ' ' . $utilisateur['prenom'] . '</option>';
else echo '<option value="' . $_SESSION['id'] . '" >' . $_SESSION['nom_session'] . ' ' . $_SESSION['prenom_session'] . '</option>'; 
foreach ($tab_user as &$user) {
    if(($user->user_id != $_SESSION['id'] || $_SESSION['admin']) && $user->user_id != $dossier_select['user_id'])

        echo '<option value="' . $user->user_id . '" >' . $user->nom . ' ' . $user->prenom . '</option>';
}
?>
                    </select>
                    <label for="check_physique" class="lab_txt">Dossier physique :</label>
                    <input id="check_physique" name="check_physique" type="checkbox" title="Existe t-il un dossier physique?" 
                           <?php if(isset($_GET['id']) && ($dossier_select['dossier_physique'] == 1)) echo "checked" ?> ></input>
                    <a id="exportPDF" class="btn" target="_blank" href="libs/pdf/export/dossier_<?php echo $_SESSION['dossier_ref'];?>.pdf" >Exporter au format PDF</a>
                    <!-- Bouton validation dossier -->
                        <button type="submit" name="ok" class="submit_button" title="Valider">Enregistrer dossier</button>	
                </fieldset>
            </div> 
        </div>
    </form>	
	
    <div id="droite_dossier">
        <fieldset class="ogconso">
            <legend>Ev&eacute;nement</legend>
            <div id="date_creation">
                    Date d'ouverture du dossier : <?php echo $dossier_select["date_creation_d"]; ?>
                </div>
            <div id="evenement_dossier">
                
                <table id="tab_event" class="scroll_tab">
                    <thead>
                        <tr id="head_tab_rdv">
                            <th>Trait&eacute;</th>
                            <th>Date</th>
                            <th align="left">Mode de contact</th>
                            <th align="left">Utilisateur</th>
                            <th>D&eacute;tails</th>
                            <th>Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i=-1;
                        $tab_reverse = array_reverse($tableau_evenement_user, true);
                        foreach ($tab_reverse as &$ligne_evenement) {
                            
                             
                            if ( $ligne_evenement['dossier_id'] == $_SESSION['dossier_ref']) {
                                $i++;
                                if (($i % 2) == 0)
                                        echo "<tr class=\"even\">";
                                    else
                                        echo "<tr class=\"odd\">";
                               
                                    
                        ?>
                                    <td class="ligne_rdv"><input class="check_rdv" id="<?php echo $ligne_evenement['id_evenement'];?>" type="checkbox"<?php 
                                    if($ligne_evenement['traite']==1) echo "checked";?>/></td>
                                    <td id="date_rdv" class="ligne_rdv"><?php echo $ligne_evenement['date_evenement']; ?></td>
                                    <td id="mode_rdv" class="ligne_rdv"><?php echo $ligne_evenement['mode_contact']; ?></td>
                                    <td id="user_rdv" class="ligne_rdv"><?php echo $ligne_evenement['utilisateur']; ?></td>
                                    <td id="deplier" class="ligne_rdv"><a href="#" id="lien_detail" class="click_event"></a></td>  
                                    <td class="ligne_rdv"><a href="accueil.php?module=dossier&action=modifier_evenement&id=<?php echo $ligne_evenement['id_evenement']; ?>" id="click_modifier_event" onClick="javascript:void(save_fields('accueil.php?module=dossier&action=creer_evenement&id=<?php echo $_GET['id']; ?>'));"></a></td>                

                                </tr>
                                <?php
                                if (($i % 2) == 0)
                                        echo "<tr class=\"even cacher\">";
                                    else
                                        echo "<tr class=\"odd cacher\">";
                              ?>
                                    <td colspan="6" ><textarea class="comment_rdv" placeholder="D&eacute;tails du rendez vous" readonly><?php echo stripslashes($ligne_evenement['commentaire']); ?></textarea></td>
                                </tr>
                        <?php
                        
                            }
                        }
                        ?>

                               
                    </tbody>
                </table>
            </div>
            <button id="ajouter_evenement" class="btn desactiver" onClick="javascript:void(save_fields('accueil.php?module=dossier&action=creer_evenement&id=<?php echo $_GET['id']; ?>'));">Ajouter une action</button>
        </fieldset>
    </div>

</div>
<script type="text/javascript">
     <?php if(($dossier_select['user_id'] != $_SESSION['id']) && $dossier_select['user_id'] != null && $_SESSION['admin'] != 1 ) { ?>
        var allInput = document.getElementById('creer_dossier').getElementsByTagName('input');
        var allTextarea = document.getElementById('creer_dossier').getElementsByTagName('textarea');
        var allSelect = document.getElementById('creer_dossier').getElementsByTagName('select');
        var allButton = document.getElementById('creer_dossier').getElementsByTagName('button');
        var allOther = document.getElementsByClassName('desactiver');
        for(var i=0; i<allInput.length;i++){ allInput[i].disabled = true; }
        for(var i=0; i<allTextarea.length;i++){ allTextarea[i].disabled = true; }
        for(var i=0; i<allSelect.length;i++){ allSelect[i].disabled = true; }
        for(var i=0; i<allButton.length;i++){ allButton[i].disabled = true; }
        for(var i=0; i<allOther.length;i++){ allOther[i].onclick = ''; }
      

    <?php } else if(isset($_GET['from']) || isset($_GET['erreur'])) { ?>
    var checked_radio = readCookie("sexe");
    if ( checked_radio == '0' ){
        document.getElementById('mr').checked = true;
    }
    if ( checked_radio == '1' ){
        document.getElementById('mme').checked = true;
    }
    document.getElementById("nom").value = readCookie("nom");
    document.getElementById("prenom").value = readCookie("prenom");
    document.getElementById("adresse").value = readCookie("adresse");
    document.getElementById("codepostal").value = readCookie("codepostal");
    document.getElementById("ville").value = readCookie("ville");
    document.getElementById("mail").value = readCookie("mail");
    document.getElementById("telephone").value = readCookie("telephone");
    document.getElementById("mobile").value = readCookie("mobile");
    document.getElementById("nom_f").value = readCookie("nom_f");
    document.getElementById("prenom_f").value = readCookie("prenom_f");
    document.getElementById("raison_sociale_f").value = readCookie("raison_sociale_f");
    document.getElementById("adresse_f").value = readCookie("adresse_f");
    document.getElementById("codepostal_f").value = readCookie("codepostal_f");
    document.getElementById("ville_f").value = readCookie("ville_f");
    document.getElementById("mail_f").value = readCookie("mail_f");
    document.getElementById("telephone_f").value = readCookie("telephone_f");
    document.getElementById("commentaire_f").value = readCookie("commentaire_f");
    document.getElementById("theme").selectedIndex = readCookie("theme");
    if ( readCookie("theme") != null ){
        changeSousTheme(readCookie("theme")-1);
    }
    document.getElementById("soustheme").selectedIndex = readCookie("soustheme");
    document.getElementById("mail_f").value = readCookie("mail_f");
    document.getElementById("txt_problematique").value = readCookie("txt_problematique");
    <?php } ?> 
</script>