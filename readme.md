#Construire un projet

>symfony new api_rest --full

(--full = toutes les options)

#Faire un objet avec un maker

>symfony console make:entity

 #Creer le sql
 >symfony console make:migration

(voir dossier migrations)

#Envoyer le sql dans la BDD (ORM)
>symfony console doctrine:migration:migrate

#on vide le cache avec la console 
>symfony console cache:clear
