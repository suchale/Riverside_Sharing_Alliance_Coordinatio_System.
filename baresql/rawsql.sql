/*creating tables SQL*/

-- -----------------------------------------------------
-- Table `RSACS`.`City`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`City` (
  `city_id` INT NOT NULL AUTO_INCREMENT,
  `cityName` VARCHAR(90) NULL,
  `state` VARCHAR(20) NULL,
  `zipcode` VARCHAR(25) NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`city_id`))



-- -----------------------------------------------------
-- Table `RSACS`.`Site`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`Site` (
  `site_id` INT NOT NULL AUTO_INCREMENT,
  `shortName` VARCHAR(45) NULL,
  `addressLine1` VARCHAR(500) NULL,
  `addressLine2` VARCHAR(500) NULL,
  `phoneNumber` VARCHAR(25) NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `city_id` INT NOT NULL,
  PRIMARY KEY (`site_id`, `city_id`),
  INDEX `fk_Site_City1_idx` (`city_id` ASC),
  CONSTRAINT `fk_Site_City1`
    FOREIGN KEY (`city_id`)
    REFERENCES `RSACS`.`City` (`city_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table `RSACS`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`User` (
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
    REFERENCES `RSACS`.`Site` (`site_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table `RSACS`.`Service`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`Service` (
  `service_id` INT NOT NULL AUTO_INCREMENT,
  `sName` VARCHAR(255) NULL,
  `site_id` INT NOT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`service_id`, `site_id`),
  INDEX `fk_Service_Site1_idx` (`site_id` ASC),
  CONSTRAINT `fk_Service_Site1`
    FOREIGN KEY (`site_id`)
    REFERENCES `RSACS`.`Site` (`site_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table `RSACS`.`Shelter`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`Shelter` (
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
    REFERENCES `RSACS`.`Service` (`service_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table `RSACS`.`RoomWaitlist`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`RoomWaitlist` (
  `hofClient_id` INT NOT NULL,
  `sShelter_id` INT NOT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '	',
  PRIMARY KEY (`hofClient_id`, `sShelter_id`),
  INDEX `fk_RoomWaitlist_Shelter1_idx` (`sShelter_id` ASC),
  CONSTRAINT `fk_RoomWaitlist_Shelter1`
    FOREIGN KEY (`sShelter_id`)
    REFERENCES `RSACS`.`Shelter` (`sShelter_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table `RSACS`.`Family`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`Family` (
  `mOFClient_id` VARCHAR(45) NOT NULL,
  `hOFclient_id` INT NOT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`hOFclient_id`, `mOFClient_id`),
  INDEX `fk_Family_RoomWaitlist1_idx` (`hOFclient_id` ASC),
  CONSTRAINT `fk_Family_RoomWaitlist1`
    FOREIGN KEY (`hOFclient_id`)
    REFERENCES `RSACS`.`RoomWaitlist` (`hofClient_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table `RSACS`.`Request`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`Request` (
  `request_id` INT NOT NULL AUTO_INCREMENT,
  `source_user_id` INT NOT NULL,
  `destination_user_id` INT NOT NULL,
  `Item_id` INT NOT NULL,
  `status` INT NULL DEFAULT 0,
  `RequestedItemCount` INT NULL,
  `Items_provided` INT NULL DEFAULT 0,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`request_id`, `source_user_id`),
  INDEX `fk_Request_User1_idx` (`source_user_id` ASC),
  CONSTRAINT `fk_Request_User1`
    FOREIGN KEY (`source_user_id`)
    REFERENCES `RSACS`.`User` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table `RSACS`.`FoodBank`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`FoodBank` (
  `Request_id` INT NOT NULL,
  `sFoodBank_id` INT NOT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Request_id`, `sFoodBank_id`),
  INDEX `fk_FoodBank_Request1_idx` (`Request_id` ASC),
  INDEX `fk_FoodBank_Service1_idx` (`sFoodBank_id` ASC),
  CONSTRAINT `fk_FoodBank_Request1`
    FOREIGN KEY (`Request_id`)
    REFERENCES `RSACS`.`Request` (`request_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_FoodBank_Service1`
    FOREIGN KEY (`sFoodBank_id`)
    REFERENCES `RSACS`.`Service` (`service_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table `RSACS`.`ItemCategory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`ItemCategory` (
  `category_id` INT NOT NULL AUTO_INCREMENT,
  `categoryName` VARCHAR(45) NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`),
  UNIQUE INDEX `table1_id_UNIQUE` (`category_id` ASC))



-- -----------------------------------------------------
-- Table `RSACS`.`ItemSubCategory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`ItemSubCategory` (
  `subCategory_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`subCategory_id`, `category_id`),
  INDEX `fk_subCategory_Category1_idx` (`category_id` ASC),
  CONSTRAINT `fk_subCategory_Category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `RSACS`.`ItemCategory` (`category_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table `RSACS`.`Item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`Item` (
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
    REFERENCES `RSACS`.`ItemSubCategory` (`subCategory_id` , `category_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table `RSACS`.`FoodBank_Inventory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`FoodBank_Inventory` (
  `Item_id` INT NOT NULL,
  `ItemCount` INT NULL,
  `sFoodBank_id` INT NOT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Item_id`, `sFoodBank_id`),
  INDEX `fk_Item_FoodBank_Item1_idx` (`Item_id` ASC),
  CONSTRAINT `fk_Item_FoodBank_Item1`
    FOREIGN KEY (`Item_id`)
    REFERENCES `RSACS`.`Item` (`Item_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table `RSACS`.`Client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`Client` (
  `client_id` INT NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(255) NOT NULL,
  `lastName` VARCHAR(255) NULL,
  `govtIDNumber` VARCHAR(100) NOT NULL,
  `govtIDTypeDesc` VARCHAR(255) NULL,
  `ContactNumber` VARCHAR(15) NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`client_id`))



-- -----------------------------------------------------
-- Table `RSACS`.`ClientLog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`ClientLog` (
  `Client_id` INT NOT NULL,
  `fieldModified` VARCHAR(45) NULL,
  `OldValue` VARCHAR(1000) NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Client_id`),
  INDEX `fk_ClientLog_Client1_idx` (`Client_id` ASC),
  CONSTRAINT `fk_ClientLog_Client1`
    FOREIGN KEY (`Client_id`)
    REFERENCES `RSACS`.`Client` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table `RSACS`.`FoodPantry`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`FoodPantry` (
  `sFoodPantry_id` INT NOT NULL,
  `description` MEDIUMTEXT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sFoodPantry_id`),
  CONSTRAINT `fk_FoodPantry_Service1`
    FOREIGN KEY (`sFoodPantry_id`)
    REFERENCES `RSACS`.`Service` (`service_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table `RSACS`.`SoupKitchen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`SoupKitchen` (
  `sSoupKitchen_id` INT NOT NULL,
  `Description` MEDIUMTEXT NULL,
  `totalSeatAvailable` INT NULL,
  `createdAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sSoupKitchen_id`),
  CONSTRAINT `fk_SoupKitchen_Service1`
    FOREIGN KEY (`sSoupKitchen_id`)
    REFERENCES `RSACS`.`Service` (`site_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table `RSACS`.`CheckIn`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`CheckIn` (
  `CheckIn_id` INT NOT NULL,
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
    REFERENCES `RSACS`.`Client` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_CheckIn_User1`
    FOREIGN KEY (`user_id`)
    REFERENCES `RSACS`.`User` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_CheckIn_Service1`
    FOREIGN KEY (`service_id`)
    REFERENCES `RSACS`.`Service` (`service_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table `RSACS`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`user` (
  `username` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(32) NOT NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP);


-- -----------------------------------------------------
-- Table `RSACS`.``
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`` (
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` TIMESTAMP NULL);


-- -----------------------------------------------------
-- Table `RSACS`.`user_1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`user_1` (
  `username` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(32) NOT NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP);


-- -----------------------------------------------------
-- Table `RSACS`.`timestamps`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RSACS`.`timestamps` (
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);


-- ------------------------------------------------------
-- View All Entires, Inclusive of all the columns 
-- from Site Table. 
-- ------------------------------------------------------
SELECT * FROM SITE      
-- ------------------------------------------------------
-- Insert records into Site. Assuming all the records are 
-- to be accepted from the Laravel Request OR which ever 
-- MVC Framework suits at the final decision.
-- ------------------------------------------------------
INSERT INTO SITE (shortName,addressLine1,addressLine2,city,zipcode,phoneNumber)
VALUES (
shortName = :shortName,
addressLine1 = :addressLine1,
addressLine2 = :addressLine2,
city = :city,
zipcode = :zipcode,
phoneNumber = :phoneNumber
);
-- ------------------------------------------------------
-- Show the form for editing the specified resource.
-- where $id is the id of the requested resource to be 
-- edited. :site_id -> represents the site_id
-- of the input from the request variable.
-- ------------------------------------------------------
SELECT * FROM SITE WHERE site_id =:site_id LIMIT 1;

-- ------------------------------------------------------
-- Update a Site record, where the values represented
-- with a colon is obtained from request variable.
-- ------------------------------------------------------
UPDATE SITE
SET 
shortName = :shortName,
addressLine1 = :addressLine1,
addressLine2 = :addressLine2,
city = :city,
zipcode = :zipcode,
phoneNumber = :phoneNumber
WHERE site_id =:site_id;

-- ------------------------------------------------------
-- Delete a Site record, with the same 
-- notations from above.
-- ------------------------------------------------------
DELETE FROM SITE
WHERE site_id =:site_id; 

-- ------------------------------------------------------
-- Add a User record, with the same 
-- notations from above.
-- ------------------------------------------------------
INSERT INTO USER (username, password, firstName, lastName, site_id)
VALUES (
username = :username,
password = :password,
firstName = :firstName,
lastName = :lastName,
site_id = :site_id
);
-- ------------------------------------------------------
-- Edit a User record, where the values represented
-- with a colon is obtained from request variable.
-- ------------------------------------------------------
UPDATE USER
SET 
username = :username,
password = :password,
firstName = :firstName,
lastName = :lastName,
site_id = :site_id,
WHERE user_id =:user_id;

-- ------------------------------------------------------
-- Delete a User record, with the same 
-- notations from above.
-- ------------------------------------------------------
DELETE FROM USER
WHERE user_id =:user_id; 

-- ------------------------------------------------------
-- Add a Client record, where the values represented
-- with a colon is obtained from request variable.
-- ------------------------------------------------------
INSERT INTO CLIENT (firstName, lastName, govtIDNumber, govtIDTypeDesc, ContactNumber)
VALUES (
firstName= :firstName,
lastName = :lastName,
govtIDNumber = :govtIDNumber,
govtIDTypeDesc = :govtIDTypeDesc,
ContactNumber = :ContactNumber
);
-- ------------------------------------------------------
-- Edit a Client record, where the values represented
-- with a colon is obtained from request variable.
-- ------------------------------------------------------
UPDATE CLIENT
SET 
firstName= :firstName,
lastName = :lastName,
govtIDNumber = :govtIDNumber,
govtIDTypeDesc = :govtIDTypeDesc,
ContactNumber = :ContactNumber,
WHERE client_id =:client_id;
-- ------------------------------------------------------
-- Delete a Client record, with the same 
-- notations from above.
-- ------------------------------------------------------
DELETE FROM CLIENT
WHERE client_id =:client_id; 
-- ------------------------------------------------------
-- Add a Service record, where the values represented
-- with a colon is obtained from request variable.
-- ------------------------------------------------------
INSERT INTO SERVICE (sName, site_id)
VALUES ({from the request});
-- ------------------------------------------------------
-- Edit a Service record, where the values represented
-- with a colon is obtained from request variable.
-- ------------------------------------------------------
UPDATE SERVICE
SET 
sName= :sName,
site_id = :site_id
WHERE service_id =:service_id;
-- ------------------------------------------------------
-- Delete a Service record, with the same 
-- notations from above.
-- ------------------------------------------------------
DELETE FROM SERVICE
WHERE service_id =:service_id;
-- ------------------------------------------------------
-- Add a FoodBank record, where the values represented
-- with a colon is obtained from request variable.
-- ------------------------------------------------------
INSERT INTO FoodBank (Request_id, sFoodBank_id)
VALUES (
  Request_id =:request_id,
  sFoodBank_id = :sFoodBank_id
);
-- ------------------------------------------------------
-- Edit a FoodBank record, where the values represented
-- with a colon is obtained from request variable.
-- ------------------------------------------------------
UPDATE FoodBank
SET 
Request_id = :Request_id,
sFoodBank_id = :sFoodBank_id
WHERE sFoodBank_id =:sFoodBank_id;
-- ------------------------------------------------------
-- Delete a Service record, with the same 
-- notations from above.
-- ------------------------------------------------------
DELETE FROM SERVICE
WHERE service_id =:service_id;
-- ------------------------------------------------------
-- Add a CheckIn record, where the values represented
-- with a colon is obtained from request variable.
-- ------------------------------------------------------
INSERT INTO CheckIn (client_id, user_id,service_id,description)
VALUES (
  client_id =:client_id,
  user_id = :user_id,
  service_id=:service_id,
  description=:description
);
-- ------------------------------------------------------
-- Edit a CheckIn record, where the values represented
-- with a colon is obtained from request variable.
-- ------------------------------------------------------
UPDATE CheckIn
SET 
 client_id =:client_id,
 user_id = :user_id,
 service_id=:service_id,
 description=:description
WHERE CheckIn_id =:CheckIn_id;
-- ------------------------------------------------------
-- Delete a CheckIn, with the same 
-- notations from above.
-- ------------------------------------------------------
DELETE FROM CheckIn
WHERE CheckIn_id =:CheckIn_id;
-- ------------------------------------------------------
-- Add a FoodPantry record, where the values represented
-- with a colon is obtained from request variable.
-- ------------------------------------------------------
INSERT INTO FoodPantry (description)
VALUES (
  description=:description
);
-- ------------------------------------------------------
-- Edit a FoodPantry record, where the values represented
-- with a colon is obtained from request variable.
-- ------------------------------------------------------
UPDATE FoodPantry
SET 
 description=:description
WHERE sFoodPantry_id =:sFoodPantry_id;
-- ------------------------------------------------------
-- Delete a FoodPantry, with the same 
-- notations from above.
-- ------------------------------------------------------
DELETE FROM FoodPantry
WHERE sFoodPantry_id =:sFoodPantry_id;