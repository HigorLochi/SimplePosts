CREATE TABLE IF NOT EXISTS `simple_posts`.`posts` (
    `id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `iduser` BIGINT NOT NULL,
    `idimage` BIGINT,
    `title` VARCHAR(255) NOT NULL,
    `text` MEDIUMTEXT NOT NULL,
    FOREIGN KEY (iduser) REFERENCES users(id),
    FOREIGN KEY (idimage) REFERENCES postimages(id)
)