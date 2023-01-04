-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 02. Jan 2023 um 20:29
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cms`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `block`
--

CREATE TABLE `block` (
  `ID` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `block`
--

INSERT INTO `block` (`ID`, `title`, `name`) VALUES
(28, 'Kontaktformular', 'kontaktformular'),
(42, 'Gallerie', 'gallerie'),
(43, 'Hintergrundbild', 'hintergrundbild'),
(44, 'Text', 'text'),
(45, 'Map & Kontakt Infos', 'map'),
(48, 'Text Vertical', 'text-vertical'),
(50, 'Home Header', 'home-header'),
(51, 'Team', 'team'),
(54, 'Text Links & Bild Rechts', 'text-bild-rechts'),
(55, 'Gallerie Links & Text Rechts', 'text-gallerie-links');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blockhasfield`
--

CREATE TABLE `blockhasfield` (
  `ID` int(11) NOT NULL,
  `block` int(11) NOT NULL,
  `field` int(11) NOT NULL,
  `fieldtype` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `blockhasfield`
--

INSERT INTO `blockhasfield` (`ID`, `block`, `field`, `fieldtype`, `position`) VALUES
(64, 28, 38, 'text_simple', 1),
(65, 28, 17, 'text_area', 2),
(87, 42, 55, 'text_simple', 1),
(88, 42, 3, 'gallery', 2),
(89, 43, 13, 'image', 1),
(90, 44, 56, 'text_simple', 1),
(91, 44, 23, 'text_area', 2),
(92, 45, 57, 'text_simple', 1),
(108, 48, 64, 'text_simple', 1),
(109, 48, 30, 'text_area', 2),
(111, 50, 66, 'text_simple', 1),
(112, 50, 67, 'text_simple', 2),
(113, 50, 4, 'gallery', 3),
(114, 51, 31, 'text_area', 1),
(115, 51, 32, 'text_area', 2),
(116, 51, 33, 'text_area', 3),
(117, 51, 34, 'text_area', 4),
(118, 51, 5, 'gallery', 5),
(147, 54, 76, 'text_simple', 1),
(148, 54, 47, 'text_area', 2),
(149, 54, 25, 'image', 3),
(150, 55, 77, 'text_simple', 1),
(151, 55, 6, 'gallery', 2),
(152, 55, 48, 'text_area', 3),
(153, 55, 49, 'text_area', 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blockhasspecialfield`
--

CREATE TABLE `blockhasspecialfield` (
  `ID` int(11) NOT NULL,
  `block` int(11) NOT NULL,
  `specialfield` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `cname` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `custom_fields`
--

CREATE TABLE `custom_fields` (
  `ID` int(11) NOT NULL,
  `title` varchar(2000) NOT NULL,
  `data` varchar(500) NOT NULL,
  `fieldtype` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `custom_fields`
--

INSERT INTO `custom_fields` (`ID`, `title`, `data`, `fieldtype`) VALUES
(1, 'Seitentitel', 'CMS Template', 'text_simple'),
(2, 'Adresse', 'Musterstrasse 69<br>\r\n1234 Musterort', 'text_area'),
(3, 'Telefon', '+41 12 345 67 89', 'text_simple'),
(4, 'Öffnungszeiten', 'Montag & Sonntag<br>\r\nGeschlossen<br>\r\nDienstag - Freitag<br>\r\n08:00-18:30 Uhr<br>\r\nSamstag<br>\r\n08:00-15:00 Uhr', 'text_area'),
(5, 'E-Mail', 'info@cms.ch', 'text_simple');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `d_gallery`
--

CREATE TABLE `d_gallery` (
  `ID` int(11) NOT NULL,
  `data` varchar(128) NOT NULL,
  `pagehasblock` int(11) NOT NULL,
  `field` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `d_gallery`
--

INSERT INTO `d_gallery` (`ID`, `data`, `pagehasblock`, `field`) VALUES
(1234, 'A7R03004.jpg', 642, 3),
(1235, 'A7R03083.jpg', 642, 3),
(1236, 'A7R03264.jpg', 642, 3),
(1237, 'A7R03421.jpg', 642, 3),
(1238, 'A7R03712.jpg', 642, 3),
(1239, 'A7R03911.jpg', 642, 3),
(1534, 'A7R02647.jpg', 669, 4),
(1535, 'A7R02701.jpg', 669, 4),
(1536, 'A7R02731.jpg', 669, 4),
(1537, 'A7R03132.jpg', 685, 3),
(1538, 'A7R03134.jpg', 685, 3),
(1539, 'A7R03145.jpg', 685, 3),
(1540, 'A7R03764.jpg', 688, 6),
(1541, 'A7R03767.jpg', 688, 6),
(1542, 'A7R03769.jpg', 688, 6);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `d_image`
--

CREATE TABLE `d_image` (
  `ID` int(11) NOT NULL,
  `data` varchar(128) NOT NULL,
  `pagehasblock` int(11) NOT NULL,
  `field` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `d_image`
--

INSERT INTO `d_image` (`ID`, `data`, `pagehasblock`, `field`) VALUES
(46, 'A7R03013.jpg', 686, 13),
(47, 'A7R03275.jpg', 687, 25);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `d_text_area`
--

CREATE TABLE `d_text_area` (
  `ID` int(11) NOT NULL,
  `data` longtext NOT NULL,
  `pagehasblock` int(11) NOT NULL,
  `field` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `d_text_area`
--

INSERT INTO `d_text_area` (`ID`, `data`, `pagehasblock`, `field`) VALUES
(41, 'Elisabeth Hartmann\r\n\r\nRütihofstr.83\r\n\r\n8400 Winterthur\r\n\r\nInstagram: Unikum bylizhartmann', 617, 17),
(49, 'Elisabeth Hartmann\r\n\r\nRütihofstr.83\r\n\r\n8400 Winterthur\r\n\r\nInstagram: Unikum bylizhartmann ', 630, 17),
(53, 'Instagram: <a href=\"www.google.ch\">Link</a>\r\nLorem ipsum dolor sit amet, consetetur sadipscing elitr.', 634, 17),
(63, 'Instagram: <a href=\"www.google.ch\">Link</a>\r\nLorem ipsum dolor sit amet, consetetur sadipscing elitr.', 650, 17),
(78, '<h3>Kontaktadresse</h3>\r\nCoiffeur Stile Angela\r\nSt. Jakokobsstrasse 28\r\n4132 Muttenz\r\nSchweiz\r\n<a href=\"info@coiffeur-stile-angela.ch\">info@coiffeur-stile-angela.ch</a>\r\n\r\n<h3>Handelsregistereintrag</h3>\r\nMWST Nr.\r\n\r\n<h3>Haftungsausschluss</h3>\r\nDer Autor übernimmt keinerlei Gewähr hinsichtlich der inhaltlichen Richtigkeit, Genauigkeit, Aktualität, Zuverlässigkeit und Vollständigkeit der Informationen.\r\nHaftungsansprüche gegen den Autor wegen Schäden materieller oder immaterieller Art, welche aus dem Zugriff oder der Nutzung bzw. Nichtnutzung der veröffentlichten Informationen, durch Missbrauch der Verbindung oder durch technische Störungen entstanden sind, werden ausgeschlossen.\r\nAlle Angebote sind unverbindlich. Der Autor behält es sich ausdrücklich vor, Teile der Seiten oder das gesamte Angebot ohne gesonderte Ankündigung zu verändern, zu ergänzen, zu löschen oder die Veröffentlichung zeitweise oder endgültig einzustellen.\r\n\r\n<h3>Haftung für Links</h3>\r\nVerweise und Links auf Webseiten Dritter liegen ausserhalb unseres Verantwortungsbereichs Es wird jegliche Verantwortung für solche Webseiten abgelehnt. Der Zugriff und die Nutzung solcher Webseiten erfolgen auf eigene Gefahr des Nutzers oder der Nutzerin.\r\n\r\n<h3>Urheberrechte</h3>\r\nDie Urheber- und alle anderen Rechte an Inhalten, Bildern, Fotos oder anderen Dateien auf der Website gehören ausschliesslich der Firma Coiffeur Stile Angela oder den speziell genannten Rechtsinhabern. Für die Reproduktion jeglicher Elemente ist die schriftliche Zustimmung der Urheberrechtsträger im Voraus einzuholen.\r\n\r\n<h3>Datenschutz</h3>\r\nGestützt auf Artikel 13 der schweizerischen Bundesverfassung und die datenschutzrechtlichen Bestimmungen des Bundes (Datenschutzgesetz, DSG) hat jede Person Anspruch auf Schutz ihrer Privatsphäre sowie auf Schutz vor Missbrauch ihrer persönlichen Daten. Wir halten diese Bestimmungen ein. Persönliche Daten werden streng vertraulich behandelt und weder an Dritte verkauft noch weiter gegeben.\r\nIn enger Zusammenarbeit mit unseren Hosting-Providern bemühen wir uns, die Datenbanken so gut wie möglich vor fremden Zugriffen, Verlusten, Missbrauch oder vor Fälschung zu schützen.\r\nBeim Zugriff auf unsere Webseiten werden folgende Daten in Logfiles gespeichert: IP-Adresse, Datum, Uhrzeit, Browser-Anfrage und allg. übertragene Informationen zum Betriebssystem resp. Browser. Diese Nutzungsdaten bilden die Basis für statistische, anonyme Auswertungen, so dass Trends erkennbar sind, anhand derer wir unsere Angebote entsprechend verbessern können.\r\n\r\n<h3>Datenschutzerklärung für die Nutzung von Facebook-Plugins (Like-Button)</h3>\r\nAuf unseren Seiten sind Plugins des sozialen Netzwerks Facebook, 1601 South California Avenue, Palo Alto, CA 94304, USA integriert. Die Facebook-Plugins erkennen Sie an dem Facebook-Logo oder dem \"Like-Button\" (\"Gefällt mir\") auf unserer Seite. Eine Übersicht über die Facebook-Plugins finden Sie hier: http://developers.facebook.com/docs/plugins/.\r\nWenn Sie unsere Seiten besuchen, wird über das Plugin eine direkte Verbindung zwischen Ihrem Browser und dem Facebook-Server hergestellt. Facebook erhält dadurch die Information, dass Sie mit Ihrer IP-Adresse unsere Seite besucht haben. Wenn Sie den Facebook \"Like-Button\" anklickenwährend Sie in Ihrem Facebook-Account eingeloggt sind, können Sie die Inhalte unserer Seiten auf Ihrem Facebook-Profil verlinken. Dadurch kann Facebook den Besuch unserer Seiten Ihrem Benutzerkonto zuordnen. Wir weisen darauf hin, dass wir als Anbieter der Seiten keine Kenntnis vom Inhalt der übermittelten Daten sowie deren Nutzung durch Facebook erhalten. Weitere Informationen hierzu finden Sie in der Datenschutzerklärung von facebook unter https://www.facebook.com/about/privacy/\r\nWenn Sie nicht wünschen, dass Facebook den Besuch unserer Seiten Ihrem Facebook-Nutzerkonto zuordnen kann, loggen Sie sich bitte aus Ihrem Facebook-Benutzerkonto aus.\r\n\r\n<h3>Datenschutzerklärung für die Nutzung von Twitter</h3>\r\nAuf unseren Seiten sind Funktionen des Dienstes Twitter eingebunden. Diese Funktionen werden angeboten durch die Twitter Inc., 795 Folsom St., Suite 600, San Francisco, CA 94107, USA. Durch das Benutzen von Twitter und der Funktion \"Re-Tweet\" werden die von Ihnen besuchten Webseiten mit Ihrem Twitter-Account verknüpft und anderen Nutzern bekannt gegeben. Dabei werden u.a. Daten wie IP-Adresse, Browsertyp, aufgerufene Domains, besuchte Seiten, Mobilfunkanbieter, Geräte- und Applikations-IDs und Suchbegriffe an Twitter übertragen.\r\nWir weisen darauf hin, dass wir als Anbieter der Seiten keine Kenntnis vom Inhalt der übermittelten Daten sowie deren Nutzung durch Twitter erhalten. Aufgrund laufender Aktualisierung der Datenschutzerklärung von Twitter, weisen wir auf die aktuellste Version unter (http://twitter.com/privacy) hin.\r\nIhre Datenschutzeinstellungen bei Twitter können Sie in den Konto-Einstellungen unter http://twitter.com/account/settings ändern. Bei Fragen wenden Sie sich an privacy@twitter.com.\r\n\r\n<h3>Datenschutzerklärung für die Nutzung von Google Adsense</h3>\r\nDiese Website benutzt Google AdSense, einen Dienst zum Einbinden von Werbeanzeigen der Google Inc. (\"Google\"). Google AdSense verwendet sog. \"Cookies\", Textdateien, die auf Ihrem Computer gespeichert werden und die eine Analyse der Benutzung der Website ermöglicht. Google AdSense verwendet auch so genannte Web Beacons (unsichtbare Grafiken). Durch diese Web Beacons können Informationen wie der Besucherverkehr auf diesen Seiten ausgewertet werden.\r\nDie durch Cookies und Web Beacons erzeugten Informationen über die Benutzung dieser Website (einschließlich Ihrer IP-Adresse) und Auslieferung von Werbeformaten werden an einen Server von Google in den USA übertragen und dort gespeichert. Diese Informationen können von Google an Vertragspartner von Google weiter gegeben werden. Google wird Ihre IP-Adresse jedoch nicht mit anderen von Ihnen gespeicherten Daten zusammenführen.\r\nSie können die Installation der Cookies durch eine entsprechende Einstellung Ihrer Browser Software verhindern; wir weisen Sie jedoch darauf hin, dass Sie in diesem Fall gegebenenfalls nicht sämtliche Funktionen dieser Website voll umfänglich nutzen können. Durch die Nutzung dieserWebsite erklären Sie sich mit der Bearbeitung der über Sie erhobenen Daten durch Google in der zuvor beschriebenen Art und Weise und zu dem zuvor benannten Zweck einverstanden.\r\n\r\n<h3>Datenschutzerklärung für die Nutzung von Twitter</h3>\r\nAuf unseren Seiten sind Funktionen des Dienstes Twitter eingebunden. Diese Funktionen werden angeboten durch die Twitter Inc., 795 Folsom St., Suite 600, San Francisco, CA 94107, USA. Durch das Benutzen von Twitter und der Funktion \"Re-Tweet\" werden die von Ihnen besuchten Webseiten mit Ihrem Twitter-Account verknüpft und anderen Nutzern bekannt gegeben. Dabei werden u.a. Daten wie IP-Adresse, Browsertyp, aufgerufene Domains, besuchte Seiten, Mobilfunkanbieter, Geräte- und Applikations-IDs und Suchbegriffe an Twitter übertragen.\r\nWir weisen darauf hin, dass wir als Anbieter der Seiten keine Kenntnis vom Inhalt der übermittelten Daten sowie deren Nutzung durch Twitter erhalten. Aufgrund laufender Aktualisierung der Datenschutzerklärung von Twitter, weisen wir auf die aktuellste Version unter (http://twitter.com/privacy) hin.\r\nIhre Datenschutzeinstellungen bei Twitter können Sie in den Konto-Einstellungen unter http://twitter.com/account/settings ändern. Bei Fragen wenden Sie sich an privacy@twitter.com.\r\n\r\n<h3>Datenschutzerklärung für die Nutzung von Google Adsense</h3>\r\nDiese Website benutzt Google AdSense, einen Dienst zum Einbinden von Werbeanzeigen der Google Inc. (\"Google\"). Google AdSense verwendet sog. \"Cookies\", Textdateien, die auf Ihrem Computer gespeichert werden und die eine Analyse der Benutzung der Website ermöglicht. Google AdSense verwendet auch so genannte Web Beacons (unsichtbare Grafiken). Durch diese Web Beacons können Informationen wie der Besucherverkehr auf diesen Seiten ausgewertet werden.\r\nDie durch Cookies und Web Beacons erzeugten Informationen über die Benutzung dieser Website (einschließlich Ihrer IP-Adresse) und Auslieferung von Werbeformaten werden an einen Server von Google in den USA übertragen und dort gespeichert. Diese Informationen können von Google an Vertragspartner von Google weiter gegeben werden. Google wird Ihre IP-Adresse jedoch nicht mit anderen von Ihnen gespeicherten Daten zusammenführen.\r\nSie können die Installation der Cookies durch eine entsprechende Einstellung Ihrer Browser Software verhindern; wir weisen Sie jedoch darauf hin, dass Sie in diesem Fall gegebenenfalls nicht sämtliche Funktionen dieser Website voll umfänglich nutzen können. Durch die Nutzung dieserWebsite erklären Sie sich mit der Bearbeitung der über Sie erhobenen Daten durch Google in der zuvor beschriebenen Art und Weise und zu dem zuvor benannten Zweck einverstanden.\r\n\r\n<h3>Datenschutzerklärung für die Nutzung von Google Analytics</h3>\r\nDiese Website benutzt Google Analytics, einen Webanalysedienst der Google Inc. (\"Google\"). Google Analytics verwendet sog. \"Cookies\", Textdateien, die auf Ihrem Computer gespeichert werden und die eine Analyse der Benutzung der Website durch Sie ermöglichen. Die durch den Cookie erzeugten Informationen über Ihre Benutzung dieser Website werden in der Regel an einen Server von Google in den USA übertragen und dort gespeichert. Im Falle der Aktivierung der IP-Anonymisierung auf dieser Webseite wird Ihre IP-Adresse von Google jedoch innerhalb von Mitgliedstaaten der Europäischen Union oder in anderen Vertragsstaaten des Abkommens über den Europäischen Wirtschaftsraum zuvor gekürzt.\r\nNur in Ausnahmefällen wird die volle IP-Adresse an einen Server von Google in den USA übertragen und dort gekürzt. Google wird diese Informationen benutzen, um Ihre Nutzung der Website auszuwerten, um Reports über die Websiteaktivitäten für die Websitebetreiber zusammenzustellen und um weitere mit der Websitenutzung und der Internetnutzung verbundene Dienstleistungen zu erbringen. Auch wird Google diese Informationen gegebenenfalls an Dritte übertragen, sofern dies gesetzlich vorgeschrieben oder soweit Dritte diese Daten im Auftrag von Google verarbeiten.Die im Rahmen von Google Analytics von Ihrem Browser übermittelte IP-Adresse wird nicht mit anderen Daten von Google zusammengeführt.\r\nSie können die Installation der Cookies durch eine entsprechende Einstellung Ihrer Browser Software verhindern; wir weisen Sie jedoch darauf hin, dass Sie in diesem Fall gegebenenfalls nicht sämtliche Funktionen dieser Website voll umfänglich nutzen können. Durch die Nutzung dieser Website erklären Sie sich mit der Bearbeitung der über Sie erhobenen Daten durch Google in der zuvor beschriebenen Art und Weise und zu dem zuvor benannten Zweck einverstanden.\r\nSie können darüber hinaus die Erfassung der durch das Cookie erzeugten und auf Ihre Nutzung der Website bezogenen Daten (inkl. Ihrer IP-Adresse) an Google sowie die Verarbeitung dieser Daten durch Google verhindern, indem Sie das unter dem folgenden Link (http://tools.google.com/dlpage/gaoptout?hl=de) verfügbare Browser-Plugin herunterladen und installieren.\r\nWir nutzen Google Analytics zudem dazu, Daten aus AdWords und dem Double-Click-Cookie zu statistischen Zwecken auszuwerten. Sollten Sie dies nicht wünschen, können Sie dies über den Anzeigenvorgaben-Manager (http://www.google.com/settings/ads/onweb/?hl=de) deaktivieren.\r\n\r\n<h3>Datenschutzerklärung für die Nutzung von Google +1</h3>\r\nMithilfe der Google +1-Schaltfläche können Sie Informationen weltweit veröffentlichen. Über die Google +1-Schaltfläche erhalten Sie und andere Nutzer personalisierte Inhalte von Google und dessen Partnern. Google speichert sowohl die Information, dass Sie für einen Inhalt +1 gegeben haben, als auch Informationen über die Seite, die Sie beim Klicken auf +1 angesehen haben. Ihre +1 können als Hinweise zusammen mit Ihrem Profilnamen und Ihrem Foto in Google-Diensten, wie etwa in Suchergebnissen oder in Ihrem Google-Profil, oder an anderen Stellen auf Websites und Anzeigen im Internet eingeblendet werden.\r\nGoogle zeichnet Informationen über Ihre +1-Aktivitäten auf, um die Google-Dienste für Sie und andere zu verbessern.\r\nUm die Google +1-Schaltfläche verwenden zu können, benötigen Sie ein weltweit sichtbares, öffentliches Google-Profil, das zumindest den für das Profil gewählten Namen enthalten muss. Dieser Name wird in allen Google-Diensten verwendet. In manchen Fällen kann dieser Name auch einenanderen Namen ersetzen, den Sie beim Teilen von Inhalten über Ihr Google-Konto verwendet haben. Die Identität Ihres Google-Profils kann Nutzern angezeigt werden, die Ihre E-Mail-Adresse kennen oder über andere identifizierende Informationen von Ihnen verfügen.\r\nNeben den oben erläuterten Verwendungszwecken werden die von Ihnen bereitgestellten Informationen gemäß den geltenden Google-Datenschutzbestimmungen (http://www.google.com/intl/de/policies/privacy/) genutzt. Google veröffentlicht möglicherweise zusammengefasste Statistiken über die +1-Aktivitäten der Nutzer bzw. geben diese Statistiken an unsere Nutzer und Partner weiter, wie etwa Publisher, Inserenten oder verbundene Websites.;\r\n\r\n<h3>Quelle</h3>\r\nDieses Impressum wurde am 09.05.2012 mit dem Impressum-Generator http://www.bag.ch/impressum-generator der Firma Brunner AG, Druck und Medien, in Kriens erstellt. Die Brunner AG, Druck und Medien, in Kriens übernimmt keine Haftung.\r\n\r\n<h3>Bildnachweise</h3>\r\nUrheber und Bildquelle der im Original-Layout \"Coiffeur Stile Angela\" verwendeten Bilder: Gestaltungswerkzeuge', 662, 30),
(83, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 670, 23),
(120, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 684, 17),
(121, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 687, 47),
(122, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 688, 48),
(123, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam', 688, 49);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `d_text_simple`
--

CREATE TABLE `d_text_simple` (
  `ID` int(11) NOT NULL,
  `data` varchar(128) NOT NULL,
  `pagehasblock` int(11) NOT NULL,
  `field` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `d_text_simple`
--

INSERT INTO `d_text_simple` (`ID`, `data`, `pagehasblock`, `field`) VALUES
(80, 'Kontakt ', 617, 38),
(95, 'Kontakt', 630, 38),
(99, 'Kontakt', 634, 38),
(108, 'Referenzen', 642, 55),
(116, 'Kontakt', 650, 38),
(122, 'AIzaSyCs_dArrTXfdE3V_mhK0xbCfPGNS2OkgDg', 655, 57),
(135, 'Impressum', 662, 64),
(146, 'AIzaSyCs_dArrTXfdE3V_mhK0xbCfPGNS2OkgDg', 668, 57),
(147, 'Home Header<br>Titel', 669, 66),
(148, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.', 669, 67),
(149, 'Text Titel', 670, 56),
(153, 'AIzaSyCs_dArrTXfdE3V_mhK0xbCfPGNS2OkgDg', 672, 57),
(177, 'AIzaSyDOlbEm0_qE4VQJSi5TfRWFqFWmbmZIPJQ', 681, 57),
(182, 'AIzaSyDOlbEm0_qE4VQJSi5TfRWFqFWmbmZIPJQ', 683, 57),
(183, 'Kontaktformular Titel', 684, 38),
(184, 'Gallerie Titel', 685, 55),
(185, 'Text Links & Bild Rechts Titel', 687, 76),
(186, 'Gallerie Links & Text Rechts Titel', 688, 77);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `f_gallery`
--

CREATE TABLE `f_gallery` (
  `ID` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `block` int(11) NOT NULL,
  `fieldtype` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `f_gallery`
--

INSERT INTO `f_gallery` (`ID`, `title`, `block`, `fieldtype`) VALUES
(3, 'Gallerie', 42, 'gallery'),
(4, 'Hintergrundbilder', 50, 'gallery'),
(5, 'Bilder', 51, 'gallery'),
(6, 'Gallerie', 55, 'gallery');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `f_image`
--

CREATE TABLE `f_image` (
  `ID` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `block` int(11) NOT NULL,
  `fieldtype` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `f_image`
--

INSERT INTO `f_image` (`ID`, `title`, `block`, `fieldtype`) VALUES
(13, 'Bild', 43, 'image'),
(25, 'Bild', 54, 'image');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `f_text_area`
--

CREATE TABLE `f_text_area` (
  `ID` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `rows_count` int(11) NOT NULL,
  `block` int(11) NOT NULL,
  `fieldtype` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `f_text_area`
--

INSERT INTO `f_text_area` (`ID`, `title`, `rows_count`, `block`, `fieldtype`) VALUES
(17, 'Text', 4, 28, 'text_area'),
(23, 'Text', 4, 44, 'text_area'),
(30, 'Text', 10, 48, 'text_area'),
(31, 'Name', 3, 51, 'text_area'),
(32, 'Ausbildung', 3, 51, 'text_area'),
(33, 'Sprachen', 3, 51, 'text_area'),
(34, 'Text', 6, 51, 'text_area'),
(47, 'Text', 4, 54, 'text_area'),
(48, 'Text Rechts', 4, 55, 'text_area'),
(49, 'Text Unten', 4, 55, 'text_area');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `f_text_simple`
--

CREATE TABLE `f_text_simple` (
  `ID` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `block` int(11) NOT NULL,
  `fieldtype` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `f_text_simple`
--

INSERT INTO `f_text_simple` (`ID`, `title`, `block`, `fieldtype`) VALUES
(38, 'Titel', 28, 'text_simple'),
(55, 'Titel', 42, 'text_simple'),
(56, 'Titel', 44, 'text_simple'),
(57, 'Google Maps Key', 45, 'text_simple'),
(64, 'Titel', 48, 'text_simple'),
(66, 'Titel', 50, 'text_simple'),
(67, 'Lead', 50, 'text_simple'),
(76, 'Titel', 54, 'text_simple'),
(77, 'Titel', 55, 'text_simple');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu_footer`
--

CREATE TABLE `menu_footer` (
  `ID` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `pages` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `menu_footer`
--

INSERT INTO `menu_footer` (`ID`, `name`, `url`, `icon`, `pages`) VALUES
(40, 'About Us', 'about-us', '', '[\"1\",\"16\",\"17\"]'),
(41, 'Services', '#services', '', '[\"1\",\"16\",\"17\"]'),
(42, 'Privacy', '#privacy', '', '[\"1\",\"16\",\"17\"]'),
(43, 'Kosten', '#kosten', '', '[\"1\",\"16\",\"17\"]'),
(44, 'Contact', '#contact', '', '[\"1\",\"16\",\"17\"]'),
(45, 'Book Now', '#book-now', '', '[\"1\",\"16\",\"17\"]');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu_header`
--

CREATE TABLE `menu_header` (
  `ID` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `pages` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `menu_header`
--

INSERT INTO `menu_header` (`ID`, `name`, `url`, `icon`, `pages`) VALUES
(173, 'About Us', 'about-us', '', '[\"1\",\"16\",\"17\"]'),
(174, 'Services', '#services', '', '[\"1\",\"16\",\"17\"]'),
(175, 'Contact', '#contact', '', '[\"1\",\"16\",\"17\"]');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `page`
--

CREATE TABLE `page` (
  `ID` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `page`
--

INSERT INTO `page` (`ID`, `title`, `name`) VALUES
(1, 'Home', 'index'),
(16, 'Impressum', 'impressum/index');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pagehasblock`
--

CREATE TABLE `pagehasblock` (
  `ID` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  `block` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `pagehasblock`
--

INSERT INTO `pagehasblock` (`ID`, `page`, `block`, `position`) VALUES
(662, 16, 48, 1),
(669, 1, 50, 1),
(670, 1, 44, 2),
(683, 1, 45, 3),
(684, 1, 28, 4),
(685, 1, 42, 5),
(686, 1, 43, 6),
(687, 1, 54, 7),
(688, 1, 55, 8);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sf_repeater`
--

CREATE TABLE `sf_repeater` (
  `ID` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `block` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `blockhasfield`
--
ALTER TABLE `blockhasfield`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `blockhasspecialfield`
--
ALTER TABLE `blockhasspecialfield`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `d_gallery`
--
ALTER TABLE `d_gallery`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `d_image`
--
ALTER TABLE `d_image`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `d_text_area`
--
ALTER TABLE `d_text_area`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `d_text_simple`
--
ALTER TABLE `d_text_simple`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `f_gallery`
--
ALTER TABLE `f_gallery`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `f_image`
--
ALTER TABLE `f_image`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `f_text_area`
--
ALTER TABLE `f_text_area`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `f_text_simple`
--
ALTER TABLE `f_text_simple`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `menu_footer`
--
ALTER TABLE `menu_footer`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `menu_header`
--
ALTER TABLE `menu_header`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `pagehasblock`
--
ALTER TABLE `pagehasblock`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `sf_repeater`
--
ALTER TABLE `sf_repeater`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `block`
--
ALTER TABLE `block`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT für Tabelle `blockhasfield`
--
ALTER TABLE `blockhasfield`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT für Tabelle `blockhasspecialfield`
--
ALTER TABLE `blockhasspecialfield`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `d_gallery`
--
ALTER TABLE `d_gallery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1543;

--
-- AUTO_INCREMENT für Tabelle `d_image`
--
ALTER TABLE `d_image`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT für Tabelle `d_text_area`
--
ALTER TABLE `d_text_area`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT für Tabelle `d_text_simple`
--
ALTER TABLE `d_text_simple`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT für Tabelle `f_gallery`
--
ALTER TABLE `f_gallery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `f_image`
--
ALTER TABLE `f_image`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT für Tabelle `f_text_area`
--
ALTER TABLE `f_text_area`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT für Tabelle `f_text_simple`
--
ALTER TABLE `f_text_simple`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT für Tabelle `menu_footer`
--
ALTER TABLE `menu_footer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT für Tabelle `menu_header`
--
ALTER TABLE `menu_header`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT für Tabelle `page`
--
ALTER TABLE `page`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `pagehasblock`
--
ALTER TABLE `pagehasblock`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=689;

--
-- AUTO_INCREMENT für Tabelle `sf_repeater`
--
ALTER TABLE `sf_repeater`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
