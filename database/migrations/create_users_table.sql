CREATE TABLE IF NOT EXISTS `simple_posts`.`users` (
    `id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `idphoto` BIGINT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    FOREIGN KEY (idphoto) REFERENCES userphotos(id)
)