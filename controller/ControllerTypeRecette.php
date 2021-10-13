<?php

require_once (File::build_path(array("model", "ModelTypeRecette.php")));

class ControllerTypeRecette {

    protected static $object = 'TypeRecette';

    public static function readAll() {
        $tab_i = ModelTypeRecette::selectAll();     //appel au modèle pour gerer la BD
        $controller = ('TypeRecette');
        $view = 'list';
        $pagetitle = 'Types Recettes';
        require (File::build_path(array("view", "view.php")));  //"redirige" vers la vue
    }

    public static function read() {
        $pagetitle = 'Détails';
        $idTypeRecette = $_GET["idTypeRecette"];
        $p = ModelTypeRecette::select($idTypeRecette);
        if ($p == null) {
            $controller = ('TypeRecette');
            $view = 'error';
            require (File::build_path(array("view", "view.php")));
        } else {
            $controller = 'TypeRecette';
            $view = 'detail';
            require (File::build_path(array("view", "view.php")));
        }
    }


           
    public static function create() {
            $create=true;//différencier entre mise à jour et l'ajout
            $idTypeRecette = "";
            $nomTypeRecette = ""; 
            $pagetitle = 'Nouveau Type';
            $controller = 'TypeRecette';
            $view = 'update';
            require (File::build_path(array("view", "view.php")));//appel les lignes
            //création des variables ds controlleurs et on les utilise ds view
        }


    public static function created() {
            $data = array(
                "idTypeRecette" => "",
                "nomTypeRecette" => $_GET["nomTypeRecette"]
                
            );

            $p = new ModelTypeRecette($_GET["nomTypeRecette"]);
            ModelTypeRecette::save($data);
            $tab_p = ModelTypeRecette::selectAll();
            $controller = ('TypeRecette');
            $view = 'created';
            $pagetitle = 'Tous nos types recettes';
            require (File::build_path(array("view", "view.php")));
        }


    public static function error() {
        $controller = ('TypeRecette');
        $view = 'error';
        $pagetitle = 'Erreur';
        require (File::build_path(array("view", "view.php")));
    }


    // à faire avec udptated
    public static function update() {
            $act = "updated";
            $form = "readonly";
            $pagetitle = 'Mise à jour informations Type recette';
            $idRecette = $_GET["idTypeRecette"];

            $p = ModelTypeRecette::select($idTypeRecette);
            $nomTypeRecette = $p->getNomTypeRecette();
            if ($p == null) {
                $controller = ('TypeRecette');
                $view = 'error';
                require (File::build_path(array("view", "view.php")));
            } else {
                $controller = 'TypeRecette';
                $view = 'update';
                require (File::build_path(array("view", "view.php")));
            }
        }


    //TODO
    public static function updated() {
            $tab_p = ModelTypeRecette::selectAll();
            $pagetitle = 'Produit mis à jour';
            $idTypeRecette = $_GET["idTypeRecette"];
            $data = array(
                "nomTypeRecette" => $_GET["nomTypeRecette"],
                "primary" => $_GET["idTypeRecette"],
            );
            $p = ModelTypeRecette::select($idTypeRecette);
            $p->update($data);
            $controller = "TypeRecette";
            $view = 'updated';
            require (File::build_path(array("view", "view.php")));
        }

    public static function delete() {
            $tab_p = ModelTypeRecette::selectAll();     //appel au modèle pour gerer la BD
            $idTypeRecette = $_GET["idTypeRecette"];
            $p = ModelTypeRecette::select($idTypeRecette);
            if ($p == null) {
                $pagetitle = 'Erreur produit';
                $controller = ('TypeRecette');
                $view = 'error';
                require (File::build_path(array("view", "view.php")));
            } else {
                
                
                ModelTypeRecette::delete($idTypeRecette);
                $controller = ('TypeRecette');
                $view = 'delete';
                $pagetitle = 'Suppression de Type Recette';
                require (File::build_path(array("view", "view.php")));
                
            }
        }



}