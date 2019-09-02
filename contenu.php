<?php
$json = file_get_contents("assets/json/DB.json");
$parsed_json = json_decode($json);
$html1 = "";
$html2 = "";
//A faire
if ($parsed_json) {
    foreach ($parsed_json as $value) {
        foreach ($value as $value2) {
            if (!empty(trim($value2[0]))) {
                if ($value->statut == true) {
                    $html1 .= '<li><p><label><input type=checkbox class="filled-in"  name="check[]" value=' . $value->count . ' ><span class="afaire">' . $value2 . '</span></label></p></li>';
                } else if ($value->statut == false) {
                    $html2 .= '<li><p><label><input type=checkbox checked="checked" class="filled-in" name="check[]" value=' . $value->count . '><span class="archive">' . $value2 . '</span></label></p></li>';
                }
            }
        }
    }
};


