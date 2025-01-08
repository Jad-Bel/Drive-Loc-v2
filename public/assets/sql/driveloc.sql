CREATE TABLE `role` (
  `role_id` int NOT NULL PRIMARY KEY,
  `role_name` varchar(50) NOT NULL
)

CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `role_id` int NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_last` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_pw` varchar(255) NOT NULL
)

ALTER TABLE `users`
    FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

create table categorie (
	categorie_id int not null AUTO_INCREMENT PRIMARY KEY,
  ctg_name VARCHAR(50) not null
);

CREATE TABLE `vehicule` (
  `vehicule_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `categorie_id` int NOT NULL,
  `marque` varchar(50) NOT NULL,
  `disponibilite` tinyint DEFAULT '0',
  `prix` decimal(10,4) DEFAULT NULL,
  `description` text
)

ALTER TABLE vehicule
ADD FOREIGN KEY (categorie_id) REFERENCES categorie(categorie_id);


CREATE TABLE avis (
	avis_id int not null AUTO_INCREMENT PRIMARY key,
  user_id int not null, 
  vehicule_id int not null, 
  avis text,
  foreign key (user_id) REFERENCES users(user_id),
  FOREIGN key (vehicule_id) REFERENCES vehicule(vehicule_id)
);

CREATE TABLE reservation (
    rsv_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    user_id INT NOT NULL,                           
    vehicule_id INT NOT NULL,                       
    date_rsv DATE NOT NULL,                         
    date_pickup DATE NOT NULL,                      
    date_return DATE NOT NULL,                      
    lieu_pickup VARCHAR(255) NOT NULL,              
    lieu_return VARCHAR(255) NOT NULL,              
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (vehicule_id) REFERENCES vehicule(vehicule_id)
);

CREATE TABLE themes (
    thm_id INT PRIMARY KEY AUTO_INCREMENT,
    thm_nom VARCHAR(50) NOT NULL
);

CREATE TABLE articles (
    art_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    content VARCHAR(1000) NOT NULL,
    user_id INT NOT NULL,
    creation_date DATE NOT NULL,
    thm_id INT,
    status TINYINT DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (thm_id) REFERENCES themes(thm_id)
);

CREATE TABLE tags (
    tag_id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL
);

CREATE TABLE commentaires (
    comm_id INT PRIMARY KEY AUTO_INCREMENT,
    content TEXT NOT NULL,
    creation_date DATETIME NOT NULL,
    art_id INT,
    FOREIGN KEY (art_id) REFERENCES articles(art_id)
);

CREATE TABLE favoris (
    user_id INT,
    article_id INT,
    PRIMARY KEY (user_id, article_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (article_id) REFERENCES articles(art_id)
);

CREATE TABLE article_tags (
    art_id INT,
    tag_id INT,
    PRIMARY KEY (art_id, tag_id),
    FOREIGN KEY (art_id) REFERENCES articles(art_id),
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id)
);


-- get all articles with their authors
SELECT a.art_id, a.title, CONCAT(u.user_name, ' ', u.user_last) AS author
FROM articles a
JOIN users u ON a.user_id = u.user_id;

-- get all articles with their themes
SELECT a.title, t.thm_nom
FROM articles a
JOIN themes t ON a.thm_id = t.thm_id;

-- get all comment for an article
SELECT a.title, c.content, c.creation_date
FROM articles a
JOIN commentaires c ON a.art_id = c.art_id;

-- get all articles with their tags
SELECT a.title, t.nom AS tag_name
FROM articles a
JOIN article_tags `at` ON a.art_id = at.art_id
JOIN tags t ON at.tag_id = t.tag_id;

-- get all favorite articles for a user
SELECT u.user_name, a.title
FROM users u
JOIN favoris f ON u.user_id = f.user_id
JOIN articles a ON f.article_id = a.art_id;
