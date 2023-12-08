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

------------------------------

Features
Un dashboard avec de multiples options
+ Si SUPER_ADMIN, création, édition et suppression de compte
+ Consultation et création de compte (utilisateur uniquement), et consultation des testes. 
+ Consultation des testes, de leurs questions et des critères, et modération des labels et descriptions.
+ Consultation des messages
+ Consultation des questions
+ Consultation des criteres
  
Enregistrement sur le site
+ Login avec remember-me
+ Reset du mot de passe via un token envoyé par email
+ Reset du mot de passe via la page profile, si connecté.

Des features utilisateur 
+ Edition du profile et ajout d’un avatar.
+ Création des testes constitué de questions, critères et solutions.
+ Passage de teste, et consultation des essais antérieure.
+ Visualisation des d’un essai, soit passé, soit après redirection
+ Boutons edition, suppression des testes selon le role, et le ownsership.
+ Trie des testes par nom et ownsership.
+ Page contact avec envoie de mail.
