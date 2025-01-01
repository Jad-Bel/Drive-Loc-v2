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