<link rel="stylesheet" type="text/css" href="style/style_formulaire.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" integrity="sha512-yVvxUQV0QESBt1SyZbNJMAwyKvFTLMyXSyBHDO4BG5t7k/Lw34tyqlSDlKIrIENIzCl+RVUNjmCPG+V/GMesRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" defer>


    function creerTypeRecette(){
        if (document.getElementById("newTypeRecette").required == false){
            $("#typeRecetteSelect").toggle();
            $("#typeRecetteSelect select").prop("required",false)
            $("#typeRecetteSelect select").trigger("chosen:updated");
            $("#newTypeRecette").toggle();
            $("#newTypeRecette").prop("required",true)
            $("#textTypeIngredient").text("Choisir un type existant");
        }
        else {
            $("#typeRecetteSelect").toggle();
            $("#typeRecetteSelect select").prop("required",true)
            $("#newTypeRecette").toggle();
            $("#newTypeRecette").prop("required",false)
            $("#newTypeRecette").prop("value","")
            $("#textTypeIngredient").text("Creer un nouveau type ingrédient");
        }
    }

    function creerAuteur(){
        if (document.getElementById("newAuteurNom").required == false){
            $("#auteurSelect").toggle();
            $("#auteurSelect select").prop("required",false)
            $("#auteurSelect select").trigger("chosen:updated");
            $("#newAuteurNom").toggle();
            $("#newAuteurNom").prop("required",true)
            $("#newAuteurPrenom").toggle();
            $("#newAuteurPrenom").prop("required",true)
            $("#textAuteur").text("Choisir un auteur existant");
        }
        else {
            $("#auteurSelect").toggle();
            $("#auteurSelect select").prop("required",true)
            $("#newAuteurNom").toggle();
            $("#newAuteurNom").prop("required",false)
            $("#newAuteurNom").prop("value","")
            $("#newAuteurPrenom").toggle();
            $("#newAuteurPrenom").prop("required",false)
            $("#newAuteurPrenom").prop("value","")
            $("#textAuteur").text("Creer un nouvel auteur");
        }
    }
    var i = 0;


    function ajouterIngredient(){
        $("#listeIngredient").append("<div id='" + i + "'></div>");
        $("#listeIngredient div:last").append("<li><select class='choix' class='liste_der' name='ingredients[]' placeholder='Choisissez ingrédient' required></select></li>");
        <?php foreach ($listeIngredient as $ingredient){?>
            $("#listeIngredient div:last select:last").append($('<option>', {
                value: "<?php echo $ingredient->getIdIngredient()?>",
                text: "<?php echo $ingredient->getNomIngredient()?>"
            }));
        <?php }; ?>
        $("#listeIngredient div:last").append("<li><input type='text' name='quantitesIngredients[]' placeholder='Quantité ingredient' required></input></li>");
        $("#listeIngredient div:last").append("<li><div onclick='$(this).parent().parent().remove()'>Supprimer</div></li>");
        i++;
        $(".choix").chosen();
    }
    function ajouterRecette(){
        $("#listeIngredient").append("<div id='" + i + "'></div>");
        $("#listeIngredient div:last").append("<li><select class='choix' name='recettes[]' placeholder='Choisissez la recette' required></select></li>");
        <?php foreach ($listeRecette as $recette){?>
        $("#listeIngredient div:last select:last").append($('<option>', {
            value: "<?php echo $recette->getIdRecette()?>",
            text: "<?php echo $recette->getNomRecette()?>"
        }));
        <?php }; ?>
        $("#listeIngredient div:last").append("<li><input class='entrer_text' type='text' name='quantitesRecettes[]' placeholder='Quantité recette' required></input></li>");
        $("#listeIngredient div:last").append("<li><div onclick='$(this).parent().parent().remove()'>Supprimer<br></div></li>");
        i++;
        $(".choix").chosen();
    }


</script>
<form id="ajout_ingredient" method="post" action="index.php?action=<?= ($create ? "created" : "updated" )?>&controller=recette">
    <fieldset class="bordure">
        <legend class="titre"><?= ($create ? "Ajout d'une nouvelle recette" : "Mise à jour d'une recette") ?></legend>
        <div class="contenu_form">    
            <p>
                <input type ="hidden" name ="action" value=<?php echo "\"$act\"" ?>/>
                <input type ="hidden" name ="controller" value="recette"/>
                <label class="sous_titre" for="nom_recette">Nom</label> :
                <input class="entrer_text" type="text" placeholder="Ex : rizoto" name="nomRecette" <?= ($create ? "required" : "required") ?> value="<?= htmlspecialchars($nomRecette) ?>" id="nom_recette"/>
            </p>
            <p class="sous_titre">Type Recette
                <div id="typeRecetteSelect">
                    <select id="selectTypeRecette" class="liste_der" name="idTypeRecette" required>
                        <option value="" disabled <?= ($create ? "selected" : "") ?>>Choisissez un type</option>
                        <?php
                        foreach($typeRecetteList as $type){
                            echo '<option value="' . $type->getIdTypeRecette() . '" ' . ($type->getIdTypeRecette() == $idTypeRecette ? "selected" : "") . '>' .  $type->getNomTypeRecette() . '</option>';
                        }
                        ?>
                        <script>$("#selectTypeRecette").chosen();</script>
                    </select>
                </div>
                <input id="newTypeRecette" type="text" name="newTypeRecette" placeholder="Nouveau Type" style="display: none">
            </p>
            <div id="textTypeRecette" onClick="creerTypeRecette()">Creer un nouveau type recette</div>


            <p class="sous_titre">Auteur
                <div id="auteurSelect">
                    <select id="selectAuteur" class="liste_der" name="idAuteur" required>
                        <option value="" disabled <?= ($create ? "selected" : "") ?>>Choisissez un auteur</option>
                        <?php
                            foreach($auteurList as $auteur){
                                echo '<option value="' . $auteur->getIdAuteur() . '" ' . ($auteur->getidAuteur() == $idAuteur ? "selected" : "") . '>' .  $auteur->getNomAuteur() . '</option>';
                            }
                        ?>
                        <script>$("#selectAuteur").chosen();</script>
                    </select>
                </div>
                <input id="newAuteurNom" type="text" name="newNom" placeholder="Nom" style="display: none">
                <input id="newAuteurPrenom" type="text" name="newPrenom" placeholder="Prenom" style="display: none">
            </p>
            <div id="textAuteur" onClick="creerAuteur()">Creer un nouvel auteur</div>
            <p>
                <label class="sous_titre" for="nombre_Portion">Nombre de portion</label> :
                <input class="entrer_text" type="text" name="nombrePortion" value="<?= htmlspecialchars($nombrePortion) ?>" id="nombre_Portion" required/>
            </p>
            <p>
                <label class="sous_titre" for="prixMain_Oeuvre">Prix de main d'oeuvre</label> :
                <input class="entrer_text" type="text" name="prixMainOeuvre" value="<?= htmlspecialchars($prixMainOeuvre) ?>" id="prixMain_Oeuvre" required/>
            </p>
            <p>
                <label class="sous_titre" for="multiplicateur_id">Multiplicateur</label> :
                <input class="entrer_text" type="text" name="multiplicateur" value="<?= htmlspecialchars($multiplicateur) ?>" id="multiplicateur_id" required/>
            </p>
            <div id="contener_liste">
                <p class="sous_titre">Liste des ingrédients</p>
                <p id="ajouterIngredient" onclick="ajouterIngredient()"> Ajouter Ingrédient </p>
                <p id="ajouterRecette" onclick="ajouterRecette()"> Ajouter Recette </p>
                <ul id="listeIngredient">
            </div>

            </ul>

            <label class="sous_titre" for="descriptif_id">Description</label>
            <textarea class="entrer_text" id="descriptif_id" name="descriptif" rows="5" cols="33" required>
                <?= htmlspecialchars($descriptif) ?>
            </textarea>

            
            <label class="sous_titre" for="progression_id">Progression</label>
            <textarea class="entrer_text" id="progression_id" name="progression" rows="5" cols="33" required>
                <?= htmlspecialchars($progression) ?>
            </textarea>
            

            <?=($create ? "" : '<input type="hidden" name="idRecette" value="' . rawurldecode($idRecette) . '"/>') ?>
                <input class="bouton_final" type="submit" value="<?= $create ? "Ajouter" : "Mettre à jour" ?>" />
            </p>
        </div>
    </fielset>
</form>

