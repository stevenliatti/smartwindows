-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema smartwindows
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema smartwindows
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `smartwindows` DEFAULT CHARACTER SET latin1 ;
USE `smartwindows` ;

-- -----------------------------------------------------
-- Table `smartwindows`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `smartwindows`.`users` ;

CREATE TABLE IF NOT EXISTS `smartwindows`.`users` (
  `id` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL,
  `role` VARCHAR(20) CHARACTER SET 'latin1' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `smartwindows`.`state`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `smartwindows`.`state` ;

CREATE TABLE IF NOT EXISTS `smartwindows`.`state` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `config_mode` VARCHAR(1) NOT NULL,
  `window` VARCHAR(1) NOT NULL,
  `blind` VARCHAR(2) NOT NULL,
  `date` DATE NOT NULL,
  `time` TIME NOT NULL,
  `users_id` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`, `users_id`),
  INDEX `fk_state_users_idx` (`users_id` ASC),
  CONSTRAINT `fk_state_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `smartwindows`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
