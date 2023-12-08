-- mdp super admin
INSERT INTO User (username,password, email, roles) VALUES ('superadmin', 'superadmin', 'changeme@gmail.com', 'ROLE_SUPER_ADMIN'); 

INSERT INTO type_teste (label,description) VALUES ('baton', 'Diagramme en bâton'); 
INSERT INTO type_teste (label,description) VALUES ('horizontal', 'Diagramme horizontal'); 
INSERT INTO type_teste (label,description) VALUES ('radar', 'Diagramme en radar');