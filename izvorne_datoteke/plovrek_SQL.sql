-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema WebDiP2022x026
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema WebDiP2022x026
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `WebDiP2022x026` DEFAULT CHARACTER SET utf8 ;
USE `WebDiP2022x026` ;

-- -----------------------------------------------------
-- Table `WebDiP2022x026`.`tip_korisnika`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2022x026`.`tip_korisnika` (
  `tip_id` INT NOT NULL AUTO_INCREMENT,
  `naziv_tipa` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`tip_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2022x026`.`korisnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2022x026`.`korisnik` (
  `email` VARCHAR(45) NOT NULL,
  `tip_id` INT NOT NULL,
  `ime` VARCHAR(45) NOT NULL,
  `prezime` VARCHAR(45) NOT NULL,
  `datum_rodenja` DATE NOT NULL,
  `spol` CHAR(1) NOT NULL,
  `broj_telefona` VARCHAR(45) NOT NULL,
  `adresa` VARCHAR(45) NOT NULL,
  `korisnicko_ime` VARCHAR(45) NOT NULL,
  `lozinka` VARCHAR(45) NOT NULL,
  `lozinka_sha256` CHAR(64) NOT NULL,
  `nadimak` VARCHAR(45) NOT NULL,
  `slika_profila` VARCHAR(65) NOT NULL,
  `datum_vrijeme_registracije` DATETIME NOT NULL,
  `broj_unosa` INT NOT NULL,
  `status_racuna` TINYINT NOT NULL,
  `uvjeti_koristenja` TINYINT NOT NULL,
  `aktivacijski_kod` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`email`),
  INDEX `fk_korisnik_tip_korisnika_idx` (`tip_id` ASC),
  CONSTRAINT `fk_korisnik_tip_korisnika`
    FOREIGN KEY (`tip_id`)
    REFERENCES `WebDiP2022x026`.`tip_korisnika` (`tip_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2022x026`.`tip_radnje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2022x026`.`tip_radnje` (
  `tip_radnje_id` INT NOT NULL AUTO_INCREMENT,
  `naziv_radnje` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`tip_radnje_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2022x026`.`dnevnik_rada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2022x026`.`dnevnik_rada` (
  `dnevnik_id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `tip_radnje_id` INT NOT NULL,
  `upit` TEXT NOT NULL,
  `radnja` TEXT NOT NULL,
  `datum_vrijeme_zapisa` DATETIME NOT NULL,
  PRIMARY KEY (`dnevnik_id`, `tip_radnje_id`),
  INDEX `fk_dnevnik_rada_tip_radnje1_idx` (`tip_radnje_id` ASC),
  INDEX `fk_dnevnik_rada_korisnik1_idx` (`email` ASC),
  CONSTRAINT `fk_dnevnik_rada_tip_radnje1`
    FOREIGN KEY (`tip_radnje_id`)
    REFERENCES `WebDiP2022x026`.`tip_radnje` (`tip_radnje_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dnevnik_rada_korisnik1`
    FOREIGN KEY (`email`)
    REFERENCES `WebDiP2022x026`.`korisnik` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2022x026`.`registar_bodova`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2022x026`.`registar_bodova` (
  `zapis_bodova_id` INT NOT NULL AUTO_INCREMENT,
  `korisnik_email` VARCHAR(45) NOT NULL,
  `broj_trenutnih_bodova` INT NOT NULL,
  PRIMARY KEY (`zapis_bodova_id`),
  INDEX `fk_registar_bodova_korisnik1_idx` (`korisnik_email` ASC),
  CONSTRAINT `fk_registar_bodova_korisnik1`
    FOREIGN KEY (`korisnik_email`)
    REFERENCES `WebDiP2022x026`.`korisnik` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2022x026`.`kampanja`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2022x026`.`kampanja` (
  `kampanja_id` INT NOT NULL AUTO_INCREMENT,
  `korisnik_email` VARCHAR(45) NOT NULL,
  `naziv_kampanje` VARCHAR(45) NOT NULL,
  `opis_kampanje` TEXT NOT NULL,
  `datum_vrijeme_pocetka` DATETIME NOT NULL,
  `datum_vrijeme_zavrsetka` DATETIME NOT NULL,
  PRIMARY KEY (`kampanja_id`),
  INDEX `fk_kampanja_korisnik1_idx` (`korisnik_email` ASC),
  CONSTRAINT `fk_kampanja_korisnik1`
    FOREIGN KEY (`korisnik_email`)
    REFERENCES `WebDiP2022x026`.`korisnik` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2022x026`.`proizvod`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2022x026`.`proizvod` (
  `proizvod_id` INT NOT NULL AUTO_INCREMENT,
  `moderator_email` VARCHAR(45) NOT NULL,
  `naziv_proizvoda` VARCHAR(45) NOT NULL,
  `opis_proizvoda` TEXT NOT NULL,
  `slika_proizvoda` VARCHAR(65) NOT NULL,
  `kolicina` INT NOT NULL,
  `cijena_proizvoda` FLOAT NOT NULL,
  `bodovi_proizvoda` INT NOT NULL,
  `status_proizvoda` TINYINT NOT NULL,
  PRIMARY KEY (`proizvod_id`),
  INDEX `fk_proizvod_korisnik1_idx` (`moderator_email` ASC),
  CONSTRAINT `fk_proizvod_korisnik1`
    FOREIGN KEY (`moderator_email`)
    REFERENCES `WebDiP2022x026`.`korisnik` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2022x026`.`kampanja_proizvod`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2022x026`.`kampanja_proizvod` (
  `kampanja_id` INT NOT NULL,
  `proizvod_id` INT NOT NULL,
  PRIMARY KEY (`kampanja_id`, `proizvod_id`),
  INDEX `fk_kampanja_proizvod_proizvod1_idx` (`proizvod_id` ASC),
  CONSTRAINT `fk_kampanja_proizvod_kampanja1`
    FOREIGN KEY (`kampanja_id`)
    REFERENCES `WebDiP2022x026`.`kampanja` (`kampanja_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kampanja_proizvod_proizvod1`
    FOREIGN KEY (`proizvod_id`)
    REFERENCES `WebDiP2022x026`.`proizvod` (`proizvod_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2022x026`.`kupnja`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2022x026`.`kupnja` (
  `proizvod_id` INT NOT NULL,
  `korisnik_email` VARCHAR(45) NOT NULL,
  `bodovi_iskoristeni_u_kupnji` INT NOT NULL,
  PRIMARY KEY (`proizvod_id`),
  INDEX `fk_kupnja_proizvod1_idx` (`proizvod_id` ASC),
  INDEX `fk_kupnja_korisnik1_idx` (`korisnik_email` ASC),
  CONSTRAINT `fk_kupnja_proizvod1`
    FOREIGN KEY (`proizvod_id`)
    REFERENCES `WebDiP2022x026`.`proizvod` (`proizvod_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kupnja_korisnik1`
    FOREIGN KEY (`korisnik_email`)
    REFERENCES `WebDiP2022x026`.`korisnik` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2022x026`.`konfiguracija_aplikacje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2022x026`.`konfiguracija_aplikacje` (
  `konfiguracija_id` INT NOT NULL AUTO_INCREMENT,
  `korisnik_email` VARCHAR(45) NOT NULL,
  `opis_konfiguracije` TEXT NOT NULL,
  `status_konfiguracije` TINYINT NOT NULL,
  PRIMARY KEY (`konfiguracija_id`),
  INDEX `fk_konfiguracija_aplikacje_korisnik1_idx` (`korisnik_email` ASC),
  CONSTRAINT `fk_konfiguracija_aplikacje_korisnik1`
    FOREIGN KEY (`korisnik_email`)
    REFERENCES `WebDiP2022x026`.`korisnik` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2022x026`.`dz4_tip_korisnika`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2022x026`.`dz4_tip_korisnika` (
  `id_tipa` INT NOT NULL AUTO_INCREMENT,
  `naziv_tipa` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_tipa`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2022x026`.`dz4_korisnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2022x026`.`dz4_korisnik` (
  `email` VARCHAR(45) NOT NULL,
  `ime` VARCHAR(45) NOT NULL,
  `prezime` VARCHAR(45) NOT NULL,
  `korisnicko_ime` VARCHAR(45) NOT NULL,
  `spol` CHAR(1) NOT NULL,
  `lozinka` VARCHAR(45) NOT NULL,
  `lozinka_sha256` CHAR(64) NOT NULL,
  `id_tipa` INT NOT NULL,
  PRIMARY KEY (`email`),
  INDEX `fk_dz4_korisnik_dz4_tip_korisnika1_idx` (`id_tipa` ASC),
  CONSTRAINT `fk_dz4_korisnik_dz4_tip_korisnika1`
    FOREIGN KEY (`id_tipa`)
    REFERENCES `WebDiP2022x026`.`dz4_tip_korisnika` (`id_tipa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebDiP2022x026`.`dz4_obrazac`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2022x026`.`dz4_obrazac` (
  `id_obrazac` INT NOT NULL AUTO_INCREMENT,
  `naslov` VARCHAR(45) NOT NULL,
  `tip_poruke` VARCHAR(45) NOT NULL,
  `sadrzaj` LONGTEXT NOT NULL,
  `prilog` BLOB NOT NULL,
  `datum` DATETIME NOT NULL,
  `email_primatelj` VARCHAR(45) NOT NULL,
  `email_posiljatelj` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_obrazac`),
  INDEX `fk_dz4_obrazac_dz4_korisnik1_idx` (`email_posiljatelj` ASC),
  CONSTRAINT `fk_dz4_obrazac_dz4_korisnik1`
    FOREIGN KEY (`email_posiljatelj`)
    REFERENCES `WebDiP2022x026`.`dz4_korisnik` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
