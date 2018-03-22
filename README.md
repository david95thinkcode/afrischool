# **Afrischool**

## Analyse
L'analyse du projet a conduit à l'élaboration du mcd suivant :

![MCD version 0.0.1 !](screenshoots_&_pics/mcd-afrischool.jpg "Notre premier mcd")

## Migrations

- ### Categorie_ets
~~~~
Réprésente les catégories d'établissement
~~~~
Propriété|Type
----------|----
id|id
libelle|string
description|string

- ### Etablissements
~~~~
Représente les établissements ou écoles
~~~~
Propriété|Type
----------|----
id|int
raison_sociale|string
directeur|string
tel|string
email|string
site_web|string
categorie_id|int
adresse_id|int

- ### Adresses 

Propriété|Type
----------|----
id|int
pays|string
ville|string
quartier|string

# Vues
### Repertoires
- `templates` : regroupe les vues qui font office de templates.
- `public` : regroupe les vues du site web, accessibles au public (les internautes simples).
- `dashboard` : rassemble les vues liées aux tableaux de bord.
  - `dashboard/dev` : regroupe les vues liées aux différentes interfaces auxquelles aura accès l'équipe de **Afrischool** pour la gestion de ses clients, éventuellement les informations sur le projet, etc.
  - `dashboard/etablissements` : Regroupe les vues liées aux différentes interfaces auxquelles aura accès chaque école pour sa gestion.
- `partials` : regroupe les portions de vues succeptibles d'être partagées entre différentes vues. Il peut contenir également des bouts de vues à inclure dans une vue un peu plus grande dans le but de réduire son nombre de ligne de code.
- `inscriptions` : (A revoir)

Edited by 
- [david95thinkcode]()