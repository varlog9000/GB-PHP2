-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 22 2019 г., 00:13
-- Версия сервера: 5.7.25
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `learn_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id_basket` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_good` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  `price` double DEFAULT NULL,
  `is_in_order` tinyint(4) DEFAULT '0',
  `id_order` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id_basket`, `id_user`, `id_good`, `count`, `price`, `is_in_order`, `id_order`) VALUES
(9, 9, 4, 18, 1980, 1, 23),
(11, 9, 2, 25, 960, 1, 23),
(12, 9, 1, 3, 450, 1, 23),
(13, 9, 8, 20, 85, 1, 24),
(14, 9, 3, 26, 1600, 1, 25),
(15, 9, 5, 4, 12000, 1, 25),
(24, 9, 18, 31, 5500, 1, 27),
(25, 9, 19, 14, 4500, 1, 27),
(26, 9, 12, 1, 200, 1, 27),
(27, 9, 13, 1, 100, 1, 27),
(28, 9, 10, 2, 600, 1, 27),
(29, 9, 9, 2, 350, 1, 27),
(30, 9, 11, 2, 750, 1, 27),
(31, 9, 5, 1, 12000, 1, 29),
(32, 9, 6, 1, 15000, 1, 29),
(33, 9, 7, 2, 400, 1, 29),
(34, 9, 8, 20, 85, 1, 29),
(35, 9, 9, 2, 350, 1, 29),
(36, 9, 10, 2, 600, 1, 29),
(37, 9, 11, 2, 750, 1, 29),
(38, 9, 12, 1, 200, 1, 29),
(39, 9, 13, 3, 100, 1, 29),
(40, 9, 18, 31, 5500, 1, 29),
(41, 9, 19, 14, 4500, 1, 29),
(42, 11, 18, 1, 5500, 1, 31),
(43, 11, 19, 1, 4500, 1, 31),
(59, 9, 12, 1, 200, 1, 33),
(60, 9, 13, 2, 100, 1, 33),
(61, 9, 11, 1, 750, 1, 34),
(62, 9, 1, 1, 450, 1, 34),
(63, 9, 3, 1, 1600, 1, 34),
(64, 9, 7, 2, 400, 1, 34),
(72, 11, 19, 1, 4500, 0, 0),
(73, 12, 1, 1, 450, 1, 35),
(74, 12, 1, 1, 450, 1, 36),
(75, 12, 7, 2, 400, 1, 36);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id_category`, `status`, `name`, `parent_id`, `photo`) VALUES
(1, 1, 'Огнетушители', 0, 'images/catogories/ognetushiteli.jpg'),
(2, 0, 'Подставки и кроштейны', 0, 'images/catogories/podstavki.jpg'),
(3, 1, 'Средства спасения и индивидуальной защиты', 0, 'images/catogories/sizod.jpg'),
(4, 1, 'Огнетушители Порошковые', 1, 'images/catogories/op.jpg'),
(5, 1, 'Огнетушители Углекислотные', 1, 'images/catogories/ou.jpg'),
(6, 1, 'Огнетушители Хлодоновые', 1, 'images/catogories/oh.jpg'),
(7, 1, 'Кронштейны и подставки', 0, 'images/catogories/o-podstavki.jpg'),
(8, 0, 'Чехлы', 2, 'images/catogories/chehly.jpg'),
(9, 0, 'Пеналы транспортные', 2, 'images/catogories/penal.jpg'),
(10, 1, 'Аптечки', 3, 'images/catogories/aptechki.jpg'),
(11, 1, 'Респираторы', 3, 'images/catogories/respiratory.jpg'),
(12, 1, 'Самоспасатели', 3, 'images/catogories/samospasateli.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id_good` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `id_status_good` int(11) DEFAULT NULL,
  `short_descr` varchar(250) DEFAULT NULL,
  `descr` varchar(5000) DEFAULT NULL,
  `photo` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id_good`, `name`, `price`, `id_category`, `id_status_good`, `short_descr`, `descr`, `photo`) VALUES
(1, 'Огнетушитель ОП-2', 450, 4, NULL, 'Автомобильный порошковый огнетушитель ОП-2 (з) АВСЕ подходит для прохождения ТО (техосмотра), также применяется для укомплектования общественных зданий', 'Порошковый огнетушитель ОП-2 (з) (автомобильный) предназначен для использования на автотранспорте.\r\n\r\nНаилучшими признано данное пожарное оборудование с классами тушения АВСЕ. Такой автомобильный огнетушитель эффективен при тушении возгорания твердых горючих материалов, горючих жидкостей, газов и электрооборудования под напряжением до 1000 В.\r\n\r\nСогласно нормам ГИБДД в транспортном средстве необходимо иметь не менее одного огнетушителя с массой огнетушащего вещества (ОТВ) 2 кг.\r\n\r\nС основными техническими характеристиками автомобильного огнетушителя порошкового ОП-2 (з) можно ознакомиться ниже.', 'images/goods/op-2.jpg'),
(2, 'Огнетушитель ОП-4', 960, 4, NULL, 'Порошковый огнетушитель ОП-4 (з) АВСЕ (бывший ОП-5) используется для оснащения общественных зданий, складов, промышленных предприятий и автотранспорта', 'Огнетушитель порошковый ОП-4 (з) - самая востребованная модель среди порошковых огнетушителей, заслужившая популярность благодаря широкому спектру применения и своим техническим характеристикам.\r\n\r\nОгнетушитель ОП-4 (з) используется для эффективной защиты общественных зданий, складов хранения (включая хранение горючих материалов и жидкостей, соответствующих классам A и B), промышленных предприятий, применяется в качестве первичного средства пожаротушения в быту (тушение возгорания газа класса C, электропроводки - класс E).\r\n\r\nОгнетушитель порошковый ОП-4 (з) АВСЕ применяют для комплектации легких грузовых автомобилей и микроавтобусов.\r\n\r\nДля хранения огнетушителя используются кронштейны и подставки под огнетушители.', 'images/goods/op-4.jpg'),
(3, 'Огнетушитель ОУ-2', 1600, 5, NULL, 'Автомобильный углекислотный огнетушитель ОУ-2 ВСЕ (по старой маркировке - ОУ-3) используется для укомплектования зданий и учреждений производственного и общественного назначения, допускается для прохождения ТО (техосмотра)', 'Огнетушитель углекислотный ОУ-2 (автомобильный) используется для защиты от возгорания легкового и малого коммерческого транспорта (по огнетушащей способности по B-классу соответствует порошковому огнетушителю ОП-2).\r\n\r\nДоказана эффективность использования ОУ-2 для борьбы с очагами пожара B-класса (горючие жидкости), C-класса (газы), E-класса (электропроводка и оборудование под напряжением).\r\n\r\nДопускается применение огнетушителя углекислотного ОУ-2 ВСЕ для укомлектования общественных зданий и ряда складских и производственных помещений.\r\n\r\nНиже в таблице приведены технические характеристики огнетушителя углекислотного ОУ-2.', 'images/goods/ou-2.jpg'),
(4, 'Огнетушитель ОУ-3', 1980, 5, NULL, '\r\nОгнетушитель ОУ-3 ВСЕ\r\nПопулярная модель углекислотного огнетушителя ОУ-3 ВСЕ (старое название ОУ-5) применяется для комплектации общественных зданий, помещений, электроустановок, малого коммерческого транспорта.', 'Огнетушитель углекислотный ОУ-3 используется в качестве первичного средства пожаротушения в общественных зданиях, бизнес-центрах, на складах, предприятиях, в бытовых условиях.\r\n\r\nПрименение огнетушителя ОУ-3 ВСЕ обусловлено следующими достоинствами:\r\n\r\nотсутствием следов огнетушащего вещества (ОТВ) после использования огнетушителя,\r\nболее эффективное тушение электропроводки и электроприборов под напряжением до 1000 В.\r\nОгнетушитель ОУ-3 является самым востребованным среди линейки углекислотных огнетушителей и незаменим при комплектации первичными средствами пожаротушения зданий музеев, архивов, офисов, квартир.\r\n\r\nНа малом коммерческом транспорте использование огнетушителя ОУ-3 ВСЕ (вместо огнетушителя углекислотного ОУ-2) более эффективно. Для оснащения автотранспорта допускаются углекислотные огнетушители соответствующие по огнетушащей способности по классу \"B\" порошковым (ОУ-3 может применятся на транспорте аналогично огнетушителю порошковому ОП-3).\r\n\r\nОгнетушитель ОУ-3 неприменим для тушения очагов возгораний класса A - горение твердых горючих веществ.\r\n\r\nДля хранения необходимо использовать пожарные шкафы для огнетушителей, напольные подставки или осуществлять монтаж на вертикальную поверхность с помощью универсальных кронштейнов на высоте 1,5 м от уровня пола до верхней части огнетушителя.', 'images/goods/ou-3.jpg'),
(5, 'Огнетушитель хладоновый ОХ-2(з)', 12000, 6, NULL, 'Огнетушитель хладоновый ОХ-2(з)-АВСЕ-01 при тушении не оставляет следов. Используется для защиты объектов, где загрязнение поверхности очень критично, например: вычислительная техника, предметы искусства. Масса заряда ГОТВ - 2 кг.', 'Огнетушители хладоновые закачные ОХ-2(з)-АВСЕ-01 являются первичным средством пожаротушения и предназначены для тушения пожаров классов А (горение твердых веществ и материалов, В (горение жидких веществ), С (горение газообразных веществ), Е (горение электроустановок, находящиеся под напряжением до 400 В). Огнетушители хладоновые необходимы в тех случаях, когда огнетушащий состав не должен причинять вред защищаемому оборудованию и электрооборудованию, находящемуся под напряжением (помещения, где расположена радиоэлектронная аппаратура, музейные экспонаты, архивы, вычислительные центры, серверы).\r\nОгнетушители не предназначены для тушения загорания щелочных, щелочноземельных металлов и других материалов, горение которых может проходить без доступа воздуха.\r\n\r\nОгнетушитель выпускается в климатическом исполнении «У» категории размещения 2 по ГОСТ 15151-69.\r\n\r\nДиапазон температур хранения и эксплуатации огнетушителя составляет от минус 40°С до плюс 50°С.', 'images/goods/oh-2.jpg'),
(6, 'Огнетушитель хладоновый ОХ-4(з)', 15000, 6, NULL, 'Огнетушитель хладоновый ОХ-4(з)-АВСЕ-01 при тушении не оставляет следов. Используется для защиты объектов, где загрязнение поверхности очень критично, например: вычислительная техника, предметы искусства. Масса заряда ГОТВ - 4 кг.', 'Огнетушители хладоновые закачные ОХ-4(з)-АВСЕ-01 являются первичным средством пожаротушения и предназначены для тушения пожаров классов А (горение твердых веществ и материалов, В (горение жидких веществ), С (горение газообразных веществ), Е (горение электроустановок, находящиеся под напряжением до 400 В). Огнетушители хладоновые необходимы в тех случаях, когда огнетушащий состав не должен причинять вред защищаемому оборудованию и электрооборудованию, находящемуся под напряжением (помещения, где расположена радиоэлектронная аппаратура, музейные экспонаты, архивы, вычислительные центры, серверы).\r\nОгнетушители не предназначены для тушения загорания щелочных, щелочноземельных металлов и других материалов, горение которых может проходить без доступа воздуха.\r\n\r\nОгнетушитель выпускается в климатическом исполнении «У» категории размещения 2 по ГОСТ 15151-69.\r\n\r\nДиапазон температур хранения и эксплуатации огнетушителя составляет от минус 40°С до плюс 50°С.', 'images/goods/oh-4.jpg'),
(7, 'Подставка для огнетушителя П-10', 400, 7, NULL, 'Размеры: 170 x 400 x 170 мм. Предназначена для размещения огнетушителей массой до 10 кг. Материал: листовая сталь, покрытая порошковой краской', 'Подставки для огнетушителей металлические напольные предназначены для размещения в них переносных огнетушителей и могут быть расположены на производственных объектах и в общественных зданиях.\r\nПодставки рассчитаны на эксплуатацию в помещениях при температуре от 5 до 45 град. и относительной влажности до 95%.\r\nРазмеры: 170 x 400 x 170 мм.\r\n\r\nСрок эксплуатации подставок для огнетушителей - не менее 10 лет', 'images/goods/podstavka-p-20.jpg'),
(8, 'Кронштейн для огнетушителя КО-2', 85, 7, NULL, 'Подходит для огнетушителей порошковых ОП-1, ОП-2, ОП-3, ОП-4, ОП-5 и углекислотных ОУ-1, ОУ-2, ОУ-3.', 'Крепление КО-2 настенное для огнетушителя универсальное металлическое, подвес огнетушителей порошковых ОП-1 - ОП-5 и углекислотных ОУ-1 - ОУ-3.\r\nКомпактный и легкий настенный кронштейн разработан для прочного крепления огнетушителей к твердым поверхностям, обеспечивая аккуратное хранение противопожарного  оборудования и возможность его немедленного использования в случае возникновения возгорания.\r\nОгнетушитель навешивается на кронштейн запорно-пусковым устройством. \r\nВыдерживаемый креплением вес - до 8 кг.', 'images/goods/podves-metall-2.jpg'),
(9, 'Аптечка автомобильная ФЭСТ', 350, 10, NULL, 'Для оснащения автотранспортных средств.', 'Для количества людей, находящихся в автомобиле, микроавтобусе, автобусе. \r\n\r\nАптечка изготовлена в соответствии с приказом Минздравмедпрома РФ от 20.08.1996 года №325 (в редакции приказа Минздравсоцразвития России от 08.09.2009 года №697н)  ТУ 9398-100-10973749-2009\r\n\r\nРазмеры футляров: \r\nиз полистирола - 210x210x65 мм\r\nмягкий футляр - 175х135х70 мм', 'images/goods/aa.jpg'),
(10, 'Аптечка универсальная ФЭСТ', 600, 10, NULL, 'Для оказания неотложной медицинской помощи в производственных условиях с числом работающих до 7 человек.', 'ТУ 9398-040-10973749-2009\r\n\r\nРазмер футляра: 210x210x75 мм\r\n \r\n№	СОСТАВ	 \r\n1	Анальгин, табл. 0,5 №10	1 уп.\r\n2	Валидол, табл. 0,06 №6	1 уп.\r\n3	Уголь активированный, табл. 0,25 №10	2 уп.\r\n4	Бинт стерильный 5 м х 10 см или 5 м x 7 см	1 шт.\r\n5	Бинт нестерильный 5 м х 10 см	1 шт.\r\n6	Бинт нестерильный 5 м х 5 см	1 шт.\r\n7	Бинт эластичный трубчатый медицинский нестерильный №1, 3, 6	по 1 шт.\r\n8	Вата, 50 г	1 уп.\r\n9	Бриллиантового зеленого раствор 1%, 10 мл	1 фл.\r\n10	Аммиака раствор 10%, 10 мл	1 фл.\r\n11	Экстракт валерианы, табл. 0,02 №10	1 уп.\r\n12	Лейкопластырь бактерицидный 1,9 x 7,2 см	4 уп.\r\n13	Жгут кровоостанавливающий	1 шт.\r\n14	Гипотермический (охлаждающий) пакет	1 шт.\r\n15	Стаканчик для приема лекарств	1 шт.\r\n16	Перекиси водорода раствор 3%, 40 мл	1 фл.\r\n17	Салфетки марлевые медицинские стерильные 16 x 14 см, №20	1 уп.\r\n18	Тетрациклиновая мазь 3%, 15 г	1 уп.', 'images/goods/au.jpg'),
(11, 'Аптечка офисная ФЭСТ', 750, 10, NULL, 'Для оснащения рабочих кабинетов учреждений и организаций - на 30 человек.\r\n\r\nФорма выпуска: пластиковый чемоданчик, сумка, пластиковый шках, металлический шкаф', 'АПТЕЧКА ПЕРВОЙ ПОМОЩИ ДЛЯ ОСНАЩЕНИЯ РАБОЧИХ КАБИНЕТОВ УЧРЕЖДЕНИЙ И ОРГАНИЗАЦИЙ АРК – ФЭСТ (офисная)\r\n\r\nДля оснащения рабочих кабинетов учреждений и организаций - на 30 человек.\r\n\r\nТУ 9398-038-10973749-2008\r\n\r\nРазмеры футляров:\r\nфутляр из полистирола - 305x265x100 мм\r\nмягкий футляр - 285х230х145 мм\r\nпластиковый шкаф - 250х300х110 мм\r\nметаллический шкаф - 250х309х98 мм\r\nАптечка для офиса – миниатюрный медпункт на рабочем месте\r\nПредприятие «ФЭСТ» предлагает универсальный набор медикаментов для нужд офиса. В состав аптечек входит все необходимое, чтобы оказать первую помощь в случае наиболее распространенных травм и несчастных случаев, которые могут случиться непосредственно на рабочем месте.', 'images/goods/ao.jpg'),
(12, 'Респиратор АЛИНА-200 АВК', 200, 11, NULL, 'предназначен для защиты органов дыхания от всех видов аэрозолей (пыль, дым, туман)', 'Респиратор Алина-200 АВК - предназначен для защиты органов дыхания от всех видов аэрозолей (пыль, дым, туман), включая радиоактивные и бактериологические, с дополнительной защитой от хлора и аммиака, паров и газов органического происхождения.\r\n\r\nОсобенности: универсальный размер (в том числе для детей с 4-х лет). Возможность применения без предварительного обучения. Герметичная фольгированная упаковка. Гарантийный срок хранения в индивидуальной упаковке – 5 лет.', 'images/goods/alina.jpg'),
(13, 'Респиратор Лепесток', 100, 11, NULL, 'для защиты от грубодисперсных аэрозолей (диаметр частиц свыше 2 мкм) высокоопасных и умеренно опасных вредных веществ при концентрациях до 200 ПДК', 'Респираторы модели «Лепесток» представляют собой неформованную маску и предназначены для защиты органов дыхания от аэрозольных вредных примесей.\r\n\r\nРеспиратор «Лепесток» рекомендуется применять для защиты от грубодисперсных аэрозолей (диаметр частиц свыше 2 мкм) высокоопасных и умеренно опасных вредных веществ при концентрациях до 200 ПДК. От паров и газов респиратор «Лепесток» не защищает. Т.к. респиратор «Лепесток» не обогащает вдыхаемый воздух кислородом, поэтому его можно применять в атмосфере, содержащей не менее 17 % кислорода по объему.\r\n\r\nРеспиратор «Лепесток» хорошо зарекомендовал себя на щебеночных заводах и заводах железобетонных изделий, при погрузочно-разгрузочных работах, а также при сухой шлифовке, полировке, заточке, механическом удалении старой краски и др.\r\n\r\nПлотное прилегание респиратора «Лепесток» к лицу достигается за счет резинового шнура, вшитого по периметру круга и алюминиевой пластинки, обжимающей переносицу.', 'images/goods/lepestok.jpg'),
(18, 'Самоспасатель изолирующий противопожарный СИП-1', 5500, 12, NULL, 'предназначен для защиты органов дыхания, зрения и головы при самостоятельной эвакуации при пожаре', 'Самоспасатель изолирующий противопожарный СИП-1 предназначен для защиты органов дыхания, зрения и головы при самостоятельной эвакуации из высотных зданий, гостиниц, помещений вагонов, корабельных отсеков и т.д. во время пожара или при других аварийных ситуациях, связанных с выбросом любых вредных веществ, независимо от их концентрации, в том числе и при недостатке кислорода в воздухе.\r\n\r\nСамоспасатель СИП-1 служит для применения людьми старше 12 лет, в том числе имеющими длинные волосы, прически или очки, т.к. защитный колпак самоспасателя СИП-1 универсален и предохраняет голову и волосы при кратковременном контакте с открытым огнем.\r\n\r\nСамоспасатель СИП-1 имеет отличие от других аналогичных изолирующих самоспасателей расположением дыхательного мешка. У СИП-1 мешок располагается вокруг шеи, а не на груди, как у друних. Такая конструкция самоспасателя СИП-1 не мешает переносить грузы, имущество или людей, потерявших сознание. Кроме того конструктивные особенности самоспасателя СИП-1 предотвращают отрыв полумаски от лица и потерю дыхательной смеси из мешка при наклонах, падении, ползании или столкновении с препятствиями, что очень важно в сложных условиях аварийной ситуации.', 'images/goods/sip-1.jpg'),
(19, 'Самоспасатель «Шанс»-Е (Европейский)', 4500, 12, NULL, 'предназначен для защиты органов дыхания, глаз и кожи лица людей от токсичных продуктов горения, в том числе от оксида углерода, при эвакуации из задымленных помещений во время пожара', 'УФМС «Шанс»-Е предназначен для защиты органов дыхания, глаз и кожи лица людей от токсичных продуктов горения, в том числе от оксида углерода, при эвакуации из задымленных помещений во время пожара, а также от других опасных химических веществ (паров, газов и аэрозолей), в случае техногенных аварий и террористических актов.\r\n\r\nЛицевая часть самоспасателя «Шанс»-Е выпускается по требованиям европейского стандарта EN 403.\r\nДанная модель имеет улучшенные эргономические и эксплуатационные характеристики.\r\nСамоспасатель «Шанс»-Е еще более прост в надевании.\r\nСамоспасатель «Шанс»-Е имеет шейный обтюратор из эластичной резины.\r\n \r\n\r\n1.  Условия применения и ограничения:  Самоспасатель (полумаска) выпускается одного размера для взрослых и детей возраста от 7 лет. При этом, в надетом положении для людей старше 12 лет нижняя часть полумаски должна находится (примыкать) в углублении между ртом и подбородком, для людей от 7 до 12 лет – под подбородком. Изделие не требует подбора и подгонки по размерам, и может использоваться людьми, в том числе имеющими объемную и длинную прическу, усы, бороду, очки.\r\n\r\n2.  Состав изделия:  УФМС «Шанс»-Е состоит из лицевой части, изготовленной из термостойкого поливинилхлорида желтого или оранжевого цвета в виде капюшона (закрывающего всю голову человека), прозрачной термостойкой поливинилхлоридной пленки с общим полем зрения не менее 70%, эластичного регулируемого оголовья, полумаски с двумя клапанами вдоха и одним клапаном выдоха и защитной накладкой клапана выдоха из огнестойкого термоэластопласта желтого цвета, двух фильтрующе-поглощающих патронов (пластиковые коробки диаметром 80 мм и высотой 40 мм) закрытые манжетами из огнестойкого термоэластопласта желтого цвета и герметизирующего шейного обтюратора.', 'images/goods/shans-e.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `goods_status`
--

CREATE TABLE `goods_status` (
  `id_good_status` int(11) NOT NULL,
  `good_status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `datetime_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `owner_name` varchar(75) DEFAULT NULL,
  `phone` varchar(18) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `id_order_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `amount`, `datetime_create`, `owner_name`, `phone`, `address`, `id_order_status`) VALUES
(23, 9, NULL, '2019-04-16 13:14:10', 'Никита', '+79626844700', 'Кузьмолово', 1),
(24, 9, 85, '2019-04-16 14:13:06', 'Никита', '+79626844700', 'Кузьмолово', 1),
(25, 9, 13600, '2019-04-16 15:04:51', 'Никита', '+79626844700', 'Кузьмолово', 1),
(26, 9, 0, '2019-04-16 16:29:50', '', '', '', 1),
(27, 9, 23000, '2019-04-16 16:39:29', 'Никита', '+79626844700', 'Кузьмолово', 3),
(29, 9, 45020, '2019-04-16 16:52:08', 'Яна', '+79215927187', 'Хошимина', 4),
(30, 11, 44000, '2019-04-16 17:00:21', '', '', '', 1),
(31, 11, 11410, '2019-04-16 17:07:34', 'Яна+Никита', '+79215927187', 'Хошимина', 6),
(32, 11, 0, '2019-04-16 17:15:58', '', '', '', 1),
(33, 9, 400, '2019-04-16 23:44:39', 'Никита', '+79215927187', 'Хошимина', 1),
(34, 9, 4000, '2019-04-17 10:38:16', 'Никита', '+79626844700', 'Кузьмолово', 1),
(35, 12, 450, '2019-04-20 20:02:52', 'Яна', '+79215927187', 'Хошимина', 1),
(36, 12, 1250, '2019-04-20 20:03:58', 'Янетта', '+79215927187', 'Хошимина', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `order_status`
--

CREATE TABLE `order_status` (
  `id_order_status` int(11) NOT NULL,
  `order_status_name` varchar(50) NOT NULL,
  `sort` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_status`
--

INSERT INTO `order_status` (`id_order_status`, `order_status_name`, `sort`) VALUES
(1, 'Оформлен', 1),
(2, 'Завершен', 5),
(3, 'Подтвержден', 2),
(4, 'Передан для самовывоза', 3),
(5, 'Передан в доставку', 4),
(6, 'Отменен', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_login` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_last_action` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `user_name`, `user_login`, `user_password`, `user_last_action`) VALUES
(7, 'Никита', 'admin', '3cf108a4e0a498347a5a75a792f23212378b73f38d223849ee9a19900343fe7a30213a7777106cc760c3bc4d8fa72e48', '2019-04-09 23:27:48'),
(8, 'Валентина', 'vlt', '5b10d90161a21057df6b411bae1528c4378b73f38d223849ee9a19900343fe7a778cfa3dc57d9c174c163ace65369625', '2019-04-10 07:01:48'),
(9, 'adm', 'adm', '46d32f3273b944711f375cddf006c90b202cb962ac59075b964b07152d234b7080177534a0c99a7e3645b52f2027a48b', '2019-04-10 08:11:43'),
(10, 'vlt', 'vlt', '5b10d90161a21057df6b411bae1528c4202cb962ac59075b964b07152d234b704db7f2af642040109eab802746c7b7f4', '2019-04-10 20:47:44'),
(11, 'Яна', 'yana', '1520b22b5d316b55b60b7780d8e1ec1e202cb962ac59075b964b07152d234b70f120b1fbce5e71f228b8764c574455da', '2019-04-13 21:51:46'),
(12, 'Янетта', '111', '866107b7d994185ec121a8d91a15d896698d51a19d8a121ce581499d7b70166896e79218965eb72c92a549dd5a330112', '2019-04-20 16:54:21');

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE `user_role` (
  `id_user_role` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id_basket`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id_good`),
  ADD UNIQUE KEY `id_good` (`id_good`);

--
-- Индексы таблицы `goods_status`
--
ALTER TABLE `goods_status`
  ADD PRIMARY KEY (`id_good_status`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Индексы таблицы `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id_order_status`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Индексы таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_user_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id_basket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id_good` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `goods_status`
--
ALTER TABLE `goods_status`
  MODIFY `id_good_status` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id_order_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_user_role` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
