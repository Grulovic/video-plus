-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 169.254.0.2:3306
-- Generation Time: Mar 10, 2021 at 09:24 PM
-- Server version: 10.3.23-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grulovic_video`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Business', 'This is some description for the Business category.', '2021-02-06 11:16:40', '2021-02-06 11:16:52'),
(2, 1, 'Cars', 'This is some description for the Cars category.', '2021-02-06 11:16:40', '2021-02-06 11:16:52'),
(3, 1, 'Entertainment', 'This is some description for the Entertainment category.', '2021-02-06 11:16:40', '2021-02-06 11:16:52'),
(4, 1, 'Family', 'This is some description for the Family category.', '2021-02-06 11:16:40', '2021-02-06 11:16:52'),
(5, 1, 'Health', 'This is some description for the Health category.', '2021-02-06 11:16:40', '2021-02-06 11:16:52'),
(6, 1, 'Politics', 'This is some description for the Politics category.', '2021-02-06 11:16:40', '2021-02-06 11:16:52'),
(7, 1, 'Religion', 'This is some description for the Religion category.', '2021-02-06 11:16:40', '2021-02-06 11:16:52'),
(8, 1, 'Science', 'This is some description for the Science category.', '2021-02-06 11:16:40', '2021-02-06 11:16:52'),
(9, 1, 'Sports', 'This is some description for the Sports category.', '2021-02-06 11:16:40', '2021-02-06 11:16:52'),
(10, 1, 'Technology', 'This is some description for the Technology category.', '2021-02-06 11:16:40', '2021-02-06 11:16:52'),
(11, 1, 'Travel', 'This is some description for the Travel category.', '2021-02-06 11:16:40', '2021-02-06 11:16:52'),
(12, 1, 'Video', 'This is some description for the Video category.', '2021-02-06 11:16:40', '2021-02-06 11:16:52'),
(13, 1, 'Test', 'Opis', '2021-02-16 14:41:32', '2021-02-16 14:41:32'),
(14, 1, 'Beograd', 'This is some description for the Beograd category.', '2021-02-13 21:34:39', '2021-02-13 21:34:39'),
(15, 1, 'Premijer', 'This is some description for the Premijer category.', '2021-02-13 21:34:50', '2021-02-16 13:36:46'),
(16, 1, 'COVID', 'This is some description for the COVID category.', '2021-02-13 21:34:59', '2021-02-13 21:34:59'),
(17, 1, 'Ministarstva', 'This is some description for the Ministarstva category.', '2021-02-13 21:35:10', '2021-02-16 13:37:46'),
(18, 1, 'Protesti', 'This is some description for the Protesti category.', '2021-02-13 21:35:18', '2021-02-13 21:35:18'),
(19, 1, 'Potpredsednici vlade', 'This is some description for the Potpredsednici vlade category.', '2021-02-13 21:35:36', '2021-02-16 13:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `user_id`, `name`, `description`, `location`, `created_at`, `updated_at`) VALUES
(15, 1, 'Najviše zaraženih u Beogradu, slede Vranje i Niš', 'U Srbiji su u proteklom danu potvrđena 1.622 nova slučaja koronavirusa, a najteža situacija i dalje je u Beogradu, gde je registrovano 615 obolelih, što je čak 38 odsto od ukupnog broja.\r\n\r\nU Kragujevcu je bilo 59 novih slučajeva, Vranju 54, Nišu 51, Kruševcu 48, Novom Sadu 40, Subotici 37, Kraljevu 35, Pančevu 32, Šapcu 23, a u Užicu 22, preneo je RTS.\r\n\r\nViše vesti o kovidu-19 i posledicama pandemije u zemlji i svetu čitajte na stranici Koronavirus.', 'Beograd, Srbija', '2021-02-13 21:42:41', '2021-02-13 21:42:41'),
(16, 1, 'DELOVAO MI JE KAO SJAJAN AMERIČKI GRAD: Ričard Grenel o Beogradu ima samo reči hvale', 'Nekadašnji specijalni izaslanik predsednika SAD Donalda Trampa za tzv. Kosovo Ričard Grenel o Beogradu ima samo reči hvale, pun je utisaka, a postoji i nešto što mu nedostaje.\r\n\r\n- Obožavam da boravim u Beogradu. Iako sam pronašao nekoliko omiljenih restorana, još nisam pronašao dobru teretanu - vežbanje mi je važno. Pomišljam da pitam ministra finansija Sinišu Malog za preporuke teretana, jer smo jednom vežbali zajedno u Vašingtonu - otkriva Grenel.\r\n\r\nKaže da ima nekoliko prijatelja koji žive duž reke i da je veoma ljubomoran na ono što imaju. Predsednik Vučić ga je, kaže, vodio u obilazak rive brodom i bio je veoma impresioniran.\r\n\r\n- Beograd mi je delovao kao sjajan američki grad - rekao je on.', 'Beograd, Srbija', '2021-02-13 21:44:17', '2021-02-13 21:44:17'),
(17, 1, 'Brnabić: Svečano otvaranje gondole ne utiče na širenje koronavirusa', 'Novoizgrađena gondola koja povezuje Brzeće sa Malim Karamanom na vrhu Kopaonika završena je pet meseci pre roka i to treba proslaviti, izjavila je danas premijerka Ana Brnabić uz napomenu da to neće uticati na promenu situacije u vezi sa virusom korona.\r\n\r\nBrnabić je to rekla u Brzeću na otvaranju gondole, a odgovarajući na pitanje novinara zašto je odlučila da baš danas otvori gondolu s obzirom da nam predstoje praznici, da je Kopaonik već pun, a da medicinski deo Kriznog štaba očekuje povećanje broja zaraženih i poziva na poštovanje mera i oprez.\r\n\r\n„Ako ja ne otvorim danas gondolu ne znači da ljudi neće dolaziti. Gondola je završena i treba da je otvorimo, a na neki način će pomoći i da smanjimo gužve“, istakla je premijerka.\r\n\r\nBrnabić dodaje i da su ljudi nevezano za gondolu već tu i ističe da se niko nije zarazio na skijanju, već u kafićima.\r\n\r\nU tom smislu, napominje da je povećan inspekcijski nadzor u ugostiteljskim objektima.\r\n\r\n„Gondola je završena pet meseci pre roka i to treba proslaviti. Ovo neće promeniti ništa u smislu korone“, rekla je Brnabić.', 'Kopaonik, Srbija', '2021-02-13 21:45:29', '2021-02-13 21:45:29'),
(21, 1, 'Brnabić: Sutra u Srbiju stiže dodatnih 40.000 Fajzerovih vakcina', 'Premijerka Srbije Ana Brnabić kazala je da je Srbija spremna da donira vakcine protiv korona virusa svim zemljama regiona, ukoliko to bude potrebno.\r\n\r\n- Solidarnost u ovim trenucima je najvažnija, Srbija i naš narod su poznati po solidarnosti. Nama već sutra stiže dodatni kontigent Fajzer vakcina od 40.000 - rekla je premijerka na TV Prva.', NULL, '2021-02-14 13:47:27', '2021-02-14 13:47:27'),
(22, 1, 'Kopaonik dobio novu gondolu Brzeće - Mali Karaman', 'BRZEĆE - Novoizgrađena gondola koja povezuje Brzeće sa Malim Karamanom na vrhu Kopaonika puštena je danas u rad, u prisustvu premijerke Ane Brnabić.', 'Kopaonik', '2021-02-14 13:51:44', '2021-02-14 13:51:44'),
(23, 1, 'Brnabić svečano dočekala premijera Češke', 'Predsednica Vlade Republike Srbije Ana Brnabić dočekala je danas ispred Palate Srbija, uz intoniranje himni dveju zemalja i postrojenu Gardu, predsednika Vlade Češke Republike Andreja Babiša, koji boravi u jednodnevnoj poseti Srbiji.', 'Beograd', '2021-02-14 13:53:29', '2021-02-14 13:53:29'),
(24, 1, 'Usvojen novi paket pomoći privredi i građanima', 'Predsednica Vlade Republike Srbije Ana Brnabić saopštila je da je Vlada na današnjoj sednici usvojila treći paket ekonomskih mera pomoći građanima i privredi, vredan 249 milijardi dinara.', 'Beograd', '2021-02-14 13:54:54', '2021-02-14 13:54:54'),
(25, 1, 'Srbija donirala Severnoj Makedoniji prvi kontingent vakcina', 'Srbija donirala Severnoj Makedoniji prvi kontingent vakcina', 'Tabanovce', '2021-02-14 13:56:54', '2021-02-14 13:56:54'),
(26, 14, 'Ruska vakcina biće isporučena Srbiji u dogovorenim količinama', 'Ruska vakcina biće isporučena Srbiji u dogovorenim količinama', NULL, '2021-02-15 11:24:25', '2021-02-15 11:24:25'),
(27, 14, 'Jaka Vojska čvrst bedem odbrane naše zemlje', 'Jaka Vojska čvrst bedem odbrane naše zemlje', NULL, '2021-02-15 11:26:03', '2021-02-15 11:26:03'),
(29, 14, 'Sretenjskim duhom inspirisana Srbija primer mnogima u svetu', 'Sretenjskim duhom inspirisana Srbija primer mnogima u svetu.\r\n\r\nPredsednica Vlade Republike Srbije Ana Brnabić poručila je u Orašcu da duh sretenjske Srbije vodi i inspiriše i danas, kada je Srbija postala jaka i moderna država koja vrednuje svoju istoriju i tradiciju i brine o građanima, nacionalnim interesima i ekonomiji.', 'Orasac', '2021-02-15 13:23:20', '2021-02-15 13:23:20'),
(40, 14, 'Brnabić uručila Crnoj Gori prvi kontingent vakcina \"Sputnjik V\"', 'Predsednica Vlade Republike Srbije Ana Brnabić doputovala je večeras u Podgoricu avionom Vlade Srbije, kojim je dopremljeno 2.000 doza ruske vakcine \"Sputnjik V\", koje je Srbija donirala Crnoj Gori.\r\nPremijerku Srbije su na aerodromu dočekali predsednik Vlade Republike Crne Gore Zdravko Krivokapić i ministarka zdravlja Jelena Borovinić Bojović.\r\nBrnabić je, nakon predaje prvog kontingenta vakcina, izrazila izuzetno zadovoljstvo time što može da Crnoj Gori uruči ovaj poklon, dodavši da je reč o prvim dozama 2.000 vakcina i da će uskoro biti donete i doze za revakcinaciju.\r\nOvo ne deluje kao velika količina vakcina, ali je dovoljna da se imunizuju ili zdravstveni radnici u crvenoj zoni ili korisnici i zaposleni u gerontološkim centrima. Ovo je za prvu liniju odbrane od virusa i pomoći će vam u toj borbi, istakla je ona.\r\nNa ovaj način Srbija želi da otvori novo poglavlje u odnosima dveju zemalja – da odnosi između dva naroda budu kao između braće i sestara, najboljih i najvećih prijatelja. Želimo da gradimo mostove bratstva i prijateljstva sa Crnom Gorom, poručila je premijerka Srbije.\r\nBrnabić je izrazila divljenje zbog toga kako se Crna Gora bori sa pandemijom koronavirusa, navodeći da primećuje da je sve veći broj testiranih, što je pravi vid borbe dok ne stigne vakcina.\r\nOna je, ukazavši na to da je naročito u teškim vremenima solidarnost najvažnija, poručila da je Srbija spremna da donira još vakcina Crnoj Gori ukoliko to bude potrebno.\r\nMi smo ove vakcine dobili zahvaljujući ličnom prijateljstvu predsednika Srbije Aleksandra Vučića i predsednika Ruske Federacije Vladimira Putina i veliko mi je zadovoljstvo što smo mogli da izađemo u susret Crnoj Gori, rekla je Brnabić.\r\nKrivokapić je preneo zahvalnost premijerki i državi Srbije na vakcinama, koje su, kako je naveo, najdragoceniji poklon, dodavši da je zdravlje iznad svega, a solidarnost pre svega.\r\nOn je podvukao da su vakcine koje je Srbija donirala toj zemlji dokaz velikog poštovanja koje Srbija iskazuje prema Crnoj Gori, pri čemu je izrazio nadu da će to biti novi početak razvoja međusobnih odnosa dveju zemalja.\r\nNadam se da će ovo biti novi početak razvoja naših odnosa, koji su jedno vreme bili u zastoju. Moramo da unapređujemo odnose u korist naših građana jer je to naša obaveza, rekao je predsednik Vlade Crne Gore.\r\nMolim vas da iskažete zahvalnost građanima Srbije koji su se odrekli doza vakcina za građane Crne Gore i to nije prvi put u istoriji, poručio je Krivokapić.', 'Podgorica', '2021-02-18 10:07:59', '2021-02-18 10:07:59'),
(41, 1, 'Razvoj turističke i trgovinske saradnje sa Slovenijom', 'Ministarka trgovine, turizma i telekomunikacija u Vladi Republike Srbije Tatjana Matić razgovarala je danas sa ambasadorom Slovenije u Srbiji Damjanom Bergantom o razvoju saradnje u oblastima turizma i trgovinske razmene.\r\nTom prilikom je konstatovano da je Slovenija jedna od najznačajnijih turističkih destinacija srpskih državljana i veoma važan spoljnotrgovinski partner.\r\nNaime, kako je ukazano, u poslednjih deset godina dve zemlje beleže konstantan rast trgovinske razmene, koja je dostigla obim od milijardu i 167 miliona evra u 2020. godini, uprkos pandemijskim okolnostima.\r\nSagovornici su izrazili očekivanje da će u narednom periodu biti sprovedena uspešna imunizacija, koja bi trebalo da omogući bolju privrednu i ekonomsku bilateralnu saradnju.\r\nPosebno je bilo reči o potencijalima banjskog turizma u Srbiji i mogućnostima partnerstva dveju zemalja u razvoju ove turističke grane.', 'Beograd', '2021-02-18 10:08:38', '2021-03-04 19:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_categories`
--

CREATE TABLE `gallery_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_categories`
--

INSERT INTO `gallery_categories` (`id`, `gallery_id`, `category_id`, `created_at`, `updated_at`) VALUES
(31, 6, 1, '2021-02-11 20:26:06', '2021-02-11 20:26:06'),
(32, 6, 2, '2021-02-11 20:26:06', '2021-02-11 20:26:06'),
(33, 6, 3, '2021-02-11 20:26:06', '2021-02-11 20:26:06'),
(34, 6, 4, '2021-02-11 20:26:06', '2021-02-11 20:26:06'),
(35, 6, 5, '2021-02-11 20:26:06', '2021-02-11 20:26:06'),
(36, 7, 1, '2021-02-11 20:26:10', '2021-02-11 20:26:10'),
(37, 7, 2, '2021-02-11 20:26:10', '2021-02-11 20:26:10'),
(38, 7, 3, '2021-02-11 20:26:10', '2021-02-11 20:26:10'),
(39, 7, 4, '2021-02-11 20:26:10', '2021-02-11 20:26:10'),
(40, 7, 5, '2021-02-11 20:26:10', '2021-02-11 20:26:10'),
(69, 15, 14, '2021-02-13 21:42:41', '2021-02-13 21:42:41'),
(70, 15, 16, '2021-02-13 21:42:41', '2021-02-13 21:42:41'),
(71, 16, 14, '2021-02-13 21:44:17', '2021-02-13 21:44:17'),
(72, 16, 11, '2021-02-13 21:44:17', '2021-02-13 21:44:17'),
(73, 16, 13, '2021-02-13 21:44:17', '2021-02-13 21:44:17'),
(74, 17, 15, '2021-02-13 21:45:29', '2021-02-13 21:45:29'),
(75, 17, 16, '2021-02-13 21:45:29', '2021-02-13 21:45:29'),
(85, 21, 15, '2021-02-14 13:47:27', '2021-02-14 13:47:27'),
(86, 22, 15, '2021-02-14 13:51:44', '2021-02-14 13:51:44'),
(87, 23, 15, '2021-02-14 13:53:29', '2021-02-14 13:53:29'),
(88, 24, 15, '2021-02-14 13:54:54', '2021-02-14 13:54:54'),
(89, 25, 14, '2021-02-14 13:56:54', '2021-02-14 13:56:54'),
(90, 26, 14, '2021-02-15 11:24:25', '2021-02-15 11:24:25'),
(91, 27, 14, '2021-02-15 11:26:03', '2021-02-15 11:26:03'),
(92, 29, 15, '2021-02-15 13:23:20', '2021-02-15 13:23:20'),
(94, 31, 14, '2021-02-15 15:34:06', '2021-02-15 15:34:06'),
(98, 40, 15, '2021-02-18 10:07:59', '2021-02-18 10:07:59'),
(108, 41, 17, '2021-03-04 19:24:34', '2021-03-04 19:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`id`, `user_id`, `video_id`, `gallery_id`, `action`, `created_at`, `updated_at`) VALUES
(1, 1, 6, NULL, 'Video Downloaded', '2021-02-06 12:28:03', '2021-02-06 12:28:03'),
(2, 1, 4, NULL, 'Video Downloaded', '2021-02-06 17:24:23', '2021-02-06 17:24:23'),
(36, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:28:29', '2021-02-10 18:28:29'),
(37, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:28:54', '2021-02-10 18:28:54'),
(38, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:29:29', '2021-02-10 18:29:29'),
(39, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:38:41', '2021-02-10 18:38:41'),
(40, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:40:21', '2021-02-10 18:40:21'),
(41, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:40:58', '2021-02-10 18:40:58'),
(42, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:41:10', '2021-02-10 18:41:10'),
(43, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:41:17', '2021-02-10 18:41:17'),
(44, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:41:18', '2021-02-10 18:41:18'),
(45, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:44:49', '2021-02-10 18:44:49'),
(46, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:45:27', '2021-02-10 18:45:27'),
(47, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:46:29', '2021-02-10 18:46:29'),
(48, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:46:43', '2021-02-10 18:46:43'),
(49, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:49:49', '2021-02-10 18:49:49'),
(50, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:50:13', '2021-02-10 18:50:13'),
(51, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:50:30', '2021-02-10 18:50:30'),
(52, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:50:53', '2021-02-10 18:50:53'),
(53, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:51:13', '2021-02-10 18:51:13'),
(54, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:51:47', '2021-02-10 18:51:47'),
(55, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:51:51', '2021-02-10 18:51:51'),
(56, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:52:18', '2021-02-10 18:52:18'),
(57, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:52:37', '2021-02-10 18:52:37'),
(58, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:53:05', '2021-02-10 18:53:05'),
(59, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:53:12', '2021-02-10 18:53:12'),
(60, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:53:21', '2021-02-10 18:53:21'),
(61, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:53:38', '2021-02-10 18:53:38'),
(62, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:54:09', '2021-02-10 18:54:09'),
(63, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:54:10', '2021-02-10 18:54:10'),
(64, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:54:15', '2021-02-10 18:54:15'),
(65, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:54:49', '2021-02-10 18:54:49'),
(66, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:55:12', '2021-02-10 18:55:12'),
(67, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:56:11', '2021-02-10 18:56:11'),
(68, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:58:18', '2021-02-10 18:58:18'),
(69, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:59:42', '2021-02-10 18:59:42'),
(70, 1, NULL, 4, 'Gallery Downloaded', '2021-02-10 18:59:52', '2021-02-10 18:59:52'),
(71, 1, NULL, 4, 'Gallery Downloaded', '2021-02-11 19:37:07', '2021-02-11 19:37:07'),
(72, 1, NULL, 8, 'Gallery Downloaded', '2021-02-11 20:45:02', '2021-02-11 20:45:02'),
(73, 1, 6, NULL, 'Video Downloaded', '2021-02-11 21:06:10', '2021-02-11 21:06:10'),
(74, 1, NULL, 20, 'Gallery Downloaded', '2021-02-13 22:04:55', '2021-02-13 22:04:55'),
(75, 1, 9, NULL, 'Video Downloaded', '2021-02-13 22:54:20', '2021-02-13 22:54:20'),
(76, 1, NULL, 18, 'Gallery Downloaded', '2021-02-13 22:54:32', '2021-02-13 22:54:32'),
(77, 1, 11, NULL, 'Video Downloaded', '2021-02-13 22:56:44', '2021-02-13 22:56:44'),
(78, 1, NULL, 32, 'Gallery Downloaded', '2021-02-15 15:43:20', '2021-02-15 15:43:20'),
(79, 1, 41, NULL, 'Video Uploaded', '2021-02-15 20:09:57', '2021-02-15 20:09:57'),
(80, 1, 41, NULL, 'Video Deleted', '2021-02-15 20:10:07', '2021-02-15 20:10:07'),
(81, 1, 42, NULL, 'Video Uploaded', '2021-02-15 20:10:33', '2021-02-15 20:10:33'),
(82, 1, 42, NULL, 'Video Edited', '2021-02-15 20:10:41', '2021-02-15 20:10:41'),
(83, 1, 42, NULL, 'Video Downloaded', '2021-02-15 20:10:50', '2021-02-15 20:10:50'),
(84, 1, 42, NULL, 'Video Deleted', '2021-02-15 20:11:03', '2021-02-15 20:11:03'),
(85, 1, NULL, 39, 'Gallery Uploaded', '2021-02-15 20:12:23', '2021-02-15 20:12:23'),
(86, 1, NULL, 39, 'Gallery Edited', '2021-02-15 20:12:34', '2021-02-15 20:12:34'),
(87, 1, NULL, 39, 'Gallery Deleted', '2021-02-15 20:12:43', '2021-02-15 20:12:43'),
(88, 14, 43, NULL, 'Video Uploaded', '2021-02-16 10:30:51', '2021-02-16 10:30:51'),
(89, 1, 38, NULL, 'Video Downloaded', '2021-02-16 13:31:50', '2021-02-16 13:31:50'),
(90, 1, NULL, 27, 'Gallery Downloaded', '2021-02-16 13:31:58', '2021-02-16 13:31:58'),
(91, 14, 44, NULL, 'Video Uploaded', '2021-02-16 17:01:03', '2021-02-16 17:01:03'),
(92, 14, 45, NULL, 'Video Uploaded', '2021-02-18 09:05:44', '2021-02-18 09:05:44'),
(93, 14, 46, NULL, 'Video Uploaded', '2021-02-18 09:10:27', '2021-02-18 09:10:27'),
(94, 14, 47, NULL, 'Video Uploaded', '2021-02-18 09:11:09', '2021-02-18 09:11:09'),
(95, 14, 48, NULL, 'Video Uploaded', '2021-02-18 09:20:19', '2021-02-18 09:20:19'),
(96, 14, 49, NULL, 'Video Uploaded', '2021-02-18 09:35:17', '2021-02-18 09:35:17'),
(97, 14, NULL, 40, 'Gallery Uploaded', '2021-02-18 10:07:59', '2021-02-18 10:07:59'),
(98, 14, NULL, 41, 'Gallery Uploaded', '2021-02-18 10:08:38', '2021-02-18 10:08:38'),
(99, 14, 50, NULL, 'Video Uploaded', '2021-02-18 13:42:46', '2021-02-18 13:42:46'),
(100, 14, 51, NULL, 'Video Uploaded', '2021-02-19 08:49:37', '2021-02-19 08:49:37'),
(101, 14, 52, NULL, 'Video Uploaded', '2021-02-19 08:50:22', '2021-02-19 08:50:22'),
(102, 14, 53, NULL, 'Video Uploaded', '2021-02-20 07:41:51', '2021-02-20 07:41:51'),
(103, 14, 54, NULL, 'Video Uploaded', '2021-02-21 12:02:02', '2021-02-21 12:02:02'),
(104, 14, 55, NULL, 'Video Uploaded', '2021-02-22 10:21:06', '2021-02-22 10:21:06'),
(105, 14, 56, NULL, 'Video Uploaded', '2021-02-22 10:21:48', '2021-02-22 10:21:48'),
(106, 14, 46, NULL, 'Video Downloaded', '2021-02-22 11:37:54', '2021-02-22 11:37:54'),
(107, 14, 51, NULL, 'Video Downloaded', '2021-02-22 12:33:25', '2021-02-22 12:33:25'),
(108, 14, NULL, 29, 'Gallery Downloaded', '2021-02-22 12:34:39', '2021-02-22 12:34:39'),
(109, 14, 57, NULL, 'Video Uploaded', '2021-02-24 09:04:24', '2021-02-24 09:04:24'),
(110, 14, 58, NULL, 'Video Uploaded', '2021-02-27 10:20:24', '2021-02-27 10:20:24'),
(111, 14, 59, NULL, 'Video Uploaded', '2021-02-27 10:21:26', '2021-02-27 10:21:26'),
(112, 1, NULL, 42, 'Gallery Uploaded', '2021-02-28 13:13:23', '2021-02-28 13:13:23'),
(113, 1, NULL, 42, 'Gallery Edited', '2021-02-28 13:16:11', '2021-02-28 13:16:11'),
(114, 1, NULL, 42, 'Gallery Edited', '2021-02-28 13:17:54', '2021-02-28 13:17:54'),
(115, 1, NULL, 42, 'Gallery Deleted', '2021-02-28 13:21:27', '2021-02-28 13:21:27'),
(116, 1, NULL, 43, 'Gallery Uploaded', '2021-02-28 13:27:40', '2021-02-28 13:27:40'),
(117, 1, NULL, 43, 'Gallery Deleted', '2021-02-28 13:29:04', '2021-02-28 13:29:04'),
(118, 14, 60, NULL, 'Video Uploaded', '2021-03-01 09:57:12', '2021-03-01 09:57:12'),
(119, 14, 61, NULL, 'Video Uploaded', '2021-03-03 09:58:10', '2021-03-03 09:58:10'),
(120, 14, 62, NULL, 'Video Uploaded', '2021-03-04 10:01:32', '2021-03-04 10:01:32'),
(121, 1, NULL, 44, 'Gallery Uploaded', '2021-03-04 19:02:09', '2021-03-04 19:02:09'),
(122, 1, NULL, 44, 'Gallery Deleted', '2021-03-04 19:02:13', '2021-03-04 19:02:13'),
(123, 1, NULL, 45, 'Gallery Uploaded', '2021-03-04 19:02:24', '2021-03-04 19:02:24'),
(124, 1, NULL, 45, 'Gallery Deleted', '2021-03-04 19:02:29', '2021-03-04 19:02:29'),
(125, 1, NULL, 46, 'Gallery Uploaded', '2021-03-04 19:03:03', '2021-03-04 19:03:03'),
(126, 1, NULL, 46, 'Gallery Deleted', '2021-03-04 19:03:08', '2021-03-04 19:03:08'),
(127, 1, NULL, 47, 'Gallery Uploaded', '2021-03-04 19:06:03', '2021-03-04 19:06:03'),
(128, 1, NULL, 47, 'Gallery Deleted', '2021-03-04 19:06:16', '2021-03-04 19:06:16'),
(129, 1, NULL, 48, 'Gallery Uploaded', '2021-03-04 19:09:02', '2021-03-04 19:09:02'),
(130, 1, NULL, 48, 'Gallery Deleted', '2021-03-04 19:09:07', '2021-03-04 19:09:07'),
(131, 1, NULL, 41, 'Gallery Edited', '2021-03-04 19:24:34', '2021-03-04 19:24:34'),
(132, 1, 62, NULL, 'Video Edited', '2021-03-04 19:29:01', '2021-03-04 19:29:01'),
(133, 1, NULL, 49, 'Gallery Uploaded', '2021-03-04 19:37:21', '2021-03-04 19:37:21'),
(134, 1, NULL, 49, 'Gallery Deleted', '2021-03-04 19:39:08', '2021-03-04 19:39:08'),
(135, 1, NULL, 16, 'Gallery Downloaded', '2021-03-05 19:02:37', '2021-03-05 19:02:37'),
(136, 1, NULL, 16, 'Gallery Downloaded', '2021-03-05 19:02:38', '2021-03-05 19:02:38'),
(137, 1, NULL, 16, 'Gallery Downloaded', '2021-03-05 19:02:39', '2021-03-05 19:02:39'),
(138, 1, NULL, 16, 'Gallery Downloaded', '2021-03-05 19:02:40', '2021-03-05 19:02:40'),
(139, 1, NULL, 41, 'Gallery Downloaded', '2021-03-05 19:04:07', '2021-03-05 19:04:07'),
(140, 1, 52, NULL, 'Video Downloaded', '2021-03-05 19:06:59', '2021-03-05 19:06:59'),
(141, 1, 46, NULL, 'Video Downloaded', '2021-03-05 19:08:59', '2021-03-05 19:08:59'),
(142, 14, 63, NULL, 'Video Uploaded', '2021-03-09 08:00:58', '2021-03-09 08:00:58'),
(143, 14, 64, NULL, 'Video Uploaded', '2021-03-09 08:02:03', '2021-03-09 08:02:03'),
(144, 14, 65, NULL, 'Video Uploaded', '2021-03-09 08:30:15', '2021-03-09 08:30:15'),
(145, 14, 66, NULL, 'Video Uploaded', '2021-03-09 08:32:06', '2021-03-09 08:32:06'),
(146, 14, 64, NULL, 'Video Downloaded', '2021-03-09 14:57:17', '2021-03-09 14:57:17'),
(147, 14, NULL, 24, 'Gallery Downloaded', '2021-03-09 15:00:56', '2021-03-09 15:00:56'),
(148, 14, 43, NULL, 'Video Downloaded', '2021-03-09 15:16:35', '2021-03-09 15:16:35'),
(149, 14, 67, NULL, 'Video Uploaded', '2021-03-09 15:18:06', '2021-03-09 15:18:06'),
(150, 14, NULL, 29, 'Gallery Downloaded', '2021-03-09 15:18:31', '2021-03-09 15:18:31'),
(151, 14, 67, NULL, 'Video Deleted', '2021-03-10 10:58:44', '2021-03-10 10:58:44'),
(152, 14, 68, NULL, 'Video Uploaded', '2021-03-10 11:00:36', '2021-03-10 11:00:36');

-- --------------------------------------------------------

--
-- Table structure for table `lives`
--

CREATE TABLE `lives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lives`
--

INSERT INTO `lives` (`id`, `user_id`, `title`, `description`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Live test', 'This is some description for Live test.', 'http://207.180.211.131:8080/VladaSrbije/embed.html', '2021-02-15 20:36:39', '2021-02-15 20:36:39'),
(3, 1, 'Live test 2', 'This is desc', 'http://207.180.211.131:8080/VladaSrbije/embed.html', '2021-02-16 13:33:04', '2021-03-04 19:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Live test', 'This is some description for Live test.', '2021-02-15 20:36:39', '2021-02-15 20:36:39'),
(3, 1, 'Live test 2', 'This is desc', '2021-02-16 13:33:04', '2021-03-04 19:25:54'),
(5, 1, 'edit title', 'edit desc', '2021-03-05 19:51:09', '2021-03-05 19:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_02_01_210243_create_sessions_table', 1),
(7, '2021_02_01_210703_create_videos_table', 1),
(8, '2021_02_01_210718_create_photos_table', 1),
(9, '2021_02_01_210746_create_histories_table', 1),
(10, '2021_02_01_211211_create_categories_table', 1),
(11, '2021_02_01_211858_create_video_categories_table', 1),
(12, '2021_02_01_213255_create_photo_categories_table', 1),
(13, '2021_02_08_205019_create_galleries_table', 2),
(14, '2021_02_08_205359_create_gallery_categories_table', 2),
(15, '2021_02_08_205526_create_gallery_photos_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `mime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `gallery_id`, `mime`, `file_name`, `original_file_name`, `created_at`, `updated_at`) VALUES
(58, 15, 'image/jpeg', '2021-02-13_22-42-41_covid.jpg', 'covid.jpg', '2021-02-13 21:42:41', '2021-02-13 21:42:41'),
(59, 15, 'image/jpeg', '2021-02-13_22-42-41_covid1.jpg', 'covid1.jpg', '2021-02-13 21:42:41', '2021-02-13 21:42:41'),
(60, 15, 'image/jpeg', '2021-02-13_22-42-41_covid2.jpg', 'covid2.jpg', '2021-02-13 21:42:41', '2021-02-13 21:42:41'),
(61, 15, 'image/jpeg', '2021-02-13_22-42-41_covid3.jpg', 'covid3.jpg', '2021-02-13 21:42:41', '2021-02-13 21:42:41'),
(62, 16, 'image/jpeg', '2021-02-13_22-44-17_beograd.jpg', 'beograd.jpg', '2021-02-13 21:44:17', '2021-02-13 21:44:17'),
(63, 16, 'image/jpeg', '2021-02-13_22-44-17_beograd1.jpg', 'beograd1.jpg', '2021-02-13 21:44:17', '2021-02-13 21:44:17'),
(64, 17, 'image/jpeg', '2021-02-13_22-45-29_brnabic.jpg', 'brnabic.jpg', '2021-02-13 21:45:29', '2021-02-13 21:45:29'),
(65, 17, 'image/jpeg', '2021-02-13_22-45-29_brnabic1.jpg', 'brnabic1.jpg', '2021-02-13 21:45:29', '2021-02-13 21:45:29'),
(66, 17, 'image/jpeg', '2021-02-13_22-45-29_brnabic2.jpg', 'brnabic2.jpg', '2021-02-13 21:45:29', '2021-02-13 21:45:29'),
(77, 21, 'image/jpeg', '2021-02-14_14-47-27_tan2021-2-111629505706-830x0.jpg', 'tan2021-2-111629505706-830x0.jpg', '2021-02-14 13:47:27', '2021-02-14 13:47:27'),
(78, 22, 'image/jpeg', '2021-02-14_14-51-44_gondola-kop2.jpg', 'gondola-kop2.jpg', '2021-02-14 13:51:44', '2021-02-14 13:51:44'),
(79, 22, 'image/jpeg', '2021-02-14_14-51-44_gondola-kop.jpg', 'gondola-kop.jpg', '2021-02-14 13:51:44', '2021-02-14 13:51:44'),
(80, 23, 'image/jpeg', '2021-02-14_14-53-29_img_140523.jpg', 'img_140523.jpg', '2021-02-14 13:53:29', '2021-02-14 13:53:29'),
(81, 24, 'image/jpeg', '2021-02-14_14-54-54_img_140703.jpg', 'img_140703.jpg', '2021-02-14 13:54:54', '2021-02-14 13:54:54'),
(82, 24, 'image/jpeg', '2021-02-14_14-54-54_img_140700.jpg', 'img_140700.jpg', '2021-02-14 13:54:54', '2021-02-14 13:54:54'),
(83, 24, 'image/jpeg', '2021-02-14_14-54-54_img_140730.jpg', 'img_140730.jpg', '2021-02-14 13:54:54', '2021-02-14 13:54:54'),
(84, 25, 'image/jpeg', '2021-02-14_14-56-54_img_140874.jpg', 'img_140874.jpg', '2021-02-14 13:56:54', '2021-02-14 13:56:54'),
(85, 25, 'image/jpeg', '2021-02-14_14-56-54_img_140877.jpg', 'img_140877.jpg', '2021-02-14 13:56:54', '2021-02-14 13:56:54'),
(86, 25, 'image/jpeg', '2021-02-14_14-56-54_img_140880.jpg', 'img_140880.jpg', '2021-02-14 13:56:54', '2021-02-14 13:56:54'),
(87, 26, 'image/jpeg', '2021-02-15_12-24-25_img_140943.jpg', 'img_140943.jpg', '2021-02-15 11:24:25', '2021-02-15 11:24:25'),
(88, 26, 'image/jpeg', '2021-02-15_12-24-25_img_140940.jpg', 'img_140940.jpg', '2021-02-15 11:24:25', '2021-02-15 11:24:25'),
(89, 27, 'image/jpeg', '2021-02-15_12-26-03_img_140922.jpg', 'img_140922.jpg', '2021-02-15 11:26:03', '2021-02-15 11:26:03'),
(90, 27, 'image/jpeg', '2021-02-15_12-26-03_img_140919.jpg', 'img_140919.jpg', '2021-02-15 11:26:03', '2021-02-15 11:26:03'),
(91, 29, 'image/jpeg', '2021-02-15_14-23-20_41ADE210-AF79-40F0-90CE-616F1AE9DF0A.jpeg', '41ADE210-AF79-40F0-90CE-616F1AE9DF0A.jpeg', '2021-02-15 13:23:20', '2021-02-15 13:23:20'),
(92, 29, 'image/jpeg', '2021-02-15_14-23-20_F8D7BF39-4BBE-409F-839C-CD1C2F69832F.jpeg', 'F8D7BF39-4BBE-409F-839C-CD1C2F69832F.jpeg', '2021-02-15 13:23:20', '2021-02-15 13:23:20'),
(93, 29, 'image/jpeg', '2021-02-15_14-23-20_6A395147-0DEE-4A89-B5BF-6503F4594F95.jpeg', '6A395147-0DEE-4A89-B5BF-6503F4594F95.jpeg', '2021-02-15 13:23:20', '2021-02-15 13:23:20'),
(94, 29, 'image/jpeg', '2021-02-15_14-23-20_E3F8FE0B-8A00-439B-B835-EA4AC88B5E8D.jpeg', 'E3F8FE0B-8A00-439B-B835-EA4AC88B5E8D.jpeg', '2021-02-15 13:23:20', '2021-02-15 13:23:20'),
(95, 29, 'image/jpeg', '2021-02-15_14-23-20_198A3657-6F6C-43D8-B29A-EEE246F32C11.jpeg', '198A3657-6F6C-43D8-B29A-EEE246F32C11.jpeg', '2021-02-15 13:23:20', '2021-02-15 13:23:20'),
(121, 40, 'image/jpeg', '2021-02-18_11-07-59_img_141099.jpg', 'img_141099.jpg', '2021-02-18 10:07:59', '2021-02-18 10:07:59'),
(122, 41, 'image/jpeg', '2021-02-18_11-08-38_img_141117.jpg', 'img_141117.jpg', '2021-02-18 10:08:38', '2021-02-18 10:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3hMUWKsHxGrtG371crcrQllAbRKeAfn1dPJM2rTw', 14, '185.118.171.122', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0.2 Safari/605.1.15', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTktVVzIzNXo1NFhDQmlUSEhrcjEyeHdMSUs0M05LZzhnQUlLMUZxbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly92aWRlby5ncnVsb3ZpYy5ycyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE0O3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkaVhHOG9QbWQ5ci43MFlEelJhYjZCT2Q5TEFQczJIeHBsbUUxSllxOFFDZFg3QVhKMWNMZS4iO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJGlYRzhvUG1kOXIuNzBZRHpSYWI2Qk9kOUxBUHMySHhwbG1FMUpZcThRQ2RYN0FYSjFjTGUuIjt9', 1615307121),
('L7yj4F79ra1u6b9TwlZwALx0YUYZdxd45xSjQCPI', NULL, '212.200.181.162', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0.3 Safari/605.1.15', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoielJhZmJzakdjN1dBMG9hdlBrMFJvamVibGRZVUs4Rk9LSVdnendVQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly92aWRlby5ncnVsb3ZpYy5ycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1615402305),
('PD7IELEX409dV4sO5wWGhapiR8fcCUk4FzIKhHRn', NULL, '87.116.162.72', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia1IwRmIyYXVzYkxKRGR4aTZaS1lmMlJYWmVaeU10dThQSVVYVlhMWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly92aWRlby5ncnVsb3ZpYy5ycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1615401052),
('RGzcs3oUmi02eCDHgzOHVU2X4PP4IJm6PMqnwlcE', 14, '185.118.171.122', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0.2 Safari/605.1.15', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoickprV3F1elMwS2pCbUQ0bDY4aURjT0dBN1ZoUmRTcUVSejF0WXVYRSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vdmlkZW8uZ3J1bG92aWMucnMvdmlkZW9zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTQ7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRpWEc4b1BtZDlyLjcwWUR6UmFiNkJPZDlMQVBzMkh4cGxtRTFKWXE4UUNkWDdBWEoxY0xlLiI7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkaVhHOG9QbWQ5ci43MFlEelJhYjZCT2Q5TEFQczJIeHBsbUUxSllxOFFDZFg3QVhKMWNMZS4iO30=', 1615377709);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Stefan Grulović', 'admin', 'stefan.grulovic@avalarc.com', '2021-02-05 20:14:27', '$2y$10$vKP2mo9Srte2I3NDBrYZcunvlWUKKQV2du.vgtZK4.e3GD5o6zIV6', NULL, NULL, NULL, NULL, NULL, '2021-02-05 20:14:16', '2021-02-05 20:14:27'),
(13, 'Grulović Junk', 'user', 'grulovicjunk@gmail.com', '2021-02-14 18:53:43', '$2y$10$0IydmcIcb6mtJjwal5QVWuNUsE/Uq/o706ms2fOR1EEZH/OrGQkpa', NULL, NULL, NULL, NULL, NULL, '2021-02-14 18:53:34', '2021-03-04 19:55:16'),
(14, 'ET', 'admin', 'edibtahirovic@gmail.com', '2021-02-15 10:07:11', '$2y$10$iXG8oPmd9r.70YDzRab6BOd9LAPs2HxplmE1JYq8QCdX7AXJ1cLe.', NULL, NULL, 'nV6xpmcf8gGNurAclMWACfDquITqmG7FIHNl2WG0wHDKq00RJcoMMTnUH6lJ', NULL, NULL, '2021-02-15 10:06:54', '2021-02-15 10:07:11');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `runtime` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `user_id`, `name`, `description`, `location`, `mime`, `file_name`, `original_file_name`, `runtime`, `created_at`, `updated_at`, `size`) VALUES
(9, 1, 'Najviše zaraženih u Beogradu, slede Vranje i Niš', 'U Srbiji su u proteklom danu potvrđena 1.622 nova slučaja koronavirusa, a najteža situacija i dalje je u Beogradu, gde je registrovano 615 obolelih, što je čak 38 odsto od ukupnog broja. U Kragujevcu je bilo 59 novih slučajeva, Vranju 54, Nišu 51, Kruševcu 48, Novom Sadu 40, Subotici 37, Kraljevu 35, Pančevu 32, Šapcu 23, a u Užicu 22, preneo je RTS. Više vesti o kovidu-19 i posledicama pandemije u zemlji i svetu čitajte na stranici Koronavirus.', 'Beograd, Srbija', 'video/mp4', '2021-02-13_23-40-09_covid.mp4', 'covid.mp4', 123.46, '2021-02-13 22:40:09', '2021-02-13 22:40:09', '13.43 MB'),
(10, 1, 'DELOVAO MI JE KAO SJAJAN AMERIČKI GRAD: Ričard Grenel o Beogradu ima samo reči hvale', 'Nekadašnji specijalni izaslanik predsednika SAD Donalda Trampa za tzv. Kosovo Ričard Grenel o Beogradu ima samo reči hvale, pun je utisaka, a postoji i nešto što mu nedostaje. - Obožavam da boravim u Beogradu. Iako sam pronašao nekoliko omiljenih restorana, još nisam pronašao dobru teretanu - vežbanje mi je važno. Pomišljam da pitam ministra finansija Sinišu Malog za preporuke teretana, jer smo jednom vežbali zajedno u Vašingtonu - otkriva Grenel. Kaže da ima nekoliko prijatelja koji žive duž reke i da je veoma ljubomoran na ono što imaju. Predsednik Vučić ga je, kaže, vodio u obilazak rive brodom i bio je veoma impresioniran. - Beograd mi je delovao kao sjajan američki grad - rekao je on.', 'Beograd, Srbija', 'video/mp4', '2021-02-13_23-40-41_beograd.mp4', 'beograd.mp4', 123.46, '2021-02-13 22:40:41', '2021-02-13 22:40:41', '10.8 MB'),
(11, 1, 'Brnabić: Svečano otvaranje gondole ne utiče na širenje koronavirusa', 'Novoizgrađena gondola koja povezuje Brzeće sa Malim Karamanom na vrhu Kopaonika završena je pet meseci pre roka i to treba proslaviti, izjavila je danas premijerka Ana Brnabić uz napomenu da to neće uticati na promenu situacije u vezi sa virusom korona. Brnabić je to rekla u Brzeću na otvaranju gondole, a odgovarajući na pitanje novinara zašto je odlučila da baš danas otvori gondolu s obzirom da nam predstoje praznici, da je Kopaonik već pun, a da medicinski deo Kriznog štaba očekuje povećanje broja zaraženih i poziva na poštovanje mera i oprez. „Ako ja ne otvorim danas gondolu ne znači da ljudi neće dolaziti. Gondola je završena i treba da je otvorimo, a na neki način će pomoći i da smanjimo gužve“, istakla je premijerka. Brnabić dodaje i da su ljudi nevezano za gondolu već tu i ističe da se niko nije zarazio na skijanju, već u kafićima. U tom smislu, napominje da je povećan inspekcijski nadzor u ugostiteljskim objektima. „Gondola je završena pet meseci pre roka i to treba proslaviti. Ovo neće promeniti ništa u smislu korone“, rekla je Brnabić.', 'Kopaonik, Srbija', 'video/mp4', '2021-02-13_23-41-22_brnabic.mp4', 'brnabic.mp4', 123.46, '2021-02-13 22:41:22', '2021-02-13 22:41:22', '21.67 MB'),
(12, 1, 'Protesti u Srbiji: Manji incidenti u Beogradu, mirno u Novom Sadu, Nišu i ostalim gradovima', 'U gradovima širom Srbije ponovo su održani protesti protiv vlasti, a za razliku od prethodnih dana, sinoć je uglavnom sve proteklo mirno i bez sukoba policije i demonstranata. Deo demonstranata u četvrtak u Beogradu izrazio je spremnost da nastavi protest protiv vlasti u petak, uprkos zabrani okupljanja više od 10 osoba koju je najavila premijerka Srbije Ana Brnabić. Tokom protesta u četvrtak u Beogradu, grupa mladića zapalila je pirotehnička sredstva ispred Skupštine Srbije i pozivala ostale da ustanu sa asfalta i krenu agresivnije u protest, ali to se nije desilo. Mirni protesti održani su i u Nišu, Novom Sadu, Leskovcu, Kraljevu, Boru, Zrenjaninu i Čačku.', 'Beograd, Srbija', 'video/mp4', '2021-02-13_23-41-43_protesti.mp4', 'protesti.mp4', 123.46, '2021-02-13 22:41:43', '2021-02-13 22:41:43', '14.74 MB'),
(13, 1, 'ATP kup dobija novog šampiona, Srbija izgubila od Nemačke', 'Teniska reprezentacija Srbije neće odbraniti trofej na ATP kupu pošto je jutros u Melburnu izgubila od selekcije Nemačke sa 1:2, u odlučujućem meču Grupe A. Odlučujući bod Nemačkoj doneli su Aleksander Zverev i Jan-Lenard Štruf koji su nakon super taj-brejka slavili protiv Novaka Đokovića i Nikole Čačića sa 6:7, 7:5, 7:10. U prvom setu nije bilo brejkova, a Nemci su dobili taj-brejk sa 7:4 i tako stigli do prednosti u ovom duelu. Đoković i Čačić su u drugom setu, zahvaljujući jedinom brejku u 11 gemu, došli do izjednačenja, nakon čega je usledio super taj-brejk. Srpski teniseri su poveli sa 4:2, ali su izgubili narednih šest poena (4:8). Uspeli su da se približe na 7:8, ali ne i da potpuno preokrenu rezultat. Prethodno je, u prvom susretu dana, Dušan Lajović nakon dobijenog prvog seta poražen od Štrufa sa 6:3, 3:6, 4:6, a izjednačenje Srbiji doneo je Djoković koji je preokrenuo protiv Zvereva i slavio sa 6:7 (3:7), 6:2, 7:5. „Bio je to sjajan meč. Obojica smo igrali dobro. On je odlično servirao danas. Uradio je sve što je mogao u poslednjih nekoliko gemova. Bili smo veoma napeti u završnici. Treći set bio je kocka, mogao je da ga dobije bilo koji od nas“, rekao je Đoković posle meča. Nemačka će u polufinalu igraju protiv Rusije, dok će se u drugom polufinalu sastati Italija i Španija.', 'Srbija', 'video/mp4', '2021-02-13_23-42-18_sport.mp4', 'sport.mp4', 123.46, '2021-02-13 22:42:18', '2021-02-13 22:42:18', '12.42 MB'),
(15, 1, 'Vučić učestvovao na zatvorenom onlajn razgovoru sa Kisindžerom', 'Predsednik Srbije Aleksandar Vučić objavio je da je učestvovao na zatvorenom onlajn razgovoru sa bivšim američkim državnim sekretarom Henrijem Kisindžerom, u organizaciji \"Vorld majnds\". „Imao sam izuzetnu čast da učestvujem na ekskluzivnoj zatvorenoj sesiji sa bivšim američkim državnim sekretarom i bivšim savetnikom za nacionalnu bezbednost Henrijem Kisindžerom“, napisao je Vučić na svom instagram profilu, uz haštag „vorld majnds espreso“. „Vorld majnds espreso“ se održava dva puta mesečno i predstavlja kratke, neformalne video razgovore sa odabranim ljudima u svetu. Svi se na te razgovore uključuju iz svojih kancelarija, sastanak traje 30 minuta i snima se, a primenjuju se stroga pravila Četam hausa. Posle Četam haus sastanaka, učesnici ne saopštavaju detalje razgovora.', 'Beograd, Srbija', 'video/mp4', '2021-02-13_23-43-32_vucic.mp4', 'vucic.mp4', 123.46, '2021-02-13 22:43:32', '2021-02-13 22:43:32', '31.96 MB'),
(17, 1, 'Brzece, premijerka Srbije Ana Brnabic prisustvovala pustanju u rad gondole Brzece–Mali karaman na Kopaoniku_pokrivanje', NULL, 'kopaonik', 'video/mp4', '2021-02-14_09-56-01_Brzece,-premijerka-Srbije-Ana-Brnabic-prisustvovala-pustanju-u-rad-gondole-Brzece–Mali-karaman-na-Kopaoniku_pokrivanje_1.mp4', 'Brzece, premijerka Srbije Ana Brnabic prisustvovala pustanju u rad gondole Brzece–Mali karaman na Kopaoniku_pokrivanje_1.mp4', 123.46, '2021-02-14 08:56:01', '2021-02-14 08:56:01', '43.35 MB'),
(23, 1, 'Beograd, premijerka Srbije Ana Brnabic predsedava na sednici Saveta za koordinaciju aktivnosti i mera za rast BDPa_pokrivanje', NULL, 'Beograd', 'video/mp4', '2021-02-14_13-02-34_Beograd,-premijerka-Srbije-Ana-Brnabic-predsedava-na-sednici-Saveta-za-koordinaciju-aktivnosti-i-mera-za-rast-BDPa_pokrivanje.mp4', 'Beograd, premijerka Srbije Ana Brnabic predsedava na sednici Saveta za koordinaciju aktivnosti i mera za rast BDPa_pokrivanje.mp4', 123.46, '2021-02-14 12:02:34', '2021-02-14 12:02:34', '31.33 MB'),
(25, 1, 'Beograd, sednica Vlade Srbije 11.02.2021, pokrivanje.mp4', NULL, 'Beograd', 'video/mp4', '2021-02-14_13-05-05_Beograd,-sednica-Vlade-Srbije-11.02.2021,-pokrivanje.mp4', 'Beograd, sednica Vlade Srbije 11.02.2021, pokrivanje.mp4', 123.46, '2021-02-14 12:05:06', '2021-02-14 12:06:45', '25.57 MB'),
(26, 1, 'Beograd, Ana Brnabic premijerka Srbije, politicki i ekonomski odnosi.mp4', NULL, 'Beograd', 'video/mp4', '2021-02-14_14-26-34_Beograd,-Ana-Brnabic-premijerka-Srbije,-politicki-i-ekonomski-odnosi.mp4', 'Beograd, Ana Brnabic premijerka Srbije, politicki i ekonomski odnosi.mp4', 123.46, '2021-02-14 13:26:34', '2021-02-14 13:26:34', '46.36 MB'),
(27, 1, 'Beograd, premijer Ceske Andrej Babis i premijerka Srbije Ana Brnabic obilaze punktove za vakcinaciju na Beogradskom sajmu_pokrivanje', 'Beograd, premijer Ceske Andrej Babis i premijerka Srbije Ana Brnabic obilaze punktove za vakcinaciju na Beogradskom sajmu pokrivanje', 'Beograd', 'video/mp4', '2021-02-14_14-30-16_Beograd,-premijer-Ceske-Andrej-Babis-i-premijerka-Srbije-Ana-Brnabic-obilaze-punktove-za-vakcinaciju-na-Beogradskom-sajmu_pokrivanje.mp4', 'Beograd, premijer Ceske Andrej Babis i premijerka Srbije Ana Brnabic obilaze punktove za vakcinaciju na Beogradskom sajmu_pokrivanje.mp4', 123.46, '2021-02-14 13:30:16', '2021-02-14 13:30:16', '46.4 MB'),
(28, 1, 'Beograd, dolazak novih vakcina iz Kine na aerodromu Nikola Tesla, pokrivanje', 'Beograd, dolazak novih vakcina iz Kine na aerodromu Nikola Tesla, pokrivanje', 'Beograd', 'video/mp4', '2021-02-14_14-35-30_Beograd,-dolazak-novih-vakcina-iz-Kine-na-aerodromu-Nikola-Tesla,-pokrivanje.mp4', 'Beograd, dolazak novih vakcina iz Kine na aerodromu Nikola Tesla, pokrivanje.mp4', 123.46, '2021-02-14 13:35:30', '2021-02-14 13:35:30', '42.31 MB'),
(29, 1, 'Beograd, Sinisa Mali ministar finansija, po 30 evra punoletnim gradjanima i 110 evra penzionerima', 'Beograd, Sinisa Mali ministar finansija, po 30 evra punoletnim gradjanima i 110 evra penzionerima.', 'Beograd', 'video/mp4', '2021-02-14_14-38-02_Beograd,-Sinisa-Mali-ministar-finansija,-po-30-evra-punoletnim-gradjanima-i-110-evra-penzionerima.mp4', 'Beograd, Sinisa Mali ministar finansija, po 30 evra punoletnim gradjanima i 110 evra penzionerima.mp4', 123.46, '2021-02-14 13:38:02', '2021-02-14 13:38:02', '48.44 MB'),
(30, 1, 'Beograd, Ana Brnabic premijerka Srbije, cekamo odobrenje Fajzera za vakcije Severnoj Makedoniji', 'Beograd, Ana Brnabic premijerka Srbije, cekamo odobrenje Fajzera za vakcije Severnoj Makedoniji', 'Beograd', 'video/mp4', '2021-02-14_14-40-33_Beograd,-Ana-Brnabic-premijerka-Srbije,-cekamo-odobrenje-Fajzera-za-vakcije-Severnoj-Makedoniji.mp4', 'Beograd, Ana Brnabic premijerka Srbije, cekamo odobrenje Fajzera za vakcije Severnoj Makedoniji.mp4', 123.46, '2021-02-14 13:40:33', '2021-02-14 13:40:33', '36.65 MB'),
(37, 1, '87mb testa', '87mb testa', '87mb testa', 'video/mp4', '2021-02-14_20-43-48_Beograd,-sastanak-delegacija-Srbije-i-Rusije-povodom-uspostavljanja-zajednicke-proizvodnje-vakcine-Sputnjik-V-u-Srbiji,-pokrivanje.mp4', 'Beograd, sastanak delegacija Srbije i Rusije povodom uspostavljanja zajednicke proizvodnje vakcine Sputnjik V u Srbiji, pokrivanje.mp4', 123.46, '2021-02-14 19:43:49', '2021-02-14 19:43:49', '82.7 MB'),
(38, 14, 'Beograd, sastanak premijerke Srbije Ane Brnabic i ministra Nenada Popovica sa kopredsednikom Medjuvladinog komiteta za trgovinu, ekonomsku i naucno-tehnicku saradnju izmedju Srbije i Rusije Jurij Borisovim, pokrivanje', 'Beograd, sastanak premijerke Srbije Ane Brnabic i ministra Nenada Popovica sa kopredsednikom Medjuvladinog komiteta za trgovinu, ekonomsku i naucno-tehnicku saradnju izmedju Srbije i Rusije Jurij Borisovim, pokrivanje', 'Beograd', 'video/mp4', '2021-02-15_11-28-25_Beograd,-sastanak-premijerke-Srbije-Ane-Brnabic-i-ministra-Nenada-Popovica-sa-kopredsednikom-Medjuvladinog-komiteta-za-trgovinu,-ekonomsku-i-naucno-tehnicku-saradnju-izmedju-Srbije-i-Rusije-Jurij-Borisovim,-pokrivanje.mp4', 'Beograd, sastanak premijerke Srbije Ane Brnabic i ministra Nenada Popovica sa kopredsednikom Medjuvladinog komiteta za trgovinu, ekonomsku i naucno-tehnicku saradnju izmedju Srbije i Rusije Jurij Borisovim, pokrivanje.mp4', 123.46, '2021-02-15 10:28:25', '2021-02-15 10:28:25', '36.08 MB'),
(39, 14, 'Beograd, pocasna artiljerijska paljba povodom Dana drzavnosti, pokrivanje', 'Beograd, pocasna artiljerijska paljba povodom Dana drzavnosti, pokrivanje', 'Beograd', 'video/mp4', '2021-02-15_12-37-32_Beograd,-pocasna-artiljerijska-paljba-povodom-Dana-drzavnosti,-pokrivanje.mp4', 'Beograd, pocasna artiljerijska paljba povodom Dana drzavnosti, pokrivanje.mp4', 123.46, '2021-02-15 11:37:33', '2021-02-15 11:37:33', '80.83 MB'),
(40, 1, 'file doesnt exist test', 'file doesnt exist test', 'file doesnt exist test', 'video/mp4', '2021-02-15_19-28-34_file_doesnt_exist2.mp4', 'file_doesnt_exist.mp4', 123.46, '2021-02-15 18:28:34', '2021-02-15 18:28:34', '13.43 MB'),
(43, 14, 'Topola, povodom Dana drzavnosti ministarka za rad, zaposljavanje, boracka i socijalna pitanja Darija Кisic Tepavcevic polaze venac na sarkofag vozda Кaradjordja na Oplencu_pokrivanje', 'Topola, povodom Dana drzavnosti ministarka za rad, zaposljavanje, boracka i socijalna pitanja Darija Кisic Tepavcevic polaze venac na sarkofag vozda Кaradjordja na Oplencu_pokrivanje', 'Orasac', 'video/mp4', '2021-02-16_11-30-50_Topola,-povodom-Dana-drzavnosti-ministarka-za-rad,-zaposljavanje,-boracka-i-socijalna-pitanja-Darija-Кisic-Tepavcevic-polaze-venac-na-sarkofag-vozda-Кaradjordja-na-Oplencu_pokrivanje.mp4', 'Topola, povodom Dana drzavnosti ministarka za rad, zaposljavanje, boracka i socijalna pitanja Darija Кisic Tepavcevic polaze venac na sarkofag vozda Кaradjordja na Oplencu_pokrivanje.mp4', 123.46, '2021-02-16 10:30:51', '2021-02-16 10:30:51', '68.78 MB'),
(44, 14, 'Beograd, Ana Brnabic premijerka Srbije, lazi o procesu vakcinacije', 'Beograd, Ana Brnabic premijerka Srbije, lazi o procesu vakcinacije.mp4', 'Beograd', 'video/mp4', '2021-02-16_18-01-03_Beograd,-Ana-Brnabic-premijerka-Srbije,-lazi-o-procesu-vakcinacije.mp4', 'Beograd, Ana Brnabic premijerka Srbije, lazi o procesu vakcinacije.mp4', 123.46, '2021-02-16 17:01:03', '2021-02-16 17:01:03', '94.79 MB'),
(45, 14, 'Beograd, sastanak premijerke Srbije Ane Brnabic sa delegacijom Naucno-tehnoloskog parka Skolokovo iz Moskve koju predvodi predsednik Fondacije Skolkovo Arkadij Dvorkovic_pokrivanje', 'Beograd, sastanak premijerke Srbije Ane Brnabic sa delegacijom Naucno-tehnoloskog parka Skolokovo iz Moskve koju predvodi predsednik Fondacije Skolkovo Arkadij Dvorkovic_pokrivanje.mp4', 'Beograd', 'video/mp4', '2021-02-18_10-05-44_Beograd,-sastanak-premijerke-Srbije-Ane-Brnabic-sa-delegacijom-Naucno-tehnoloskog-parka-Skolokovo-iz-Moskve-koju-predvodi-predsednik-Fondacije-Skolkovo-Arkadij-Dvorkovic_pokrivanje.mp4', 'Beograd, sastanak premijerke Srbije Ane Brnabic sa delegacijom Naucno-tehnoloskog parka Skolokovo iz Moskve koju predvodi predsednik Fondacije Skolkovo Arkadij Dvorkovic_pokrivanje.mp4', 123.46, '2021-02-18 09:05:44', '2021-02-18 09:05:44', '84.27 MB'),
(46, 14, 'Beograd, Ana Brnabic premijerka Srbije, o doniranju vakcina drugim zemljama', 'Beograd, Ana Brnabic premijerka Srbije, o doniranju vakcina drugim zemljama', 'Beograd', 'video/mp4', '2021-02-18_10-10-27_Beograd,-Ana-Brnabic-premijerka-Srbije,-o-doniranju-vakcina-drugim-zemljama.mp4', 'Beograd, Ana Brnabic premijerka Srbije, o doniranju vakcina drugim zemljama.mp4', 123.46, '2021-02-18 09:10:27', '2021-02-18 09:10:27', '86.81 MB'),
(47, 14, 'Beograd, sastanak premijerke Srbije Ane Brnabic sa novim ambasadorom OEBS-a Janom Bratuom_pokrivanje', 'Beograd, sastanak premijerke Srbije Ane Brnabic sa novim ambasadorom OEBS-a Janom Bratuom_pokrivanje.mp4', 'Beograd', 'video/mp4', '2021-02-18_10-11-09_Beograd,-sastanak-premijerke-Srbije-Ane-Brnabic-sa-novim-ambasadorom-OEBS-a-Janom-Bratuom_pokrivanje.mp4', 'Beograd, sastanak premijerke Srbije Ane Brnabic sa novim ambasadorom OEBS-a Janom Bratuom_pokrivanje.mp4', 123.46, '2021-02-18 09:11:09', '2021-02-18 09:11:09', '26.96 MB'),
(48, 14, 'Crna Gora-Podgorica, dolazak prve kolicine vakcine protiv koronavirusa u Crnu Goru, pokrivanje', 'Crna Gora-Podgorica, dolazak prve kolicine vakcine protiv koronavirusa u Crnu Goru, pokrivanje.mp4', 'Crna Gora', 'video/mp4', '2021-02-18_10-20-19_Crna-Gora-Podgorica,-dolazak-prve-kolicine-vakcine-protiv-koronavirusa-u-Crnu-Goru,-pokrivanje.mp4', 'Crna Gora-Podgorica, dolazak prve kolicine vakcine protiv koronavirusa u Crnu Goru, pokrivanje.mp4', 123.46, '2021-02-18 09:20:19', '2021-02-18 09:20:19', '91.44 MB'),
(49, 14, 'Crna Gora-Podgorica, Ana Brnabic premijerka Rebublike Srbije, o donaciji vakcina Crnoj Gori', 'Crna Gora-Podgorica, Ana Brnabic premijerka Rebublike Srbije, o donaciji vakcina Crnoj Gori.mp4', 'Podgorica', 'video/mp4', '2021-02-18_10-35-16_Crna-Gora-Podgorica,-Ana-Brnabic-premijerka-Rebublike-Srbije,-o-donaciji-vakcina-Crnoj-Gori.mp4', 'Crna Gora-Podgorica, Ana Brnabic premijerka Rebublike Srbije, o donaciji vakcina Crnoj Gori.mp4', 123.46, '2021-02-18 09:35:17', '2021-02-18 09:35:17', '93.7 MB'),
(50, 14, 'Beograd, sednica Vlade Srbije 18.02.2021._pokrivanje', 'Beograd, sednica Vlade Srbije 18.02.2021._pokrivanje.mp4', 'Beograd', 'video/mp4', '2021-02-18_14-42-46_Beograd,-sednica-Vlade-Srbije-18.02.2021._pokrivanje.mp4', 'Beograd, sednica Vlade Srbije 18.02.2021._pokrivanje.mp4', 123.46, '2021-02-18 13:42:46', '2021-02-18 13:42:46', '29.16 MB'),
(51, 14, 'Beograd, sastanak premijerke Srbije Ane Brnabic sa ministrom spoljnih poslova Severne Makedonije Bujarom Osmanijem_pokrivanje', 'Beograd, sastanak premijerke Srbije Ane Brnabic sa ministrom spoljnih poslova Severne Makedonije Bujarom Osmanijem_pokrivanje', 'Beograd', 'video/mp4', '2021-02-19_09-49-37_Beograd,-sastanak-premijerke-Srbije-Ane-Brnabic-sa-ministrom-spoljnih-poslova-Severne-Makedonije-Bujarom-Osmanijem_pokrivanje.mp4', 'Beograd, sastanak premijerke Srbije Ane Brnabic sa ministrom spoljnih poslova Severne Makedonije Bujarom Osmanijem_pokrivanje.mp4', 123.46, '2021-02-19 08:49:37', '2021-02-19 08:49:37', '27.46 MB'),
(52, 14, 'Beograd, sastanak premijerke Ane Brnabic sa ambasadorom Svajcarske Ursom Smidom_pokrivanje', 'Beograd, sastanak premijerke Ane Brnabic sa ambasadorom Svajcarske Ursom Smidom_pokrivanje', 'Beograd', 'video/mp4', '2021-02-19_09-50-22_Beograd,-sastanak-premijerke-Ane-Brnabic-sa-ambasadorom-Svajcarske-Ursom-Smidom_pokrivanje.mp4', 'Beograd, sastanak premijerke Ane Brnabic sa ambasadorom Svajcarske Ursom Smidom_pokrivanje.mp4', 123.46, '2021-02-19 08:50:22', '2021-02-19 08:50:22', '29.36 MB'),
(53, 14, 'Beograd, sastanak premijerke Ane Brnabic sa predstavnicima Krovne organizacije mladih Srbije', 'Beograd, sastanak premijerke Ane Brnabic sa predstavnicima Krovne organizacije mladih Srbije', 'Beograd', 'video/mp4', '2021-02-20_08-41-51_Beograd,-sastanak-premijerke-Ane-Brnabic-sa-predstavnicima-Krovne-organizacije-mladih-Srbije.mp4', 'Beograd, sastanak premijerke Ane Brnabic sa predstavnicima Krovne organizacije mladih Srbije.mp4', 123.46, '2021-02-20 07:41:51', '2021-02-20 07:41:51', '53.69 MB'),
(54, 14, 'Sabac, Darija Kisic Tepavcevic ministarka za rad, zaposljavanje boracka i socijalna pitanja, o relaksaciji mera u gerentoloskim centrima', 'Sabac, Darija Kisic Tepavcevic ministarka za rad, zaposljavanje boracka i socijalna pitanja, o relaksaciji mera u gerentoloskim centrima.mp4', 'Sabac', 'video/mp4', '2021-02-21_13-02-01_Sabac,-Darija-Kisic-Tepavcevic-ministarka-za-rad,-zaposljavanje-boracka-i-socijalna-pitanja,-o-relaksaciji-mera-u-gerentoloskim-centrima.mp4', 'Sabac, Darija Kisic Tepavcevic ministarka za rad, zaposljavanje boracka i socijalna pitanja, o relaksaciji mera u gerentoloskim centrima.mp4', 123.46, '2021-02-21 12:02:02', '2021-02-21 12:02:02', '95.95 MB'),
(55, 14, 'UAE, Abu Dabi, sastanak ministra odbrane Nebojsa Stefanovica sa pomocnikom ministra odbrane Spanije admiralom Santijagom Ramon Gonzales Gomezom_pokrivanje', 'UAE, Abu Dabi, sastanak ministra odbrane Nebojsa Stefanovica sa pomocnikom ministra odbrane Spanije admiralom Santijagom Ramon Gonzales Gomezom_pokrivanje', 'UAE', 'video/mp4', '2021-02-22_11-21-06_UAE,-Abu-Dabi,-sastanak-ministra-odbrane-Nebojsa-Stefanovica-sa-pomocnikom-ministra-odbrane-Spanije-admiralom-Santijagom-Ramon-Gonzales-Gomezom_pokrivanje.mp4', 'UAE, Abu Dabi, sastanak ministra odbrane Nebojsa Stefanovica sa pomocnikom ministra odbrane Spanije admiralom Santijagom Ramon Gonzales Gomezom_pokrivanje.mp4', 123.46, '2021-02-22 10:21:06', '2021-02-22 10:21:06', '29.56 MB'),
(56, 14, 'UAE, Abu Dabi, sastanak ministra odbrane Nebojsa Stefanovica sa pomocnikom ministra odbrane Spanije admiralom Santijagom Ramon Gonzales Gomezom_pokrivanje', 'UAE, Abu Dabi, sastanak ministra odbrane Nebojsa Stefanovica sa pomocnikom ministra odbrane Spanije admiralom Santijagom Ramon Gonzales Gomezom_pokrivanje', 'Abu Dabi', 'video/mp4', '2021-02-22_11-21-48_UAE,-Abu-Dabi,-sastanak-ministra-odbrane-Nebojse-Stefanovica-sa-ministrom-odbranbene-industrije-Azerbejdzana-generalom-Madatom-Kulijevim_pokrivanje.mp4', 'UAE, Abu Dabi, sastanak ministra odbrane Nebojse Stefanovica sa ministrom odbranbene industrije Azerbejdzana generalom Madatom Kulijevim_pokrivanje.mp4', 123.46, '2021-02-22 10:21:48', '2021-02-22 10:21:48', '21.87 MB'),
(57, 14, 'Beograd, sednica Kriznog staba 24.02.2021._pokrivanje', 'Beograd, sednica Kriznog staba 24.02.2021._pokrivanje', 'Beograd', 'video/mp4', '2021-02-24_10-04-24_Beograd,-sednica-Kriznog-staba-24.02.2021._pokrivanje.mp4', 'Beograd, sednica Kriznog staba 24.02.2021._pokrivanje.mp4', 123.46, '2021-02-24 09:04:24', '2021-02-24 09:04:24', '38.34 MB'),
(58, 14, 'Loznica, Maja Popovic ministarka pravde, formirana je komisija za preispitivanje okolnosti slucaja nedavne saobracajne nesrece.mp4', 'Loznica, Maja Popovic ministarka pravde, formirana je komisija za preispitivanje okolnosti slucaja nedavne saobracajne nesrece', 'Loznica', 'video/mp4', '2021-02-27_11-20-23_Loznica,-Maja-Popovic-ministarka-pravde,-formirana-je-komisija-za-preispitivanje-okolnosti-slucaja-nedavne-saobracajne-nesrece.mp4', 'Loznica, Maja Popovic ministarka pravde, formirana je komisija za preispitivanje okolnosti slucaja nedavne saobracajne nesrece.mp4', 123.46, '2021-02-27 10:20:24', '2021-02-27 10:20:24', '91.77 MB'),
(59, 14, 'Beograd, sastanak premijerke Ane Brnabic sa ambasadorom Turske Tanzua Bilgicem, pokrivanje', 'Beograd, sastanak premijerke Ane Brnabic sa ambasadorom Turske Tanzua Bilgicem, pokrivanje', 'Beograd', 'video/mp4', '2021-02-27_11-21-26_Beograd,-sastanak-premijerke-Ane-Brnabic-sa-ambasadorom-Turske-Tanzua-Bilgicem,-pokrivanje.mp4', 'Beograd, sastanak premijerke Ane Brnabic sa ambasadorom Turske Tanzua Bilgicem, pokrivanje.mp4', 123.46, '2021-02-27 10:21:26', '2021-02-27 10:21:26', '30.18 MB'),
(60, 14, 'Beograd, sastanak premijerke Ane Brnabic sa ambasadorkom Estonije Kristi Karelson_pokrivanje', 'Beograd, sastanak premijerke Ane Brnabic sa ambasadorkom Estonije Kristi Karelson_pokrivanje', 'Beograd', 'video/mp4', '2021-03-01_10-57-12_Beograd,-sastanak-premijerke-Ane-Brnabic-sa-ambasadorkom-Estonije-Kristi-Karelson_pokrivanje.mp4', 'Beograd, sastanak premijerke Ane Brnabic sa ambasadorkom Estonije Kristi Karelson_pokrivanje.mp4', 123.46, '2021-03-01 09:57:12', '2021-03-01 09:57:12', '33.86 MB'),
(61, 14, 'Beograd, sastanak premijerke Ane Brnabic sa ambasadorom Kipra Dimitriosom Teofilaktuom, pokrivanje', 'Beograd, sastanak premijerke Ane Brnabic sa ambasadorom Kipra Dimitriosom Teofilaktuom, pokrivanje', 'Beograd', 'video/mp4', '2021-03-03_10-58-09_Beograd,-sastanak-premijerke-Ane-Brnabic-sa-ambasadorom-Kipra-Dimitriosom-Teofilaktuom,-pokrivanje.mp4', 'Beograd, sastanak premijerke Ane Brnabic sa ambasadorom Kipra Dimitriosom Teofilaktuom, pokrivanje.mp4', 123.46, '2021-03-03 09:58:10', '2021-03-03 09:58:10', '51.73 MB'),
(62, 14, 'Beograd, sastanak premijerke Ane Brnabic sa specijalnim predstavnikom EU za dijalog Beograda i Pristine Miroslavom Lajcakom_pokrivanje', 'Beograd, sastanak premijerke Ane Brnabic sa specijalnim predstavnikom EU za dijalog Beograda i Pristine Miroslavom Lajcakom_pokrivanje', 'Beograd', 'video/mp4', '2021-03-04_11-01-32_Beograd,-sastanak-premijerke-Ane-Brnabic-sa-specijalnim-predstavnikom-EU-za-dijalog-Beograda-i-Pristine-Miroslavom-Lajcakom_pokrivanje.mp4', 'Beograd, sastanak premijerke Ane Brnabic sa specijalnim predstavnikom EU za dijalog Beograda i Pristine Miroslavom Lajcakom_pokrivanje.mp4', 123.46, '2021-03-04 10:01:32', '2021-03-04 19:29:01', '23.75 MB'),
(63, 14, 'Arandjelovac, Bukulja,  premijerka Srbije Ana Brnabic obilazi gazdinstvo porodice Jagodic u selu Stojnik_pokrivanje', 'Arandjelovac, Bukulja,  premijerka Srbije Ana Brnabic obilazi gazdinstvo porodice Jagodic u selu Stojnik_pokrivanje', 'Arandjelovac, Bukulja', 'video/mp4', '2021-03-09_09-00-57_Arandjelovac,-Bukulja,--premijerka-Srbije-Ana-Brnabic-obilazi-gazdinstvo-porodice-Jagodic-u-selu-Stojnik_pokrivanje.mp4', 'Arandjelovac, Bukulja,  premijerka Srbije Ana Brnabic obilazi gazdinstvo porodice Jagodic u selu Stojnik_pokrivanje.mp4', 123.46, '2021-03-09 08:00:58', '2021-03-09 08:00:58', '95.07 MB'),
(64, 14, 'Bukulja, Ana Brnabic premijerka Srbije, strateski pristup investicije u poljoprivredi', 'Bukulja, Ana Brnabic premijerka Srbije, strateski pristup investicije u poljoprivredi', 'Arandjelovac, Bukulja', 'video/mp4', '2021-03-09_09-02-03_Bukulja,-Ana-Brnabic-premijerka-Srbije,-strateski-pristup-investicije-u-poljoprivredi.mp4', 'Bukulja, Ana Brnabic premijerka Srbije, strateski pristup investicije u poljoprivredi.mp4', 123.46, '2021-03-09 08:02:03', '2021-03-09 08:02:03', '85.39 MB'),
(65, 14, 'Beograd, ministarka za rad, zaposljavanje, boracka i socijalna pitanja Darija Kisic Tepavcevic razgovarala sa zenema borcima ratova 90-tih povodom Dana zena_pokrivanje', 'Beograd, ministarka za rad, zaposljavanje, boracka i socijalna pitanja Darija Kisic Tepavcevic razgovarala sa zenema borcima ratova 90-tih povodom Dana zena_pokrivanje', 'Beograd', 'video/mp4', '2021-03-09_09-30-15_Beograd,-ministarka-za-rad,-zaposljavanje,-boracka-i-socijalna-pitanja-Darija-Kisic-Tepavcevic-razgovarala-sa-zenema-borcima-ratova-90-tih-povodom-Dana-zena_pokrivanje.mp4', 'Beograd, ministarka za rad, zaposljavanje, boracka i socijalna pitanja Darija Kisic Tepavcevic razgovarala sa zenema borcima ratova 90-tih povodom Dana zena_pokrivanje.mp4', 123.46, '2021-03-09 08:30:15', '2021-03-09 08:30:15', '87.8 MB'),
(66, 14, 'Beograd, Darija Kisic Tepavcevic ministarka za rad,zaposljavanje, boracka i socijalna pitanja, vi ste simbol Srbije', 'Beograd, Darija Kisic Tepavcevic ministarka za rad,zaposljavanje, boracka i socijalna pitanja, vi ste simbol Srbije', 'Beograd', 'video/mp4', '2021-03-09_09-32-06_Beograd,-Darija-Kisic-Tepavcevic-ministarka-za-rad,zaposljavanje,-boracka-i-socijalna-pitanja,-vi-ste-simbol-Srbije.mp4', 'Beograd, Darija Kisic Tepavcevic ministarka za rad,zaposljavanje, boracka i socijalna pitanja, vi ste simbol Srbije.mp4', 123.46, '2021-03-09 08:32:06', '2021-03-09 08:32:06', '53.08 MB'),
(68, 14, 'Beograd, dijalog o predlogu Nacrta zakona o istopolnim zajednicama koji organizuje Ministarstvo za ljudska i manjinska prava i drustveni dijalog_pokrivanje', 'Beograd, dijalog o predlogu Nacrta zakona o istopolnim zajednicama koji organizuje Ministarstvo za ljudska i manjinska prava i drustveni dijalog_pokrivanje', 'Beograd', 'video/mp4', '2021-03-10_12-00-35_Beograd,-dijalog-o-predlogu-Nacrta-zakona-o-istopolnim-zajednicama-koji-organizuje-Ministarstvo-za-ljudska-i-manjinska-prava-i-drustveni-dijalog_pokrivanje.mp4', 'Beograd, dijalog o predlogu Nacrta zakona o istopolnim zajednicama koji organizuje Ministarstvo za ljudska i manjinska prava i drustveni dijalog_pokrivanje.mp4', 123.46, '2021-03-10 11:00:36', '2021-03-10 11:00:36', '73.78 MB');

-- --------------------------------------------------------

--
-- Table structure for table `video_categories`
--

CREATE TABLE `video_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_categories`
--

INSERT INTO `video_categories` (`id`, `video_id`, `category_id`, `created_at`, `updated_at`) VALUES
(20, 0, 0, NULL, NULL),
(24, 9, 14, '2021-02-13 22:40:09', '2021-02-13 22:40:09'),
(25, 9, 16, '2021-02-13 22:40:09', '2021-02-13 22:40:09'),
(26, 10, 14, '2021-02-13 22:40:41', '2021-02-13 22:40:41'),
(27, 10, 11, '2021-02-13 22:40:41', '2021-02-13 22:40:41'),
(28, 10, 13, '2021-02-13 22:40:41', '2021-02-13 22:40:41'),
(29, 11, 15, '2021-02-13 22:41:22', '2021-02-13 22:41:22'),
(30, 11, 16, '2021-02-13 22:41:22', '2021-02-13 22:41:22'),
(31, 12, 14, '2021-02-13 22:41:43', '2021-02-13 22:41:43'),
(32, 12, 6, '2021-02-13 22:41:43', '2021-02-13 22:41:43'),
(33, 12, 18, '2021-02-13 22:41:43', '2021-02-13 22:41:43'),
(34, 13, 9, '2021-02-13 22:42:18', '2021-02-13 22:42:18'),
(35, 13, 17, '2021-02-13 22:42:18', '2021-02-13 22:42:18'),
(36, 13, 13, '2021-02-13 22:42:18', '2021-02-13 22:42:18'),
(37, 15, 14, '2021-02-13 22:43:32', '2021-02-13 22:43:32'),
(38, 15, 6, '2021-02-13 22:43:32', '2021-02-13 22:43:32'),
(39, 15, 19, '2021-02-13 22:43:32', '2021-02-13 22:43:32'),
(40, 16, 11, '2021-02-14 08:55:12', '2021-02-14 08:55:12'),
(41, 16, 13, '2021-02-14 08:55:12', '2021-02-14 08:55:12'),
(42, 17, 15, '2021-02-14 08:56:01', '2021-02-14 08:56:01'),
(43, 18, 14, '2021-02-14 09:08:09', '2021-02-14 09:08:09'),
(44, 20, 14, '2021-02-14 09:13:48', '2021-02-14 09:13:48'),
(45, 20, 15, '2021-02-14 09:13:48', '2021-02-14 09:13:48'),
(46, 21, 14, '2021-02-14 09:26:11', '2021-02-14 09:26:11'),
(47, 21, 15, '2021-02-14 09:26:11', '2021-02-14 09:26:11'),
(51, 23, 15, '2021-02-14 12:02:34', '2021-02-14 12:02:34'),
(53, 26, 15, '2021-02-14 13:26:34', '2021-02-14 13:26:34'),
(54, 27, 15, '2021-02-14 13:30:16', '2021-02-14 13:30:16'),
(55, 28, 15, '2021-02-14 13:35:30', '2021-02-14 13:35:30'),
(56, 29, 1, '2021-02-14 13:38:02', '2021-02-14 13:38:02'),
(57, 30, 15, '2021-02-14 13:40:33', '2021-02-14 13:40:33'),
(58, 37, 15, '2021-02-14 19:43:49', '2021-02-14 19:43:49'),
(59, 38, 15, '2021-02-15 10:28:25', '2021-02-15 10:28:25'),
(60, 39, 14, '2021-02-15 11:37:33', '2021-02-15 11:37:33'),
(63, 44, 15, '2021-02-16 17:01:03', '2021-02-16 17:01:03'),
(64, 45, 15, '2021-02-18 09:05:44', '2021-02-18 09:05:44'),
(65, 46, 15, '2021-02-18 09:10:27', '2021-02-18 09:10:27'),
(66, 47, 15, '2021-02-18 09:11:09', '2021-02-18 09:11:09'),
(67, 48, 15, '2021-02-18 09:20:19', '2021-02-18 09:20:19'),
(68, 49, 15, '2021-02-18 09:35:17', '2021-02-18 09:35:17'),
(69, 50, 15, '2021-02-18 13:42:46', '2021-02-18 13:42:46'),
(70, 51, 15, '2021-02-19 08:49:37', '2021-02-19 08:49:37'),
(71, 52, 15, '2021-02-19 08:50:22', '2021-02-19 08:50:22'),
(72, 53, 15, '2021-02-20 07:41:51', '2021-02-20 07:41:51'),
(73, 54, 17, '2021-02-21 12:02:02', '2021-02-21 12:02:02'),
(74, 55, 17, '2021-02-22 10:21:06', '2021-02-22 10:21:06'),
(75, 56, 17, '2021-02-22 10:21:48', '2021-02-22 10:21:48'),
(76, 57, 14, '2021-02-24 09:04:24', '2021-02-24 09:04:24'),
(77, 58, 17, '2021-02-27 10:20:24', '2021-02-27 10:20:24'),
(78, 59, 15, '2021-02-27 10:21:26', '2021-02-27 10:21:26'),
(79, 60, 15, '2021-03-01 09:57:12', '2021-03-01 09:57:12'),
(80, 61, 12, '2021-03-03 09:58:10', '2021-03-03 09:58:10'),
(82, 63, 15, '2021-03-09 08:00:58', '2021-03-09 08:00:58'),
(83, 64, 15, '2021-03-09 08:02:03', '2021-03-09 08:02:03'),
(84, 65, 17, '2021-03-09 08:30:15', '2021-03-09 08:30:15'),
(85, 66, 17, '2021-03-09 08:32:06', '2021-03-09 08:32:06'),
(87, 68, 17, '2021-03-10 11:00:36', '2021-03-10 11:00:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lives`
--
ALTER TABLE `lives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `photos_file_name_unique` (`file_name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `videos_file_name_unique` (`file_name`);

--
-- Indexes for table `video_categories`
--
ALTER TABLE `video_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `lives`
--
ALTER TABLE `lives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `video_categories`
--
ALTER TABLE `video_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
