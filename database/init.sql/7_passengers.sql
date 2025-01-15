CREATE TABLE `passengers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `passport` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `booking_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `passengers_booking_id_foreign` (`booking_id`),
  CONSTRAINT `passengers_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `passengers` DISABLE KEYS */;
INSERT INTO `passengers` VALUES
(1,'2025-01-06 18:23:45','2025-01-06 18:23:45','Reinhard Kugler','J123123C','1986-08-22',1),
(2,'2025-01-07 10:26:54','2025-01-07 10:26:54','Johanna','L123123','2025-01-08',2);
