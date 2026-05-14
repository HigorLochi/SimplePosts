CREATE TABLE IF NOT EXISTS `simple_posts`.`userphotos` (
    `id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `iduser` BIGINT NOT NULL,
    `filename` VARCHAR(100) NOT NULL,
    `extension` VARCHAR(100) NOT NULL,
    FOREIGN KEY (iduser) REFERENCES users(id)
)