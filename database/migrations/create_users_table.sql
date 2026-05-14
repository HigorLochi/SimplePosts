CREATE TABLE IF NOT EXISTS `simple_posts`.`users` (
    `id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `isadmin` BOOLEAN NOT NULL
)