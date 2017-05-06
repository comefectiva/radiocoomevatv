-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-05-2017 a las 02:06:17
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `radiocoomevatv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customLogin`
--

CREATE TABLE `customLogin` (
  `id` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8_bin NOT NULL,
  `pass` varchar(255) COLLATE utf8_bin NOT NULL,
  `location` varchar(255) COLLATE utf8_bin NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `customLogin`
--

INSERT INTO `customLogin` (`id`, `video`, `user`, `pass`, `location`, `start_at`, `end_at`, `created_at`, `updated_at`) VALUES
(1, 2, '1140940534', '$2y$10$1Y6Zr8wA96Bi2oIpETuN1u5XOjd5g3tQPwu.L8dnOGeprg/nKkmsO', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-27 23:02:52', NULL),
(2, 2, '21545646546', '$2y$10$fPSavvkZr1e22cw/6uXY1u9I2rf4s/D4JI2M8wYwxTQN1B3OA.HwW', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-27 23:02:52', NULL),
(3, 2, '654564654', '$2y$10$aLjQfyq9zDhut76I3.N6juIr6VKPm7SdhjwKsxHxYQr.Rbyn9CbIS', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-27 23:02:52', NULL),
(4, 2, '1140940534', '$2y$10$4ZxSrUIiCEAR.WhO/pckh.xL1VFdRYlF1z7k0epH03eaZ4jxNLse6', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-27 23:04:02', NULL),
(5, 2, '21545646546', '$2y$10$CRjq7qKG7u9YQpjCNOJ9J.Ny6ZATn0uRXyesaKm.ogdmEHebkNBDa', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-27 23:04:02', NULL),
(6, 2, '654564654', '$2y$10$E/.vEiMxIYGT7Zc1mONIjuD5cYgaCynpj1XeeNxvZ6LsG65mCbuxK', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-27 23:04:02', NULL),
(7, 1, '1140940534', '$2y$10$H0Knzp893WoqshrHvWQHV.5BSfibp.TfWXA2qX7dRIW0mCU7sca06', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 02:38:30', NULL),
(8, 1, '21545646546', '$2y$10$GXGqvykj6qNojySgphh97emQ7ZsB0vHBmMNrNe/11FBkt471J8tee', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 02:38:30', NULL),
(9, 1, '654564654', '$2y$10$vScAz4YmOy0UBPmdCINb4.YKSHC76MvhGOI34yKb2g9EW97TYA4US', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 02:38:30', NULL),
(10, 1, '1140940534', '$2y$10$WIkZJam1hknTyIx.N27Rx.2l99xZjH18Mf.pUWu8GTzA5a9R577um', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 02:38:53', NULL),
(11, 1, '21545646546', '$2y$10$crqTj7AJswefDZ6FtZ5x.OLs58dLR53Xuvaea2GC28per6u61lxCW', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 02:38:53', NULL),
(12, 1, '654564654', '$2y$10$ny9nT3m.qE3hFswB1qqUyeTXhpi2INGd7cGrl0WyRfJgL3F.25T9O', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 02:38:53', NULL),
(13, 1, '1140940534', '$2y$10$cEdocLou3KNLAjJLhQUkaOyVliCIxfC4vURSFt4DbDR2pVyOk1r7S', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 02:39:41', NULL),
(14, 1, '21545646546', '$2y$10$M8RSkKq77Jjixda92iAFHeKMYVrlJeW5Yojf2Res1peXDBsNZvi7S', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 02:39:41', NULL),
(15, 1, '654564654', '$2y$10$gmjJrnOal.INXmIhjmaYy.zX/ZPO.PwNlRqVZYz3vMmkAt0/WEAou', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 02:39:41', NULL),
(16, 1, '1140940534', '$2y$10$.GHSK1JOlPW8OjrI1.Hg0..dV14IyWTDgM9cTJniKSiuUWwhW3q4C', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 02:39:50', NULL),
(17, 1, '21545646546', '$2y$10$qOORJefS9aAAxdKMJaawNe1ltISVWP333vHDLGcn1GA8UKr9gUtRm', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 02:39:50', NULL),
(18, 1, '654564654', '$2y$10$Jq4rloJdlWvB/.RMO24TheQDp2n4Nyi8hx1U5EZCxmetPuoTEizwy', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 02:39:50', NULL),
(19, 1, '1140940534', '$2y$10$Tq3Fr9GLegOMqkaUNAW1sOTmj6exMpi5ikoJay43V5MhBxr7gsy9G', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:12:18', NULL),
(20, 1, '21545646546', '$2y$10$K.P30lh7Z/cZdigxaFNr2ebYzy3xhAmVKHxsajvZD30BnGBJbO6KW', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:12:18', NULL),
(21, 1, '654564654', '$2y$10$PzKKlIAU80g/THfy19HT5eo9syG0kIs5UJvJOYCp7n1qAQHO9mdMm', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:12:18', NULL),
(22, 1, '1140940534', '$2y$10$zFx76yXUBtzXFivsW2V0Z.A8q5Gu52ReOBo4xxzJ485o.GKVo.P3e', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:13:47', NULL),
(23, 1, '21545646546', '$2y$10$uee9/2l.IjGhNhRMIqMYGuiVrv8urNRikkQLcyQOIq10zDCelm3im', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:13:47', NULL),
(24, 1, '654564654', '$2y$10$HqGb3ZMjba0FH8kgQ7ptpuqFnJrDPk9diRYkYV.zZZIRo27Fc09wm', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:13:47', NULL),
(25, 1, '1140940534', '$2y$10$VS5qWQYWXRQ743Up7ojWaeKNr8TvIRBKe81gekuB3NycCtf7xIazW', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:14:04', NULL),
(26, 1, '21545646546', '$2y$10$FHg3xrw73UtdDlwPJM/Eu.nanxVb6BM6XKxm8HeWi56rNgrAn89D6', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:14:04', NULL),
(27, 1, '654564654', '$2y$10$t486UvewoqZ16jMtx03EUOTsNXZRI1wXF3eGQcVKIwVvzCNHZMamS', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:14:04', NULL),
(28, 1, '1140940534', '$2y$10$7yJ3L0ITa7.YNB9TISX8cefYj9vTmjPyP.aKijm/WzXYlSf8lPB4y', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:14:16', NULL),
(29, 1, '21545646546', '$2y$10$y1NIaoX5Lc60GkQ6jVxHCuTEii/ShyNoYx1bezN9go2WpgCG3cS86', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:14:16', NULL),
(30, 1, '654564654', '$2y$10$dvdV8zq0QZqnvnp0LSszFui13GHP/E/3ZPEut6yF2gs4wsvzmu50O', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:14:16', NULL),
(31, 1, '1140940534', '$2y$10$lyr9aseuFszhJpeHVjBx9e1p5zgU5PUWHAtHsQFJ6kbm5tPmu1QMC', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:15:31', NULL),
(32, 1, '21545646546', '$2y$10$t0kSvUtrU3a.NUwXyDqsRercGt25Ne/vf.3qJPeg40s3uzSV41Nc6', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:15:32', NULL),
(33, 1, '654564654', '$2y$10$g6/hYpL4wDEpc.b4zxWh9.YP6tRI1jdHx3fzbjBjSBPW07Ojh1ojO', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:15:32', NULL),
(34, 1, '1140940534', '$2y$10$gUzDR7oosoi8T5lP/mYuAu8MQFbWR.V0hn.Oc67suXPFYr8H6iEDW', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:15:44', NULL),
(35, 1, '21545646546', '$2y$10$yDXNLbHmW.CzBScSdST3o.BJPowGyt0qjGcM9jn1g4kr73Xk86g2C', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:15:44', NULL),
(36, 1, '654564654', '$2y$10$8k9DrhuhS5iTkX7911O.veCdyKc5/HACFqbs9BAFRouNirx.PkSGG', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:15:44', NULL),
(37, 1, '1140940534', '$2y$10$9z8NFE8N.JhSLhPsMLzwaOanJiHMSkGRrXck5uigJa7ZEqjXCgvMm', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:16:28', NULL),
(38, 1, '21545646546', '$2y$10$.ro2tnWVC2KBxKIWFdjabuZgDfskRhN93PikdGUIw6kCrhAFG9MaK', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:16:28', NULL),
(39, 1, '654564654', '$2y$10$WwqYyvbQGoCBdofrORs.muXEhXACOO..U3CexXIusmTQ3MbjGZ6D.', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:16:28', NULL),
(40, 1, '1140940534', '$2y$10$fPFqwBS/9Fm7AYu.kB4tEejedT/T45CaD6UkHs9fpCa/9u2Qji/5u', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:17:17', NULL),
(41, 1, '21545646546', '$2y$10$2LzBqsf5KXfDp21Lq3dBR.getdzKlEeJQVUKeooMRVfp6ba/od4Ou', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:17:17', NULL),
(42, 1, '654564654', '$2y$10$9aMineHkKxFzW8uZLunYSuXGW0v4VAYr5v8bp408yWlRLnDqzVuTm', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:17:18', NULL),
(43, 1, '1140940534', '$2y$10$9s2300ddfnJSLXTSAcJX4.75CcBa1DnzoimYaBSNc2ca0z/g5asaO', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:19:21', NULL),
(44, 1, '21545646546', '$2y$10$kLW5F9xtl1h/Iv0//DO8Aet1SvbQmSXz2LUWgshCRjkHnCtm9LHm.', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:19:21', NULL),
(45, 1, '654564654', '$2y$10$2k1XK8WUxuRH0v1v8Bu5MOjs8Xd5OtrQ7KSpovjVBi9GbUA5nkjBi', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:19:21', NULL),
(46, 1, '1140940534', '$2y$10$AVdFwoYf8vzUfVepoMQizuHSUq.oMxtDqBI3ld7s1RPHtEbHlIkm2', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:20:36', NULL),
(47, 1, '21545646546', '$2y$10$5uTcHZosrh.Vw8/rBcCaR.xnrdo50lb5N92PplRgDEzsUD/OZfgpq', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:20:37', NULL),
(48, 1, '654564654', '$2y$10$ODRbaYMHnwFonpCGP18U5ewQ8Bqh8yRNQGypbCGuvkGJ6mBkVvKle', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:20:37', NULL),
(49, 1, '1140940534', '$2y$10$OUNIf3ZP0boz2Yy76jLfa.Amzs6W1wLQvHU1q9Uv5bNgkkqOSNP46', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:21:55', NULL),
(50, 1, '21545646546', '$2y$10$Y4artv778wLFE8AhMeCzOeAEYBtPFd8gdFNFn/Q2P92NTJaeQVMku', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:21:55', NULL),
(51, 1, '654564654', '$2y$10$9aEZNgkGw9Y2myaaZDapZezzqDs53AxuSdNLNluz.wiz3Pnh3Iqgu', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:21:55', NULL),
(52, 1, '1140940534', '$2y$10$PKEDmnId2lZ9JMldhFpqc.erVazBAGFEzLP63xznPad2YFQawAlcq', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:22:12', NULL),
(53, 1, '21545646546', '$2y$10$4Fif2ARuEqj07TSker9VgukYqVcwCsQHVDg4cPpTJWmqwD.JD7kRa', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:22:12', NULL),
(54, 1, '654564654', '$2y$10$GE7Z/Br9S2nFvh8/x0yDFOcchGVQXRloTvfEP5U/iSa/dmgxriLRS', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:22:12', NULL),
(55, 1, '1140940534', '$2y$10$gv3VQYgc120xSkwWoZfBt.riW078OVRdqkhv97qZ0Vb3PNxNHotma', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:22:32', NULL),
(56, 1, '21545646546', '$2y$10$rLlR5jnzQ2G2hu6bm1vLceDjlcE1boZWeFaPlmhCfgNqp/wQvDakW', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:22:32', NULL),
(57, 1, '654564654', '$2y$10$zH10fOdNjNUjTPFNOEnqx.GYWVziAGPozFijhJsIPn5rz86WCsnae', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:22:32', NULL),
(58, 1, '1140940534', '$2y$10$UyEkv407oRJ3TQB7RIqmYeZwMi/E9WhcuSGBH2MisW5xnP.l/olRm', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:23:17', NULL),
(59, 1, '21545646546', '$2y$10$nY3QqJyH9V7DfxN1Wv.eaO7OMMwBPnpxDD9tu7ExvA4XLNbvZe.aa', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:23:17', NULL),
(60, 1, '654564654', '$2y$10$pxROFKNeUpMsqqZYkRO5reNKgtuhGRBxLiolIh.T6zGVhdeUt2aR2', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:23:17', NULL),
(61, 1, '1140940534', '$2y$10$ci9wBEsxpEKmSdRNFFpR.OFNpTPOqpELGY5CHMQUy0MwzCTVwrafC', 'Cali', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:23:31', NULL),
(62, 1, '21545646546', '$2y$10$.okAp8OVUN.FggiQNdraiO6U5KVT41s/weIMWCxSfWDfL52BPyjTS', 'Palmira', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:23:31', NULL),
(63, 1, '654564654', '$2y$10$r7lfA9rQ6HaJ4EXnDQ8TGeKSpsDWpaEOrZ/SYaz/gvAYZxJ25w.Ju', 'Caldono', '2017-04-27 00:00:00', '2017-04-30 00:00:00', '2017-04-28 03:23:31', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `type` varchar(255) COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `media`
--

INSERT INTO `media` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, '1493269200-1.jpg', '', '2017-04-28 04:28:14', NULL),
(2, '1493269200-2.jpg', '', '2017-04-28 04:30:01', NULL),
(3, '1493614800.jpg', '', '2017-05-01 23:05:07', NULL),
(4, '1493614800-1.jpg', '', '2017-05-01 23:05:58', NULL),
(5, '1493614800-2.jpg', '', '2017-05-01 23:06:16', NULL),
(6, '1493614800-3.jpg', '', '2017-05-01 23:13:13', NULL),
(7, '1493614800-4.jpg', '', '2017-05-01 23:13:37', NULL),
(8, '1493614800-5.jpg', '', '2017-05-01 23:14:08', NULL),
(9, '1493614800-6.jpg', '', '2017-05-01 23:19:13', NULL),
(10, '1493614800-7.jpg', '', '2017-05-01 23:19:53', NULL),
(11, '1493614800-8.jpg', '', '2017-05-01 23:20:11', NULL),
(12, '1493614800-9.jpg', '', '2017-05-01 23:28:34', NULL),
(13, '1493614800-10.jpg', '', '2017-05-01 23:32:03', NULL),
(14, '1493614800-11.jpg.jpg', '', '2017-05-01 23:34:57', NULL),
(15, '1493614800-12.jpg.jpg', '', '2017-05-01 23:36:35', NULL),
(16, '1493614800-13.jpg.jpg', '', '2017-05-01 23:38:27', NULL),
(17, '1493614800-14.jpg.jpg', '', '2017-05-01 23:42:37', NULL),
(18, '1493614800-15.jpg.jpg', '', '2017-05-01 23:43:36', NULL),
(19, '1493614800-16.jpg.jpg', '', '2017-05-01 23:47:07', NULL),
(20, '1493614800-17.jpg.jpg', '', '2017-05-01 23:48:11', NULL),
(21, '1493614800-18.jpg.jpg', '', '2017-05-01 23:49:06', NULL),
(22, '1493614800-19.jpg.jpg', '', '2017-05-01 23:50:27', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `radios`
--

CREATE TABLE `radios` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `infoPath` varchar(255) NOT NULL,
  `coverPath` varchar(255) NOT NULL,
  `internalID` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `radios`
--

INSERT INTO `radios` (`id`, `name`, `source`, `type`, `target`, `infoPath`, `coverPath`, `internalID`, `created_at`) VALUES
(1, 'Adulto Contemporaneo', 'http://radio.coomeva.com.co:8090/adulto.mp3', 'audio/mpeg', 'radiocoomeva', '7090/info_n_7090.xml', '7090/caratulas/', '7090', '2017-05-05 22:19:45'),
(2, 'Instrumental', 'http://radio.coomeva.com.co:8090/instrumental.mp3', 'audio/mpeg', 'radiocoomeva', '7286/info_n_7286.xml', '7286/caratulas/', '7286', '2017-05-05 22:19:45'),
(3, 'Jovenes', 'http://radio.coomeva.com.co:8090/jovenes.mp3', 'audio/mpeg', 'radiocoomeva', '7284/info_n_7284.xml', '7284/caratulas/', '7284', '2017-05-05 22:19:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `mail` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `mail`, `password`, `active`, `created_at`) VALUES
(1, 'RadioCoomeva', 'web@comunicacionefectiva.com', '$2a$04$JfSDap0inRbrlt76OyKOy.EbQoFVUN20CwrILpLPB/WgfH7t8.YFy', 1, '2017-05-01 18:15:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin,
  `image` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `sector` varchar(255) COLLATE utf8_bin DEFAULT 'Otro',
  `requireLogin` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `customLogin`
--
ALTER TABLE `customLogin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `radios`
--
ALTER TABLE `radios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `customLogin`
--
ALTER TABLE `customLogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `radios`
--
ALTER TABLE `radios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
