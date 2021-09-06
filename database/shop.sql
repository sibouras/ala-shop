DROP DATABASE IF EXISTS `shop`;
CREATE DATABASE `shop`;
USE `shop`;

#
# TABLE STRUCTURE FOR: users
#
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userID` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'to identify user',
  `userName` VARCHAR(255) NOT NULL UNIQUE COMMENT 'username to login',
  `password` VARCHAR(255) NOT NULL COMMENT 'password to login',
  `email` VARCHAR(255) NOT NULL,
  `fullName` VARCHAR(255) NOT NULL,
  `groupID` INT NOT NULL DEFAULT 0 COMMENT 'identify user group',
  `regStatus` INT NOT NULL DEFAULT 0 COMMENT 'user approval',
  `date` DATE NOT NULL,
  `image` VARCHAR(255) NOT NULL DEFAULT 'default.png'
);

#
# TABLE STRUCTURE FOR: categories
#
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL UNIQUE,
  `description` TEXT NOT NULL,
  `ordering` INT DEFAULT NULL,
  `visibility` INT NOT NULL,
  `allowComments` tinyint(4) NOT NULL,
  `allowAds` TINYINT(4) NOT NULL
);

#
# TABLE STRUCTURE FOR: items
#
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `price` VARCHAR(255) NOT NULL,
  `add_date` DATE NOT NULL,
  `country_made` VARCHAR(255) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `status` VARCHAR(255) NOT NULL,
  `rating` SMALLINT NOT NULL,
  `category_id` INT NOT NULL,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

#
# TABLE STRUCTURE FOR: reviews
#
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `rating` TINYINT NOT NULL,
  `comment` TEXT NOT NULL,
  `date` DATE NOT NULL,
  `item_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`userID`) ON DELETE CASCADE ON UPDATE CASCADE
);

#
# TABLE STRUCTURE FOR: cart
#
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `item_id` INT NOT NULL,
  `quantity` INT NOT NULL DEFAULT 1,
  `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

#
# TABLE STRUCTURE FOR: wishlist
#
DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `item_id` INT NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

#
# TABLE STRUCTURE FOR: orders
#
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `total` FLOAT NOT NULL DEFAULT '0',
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `country` VARCHAR(255) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `zip` VARCHAR(255) NULL,
  `city` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  `createdAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);


#
# DATA
#
INSERT INTO `users` (
    `userID`,
    `userName`,
    `password`,
    `email`,
    `fullName`,
    `groupID`,
    `regStatus`,
    `date`,
    `image`
  )
VALUES (
    NULL,
    'ala',
    SHA1('123'),
    'ala@gmail.com',
    'Ala Marzouk',
    '1',
    '1',
    '2021-01-10',
    '25.jpg'
  ),
  (
    NULL,
    'bob',
    SHA1('bob'),
    'bob@gmail.com',
    'Bob Ross',
    '0',
    '1',
    '2021-01-17',
    'bob-ross.jpg'
  ),
  (
    NULL,
    'freddie',
    SHA1('freddie'),
    'freddie@hotmail.com',
    'Freddie Mercury',
    '0',
    '1',
    '2021-02-11',
    'freddie-mercury.jpg'
  ),
  (
    NULL,
    'michael',
    SHA1('michael'),
    'michael@outlook.com',
    'Michael Jackson',
    '0',
    '1',
    '2021-02-18',
    'michael-jackson.jpg'
  ),
  (
    NULL,
    'pablo',
    SHA1('pablo'),
    'pablo@gmail.com',
    'Pablo Escobar',
    '0',
    '1',
    '2021-03-18',
    'pablo-escobar.jpg'
  ),
  (
    NULL,
    'scarlett',
    SHA1('scarlett'),
    'scarlett@gg.com',
    'Scarlett Johansson',
    '0',
    '1',
    '2021-04-02',
    'scarlett-johansson.jpg'
  ),
  (
    NULL,
    'cristiano',
    SHA1('cristiano'),
    'cristiano@soccer.com',
    'Cristiano Ronaldo',
    '0',
    '1',
    '2021-04-25',
    'cristiano-ronaldo.jpg'
  ),
  (
    NULL,
    'dwayne',
    SHA1('dwayne'),
    'dwayne@movie.com',
    'Dwayne Johnson',
    '0',
    '1',
    '2021-05-04',
    'dwayne-johnson.jpg'
  );


INSERT INTO `categories` (
    `name`,
    `description`,
    `ordering`,
    `visibility`,
    `allowComments`,
    `allowAds`
  )
VALUES (
    'Smartphone',
    'smartphones with best prices ',
    '1',
    '0',
    '0',
    '0'
  ),
  (
    'Laptop',
    'New powerful laptops',
    '2',
    '0',
    '1',
    '0'
  ),
  (
    'Desktop',
    'New powerful Desktops',
    '3',
    '0',
    '1',
    '1'
  ),
  (
    'Mice',
    'Gaming mice',
    '5',
    '1',
    '1',
    '0'
  ),
  (
    'Keyboard',
    'Mechanical keyboards',
    '6',
    '1',
    '0',
    '1'
  );


INSERT INTO `items` (
    `name`,
    `description`,
    `price`,
    `add_date`,
    `country_made`,
    `image`,
    `status`,
    `rating`,
    `category_id`
  )
VALUES (
    'acer predator helios 300',
    'Acer Predator Helios 300 Gaming Laptop, Intel i7-10750H, NVIDIA GeForce RTX 3060 Laptop GPU, 15.6" Full HD 144Hz 3ms IPS Display, 16GB DDR4, 512GB NVMe SSD, WiFi 6, RGB Keyboard, PH315-53-71HN',
    '1345.99',
    '2021-05-02',
    'china',
    'acer predator helios 300.jpg',
    '1',
    '4',
    '2'
  ),
  (
    'ASUS ROG Strix G15',
    'ASUS ROG Strix G15 (2021) Gaming Laptop, 15.6” 144Hz IPS Type FHD Display, NVIDIA GeForce RTX 3060, AMD Ryzen 9 5900HX, 16GB DDR4, 512GB PCIe NVMe SSD, RGB Keyboard, Windows 10, G513QM-ES94',
    '1558.82',
    '2021-05-04',
    'us',
    'ASUS ROG Strix G15.jpg',
    '1',
    '3',
    '2'
  ),
  (
    '2020 HP 14 inch',
    '2020 HP 14 inch HD Laptop, Intel Celeron N4020 up to 2.8 GHz, 4GB DDR4, 64GB eMMC Storage, WiFi 5, Webcam, HDMI, Windows 10 S /Legendary Accessories (Google Classroom or Zoom Compatible) (Rose Gold)',
    '399.99',
    '2021-05-24',
    'canada',
    '2020 HP 14 inch.jpg',
    '1',
    '4',
    '2'
  ),
  (
    'Acer Chromebook',
    'Acer Chromebook Spin 311 Convertible Laptop, Intel Celeron N4020, 11.6" HD Touch, 4GB LPDDR4, 32GB eMMC, Gigabit Wi-Fi 5, Bluetooth 5.0, Google Chrome, CP311-2H-C679',
    '257.29',
    '2021-05-30',
    'us',
    'Acer Chromebook.jpg',
    '1',
    '4',
    '2'
  ),
  (
    'Moto G Power',
    'Moto G Power | 3-Day Battery1 | Unlocked | Made for US by Motorola | 4/64GB | 16MP Camera | 2020 | Black',
    '249.99',
    '2021-05-27',
    'australia',
    'Moto G Power.jpg',
    '1',
    '4',
    '1'
  ),
  (
    'Samsung Galaxy A01',
    'TracFone Samsung Galaxy A01 4G LTE Prepaid Smartphone - Black - 16GB - Sim Card Included -CDMA',
    '59.00',
    '2021-05-29',
    'germany',
    'Samsung Galaxy A01.jpg',
    '1',
    '2',
    '1'
  ),
  (
    'Samsung Galaxy Note 20',
    'Samsung Galaxy Note 20 5G Factory Unlocked Android Cell Phone, US Version, 128GB of Storage, Mobile Gaming Smartphone, Long-Lasting Battery, Mystic Gray',
    '799.99',
    '2021-05-30',
    'us',
    'Samsung Galaxy Note 20.jpg',
    '1',
    '4',
    '1'
  ),
  (
    'Apple iPhone 8',
    'Apple iPhone 8, 64GB, Gold - Fully Unlocked (Renewed)',
    '599.99',
    '2021-05-30',
    'poland',
    'Apple iPhone 8.jpg',
    '1',
    '4',
    '1'
  ),
  (
    'CyberpowerPC Gamer',
    'CyberpowerPC Gamer Xtreme VR Gaming PC, Intel i5-10400F 2.9GHz, GeForce GTX 1660 Super 6GB, 8GB DDR4, 500GB NVMe SSD, Wi-Fi Ready & Windows 10 Home (GXiVR8060A10)',
    '949.99',
    '2021-05-10',
    'italy',
    'CyberpowerPC Gamer.jpg',
    '1',
    '4',
    '3'
  ),
  (
    'OMEN - GT13-0090 30L',
    'OMEN - GT13-0090 30L Gaming Desktop PC, NVIDIA GeForce RTX 3090 Graphics Card, 10th Generation Intel Core i9-10850K Processor, 32 GB RAM, 1 TB SSD, Windows 10 Home (GT13-0090, 2020) Shadow black',
    '4193.00',
    '2021-08-30',
    'us',
    'OMEN - GT13-0090 30L.jpg',
    '1',
    '4',
    '3'
  ),
  (
    'iBUYPOWER Gaming PC',
    'iBUYPOWER Gaming PC Computer Desktop Element Mini 9300 (AMD Ryzen 3 3100 3.6GHz, AMD Radeon RX 550 2GB, 8GB DDR4 RAM, 240GB SSD, Wi-Fi Ready, Windows 10 Home)',
    '609.92',
    '2021-08-30',
    'us',
    'iBUYPOWER Gaming PC.jpg',
    '1',
    '4',
    '3'
  ),
  (
    'Glorious Model O-',
    'Glorious Model O- (Minus) Gaming Mouse, Glossy White (GOM-GWHITE)',
    '81.82',
    '2021-08-30',
    'us',
    'Glorious Model O-.jpg',
    '1',
    '4',
    '4'
  ),
  (
    'Logitech G203',
    'Logitech G203 Wired Gaming Mouse, 8,000 DPI, Rainbow Optical Effect LIGHTSYNC RGB, 6 Programmable Buttons, On-Board Memory, Screen Mapping, PC/Mac Computer and Laptop Compatible - Black',
    '29.99',
    '2021-08-30',
    'us',
    'Logitech G203.jpg',
    '1',
    '4',
    '4'
  ),
  (
    'KINESIS Gaming',
    'KINESIS Gaming Freestyle Edge RGB Split Mechanical Keyboard (MX Red)',
    '199.00',
    '2021-08-31',
    'us',
    'KINESIS Gaming.jpg',
    '1',
    '4',
    '5'
  );


INSERT INTO `reviews` (
    `id`,
    `rating`,
    `comment`,
    `date`,
    `item_id`,
    `user_id`
  )
VALUES (
    NULL,
    '4',
    'very good product',
    '2021-04-29',
    '13',
    '5'
  ),
  (
    NULL,
    '3',
    'not very good',
    '2021-05-23',
    '12',
    '2'
  );
