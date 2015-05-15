DROP DATABASE IF EXISTS `articles`;
Create DATABASE `articles`;

DROP TABLE `articles`.`tb_articles`;

CREATE TABLE IF NOT EXISTS `articles`.`tb_articles`
(
    id INT NOT NULL AUTO_INCREMENT,
    header VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Заголовок',
    text TEXT NOT NULL DEFAULT '' COMMENT 'Новость',
    date DATETIME NOT NULL COMMENT 'Дата добавления',
    INDEX ixHeader (header),    
    PRIMARY KEY (id)
) COMMENT 'Таблица авторизации'
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
