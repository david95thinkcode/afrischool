## Analyse
L'analyse du projet a conduit à l'élaboration du mcd suivant :

![MCD version 0.0.1 !](screenshoots_&_pics/mcd-afrischool.jpg "Notre premier mcd")

# Migrations simples

- ### Categorie_ets

~~~~
Réprésente les catégories d'établissement
~~~~
Propriété|Type
----------|----
id|int
libelle|string
description|string

- ### Adresses 

Propriété|Type
----------|----
id|int
pays|string
ville|string
quartier|string

- ### Matieres

Propriété|Type
----------|----
id|int
intitule|string

- ### Classes

Propriété|Type
----------|----
id|int
cla_intitule|int
classe_id|int
matiere_id|int
professeur_id|int !!!

- ### Professeurs

Propriété|Type
----------|----
id|int
prof_nom|string
prof_prenoms|string
prof_sexe|string
prof_tel|string
prof_email|string
prof_date_naissance|date
prof_nationalite|string


# Migrations dépendantes des simples

- ### Diplomes

~~~~
Réprésente les diplômes des professeurs
~~~~
Propriété|Type
----------|----
id|int
dip_intitule|string
dip_ecole|string
dip_specialite|string
dip_niveau|string
dip_date_obtention|date
professeur_id|int

- ### Etablissements

~~~~
Représente les établissements ou écoles
~~~~
Propriété|Type
----------|----
id|int
raison_sociale|string
sigle|string
directeur|string
tel|string
email|string
site_web|string
activer|boolean
adresse_id|int
categorie_id|char

- ### Enseigner
~~~~
Représente un cours enseigné par un professeur dans une classe
~~~~
Propriété|Type
----------|----
id|int
coefficient|int
classe_id|int
matiere_id|int
professeur_id|int

- ### Inscriptions
~~~~
Représente une inscription effectuée par un élève dans une classe pour une année scolaire donnée dans une école
~~~~
Propriété|Type
----------|----
id|int
eleve_id|int
classe_id|int
annee_scolaire_id|int
