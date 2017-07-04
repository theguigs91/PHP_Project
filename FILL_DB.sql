USE 'asana_like';

INSERT INTO users (name, email, password) VALUES('Presci', 'san_p@epita.fr', 'password');

INSERT INTO project (name) VALUES('PHP Project');

INSERT INTO category (name, project_id) VALUES('Back end', 1);
INSERT INTO category (name, project_id) VALUES('Front end', 1);
INSERT INTO category (name, project_id) VALUES('Base de données', 1);

INSERT INTO task (description, category_id, project_id) VALUES('Assigner tâches', 1, 1);
INSERT INTO task (description, category_id, project_id) VALUES('Refaire la nav bar', 2, 1);
INSERT INTO task (description, category_id, project_id) VALUES('Remplir la base de données', 3, 1);
INSERT INTO task (description, category_id, project_id) VALUES('Suppression des tâches', 1, 1);

INSERT INTO user_project VALUES(1, 1);

INSERT INTO user_task VALUES(1, 1);
INSERT INTO user_task VALUES(1, 4);
