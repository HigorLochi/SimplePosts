CREATE TABLE IF NOT EXISTS `simple_posts`.`postimages` (
    `id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `idpost` BIGINT NOT NULL,
    `filename` VARCHAR(100) NOT NULL,
    `extension` VARCHAR(100) NOT NULL,
    FOREIGN KEY (idpost) REFERENCES posts(id) ON DELETE CASCADE
)