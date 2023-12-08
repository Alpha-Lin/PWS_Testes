Apres avoir utilisé git pull https://github.com/Alpha-Lin/PWS_Testes.git il faut installer le projet, il est important de commencer par faire un composer install, puis un npm install suivi d’un npm run dev.

Ensuite, il faut configurer le .env en y mettant la connexion à la base de donnée qui s'appel ici stonksQuizz ainsi que le serveur smtp du mailer avec la ligne suivante : “MAILER_DSN=gmail+smtp://StonksQuizz:zmhn%20iqwb%20jiaz%20osqf%20@default”

La prochaine etape est d’utiliser la commande symfony console doctrine:database:create puis symfony console make:migration et enfin symfony console doctrine:migrations:migrate


Ensuite lancer le script INSERTION_BASE.sql ou lance les INSERT suivant : 

INSERT INTO User (username,password, email, roles) VALUES ('superadmin', 'superadmin', 'changeme@gmail.com', 'ROLE_SUPER_ADMIN');

INSERT INTO type_teste (label,description) VALUES ('baton', 'Diagramme en bâton');
INSERT INTO type_teste (label,description) VALUES ('horizontal', 'Diagramme horizontal');
INSERT INTO type_teste (label,description) VALUES ('radar', 'Diagramme en radar');

Les identifiants superadmin sont: username: superadmin, mdp: superadmin. 

Les 3 insertions dans type_teste sont tres importante.
Finalement, lancer le server en utilisant symfony serve.
