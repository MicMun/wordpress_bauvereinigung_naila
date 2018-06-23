<?php
/*
Template Name: Zur zweiten Unterseite weiterleiten
*/
$unterseiten = get_pages("child_of=".$post->ID."&sort_column=menu_order");
if ($unterseiten) {
   $zweiteunterseite = $unterseiten[1];
   wp_redirect(get_permalink($zweiteunterseite->ID));
}
?>
