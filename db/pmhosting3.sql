/*
 Navicat Premium Data Transfer

 Source Server         : промышленная-мебель.рус
 Source Server Type    : MySQL
 Source Server Version : 50643
 Source Host           : VH287.spaceweb.ru:3306
 Source Schema         : pmhosting3

 Target Server Type    : MySQL
 Target Server Version : 50643
 File Encoding         : 65001

 Date: 25/12/2020 15:52:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for brand
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `order` int(11) NULL DEFAULT 0,
  `type` int(11) NOT NULL DEFAULT 10,
  `status` int(11) NOT NULL DEFAULT 10,
  `video` varchar(1022) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_keywords` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES (5, 'VIKING', 'viking', 'd07fa94c77a699403ed8a88351f96424.png', 0, 0, 1, 'PSmcnowVzos', 'Промышленная и антистатическая мебель торговой марки VIKING (Викинг) напрямую от изготовителя. Представлена полная линейка промышленной металлической мебели для производства, дополнительного оснащения участка, включая готовые решения для разных отраслей промышленности. \r\n\r\nПромышленная и антистатическая мебель VIKING используется для оснащения рабочего места на электромонтажном, приборостроительном, машиностроительном производстве, а также в ремонтных мастерских, сервисных центрах, исследовательских лабораториях. \r\n\r\nМебель VIKING (Викинг) включает в себя широкий ассортимент продукции: рабочие места различного назначения, верстаки, шкафы сухого хранения, подкатные столы, металлические тумбы, стойки и тележки, металлические шкафы и стеллажи, антистатические стулья и многое другое. \r\n\r\nПромышленная антистатическая мебель VIKING сертифицирована по российскому стандарту ГОСТ Р 53734.5.1-2009 и европейскому стандарту IEC 61340. ', 'Промышленная и антистатическая мебель Викинг', 'Промышленная и антистатическая мебель Викинг', '1');
INSERT INTO `brand` VALUES (6, 'Beltema', 'beltema', '70f76fcfe7f4b0665d3cd2fefb754d57.png', 1, 0, 1, '', 'тест\r\n\r\nТест', 'Промышленная и антистатическая мебель Белтема', 'Промышленная мебель Белтема', NULL);
INSERT INTO `brand` VALUES (7, 'Treston', 'treston', 'e053821051b6146b165cf827d6471a89.png', 3, 0, 1, '', 'test\r\n\r\ntest', 'Промышленная и антистатическая мебель Treston', 'Промышленная и антистатическая мебель Treston', NULL);
INSERT INTO `brand` VALUES (9, 'Актаком', 'aktakom', 'f1a4e8732618af5028c2bd3c49b5a7df.png', 0, 0, 1, '', '', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `parent_id` int(11) NULL DEFAULT 0,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `order` int(10) UNSIGNED NULL DEFAULT 0,
  `type` int(10) UNSIGNED NOT NULL DEFAULT 10,
  `status` int(10) UNSIGNED NOT NULL DEFAULT 10,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `meta_title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_keywords` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `description_short` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `alt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `price_from` float NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 230 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'Серии рабочих мест', 'serii-rabocih-mest', 0, 'Рабочие столы', 0, 10, 1, '2c9cc00f295a961930dc6c87493ba10a.png', NULL, NULL, NULL, 'Серии рабочих мест', 'Серии рабочих мест', 333);
INSERT INTO `category` VALUES (2, 'Промышленная мебель', 'promyslennaa-mebel', 0, '', 0, 10, 1, '310f57dd1a5a121098af01b68ecc984e.png', NULL, '{category_name} в {city_name_pad_1} — широкий ассортимент от ведущих производителей. Купить промышленную мебель со склада и под заказ по низким ценам и заказать: доставку, сборку, выезд эксперта, вид рабочего места, 3D-проект помещения, подготовку ТЗ.', NULL, 'Промышленная мебель', 'Промышленная мебель', 11);
INSERT INTO `category` VALUES (3, 'Антистатическая мебель и оснащение', 'antistaticeskaa-mebel-i-osnasenie', 0, '', 0, 10, 1, '5a769edf81f9e4cfecfc3d8c10725cc3.png', NULL, '{category_name} в {city_name_pad_1} — широкий ассортимент от ведущих производителей. Купить антистатическую мебель и оснащение со склада и под заказ по низким ценам и заказать: доставку, сборку, выезд эксперта, вид рабочего места, 3D-проект помещения, подготовку ТЗ.', NULL, 'Антистатическая мебель и оснащение', 'Антистатическая мебель и оснащение', 33);
INSERT INTO `category` VALUES (92, 'Рабочие места', 'rabocie-mesta', 2, '', 1, 10, 1, '0aee1e1c7e994866addc33722474d235.png', NULL, NULL, NULL, 'Рабочие, универсальные, упаковочные столы, верстаки.', 'Рабочие места', 6106);
INSERT INTO `category` VALUES (93, 'Стулья промышленные', 'stula-promyslennye', 2, '', 7, 10, 1, 'f2b5fb2342190a31d6690ecdae2c0655.png', NULL, NULL, ' ', 'Полиуретановые, тканевые, пластиковые стулья, кресла.', 'Стул промышленный', 2850);
INSERT INTO `category` VALUES (94, 'Подкатные столы', 'podkatnye-stoly-2', 2, '', 10, 10, 1, 'b2499656dcf16595ff831873b56b1274.png', NULL, NULL, NULL, 'Для установки и перемещения оборудования в рабочей зоне.', 'Подкатные столы', 7471);
INSERT INTO `category` VALUES (95, 'Рабочие столы', 'rabocie-stoly', 92, '', 1, 10, 1, '6d97689bddd55ef309e0518265aaea52.png', NULL, NULL, NULL, 'Для инженерно-технического и производственного персонала.', 'Рабочие столы ', 7751);
INSERT INTO `category` VALUES (96, 'Столы остров', 'stoly-ostrov', 92, '', 4, 10, 1, '7232a6294e581d38e5fcb882299c8ea5.png', NULL, NULL, NULL, 'Два эффективного использования производственного пространства.', '', 18706);
INSERT INTO `category` VALUES (97, 'Верстаки', 'verstaki', 92, '', 3, 10, 1, '8b97bd6d06ce869eb84c5e2f3514f00b.png', NULL, NULL, NULL, 'Для слесарных работ с усиленной нагрузкой от 300 до 2000 кг.', 'Верстаки', 8043);
INSERT INTO `category` VALUES (99, 'Стулья тканевые', 'stula-tkanevye', 93, '', NULL, 10, 1, '844c3dbdf048948c68ef45c251a5b183.png', NULL, NULL, NULL, 'Стулья с мягким и удобным тканевым покрытием разного цвета.', 'Промышленные тканевые стулья', 2850);
INSERT INTO `category` VALUES (100, 'Стулья полиуретановые', 'stula-poliuretanovye', 93, '', NULL, 10, 1, '2c0331bf1fdb48e498b9b04b79eb17f8.png', NULL, NULL, NULL, 'Стулья из термостойкого, прочного, моющегося полиуретана.', 'Полиуретановые стулья', 7100);
INSERT INTO `category` VALUES (101, 'Готовые решения', 'gotovye-resenia', 92, '', 2, 10, 1, '719d11cbc0aefaa87c6e6b0a2a7eba56.png', NULL, NULL, NULL, 'Комплекты столов с подобранным дополнительным оборудованием.', '', 19538);
INSERT INTO `category` VALUES (102, 'Антистатическая мебель', 'antistaticeskaa-mebel', 3, '', 1, 10, 1, 'e00fdcb6b27ffa0c0131f05bb40d03c6.png', NULL, NULL, NULL, 'Рабочие места, стулья, шкафы, стеллажи, стойки, тумбы.', 'Антистатическая мебель', 9316);
INSERT INTO `category` VALUES (104, 'Средства заземления', 'sredstva-zazemlenia', 3, '', 4, 10, 1, 'e7b937ec99f2bff554e115ba416eeeea.png', NULL, NULL, NULL, 'Коврики, браслеты, колодки, узлы заземления, ремешки, бахилы. ', 'Средства заземления персонала', 810);
INSERT INTO `category` VALUES (105, 'Рабочие места антистатические ESD', 'rabocie-mesta-antistaticeskie-esd', 102, '', 1, 10, 1, 'e00fdcb6b27ffa0c0131f05bb40d03c6.png', NULL, NULL, NULL, 'Рабочие, универсальные, угловые столы. Готовые решения.', 'Антистатические столы', 9361);
INSERT INTO `category` VALUES (106, 'Стулья антистатические ESD', 'stula-antistaticeskie-esd', 102, '', 7, 10, 1, '376b8d03ed50f1377fda603db00db644.png', NULL, NULL, NULL, 'Полиуретановые и тканевые антистатические стулья.', 'Антистатические стулья', 9330);
INSERT INTO `category` VALUES (107, 'Антистатические тканевые стулья ESD', 'antistaticeskie-tkanevye-stula-esd', 106, 'Антистатические тканевые стулья', NULL, 10, 1, '0996f125aef6fa14b6e90417cb784b1b.png', NULL, NULL, NULL, 'Стулья с мягким антистатическим тканевым покрытием. ', 'Антистатические тканевые стулья ESD', 13280);
INSERT INTO `category` VALUES (108, 'Антистатические полиуретановые стулья ESD', 'antistaticeskie-poliuretanovye-stula-esd', 106, 'Антистатические полиуретановые стулья', NULL, 10, 1, '593dc263436956c9b811d9933b32b323.png', NULL, NULL, NULL, 'Стулья из антистатического термостойкого полиуретана.', 'Антистатические полиуретановые стулья', 9330);
INSERT INTO `category` VALUES (109, 'Подкатные столы антистатические ESD', 'podkatnye-stoly-antistaticeskie-esd', 102, '', 10, 10, 1, '948b03bca65d22a39dd46c286316d822.png', NULL, NULL, NULL, 'Для установки и перемещения оборудования в рабочей зоне.', 'Подкатные столы антистатические ESD', 11905);
INSERT INTO `category` VALUES (112, 'Подкатные стойки', 'podkatnye-stojki', 2, '', 4, 10, 1, '1db1cc3fdef9456ef960ffe39e003cc6.png', NULL, NULL, NULL, 'Для оборудования, комплектующих, компьютеров, инструментов.', 'Подкатная стойка', 16242);
INSERT INTO `category` VALUES (113, 'Подкатные стойки антистатические ESD', 'podkatnye-stojki-antistaticeskie-esd', 102, '', 4, 10, 1, '1db1cc3fdef9456ef960ffe39e003cc6.png', NULL, NULL, NULL, 'Для оборудования, приборов, комплектующих, инструмента.', 'Подкатные стойки антистатические ESD', 21396);
INSERT INTO `category` VALUES (114, 'Системы хранения', 'sistemy-hranenia', 2, '', 5, 10, 1, 'b0ca47ad4b005700fe8209ce213c8942.png', NULL, NULL, NULL, 'Для хранения небольших компонентов и комплектующих.', 'Системы хранения', 110);
INSERT INTO `category` VALUES (115, 'Системы хранения антистатические ESD', 'sistemy-hranenia-antistaticeskie-esd', 102, '', 5, 10, 1, 'b0ca47ad4b005700fe8209ce213c8942.png', NULL, NULL, NULL, 'для хранения небольших компонентов и комплектующих.', 'Системы хранения антистатические ESD', 6302);
INSERT INTO `category` VALUES (116, 'Шкафы металлические', 'skafy-metalliceskie', 2, '', 2, 10, 1, '8c5a9355371a1fccf18c736bbebb97c7.png', NULL, NULL, NULL, 'Для хранения одежды, документов, инструмента, комплектующих.', 'Шкафы металлические', 4221);
INSERT INTO `category` VALUES (117, 'Шкафы антистатические ESD', 'skafy-antistaticeskie-esd', 102, '', 2, 10, 1, 'e047baf1d3b83be2b005691a4e517f79.png', NULL, NULL, NULL, 'Для хранения одежды, документов, инструмента, комплектующих.', '', 14396);
INSERT INTO `category` VALUES (118, 'Стеллажи металлические', 'stellazi-metalliceskie', 2, '', 3, 10, 1, '77105c7b35023b73000600ab8b077734.png', NULL, NULL, NULL, 'Для оборудования, документации, комплектующих от 500 до 2200 кг.', 'Стеллаж', 1940);
INSERT INTO `category` VALUES (119, 'Стеллажи антистатические ESD', 'stellazi-antistaticeskie-esd', 102, '', 3, 10, 1, '77105c7b35023b73000600ab8b077734.png', NULL, NULL, NULL, 'Для хранения готовых изделий, комплектующих, оборудования.', 'Стеллажи антистатические ESD', 6318);
INSERT INTO `category` VALUES (120, 'Тумбы промышленные', 'tumby-promyslennye', 2, '', 9, 10, 1, 'adc94426f6dee670575a9e39f359e84c.png', NULL, NULL, NULL, 'Металлические, деревянные, подкатные, стационарные тумбы.', '', 3150);
INSERT INTO `category` VALUES (121, 'Тумбы антистатические ESD', 'tumby-antistaticeskie-esd', 102, '', 9, 10, 1, 'adc94426f6dee670575a9e39f359e84c.png', NULL, NULL, NULL, 'Антистатические подкатные и стационарные тумбы. ', 'Тумбы антистатические ESD', 10988);
INSERT INTO `category` VALUES (122, 'Шкафы сухого хранения', 'skafy-suhogo-hranenia', 102, '', 6, 10, 1, '7078499a321b412c21dafd19a4b48a74.png', NULL, NULL, NULL, 'Для обеспечения ультранизких значений относительной влажности.', 'Шкафы сухого хранения', 199245);
INSERT INTO `category` VALUES (124, 'Рабочие столы антистатические ESD', 'rabocie-stoly-antistaticeskie-esd', 105, '', 1, 10, 1, 'e00fdcb6b27ffa0c0131f05bb40d03c6.png', NULL, NULL, NULL, ' Для предприятий, где важна защита от статического электричества.', 'Рабочие столы антистатические ESD', 9361);
INSERT INTO `category` VALUES (125, 'Столы остров антистатические ESD', 'stoly-ostrov-antistaticeskie-esd', 105, '', 3, 10, 1, '7232a6294e581d38e5fcb882299c8ea5.png', NULL, NULL, NULL, 'Для эффективного использования производственного пространства.', 'Столы остров антистатические ESD', 24325);
INSERT INTO `category` VALUES (127, 'Универсальные столы антистатические ESD', 'universalnye-stoly-antistaticeskie-esd', 105, '', 4, 10, 1, '6e44b05fb7862e6efd64fcd31bf06cf0.png', NULL, NULL, NULL, 'Антистатические столы без возможности верхней комплектации.', 'Универсальные столы антистатические ESD', 9361);
INSERT INTO `category` VALUES (128, 'Универсальные столы', 'universalnye-stoly', 92, '', 9, 10, 1, '6e44b05fb7862e6efd64fcd31bf06cf0.png', NULL, NULL, NULL, 'Столы без возможности верхней комплектации.', 'Универсальные столы', 6106);
INSERT INTO `category` VALUES (129, 'Упаковочные столы', 'upakovocnye-stoly', 92, '', 5, 10, 1, '57a2d82ce413a3e2504027415cd0e986.png', NULL, NULL, NULL, 'Для упаковки и комплектации различной продукции и изделий.', 'Упаковочный стол', 8044);
INSERT INTO `category` VALUES (130, 'Угловые столы', 'uglovye-stoly', 92, '', 10, 10, 1, 'ef57a30b6d4827a4f88c441d4ad124d9.png', NULL, NULL, NULL, 'Для создания непрерывного рабочего пространства.', 'Угловые соединительные столы', 9969);
INSERT INTO `category` VALUES (131, 'Угловые столы антистатические ESD', 'uglovye-stoly-antistaticeskie-esd', 105, '', 5, 10, 1, 'ef57a30b6d4827a4f88c441d4ad124d9.png', NULL, NULL, NULL, 'Для воздания непрерывного рабочего пространства.', 'Угловые столы антистатические ESD', 13583);
INSERT INTO `category` VALUES (132, 'Дополнительное оснащение', 'dopolnitelnoe-osnasenie', 92, '', 12, 10, 1, 'b589856dc1db64407da7c7ea85420cff.png', NULL, NULL, NULL, 'Дополнительные модули и оборудование для рабочих мест.', 'Дополнительное оснащение рабочих мест', 358);
INSERT INTO `category` VALUES (133, 'Столы для обработки жгутов', 'stoly-dla-obrabotki-zgutov', 92, '', 8, 10, 1, '00977b143b7b8234a0212bc3dfbd5fbc.png', NULL, NULL, NULL, 'Регулируемая наклонная поверхность для раскладки и вязки жгутов.', 'Стол для раскладки и вязки жгутов', 51474);
INSERT INTO `category` VALUES (134, 'Антибактериальные столы', 'antibakterialnye-stoly', 92, '', 7, 10, 1, '37153bad2a343e66b7922fda0b975903.png', NULL, NULL, NULL, 'Бактерицидные поверхности, перегородки, рециркуляторы.', 'Антибактериальный стол', 13476);
INSERT INTO `category` VALUES (135, 'Дополнительное оснащение антистатических рабочих мест', 'dopolnitelnoe-osnasenie-antistaticeskih-rabocih-mest', 105, '', 6, 10, 1, 'b589856dc1db64407da7c7ea85420cff.png', NULL, NULL, NULL, 'Дополнительные модули и оборудование для рабочих мест.', 'Дополнительное оснащение антистатических рабочих мест', 358);
INSERT INTO `category` VALUES (136, 'Столы для чистых помещений', 'stoly-dla-cistyh-pomesenij', 92, '', 11, 10, 1, '49453124494e47c890a602dda7476b5e.png', NULL, NULL, NULL, 'Из нержавеющей стали для помещений высоких классов чистоты.', 'Столы для чистых помещений', 49004);
INSERT INTO `category` VALUES (137, 'Изготовление под заказ', 'izgotovlenie-pod-zakaz', 2, '', 6, 10, 1, '721cbf877a945bd5f9493227d0fc958d.png', NULL, NULL, NULL, 'Рабочих мест и модулей по индивидуальному проекту.', '', 7327);
INSERT INTO `category` VALUES (138, 'Изготовление под заказ', 'izgotovlenie-pod-zakaz-2', 102, '', 12, 10, 1, '721cbf877a945bd5f9493227d0fc958d.png', NULL, NULL, NULL, 'Антистатических рабочих мест по индивидуальному проекту.', '', 11233);
INSERT INTO `category` VALUES (139, 'Стулья кожзаменитель', 'stula-kozzamenitel', 93, '', NULL, 10, 1, '7ed39387ad8ab9cee5d0ec04d566fa03.png', NULL, NULL, NULL, 'Стулья с мягким и удобным, моющимся покрытием.', 'Стулья из кожзаменителя ', 3100);
INSERT INTO `category` VALUES (140, 'Стулья пластиковые', 'stula-plastikovye', 93, '', NULL, 10, 1, '1af889fbc28b6127054aacf82efad174.png', NULL, NULL, NULL, 'Стулья из термостойкого, прочного, моющегося пластика.', '', 3500);
INSERT INTO `category` VALUES (141, 'Стулья для работы стоя', 'stula-dla-raboty-stoa', 93, '', NULL, 10, 1, '699559ebc1582e5d02ef8439e7a73f9a.png', NULL, NULL, NULL, 'При долгой работе стоя, снижает давление на ноги на 60%. ', '', 18150);
INSERT INTO `category` VALUES (142, 'Кресла для персонала', 'kresla-dla-personala', 93, '', NULL, 10, 1, 'ea073556f4303e72c593da299eb07928.png', NULL, NULL, NULL, 'Для комфорта и повышения работоспособности персонала.', '', 21187);
INSERT INTO `category` VALUES (143, 'Кресла антистатические ESD', 'kresla-antistaticeskie-esd', 106, '', NULL, 10, 1, '783e9e348631d356ab3537782fc3cfcc.png', NULL, NULL, NULL, 'Удобные эргономичные антистатические кресла.', 'Кресла антистатические ESD', 35600);
INSERT INTO `category` VALUES (144, 'Табуреты полиуретановые', 'taburety-poliuretanovye', 217, '', NULL, 10, 1, 'a673d2e3634bc2220c968dda25df4993.png', NULL, NULL, NULL, 'Табуреты из термостойкого, прочного, моющегося полиуретана.', '', 4895);
INSERT INTO `category` VALUES (145, 'Табуреты кожзаменитель', 'taburety-kozzamenitel', 217, '', NULL, 10, 1, '926a5a6fec42fbe03ea4ddcba7f9fd4d.png', NULL, NULL, NULL, 'Табуреты легко моются и устойчивы к дезинфицирующим средствам.', '', 3080);
INSERT INTO `category` VALUES (146, 'Табуреты со спинкой', 'taburety-so-spinkoj', 217, '', NULL, 10, 1, '79e6073f35a6f930d0f5e508ad02000b.png', NULL, NULL, NULL, 'Табуреты с покрытием из кожзама или ткани с фиксацией спины.', '', 3080);
INSERT INTO `category` VALUES (147, 'Табуреты антистатические ESD', 'taburety-antistaticeskie-esd', 102, '', 8, 10, 1, '33f3ad005fa2fe7c389224d4e3df6c99.png', NULL, NULL, NULL, 'Полиуретановые антистатические табуреты.', 'Табуреты антистатические ESD', 6579);
INSERT INTO `category` VALUES (150, 'Подкатные стойки для оборудования', 'podkatnye-stojki-dla-oborudovania', 112, '', NULL, 10, 1, '1db1cc3fdef9456ef960ffe39e003cc6.png', NULL, NULL, NULL, 'Для размещения и перемещения оборудования в рабочей зоне. ', 'Подкатная стойка для оборудования', 16242);
INSERT INTO `category` VALUES (151, 'Стойки для оборудования антистатические ESD', 'stojki-dla-oborudovania-antistaticeskie-esd', 113, '', NULL, 10, 1, '1db1cc3fdef9456ef960ffe39e003cc6.png', NULL, NULL, NULL, 'Для размещения и перемещения оборудования в рабочей зоне.', 'Стойки для оборудования антистатические ESD', 21396);
INSERT INTO `category` VALUES (152, 'Подкатные стойки для комплектующих', 'podkatnye-stojki-dla-komplektuusih', 112, '', NULL, 10, 1, '47bc7cedddd5587ea44d7c6127072514.png', NULL, NULL, NULL, 'Для перемещений мелких комплектующих и компонентов. ', 'Подкатные стойки для комплектующих и компонентов', 16507);
INSERT INTO `category` VALUES (153, 'Стойки для комплектующих антистатические ESD', 'stojki-dla-komplektuusih-antistaticeskie-esd', 113, '', NULL, 10, 1, '88be6f47b32c720ae51e178e81bab5bd.png', NULL, NULL, NULL, 'Для перемещения мелких комплектующих и компонентов.', 'Подкатные стойки для комплектующих антистатические ESD', 18234);
INSERT INTO `category` VALUES (154, 'Подкатные стойки для оргтехники', 'podkatnye-stojki-dla-orgtehniki', 112, '', NULL, 10, 1, '449fbfdfe3c2d8f51910397b09201110.png', NULL, NULL, NULL, 'Для перемещения оргтехники внутри рабочей зоны.', 'Подкатные стойки для оргтехники', 15529);
INSERT INTO `category` VALUES (155, 'Подкатные ремонтные стойки ', 'podkatnye-remontnye-stojki', 112, '', NULL, 10, 1, 'd5d5ca13c77f3846f49daa2b14dca684.png', NULL, NULL, NULL, 'Для перемещения документов, оборудования инструмента.', 'Подкатные ремонтные стойки ', 16447);
INSERT INTO `category` VALUES (156, 'Подкатные стойки для инструмента', 'podkatnye-stojki-dla-instrumenta', 112, '', NULL, 10, 1, 'e0f6b50b2bd8804e5c252acc7984ae6d.png', NULL, NULL, NULL, 'Стойки с перфорированной стенкой для инструмента и оборудования.', 'Подкатные стойки для инструмента', 12401);
INSERT INTO `category` VALUES (157, 'Подкатные упаковочные стойки', 'podkatnye-upakovocnye-stojki', 112, '', NULL, 10, 1, '171275278d4fbde3e4a13b2fcb9ebc65.png', NULL, NULL, NULL, 'Для удобного крепления рулонных упаковочных материалов.', 'Подкатная упаковочная стойка', 3718);
INSERT INTO `category` VALUES (158, 'Кассетницы', 'kassetnicy', 114, '', NULL, 10, 1, 'f2d2bb7ccc54f02bd4c58e2165773972.png', NULL, NULL, NULL, 'Эффективное хранение мелких деталей и компонентов.', '', 2772);
INSERT INTO `category` VALUES (159, 'Кассетницы антистатические ESD', 'kassetnicy-antistaticeskie-esd', 115, '', NULL, 10, 1, 'eb466bcae967cbecac8a8cced538bb2b.png', NULL, NULL, NULL, 'Хранение и антистатическая защита мелкий деталей и компонентов.', 'Кассетницы антистатические ESD', 6184);
INSERT INTO `category` VALUES (160, 'Поворотные стойки', 'povorotnye-stojki', 114, '', NULL, 10, 1, '05e27fc40aa50ccaf2dfeacef9cdfcd1.png', NULL, NULL, NULL, 'До 4320 различных типов компонентов на площади всего 0,25 м2.', '', 21448);
INSERT INTO `category` VALUES (161, 'Поворотные стойки для кассетниц антистатические ESD', 'povorotnye-stojki-dla-kassetnic-antistaticeskie-esd', 115, '', NULL, 10, 1, 'b0ca47ad4b005700fe8209ce213c8942.png', NULL, NULL, NULL, 'До 4320 различных типов компонентов на площади всего 0,25 м2.', 'Поворотные стойки для кассетниц антистатические ESD', 11100);
INSERT INTO `category` VALUES (162, 'Шкафы для одежды', 'skafy-dla-odezdy', 116, '', NULL, 10, 1, '0cc543b63f61747595ddfc4c100c8ef3.png', NULL, NULL, NULL, 'Надежное и бережное хранение верхней и сменной одежды.', 'Шкафы металлические для одежды', 4221);
INSERT INTO `category` VALUES (163, 'Шкафы для одежды антистатические ESD', 'skafy-dla-odezdy-antistaticeskie-esd', 117, '', NULL, 10, 1, 'f780e2381972e056d945d6a9bea05249.png', NULL, NULL, NULL, 'Надежное и бережное хранение антистатической сменной одежды.', 'Шкафы для одежды антистатические ESD', 14396);
INSERT INTO `category` VALUES (164, 'Шкафы для документов', 'skafy-dla-dokumentov', 116, '', NULL, 10, 1, '397795defd20bbece7f3991a465f76ff.png', NULL, NULL, NULL, 'Для хранения офисной и технической документации, архивов.', 'Шкафы металлические для документов', 6145);
INSERT INTO `category` VALUES (165, 'Шкафы для документов антистатические ESD', 'skafy-dla-dokumentov-antistaticeskie-esd', 117, '', NULL, 10, 1, 'a0f39e93f54eafdb8b3c840ec4be9030.png', NULL, NULL, NULL, 'Для хранения офисной и технической документации, архивов.', 'Шкафы для документов антистатические ESD', 18826);
INSERT INTO `category` VALUES (166, 'Шкафы комбинированные', 'skafy-kombinirovannye', 116, '', NULL, 10, 1, '09cbd279e094bf5d3fd3761425f2bfb7.png', NULL, NULL, NULL, 'Для хранения одежды, документации, оборудования, канцелярии.', '', 7276);
INSERT INTO `category` VALUES (167, 'Шкафы комбинированные антистатические ESD', 'skafy-kombinirovannye-antistaticeskie-esd', 117, '', NULL, 10, 1, 'd863113d680b109768d5d05dcc67a0fd.png', NULL, NULL, NULL, 'Для хранения антистатической одежды, документации.', 'Шкафы комбинированные антистатические ESD', 18828);
INSERT INTO `category` VALUES (168, 'Шкафы для комплектующих', 'skafy-dla-komplektuusih', 116, '', NULL, 10, 1, '84de36f3ca049dcfd70dd2231ffb38d8.png', NULL, NULL, NULL, 'Для хранения комплектующих, компонентов, оборудования.', 'Шкаф для хранения комплектующих.', 35494);
INSERT INTO `category` VALUES (169, 'Шкафы для комплектующих антистатические ESD', 'skafy-dla-komplektuusih-antistaticeskie-esd', 117, '', NULL, 10, 1, '84de36f3ca049dcfd70dd2231ffb38d8.png', NULL, NULL, NULL, 'Для хранения и антистатической защиты  комплектующих.', 'Шкафы для комплектующих антистатические ESD', 30098);
INSERT INTO `category` VALUES (170, 'Шкафы для инструмента', 'skafy-dla-instrumenta', 116, '', NULL, 10, 1, '9b6ab41439b118ddb2fa160bea1e026e.png', NULL, NULL, NULL, 'Для хранения инструментов, оборудования, оснастки.', 'Шкафы для хранения инструмента', 25686);
INSERT INTO `category` VALUES (171, 'Шкафы для инструмента антистатические ESD', 'skafy-dla-instrumenta-antistaticeskie-esd', 117, '', NULL, 10, 1, '9b6ab41439b118ddb2fa160bea1e026e.png', NULL, NULL, NULL, 'Для хранения антистатических инструментов, оборудования.', 'Шкафы для инструмента антистатические ESD', 29618);
INSERT INTO `category` VALUES (172, 'Стеллажи с нагрузкой 500 кг.', 'stellazi-s-nagruzkoj-500-kg', 118, '', NULL, 10, 1, '38b7779f693637b06087cc99e131e174.png', NULL, NULL, NULL, 'Распределенная нагрузка на секцию до 500 кг., на полку до 120 кг.', 'Металлические стеллажи', 1940);
INSERT INTO `category` VALUES (173, 'Стеллажи с нагрузкой 750 кг.', 'stellazi-s-nagruzkoj-750-kg', 118, '', NULL, 10, 1, 'e655fe5e0acbc525dcc58e4b6a3c3994.png', NULL, NULL, NULL, 'Распределенная нагрузка на секцию до 750 кг., на полку до 180 кг.', '', 2080);
INSERT INTO `category` VALUES (174, 'Стеллажи с нагрузкой 900 кг.', 'stellazi-s-nagruzkoj-900-kg', 118, '', NULL, 10, 1, '7d3105f5715c29edc4e341c567030ecf.png', NULL, NULL, NULL, 'Распределенная нагрузка на секцию до 900 кг., на полку до 200 кг.', '', 2124);
INSERT INTO `category` VALUES (175, 'Стеллажи с нагрузкой 2200 кг.', 'stellazi-s-nagruzkoj-2200-kg', 118, '', NULL, 10, 1, '2455721f880a806a92ffb49144d7e9f7.png', NULL, NULL, NULL, 'Распределенная нагрузка на секцию до 2200 кг., на полку до 300 кг.', '', 6320);
INSERT INTO `category` VALUES (176, 'Стеллажи антистатические ESD с нагрузкой до 180 кг.', 'stellazi-antistaticeskie-esd-s-nagruzkoj-do-180-kg', 119, '', NULL, 10, 1, '6461589dd7d0e1430a31042d4e2cc201.png', NULL, NULL, NULL, 'Распределенная нагрузка на секцию до 180 кг., на полку до 30 кг.', 'Стеллажи антистатические ESD с нагрузкой до 180 кг.', 6389);
INSERT INTO `category` VALUES (177, 'Стеллажи антистатические ESD с нагрузкой до 800 кг.', 'stellazi-antistaticeskie-esd-s-nagruzkoj-do-800-kg', 119, '', NULL, 10, 1, 'e8833e23a178c3c4facce28cbddba01a.png', NULL, NULL, NULL, 'Распределенная нагрузка на секцию до 800 кг., на полку до 200 кг.', 'Стеллажи антистатические ESD с нагрузкой до 800 кг.', 19692);
INSERT INTO `category` VALUES (178, 'Тумбы подкатные', 'tumby-podkatnye', 120, '', NULL, 10, 1, '1588ce0ef6fe2f00e5644ccaacc6d2f0.png', NULL, NULL, NULL, 'Подкатные металлические и деревянные тумбы.', 'Подкатные металлические тумбы', 3150);
INSERT INTO `category` VALUES (179, 'Тумбы подкатные антистатические ESD', 'tumby-podkatnye-antistaticeskie-esd', 121, '', NULL, 10, 1, 'ce9ab255d4b8b9d97b3875acf9d98b8c.png', NULL, NULL, NULL, 'Подкатные антистатические тумбы на 3,4 ящика.', 'Тумбы подкатные антистатические ESD', 10988);
INSERT INTO `category` VALUES (180, 'Тумбы стационарные', 'tumby-stacionarnye', 120, '', NULL, 10, 1, '416ac34f4a174a8f1ac1c30d4d998726.png', NULL, NULL, NULL, 'Могут использоваться в качестве подставки под оборудование.', '', 6952);
INSERT INTO `category` VALUES (181, 'Тумбы стационарные антистатические ESD', 'tumby-stacionarnye-antistaticeskie-esd', 121, '', NULL, 10, 1, '416ac34f4a174a8f1ac1c30d4d998726.png', NULL, NULL, NULL, 'Могут использоваться в качестве подставки под оборудование.', 'Тумбы стационарные антистатические ESD', 11287);
INSERT INTO `category` VALUES (182, 'Антистатическая упаковка', 'antistaticeskaa-upakovka', 3, '', 5, 10, 1, '85dd2ae04b201d3bc807eda197c1d299.png', NULL, NULL, NULL, 'Антистатические пакеты, контейнеры, рукава, коробки, рукава, поролон.', 'Антистатическая упаковка', 7710);
INSERT INTO `category` VALUES (183, 'Антистатический линолеум', 'antistaticeskij-linoleum', 3, '', 7, 10, 1, 'ac4d9b4c1c2cb0ac6886368318c91678.png', NULL, NULL, NULL, 'Для помещений, защищенных от электростатических разрядов.', 'Антистатический линолеум', 2250);
INSERT INTO `category` VALUES (184, 'Антистатический инструмент', 'antistaticeskij-instrument', 3, '', 7, 10, 1, '76cc65a923eb4268c137439527d3dd32.png', NULL, NULL, NULL, 'Отвертки, пинцеты, кусачки, щетки, тиски, наборы инструмента. ', 'Антистатический инструмент', 310);
INSERT INTO `category` VALUES (185, 'Приборы ESD мониторинга', 'pribory-esd-monitoringa', 3, '', 8, 10, 1, 'f7062031d7e58e268438beeceb8f408b.png', NULL, NULL, NULL, 'Тестер-стенды, калибраторы. Измерение параметров поля.', 'Приборы ESD мониторинга и аудита', 29240);
INSERT INTO `category` VALUES (186, 'ESD принадлежности', 'esd-prinadleznosti', 3, '', 9, 10, 1, 'cd2222ee12b53c072e94ad83862ec050.png', NULL, NULL, NULL, 'Канцелярские принадлежности, коврики, чистящие жидкости.', '', 800);
INSERT INTO `category` VALUES (187, 'Ионизаторы воздуха', 'ionizatory-vozduha', 3, '', 10, 10, 1, 'ac5ef86c091cd0f60ac5b6f4ff5f7dca.png', NULL, NULL, NULL, 'Нейтрализация статических зарядов на объектах рабочей зоны.', 'Ионизаторы воздуха', 16824);
INSERT INTO `category` VALUES (188, 'Автоматические турникеты', 'avtomaticeskie-turnikety', 3, '', 11, 10, 1, '9336935e48ed16fcc76f350d33b19a1b.png', NULL, NULL, NULL, 'Ежедневная проверка антистатической обуви и браслетов.', 'Автоматические турникеты', NULL);
INSERT INTO `category` VALUES (189, 'Антистатическая одежда', 'antistaticeskaa-odezda', 3, '', 2, 10, 1, '75d3729c0fb97dcdcd5acce54f0107d6.png', NULL, NULL, NULL, 'Халаты, костюмы, перчатки, береты с проводящими волокнами.', 'Антистатическая одежда', 3598);
INSERT INTO `category` VALUES (190, 'Антистатическая обувь', 'antistaticeskaa-obuv', 3, '', 3, 10, 1, '4b166ac6c3055e5b87ead899ea6963f8.png', NULL, NULL, NULL, 'Туфли, сандалии из натуральной кожи для комфортной работы.', '', 3373);
INSERT INTO `category` VALUES (191, 'Антистатические настольные коврики', 'antistaticeskie-nastolnye-kovriki', 224, '', NULL, 10, 1, '8ebd449f7151c17de0a405d2d37156be.png', NULL, NULL, NULL, '', '', 1234);
INSERT INTO `category` VALUES (192, 'Антистатические браслеты', 'antistaticeskie-braslety', 104, '', 2, 10, 1, '6a8299ad61494247ef75f1cd7cf48be9.png', NULL, NULL, NULL, 'Тканевые и металлические браслеты, шнуры для их подключения.', 'Антистатические браслеты', 280);
INSERT INTO `category` VALUES (193, 'Узлы и колодки заземления', 'uzly-i-kolodki-zazemlenia', 104, '', 3, 10, 1, '4a20bfc76525c096b33f2ecde682e244.png', NULL, NULL, NULL, 'Для подключения рабочих мест, гарнитур, браслетов, приборов.', 'Узлы и колодки заземления', 800);
INSERT INTO `category` VALUES (194, 'Антистатические напольные коврики', 'antistaticeskie-napolnye-kovriki', 224, '', NULL, 10, 1, '2d24b29f32b03fd60a0901350259bdbc.png', NULL, NULL, NULL, '', '', 1234);
INSERT INTO `category` VALUES (196, 'Заземление обуви', 'zazemlenie-obuvi', 104, '', 4, 10, 1, '1fba979d99f0e582eb26bcf777011c04.png', NULL, NULL, NULL, 'Ремешки на обувь и на ногу, антистатические бахилы. ', 'Заземление обуви', 800);
INSERT INTO `category` VALUES (197, 'Антистатические пакеты', 'antistaticeskie-pakety', 182, '', NULL, 10, 1, '619fb429a0169f647c5f353122f51d88.png', NULL, NULL, NULL, 'Упаковочные, металлизированные, розовые, сверхпрочные, zip-защелка.', '', 595);
INSERT INTO `category` VALUES (198, 'Антистатические кейсы', 'antistaticeskie-kejsy', 203, '', NULL, 10, 1, '96712bd16e64d290f99276652354c7cf.png', NULL, NULL, NULL, 'Крышка, самоблокирующиеся защелки, ручки.', 'Антистатические кейсы', 4395);
INSERT INTO `category` VALUES (199, 'Антистатические контейнеры', 'antistaticeskie-kontejnery', 203, '', NULL, 10, 1, '6ef1934036116894cfba2f8faf075a63.png', NULL, NULL, NULL, 'Плоскодонная антистатическая тара разного размера.', 'Антистатические контейнеры', 2263);
INSERT INTO `category` VALUES (200, 'Подставки под платы', 'podstavki-pod-platy', 203, '', NULL, 10, 1, 'c4c47b71002ad9978c852cc59993802a.png', NULL, NULL, NULL, 'Подставки для хранения и транспортировки печатных плат.', 'Подставки под платы', 1775);
INSERT INTO `category` VALUES (201, 'Антистатические лотки', 'antistaticeskie-lotki', 203, '', NULL, 10, 1, 'acb3141ce1f5a1b4942d9602ae4031f8.png', NULL, NULL, NULL, 'Для комплектующих. Крепление на рельс, установка друг на друга.', 'Антистатические лотки', 160);
INSERT INTO `category` VALUES (202, 'Контейнер для катушек', 'kontejner-dla-katusek', 203, '', NULL, 10, 1, '1f2deba31419057a10317083f86d6600.png', NULL, NULL, NULL, 'Для транспортировки катушек и их антистатической защиты.', 'Контейнер транспортировки для катушек', 2130);
INSERT INTO `category` VALUES (203, 'Антистатическая тара', 'antistaticeskaa-tara', 3, '', 6, 10, 1, 'e7aa3cb49e813090bf4b808b546e723d.png', NULL, NULL, NULL, 'Антистатические лотки, кейсы, контейнеры, подставки, ячейки.', 'Антистатическая тара', 170);
INSERT INTO `category` VALUES (204, 'Ячейки для компонентов', 'acejki-dla-komponentov', 203, '', NULL, 10, 1, '0a3dee6394d61d2acac0a2ebe35a9445.png', NULL, NULL, NULL, 'Лотки с пазами, короткие и длинные разделители, прозрачная крышка.', '', 985);
INSERT INTO `category` VALUES (205, 'Контейнеры из полипропилена', 'kontejnery-iz-polipropilena', 182, '', NULL, 10, 1, 'fcc84d540b407204a0887e3a3974f951.png', NULL, NULL, NULL, 'Толщина 2,5 мм., отверстия для переноски с каждой стороны.', 'Контейнеры из полипропилена', 2575);
INSERT INTO `category` VALUES (207, 'Антистатический поролон', 'antistaticeskij-porolon', 182, '', NULL, 10, 1, '499d22759d649ef4f8a37c1fbce18a95.png', NULL, NULL, NULL, 'Защита от механических воздействий. Тип - открытая ячейка.', 'Антистатический поролон', 7280);
INSERT INTO `category` VALUES (208, 'Рассеивающие рукава', 'rasseivausie-rukava', 182, '', NULL, 10, 1, 'f2ce788be284a4d255f8a16e2b0b6754.png', NULL, NULL, NULL, 'Антистатические рукава для вакуумной упаковки.', 'Антистатический рассеивающий рукав', 6100);
INSERT INTO `category` VALUES (209, 'Антистатические коробки', 'antistaticeskie-korobki', 182, '', NULL, 10, 1, 'b1b4c638ef47aaaf1f42385db9681fcf.png', NULL, NULL, NULL, 'Защита от статического электричества и повреждений.', 'Антистатические коробки', 250);
INSERT INTO `category` VALUES (210, 'Устройства для упаковки', 'ustrojstva-dla-upakovki', 182, '', NULL, 10, 1, '2d36c1c88f446e141a836255f0aa86c8.png', NULL, NULL, NULL, 'Создание вакуума и заполнение упаковки газом.', '', 353493);
INSERT INTO `category` VALUES (211, 'Антистатические отвертки', 'antistaticeskie-otvertki', 184, '', NULL, 10, 1, '5d12424f84c3fc5249a81cbfe0ef6172.png', NULL, NULL, NULL, 'Ручка из проводящего пластика, жало из хром-ванадиевого сплава.', 'Антистатические отвертки', 470);
INSERT INTO `category` VALUES (212, 'Пинцеты антистатические', 'pincety-antistaticeskie', 184, '', NULL, 10, 1, 'aaf02be5601bd2197c43fadda02801e6.png', NULL, NULL, NULL, 'Высокоточные антимагнитные и кислотоустойчивые пинцеты.', '', 1450);
INSERT INTO `category` VALUES (213, 'Ручной инструмент', 'rucnoj-instrument', 184, '', NULL, 10, 1, '401aa83681f026b5f6e721a60643824c.png', NULL, NULL, NULL, 'Высококачественная сталь, полированные рабочие поверхности.', 'Ручной инструмент', 4150);
INSERT INTO `category` VALUES (214, 'Антистатические щетки', 'antistaticeskie-setki', 184, '', NULL, 10, 1, '07c68dc7e9043009fa302c8518d094dd.png', NULL, NULL, NULL, 'Антистатические щетки изготовлены из токопроводящего пластика.', 'Антистатические щетки', 310);
INSERT INTO `category` VALUES (215, 'Антистатические тиски', 'antistaticeskie-tiski', 184, '', NULL, 10, 1, 'a3b46b09300ed3a90eb87f4a711000f0.png', NULL, NULL, NULL, 'Тиски со сменными захватами для фиксации компонентов и плат.', '', 21400);
INSERT INTO `category` VALUES (216, 'Наборы инструмента', 'nabory-instrumenta', 184, '', NULL, 10, 1, '5fcf9a02e5caa302b6c96fdd485aebe2.png', NULL, NULL, NULL, 'Наборы сертифицированных антистатических инструментов.', '', 11250);
INSERT INTO `category` VALUES (217, 'Табуреты промышленные', 'taburety-promyslennye', 2, '', 8, 10, 1, 'a673d2e3634bc2220c968dda25df4993.png', NULL, NULL, NULL, 'Полиуретановые, кожзам, тканевые, со спинкой.', '', 4895);
INSERT INTO `category` VALUES (218, 'Транспортные тележки', 'transportnye-telezki', 2, '', 11, 10, 1, '42a73b71e2568e0b0ea064bc225515a4.png', NULL, NULL, NULL, 'Для перемещения изделий, компонентов, оборудования.', '', 9745);
INSERT INTO `category` VALUES (219, 'Конвейерные системы ', 'konvejernye-sistemy', 92, '', 6, 10, 1, '81c1082dc81b3cda5e7b32911cd0febd.png', NULL, NULL, NULL, 'Ускоряют передачу оборудования, материалов между сотрудниками.', 'Конвейерная настольная система', 9750);
INSERT INTO `category` VALUES (220, 'Увеличенные драйверы', 'uvelicennye-drajvery', 120, '', NULL, 10, 1, 'bf7db52bc187bc0726e8499b2f026bbf.png', NULL, NULL, NULL, 'Увеличенные тумбы с 7,10 ящиками разного размера.', '', 15207);
INSERT INTO `category` VALUES (221, 'Подкатная рабочая станция', 'podkatnaa-rabocaa-stancia', 120, 'Могут использоваться как мобильные верстаки или передвижные станции.', NULL, 10, 1, 'a99e736ea55f6ff21e193b512859044a.png', NULL, NULL, NULL, 'Нагрузка на тумбу до 350 кг, на каждый ящик до 45 кг.', 'Могут использоваться как мобильные верстаки или передвижные станции.', 40201);
INSERT INTO `category` VALUES (222, 'Готовые решения антистатические ESD', 'gotovye-resenia-antistaticeskie-esd', 105, '', 2, 10, 1, '0aee1e1c7e994866addc33722474d235.png', NULL, NULL, NULL, 'Комплекты антистатических столов с дополнительным оборудованием.', '', 21734);
INSERT INTO `category` VALUES (223, 'Подкатные тележки антистатические ESD', 'podkatnye-telezki-antistaticeskie-esd', 102, '', 11, 10, 1, '42a73b71e2568e0b0ea064bc225515a4.png', NULL, NULL, NULL, 'Для перемещения изделий, компонентов, оборудования.', 'Подкатные тележки антистатические ESD', 13076);
INSERT INTO `category` VALUES (224, 'Антистатические коврики ESD', 'antistaticeskie-kovriki-esd', 104, '', 1, 10, 1, '44d16bb470729ff8c4509b57a3c397a6.png', NULL, NULL, NULL, 'Настольные, напольные коврики для локальной антистатической зоны.', 'Антистатические коврики', 1920);
INSERT INTO `category` VALUES (225, 'Антистатические халаты', 'antistaticeskie-halaty', 189, '', 1, 10, 1, '0d914521ca0273570925199281cfd0c9.png', NULL, NULL, NULL, 'Мужские, женские. Все размеры. Цвета: синий, белый, серый. ', '', 1760);
INSERT INTO `category` VALUES (226, 'Антистатические костюмы', 'antistaticeskie-kostumy', 189, '', 2, 10, 1, '75d3729c0fb97dcdcd5acce54f0107d6.png', NULL, NULL, NULL, 'Мужские, женские. Все размеры. Цвета: синий, белый, серый. ', 'Антистатические костюмы', 7130);
INSERT INTO `category` VALUES (227, 'Антистатические береты', 'antistaticeskie-berety', 189, '', 3, 10, 1, 'b8a73bc33a0290572677734008a6c67c.png', NULL, NULL, NULL, 'Береты, платки. Цвета: синий, белый, серый. На резинке. ', 'Антистатические береты, платки', 715);
INSERT INTO `category` VALUES (228, 'Антистатические перчатки', 'antistaticeskie-percatki', 189, '', 4, 10, 1, '352343d23fa2d4a24e208e73bfb9206b.png', NULL, NULL, NULL, 'Перчатки из антистатической ткани с различными вариантами покрытия.', 'Антистатические перчатки', 100);
INSERT INTO `category` VALUES (229, 'Увеличенные драйверы антистатические ESD', 'uvelicennye-drajvery-antistaticeskie-esd', 121, '', NULL, 10, 1, 'bf7db52bc187bc0726e8499b2f026bbf.png', NULL, NULL, NULL, 'Антистатические увеличенные тумбы с 7, 10 ящиками разного размера.', '', 19731);

-- ----------------------------
-- Table structure for city
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `name_pad_1` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name_pad_2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `lat` float NULL DEFAULT NULL,
  `lng` float NULL DEFAULT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 243 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES (191, 'екатеринбург', 'Екатеринбург', 'Екатеринбурге', 'Екатеринбурга', 'ул. Чистопольская, д. 6 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 56.8233, 60.6832, NULL, 'zakaz@pmzakaz.ru', '');
INSERT INTO `city` VALUES (192, 'москва', 'Москва', 'Москве', 'Москвы', '1-й Вязовский пр-д., д. 4, стр. 19 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 55.7174, 37.7576, NULL, 'zakaz@pmzakaz.ru', '');
INSERT INTO `city` VALUES (193, 'санкт-петербург', 'Санкт-Петербург', 'Санкт-Петербурге', 'Санкт-Петербурга', 'ул. Якорная, д. 17, лит. Ш <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 59.9428, 30.4408, NULL, 'zakaz@pmzakaz.ru', '');
INSERT INTO `city` VALUES (194, 'чебоксары', 'Чебоксары', 'Чебоксарах', 'Чебоксар', 'ул. Гаражный проезд, 3, Лит. В, В1 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 56.1113, 47.2807, NULL, 'zakaz@pmzakaz.ru', '');
INSERT INTO `city` VALUES (195, 'нижний-новгород', 'Нижний-Новгород', 'Нижнем-Новгороде', 'Нижнего-Новгорода', 'ул. Вторчермета, д. 1к2 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 56.3051, 43.8646, NULL, 'zakaz@pmzakaz.ru', '');
INSERT INTO `city` VALUES (196, 'иваново', 'Иваново', 'Иваново', 'Иваново', 'ул. Парижской Коммуны, д. 84 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 56.9988, 40.9143, NULL, 'zakaz@pmzakaz.ru', '');
INSERT INTO `city` VALUES (197, 'киров', 'Киров', 'Кирове', 'Кирова', 'ул. Щорса, д. 70А/5 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 58.5744, 49.5717, NULL, 'zakaz@pmzakaz.ru', '');
INSERT INTO `city` VALUES (198, 'пермь', 'Пермь', 'Перми', 'Перми', 'ул. Промышленная, д. 123 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 57.923, 56.1663, NULL, 'zakaz@pmzakaz.ru', '');
INSERT INTO `city` VALUES (199, 'тверь', 'Тверь', 'Твери', 'Твери', 'Московское шоссе, д. 18, стр. 1 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 56.8362, 35.9455, NULL, '', '');
INSERT INTO `city` VALUES (200, 'кемерово', 'Кемерово', 'Кемерово', 'Кемерово', 'Кузнецкий пр-кт, д. 91 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 55.337, 86.0616, NULL, '', '');
INSERT INTO `city` VALUES (201, 'иркутск', 'Иркутск', 'Иркутске', 'Иркутска', 'ул. Новаторов, д. 1 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 52.349, 104.209, NULL, '', '');
INSERT INTO `city` VALUES (202, 'самара', 'Самара', 'Самаре', 'Самары', 'ул. Земеца, д. 32, лит. 354<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 53.2121, 50.2994, NULL, '', '');
INSERT INTO `city` VALUES (203, 'белгород', 'Белгород', 'Белгороде', 'Белгорода', 'ул. Кирпичный тупик, д.2А, к.3 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 50.5879, 36.5732, NULL, '', '');
INSERT INTO `city` VALUES (204, 'волгоград', 'Волгоград', 'Волгограде', 'Волгограда', 'ул. Землячки, д. 16 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 48.7486, 44.4701, NULL, '', '');
INSERT INTO `city` VALUES (205, 'смоленск', 'Смоленск', 'Смоленске', 'Смоленска', 'ул. Старо-Комендантская, д. 2 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 54.7986, 32.0529, NULL, '', '');
INSERT INTO `city` VALUES (206, 'ростов-на-дону', 'Ростов-на-Дону', 'Ростове-на-Дону', 'Ростова-на-Дону', 'ул. Доватора, д. 148 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 47.2381, 39.5995, NULL, '', '');
INSERT INTO `city` VALUES (207, 'уфа', 'Уфа', 'Уфе', 'Уфы', 'ул. Сельская Богородская, д. 57 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 54.7906, 56.0907, NULL, '', '');
INSERT INTO `city` VALUES (208, 'тула', 'Тула', 'Туле', 'Тулы', 'ул. Чмутова, д. 158 В <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 54.207, 37.5529, NULL, '', '');
INSERT INTO `city` VALUES (209, 'краснодар', 'Краснодар', 'Краснодаре', 'Краснодара', 'ул. Автомобильная, д. 3 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 45.0917, 38.9966, NULL, '', '');
INSERT INTO `city` VALUES (210, 'ставрополь', 'Ставрополь', 'Ставрополе', 'Ставрополя', 'ул. 2-я промышленная, д. 33 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 45.0599, 41.9041, NULL, '', '');
INSERT INTO `city` VALUES (211, 'тамбов', 'Тамбов', 'Тамбове', 'Тамбова', 'ул. Кавалерийская, д. 13А <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 52.7267, 41.4238, NULL, '', '');
INSERT INTO `city` VALUES (212, 'орел', 'Орел', 'Орле', 'Орла', 'ул. Черепичная, д. 22 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 52.9406, 36.0356, NULL, '', '');
INSERT INTO `city` VALUES (213, 'великий-новгород', 'Великий-Новгород', 'Великом-Новгороде', 'Великого-Новгорода', 'Базовый переулок, д. 13 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 58.5511, 31.262, NULL, '', '');
INSERT INTO `city` VALUES (214, 'саранск', 'Саранск', 'Саранске', 'Саранска', 'ул. Строительная, д. 11 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 54.2034, 45.1617, NULL, '', '');
INSERT INTO `city` VALUES (215, 'псков', 'Псков', 'Пскове', 'Пскова', 'ул. Леона Поземского, д 110Д <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 57.8336, 28.3067, NULL, '', '');
INSERT INTO `city` VALUES (216, 'челябинск', 'Челябинск', 'Челябинске', 'Челябинска', 'ул. Северный Луч, д. 1А <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 55.2194, 61.4169, NULL, '', '');
INSERT INTO `city` VALUES (217, 'владимир', 'Владимир', 'Владимире', 'Владимира', 'ул. Гастелло, д. 8 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 56.1574, 40.3867, NULL, '', '');
INSERT INTO `city` VALUES (218, 'томск', 'Томск', 'Томске', 'Томска', 'ул. Пролетарская, д. 38В, стр. 1 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 56.5093, 84.9462, NULL, '', '');
INSERT INTO `city` VALUES (219, 'ярославль', 'Ярославль', 'Ярославле', 'Ярославля', 'ул. Базовая, д. 2 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 57.6589, 39.8383, NULL, '', '');
INSERT INTO `city` VALUES (220, 'йошкар-ола', 'Йошкар-Ола', 'Йошкар-Оле', 'Йошкар-Олы', 'ул. Строителей ул, д. 99Б <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 56.615, 47.8672, NULL, '', '');
INSERT INTO `city` VALUES (221, 'рязань', 'Рязань', 'Рязани', 'Рязани', '195 км Окружной дороги <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 54.5861, 39.7292, NULL, '', '');
INSERT INTO `city` VALUES (222, 'брянск', 'Брянск', 'Брянске', 'Брянска', 'ул. Марии Расковой, д. 25 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 53.3335, 34.279, NULL, '', '');
INSERT INTO `city` VALUES (223, 'новосибирск', 'Новосибирск', 'Новосибирске', 'Новосибирска', 'ул. Большая д. 280 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 55.0131, 82.8638, NULL, '', '');
INSERT INTO `city` VALUES (224, 'казань', 'Казань', 'Казани', 'Казани', 'ул. Тихорецкая, д. 19 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 55.7307, 49.1212, NULL, '', '');
INSERT INTO `city` VALUES (225, 'саратов', 'Саратов', 'Саратове', 'Саратова', 'ул. Соколовая гора, д. 5 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 51.5556, 46.0727, NULL, '', '');
INSERT INTO `city` VALUES (226, 'омск', 'Омск', 'Омске', 'Омска', 'Космический п-т, д. 109, к. 1 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 54.9827, 73.4675, NULL, '', '');
INSERT INTO `city` VALUES (227, 'воронеж', 'Воронеж', 'Воронеже', 'Воронежа', 'ул. Землячки, д. 15 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 51.711, 39.2905, NULL, '', '');
INSERT INTO `city` VALUES (228, 'пенза', 'Пенза', 'Пензе', 'Пензы', 'ул. Измайлова, д. 13 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 53.1895, 45.0371, NULL, '', '');
INSERT INTO `city` VALUES (229, 'калуга', 'Калуга', 'Калуге', 'Калуги', 'ул. Параллельная, д. 11, к. 22 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 54.5592, 36.2715, NULL, '', '');
INSERT INTO `city` VALUES (230, 'ижевск', 'Ижевск', 'Ижевске', 'Ижевска', 'ул. Пойма, д. 22 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 56.8063, 53.1968, NULL, '', '');
INSERT INTO `city` VALUES (231, 'красноярск', 'Красноярск', 'Красноярске', 'Красноярска', 'Северное шоссе, д. 5Г, стр. 26 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 56.079, 92.9443, NULL, '', '');
INSERT INTO `city` VALUES (232, 'калининград', 'Калининград', 'Калининграде', 'Калининграда', 'ул. Пригородная, д. 18-20 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 54.7255, 20.5609, NULL, '', '');
INSERT INTO `city` VALUES (233, 'ульяновск', 'Ульяновск', 'Ульяновске', 'Ульяновска', 'ул. Герасимова, д. 10И <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 54.2986, 48.2971, NULL, '', '');
INSERT INTO `city` VALUES (234, 'барнаул', 'Барнаул', 'Барнауле', 'Барнаула', 'ул. Чернышевского, д. 293А <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 53.3262, 83.7493, NULL, '', '');
INSERT INTO `city` VALUES (235, 'улан-удэ', 'Улан-Удэ', 'Улан-Удэ', 'Улан-Удэ', 'ул. Ботаническая ул, д. 38, к. 2 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 51.8423, 107.64, NULL, '', '');
INSERT INTO `city` VALUES (236, 'хабаровск', 'Хабаровск', 'Хабаровске', 'Хабаровска', 'ул. Тихоокеанская, д. 73Г/2 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 48.5038, 135.037, NULL, '', '');
INSERT INTO `city` VALUES (237, 'владивосток', 'Владивосток', 'Владивостоке', 'Владивостока', 'ул. Командорская, д. 11, стр. 11 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 43.0976, 131.977, NULL, '', '');
INSERT INTO `city` VALUES (238, 'архангельск', 'Архангельск', 'Архангельске', 'Архангельска', 'Талажское ш., д. 4, стр. 1 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 64.5707, 40.5732, NULL, '', '');
INSERT INTO `city` VALUES (239, 'мурманск', 'Мурманск', 'Мурманске', 'Мурманска', 'ул. Домостроительная, д. 16/1 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 68.9929, 33.1317, NULL, '', '');
INSERT INTO `city` VALUES (240, 'петрозаводск', 'Петрозаводск', 'Петрозаводске', 'Петрозаводска', 'ул. Зайцева, д. 65, к. 4 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 61.8126, 34.3155, NULL, '', '');
INSERT INTO `city` VALUES (241, 'петропавловск-камчатский', 'Петропавловск-Камчатский', 'Петропавловске-Камчатском', 'Петропавловска-Камчатского', 'ул. Вулканная, д. 59/3', 53.0828, 158.634, NULL, '', '');
INSERT INTO `city` VALUES (242, 'тюмень', 'Тюмень', 'Тюмени', 'Тюмени', 'ул. Одесская, д.1, стр. 8 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(пункт выдачи товара)', 57.1491, 65.6067, NULL, '', '');

-- ----------------------------
-- Table structure for file_to_brand
-- ----------------------------
DROP TABLE IF EXISTS `file_to_brand`;
CREATE TABLE `file_to_brand`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of file_to_brand
-- ----------------------------
INSERT INTO `file_to_brand` VALUES (10, 13, 'Приказ_ФНС_России_от_02_11_2012.pdf', 2);
INSERT INTO `file_to_brand` VALUES (11, 13, 'Фрагмен123т.frw', 2);
INSERT INTO `file_to_brand` VALUES (12, 13, 'Фрагмент.frw', 2);
INSERT INTO `file_to_brand` VALUES (14, 5, 'Каталог_Viking.pdf', 1);
INSERT INTO `file_to_brand` VALUES (15, 5, 'Прайс_лист_Промышленная мебель_Антистатическое оснащение.pdf', 1);
INSERT INTO `file_to_brand` VALUES (16, 25, 'Сертификат соответсвия ГОСТ.pdf', 2);
INSERT INTO `file_to_brand` VALUES (17, 25, 'Подробное описание серии Классик Лайт.pdf', 2);
INSERT INTO `file_to_brand` VALUES (18, 45, 'Инструкция по сборке.pdf', 2);
INSERT INTO `file_to_brand` VALUES (19, 45, 'Сертификат соответсвия ГОСТ.pdf', 2);
INSERT INTO `file_to_brand` VALUES (20, 46, 'ПО-12-3 Инструкция по сборке.pdf', 2);
INSERT INTO `file_to_brand` VALUES (21, 47, 'ПО-12-4 Инструкция по сборке.pdf', 2);
INSERT INTO `file_to_brand` VALUES (23, 8, 'Каталог дымоуловители Bofa.pdf', 1);
INSERT INTO `file_to_brand` VALUES (24, 8, 'Каталог дымоуловители Bofa1.pdf', 1);
INSERT INTO `file_to_brand` VALUES (25, 8, 'Каталог дымоуловители Bofa 2.pdf', 1);
INSERT INTO `file_to_brand` VALUES (26, 8, 'Каталог дымоуловители Bofa 3.pdf', 1);
INSERT INTO `file_to_brand` VALUES (27, 8, 'Каталог дымоуловители Bofa.pdf', 1);
INSERT INTO `file_to_brand` VALUES (28, 9, 'hakko.jpg', 1);
INSERT INTO `file_to_brand` VALUES (29, 76, 'Добровольный сертификат соответствия ГОСТ Р.pdf', 2);
INSERT INTO `file_to_brand` VALUES (32, 93, 'Сертификат соответствия ГОСТ Р.pdf', 2);
INSERT INTO `file_to_brand` VALUES (36, 93, 'Инструкция по сборке стола АЛЬФА.pdf', 2);
INSERT INTO `file_to_brand` VALUES (37, 117, 'Инструкция по сборке полка АЛФ-ПО.pdf', 2);
INSERT INTO `file_to_brand` VALUES (38, 122, 'Инструкция по сборке ППМ-03А.pdf', 2);
INSERT INTO `file_to_brand` VALUES (39, 123, 'Инструкция по сборке ППЧ-01А.pdf', 2);
INSERT INTO `file_to_brand` VALUES (40, 124, 'Инструкция по сборке ППК-02.pdf', 2);
INSERT INTO `file_to_brand` VALUES (41, 125, 'Инструкция по сборке ППС-01.pdf', 2);
INSERT INTO `file_to_brand` VALUES (42, 132, 'Каталог продукции VIKING.pdf', 2);
INSERT INTO `file_to_brand` VALUES (43, 133, 'Инструкция по сборке полка АЛФ-ПО.pdf', 2);
INSERT INTO `file_to_brand` VALUES (44, 134, 'Инструкция по сборке полка АЛФ-ПО.pdf', 2);
INSERT INTO `file_to_brand` VALUES (45, 135, 'Инструкция по сборке полка АЛФ-ПО.pdf', 2);
INSERT INTO `file_to_brand` VALUES (46, 199, 'Инструкция по сборке полка АЛФ-ПО.pdf', 2);
INSERT INTO `file_to_brand` VALUES (47, 200, 'Инструкция по сборке полка АЛФ-ПО.pdf', 2);
INSERT INTO `file_to_brand` VALUES (48, 299, 'тест УС-1 26.11.xlsx', 2);
INSERT INTO `file_to_brand` VALUES (49, 301, 'test1.pdf', 2);
INSERT INTO `file_to_brand` VALUES (50, 301, 'test2.pdf', 2);
INSERT INTO `file_to_brand` VALUES (51, 302, 'Инструкция по сборке стола КЛАССИК.pdf', 2);
INSERT INTO `file_to_brand` VALUES (52, 302, 'Сертификат соответствия ГОСТ Р.pdf', 2);
INSERT INTO `file_to_brand` VALUES (53, 303, 'Инструкция по сборке стола КЛАССИК.pdf', 2);
INSERT INTO `file_to_brand` VALUES (54, 303, 'Сертификат соответствия ГОСТ Р.pdf', 2);

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration`  (
  `version` varchar(180) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apply_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', 1586881179);
INSERT INTO `migration` VALUES ('m200414_162251_init_migrate', 1588449985);
INSERT INTO `migration` VALUES ('m200502_200825_test', 1588450126);

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `short_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publish` tinyint(4) NULL DEFAULT NULL,
  `meta_title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_keywords` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES (1, 'Вчера залили сайт', 'test', '81c485cf90ee949cc054c59731e94682.png', '<p>333333333</p>\r\n', '22222222', '2020-04-21 00:00:00', 1, NULL, NULL, '3');
INSERT INTO `news` VALUES (9, 'новость 2', 'novost-2', '6b4a87efc81ed144d19387d3814ca0c6.png', '', '', '2020-08-04 16:02:15', 1, NULL, NULL, NULL);
INSERT INTO `news` VALUES (10, 'Новость 3', 'novost-3', 'c0d30f38fb19218c86323a91129df17b.png', '', '', '2020-08-04 16:03:01', 1, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `region` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `delivery_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `products` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `sum` decimal(10, 0) NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 128 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES (2, '', '', '', '312321', '', NULL, '', '', 'null', '{\"25\":\"3\"}', 53316, 1, NULL);
INSERT INTO `order` VALUES (3, '', '', '', 'ghhgh', '', NULL, '', '', 'null', '{\"25\":\"1\",\"48\":\"1\"}', 24572, 0, NULL);
INSERT INTO `order` VALUES (4, 'Й', 'Й', 'Й', '123456789', 'Й', NULL, 'В', 'Ц', 'null', '{\"47\":\"2\",\"48\":\"1\"}', 16764, 1, NULL);
INSERT INTO `order` VALUES (5, '1', '1', '1', '1', '1', '2', '1', '1', 'null', '{\"25\":\"2\"}', 35544, 0, NULL);
INSERT INTO `order` VALUES (6, '1', '1', '1', '1', '1', NULL, '1', '1', 'null', '{\"25\":\"1\"}', 17772, 1, NULL);
INSERT INTO `order` VALUES (7, 'тест', 'Алексей', 'aleksey.nnm@gmail.com', '+79136177561', 'Омская область', NULL, 'ул. 30 Северная, д.66, кв.36', '', 'null', '{\"37\":\"3\"}', 75600, 1, NULL);
INSERT INTO `order` VALUES (8, '12312312312', '', '123123123', '+79081048997', '', NULL, 'regerg er greg', '', 'null', '{\"40\":\"10\",\"41\":\"2\",\"68\":\"3\",\"69\":\"5\",\"70\":\"9\"}', 226130, 1, NULL);
INSERT INTO `order` VALUES (9, 'тест', 'Алексей', 'aleksey.nnm@gmail.com', '+79136177561', 'Омская область', '1', 'ул. Венская,6', 'asdasdasdasda', 'null', '{\"68\":\"8\"}', 48848, 1, NULL);
INSERT INTO `order` VALUES (10, 'ООО \"Радиомонтаж-Мск\"', 'Антон', 'anton', '+74959793678', '', NULL, 'Лианозовский проезд. д.6', '', 'null', '{\"116\":\"1\",\"122\":\"1\",\"123\":\"1\",\"124\":\"1\",\"125\":\"1\",\"92\":\"2\"}', 67839, 1, NULL);
INSERT INTO `order` VALUES (11, 'wwefewfew', 'wefewfwe', 'wqdqwd@wqdwqqw.io', '+79081048997', '', NULL, 'regerg er greg', '', '{\"montaj\":\"on\",\"view\":\"on\",\"3d\":\"on\"}', '{\"61\":\"1\",\"76\":\"2\"}', 409832, 1, NULL);
INSERT INTO `order` VALUES (12, '', '', '', '213123123', '', '3', '', '', 'null', '{\"107\":\"1\",\"108\":\"1\"}', 41263, 1, NULL);
INSERT INTO `order` VALUES (13, '', '', '', '1231231', '', '1', '', '', 'null', '{\"107\":\"1\",\"108\":\"1\"}', 41263, 1, NULL);
INSERT INTO `order` VALUES (14, 'ООО Радиомонтаж-Мск', 'Антон', 'anton@erpribor.ru', '+74959793678', '', '1', 'Москва, Лианозовский проезд, д. 6', 'Заказать заранее пропуск', '{\"montaj\":\"on\",\"pricelist\":\"on\"}', '{\"92\":\"2\",\"116\":\"2\"}', 56190, 1, NULL);
INSERT INTO `order` VALUES (15, 'ООО Радиомонтаж-Мск', 'Антон', 'anton@erpribor.ru', '+74959793678', 'Москва', '1', 'Москва, Лианозовский проезд, д. 6', 'Заказать заранее пропуск', '{\"montaj\":\"on\",\"3d\":\"on\",\"autsor\":\"on\"}', '{\"93\":\"4\"}', 114884, 1, NULL);
INSERT INTO `order` VALUES (16, '', '', '', '1321233', '', '1', '', '', 'null', '{\"100\":\"2\",\"101\":\"1\"}', 126292, 1, 'robots.txt');
INSERT INTO `order` VALUES (17, '', '', '', '4534534', 'Москва', '1', '', '', '{\"catalog\":\"on\",\"pricelist\":\"on\"}', '{\"101\":\"1\"}', 42502, 1, '');
INSERT INTO `order` VALUES (18, 'ф', 'й', 'й', 'й', 'Москва', '2', 'ф', 'ф', '{\"pricelist\":\"on\",\"3d\":\"on\"}', '{\"103\":\"1\"}', 51267, 1, '1234.txt');
INSERT INTO `order` VALUES (19, 'ООО Радиомонтаж-Мск', 'Антон', 'anton@erpribor.ru', '+74959793678', 'Москва', '2', 'Москва, Лианозовский проезд, д. 6', 'Заказать заранее пропуск', '{\"montaj\":\"on\",\"catalog\":\"on\",\"pricelist\":\"on\"}', '{\"200\":\"1\",\"119\":\"1\",\"121\":\"1\"}', 135021, 1, '');
INSERT INTO `order` VALUES (20, 'ООО Радиомонтаж-Мск', 'Антон', 'anton@erpribor.ru', '+74959793678', 'Москва', '2', 'Москва, Лианозовский проезд, д. 6', 'Заказать заранее пропуск', '{\"autsor\":\"on\"}', '{\"200\":\"2\"}', 246912, 1, '02- Стол переупаковки с устройством деконсолидации.Общий вид.pdf');
INSERT INTO `order` VALUES (21, 'ООО Радиомонтаж-Мск', 'Антон', 'anton@erpribor.ru', '+74959793678', 'Москва', '1', 'Москва, Лианозовский проезд, д. 6', 'Заказать заранее пропуск', '{\"montaj\":\"on\",\"catalog\":\"on\",\"pricelist\":\"on\",\"view\":\"on\",\"3d\":\"on\",\"autsor\":\"on\",\"esd\":\"on\"}', '{\"153\":\"2\"}', 2468, 1, '02- Стол переупаковки с устройством деконсолидации.Общий вид.pdf');
INSERT INTO `order` VALUES (22, 'ООО Радиомонтаж-Мск', 'Антон', 'anton@erpribor.ru', '+79263366630', 'Москва', '1', 'Крупской 12, кв. 88', '', 'null', '{\"92\":\"2\"}', 48280, 1, '');
INSERT INTO `order` VALUES (23, '', '', '', '567567', 'Москва', '1', '', '', 'null', '{\"241\":\"1\"}', 142133, 1, '');
INSERT INTO `order` VALUES (24, '', '', '', '345435', 'Москва', '1', '', '', 'null', '{\"92\":\"1\"}', 24140, 1, '');
INSERT INTO `order` VALUES (25, 'ООО \"Радиомонтаж-Мск\"', 'Антон', 'buh-m@erpribor.ru', '+74959793678', 'Москва', '2', 'Лианозовский проезд. д.6', 'Нужен подьем на этаж', '{\"montaj\":\"on\",\"catalog\":\"on\",\"pricelist\":\"on\",\"view\":\"on\",\"3d\":\"on\",\"autsor\":\"on\",\"esd\":\"on\"}', '{\"93\":\"2\",\"192\":\"2\"}', 73842, 1, 'Реквизиты-Радиомонтаж-Мск.txt');
INSERT INTO `order` VALUES (26, 'ООО Радиомонтаж-Мск', 'Антон', 'anton@erpribor.ru', '+79263366630', 'Москва', '1', 'Крупской 12, кв. 88', 'Заказать заранее пропуск', '{\"montaj\":\"on\",\"catalog\":\"on\",\"pricelist\":\"on\",\"view\":\"on\",\"3d\":\"on\",\"autsor\":\"on\",\"esd\":\"on\"}', '{\"92\":\"1\",\"72\":\"1\"}', 25476, 1, '');
INSERT INTO `order` VALUES (27, 'тест', 'Алексей', 'aleksey.nnm@gmail.com', '+79136177561', 'Москва', '1', 'ул. Венская,6', '', 'null', '{\"97\":\"1\"}', 184, 1, '');
INSERT INTO `order` VALUES (28, 'ООО \"Радиомонтаж-Мск\"', '', 'buh-m@erpribor.ru', '+74959793678', 'Москва', '1', 'Лианозовский проезд. д.6', '', 'null', '{\"93\":\"1\"}', 28721, 1, '');
INSERT INTO `order` VALUES (29, 'ООО \"Радиомонтаж-Мск\"', 'Антон', 'anton@erpribor.ru', '+74959793678', 'Калуга', '2', 'Лианозовский проезд. д.6', 'Подъем на 5 этаж', '{\"montaj\":\"on\",\"catalog\":\"on\",\"pricelist\":\"on\",\"view\":\"on\",\"3d\":\"on\",\"autsor\":\"on\"}', '{\"93\":\"2\",\"122\":\"2\",\"123\":\"1\",\"124\":\"1\",\"125\":\"1\"}', 78342, 1, '');
INSERT INTO `order` VALUES (30, 'ООО \"Радиомонтаж-Мск\"', 'Антон', 'buh-m@erpribor.ru', '+74959793678', 'Барнаул', '2', 'Лианозовский проезд. д.6', 'подъем на 5 этаж', '{\"montaj\":\"on\",\"catalog\":\"on\",\"pricelist\":\"on\",\"view\":\"on\",\"3d\":\"on\",\"autsor\":\"on\"}', '{\"93\":\"2\",\"92\":\"2\"}', 105722, 1, '');
INSERT INTO `order` VALUES (31, 'ООО \"Радиомонтаж-Мск\"', 'Антон', 'buh-m@erpribor.ru', '+74959793678', 'Барнаул', '1', 'Лианозовский проезд. д.6', 'Подъем на 5 этаж', '{\"montaj\":\"on\",\"catalog\":\"on\",\"pricelist\":\"on\",\"view\":\"on\",\"3d\":\"on\",\"autsor\":\"on\"}', '{\"93\":\"2\",\"92\":\"2\"}', 105722, 1, 'Реквизиты-Радиомонтаж-Мск.txt');
INSERT INTO `order` VALUES (34, 'ООО \"Радиомонтаж-Мск\"', '', 'buh-m@erpribor.ru', '+74959793678', 'Москва', '1', 'Лианозовский проезд. д.6', '', 'null', '{\"93\":\"1\"}', 28721, 1, '');
INSERT INTO `order` VALUES (125, 'ООО \"Радиомонтаж-Мск\"', '', 'buh-m@erpribor.ru', '+74959793678', 'Пермь', '1', 'Лианозовский проезд. д.6', '', 'null', '{\"302\":\"2\"}', 16088, 0, '');
INSERT INTO `order` VALUES (126, 'ООО \"Радиомонтаж-Мск\"', '', 'buh-m@erpribor.ru', '+74959793678', 'Пермь', '1', 'Лианозовский проезд. д.6', '', 'null', '{\"302\":\"1\"}', 8044, 1, 'претензия.pdf');
INSERT INTO `order` VALUES (127, '1', '1', '1', '1', 'Москва', '2', '1', '1', '{\"montaj\":\"on\"}', '{\"303\":\"1\"}', 10580, 1, '');

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `short_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `publish` tinyint(4) NULL DEFAULT NULL,
  `meta_title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_keywords` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES (10, 'Выезд эксперта', 'vyezd-specialista', '<p><strong><span style=\"font-size:20px\">Эксперт бесплатно приедет к Вам и поможет оптимально подобрать мебель и оборудование&nbsp;для решения Ваших задач. &nbsp;</span></strong></p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Экономия времени</span></strong></p>\r\n\r\n<p>Отправьте заявку на выезд эксперта <a href=\"mailto:zakaz@pmzakaz.ru?subject=%D0%97%D0%B0%D0%BF%D1%80%D0%BE%D1%81%20%D0%BD%D0%B0%20%D0%B2%D1%8B%D0%B5%D0%B7%D0%B4%20%D1%8D%D0%BA%D1%81%D0%BF%D0%B5%D1%80%D1%82%D0%B0&amp;body=%D0%9F%D1%80%D0%BE%D1%88%D1%83%20%D0%92%D0%B0%D1%81%20\" style=\"color: #CA1E1E; text-decoration: underline\">zakaz@pmzakaz.ru</a>, и в ближайшее время эксперт с Вами свяжется для подтверждения встречи.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Проведение замеров</span></strong></p>\r\n\r\n<p>Эксперт осмотрит Ваше помещение и сделает все замеры для подготовки проекта.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Актуальная информация</span></strong></p>\r\n\r\n<p>Консультации по оптимальному подбору мебели, правильной организации Вашего рабочего пространства. Обсудим варианты комплектации мебели и подсчитаем их предварительную стоимость. Окажем помощь в разработке нестандартных изделий. Привезем для ознакомления каталоги, ответим на все вопросы, поможем определиться с выбором.&nbsp;</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Экспертное решение</span></strong></p>\r\n\r\n<p>Вы получите бесплатный 3D проект с планом расстановки мебели и местоположением каждого элемента на нем. Обсуждение особых условий для заключения договора. Выгодное коммерческое предложение, учитывающее стоимость, технические характеристики мебели, оптимальные сроки поставки и сборки.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Готовые рабочие места</span></strong></p>\r\n\r\n<p>После реализации проекта Вы получаете рабочие места с учетом Ваших пожеланий, бюджета и задач.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><span style=\"font-size:20px\">Закажите выезд эксперта, и получите готовое решение в короткие сроки и без лишних забот!</span></strong></p>\r\n', 'Подбор промышленной мебели и оборудования на Вашем предприятии', 1, 'Подбор промышленной мебели и оборудования в {city_name_pad_1} ', 'Вызов эксперта для подбора промышленной мебели и оборудования {city_name}', 'Подбор промышленной мебели и оборудования');
INSERT INTO `page` VALUES (13, 'Техническое задание', 'tehniceskoe-zadanie', '<p><strong><span style=\"font-size:20px\">Разработка технического задания для закупок.</span></strong></p>\r\n\r\n<p><strong><span style=\"font-size:20px\">Экономия времени</span></strong><br />\r\nОтправьте заявку на подготовку ТЗ <a href=\"mailto:zakaz@pmzakaz.ru?subject=Прошу подготовить техническое задание&amp;\" style=\"color: #CA1E1E; text-decoration: underline\">zakaz@pmzakaz.ru</a>, и в ближайшее время эксперт с Вами свяжется.</p>\r\n\r\n<p><strong><span style=\"font-size:20px\">Помощь с выбором</span></strong><br />\r\nКонсультации по оптимальному подбору оборудования в соответствии с Вашими требованиями и пожеланиями.&nbsp;</p>\r\n\r\n<p><strong><span style=\"font-size:20px\">Мониторинг и анализ цен</span></strong><br />\r\nИзучение сложившихся цен на продукцию и услуги.</p>\r\n\r\n<p><strong><span style=\"font-size:20px\">Техническое задание</span></strong><br />\r\nВы получите техническое задание, составленное по N 223-ФЗ или N 44-ФЗ, согласно нормам ГОСТ, ТУ и другой нормативно-технической документации.&nbsp;</p>\r\n\r\n<p>Техническое задание содержит:&nbsp;<br />\r\n- наименование товара или услуг;<br />\r\n- технические характеристики объекта торга;<br />\r\n- количество и комплектацию;<br />\r\n- сроки поставки или выполнения работ;<br />\r\n- требования с гарантии и безопасности;<br />\r\n- условия оплаты и поставки;<br />\r\n- другие требования не противоречащие условиям, обозначенными в законе.<br />\r\n&nbsp;</p>\r\n\r\n<p><span style=\"font-size:20px\"><strong>Закажите техническое задание, и получите готовое решение в короткие сроки и без лишних забот!</strong></span></p>\r\n', 'Подготовка технического задания', 1, 'Подготовка технического задания в {city_name_pad_1}', 'Подготовка технического задания для закупок', ' Подготовка технического задания, разработка технического задания в {city_name_pad_1}');
INSERT INTO `page` VALUES (14, '3D - проект производственного помещения', '3d-proekt-pomesenij', '<p><strong><span style=\"font-size:20px\">3D-проект &mdash; это бесплатный проект Вашего будущего производственного помещения с продуманной планировкой и визуализацией.</span></strong></p>\r\n\r\n<p><img alt=\"Проект производственного помещения\" src=\"/static/news/423a92f0ac360cd3515bdb088895707e.jpg\" style=\"height:268px; width:344px\" />&nbsp; &nbsp; &nbsp;<img alt=\"Проект промышленного цеха\" src=\"/static/news/a086ec8eb98b3e4f299f51147eabcae7.jpg\" style=\"height:268px; width:344px\" /></p>\r\n\r\n<p><strong><span style=\"font-size:20px\">3D-проект включает в себя:&nbsp;</span></strong></p>\r\n\r\n<p>- эскиз &mdash; план помещения с учетом необходимого количества рабочих мест, зонирования и производственных процессов-процессов.&nbsp;<br />\r\n- 3D-макет &mdash; это объемное изображение в цвете позволяющее наглядно представить будущее производственное помещение.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Экономия времени</span></strong></p>\r\n\r\n<p>Оставьте заявку на 3D-проект на <a href=\"mailto:zakaz@pmzakaz.ru\" style=\"color: #CA1E1E; text-decoration: underline\">zakaz@pmzakaz.ru</a>, эксперт все сделает за Вас &mdash; от замеров до воплощения проекта.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Проведение замеров</span></strong></p>\r\n\r\n<p>За один визит эксперт проведет работы по замерам помещения для подготовки проекта.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Помощь с выбором</span></strong></p>\r\n\r\n<p>Консультация эксперта поможет определиться с планировкой будущего помещения и выбором промышленной мебели.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Наглядный результат</span></strong></p>\r\n\r\n<p>3D -проект, созданный с учетом Ваших предпочтений по оснащению и производственным-задачам.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Эргономичное производство</span></strong></p>\r\n\r\n<p>Вы получаете продуманное и комфортное рабочее пространство, которое становится основой для продуктивной работы и развития Вашего бизнеса.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">3D-проектировшик помещений</span></strong></p>\r\n\r\n<p><img alt=\"3-D проектировщик помещений \" src=\"/static/news/1bb57f7fe8a35438e881fb75de122661.jpg\" style=\"height:268px; width:344px\" /></p>\r\n\r\n<p>Программа для планирования, проектирования и визуализации вариантов оснащения помещений и цехов промышленной мебелью VIKING. По заданным размерам производственного помещения Вы расставите мебель и подберете отделочные материалы.</p>\r\n\r\n<p>Создайте свое помещение, получите спецификацию с планом расстановки и перечнем мебели - отправьте ее Нашим специалистам для получения полной информации&nbsp;о ценах и сроках поставки на e-mail:&nbsp;<a href=\"mailto:zakaz@pmzakaz.ru?%20subject=Заявка на просчет мебели для производственного помещения\" style=\"color: #CA1E1E; text-decoration: underline\">zakaz@pmzakaz.ru</a>.</p>\r\n\r\n<p><a href=\"/static/news/1f74cf6b433709e8779e945463acfccd.pdf\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">Скачать&nbsp;инструкцию по работе с 3D проектировщиком &gt;&gt;</a><br />\r\n<br />\r\n<a href=\"http://www.outline3d.ru/main/check.php?ver=dipaul\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">Спроектировать помещение онлайн&gt;&gt;</a></p>\r\n', '3D - проект производственного помещения', 1, '3D - проект производственного помещения, цеха в {city_name_pad_1}', 'Программа для планирования, проектирования и визуализации вариантов оснащения помещений и цехов промышленной мебелью VIKING. ', 'проект производственного помещения, проект промышленного цеха в {city_name_pad_1}');
INSERT INTO `page` VALUES (15, 'Конструктор промышленной мебели', 'konstruktor-mebeli', '<p style=\"text-align:center\"><span style=\"font-size:20px\"><strong>Конструктор рабочего места онлайн.</strong></span></p>\r\n\r\n<p>Составьте Ваше рабочее место из готовых модулей различных серий мебели. Результат сохраните и отправьте Нашим специалистам для получения полной информации&nbsp;о ценах и сроках поставки на e-mail: <a href=\"mailto:zakaz@pmzakaz.ru? subject=Прошу уточнить стоимость заказа?\" style=\"color: #CA1E1E; text-decoration: underline\">zakaz@pmzakaz.ru</a>.</p>\r\n\r\n<p style=\"text-align:center\"><iframe align=\"center\" frameborder=\"0\" height=\"1200\" src=\"https://vkg.ru/constructor-partner/classic/\" width=\"1000\"></iframe></p>\r\n', 'Конструктор промышленной мебели', 1, 'Конструктор промышленной мебели в {city_name_pad_1}', 'Составьте свое рабочее место из готовых модулей в {city_name_pad_1}', 'Конструктор промышленной мебели');
INSERT INTO `page` VALUES (16, 'Сборка мебели', 'sborka-mebeli', '<p><strong><span style=\"font-size:20px\">Наши специалисты оперативно соберут и расставят заказанную Вами мебель.</span></strong><br />\r\n&nbsp;<br />\r\n<strong><span style=\"font-size:20px\">Длительный срок службы и гарантии</span></strong></p>\r\n\r\n<p>Соблюдение технологии и квалифицированные сборщики обеспечивают высокий уровень работ и исключают ошибки, которые могут влиять на качество и срок эксплуатации мебели.&nbsp;</p>\r\n\r\n<p>&nbsp;&nbsp;<br />\r\n<strong><span style=\"font-size:20px\">Готовые рабочие места в кратчайшие сроки</span></strong></p>\r\n\r\n<p>Сборка большого объема мебели в короткие сроки.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Заказать сборку и установку промышленной мебели и утонить стоимость работ уточняйте у консультантов нашей компании <a href=\"mailto:zakaz@pmzakaz.ru?%20subject=Заявка на сборку мебели.\" style=\"color: #CA1E1E; text-decoration: underline\">zakaz@pmzakaz.ru</a>.</span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"Оборудование сервисного центра\" src=\"/static/news/9c60b281182f3177ce37669609e0ae67.jpg\" style=\"height:269px; width:344px\" />&nbsp; &nbsp; &nbsp;<img alt=\"Промышленная мебель для учебного центра\" src=\"/static/news/e358aaaba400f0ee2cc51368fab1493a.jpg\" style=\"height:268px; width:344px\" />&nbsp; &nbsp; &nbsp;<img alt=\"Радиомонтажный цех\" src=\"/static/news/ac5a8a90db78efd14c1d4c9a7af60802.jpg\" style=\"height:268px; width:344px\" />&nbsp; &nbsp; &nbsp;<img alt=\"Рабочие места для пайки\" src=\"/static/news/407217669cba574bcd1afa83ecab4e7f.jpg\" style=\"height:268px; width:344px\" />&nbsp; &nbsp; &nbsp;<img alt=\"Тяжелый верстак\" src=\"/static/news/616e3566430bf8ba49b0d8d75c510be9.jpg\" style=\"height:268px; width:344px\" /></p>\r\n', 'Сборка промышленной мебели', 1, 'Сборка промышленной мебели в {city_name_pad_1}', 'Сборка промышленной мебели', 'Сборка промышленной мебели в  {city_name_pad_1}');
INSERT INTO `page` VALUES (17, 'Паяльное оборудование', 'paalnoe-oborudovanie', '', '', 1, NULL, NULL, NULL);
INSERT INTO `page` VALUES (18, 'Измерительные приборы', 'izmeritelnye-pribory', '', '', 1, NULL, NULL, NULL);
INSERT INTO `page` VALUES (19, 'О компании', 'o-kompanii', '<p><strong><span style=\"font-size:20px\">Миссия</span></strong><br />\r\nСделать лучше каждый Ваш день на производсве, создавая комфортные рабочее места.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Видение</span></strong><br />\r\nПолный комплекс услуг для создания эффективной рабочей среды под Ваши производственные задачи-задачи:&nbsp;<a href=\"/vyezd-specialista\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">Выезд эксперта</a>,&nbsp;<a href=\"/konstruktor-mebeli\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">Конструктор мебели</a>,&nbsp;<a href=\"/3d-proekt-pomesenij\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">3D-проект помещения</a>,&nbsp;<a href=\"/tehniceskoe-zadanie\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">Подготовка ТЗ</a>,&nbsp;<a href=\"/sborka-mebeli\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">Сборка мебели</a>.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">3 тысячи</span></strong><br />\r\nУспешно выпоненных поставок в рамках государственных и коммерческих контрактов. Нам доверяют:</p>\r\n\r\n<p><img alt=\"\" src=\"/static/news/0aea2e9ebceff0aa0e00a399d625aca0.jpg\" style=\"height:69px; width:200px\" />&nbsp; &nbsp;<img alt=\"\" src=\"/static/news/490b3a5467efbee442cf56375539d12a.jpg\" style=\"height:70px; width:200px\" />&nbsp; &nbsp;<img alt=\"\" src=\"/static/news/a5ebccdba90d7a95a16ea4ec0be920a9.jpg\" style=\"height:70px; width:200px\" />&nbsp; &nbsp;<img alt=\"\" src=\"/static/news/235873d42e2bea587ad0204b9605db24.jpg\" style=\"height:70px; width:200px\" />&nbsp; &nbsp;<img alt=\"\" src=\"/static/news/1d97814b314c258f97330cffed0872fb.jpg\" style=\"height:70px; width:200px\" />&nbsp; &nbsp;<img alt=\"\" src=\"/static/news/25236ef3e366555bd55c7f8ab0936bcd.jpg\" style=\"height:69px; width:200px\" />&nbsp; &nbsp;<img alt=\"\" src=\"/static/news/d3d13e81336c621f314c71ad643bd9dc.jpg\" style=\"height:70px; width:200px\" />&nbsp; &nbsp;<img alt=\"\" src=\"/static/news/168f1f8faab673e6775e7ab95c96ed79.jpg\" style=\"height:70px; width:200px\" /></p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">7 лет</span></strong><br />\r\nЯвляемся надежным партнером в поставках промышленной мебели и оборудования.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">18 тысяч</span></strong><br />\r\nНаименований мебели и оборудования обеспечивают широкий выбор.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">52 пункта выдачи товара</span></strong><br />\r\nЧтобы быть ближе к Вам.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Официальные дилеры</span></strong><br />\r\nРаботаем напрямую с заводами производителями, что позволяет поставлять мебель и оборудование в кратчайшие сроки.</p>\r\n\r\n<p><img alt=\"Промышленная антистатическая мебель и оборудование\" src=\"/static/news/2f2b53f5e375f2800384c6e7e6648a39.jpg\" style=\"height:70px; width:200px\" />&nbsp; &nbsp;<img alt=\"Промышленная антистатическая мебель и оборудование\" src=\"/static/news/8f430e958b88d4ca4edaad46f8207195.jpg\" style=\"height:70px; width:200px\" />&nbsp; &nbsp;<img alt=\"Промышленная антистатическая мебель и оборудование\" src=\"/static/news/83b7667b206f86ae7398f3ae43eae38e.jpg\" style=\"height:70px; width:200px\" />&nbsp; &nbsp;<img alt=\"Металлическая мебель\" src=\"/static/news/ef1f19a7ffb0a750b501e566ca38dd2b.jpg\" style=\"height:70px; width:200px\" />&nbsp; &nbsp;<img alt=\"Дымоуловители\" src=\"/static/news/684b836a67ecb5621205842023b8a7db.jpg\" style=\"height:70px; width:200px\" />&nbsp; &nbsp;<img alt=\"Паяльное оборудование\" src=\"/static/news/217885e5fcd80c93589ee2a8422c61c6.jpg\" style=\"height:70px; width:200px\" />&nbsp; &nbsp;<img alt=\"Паяльное оборудование\" src=\"/static/news/3c14e8d0920021f2d0364427f02c7af9.jpg\" style=\"height:70px; width:200px\" />&nbsp; &nbsp;<img alt=\"Дымоприемники\" src=\"/static/news/7150555ff60457b1586e598a46a0294f.jpg\" style=\"height:70px; width:200px\" /></p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Профессиональные консультации</span></strong><br />\r\nНаши менеджеры ответят на любые технические вопросы. Подберут товар по характеристикам.</p>\r\n', '', 1, NULL, NULL, NULL);
INSERT INTO `page` VALUES (20, 'Доставка по России', 'dostavka-po-rossii', '<p><br />\r\n<strong><span style=\"font-size:20px\">Доставка по России</span></strong></p>\r\n\r\n<p>Доставка до склада Покупателя по России осуществляется <a href=\"https://www.dellin.ru/\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">ТК &quot;Деловые Линии&quot;</a> или <a href=\"https://pecom.ru/\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">ТК &quot;ПЭК&quot;</a> по запросу и за счет заказчика. Оплата за перевозку груза включается в стоимость продукции или прописывается отдельной строкой в счете и производится по тарифам транспортной компании. Ориентировочную стоимость и сроки доставки Вы можете утонить в калькуляторе доставки <a href=\"https://pecom.ru/services-are/shipping-request/\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">ТК &quot;ПЭК&quot;</a>, <a href=\"https://www.dellin.ru/requests/?arrival_point_code=7800000000000000000000000&amp;arrival_variant=toDoor&amp;derival_point_code=7700000000000000000000000&amp;derival_variant=toDoor&amp;height=0.1&amp;length=0.1&amp;sized_volume=0.1&amp;sized_weight=1&amp;width=0.1\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">ТК &quot;Деловые Линии&quot;</a> или у Наших специалистов. &nbsp;Объем упаковки и вес указаны на странице товара и в корзине при оформлении покупки. В стоимость доставки включается обязательное страхование груза и дополнительная упаковка. Если Вы работаете с другими транспортными компаниями - Мы готовы отправить Ваш груз выбранной Вами транспортной компанией.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Бесплатная доставка до терминала транспортной компании и отправка в адрес покупателя</span></strong></p>\r\n\r\n<p>В зависимости от производителя продукции осуществляем бесплатную доставку до терминала <a href=\"https://www.dellin.ru/\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">ТК &quot;Деловые Линии&quot;</a>,<a href=\"https://pecom.ru/\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\"> ТК &quot;ПЭК&quot;</a> и отправку в адрес Покупателя. Оплата за перевозку груза производится по тарифам транспортной компании. Ориентировочную стоимость и сроки доставки Вы можете утонить в калькуляторе доставки <a href=\"https://pecom.ru/services-are/shipping-request/\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">ТК &quot;ПЭК&quot;</a>, <a href=\"https://www.dellin.ru/requests/?arrival_point_code=7800000000000000000000000&amp;arrival_variant=toDoor&amp;derival_point_code=7700000000000000000000000&amp;derival_variant=toDoor&amp;height=0.1&amp;length=0.1&amp;sized_volume=0.1&amp;sized_weight=1&amp;width=0.1\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">ТК &quot;Деловые Линии&quot;</a> или у Наших специалистов. &nbsp;Объем упаковки и вес указаны на странице товара и в корзине при оформлении покупки. В стоимость доставки включается обязательное страхование груза и дополнительная упаковка. Если Вы работаете с другими транспортными компаниями - Мы готовы отправить Ваш груз выбранной Вами транспортной компанией.</p>\r\n\r\n<p>&nbsp;<br />\r\n<strong><span style=\"font-size:20px\">Доставка экспресс-почтой</span></strong></p>\r\n\r\n<p>Мы работаем с несколькими курьерскими службами доставки <a href=\"https://www.cityexpress.ru/\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">&quot;CITY EXPRESS&quot;</a>, <a href=\"https://www.cdek.ru/ru\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">&quot;СДЭК&quot;</a>, <a href=\"https://www.pochta.ru/emspost/\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">&quot;EMS&quot;</a>, <a href=\"https://www.ponyexpress.ru/\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">&quot;ПОНИ-ЭКСПРЕСС&quot;</a>, <a href=\"https://www.dpd.ru/\" style=\"color: #CA1E1E; text-decoration: underline\" target=\"_blank\">&quot;DPD&quot;</a>. Предложите Ваш вариант, если курьерская служба с которой Вы работаете здесь не указана.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Самовывоз со склада производства</span></strong></p>\r\n\r\n<p>В зависимости от производителя Вы можете забрать продукцию на складе производства в г. Санкт-Петербург, г. Екатеринбург, г. Москва. Адреса складов утоняйте у Наших специалистов.</p>\r\n\r\n<p><br />\r\n<strong><span style=\"font-size:20px\">Самовывоз с центрального склада</span></strong></p>\r\n\r\n<p>Стоимость доставки со склада производства на склад в Москве оплачивается за счет заказчика. Обращаем внимание, что центральный склад работает с 10:00 до 17:00 и расположен по адресу: Россия, Москва, Лианозовский проезд, д.6.</p>\r\n', 'Доставка по России, бесплатная доставка до терминала транспортной компании и отправка в адрес покупателя, доставка экспресс-почтой, Самовывоз со склада производства, Самовывоз с центрального склада.', 1, NULL, NULL, NULL);
INSERT INTO `page` VALUES (21, 'Ваш заказ принят!', 'vash-zakaz-prinyat', '<h1>Ваш заказ принят.</h1>\r\n\r\n<p>Ваш заказ принят в работу, менеджер свяжется с вами в ближайшее время.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Ваш заказ принят!', 1, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for params
-- ----------------------------
DROP TABLE IF EXISTS `params`;
CREATE TABLE `params`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `popup_banner` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `popup_banner_2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `popup_banner_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `popup_banner_link_2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `main_domain` int(11) NULL DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `meta_title_product` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_desc_product` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_title_category` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_desc_category` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_title_brand` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_desc_brand` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_title_news` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_desc_news` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_title_page` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_desc_page` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_title_main` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_desc_main` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_keywords_product` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_keywords_category` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_keywords_brand` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_keywords_news` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_keywords_page` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_keywords_main` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_title_series` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_desc_series` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_keywords_series` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of params
-- ----------------------------
INSERT INTO `params` VALUES (1, '85381e8fb0c7a1341aed53f7f6f26eec.png', '85666e8bf1229cd9403e1c23c4d89a6a.png', '', '', 192, '8 800 000 00 00', 'zakaz@pmzakaz.ru', '{product_name} в {city_name_pad_1}', '{product_description} ', '{category_name} в {city_name_pad_1}  купить по низкой цене со скидкой и доставкой.  В наличии и под заказ.', '{category_name} в {city_name_pad_1} — широкий ассортимент от ведущих производителей. Купить {category_name} со склада и под заказ по низким ценам и заказать: доставку, сборку, выезд эксперта, вид рабочего места, 3D-проект помещения, подготовку ТЗ.', '{brand_name} в {city_name_pad_1}', '{brand_name} в {city_name_pad_1}', NULL, NULL, NULL, NULL, 'Промышленная и антистатическая мебель в {city_name_pad_1}  купить по низкой цене со скидкой и доставкой.  В наличии и под заказ.', 'Промышленная и антистатическая мебель в {city_name_pad_1} — широкий ассортимент от ведущих производителей. Купить со склада и под заказ по низким ценам и заказать: доставку, сборку, выезд эксперта, вид рабочего места, 3D-проект помещения, подготовку ТЗ.', '{product_name} в {city_name_pad_1}', '{category_name}', '{brand_name} в {city_name_pad_1}', NULL, NULL, 'промышленная мебель антистатическая мебель', '22', '33', '');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) UNSIGNED NULL DEFAULT 0,
  `brand_id` int(11) UNSIGNED NULL DEFAULT 0,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `price` float NULL DEFAULT NULL,
  `price_eur` float NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT 0,
  `meta_title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_keywords` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `video` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `alt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description_short` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `order` int(11) NULL DEFAULT NULL,
  `delivery_type` int(11) NULL DEFAULT NULL,
  `execution` int(11) NULL DEFAULT NULL,
  `construct_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_product_category`(`category_id`) USING BTREE,
  INDEX `FK_product_brand`(`brand_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 304 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (61, 1, 6, 'Стул антистатический СП-230 ESD', 'stul-antistaticeskij-sp-230-esd', 'Стул антистатический СП-230 ESD - лабораторный антистатический стул из вспененного негорючего термостойкого полиуретана.', 11342, NULL, 1, NULL, NULL, NULL, '2020-08-16 04:49:29', NULL, 0, '', 'Стул антистатический СП-230 ESD', 9999, NULL, NULL, '');
INSERT INTO `product` VALUES (62, 71, 7, 'Стул антистатический СП-290 ESD', 'stul-antistaticeskij-sp-290-esd', 'Промышленный полиуретановый стул с подлокотниками СП-290 ESD разработан специально для обеспечения комфортной и безопасной работы.', 15076, NULL, 1, NULL, NULL, NULL, '2020-08-16 04:49:29', NULL, 0, NULL, 'Стул антистатический СП-290 ESD', NULL, NULL, NULL, NULL);
INSERT INTO `product` VALUES (68, 67, 5, 'Стол универсальный СУ-12-5', 'stol-universalnyj-su-12-5', 'Универсальный рабочий стол Viking (СУ) представляет собой упрощенную конструкцию базового антистатического стола без возможности наращивания.', 6106, NULL, 1, NULL, NULL, NULL, '2020-08-16 04:50:09', NULL, 0, '', 'Универсальный рабочий стол Viking СУ-12-5', 0, NULL, NULL, NULL);
INSERT INTO `product` VALUES (69, 67, 8, 'Стол универсальный СУ-15-5', 'stol-universalnyj-su-15-5', 'Универсальный рабочий стол Viking (СУ) представляет собой упрощенную конструкцию базового антистатического стола без возможности наращивания.', 7304, NULL, 1, NULL, NULL, NULL, '2020-08-16 04:50:09', NULL, 0, NULL, 'Универсальный рабочий стол Viking СУ-15-5', NULL, NULL, NULL, NULL);
INSERT INTO `product` VALUES (70, 1, 5, 'Стол универсальный СУ-18-5', 'stol-universalnyj-su-18-5', 'Универсальный рабочий стол Viking (СУ) представляет собой упрощенную конструкцию базового антистатического стола без возможности наращивания.', 91.35, 1, 0, NULL, NULL, NULL, '2020-08-16 04:50:09', NULL, 0, '', 'Универсальный рабочий стол Viking СУ-18-5', 9999, NULL, NULL, '');
INSERT INTO `product` VALUES (71, 72, 6, 'Комплект пластиковых колес КА-3 ESD', 'komplekt-plastikovyh-koles-ka-3-esd', 'Комплект пластиковых токопроводящих колес КА-3 для стула.', 1340, NULL, 1, NULL, NULL, NULL, '2020-08-16 04:53:13', NULL, 0, NULL, 'Комплект пластиковых колес КА-3 ESD', NULL, NULL, NULL, NULL);
INSERT INTO `product` VALUES (72, 1, 7, 'Комплект опор-1 ESD', 'komplekt-opor-1-esd', 'Опора - одна ножка ESD пластиковая токопроводящая для стула.', 1336, NULL, 1, NULL, NULL, NULL, '2020-08-16 04:53:13', NULL, 0, '', 'Комплект опор-1 ESD', 9999, NULL, NULL, '');
INSERT INTO `product` VALUES (73, 72, 7, 'Набор подлокотников', 'nabor-podlokotnikov', 'Подходят ко всем стульям СП а так же к СТ-113.', 1377, NULL, 1, NULL, NULL, NULL, '2020-08-16 04:53:13', NULL, 0, NULL, 'Набор подлокотников', NULL, NULL, NULL, NULL);
INSERT INTO `product` VALUES (74, 72, 6, 'Опорное кольцо для ног КДН-1 ESD', 'opornoe-kolco-dla-nog-kdn-1-esd', 'Опорное кольцо для ног КДН-1 антистатическое', 2958, NULL, 1, NULL, NULL, NULL, '2020-08-16 04:53:13', NULL, 0, NULL, 'Опорное кольцо для ног КДН-1 антистатическое', NULL, NULL, NULL, NULL);
INSERT INTO `product` VALUES (75, 72, 6, 'Газлифт пневматический ход 200 мм', 'gazlift-pnevmaticeskij-hod-200-mm', 'Газлифт для антистатических стульев БЕЛТЕМА СП-280, СП-290, СП-270, СТ-113.', 1938, NULL, 1, NULL, NULL, NULL, '2020-08-16 04:53:13', NULL, 0, NULL, 'Газлифт пневматический ход 200 мм', NULL, NULL, NULL, NULL);
INSERT INTO `product` VALUES (76, 75, 5, 'Шкаф сухого хранения DC-1', 'Shkaf-suhogo-khraneniiaDC-1', 'Шкафы сухого хранения VIKING серии DС — оборудование, предназначенное для обеспечения ультранизких значений относительной влажности, что необходимо для хранения влагочувствительных компонентов и материалов, электрорадиоэлементов, печатных плат, пластин, кассет, электронных модулей и других изделий радиоэлектронной техники. \r\n\r\nТиповое применение шкафов сухого хранения — оснащение лабораторий, полупроводниковых производств, межоперационное и складское хранение компонентов, печатных плат и смонтированных модулей.', 199245, NULL, 1, 'Шкаф сухого хранения односекционный серии DC-1 ESD', 'Шкаф сухого хранения односекционный серии DC-1 ESD', NULL, '2020-08-17 16:24:23', NULL, 0, 'Шкаф сухого хранения односекционный серии DC-1 ESD', 'односекционный для обеспечения ультранизких значений влажности.', 3, NULL, NULL, NULL);
INSERT INTO `product` VALUES (77, 75, 5, 'Шкаф сухого хранения DC1', 'testovii-shkaf-DC1', '', 15000, NULL, 1, NULL, NULL, NULL, '2020-08-17 18:47:28', NULL, 0, '', '', 2, NULL, NULL, NULL);
INSERT INTO `product` VALUES (92, 95, 5, 'АЛФ-12-7 Стол рабочий АЛЬФА ', 'alf-12-7-stol-rabocij-serii-alfa', 'Удобный и компктный стол. Рабочие поверхности легко регулируются по высоте.\r\n\r\nСтол поставляется в комплекте с верхней и нижней перфорированными панелями.', 24140, NULL, 0, NULL, NULL, NULL, '2020-08-19 15:32:48', NULL, 0, 'АЛФ-12-7 Стол рабочий серии АЛЬФА', 'для инженерного и производственного персонала.', 20, 1, 0, 'https://vkg.ru/constructor-partner/alpha/');
INSERT INTO `product` VALUES (93, 95, 5, 'АЛФ-15-7 Стол рабочий АЛЬФА', 'alf-15-7-stol-rabocij-serii-alfa', 'Удобный и компктный стол. Рабочие поверхности легко регулируются по высоте.\r\n\r\nСтол поставляется в комплекте с верхней и нижней перфорированными панелями.', 28721, NULL, 0, NULL, NULL, NULL, '2020-08-19 15:32:48', NULL, 0, 'АЛФ-15-7 Стол рабочий серии АЛЬФА', 'для инженерного и производственного персонала.', 22, 1, 0, 'https://vkg.ru/constructor-partner/alpha/');
INSERT INTO `product` VALUES (94, 95, 5, 'АЛФ-18-7 Стол рабочий АЛЬФА', 'alf-18-7-stol-rabocij-serii-alfa', 'Удобный и компктный стол. Рабочие поверхности легко регулируются по высоте.\r\n\r\nСтол поставляется в комплекте с верхней и нижней перфорированными панелями.', 30420, NULL, 0, NULL, NULL, NULL, '2020-08-19 15:32:48', NULL, 0, '', 'для инженерного и производственного персонала.', 24, 1, 0, 'https://vkg.ru/constructor-partner/alpha/');
INSERT INTO `product` VALUES (95, 124, 5, 'АЛФ-12-7 ESD Стол рабочий АЛЬФА антистатический', 'alf-12-7-esd-stol-rabocij-serii-alfa', 'Удобный и компктный антистатический стол. Рабочие поверхности легко регулируются по высоте.\r\n\r\nСтол поставляется в комплекте с верхней и нижней перфорированными панелями.', 31048, NULL, 0, NULL, NULL, NULL, '2020-08-19 15:32:48', NULL, 0, '', 'антистатический для производственного персонала.', 21, 1, 1, 'https://vkg.ru/constructor-partner/alpha/');
INSERT INTO `product` VALUES (96, 124, 5, 'АЛФ-15-7 ESD Стол рабочий АЛЬФА антистатический', 'alf-15-7-esd-stol-rabocij-serii-alfa', 'Удобный и компктный антистатический стол. Рабочие поверхности легко регулируются по высоте.\r\n\r\nСтол поставляется в комплекте с верхней и нижней перфорированными панелями.', 33032, NULL, 0, NULL, NULL, NULL, '2020-08-19 15:32:48', NULL, 0, '', 'антистатический для производственного персонала.', 23, 1, 1, '');
INSERT INTO `product` VALUES (97, 124, 5, 'АЛФ-18-7 ESD Стол рабочий АЛЬФА антистатический', 'alf-18-7-esd-stol-rabocij-serii-alfa', 'Удобный и компктный антистатический стол. Рабочие поверхности легко регулируются по высоте.\r\n\r\nСтол поставляется в комплекте с верхней и нижней перфорированными панелями.', 183.63, NULL, 0, NULL, NULL, NULL, '2020-08-19 15:32:48', NULL, 0, '', 'антистатический для производственного персонала.', 25, 1, 1, '');
INSERT INTO `product` VALUES (111, 86, 5, 'АЛФ-Т-15-8 Стол АЛЬФА Т-образный', 'alf-t-15-8-stol-alfa-t-obraznyj', 'Упрощенная Т-образная конструкция стола серии АЛЬФА без возможности дополнительной комплектации. Дополнительная устойчивость и повышенная до 300 кг распределенная нагрузка на столешницу.\r\n\r\nВозможна установка короба с электромонтажной панелью, подвесных тумб.', 17979, NULL, 1, NULL, NULL, NULL, '2020-08-19 15:32:48', NULL, 0, '', 'с усиленной столешницей. ', 0, NULL, NULL, NULL);
INSERT INTO `product` VALUES (112, 86, 5, 'АЛФ-Т-18-8 Стол АЛЬФА Т-образный', 'alf-t-18-8-stol-alfa-t-obraznyj', 'Упрощенная Т-образная конструкция стола серии АЛЬФА без возможности дополнительной комплектации. Дополнительная устойчивость и повышенная до 300 кг распределенная нагрузка на столешницу.\r\n\r\nВозможна установка короба с электромонтажной панелью, подвесных тумб.', 18672, NULL, 1, NULL, NULL, NULL, '2020-08-19 15:32:48', NULL, 0, '', 'с усиленной столешницей. ', 0, NULL, NULL, NULL);
INSERT INTO `product` VALUES (114, 86, 5, 'АЛФ-Т-15-8 ESD Стол АЛЬФА Т-образный', 'alf-t-15-8-esd-stol-alfa-t-obraznyj', 'Упрощенная Т-образная конструкция антистатического стола серии АЛЬФА без возможности дополнительной комплектации. Дополнительная устойчивость и повышенная до 300 кг распределенная нагрузка на столешницу.\r\n\r\nВозможна установка короба с электромонтажной панелью, подвесных тумб.', 19770, NULL, 1, NULL, NULL, NULL, '2020-08-19 15:32:48', NULL, 0, '', 'антистатический с усиленной столешницей. ', 0, NULL, NULL, NULL);
INSERT INTO `product` VALUES (115, 86, 5, 'АЛФ-Т-18-8 ESD Стол АЛЬФА Т-образный', 'alf-t-18-8-esd-stol-alfa-t-obraznyj', 'Упрощенная Т-образная конструкция антистатического стола серии АЛЬФА без возможности дополнительной комплектации. Дополнительная устойчивость и повышенная до 300 кг распределенная нагрузка на столешницу.\r\n\r\nВозможна установка короба с электромонтажной панелью, подвесных тумб.', 21839, NULL, 1, NULL, NULL, NULL, '2020-08-19 15:32:48', NULL, 0, '', 'антистатический с усиленной столешницей. ', 1, NULL, NULL, NULL);
INSERT INTO `product` VALUES (116, 1, NULL, 'АЛФ-ПО-12-3 Полка для оборудования', 'alf-po-12-3-polka-dla-oborudovania', 'Основная полка для оборудования для серии АЛЬФА. Дополнительно\r\nустанавливаемая полка.', 3955, NULL, 1, NULL, NULL, NULL, '2020-08-20 15:25:15', NULL, 0, '', 'дополнительно устанавливаемая полка.', 0, NULL, NULL, '');
INSERT INTO `product` VALUES (117, 1, NULL, 'АЛФ-ПО-15-3 Полка для оборудования', 'alf-po-15-3-polka-dla-oborudovania', 'Основная полка для оборудования для серии АЛЬФА. Дополнительно\r\nустанавливаемая полка.', 4190, NULL, 1, NULL, NULL, NULL, '2020-08-20 15:25:15', NULL, 0, '', 'дополнительно устанавливаемая полка.', 0, NULL, NULL, '');
INSERT INTO `product` VALUES (118, 1, NULL, 'АЛФ-ПО-18-3 Полка для оборудования', 'alf-po-18-3-polka-dla-oborudovania', 'Основная полка для оборудования для серии АЛЬФА. Дополнительно\r\nустанавливаемая полка.', 4572, NULL, 1, NULL, NULL, NULL, '2020-08-20 15:25:15', NULL, 0, '', 'дополнительно устанавливаемая полка.', 0, NULL, NULL, '');
INSERT INTO `product` VALUES (119, 1, NULL, 'АЛФ-ПО-12-3 ESD Полка для оборудования', 'alf-po-12-3-esd-polka-dla-oborudovania', 'Основная антистатическая полка для оборудования для серии АЛЬФА. Дополнительно устанавливаемая полка.', 5317, NULL, 1, NULL, NULL, NULL, '2020-08-20 15:25:15', NULL, 0, '', 'дополнительно устанавливаемая антистатическая полка.', 9999, NULL, NULL, '');
INSERT INTO `product` VALUES (120, 1, NULL, 'АЛФ-ПО-15-3 ESD Полка для оборудования', 'alf-po-15-3-esd-polka-dla-oborudovania', 'Основная антистатическая полка для оборудования для серии АЛЬФА. Дополнительно устанавливаемая полка.', 5804, NULL, 1, NULL, NULL, NULL, '2020-08-20 15:25:15', NULL, 0, '', 'дополнительно устанавливаемая антистатическая полка.', 9999, NULL, NULL, '');
INSERT INTO `product` VALUES (121, 1, NULL, 'АЛФ-ПО-18-3 ESD Полка для оборудования', 'alf-po-18-3-esd-polka-dla-oborudovania', 'Основная антистатическая полка для оборудования для серии АЛЬФА. Дополнительно устанавливаемая полка.', 6248, NULL, 1, NULL, NULL, NULL, '2020-08-20 15:25:15', NULL, 0, '', 'дополнительно устанавливаемая антистатическая полка.', 9999, NULL, NULL, '');
INSERT INTO `product` VALUES (122, 68, 5, 'ППМ-03/А Подставка для монитора ', 'ppm-03a-podstavka-dla-monitora', 'Подставка для монитора. Предназначена для размещения монитора на раб очем месте.\r\n\r\nПодставка выполнена в виде выдвижного кронштейна, крепится на боковые стойки и с помощью 3 поворотных узлов позволяет установить монитор в удобное положение. ', 5296, NULL, 1, NULL, NULL, NULL, '2020-08-20 16:02:18', NULL, 0, '', ' для столов на алюминиевом профиле.', 0, NULL, NULL, NULL);
INSERT INTO `product` VALUES (123, 68, 5, 'ППЧ-01/А Подставка для чертежей', 'ppc-01a-podstavka-dla-certezej', 'Подставка для чертежей. Предназначена для размещения чертежей на рабочем месте, поставляется в комплекте с 2 магнитами для крепления документов.\r\n\r\nПодставка выполнена в виде выдвижного кронштейна, крепится на боковые стойки и с помощью 3 поворотных узлов устанавливается в удобное для работника положение.', 6171, NULL, 1, NULL, NULL, NULL, '2020-08-20 16:02:18', NULL, 0, '', ' для столов на алюминиевом профиле.', 0, NULL, NULL, NULL);
INSERT INTO `product` VALUES (124, 68, 5, 'ППК-02 Подставка под клавиатуру', 'ppk-02-podstavka-pod-klaviaturu', 'Подставка под клавиатуру. Выполнена из металла, снабжена механизмом легкого скольжения.', 1947, NULL, 1, NULL, NULL, NULL, '2020-08-20 17:00:25', NULL, 0, '', '', 0, NULL, NULL, NULL);
INSERT INTO `product` VALUES (125, 68, 5, 'ППС-01 Подставка под системный блок подкатная', 'pps-01-podstavka-pod-sistemnyj-blok-podkatnaa', 'Подставка под системный блок подкатная. Мобильная напольная подставка на\r\nколесах для установки системного блока.', 2190, NULL, 1, NULL, NULL, NULL, '2020-08-20 17:00:25', NULL, 0, '', '', 0, NULL, NULL, NULL);
INSERT INTO `product` VALUES (133, 1, 5, 'Основная полка для оборудования серии Альфа', 'osnovnaa-polka-dla-oborudovania-dla-serii-alfa', 'Основная полка для оборудования для серии Альфа', 3955, NULL, 1, 'Основная полка для оборудования для серии Альфа', 'Основная полка для оборудования для серии Альфа', NULL, '2020-09-01 19:11:17', NULL, 1, 'Основная полка для оборудования для серии Альфа', 'Основная полка для оборудования для серии Альфа', 0, NULL, NULL, '');
INSERT INTO `product` VALUES (134, 1, 5, 'Основная полка для оборудования АЛЬФА', 'osnovnaa-polka-dla-oborudovania-alfa', 'Основная полка для оборудования для серии АЛЬФА', 3955, NULL, 0, 'Основная полка для оборудования для серии АЛЬФА', 'Основная полка для оборудования для серии АЛЬФА', NULL, '2020-09-02 18:20:01', NULL, 1, 'Основная полка для оборудования для серии АЛЬФА', 'Основная полка для оборудования для серии АЛЬФА', 0, NULL, NULL, '');
INSERT INTO `product` VALUES (136, 86, 7, 'Тест', 'test', 'Тест', 1236, NULL, 1, 'Тест', 'Тест', 'Тест', '2020-09-04 16:38:00', NULL, 0, 'Тест', 'Тест', 0, NULL, NULL, NULL);
INSERT INTO `product` VALUES (137, 86, 6, 'Стол рабочий C5-1200х750 ESD HPL', 'stol-rabocij-c5-1200h750-esd-hpl', 'Столешница выполнена из ДСП ламинированного антистатическим пластиком. \r\n\r\nМеталлический разборный каркас из  трубы 40х40 мм с нагрузкой 300 кг распределенного веса.', 14260, NULL, 1, NULL, NULL, NULL, '2020-09-08 12:50:01', NULL, 0, 'Стол рабочий C5-1200х750 ESD HPL', 'Стол рабочий C5-1200х750 ESD HPL', 9999, 0, 1, NULL);
INSERT INTO `product` VALUES (138, 81, 5, 'СО-12-7 ESD', 'so-12-7-esd', 'СО-12-7 ESD', 27140, NULL, 1, NULL, NULL, NULL, '2020-09-08 16:41:35', NULL, 0, 'СО-12-7 ESD', 'СО-12-7  ESD', 9999, 1, 1, NULL);
INSERT INTO `product` VALUES (149, 96, 5, 'СО-12-7', 'so-12-7', 'СО-12-7', 6000, NULL, 0, 'СО-12-7', 'СО-12-7', 'СО-12-7', '2020-09-11 16:50:38', NULL, 0, 'СО-12-7', 'СО-12-7', 9999, 1, 0, 'https://vkg.ru/constructor-partner/ostrov/');
INSERT INTO `product` VALUES (150, 1, 5, 'Серия Альфа', 'alfa', '', 8000, NULL, 1, NULL, NULL, NULL, '2020-09-11 16:54:09', NULL, 1, '', '', 9999, NULL, NULL, 'https://vkg.ru/constructor-partner/alpha/');
INSERT INTO `product` VALUES (152, 107, 5, 'С-200 ESD', 's-200-esd', '', 14560, NULL, 1, NULL, NULL, NULL, '2020-09-11 17:48:57', NULL, 0, 'С-200 ESD', '', 9999, NULL, NULL, NULL);
INSERT INTO `product` VALUES (153, 108, 5, 'С-300 ESD', 's-300-esd', '', 1234, NULL, 1, NULL, NULL, NULL, '2020-09-11 18:02:05', NULL, 0, '', '', 9999, 1, 1, NULL);
INSERT INTO `product` VALUES (154, 100, 6, 'СП-280', 'sp-280', '', 5608, NULL, 1, NULL, NULL, NULL, '2020-09-11 18:08:16', NULL, 0, '', '', 9999, 0, 1, NULL);
INSERT INTO `product` VALUES (169, 98, 5, 'ПС-07 Заголовок 45 символов', 'ps-07-zagolovok-45-simvolov', 'Описание', 7471, NULL, 1, NULL, NULL, NULL, '2020-09-14 12:38:51', NULL, 0, '', 'Краткое описание 55 символов', 6, 1, 0, NULL);
INSERT INTO `product` VALUES (170, 98, 5, 'ПС-10 Заголовок 45 символов', 'ps-10-zagolovok-45-simvolov', 'Описание', 9339, NULL, 0, NULL, NULL, NULL, '2020-09-14 12:38:51', NULL, 0, '', 'Краткое описание 55 символов', 7, 1, 0, NULL);
INSERT INTO `product` VALUES (171, 98, 5, 'ПС-15 Заголовок 45 символов', 'ps-15-zagolovok-45-simvolov', 'Описание', 10458, NULL, 1, NULL, NULL, NULL, '2020-09-14 12:38:51', NULL, 0, '', 'Краткое описание 55 символов', 8, 1, 0, 'https://vkg.ru/constructor-partner/classic/?iframe=true');
INSERT INTO `product` VALUES (172, 110, 5, 'ПС-07  ESD Заголовок 45 1символов', 'ps-07-esd-zagolovok-45-simvolov', 'Описание', 11905, NULL, 0, NULL, NULL, NULL, '2020-09-14 12:38:51', NULL, 0, '', 'Краткое описание 55 символов', 9, 1, 1, NULL);
INSERT INTO `product` VALUES (173, 110, 5, 'ПС-10 ESD Заголовок 45 символов', 'ps-10-esd-zagolovok-45-simvolov', 'Описание', 14882, NULL, 0, NULL, NULL, NULL, '2020-09-14 12:38:51', NULL, 0, '', 'Краткое описание 55 символов', 10, 1, 1, NULL);
INSERT INTO `product` VALUES (174, 110, 5, 'ПС-15 ESD Заголовок 45 символов', 'ps-15-esd-zagolovok-45-simvolov', 'Описание', 16625, NULL, 0, NULL, NULL, NULL, '2020-09-14 12:38:51', NULL, 0, '', 'Краткое описание 55 символов', 11, 1, 1, NULL);
INSERT INTO `product` VALUES (181, 98, 6, 'СТОЙКА ПОДКАТНАЯ СП-5', 'stojka-podkatnaa-sp-5', 'Описание', 6850, NULL, 1, NULL, NULL, NULL, '2020-09-14 12:38:51', NULL, 0, '', 'Краткое описание 55 символов', 18, 0, 0, NULL);
INSERT INTO `product` VALUES (182, 98, 6, 'СТОЙКА ПОДКАТНАЯ СП-5 ESD', 'stojka-podkatnaa-sp-5-esd', 'Описание', 10253, NULL, 1, NULL, NULL, NULL, '2020-09-14 12:38:51', NULL, 0, NULL, 'Краткое описание 55 символов', 19, 0, 1, NULL);
INSERT INTO `product` VALUES (191, 95, 5, 'СР-12-7 Стол рабочий КЛАССИК 1200х700 мм', 'sr-12-7-stol-rabocij-klassik-1200h700-mm', 'Описание', 6415, NULL, 0, NULL, NULL, NULL, '2020-09-14 17:09:31', NULL, 0, '', 'простота и функциональность по оптимальной цене.', 1, 0, 0, '');
INSERT INTO `product` VALUES (192, 124, 5, 'СР-12-7 ESD Стол рабочий КЛАССИК 1200х700 мм', 'sr-12-7-esd-stol-rabocij-klassik-1200h700-mm', 'Описание', 8200, NULL, 0, NULL, NULL, NULL, '2020-09-14 17:09:31', NULL, 0, '', 'простота и функциональность по оптимальной цене.', 2, 0, 1, '');
INSERT INTO `product` VALUES (193, 1, 5, 'Серия Классик', 'seria-klassik', 'Серия Классик', 6610, NULL, 1, 'Серия Классик', 'Серия Классик', 'Серия Классик', '2020-09-14 17:19:57', NULL, 1, 'Серия Классик', 'Серия Классик', 9999, NULL, NULL, 'https://vkg.ru/constructor-partner/alpha/');
INSERT INTO `product` VALUES (194, 96, 5, 'АЛФ-О-12-7 Стол рабочий АЛЬФА островной', 'alf-o-12-7-stol-rabocij-alfa-ostrovnoj', 'Рабочий стол, состоящий из 2 зеркально расположенных рабочих мест на одном каркасе. Компактный рабочий стол, позволяющий разместить 2 работников на ограниченном пространстве.\r\n\r\nВ стандартной комплектации поставляются с 2 двусторонними перфопанелями.', 38629, NULL, 0, NULL, NULL, NULL, '2020-09-22 11:19:51', NULL, 0, '', '2 рабочих места на одном каркасе.', 9999, 1, 1, 'https://vkg.ru/constructor-partner/alliance/');
INSERT INTO `product` VALUES (195, 96, 5, 'АЛФ-О-15-7 Стол рабочий АЛЬФА островной', 'alf-o-15-7-stol-rabocij-alfa-ostrovnoj', 'Рабочий стол, состоящий из 2 зеркально расположенных рабочих мест на одном каркасе. Компактный рабочий стол, позволяющий разместить 2 работников на ограниченном пространстве.\n\nВ стандартной комплектации поставляются с 2 двусторонними перфопанелями.', 41895, NULL, 0, NULL, NULL, NULL, '2020-09-22 11:19:51', NULL, 0, NULL, '2 рабочих места на одном каркасе.', 9999, 1, 1, NULL);
INSERT INTO `product` VALUES (196, 96, 5, 'АЛФ-О-18-7 Стол рабочий АЛЬФА островной', 'alf-o-18-7-stol-rabocij-alfa-ostrovnoj', 'Рабочий стол, состоящий из 2 зеркально расположенных рабочих мест на одном каркасе. Компактный рабочий стол, позволяющий разместить 2 работников на ограниченном пространстве.\n\nВ стандартной комплектации поставляются с 2 двусторонними перфопанелями.', 42502, NULL, 0, NULL, NULL, NULL, '2020-09-22 11:19:51', NULL, 0, NULL, '2 антистатических рабочих места на одном каркасе.', 9999, 1, 1, NULL);
INSERT INTO `product` VALUES (197, 125, 5, 'АЛФ-О-12-7 ESD Стол рабочий АЛЬФА островной', 'alf-o-12-7-esd-stol-rabocij-alfa-ostrovnoj', 'Антистатический рабочий стол, состоящий из 2 зеркально расположенных рабочих мест на одном каркасе. Компактный рабочий стол, позволяющий разместить 2 работников на ограниченном пространстве.\r\n\r\nВ стандартной комплектации поставляются с 2 двусторонними перфопанелями.', 47242, NULL, 0, NULL, NULL, NULL, '2020-09-22 11:19:51', NULL, 0, '', '2 антистатических рабочих места на одном каркасе.', 9999, 1, 1, '');
INSERT INTO `product` VALUES (198, 125, 5, 'АЛФ-О-15-7 ESD Стол рабочий АЛЬФА островной', 'alf-o-15-7-esd-stol-rabocij-alfa-ostrovnoj', 'Антистатический рабочий стол, состоящий из 2 зеркально расположенных рабочих мест на одном каркасе. Компактный рабочий стол, позволяющий разместить 2 работников на ограниченном пространстве.\r\n\r\nВ стандартной комплектации поставляются с 2 двусторонними перфопанелями.', 51267, NULL, 0, NULL, NULL, NULL, '2020-09-22 11:19:51', NULL, 0, '', '2 антистатических рабочих места на одном каркасе.', 9999, 1, 1, '');
INSERT INTO `product` VALUES (200, 125, 5, 'АЛФ-О-18-7 ESD Стол рабочий АЛЬФА островной', 'alf-o-18-7-esd-stol-rabocij-alfa-ostrovnoj', 'Антистатический рабочий стол, состоящий из 2 зеркально расположенных рабочих мест на одном каркасе. Компактный рабочий стол, позволяющий разместить 2 работников на ограниченном пространстве.\r\n\r\nВ стандартной комплектации поставляются с 2 двусторонними перфопанелями.', 123456, NULL, 0, NULL, NULL, NULL, '2020-09-22 11:41:21', NULL, 0, '', 'Краткое описание 55 символов', 1, 1, 1, 'https://vkg.ru/constructor-partner/alpha/');
INSERT INTO `product` VALUES (204, 125, 5, 'ТЕСТ АЛФ-О-18-7 ESD Стол рабочий АЛЬФА островной', 'test-alf-o-18-7-esd-stol-rabocij-alfa-ostrovnoj', 'Антистатический рабочий стол, состоящий из 2 зеркально расположенных рабочих мест на одном каркасе. Компактный рабочий стол, позволяющий разместить 2 работников на ограниченном пространстве.\r\n\r\nВ стандартной комплектации поставляются с 2 двусторонними перфопанелями.', 123456, NULL, 0, NULL, NULL, NULL, '2020-09-22 12:29:05', NULL, 0, '', 'Краткое описание 55 символов', 1, 1, 1, '');
INSERT INTO `product` VALUES (205, 128, 5, 'АЛФ-У-12-7 Стол АЛЬФА универсальный', 'alf-u-12-7-stol-alfa-universalnyj', 'Упрощенная конструкция антистатического стола серии АЛЬФА без возможности верхней комплектации.\n\nДополнительно может комплектоваться специально разработанным коробом с электромонтажной панелью, стандартными подвесными тумбами.', 12346, NULL, 0, NULL, NULL, NULL, '2020-09-22 14:34:43', NULL, 0, NULL, 'Краткое описание 55 символов', 9999, 1, 1, NULL);
INSERT INTO `product` VALUES (206, 127, 5, 'АЛФ-У-12-7 ESD Стол АЛЬФА универсальный', 'alf-u-12-7-esd-stol-alfa-universalnyj', 'Упрощенная конструкция антистатического стола серии АЛЬФА без возможности верхней комплектации.\n\nДополнительно может комплектоваться специально разработанным коробом с электромонтажной панелью, стандартными подвесными тумбами.', 23456, NULL, 0, NULL, NULL, NULL, '2020-09-22 14:34:43', NULL, 0, NULL, 'Краткое описание 55 символов', 9999, 1, 1, NULL);
INSERT INTO `product` VALUES (207, 1, 5, 'Альфа Остров', 'alfa-ostrov', '', 12345, NULL, 1, NULL, NULL, NULL, '2020-09-22 15:01:11', NULL, 1, '', '', 9999, NULL, NULL, NULL);
INSERT INTO `product` VALUES (208, 1, 5, 'Альфа универсальный', 'alfa-universalnyj', '', 12345, NULL, 1, NULL, NULL, NULL, '2020-09-22 15:08:01', NULL, 1, '', '', 9999, NULL, NULL, NULL);
INSERT INTO `product` VALUES (209, 128, 5, 'АЛФ-Т-12-8 Стол АЛЬФА Т-образный', 'alf-t-12-8-stol-alfa-t-obraznyj', 'Упрощенная конструкция антистатического стола серии АЛЬФА без возможности верхней комплектации.\n\nДополнительно может комплектоваться специально разработанным коробом с электромонтажной панелью, стандартными подвесными тумбами.', 12346, NULL, 0, NULL, NULL, NULL, '2020-09-22 17:03:06', NULL, 0, NULL, 'Краткое описание 55 символов', 9999, 1, 1, NULL);
INSERT INTO `product` VALUES (210, 127, 5, 'АЛФ-Т-12-8 ESD Стол АЛЬФА Т-образный', 'alf-t-12-8-esd-stol-alfa-t-obraznyj', 'Упрощенная конструкция антистатического стола серии АЛЬФА без возможности верхней комплектации.\n\nДополнительно может комплектоваться специально разработанным коробом с электромонтажной панелью, стандартными подвесными тумбами.', 23456, NULL, 0, NULL, NULL, NULL, '2020-09-22 17:03:06', NULL, 0, NULL, 'Краткое описание 55 символов', 9999, 1, 1, NULL);
INSERT INTO `product` VALUES (211, 1, 5, 'Альфа Т-образный', 'alfa-t-obraznyj', '', 12345, NULL, 1, NULL, NULL, NULL, '2020-09-22 17:05:57', NULL, 1, '', '', 9999, NULL, NULL, NULL);
INSERT INTO `product` VALUES (228, 1, 5, 'Угловые столы', 'uglovye-stoly', '', 1234, NULL, 1, NULL, NULL, NULL, '2020-09-30 12:09:27', NULL, 1, '', '', 9999, NULL, NULL, 'https://vkg.ru/constructor-partner/alpha/');
INSERT INTO `product` VALUES (232, 97, 5, 'Тестовый стол1', 'testovyj-stol1', 'Описание', 12345, NULL, 1, NULL, NULL, NULL, '2020-10-05 22:22:22', NULL, 0, NULL, 'Краткое описание 55 симво', 2, 1, 0, 'https://vkg.ru/constructor-partner/alpha/');
INSERT INTO `product` VALUES (233, 97, 5, 'Тестовый стол2', 'testovyj-stol2', 'Описание', 12345, NULL, 0, NULL, NULL, NULL, '2020-10-05 22:22:22', NULL, 0, NULL, 'Краткое описание 55 симво', 1, 0, 1, 'https://vkg.ru/constructor-partner/alpha/');
INSERT INTO `product` VALUES (241, 97, 5, 'Тестовый стол3', 'testovyj-stol3', 'Описание', 141590, 1550, 1, NULL, NULL, NULL, '2020-10-07 18:29:01', NULL, 0, NULL, 'Краткое описание 55 симво', 2, 1, 0, 'https://vkg.ru/constructor-partner/alpha/');
INSERT INTO `product` VALUES (250, 130, 5, 'УС-1 Угловой стол', 'us-1-zagolovok-45-simvolov', 'Описание', 10000, NULL, 0, NULL, NULL, NULL, '2020-11-26 10:49:39', NULL, 0, '', 'Краткое описание 55 символов', 9999, 0, 0, 'https://vkg.ru/constructor-partner/classic/');
INSERT INTO `product` VALUES (251, 131, 5, 'УС-1 ESD Угловой стол', 'us-1-esd-zagolovok-45-simvolov', 'Описание', 200000, NULL, 0, NULL, NULL, NULL, '2020-11-26 10:49:39', NULL, 0, '', 'Краткое описание 55 символов', 9999, 1, 0, 'https://vkg.ru/constructor-partner/classic/');
INSERT INTO `product` VALUES (252, 131, 5, 'УС-2 ESD Угловой стол антистатический', 'us-2-esd-zagolovok-45-simvolov', 'Описание', 30000, NULL, 0, NULL, NULL, NULL, '2020-11-26 10:49:39', NULL, 0, '', 'Краткое описание 55 символов', 9999, 1, 0, 'https://vkg.ru/constructor-partner/classic/');
INSERT INTO `product` VALUES (253, 131, 5, 'УС-3 ESD Заголовок 45 символов ', 'us-3-esd-zagolovok-45-simvolov', 'Описание', 40000, NULL, 0, NULL, NULL, NULL, '2020-11-26 10:49:39', NULL, 0, '', 'Краткое описание 55 символов', 9999, 1, 0, 'https://vkg.ru/constructor-partner/classic/');
INSERT INTO `product` VALUES (301, 130, 5, 'УС-1 test Заголовок 45 символов', 'us-1-test-zagolovok-45-simvolov', 'Описание', 10000, NULL, 1, NULL, NULL, NULL, '2020-12-17 16:56:49', NULL, 0, '', 'Краткое описание 55 символов', 9999, 0, 0, 'https://vkg.ru/constructor-partner/classic/');
INSERT INTO `product` VALUES (302, 95, 5, 'СР-15-7 Стол рабочий КЛАССИК 1500х700 мм', 'sr-15-7-stol-rabocij-klassik-1500h700-mm', ' Рекомендуется как рабочее место регулировщика, сборщика радиоаппаратуры, радиомонтажника. Каркас из стального профиля, покрытого порошковой краской. Столешница из материала устойчивого к истиранию.', 8044, NULL, 0, NULL, NULL, NULL, '2020-12-18 10:49:22', NULL, 0, NULL, 'Простота и функциональность по оптимальной цене', 9999, 0, 0, 'https://vkg.ru/constructor-partner/classic/');
INSERT INTO `product` VALUES (303, 124, 5, 'СР-15-7 ESD Стол рабочий антистатический 1500х700 мм', 'sr-15-7-esd-stol-rabocij-antistaticeskij-1500h700-mm', ' Рекомендуется как рабочее место регулировщика, сборщика радиоаппаратуры, радиомонтажника. Каркас из стального профиля, покрытого порошковой краской. Столешница из материала устойчивого к истиранию.', 10580, NULL, 0, NULL, NULL, NULL, '2020-12-18 10:49:22', NULL, 0, NULL, 'Простота и функциональность по оптимальной цене', 9999, 0, 0, 'https://vkg.ru/constructor-partner/classic/');

-- ----------------------------
-- Table structure for product_doc
-- ----------------------------
DROP TABLE IF EXISTS `product_doc`;
CREATE TABLE `product_doc`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `product_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_product_doc_product`(`product_id`) USING BTREE,
  CONSTRAINT `FK_product_doc_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of product_doc
-- ----------------------------

-- ----------------------------
-- Table structure for product_img
-- ----------------------------
DROP TABLE IF EXISTS `product_img`;
CREATE TABLE `product_img`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_product_img_product`(`product_id`) USING BTREE,
  CONSTRAINT `FK_product_img_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 186 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of product_img
-- ----------------------------
INSERT INTO `product_img` VALUES (6, 68, '80e3f73b1e0219106b39d9a26b51f209.png', 0);
INSERT INTO `product_img` VALUES (7, 76, 'a6fbe46ba34759bece89bc20efb02d97.png', 3);
INSERT INTO `product_img` VALUES (8, 76, 'c404dc20a9db49459beafd11aa0c5f87.png', 2);
INSERT INTO `product_img` VALUES (9, 76, '98c77d4d81d3871f9e9ad2a86a8cd983.png', 1);
INSERT INTO `product_img` VALUES (10, 76, '99236afd69faf28c9e66f3e849d5b89a.png', 0);
INSERT INTO `product_img` VALUES (11, 77, 'a5e433935c933d3922e2daaf85bfb4ae.png', 0);
INSERT INTO `product_img` VALUES (12, 77, '1e0c0798820ef9f6cb8d232045c2e843.png', 1);
INSERT INTO `product_img` VALUES (13, 77, '5d2989a07ac6e6f3a39179e319fa10eb.png', 2);
INSERT INTO `product_img` VALUES (20, 94, '990594ffc2e0e196a03b36b876df763a.png', 0);
INSERT INTO `product_img` VALUES (21, 94, '36409b67174a5ab5edd63a8c05c5adf1.png', 1);
INSERT INTO `product_img` VALUES (22, 95, '1cf29eb30e3f6aadc972390c17e1720a.png', 0);
INSERT INTO `product_img` VALUES (23, 95, 'f54fbfe5bbe36a7fdb9f409171ed3213.png', 1);
INSERT INTO `product_img` VALUES (24, 97, 'ac71f9646e53618ea3a934973b81f1e5.png', 0);
INSERT INTO `product_img` VALUES (25, 97, '1d7cfccbb4d9340a26bea75407ef4e5b.png', 1);
INSERT INTO `product_img` VALUES (26, 96, '9e8bf8eef86669402e92de0ba52520a1.png', 0);
INSERT INTO `product_img` VALUES (27, 96, '08d02c2f8a8e23035cc87ba007acd110.png', 1);
INSERT INTO `product_img` VALUES (47, 111, '5c59790dbfb3c4f84a70f503e88f852d.png', 0);
INSERT INTO `product_img` VALUES (48, 112, '380c9c9b338c90ae2d88dfbeadf766be.png', 0);
INSERT INTO `product_img` VALUES (50, 114, '08b5f1f598c43b195743eb61187eb45f.png', 0);
INSERT INTO `product_img` VALUES (51, 115, '4ed16ad4d91866303594b7bee7a64280.png', 0);
INSERT INTO `product_img` VALUES (52, 116, '2b9c8fc6ce0ae1c95b6aae88d8ee8f5c.png', 0);
INSERT INTO `product_img` VALUES (54, 117, '002c3f30a3a41abf8cbaeb96950f1969.png', 0);
INSERT INTO `product_img` VALUES (55, 122, 'fec99e880fac0d481c52bd67f12c77ce.png', 0);
INSERT INTO `product_img` VALUES (56, 123, 'be97d8e11a21a8c841b82b5fa1c4efb4.png', 0);
INSERT INTO `product_img` VALUES (58, 124, '2f5e77ea6444b329cace08ee45a417f8.png', 0);
INSERT INTO `product_img` VALUES (59, 125, '59e5402872a797ad707628b271e1ba78.png', 0);
INSERT INTO `product_img` VALUES (72, 133, '11af77921ff549e9067949e0e0bee317.png', 0);
INSERT INTO `product_img` VALUES (73, 134, 'cd5b10ff6937ac429c2eb593702c9d9d.png', 0);
INSERT INTO `product_img` VALUES (75, 118, 'b590f843e296d7f2691d69a118923a27.png', 0);
INSERT INTO `product_img` VALUES (76, 136, '39cfdd1c4a0232335df4849f7ad3ced1.png', 0);
INSERT INTO `product_img` VALUES (77, 137, '0cb1d0ed187f084b2cc057eb65fa3b7a.png', 0);
INSERT INTO `product_img` VALUES (79, 138, 'c3f0e3e1eddc6cd768cf876e9a53d555.png', 0);
INSERT INTO `product_img` VALUES (80, 70, '5f21153382e1057deee7a8ac1d87abb8.png', 0);
INSERT INTO `product_img` VALUES (82, 149, 'd4296a4dbc2bb77f6ac82de68188e313.png', 0);
INSERT INTO `product_img` VALUES (83, 150, 'b432aa944eb900ee0dcc846b904197f3.png', 0);
INSERT INTO `product_img` VALUES (85, 152, 'b6e4b91cca97cb10c7939ca1de41ad77.png', 0);
INSERT INTO `product_img` VALUES (86, 153, '57da76c7ae37ea7506f69ba7c83bec53.png', 0);
INSERT INTO `product_img` VALUES (87, 154, '9d6a3d4dc7956d98ca1d17310ff714a7.png', 0);
INSERT INTO `product_img` VALUES (88, 181, '37383908de797ec24286582d3161bc85.png', 0);
INSERT INTO `product_img` VALUES (91, 193, 'a3b2900bd6c93d2f7f0cc382660010be.png', 0);
INSERT INTO `product_img` VALUES (97, 192, '4e7b6424cd13b1a3db1ba271777784cb.png', 0);
INSERT INTO `product_img` VALUES (98, 172, 'f37244d61e065c00fc026d46a57269e7.png', 0);
INSERT INTO `product_img` VALUES (99, 173, '10394e96824782d623cbf584c6b2a929.png', 0);
INSERT INTO `product_img` VALUES (100, 174, 'bc17ec88672954127c7c1201224480c5.png', 0);
INSERT INTO `product_img` VALUES (101, 169, '68872c2eee435fbd07f40beab3bb8543.png', 0);
INSERT INTO `product_img` VALUES (102, 170, 'c5e2d57faef5fbd5ae9763ce76a92632.png', 0);
INSERT INTO `product_img` VALUES (103, 171, '6611010332baad580bda5092445288ac.png', 0);
INSERT INTO `product_img` VALUES (104, 194, '7ba2ef0af4dab47f49fb6b358c170686.png', 0);
INSERT INTO `product_img` VALUES (106, 200, '721fc2af55daaed045196e9556cc6a82.png', 0);
INSERT INTO `product_img` VALUES (108, 204, '455b395101b7b562c9b4dc30e948b5ed.png', 0);
INSERT INTO `product_img` VALUES (109, 207, 'd4ee74b6ab81ad65c89bad8d10b5cc5b.png', 0);
INSERT INTO `product_img` VALUES (110, 198, '10c4b3a566123db4b86f20e44b01c57f.png', 0);
INSERT INTO `product_img` VALUES (111, 197, '6172cda7bb4a2ac5bb81e731fca7d32a.png', 0);
INSERT INTO `product_img` VALUES (112, 208, 'b34ae2137111ff02e923db2691ffb047.png', 0);
INSERT INTO `product_img` VALUES (113, 211, 'e4661e8a5153055883e6450994dd9d9d.png', 0);
INSERT INTO `product_img` VALUES (119, 228, '0b43f5138d889b76e46f97c396ecc1af.png', 0);
INSERT INTO `product_img` VALUES (124, 121, 'ab69370aa53d5aa36c527083a95885c3.png', 0);
INSERT INTO `product_img` VALUES (125, 120, '1a7933dc562fb4b5d47a3e5786f9a11e.png', 0);
INSERT INTO `product_img` VALUES (126, 119, '97e31d18dc21d2b29ae80bed1b585e99.png', 0);
INSERT INTO `product_img` VALUES (127, 250, '7182e91489d7b8d2a65e80ae24338221.png', 0);
INSERT INTO `product_img` VALUES (128, 251, '203795878258c9fef23c6804262e3fc8.png', 0);
INSERT INTO `product_img` VALUES (129, 252, '58499223f7e38446554c289e3b241a82.png', 0);
INSERT INTO `product_img` VALUES (130, 253, 'a9f1e3a8f4501837872eaa6a30ab9301.png', 0);
INSERT INTO `product_img` VALUES (132, 61, '71edf8e32dc814462ad64309947173e1.png', 0);
INSERT INTO `product_img` VALUES (136, 93, 'bf39b64c44a3d755a38bb1e4f4ecaca1.png', 0);
INSERT INTO `product_img` VALUES (138, 93, '3c3bea8cf196e0f8fac4986ba882fb67.png', 1);
INSERT INTO `product_img` VALUES (139, 93, '953aa68ea77df191cbf0acb57f5cd25f.png', 2);
INSERT INTO `product_img` VALUES (141, 92, 'c93f6b2b4ce2ec1b1d910f90135194d6.png', 0);
INSERT INTO `product_img` VALUES (142, 92, 'c42fbb6f91f4fdf24f906a7b947067bf.png', 1);
INSERT INTO `product_img` VALUES (143, 92, 'ebe60495f46d8925aaa511b82d32eb56.png', 2);
INSERT INTO `product_img` VALUES (151, 72, '022d4ddda5f8fa63f26a5c66bfab251b.png', 0);
INSERT INTO `product_img` VALUES (160, 191, '5ea4af33fc014f439b1403c47661b141.png', 0);
INSERT INTO `product_img` VALUES (161, 191, '3e8b84918349473b1ff9bff4742779eb.png', 1);
INSERT INTO `product_img` VALUES (162, 191, '4bdefd2e0ca144913a2e00c85bd5e1bd.png', 2);
INSERT INTO `product_img` VALUES (163, 191, '1120561295d7d679d07e83c90be030b2.png', 3);
INSERT INTO `product_img` VALUES (164, 191, 'aa4738b17ecdfdb7305503c392391bd6.png', 4);
INSERT INTO `product_img` VALUES (170, 301, 'test2.jpg', 0);
INSERT INTO `product_img` VALUES (171, 301, 'test1.jpg', 1);
INSERT INTO `product_img` VALUES (172, 302, 'kl.jpg', 99999);
INSERT INTO `product_img` VALUES (173, 302, 'kl1.jpg', 99999);
INSERT INTO `product_img` VALUES (174, 302, 'kl2.jpg', 99999);
INSERT INTO `product_img` VALUES (175, 302, 'kl3.jpg', 99999);
INSERT INTO `product_img` VALUES (176, 302, 'kl4.jpg', 99999);
INSERT INTO `product_img` VALUES (177, 302, 'kl5.jpg', 99999);
INSERT INTO `product_img` VALUES (178, 302, 'kl6.jpg', 99999);
INSERT INTO `product_img` VALUES (179, 303, 'kl.jpg', 99999);
INSERT INTO `product_img` VALUES (180, 303, 'kl1.jpg', 99999);
INSERT INTO `product_img` VALUES (181, 303, 'kl2.jpg', 99999);
INSERT INTO `product_img` VALUES (182, 303, 'kl3.jpg', 99999);
INSERT INTO `product_img` VALUES (183, 303, 'kl4.jpg', 99999);
INSERT INTO `product_img` VALUES (184, 303, 'kl5.jpg', 99999);
INSERT INTO `product_img` VALUES (185, 303, 'kl6.jpg', 99999);

-- ----------------------------
-- Table structure for product_packages
-- ----------------------------
DROP TABLE IF EXISTS `product_packages`;
CREATE TABLE `product_packages`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of product_packages
-- ----------------------------
INSERT INTO `product_packages` VALUES (2, 2, 'Для Альфа');
INSERT INTO `product_packages` VALUES (3, 1, 'Для всех Алюминиевых столов');
INSERT INTO `product_packages` VALUES (4, 1, 'Для всех столов Викинг');
INSERT INTO `product_packages` VALUES (5, 0, 'Для Альфа Рекомендованные');
INSERT INTO `product_packages` VALUES (6, 1, 'Полки какие-то');

-- ----------------------------
-- Table structure for product_to_packages
-- ----------------------------
DROP TABLE IF EXISTS `product_to_packages`;
CREATE TABLE `product_to_packages`  (
  `product_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `packages_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  INDEX `FK_product_to_packages_product`(`product_id`) USING BTREE,
  INDEX `FK_product_to_packages_product_packages`(`packages_id`) USING BTREE,
  CONSTRAINT `FK_product_to_packages_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_product_to_packages_product_packages` FOREIGN KEY (`packages_id`) REFERENCES `product_packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of product_to_packages
-- ----------------------------
INSERT INTO `product_to_packages` VALUES (122, 3);
INSERT INTO `product_to_packages` VALUES (123, 3);
INSERT INTO `product_to_packages` VALUES (124, 4);
INSERT INTO `product_to_packages` VALUES (125, 4);
INSERT INTO `product_to_packages` VALUES (119, 6);
INSERT INTO `product_to_packages` VALUES (120, 6);
INSERT INTO `product_to_packages` VALUES (121, 6);
INSERT INTO `product_to_packages` VALUES (116, 2);
INSERT INTO `product_to_packages` VALUES (117, 2);
INSERT INTO `product_to_packages` VALUES (118, 2);
INSERT INTO `product_to_packages` VALUES (92, 5);
INSERT INTO `product_to_packages` VALUES (95, 5);
INSERT INTO `product_to_packages` VALUES (93, 5);
INSERT INTO `product_to_packages` VALUES (97, 5);

-- ----------------------------
-- Table structure for product_to_product
-- ----------------------------
DROP TABLE IF EXISTS `product_to_product`;
CREATE TABLE `product_to_product`  (
  `main_product_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `type` int(10) UNSIGNED NOT NULL,
  INDEX `FK_product_to_product_product`(`main_product_id`) USING BTREE,
  INDEX `FK_product_to_product_product_2`(`product_id`) USING BTREE,
  CONSTRAINT `FK_product_to_product_product` FOREIGN KEY (`main_product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_product_to_product_product_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of product_to_product
-- ----------------------------
INSERT INTO `product_to_product` VALUES (76, 61, 1);
INSERT INTO `product_to_product` VALUES (76, 69, 1);
INSERT INTO `product_to_product` VALUES (68, 62, 1);
INSERT INTO `product_to_product` VALUES (114, 62, 0);
INSERT INTO `product_to_product` VALUES (181, 152, 0);
INSERT INTO `product_to_product` VALUES (207, 204, 2);
INSERT INTO `product_to_product` VALUES (207, 194, 2);
INSERT INTO `product_to_product` VALUES (207, 195, 2);
INSERT INTO `product_to_product` VALUES (207, 196, 2);
INSERT INTO `product_to_product` VALUES (207, 197, 2);
INSERT INTO `product_to_product` VALUES (207, 198, 2);
INSERT INTO `product_to_product` VALUES (200, 119, 1);
INSERT INTO `product_to_product` VALUES (200, 121, 1);
INSERT INTO `product_to_product` VALUES (200, 152, 0);
INSERT INTO `product_to_product` VALUES (200, 153, 0);
INSERT INTO `product_to_product` VALUES (200, 195, 0);
INSERT INTO `product_to_product` VALUES (200, 196, 0);
INSERT INTO `product_to_product` VALUES (200, 197, 0);
INSERT INTO `product_to_product` VALUES (211, 209, 2);
INSERT INTO `product_to_product` VALUES (211, 210, 2);
INSERT INTO `product_to_product` VALUES (208, 205, 2);
INSERT INTO `product_to_product` VALUES (208, 206, 2);
INSERT INTO `product_to_product` VALUES (193, 191, 2);
INSERT INTO `product_to_product` VALUES (193, 192, 2);
INSERT INTO `product_to_product` VALUES (95, 119, 1);
INSERT INTO `product_to_product` VALUES (134, 116, 2);
INSERT INTO `product_to_product` VALUES (134, 117, 2);
INSERT INTO `product_to_product` VALUES (134, 118, 2);
INSERT INTO `product_to_product` VALUES (134, 119, 2);
INSERT INTO `product_to_product` VALUES (134, 120, 2);
INSERT INTO `product_to_product` VALUES (134, 121, 2);
INSERT INTO `product_to_product` VALUES (94, 72, 1);
INSERT INTO `product_to_product` VALUES (94, 97, 0);
INSERT INTO `product_to_product` VALUES (150, 122, 1);
INSERT INTO `product_to_product` VALUES (150, 123, 1);
INSERT INTO `product_to_product` VALUES (150, 124, 1);
INSERT INTO `product_to_product` VALUES (150, 125, 1);
INSERT INTO `product_to_product` VALUES (150, 92, 0);
INSERT INTO `product_to_product` VALUES (150, 93, 0);
INSERT INTO `product_to_product` VALUES (150, 92, 2);
INSERT INTO `product_to_product` VALUES (150, 95, 2);
INSERT INTO `product_to_product` VALUES (150, 93, 2);
INSERT INTO `product_to_product` VALUES (150, 96, 2);
INSERT INTO `product_to_product` VALUES (150, 94, 2);
INSERT INTO `product_to_product` VALUES (150, 97, 2);
INSERT INTO `product_to_product` VALUES (133, 116, 2);
INSERT INTO `product_to_product` VALUES (133, 117, 2);
INSERT INTO `product_to_product` VALUES (133, 118, 2);
INSERT INTO `product_to_product` VALUES (133, 119, 2);
INSERT INTO `product_to_product` VALUES (133, 120, 2);
INSERT INTO `product_to_product` VALUES (133, 121, 2);
INSERT INTO `product_to_product` VALUES (228, 119, 1);
INSERT INTO `product_to_product` VALUES (228, 120, 1);
INSERT INTO `product_to_product` VALUES (228, 121, 1);
INSERT INTO `product_to_product` VALUES (228, 250, 1);
INSERT INTO `product_to_product` VALUES (228, 250, 2);
INSERT INTO `product_to_product` VALUES (228, 251, 2);
INSERT INTO `product_to_product` VALUES (228, 252, 2);
INSERT INTO `product_to_product` VALUES (228, 253, 2);
INSERT INTO `product_to_product` VALUES (93, 122, 1);
INSERT INTO `product_to_product` VALUES (93, 123, 1);
INSERT INTO `product_to_product` VALUES (93, 124, 1);
INSERT INTO `product_to_product` VALUES (93, 125, 1);
INSERT INTO `product_to_product` VALUES (93, 92, 0);
INSERT INTO `product_to_product` VALUES (93, 93, 0);
INSERT INTO `product_to_product` VALUES (92, 72, 1);

-- ----------------------------
-- Table structure for property
-- ----------------------------
DROP TABLE IF EXISTS `property`;
CREATE TABLE `property`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `value_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `order` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of property
-- ----------------------------
INSERT INTO `property` VALUES (1, 'Артикул', '', 'Основа', 1);
INSERT INTO `property` VALUES (2, 'Масса', 'кг', 'Основа', 7);
INSERT INTO `property` VALUES (3, 'Объем упаковки', 'м3', 'Основа', 8);
INSERT INTO `property` VALUES (4, 'Габаритные размеры', 'мм', 'Основа', 2);
INSERT INTO `property` VALUES (5, 'Размер полки', 'мм', NULL, NULL);
INSERT INTO `property` VALUES (6, 'Цвет', '', 'Общие', 6);
INSERT INTO `property` VALUES (7, 'Нагрузка на столешницу', 'кг', NULL, NULL);
INSERT INTO `property` VALUES (8, 'Нагрузка на полку', 'кг', 'Полки', NULL);
INSERT INTO `property` VALUES (9, 'Высота столешницы', 'мм', 'Стол', 2);
INSERT INTO `property` VALUES (10, 'Регулировка полки по высоте', 'мм', NULL, NULL);
INSERT INTO `property` VALUES (11, 'Температурная стойкость', 'C', 'Общие', 5);
INSERT INTO `property` VALUES (12, 'Материал сидения и спинки', '', NULL, NULL);
INSERT INTO `property` VALUES (13, 'Регулировка высоты сидения ', 'мм', NULL, NULL);
INSERT INTO `property` VALUES (14, 'Регулировка угла наклона спинки ', '', NULL, NULL);
INSERT INTO `property` VALUES (15, 'Размер сидения', 'мм', NULL, NULL);
INSERT INTO `property` VALUES (16, 'Размер спинки', 'мм', NULL, NULL);
INSERT INTO `property` VALUES (17, 'Нагрузка на стул', 'кг', NULL, NULL);
INSERT INTO `property` VALUES (18, 'Регулировка высоты сидения с опорным кольцом', 'мм', NULL, NULL);
INSERT INTO `property` VALUES (20, 'Размер столешницы', 'мм', 'Стол', 1);
INSERT INTO `property` VALUES (21, 'Длина', ' ', 'Основа', NULL);
INSERT INTO `property` VALUES (22, 'Ширина', ' ', 'Основа', NULL);
INSERT INTO `property` VALUES (27, 'Цена ESD', '\nруб.', 'Основа', NULL);
INSERT INTO `property` VALUES (29, 'Глубина', ' мм', 'Основа', NULL);
INSERT INTO `property` VALUES (30, 'Высота', ' мм', 'Основа', NULL);
INSERT INTO `property` VALUES (31, 'Максимальная нагрузка', ' кг', 'Основа', NULL);
INSERT INTO `property` VALUES (32, 'Вес', ' кг', 'Основа', NULL);
INSERT INTO `property` VALUES (33, 'Типоразмер', ' ', 'Основа', NULL);
INSERT INTO `property` VALUES (34, 'Количество ящиков', ' ', 'Основа', NULL);
INSERT INTO `property` VALUES (35, 'Количество полок', ' ', 'Основа', NULL);
INSERT INTO `property` VALUES (36, 'Высота', 'мм', 'Стойки', NULL);
INSERT INTO `property` VALUES (37, 'Ширина', 'мм', 'Стойки', NULL);
INSERT INTO `property` VALUES (38, '', ' ', 'Основа', NULL);
INSERT INTO `property` VALUES (39, 'Размер столшницы', ' мм', 'Основа', NULL);
INSERT INTO `property` VALUES (40, 'Нагрузка на стол', ' кг', 'Стол', 4);
INSERT INTO `property` VALUES (41, 'Общая высота стола', ' мм', 'Стол', 3);
INSERT INTO `property` VALUES (42, 'Регулировка по высоте', ' мм', NULL, NULL);
INSERT INTO `property` VALUES (43, 'Максимальна нагрузка', ' кг', 'Основа', 2);
INSERT INTO `property` VALUES (44, 'Габаритные разметы', ' ', NULL, NULL);
INSERT INTO `property` VALUES (45, 'Арикул', ' ', NULL, NULL);
INSERT INTO `property` VALUES (47, 'Гарантия', ' год', NULL, 8);
INSERT INTO `property` VALUES (48, 'Срок службы', ' лет', NULL, 9);
INSERT INTO `property` VALUES (49, 'Цена', ' евро', NULL, NULL);
INSERT INTO `property` VALUES (51, 'Файлы', ' ', NULL, NULL);

-- ----------------------------
-- Table structure for property_to_product
-- ----------------------------
DROP TABLE IF EXISTS `property_to_product`;
CREATE TABLE `property_to_product`  (
  `product_id` int(11) UNSIGNED NOT NULL,
  `property_id` int(11) UNSIGNED NOT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  INDEX `FK_property_to_product_product`(`product_id`) USING BTREE,
  INDEX `FK_property_to_product_property`(`property_id`) USING BTREE,
  CONSTRAINT `FK_property_to_product_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_property_to_product_property` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of property_to_product
-- ----------------------------
INSERT INTO `property_to_product` VALUES (69, 22, '1500');
INSERT INTO `property_to_product` VALUES (69, 29, '500');
INSERT INTO `property_to_product` VALUES (122, 2, '2.5');
INSERT INTO `property_to_product` VALUES (122, 3, '0.01');
INSERT INTO `property_to_product` VALUES (122, 43, '15');
INSERT INTO `property_to_product` VALUES (123, 2, '4');
INSERT INTO `property_to_product` VALUES (123, 3, '0.02');
INSERT INTO `property_to_product` VALUES (125, 2, '6');
INSERT INTO `property_to_product` VALUES (125, 3, '0.01');
INSERT INTO `property_to_product` VALUES (125, 4, '220x150x480');
INSERT INTO `property_to_product` VALUES (125, 6, 'Светло-серый RAL7035, темно-серый RAL7012');
INSERT INTO `property_to_product` VALUES (124, 2, '5');
INSERT INTO `property_to_product` VALUES (124, 3, '0.01');
INSERT INTO `property_to_product` VALUES (124, 6, 'Светло-серый RAL7035, темно-серый RAL7012');
INSERT INTO `property_to_product` VALUES (111, 3, '0.1');
INSERT INTO `property_to_product` VALUES (111, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (111, 9, '800');
INSERT INTO `property_to_product` VALUES (111, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (111, 32, '49');
INSERT INTO `property_to_product` VALUES (111, 39, '1500х800');
INSERT INTO `property_to_product` VALUES (111, 40, 'до 300');
INSERT INTO `property_to_product` VALUES (76, 2, '50');
INSERT INTO `property_to_product` VALUES (76, 3, '1');
INSERT INTO `property_to_product` VALUES (76, 4, '600х737х640');
INSERT INTO `property_to_product` VALUES (76, 6, 'RAL9005, 9010, 7035');
INSERT INTO `property_to_product` VALUES (112, 3, '0.15');
INSERT INTO `property_to_product` VALUES (112, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (112, 9, '800');
INSERT INTO `property_to_product` VALUES (112, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (112, 32, '54');
INSERT INTO `property_to_product` VALUES (112, 39, '1800х800');
INSERT INTO `property_to_product` VALUES (112, 40, 'до 300');
INSERT INTO `property_to_product` VALUES (68, 1, '1111');
INSERT INTO `property_to_product` VALUES (68, 2, '35');
INSERT INTO `property_to_product` VALUES (68, 3, '130');
INSERT INTO `property_to_product` VALUES (68, 4, 'ййй');
INSERT INTO `property_to_product` VALUES (68, 22, '1200');
INSERT INTO `property_to_product` VALUES (68, 29, '500');
INSERT INTO `property_to_product` VALUES (114, 3, '0.1');
INSERT INTO `property_to_product` VALUES (114, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (114, 9, '800');
INSERT INTO `property_to_product` VALUES (114, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (114, 32, '49');
INSERT INTO `property_to_product` VALUES (114, 39, '1500х800');
INSERT INTO `property_to_product` VALUES (114, 40, 'до 300');
INSERT INTO `property_to_product` VALUES (115, 3, '0.15');
INSERT INTO `property_to_product` VALUES (115, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (115, 9, '800');
INSERT INTO `property_to_product` VALUES (115, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (115, 32, '54');
INSERT INTO `property_to_product` VALUES (115, 39, '1800х800');
INSERT INTO `property_to_product` VALUES (115, 40, 'до 300');
INSERT INTO `property_to_product` VALUES (137, 4, '1200х750');
INSERT INTO `property_to_product` VALUES (138, 4, '1200х700');
INSERT INTO `property_to_product` VALUES (182, 4, '560х520');
INSERT INTO `property_to_product` VALUES (182, 31, '50');
INSERT INTO `property_to_product` VALUES (181, 4, '560х520');
INSERT INTO `property_to_product` VALUES (181, 31, '50');
INSERT INTO `property_to_product` VALUES (169, 4, '710х515');
INSERT INTO `property_to_product` VALUES (169, 31, '150');
INSERT INTO `property_to_product` VALUES (172, 4, '710х515');
INSERT INTO `property_to_product` VALUES (172, 31, '150');
INSERT INTO `property_to_product` VALUES (173, 4, '700х1000');
INSERT INTO `property_to_product` VALUES (173, 31, '150');
INSERT INTO `property_to_product` VALUES (174, 4, '700х1500');
INSERT INTO `property_to_product` VALUES (174, 31, '150');
INSERT INTO `property_to_product` VALUES (170, 4, '700х1000');
INSERT INTO `property_to_product` VALUES (170, 31, '150');
INSERT INTO `property_to_product` VALUES (171, 4, '700х1500');
INSERT INTO `property_to_product` VALUES (171, 31, '150');
INSERT INTO `property_to_product` VALUES (195, 3, '0.2');
INSERT INTO `property_to_product` VALUES (195, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (195, 9, '600-1100');
INSERT INTO `property_to_product` VALUES (195, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (195, 32, '88');
INSERT INTO `property_to_product` VALUES (195, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (195, 41, '1500');
INSERT INTO `property_to_product` VALUES (195, 45, 'АЛФ-О-15-7');
INSERT INTO `property_to_product` VALUES (196, 3, '0.2');
INSERT INTO `property_to_product` VALUES (196, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (196, 9, '600-1100');
INSERT INTO `property_to_product` VALUES (196, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (196, 32, '98');
INSERT INTO `property_to_product` VALUES (196, 40, 'до 206');
INSERT INTO `property_to_product` VALUES (196, 41, '1500');
INSERT INTO `property_to_product` VALUES (196, 45, 'АЛФ-О-18-7');
INSERT INTO `property_to_product` VALUES (194, 3, '0.2');
INSERT INTO `property_to_product` VALUES (194, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (194, 9, '600-1100');
INSERT INTO `property_to_product` VALUES (194, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (194, 32, '78');
INSERT INTO `property_to_product` VALUES (194, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (194, 41, '1500');
INSERT INTO `property_to_product` VALUES (194, 45, 'АЛФ-О-12-7');
INSERT INTO `property_to_product` VALUES (205, 2, '98');
INSERT INTO `property_to_product` VALUES (205, 3, '0.2');
INSERT INTO `property_to_product` VALUES (205, 6, 'RAL7035, RAL7012');
INSERT INTO `property_to_product` VALUES (205, 9, '800');
INSERT INTO `property_to_product` VALUES (205, 11, 'до 300 (кратковременно)');
INSERT INTO `property_to_product` VALUES (205, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (205, 45, 'АЛФ-У-12-7');
INSERT INTO `property_to_product` VALUES (206, 2, '98');
INSERT INTO `property_to_product` VALUES (206, 3, '0.2');
INSERT INTO `property_to_product` VALUES (206, 6, 'RAL7035, RAL7012');
INSERT INTO `property_to_product` VALUES (206, 9, '800');
INSERT INTO `property_to_product` VALUES (206, 11, 'до 300 (кратковременно)');
INSERT INTO `property_to_product` VALUES (206, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (206, 45, 'АЛФ-У-12-7 ESD');
INSERT INTO `property_to_product` VALUES (200, 2, '98');
INSERT INTO `property_to_product` VALUES (200, 3, '0.2');
INSERT INTO `property_to_product` VALUES (200, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (200, 9, '600-1100');
INSERT INTO `property_to_product` VALUES (200, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (200, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (200, 41, '1500');
INSERT INTO `property_to_product` VALUES (200, 45, 'АЛФ-О-18-7 ESD');
INSERT INTO `property_to_product` VALUES (204, 2, '98');
INSERT INTO `property_to_product` VALUES (204, 3, '0.2');
INSERT INTO `property_to_product` VALUES (204, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (204, 9, '600-1100');
INSERT INTO `property_to_product` VALUES (204, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (204, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (204, 41, '1500');
INSERT INTO `property_to_product` VALUES (204, 45, 'АЛФ-О-18-7 ESD');
INSERT INTO `property_to_product` VALUES (198, 3, '0.2');
INSERT INTO `property_to_product` VALUES (198, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (198, 9, '600-1100');
INSERT INTO `property_to_product` VALUES (198, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (198, 32, '88');
INSERT INTO `property_to_product` VALUES (198, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (198, 41, '1500');
INSERT INTO `property_to_product` VALUES (198, 45, 'АЛФ-О-15-7 ESD');
INSERT INTO `property_to_product` VALUES (197, 3, '0.2');
INSERT INTO `property_to_product` VALUES (197, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (197, 9, '600-1100');
INSERT INTO `property_to_product` VALUES (197, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (197, 32, '78');
INSERT INTO `property_to_product` VALUES (197, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (197, 41, '1500');
INSERT INTO `property_to_product` VALUES (197, 45, 'АЛФ-О-12-7 ESD');
INSERT INTO `property_to_product` VALUES (209, 2, '98');
INSERT INTO `property_to_product` VALUES (209, 3, '0.2');
INSERT INTO `property_to_product` VALUES (209, 6, 'RAL7035, RAL7012');
INSERT INTO `property_to_product` VALUES (209, 9, '800');
INSERT INTO `property_to_product` VALUES (209, 11, 'до 300 (кратковременно)');
INSERT INTO `property_to_product` VALUES (209, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (209, 45, 'АЛФ-Т-12-8 ');
INSERT INTO `property_to_product` VALUES (210, 2, '98');
INSERT INTO `property_to_product` VALUES (210, 3, '0.2');
INSERT INTO `property_to_product` VALUES (210, 6, 'RAL7035, RAL7012');
INSERT INTO `property_to_product` VALUES (210, 9, '800');
INSERT INTO `property_to_product` VALUES (210, 11, 'до 300 (кратковременно)');
INSERT INTO `property_to_product` VALUES (210, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (210, 45, 'АЛФ-Т-12-8 ESD');
INSERT INTO `property_to_product` VALUES (192, 1, '123');
INSERT INTO `property_to_product` VALUES (192, 2, '50');
INSERT INTO `property_to_product` VALUES (192, 3, '0.2');
INSERT INTO `property_to_product` VALUES (192, 4, '1200х700');
INSERT INTO `property_to_product` VALUES (192, 6, 'RAL7035, 7012');
INSERT INTO `property_to_product` VALUES (192, 9, '650-950');
INSERT INTO `property_to_product` VALUES (192, 11, '300 С');
INSERT INTO `property_to_product` VALUES (192, 31, '300');
INSERT INTO `property_to_product` VALUES (192, 44, '1200х700');
INSERT INTO `property_to_product` VALUES (232, 1, 'УС-1');
INSERT INTO `property_to_product` VALUES (232, 2, '98');
INSERT INTO `property_to_product` VALUES (232, 3, '0.2');
INSERT INTO `property_to_product` VALUES (232, 4, '1200х700');
INSERT INTO `property_to_product` VALUES (232, 6, 'RAL7035, RAL7012');
INSERT INTO `property_to_product` VALUES (232, 9, '800');
INSERT INTO `property_to_product` VALUES (232, 11, 'до 300 ');
INSERT INTO `property_to_product` VALUES (232, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (233, 1, 'УС-1 ESD');
INSERT INTO `property_to_product` VALUES (233, 2, '98');
INSERT INTO `property_to_product` VALUES (233, 3, '0.2');
INSERT INTO `property_to_product` VALUES (233, 4, '1200х700');
INSERT INTO `property_to_product` VALUES (233, 6, 'RAL7035, RAL7012');
INSERT INTO `property_to_product` VALUES (233, 9, '800');
INSERT INTO `property_to_product` VALUES (233, 11, 'до 300 ');
INSERT INTO `property_to_product` VALUES (233, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (241, 1, 'УС-1');
INSERT INTO `property_to_product` VALUES (241, 2, '98');
INSERT INTO `property_to_product` VALUES (241, 3, '0.2');
INSERT INTO `property_to_product` VALUES (241, 4, '1200х700');
INSERT INTO `property_to_product` VALUES (241, 6, 'RAL7035, RAL7012');
INSERT INTO `property_to_product` VALUES (241, 9, '800');
INSERT INTO `property_to_product` VALUES (241, 11, 'до 300 ');
INSERT INTO `property_to_product` VALUES (241, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (96, 1, 'АЛФ-15-7 ESD Стол рабочий АЛЬФА антистатический');
INSERT INTO `property_to_product` VALUES (96, 3, '0.1');
INSERT INTO `property_to_product` VALUES (96, 4, '1500х700');
INSERT INTO `property_to_product` VALUES (96, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (96, 9, '600-1100');
INSERT INTO `property_to_product` VALUES (96, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (96, 32, '49');
INSERT INTO `property_to_product` VALUES (96, 39, '1500х700');
INSERT INTO `property_to_product` VALUES (96, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (96, 41, '1500');
INSERT INTO `property_to_product` VALUES (97, 1, 'АЛФ-18-7 ESD Стол рабочий АЛЬФА антистатический');
INSERT INTO `property_to_product` VALUES (95, 3, '0.1');
INSERT INTO `property_to_product` VALUES (95, 4, '1200х700');
INSERT INTO `property_to_product` VALUES (95, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (95, 9, '600-1100');
INSERT INTO `property_to_product` VALUES (95, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (95, 32, '44');
INSERT INTO `property_to_product` VALUES (95, 39, '1200х700');
INSERT INTO `property_to_product` VALUES (95, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (95, 41, '1500');
INSERT INTO `property_to_product` VALUES (70, 22, '1800');
INSERT INTO `property_to_product` VALUES (70, 29, '500');
INSERT INTO `property_to_product` VALUES (116, 1, 'АЛФ-ПО-12-3 Основная полка для оборудования');
INSERT INTO `property_to_product` VALUES (116, 2, '13');
INSERT INTO `property_to_product` VALUES (116, 3, '0.04');
INSERT INTO `property_to_product` VALUES (116, 5, '1200х300');
INSERT INTO `property_to_product` VALUES (116, 6, 'Светло-серый RAL7035');
INSERT INTO `property_to_product` VALUES (116, 8, '100');
INSERT INTO `property_to_product` VALUES (116, 11, '300');
INSERT INTO `property_to_product` VALUES (116, 42, '200-850');
INSERT INTO `property_to_product` VALUES (117, 1, 'АЛФ-ПО-15-3 Основная полка для оборудования');
INSERT INTO `property_to_product` VALUES (117, 2, '14');
INSERT INTO `property_to_product` VALUES (117, 3, '0.05');
INSERT INTO `property_to_product` VALUES (117, 5, '1500х300');
INSERT INTO `property_to_product` VALUES (117, 6, 'Светло-серый RAL7035');
INSERT INTO `property_to_product` VALUES (117, 8, '100');
INSERT INTO `property_to_product` VALUES (117, 11, '300');
INSERT INTO `property_to_product` VALUES (117, 42, '200-850');
INSERT INTO `property_to_product` VALUES (118, 1, 'АЛФ-ПО-18-3  Основная полка для оборудования');
INSERT INTO `property_to_product` VALUES (118, 2, '18');
INSERT INTO `property_to_product` VALUES (118, 3, '0.06');
INSERT INTO `property_to_product` VALUES (118, 5, '1800х300');
INSERT INTO `property_to_product` VALUES (118, 6, 'Светло-серый RAL7035');
INSERT INTO `property_to_product` VALUES (118, 8, '100');
INSERT INTO `property_to_product` VALUES (118, 11, '300');
INSERT INTO `property_to_product` VALUES (118, 42, '200-850');
INSERT INTO `property_to_product` VALUES (119, 1, 'АЛФ-ПО-12-3 ESD Основная полка для оборудования');
INSERT INTO `property_to_product` VALUES (119, 2, '13');
INSERT INTO `property_to_product` VALUES (119, 3, '0.04');
INSERT INTO `property_to_product` VALUES (119, 5, '1200х300');
INSERT INTO `property_to_product` VALUES (119, 6, 'Светло-серый RAL7035');
INSERT INTO `property_to_product` VALUES (119, 8, '100');
INSERT INTO `property_to_product` VALUES (119, 11, '300');
INSERT INTO `property_to_product` VALUES (119, 42, '200-850');
INSERT INTO `property_to_product` VALUES (120, 1, 'АЛФ-ПО-15-3 ESD Основная полка для оборудования ');
INSERT INTO `property_to_product` VALUES (120, 2, '14');
INSERT INTO `property_to_product` VALUES (120, 3, '0.05');
INSERT INTO `property_to_product` VALUES (120, 5, '1500х300');
INSERT INTO `property_to_product` VALUES (120, 6, 'Светло-серый RAL7035');
INSERT INTO `property_to_product` VALUES (120, 8, '100');
INSERT INTO `property_to_product` VALUES (120, 11, '300');
INSERT INTO `property_to_product` VALUES (120, 42, '200-850');
INSERT INTO `property_to_product` VALUES (121, 1, 'АЛФ-ПО-18-3 ESD Основная полка для оборудования');
INSERT INTO `property_to_product` VALUES (121, 2, '18');
INSERT INTO `property_to_product` VALUES (121, 3, '0.06');
INSERT INTO `property_to_product` VALUES (121, 5, '1800х300');
INSERT INTO `property_to_product` VALUES (121, 6, 'Светло-серый RAL7035');
INSERT INTO `property_to_product` VALUES (121, 8, '100');
INSERT INTO `property_to_product` VALUES (121, 11, '300');
INSERT INTO `property_to_product` VALUES (121, 42, '200-850');
INSERT INTO `property_to_product` VALUES (94, 1, 'АЛФ-18-7 Стол рабочий АЛЬФА');
INSERT INTO `property_to_product` VALUES (94, 3, '0.1');
INSERT INTO `property_to_product` VALUES (94, 4, '1800х700');
INSERT INTO `property_to_product` VALUES (94, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (94, 9, '600-1100');
INSERT INTO `property_to_product` VALUES (94, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (94, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (94, 41, '1500');
INSERT INTO `property_to_product` VALUES (150, 2, '1');
INSERT INTO `property_to_product` VALUES (150, 3, '1');
INSERT INTO `property_to_product` VALUES (150, 31, '1');
INSERT INTO `property_to_product` VALUES (250, 1, 'УС-1');
INSERT INTO `property_to_product` VALUES (250, 2, '28');
INSERT INTO `property_to_product` VALUES (250, 3, '0.1');
INSERT INTO `property_to_product` VALUES (250, 4, '1200х500');
INSERT INTO `property_to_product` VALUES (250, 6, 'RAL7035, RAL7012');
INSERT INTO `property_to_product` VALUES (250, 9, '650-900');
INSERT INTO `property_to_product` VALUES (250, 11, 'до 300 ');
INSERT INTO `property_to_product` VALUES (250, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (250, 47, '1');
INSERT INTO `property_to_product` VALUES (250, 48, '20');
INSERT INTO `property_to_product` VALUES (253, 1, 'УС-3 ESD');
INSERT INTO `property_to_product` VALUES (253, 2, '28');
INSERT INTO `property_to_product` VALUES (253, 3, '0.1');
INSERT INTO `property_to_product` VALUES (253, 4, '1200х503');
INSERT INTO `property_to_product` VALUES (253, 6, 'RAL7035, RAL7012');
INSERT INTO `property_to_product` VALUES (253, 9, '650-902');
INSERT INTO `property_to_product` VALUES (253, 11, 'до 303');
INSERT INTO `property_to_product` VALUES (253, 40, 'до 203');
INSERT INTO `property_to_product` VALUES (253, 47, '1');
INSERT INTO `property_to_product` VALUES (253, 48, '20');
INSERT INTO `property_to_product` VALUES (252, 1, 'УС-2 ESD');
INSERT INTO `property_to_product` VALUES (252, 2, '28');
INSERT INTO `property_to_product` VALUES (252, 3, '0.1');
INSERT INTO `property_to_product` VALUES (252, 4, '1200х502');
INSERT INTO `property_to_product` VALUES (252, 6, 'RAL7035, RAL7012');
INSERT INTO `property_to_product` VALUES (252, 9, '650-901');
INSERT INTO `property_to_product` VALUES (252, 11, 'до 302');
INSERT INTO `property_to_product` VALUES (252, 40, 'до 202');
INSERT INTO `property_to_product` VALUES (252, 47, '1');
INSERT INTO `property_to_product` VALUES (252, 48, '20');
INSERT INTO `property_to_product` VALUES (251, 1, 'УС-1 ESD  ');
INSERT INTO `property_to_product` VALUES (251, 2, '28');
INSERT INTO `property_to_product` VALUES (251, 3, '0.1');
INSERT INTO `property_to_product` VALUES (251, 4, '1200х501');
INSERT INTO `property_to_product` VALUES (251, 6, 'RAL7035, RAL7012');
INSERT INTO `property_to_product` VALUES (251, 9, '650-900');
INSERT INTO `property_to_product` VALUES (251, 11, 'до 301');
INSERT INTO `property_to_product` VALUES (251, 40, 'до 201');
INSERT INTO `property_to_product` VALUES (251, 47, '1');
INSERT INTO `property_to_product` VALUES (251, 48, '20');
INSERT INTO `property_to_product` VALUES (93, 1, 'АЛФ-15-7 Стол рабочий АЛЬФА');
INSERT INTO `property_to_product` VALUES (93, 2, '49');
INSERT INTO `property_to_product` VALUES (93, 3, '0.1');
INSERT INTO `property_to_product` VALUES (93, 4, '1500х700');
INSERT INTO `property_to_product` VALUES (93, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (93, 9, '600-1100');
INSERT INTO `property_to_product` VALUES (93, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (93, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (93, 41, '1500');
INSERT INTO `property_to_product` VALUES (92, 1, 'АЛФ-12-7 Стол рабочий АЛЬФА');
INSERT INTO `property_to_product` VALUES (92, 2, '24');
INSERT INTO `property_to_product` VALUES (92, 3, '0.1');
INSERT INTO `property_to_product` VALUES (92, 4, '1200х700');
INSERT INTO `property_to_product` VALUES (92, 6, 'Светло серый RAL7035');
INSERT INTO `property_to_product` VALUES (92, 9, '600-1100');
INSERT INTO `property_to_product` VALUES (92, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (92, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (92, 41, '1500');
INSERT INTO `property_to_product` VALUES (191, 2, '50');
INSERT INTO `property_to_product` VALUES (191, 3, '0.2');
INSERT INTO `property_to_product` VALUES (191, 4, '1200х700');
INSERT INTO `property_to_product` VALUES (191, 6, 'RAL7035, 7012');
INSERT INTO `property_to_product` VALUES (191, 9, '650-950');
INSERT INTO `property_to_product` VALUES (191, 11, '300 С');
INSERT INTO `property_to_product` VALUES (191, 31, '300');
INSERT INTO `property_to_product` VALUES (301, 1, 'УС-1');
INSERT INTO `property_to_product` VALUES (301, 2, '28');
INSERT INTO `property_to_product` VALUES (301, 3, '0.1');
INSERT INTO `property_to_product` VALUES (301, 4, '1200х500');
INSERT INTO `property_to_product` VALUES (301, 6, 'RAL7035, RAL7012');
INSERT INTO `property_to_product` VALUES (301, 9, '650-900');
INSERT INTO `property_to_product` VALUES (301, 11, 'до 300 ');
INSERT INTO `property_to_product` VALUES (301, 40, 'до 200');
INSERT INTO `property_to_product` VALUES (301, 47, '1');
INSERT INTO `property_to_product` VALUES (301, 48, '20');
INSERT INTO `property_to_product` VALUES (302, 1, 'СР-15-7');
INSERT INTO `property_to_product` VALUES (302, 2, '34');
INSERT INTO `property_to_product` VALUES (302, 3, '0.2');
INSERT INTO `property_to_product` VALUES (302, 6, 'RAL7035, RAL7012');
INSERT INTO `property_to_product` VALUES (302, 9, '650-900');
INSERT INTO `property_to_product` VALUES (302, 11, 'до 300 ');
INSERT INTO `property_to_product` VALUES (302, 20, '1500х700');
INSERT INTO `property_to_product` VALUES (302, 40, 'до 300');
INSERT INTO `property_to_product` VALUES (302, 47, '1');
INSERT INTO `property_to_product` VALUES (302, 48, '20');
INSERT INTO `property_to_product` VALUES (303, 1, 'СР-15-7 ESD');
INSERT INTO `property_to_product` VALUES (303, 2, '34');
INSERT INTO `property_to_product` VALUES (303, 3, '0.2');
INSERT INTO `property_to_product` VALUES (303, 6, 'RAL7035, RAL7012');
INSERT INTO `property_to_product` VALUES (303, 9, '650-900');
INSERT INTO `property_to_product` VALUES (303, 11, 'до 300');
INSERT INTO `property_to_product` VALUES (303, 20, '1500х700');
INSERT INTO `property_to_product` VALUES (303, 40, 'до 300');
INSERT INTO `property_to_product` VALUES (303, 47, '1');
INSERT INTO `property_to_product` VALUES (303, 48, '20');

-- ----------------------------
-- Table structure for service
-- ----------------------------
DROP TABLE IF EXISTS `service`;
CREATE TABLE `service`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `img` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `description` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `href` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `order` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of service
-- ----------------------------
INSERT INTO `service` VALUES (6, 'Выезд эксперта', '4738024844dbc774a14f39133e4c09cc.png', 'Подбор мебели на Вашем предприятии.', '/vyezd-specialista', 1);
INSERT INTO `service` VALUES (7, 'Подготовка ТЗ', '44c36e72e8f7472567b9f8ee1db8263c.png', '223-ФЗ, 44-ФЗ, согласно нормам ГОСТ, ТУ.', '/tehniceskoe-zadanie', 4);
INSERT INTO `service` VALUES (8, '3D-проект помещения', 'b8e6ba603153bdbf786e8ae283171365.png', 'Фотореалистичная трехмерная визуализация.', '/3d-proekt-pomesenij', 3);
INSERT INTO `service` VALUES (9, 'Конструктор мебели', '02f7b0ea11f7778bfaca084c689253cb.png', 'Составьте рабочее место из готовых модулей.', '/konstruktor-mebeli', 2);
INSERT INTO `service` VALUES (12, 'Сборка мебели', 'f0bcb9f300d92e8bb82e21e3202cc76d.png', 'Рабочие места в кратчайшие сроки.', '/sborka-mebeli', 5);

-- ----------------------------
-- Table structure for slider
-- ----------------------------
DROP TABLE IF EXISTS `slider`;
CREATE TABLE `slider`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `url` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of slider
-- ----------------------------
INSERT INTO `slider` VALUES (2, 'Промышленная мебель', 'для решения любых задач.', 'https://промышленная-мебель.рус/catalog/promyslennaa-mebel', 'slide1.png', 0);
INSERT INTO `slider` VALUES (3, 'Антистатическая мебель и оснащение', 'по требованиями современных стандартов.', 'https://промышленная-мебель.рус/catalog/antistaticeskaa-mebel-i-osnasenie', 'slide2.png', 1);
INSERT INTO `slider` VALUES (4, 'Паяльное оборудование', 'и материалы для пайки от ведущих производителей.', '/admin/slider', 'slide3.png', 2);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  UNIQUE INDEX `password_reset_token`(`password_reset_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'adminmebel', 'HUJuN2ZTc6T82ZjixON-EbS8howjk1XK', '$2y$13$MB7vr5zXPaUw6xxrHl7GX.nzltnjLAiVx3rfeKFrRXFQK0bKz/PJO', NULL, 10, 1588450381, 1588450381);

SET FOREIGN_KEY_CHECKS = 1;
