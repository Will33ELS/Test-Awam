## Outil AWAM
### Démarche technique

Sur la page d'accueil, 2 inputs permettant d'insérer un montant à calculer,
ils sont tous les deux associés à une liste déroulante permettant de choisir une devise.

Lorsque l'utilisateur clique sur le bouton calculer, un controller vérifie que tous les champs soit
bien renseigné, il vérifie que les montants sont bien des nombres numériques et que les devises sont correct.

Si les deux devise sont égaux, on les additiones et on retourne le résultat. Sinon, on converti la devise en dollars en euro
avec le coefficiant 0.9

Un mail est envoyé par le biai de la fonction PHP mail() qui résume le calcul.

Le calculateur fonctionne avec une seul route (/) qui accepte deux méthodes (GET et POST)

J'ai utilisé un component Alert pour afficher une alerte dans certains cas de figure:
- Tous les champs ne sont pas renseigné
- Les montants ne sont pas des nombres
- Les devises renseignés ne sont pas correct (supporté par le calculateur)

### Possibilité pour l'avenir ?

1) Rendre l'outil plus puissant en utilisant le taux de change 
en direct ou pouvoir renseigné le taux de change depuis le formulaire.

#### Comment ?

Utilisé une API par exemple [Devises.zone](https://devises.zone/api) qui converti un montant ou bien ajouter un champ qui permet
de renseigné le taux de change d'une devise vers une autre

2) Ajouter plusieurs devises dans la calculateur

#### Comment ?

Cela demanderai de revoir une partie d'un controller, pourquoi ne pas stocker les devises dans une base de données ?
Ce qui nous permettrai dans la fonction de vérification de devise de vérifier si la devise renseigné est bien présente dans la base de données.

Pour l'affichage du form, utiliser le model Devise et les lister pour les listes déroulantes.

Utiliser une API pour convertir une devise en euro serait relativement utile et simple pour l'utilisateur du calculateur
