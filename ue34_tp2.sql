--
-- Base de données : `ue34_tp2`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_aut` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_create` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modif` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_aut` (`id_aut`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `id_aut`, `title`, `content`, `date_create`, `date_modif`) VALUES
(1, 1, 'Article type !', '<header>\r\n            <h1>Lorem Ipsum : L\'Art de la Typographie</h1>\r\n            <p><small>Publié le <time datetime=\"2023-10-20\">20 octobre 2023</time> par <strong>Auteur Anonyme</strong></small></p>\r\n        </header>\r\n        \r\n        <section>\r\n            <h2>Introduction</h2>\r\n            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel nisl ut sapien congue accumsan. Proin placerat, sapien sit amet congue porta, augue sapien tincidunt risus, nec iaculis magna lorem ac orci.</p>\r\n        </section>\r\n        \r\n        <section>\r\n            <h2>Un peu d\'histoire</h2>\r\n            <p>Le texte <em>Lorem Ipsum</em> trouve ses origines dans un livre de Cicéron datant de 45 avant J.-C. Le passage suivant est très connu :</p>\r\n            <blockquote>\r\n                \"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\"\r\n            </blockquote>\r\n            <p>Ce texte fictif est utilisé pour remplir les espaces réservés à des fins de mise en page et de design.</p>\r\n        </section>\r\n        \r\n        <section>\r\n            <h2>Les avantages du Lorem Ipsum</h2>\r\n            <p>Voici trois avantages principaux de l\'utilisation du Lorem Ipsum :</p>\r\n            <ul>\r\n                <li>Il permet de se concentrer sur le design sans se distraire par le contenu.</li>\r\n                <li>Les blocs de texte respectent l’apparence d’un texte classique.</li>\r\n                <li>Il est facilement reconnaissable et universellement compris par les designers.</li>\r\n            </ul>\r\n        </section>\r\n        \r\n        <footer>\r\n            <p>Pour aller plus loin, consultez <a href=\"https://fr.wikipedia.org/wiki/Lorem_ipsum\" target=\"_blank\">la page Wikipedia</a> sur le Lorem Ipsum.</p>\r\n        </footer>\r\n', '2025-02-23 20:34:06', '2025-02-23 20:34:06'),
(2, 1, 'Article type 2', '<p>Ceci est un paragraphe simple. Il contient divers éléments pour tester les styles définis dans le fichier CSS.</p>\r\n        \r\n        <p><b>Texte en gras</b> et <strong>texte en fort.</strong></p>\r\n        <p><i>Texte en italique</i> et <em>texteur emphase.</em></p>\r\n        <p><u>Texte souligné</u> et <s>texte barré.</s></p>\r\n        <p><mark>Texte mis en surbrillance</mark> pour vérifier les styles d\'arrière-plan et de police.</p>\r\n        <p><small>Texte plus petit que la taille par défaut.</small></p>\r\n        <p>Voici un morceau de code&nbsp;: <code>console.log(\'Hello World\');</code></p>\r\n        \r\n        <p>Voici une citation inline : <q>L\'imagination est plus importante que le savoir.</q></p>\r\n        \r\n        <blockquote>\r\n            Ceci est une citation longue (blockquote). Elle est utile pour des citations importantes ou des extraits longs.\r\n        </blockquote>\r\n        \r\n        <p>Un exemple avec des indices : H<sub>2</sub>O et des exposants : 3<sup>2</sup>.</p>\r\n        \r\n        <hr>\r\n        \r\n        <p>Voici un lien&nbsp;: <a href=\"https://www.example.com\" target=\"_blank\">Visitez Exemple.com</a></p>\r\n        <p>Survolez le lien pour voir l’effet hover.</p>\r\n', '2025-02-23 20:49:27', '2025-02-23 20:49:27'),
(3, 1, 'Test 35', '<p>Ceci est un <b>texte en gras</b> et un <strong>texte fort</strong>.</p>\r\n    <p>Ceci est un <i>texte en italique</i> et un <em>texte mis en emphase</em>.</p>\r\n    <p>Ceci est un <u>texte souligné</u> et un <s>texte barré</s>.</p>\r\n    <p>Ceci est un <mark>texte surligné</mark> et un <small>texte en petit</small>.</p>\r\n    <p>Un exemple de code : <code>console.log(\"Hello, World!\");</code></p>\r\n    <p>Une citation courte : <q>Le savoir est une arme.</q></p>\r\n    <blockquote>\r\n        Ceci est une citation plus longue, souvent utilisée pour afficher du texte cité d\'une autre source.\r\n    </blockquote>\r\n    <hr>\r\n    <p>Voici un texte avec une <sup>exposant</sup> intégré.</p>\r\n    <p>Voici un lien : <a href=\"https://www.example.com\">Cliquez ici</a></p>\r\n', '2025-02-23 20:52:49', '2025-02-23 20:52:49');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  `id_us` int NOT NULL,
  `content` text NOT NULL,
  `date_create` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modif` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_art` (`article_id`),
  KEY `id_us` (`id_us`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `id_us`, `content`, `date_create`, `date_modif`) VALUES
(1, 1, 1, 'Ceci est un petit commentaire de test\nretour a la ligne !', '2025-02-23 22:23:31', '2025-02-23 22:23:31');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_aut` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` tinyint UNSIGNED NOT NULL DEFAULT '255',
  PRIMARY KEY (`id_aut`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_aut`, `nom`, `prenom`, `username`, `password`, `user_level`) VALUES
(1, 'root', 'root', 'root', '$2y$10$OXjBtWocPWOceKKr1YftSOcjv1cr5.U7C/qfjDXn6iqn2GtL3fmRq', 0),
COMMIT;