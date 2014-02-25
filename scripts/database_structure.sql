SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `Noparadellover` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

CREATE TABLE IF NOT EXISTS `Noparadellover`.`project_types` (
  `idproject_type` INT(11) NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idproject_type`),
  UNIQUE INDEX `type_UNIQUE` (`type` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `Noparadellover`.`duties` (
  `idduty` INT(11) NOT NULL AUTO_INCREMENT,
  `duty` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idduty`),
  UNIQUE INDEX `idduty_UNIQUE` (`idduty` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '	';

CREATE TABLE IF NOT EXISTS `Noparadellover`.`companies` (
  `idcompany` INT(11) ZEROFILL NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcompany`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `Noparadellover`.`projects` (
  `idproject` INT(11) NOT NULL AUTO_INCREMENT,
  `alias` VARCHAR(45) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `tweet` VARCHAR(140) NOT NULL,
  `budget` DOUBLE NULL DEFAULT NULL,
  `date_ini` DATE NULL DEFAULT NULL,
  `date_fini` DATE NULL DEFAULT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `project_types_idproject_type` INT(11) NOT NULL,
  `companies_idcompany` INT(11) ZEROFILL NOT NULL,
  PRIMARY KEY (`idproject`),
  UNIQUE INDEX `alias_UNIQUE` (`alias` ASC),
  INDEX `fk_projects_project_types_idx` (`project_types_idproject_type` ASC),
  INDEX `fk_projects_companies1_idx` (`companies_idcompany` ASC),
  CONSTRAINT `fk_projects_project_types`
    FOREIGN KEY (`project_types_idproject_type`)
    REFERENCES `Noparadellover`.`project_types` (`idproject_type`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_projects_companies1`
    FOREIGN KEY (`companies_idcompany`)
    REFERENCES `Noparadellover`.`companies` (`idcompany`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `Noparadellover`.`teams` (
  `projects_idproject` INT(11) NOT NULL,
  `users_iduser` INT(11) NOT NULL,
  `duties_idduty` INT(11) NOT NULL,
  PRIMARY KEY (`projects_idproject`, `users_iduser`, `duties_idduty`),
  INDEX `fk_projects_has_users_users1_idx` (`users_iduser` ASC),
  INDEX `fk_projects_has_users_projects1_idx` (`projects_idproject` ASC),
  INDEX `fk_teams_duties1_idx` (`duties_idduty` ASC),
  CONSTRAINT `fk_projects_has_users_projects1`
    FOREIGN KEY (`projects_idproject`)
    REFERENCES `Noparadellover`.`projects` (`idproject`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_projects_has_users_users1`
    FOREIGN KEY (`users_iduser`)
    REFERENCES `mydb`.`users` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_teams_duties1`
    FOREIGN KEY (`duties_idduty`)
    REFERENCES `Noparadellover`.`duties` (`idduty`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
