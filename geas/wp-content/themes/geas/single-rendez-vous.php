<?php
get_header();
session_start();?>

<?php
while ( have_posts() ) :
    the_post();

    global $wpdb;
    $infos = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}Enfants_has_Client INNER JOIN geas_Enfant ON geas_Enfant.id_Enfant = geas_Enfants_has_Client.fk_id_Enfant INNER JOIN  geas_Client ON geas_Client.id_Client = geas_Enfants_has_Client.fk_id_Client INNER JOIN  geas_TypeRelation ON geas_TypeRelation.id_TypeRelation = geas_Enfants_has_Client.TypeRelation_id_TypeRelation WHERE id_Enfant = 1" , OBJECT );
    $allergies = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}TypePathologies INNER JOIN geas_Allergie ON geas_TypePathologies.id_TypePathologies = geas_Allergie.TypePathologies_id_TypePathologies INNER JOIN geas_Enfant ON geas_Enfant.id_Enfant = geas_TypePathologies.fk_id_Enfant WHERE id_Enfant = 1", OBJECT);
    $maladies = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}Allergie_has_Enfant INNER JOIN geas_Enfant ON geas_Enfant.id_Enfant = geas_Allergie_has_Enfant.Enfant_id_Enfant INNER JOIN  geas_Allergie ON geas_Allergie.id_Allergie = geas_Allergie_has_Enfant.Allergie_id_Allergie WHERE id_Enfant = 1" , OBJECT );
    $vaccin = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}Vaccin INNER JOIN geas_Enfant ON geas_Enfant.id_Enfant = geas_Vaccin.fk_id_Enfant where id_Enfant = 1" , OBJECT );
    $rdvs = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}rendezvous_has_Enfant INNER JOIN geas_rendezvous ON geas_rendezvous.id_rendezvous = geas_rendezvous_has_Enfant.rendezvous_id_rendezvous INNER JOIN  geas_Enfant ON geas_Enfant.id_Enfant = geas_rendezvous_has_Enfant.Enfant_id_Enfant WHERE id_Enfant = 1" , OBJECT );

    ?>
    <div class="wrap_infoP">
        <h2 class="enfinfo">Enfant Information</h2>
<div class="parties">
    <h3 class="ident">Identification</h3>
        <div class="infloat">
            <p class="det">Nom: <?= $infos->nom; ?></p>
            <p class="det">Date de Naissance: <?= $infos->date_Birth; ?></p>
        </div>
        <div class="infloat">
            <p class="det">Prenom: <?= $infos->prenom; ?></p>
            <p class="det">Age: <?= $infos->age; ?></p>
        </div>
</div>
    <div class="trait"></div>
<div class="parties">
    <h3 class="ident">Information Résponsable légaux</h3>
    <div class="infloat">
        <p class="det">Nom: <?= $infos->nom_Client; ?></p>
        <p class="det">Lien avec l'enfant: <?= $infos->TypeRelaLibelle; ?></p>
        <p class="det">E-mail: <?= $infos->email; ?></p>
        <p class="det">Adresse: <?= $infos->adresse1; ?></p>
    </div>
    <div class="infloat">
        <p class="det">Prenom: <?= $infos->prenom_Client; ?></p>
        <p class="det">Numéro de Télephone: <?= $infos->telephone; ?></p>
        <p class="det">Ville: <?= $infos->ville; ?> - Code Postal: <?= $infos->cp; ?></p>
    </div>
</div>
<div class="clear"></div>
    <div class="trait"></div>
    <div class="parties">
        <h3 class="ident">Pathogenes</h3>
        <div class="infloat2">
            <p class="det">Maladie: <?= $maladies->allergie_maladie; ?></p>
            <p class="det">Traitement: <?= $maladies->traitement; ?></p>
            <p class="det">Type: <?= $allergies->type; ?></p>
        </div>
        <div class="infloat2">
            <p class="det">Tuberculose: <?= $vaccin->Tuberculose; ?></p>
            <p class="det">Diphterie: <?= $vaccin->Diphterie; ?></p>
            <p class="det">Méningites à Haemophilus influenzae b: <?= $vaccin->Méningites_à_Haemophilus_influenzae_b; ?></p>
            <p class="det">Hepatite B: <?= $vaccin->Hepatite_B; ?></p>
            <p class="det">ROR: <?= $vaccin->ROR; ?></p>
            <p class="det">Méningites pneumonies et septicémies àpneumocoque: <?= $vaccin->Méningites_pneumonies_et_septicémies_à_pneumocoque; ?></p>
        </div>
        <div class="infloat2">
            <p class="det">Méningites et septicémies à méningocoque C: <?= $vaccin->Méningites_et_septicémies_à_méningocoque_C; ?></p>
            <p class="det">HPV: <?= $vaccin->HPV; ?></p>
            <p class="det">Hépatite A: <?= $vaccin->Hépatite_A; ?></p>
            <p class="det">Hépatite B: <?= $vaccin->Hépatite_B; ?></p>
            <p class="det">Varicelle: <?= $vaccin->Varicelle; ?></p>
            <p class="det">Grippe saisonnière: <?= $vaccin->Grippe_saisonnière; ?></p>
        </div>
    </div>
    <div class="clear"></div>
    </div>
    <div class="wrap_infordv">
        <h2 class="enfinfo">Rendez-vous</h2>
            <div class="parties">
                <h3 class="ident">Rendez-vous</h3>
                <div class="infloat">
                    <?php foreach ($rdvs as $rdv){?>
                    <p class="det">Date: <?= $rdv->date_rendezvous; ?> - debut: <?= $rdv->heure_debut; ?> fin: <?= $rdv->heure_fin; ?></p>
                    <?php } ?>
                </div>
            </div>
    </div>

<?php

endwhile; // End of the loop.

get_footer();