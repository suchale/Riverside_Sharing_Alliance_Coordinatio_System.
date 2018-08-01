-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema rsacs
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema rsacs
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `rsacs` DEFAULT CHARACTER SET utf8 ;
USE `rsacs` ;

-- -----------------------------------------------------
-- Table `rsacs`.`Site`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`Site` (
  `site_id` INT NOT NULL AUTO_INCREMENT,
  `shortName` VARCHAR(45) NULL,
  `addressLine1` VARCHAR(500) NULL,
  `addressLine2` VARCHAR(500) NULL,
  `city` VARCHAR(90) NULL,
  `state` VARCHAR(2) NULL,
  `zipcode` INT NULL,
  `phoneNumber` VARCHAR(15) NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`site_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`User` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `firstName` VARCHAR(255) NULL,
  `lastName` VARCHAR(255) NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `site_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `site_id`),
  INDEX `fk_User_Site1_idx` (`site_id` ASC),
  CONSTRAINT `fk_User_Site1`
    FOREIGN KEY (`site_id`)
    REFERENCES `rsacs`.`Site` (`site_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`Service`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`Service` (
  `service_id` INT NOT NULL AUTO_INCREMENT,
  `sName` VARCHAR(255) NULL,
  `site_id` INT NOT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`service_id`, `site_id`),
  INDEX `fk_Service_Site1_idx` (`site_id` ASC),
  CONSTRAINT `fk_Service_Site1`
    FOREIGN KEY (`site_id`)
    REFERENCES `rsacs`.`Site` (`site_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`ItemCategory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`ItemCategory` (
  `category_id` INT NOT NULL AUTO_INCREMENT,
  `categoryName` VARCHAR(45) NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`),
  UNIQUE INDEX `table1_id_UNIQUE` (`category_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`ItemSubCategory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`ItemSubCategory` (
  `subCategory_id` INT NOT NULL AUTO_INCREMENT,
  `category_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`subCategory_id`, `category_id`),
  INDEX `fk_subCategory_Category1_idx` (`category_id` ASC),
  CONSTRAINT `fk_subCategory_Category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `rsacs`.`ItemCategory` (`category_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`Item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`Item` (
  `Item_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `numberOfUnits` INT NOT NULL DEFAULT 1,
  `expirationDate` DATE NULL,
  `subCategory_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Item_id`, `subCategory_id`, `category_id`),
  INDEX `fk_Item_subCategory1_idx` (`subCategory_id` ASC, `category_id` ASC),
  CONSTRAINT `fk_Item_subCategory1`
    FOREIGN KEY (`subCategory_id` , `category_id`)
    REFERENCES `rsacs`.`ItemSubCategory` (`subCategory_id` , `category_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`Request`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`Request` (
  `request_id` INT NOT NULL AUTO_INCREMENT,
  `source_user_id` INT NOT NULL,
  `destination_user_id` INT NOT NULL,
  `status` INT NULL DEFAULT 0,
  `RequestedItemCount` INT NULL,
  `ItemsProvidedCount` INT NULL DEFAULT 0,
  `Item_id` INT NOT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`request_id`, `source_user_id`, `Item_id`),
  INDEX `fk_Request_User1_idx` (`source_user_id` ASC),
  INDEX `fk_Request_Item1_idx` (`Item_id` ASC),
  CONSTRAINT `fk_Request_User1`
    FOREIGN KEY (`source_user_id`)
    REFERENCES `rsacs`.`User` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Request_Item1`
    FOREIGN KEY (`Item_id`)
    REFERENCES `rsacs`.`Item` (`Item_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`FoodBank`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`FoodBank` (
  `Request_id` INT NOT NULL,
  `sFoodBank_id` INT NOT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Request_id`, `sFoodBank_id`),
  INDEX `fk_FoodBank_Request1_idx` (`Request_id` ASC),
  INDEX `fk_FoodBank_Service1_idx` (`sFoodBank_id` ASC),
  CONSTRAINT `fk_FoodBank_Request1`
    FOREIGN KEY (`Request_id`)
    REFERENCES `rsacs`.`Request` (`request_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_FoodBank_Service1`
    FOREIGN KEY (`sFoodBank_id`)
    REFERENCES `rsacs`.`Service` (`service_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`FoodBank_Inventory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`FoodBank_Inventory` (
  `Item_id` INT NOT NULL,
  `ItemCount` INT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sFoodBank_id` INT NOT NULL,
  PRIMARY KEY (`Item_id`, `sFoodBank_id`),
  INDEX `fk_Item_FoodBank_Item1_idx` (`Item_id` ASC),
  INDEX `fk_FoodBank_Inventory_FoodBank1_idx` (`sFoodBank_id` ASC),
  CONSTRAINT `fk_Item_FoodBank_Item1`
    FOREIGN KEY (`Item_id`)
    REFERENCES `rsacs`.`Item` (`Item_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_FoodBank_Inventory_FoodBank1`
    FOREIGN KEY (`sFoodBank_id`)
    REFERENCES `rsacs`.`FoodBank` (`sFoodBank_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`Family`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`Family` (
  `family_id` INT NOT NULL,
  `familyName` VARCHAR(45) NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`family_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`Client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`Client` (
  `client_id` INT NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(255) NOT NULL,
  `lastName` VARCHAR(255) NULL,
  `is_head` VARCHAR(45) NULL,
  `govtIDNumber` VARCHAR(100) NOT NULL,
  `govtIDTypeDesc` VARCHAR(255) NULL,
  `ContactNumber` VARCHAR(15) NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `family_id` INT NOT NULL,
  PRIMARY KEY (`client_id`, `family_id`),
  INDEX `fk_Client_Family1_idx` (`family_id` ASC),
  CONSTRAINT `fk_Client_Family1`
    FOREIGN KEY (`family_id`)
    REFERENCES `rsacs`.`Family` (`family_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`ClientLog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`ClientLog` (
  `Client_id` INT NOT NULL,
  `fieldModified` VARCHAR(45) NULL,
  `OldValue` VARCHAR(1000) NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Client_id`),
  INDEX `fk_ClientLog_Client1_idx` (`Client_id` ASC),
  CONSTRAINT `fk_ClientLog_Client1`
    FOREIGN KEY (`Client_id`)
    REFERENCES `rsacs`.`Client` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`Shelter`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`Shelter` (
  `sShelter_id` INT NOT NULL,
  `hoursOfOperation` VARCHAR(255) NULL DEFAULT '7PM to 7AM',
  `bunkType` VARCHAR(2) NULL,
  `bunkAvailableCount` INT NULL,
  `familyRoomAvailableCount` INT NULL,
  `description` MEDIUMTEXT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sShelter_id`),
  INDEX `fk_Shelter_Service1_idx` (`sShelter_id` ASC),
  CONSTRAINT `fk_Shelter_Service10`
    FOREIGN KEY (`sShelter_id`)
    REFERENCES `rsacs`.`Service` (`service_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`FoodPantry`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`FoodPantry` (
  `sFoodPantry_id` INT NOT NULL,
  `description` MEDIUMTEXT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sFoodPantry_id`),
  CONSTRAINT `fk_FoodPantry_Service1`
    FOREIGN KEY (`sFoodPantry_id`)
    REFERENCES `rsacs`.`Service` (`service_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`SoupKitchen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`SoupKitchen` (
  `sSoupKitchen_id` INT NOT NULL,
  `Description` MEDIUMTEXT NULL,
  `totalSeatAvailable` INT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sSoupKitchen_id`),
  CONSTRAINT `fk_SoupKitchen_Service1`
    FOREIGN KEY (`sSoupKitchen_id`)
    REFERENCES `rsacs`.`Service` (`site_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`CheckIn`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`CheckIn` (
  `CheckIn_id` INT NOT NULL AUTO_INCREMENT,
  `client_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `service_id` INT NOT NULL,
  `Description` MEDIUMTEXT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CheckIn_id`, `client_id`, `user_id`, `service_id`),
  INDEX `fk_CheckIn_Client1_idx` (`client_id` ASC),
  INDEX `fk_CheckIn_User1_idx` (`user_id` ASC),
  INDEX `fk_CheckIn_Service1_idx` (`service_id` ASC),
  CONSTRAINT `fk_CheckIn_Client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `rsacs`.`Client` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_CheckIn_User1`
    FOREIGN KEY (`user_id`)
    REFERENCES `rsacs`.`User` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_CheckIn_Service1`
    FOREIGN KEY (`service_id`)
    REFERENCES `rsacs`.`Service` (`service_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rsacs`.`RoomWaitList`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsacs`.`RoomWaitList` (
  `shelter_id` INT NOT NULL,
  `family_id` INT NOT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`shelter_id`, `family_id`),
  INDEX `fk_RoomWaitList_Shelter1_idx` (`shelter_id` ASC),
  INDEX `fk_RoomWaitList_Family1_idx` (`family_id` ASC),
  CONSTRAINT `fk_RoomWaitList_Shelter1`
    FOREIGN KEY (`shelter_id`)
    REFERENCES `rsacs`.`Shelter` (`sShelter_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_RoomWaitList_Family1`
    FOREIGN KEY (`family_id`)
    REFERENCES `rsacs`.`Family` (`family_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
