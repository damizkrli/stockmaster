# Abaques Stockage : 
Logiciel de stockage des produits en stock, en hors-stock et des fournitures non répertoriées dans le logiciel officiel de la société Abaques Audiovisuel.

### Contexte :
Abaques Audiovisuel est une entreprise qui fonctionne avec un stock en flux tendu. Il existe trois différents types de stock : le stock, le hors-stock et les fournitures.
Le stock est comptabilisé, le hors-stock est répertorié, mais non déclaré, car il est acheté par le client et récupérer par l'entreprise afin de réaliser une marge de 100% sur le(s) produit(s). Les fournitures ne sont pas comptabilisées, parce que l'activité est trop fastidieuse en l'absence d'un magasinier. Chaque stock est indépendant. En cas de transfert inter-agence, le magasinier à l'initiative du transfert, créer un bon de sortie pour le stock puis un bon d'entrée dans pour l'agence qui reçoit le matériel. L'ADV, s'occupe de l'affectation du matériel si, et seulement si, il est sérialisé. Dans le cas contraire, aucune action n'est requise. Des inventaires sont organisées tous les 3 mois afin d'avoir un visuel sur le stock et le moins de difference possible entre le stock théorique et le stock réel.

### Problématique :
Elle concerne les 3 niveaux de stock :

le stock réel n'est pas juste et crée ainsi des ruptures qui peuvent engendrer des retards pour les chantiers, mais aussi des frais supplémentaires pour la commande de produit de manière rapide (transport express). Les transferts de stock ont également un coût (transporteur DSV).
le hors-stock est rarement répertorié ce qui en fait un stock "fantôme" sur lequel il est difficile de compter. La mauvaise tenue du hors-stock engendre une perte financière indirecte, mais non négligeable
les fournitures ne sont pas répertoriées a cause du coût humain qu'elles engendrent. Cependant, le surplus de quantité exigés par les techniciens, les pertes sur les chantiers

### Solutions
Pour les différents niveaux de stock il est possible de :
mettre en place un outil de gestion stock pour le stock réel : lors de la réception d'un produit, il est comptabilisé dans le stock par un ajout via sa référence, sa désignation, son numéro de série et sa quantité, la date d'ajout et l'agence. La continuité des inventaires trimestriel est également une solution.
Pour le hors-stock, l'utilisation d'un utilitaire de gestion de stock est une obligation afin de procéder à l'utilisation de ce stock et à sa bonne tenue. Un rangement minutieux permet également d'optimiser la cohabitation d'un stock réel avec un stock fictif.
Ce que l'on veut faire
On souhaite donner la possibilité aux stockmans des différentes agences d'administrer les stocks. Ils pourront ajouter, supprimer, modifier ou consulter les 3 niveaux de stock dans le but d'alerter les différentes entités de la disponibilité ou non des produits. Les membres de l'ADV auront également la possibilité de consulter les stocks pour la réalisation des commandes.

### À quoi ressemble l'application
Lors de l'ouverture de l'application, on arrive sur la page d'accueil qui contient 3 tableaux pour les 3 différents stocks. L'application dispose d'une barre de navigation qui contient 3 boutons menant chacun à une page différente qui contient les différents stocks. L'arrivée sur chaque page permet de voir : une barre de recherche, pour effectuer une recherche avec une saisie prédictive et une recherche multicritère. On voit également un tableau qui contient les produits dont l'ordre sera prédéfini par ordre alphabétique. Au-dessus du tableau, on dispose d'un bouton ajouter : ce bouton faire apparaitre une fenêtre modale avec des champs pour ajouter les informations du produit. Lorsque le formulaire est soumis à validation, un message de validation apparaît ou un message d'erreur si une contrainte n'est pas respectées.
