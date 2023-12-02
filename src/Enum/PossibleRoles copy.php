<?php

namespace App\Enum;

enum ObjetsDemandeContact: string {
    case demandeRoleEditeur = "Demande de role editeur";
    case problemeCreationTest = "J'ai un probleme avec la creation de testes...";
    case suppressionCompte = "Je veux supprimer mon compte!";
    case autre = 'Autre demande';
}