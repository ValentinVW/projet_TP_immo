### Vérifier que tout est OK avec doctrine

php bin/console doctrine:schema:validate


### 1.créer un fichier dans le dossier migration

bin/console make:migration

### 2.pour finir la migration sur la Data Base

bin/console doctrine:migrations:migrate

## DOC POUR DOCTRINE ET MAPPING

https://www.doctrine-project.org/projects/doctrine-orm/en/2.10/reference/basic-mapping.html#basic-mapping

https://symfony.com/doc/current/doctrine.html#migrations-creating-the-database-tables-schema