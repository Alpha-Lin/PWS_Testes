Apres avoir utilisé `git pull https://github.com/Alpha-Lin/PWS_Testes.git` :
+ `npm install`
+ `npm run dev`

Ensuite configurer le .env en y mettant la connexion à la base de donnée qui s'appel ici `stonksQuizz` ainsi que le server SMTP via MAILER_DNS=gmail+ ..... (voir rapport)

Ensuite :
+ `symfony console doctrine:database:create` 
+ `symfony console make:migration` 
+ `symfony console doctrine:migrations:migrate`

Ensuite lancer le script INSERTION_BASE.sql ou lancer les INSERT suivant : 

```sql
INSERT INTO User (username,password, email, roles) VALUES ('superadmin', 'superadmin', 'changeme@gmail.com', 'ROLE_SUPER_ADMIN');

INSERT INTO type_teste (label,description) VALUES ('baton', 'Diagramme en bâton');
INSERT INTO type_teste (label,description) VALUES ('horizontal', 'Diagramme horizontal');
INSERT INTO type_teste (label,description) VALUES ('radar', 'Diagramme en radar');
```

Les identifiants superadmin sont: username: superadmin, mdp: superadmin. 

Les 3 insertions dans type_teste sont tres importante.

Finalement, lancer `symfony serve`.
