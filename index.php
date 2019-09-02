<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$document = file_get_contents("assets/json/DB.json", true);// Chemin pour acceder aux Json

$table = json_decode($document, true);// permet d'utiliser le PHP

if(isset($_POST['tache'])) {
    $input = trim(filter_input(INPUT_POST, 'tache', FILTER_SANITIZE_STRING));// Recupére la tache inputé

    $html = html_entity_decode(json_encode($table));// convertit en code html le code json 

    $table[] = ["count"=> count($table),"tache" => $input,"statut" => true];// transforme notre input en objet json
    
    $codejson = json_encode($table,JSON_UNESCAPED_UNICODE);// encode dans le fichier
    $input = fopen("assets/json/DB.json", "w"); // ouvre le fichier 
    

    fwrite($input, $codejson);//écrit dans le doc
    fclose($input);// ferme le doc 
    }
  // transforme un " a faire " en un " archive"  
    if(isset($_POST['check'])) {
        foreach ($_POST['check'] as $id) {
            if ($table[$id]["statut"] == true) {
                $table[$id]["statut"] = false;
                $newJsonString = json_encode($table);
                file_put_contents("assets/json/DB.json", $newJsonString);
            }
        }
    };
    
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/style.css">
    <title>To Do List</title>
</head>

<body>
    <main>
        <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4  m-5 p-0">
                        <form class="content1 ml-5" method="post" action="#">
                            <h4>TACHES A FAIRE</h4>
                            <ul id="sortable" class='liststyle'>
                            <?php require("./contenu.php");
                            echo $html1 ?>
                            </ul>
                            <div class='plest'>
                            <button class="btn btn-dark text-center butarchive" type="submit" name="fin">Archiver</button>
                            </div>
                        </form>
                    </div>
               
        
                    <div class=" content1 col-12 col-sm-12 col-md-4 col-lg-4 m-5 p-0">
                        <h4>ARCHIVE</h4>
                        <ul id="resortable" class='liststyle'>
                        <?php require("./contenu.php");
                            echo $html2 ?>
                    </div>
                    </div>
            
        </div>
               
        <form class="form" method="post" action="#">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 plest">
                        <h3>Ajouter une tâche </h3>
                    
                        <div class="row">
                            <div class="col-lg-12 plest">
                                <input id="tache_input" type="text" class="validate mt-3" name="tache">
                                <label for="tache_input"></label>
                            </div>
                        </div>
                        <input type="checkbox" name="contact_me_by_fax_only" value="1" style="display:none !important"
                            tabindex="-1" autocomplete="off">
                        
                        
                    <button class="btn btn-dark justify-content-center mt-3" type="submit" name="Ajouter">Ajouter
                        
                    </button>
                    
                </div>
            </div>
        </form>
    </main>
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>$( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  });
  
  $( function() {
    $( "#resortable" ).sortable();
    $( "#resortable" ).disableSelection();
  });
  </script>
</body>

</html>