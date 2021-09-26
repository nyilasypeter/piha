CREATE SCHEMA `piha` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci ;

CREATE TABLE `appuser` (
  `id` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `emailaddress` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `motto` varchar(1000) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `webpageurl` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UK_ee3cmxp6jvhe7rqksp12a80w5` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_hungarian_ci;

CREATE TABLE `message` (
  `id` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `textmessage` longtext COLLATE utf8_hungarian_ci,
  `type` int DEFAULT NULL,
  `author_id` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK9m8tjl8bgbboe0x90e6trrpui` (`author_id`),
  CONSTRAINT `FK9m8tjl8bgbboe0x90e6trrpui` FOREIGN KEY (`author_id`) REFERENCES `appuser` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_hungarian_ci;

CREATE TABLE `message_addressees` (
  `message_id` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `addressees_id` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  KEY `FK9iqy8bst60qhm4eqnt6dhvuro` (`addressees_id`),
  KEY `FK99ieo5b1qa297ewifxw3rycst` (`message_id`),
  CONSTRAINT `FK99ieo5b1qa297ewifxw3rycst` FOREIGN KEY (`message_id`) REFERENCES `message` (`id`),
  CONSTRAINT `FK9iqy8bst60qhm4eqnt6dhvuro` FOREIGN KEY (`addressees_id`) REFERENCES `appuser` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_hungarian_ci;

CREATE TABLE `movie` (
  `id` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `description` longtext COLLATE utf8_hungarian_ci,
  `genre` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_hungarian_ci;

CREATE TABLE `movieobject` (
  `id` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `description` longtext COLLATE utf8_hungarian_ci,
  `name` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `price` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_hungarian_ci;

insert into movie (id, title, description, genre) values ('1', 'Star Wars - A new hope', 'Luke Skywalker joins forces with a Jedi Knight, a cocky pilot, a Wookiee, and two droids to save the galaxy from the Empires world-destroying battle-station, while also attempting to rescue Princess Leia from the evil Darth Vader.', ' Action, Adventure, Fantasy');
insert into movie (id, title, description, genre) values ('2', 'Star Wars - The Empire Strikes Back', 'After the rebels are overpowered by the Empire on their newly established base, Luke Skywalker begins Jedi training with Master Yoda. His friends accept shelter from a questionable ally as Darth Vader hunts them in a plan to capture Luke.', ' Action, Adventure, Fantasy');
insert into movie (id, title, description, genre) values ('3', 'Star Wars - Return of the Jedi', 'After a daring mission to rescue Han Solo from Jabba the Hutt, the rebels dispatch to Endor to destroy a more powerful Death Star. Meanwhile, Luke struggles to help Vader back from the dark side without falling into the Emperors trap.', ' Action, Adventure, Fantasy');
insert into appuser (id, name, sex, emailaddress, password, webpageurl, motto) values ('1', 'Yoda', 'm', 'yoda@lucasarts.com', 'NoSecretsATrueJediHas', 'http://www.starwars.com/databank/yoda', 'I don''t know how old I am.');
insert into appuser (id, name, sex, emailaddress, password, webpageurl, motto) values ('2', 'Darth Vader', 'm', 'darth@lucasarts.com', 'IamYourFather', 'http://www.starwars.com/databank/darth-vader', 'I see a red door and I want it paint it back');
insert into appuser (id, name, sex, emailaddress, password, webpageurl, motto) values ('3', 'Princess Leia', 'f', 'lea@lucasarts.com', 'IwishIhaveChoosenTheWookieInstead', 'http://starwars.wikia.com/wiki/Leia_Organa_Solo', '');
insert into movieobject (id, name, description, price) values(1, 'Princess Lea figure', 'A beautiful, handpainted lively model of the young Lea', 3500);
insert into movieobject (id, name, description, price) values(2, 'Yoda figure', 'A beautiful, handpainted exclusvely-green model of Yoda', 3600);
insert into movieobject (id, name, description, price) values(3, 'Full Darth Veder Armor', 'A full-sized authentic costume of Darth-veder with boots, trousers, robe, mask and a beutifully cracted light-sword.', 214750);

