/*
 Navicat Premium Dump SQL

 Source Server         : BieneresRaices
 Source Server Type    : MySQL
 Source Server Version : 100625 (10.6.25-MariaDB-ubu2204)
 Source Host           : localhost:3306
 Source Schema         : bienesraices

 Target Server Type    : MySQL
 Target Server Version : 100625 (10.6.25-MariaDB-ubu2204)
 File Encoding         : 65001

 Date: 10/04/2026 15:17:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for propiedades
-- ----------------------------
DROP TABLE IF EXISTS `propiedades`;
CREATE TABLE `propiedades`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `imagen` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `descripcion` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  `habitaciones` int NULL DEFAULT NULL,
  `wc` int NULL DEFAULT NULL,
  `estacionamiento` int NULL DEFAULT NULL,
  `creado` date NULL DEFAULT NULL,
  `vendedores_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_propiedades_vendedores_idx`(`vendedores_id` ASC) USING BTREE,
  CONSTRAINT `fk_propiedades_vendedores` FOREIGN KEY (`vendedores_id`) REFERENCES `vendedores` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of propiedades
-- ----------------------------
INSERT INTO `propiedades` VALUES (27, ' Casa en la alberca', 4500000.00, '3397b2a0f847c1aa05a4fdef2a5d7bc4.jpg', 'Casa en la alberca con bonita vista al lago para que la pases bien con tu familia y amigos, no te pierdas esta hermosa casa', 5, 5, 3, '2024-10-12', 12);
INSERT INTO `propiedades` VALUES (28, ' Casa en el bosque', 900000.00, '9055ce672e598f97e317ff333d2922e8.jpg', 'Hermosa casa en el bosque con multiples campos, para mayor informaci├│n le pedimos que se contacte con nostros', 7, 8, 5, '2024-10-12', 10);
INSERT INTO `propiedades` VALUES (29, ' Casa en la ciudad', 2000000.00, '82ae4b3ddd7de3e46b81d6dd283ed287.jpg', 'Casa en la ciudad con buen ambiente y accesibilidad a muchos lugares con vista a parque recreativo en lugar muy accesible', 8, 7, 5, '2024-10-12', 13);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Administrador');
INSERT INTO `roles` VALUES (2, 'Cliente');
INSERT INTO `roles` VALUES (3, 'Asesor');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `password` char(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `rolId` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_usuarios_roles`(`rolId` ASC) USING BTREE,
  CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`rolId`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usuarios
-- ----------------------------

-- ----------------------------
-- Table structure for vendedores
-- ----------------------------
DROP TABLE IF EXISTS `vendedores`;
CREATE TABLE `vendedores`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `apellido` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `telefono` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of vendedores
-- ----------------------------
INSERT INTO `vendedores` VALUES (10, ' Juan', 'De la torre', '75417452', 'juan@gmail.com', 'ccb37fe79cb5ef369931b3c988eafd56.jpg');
INSERT INTO `vendedores` VALUES (11, ' Karen', 'Perez', '71214173', 'karen@gmail.com', 'ccf763e702fda7e1fdcbc9ae686458bf.jpg');
INSERT INTO `vendedores` VALUES (12, ' Javier', 'Sánchez', '74125365', 'hs21002@gmail.com', 'a0a6ab342b31e44bc493bc9a2e0d4033.jpg');
INSERT INTO `vendedores` VALUES (13, ' Elizabeth', 'Ruiz', '72498173', 'elizabeth@gmail.com', 'cffce0f79a838d0dd7e381e723cce414.jpg');

SET FOREIGN_KEY_CHECKS = 1;
