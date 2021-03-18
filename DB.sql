-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1:3306
-- 生成日時: 2021 年 3 月 18 日 17:47
-- サーバのバージョン： 8.0.22
-- PHP のバージョン: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `price_checker`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `items`
--

CREATE TABLE `items` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `kana` varchar(50) NOT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `price` int NOT NULL,
  `comment` text,
  `user_id` int NOT NULL,
  `shop_id` int NOT NULL,
  `purchase_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `items`
--

INSERT INTO `items` (`id`, `name`, `kana`, `item_name`, `price`, `comment`, `user_id`, `shop_id`, `purchase_date`) VALUES
(1, '目薬', 'メグスリ', 'アルガードクリアブロックZ', 1800, '目の痒みが取れた', 3, 4, '2021-03-07 00:00:00'),
(3, '目の洗浄液', 'メノセンジョウエキ', 'アイボン　Wビタミン　PREMIUM', 648, '', 3, 1, '2021-03-06 00:00:00'),
(4, '卵', 'タマゴ', '新鮮卵', 200, '新鮮だよ', 3, 1, '2021-03-09 00:00:00'),
(5, '牛肉', 'ギュウニク', '神戸牛', 2000, 'おいしい', 3, 1, '2021-03-08 00:00:00'),
(6, '豚肉', 'ブタニク', '黒豚', 1800, 'おいしいよ', 3, 1, '2021-03-08 00:00:00'),
(7, '鶏肉', 'トリニク', 'おいしい鶏肉', 1500, '', 3, 1, '2021-03-08 00:00:00'),
(8, '麦茶', 'ムギチャ', '天然ミネラル麦茶', 350, '', 2, 7, '2021-03-09 00:00:00'),
(24, '卯の花', 'ウノハナ', '', 128, '', 3, 1, '2021-02-10 00:00:00'),
(25, '大豆油', 'ダイズアブラ', '', 218, 'はじめて大豆油を買ってみた\r\n\r\nまあまあうまかった\r\n\r\n\r\n\r\nコスパはいい', 2, 7, '2021-02-05 00:00:00'),
(26, '醤油750ml', 'ショウユ', '特選丸大豆醤油', 328, '', 2, 7, '2021-02-05 00:00:00'),
(27, '梅酒1L', 'ウメシュ', 'さらりとした梅酒', 869, 'おいしい', 2, 7, '2021-02-05 00:00:00'),
(28, 'サワー', 'サワー', 'ほろよい桃', 110, '', 2, 7, '2021-02-05 00:00:00'),
(29, 'レモンサワー', 'レモンサワー', '檸檬堂鬼レモン', 152, '', 2, 7, '2021-02-05 00:00:00'),
(30, 'チューハイ', 'チューハイ', '素敵絞りオレンジ', 152, '', 2, 7, '2021-02-05 00:00:00'),
(31, 'キャベツ半分', 'キャベツハンブン', '', 152, '', 2, 7, '2021-03-13 00:00:00'),
(32, 'ニラ', 'ニラ', '', 174, '', 2, 7, '2021-03-13 00:00:00'),
(33, '糸唐辛子', 'イトトウガラシ', '', 132, '２０％引き', 2, 7, '2021-03-13 00:00:00'),
(34, 'おにぎり鮭', 'オニギリシャケ', '熟成紅鮭', 140, '', 2, 8, '2021-03-15 00:00:00'),
(35, 'プリン３個', 'プリン', 'カスタードプリン', 134, '', 3, 9, '2021-03-06 00:00:00'),
(36, 'ベビーリーフ', 'ベビーリーフ', '', 174, '', 3, 9, '2021-03-06 00:00:00'),
(37, 'ソーセージ', 'ソーーセージ', 'シャウエッセンチェダーカマンベール', 527, '', 3, 9, '2021-03-06 00:00:00'),
(38, 'ティッシュ５箱', 'ティッシュハコ', 'エリエール＋Water', 986, '', 3, 9, '2021-03-06 00:00:00'),
(39, 'パスタソース', 'パスタソース', '予約の取れない店の生クリームボロネーゼ', 145, '', 3, 9, '2021-03-06 00:00:00'),
(40, 'ジンジャーエール', 'ジンジャーエール', 'カナダドライジンジャーエール', 87, '', 3, 9, '2021-03-06 00:00:00'),
(41, 'モッツァレラチーズ', 'モッツァレラチーズ', '花畑牧場フレッシュモッツァレラ', 241, '', 3, 9, '2021-03-06 00:00:00'),
(42, 'アルミホイル', 'アルミホイル', '三菱ホイル25cm×15m', 92, '', 3, 9, '2021-03-06 00:00:00'),
(43, 'ハヤシライス', 'ハヤシライス', 'ゴールデンハヤシ', 168, '', 3, 9, '2021-03-06 00:00:00'),
(44, 'ベーコン', 'ベーコン', '村井商会ベーコンスライス', 471, '\r\n', 3, 9, '2021-03-06 00:00:00'),
(45, 'キャベツ', 'キャベツ', '', 54, '', 3, 9, '2021-03-06 00:00:00'),
(46, '冷凍シーフードミックス310g', 'レイトウシフーフードミックス', '', 417, '', 3, 9, '2021-03-06 00:00:00'),
(47, '牛乳500mL', 'ギュウニュウ', '別海のおいしい牛乳', 130, '', 3, 9, '2021-03-06 00:00:00'),
(48, 'ウェットティッシュ', 'ウェットティッシュ', 'シルコットウェットアルコール40枚', 237, '', 3, 9, '2021-03-06 00:00:00'),
(49, 'ホールトマト400g', 'ホールトマト', 'フィオリータ', 78, '', 3, 9, '2021-03-06 00:00:00'),
(50, '赤ワイン180ml', 'アカワイン', '楽園ワイン', 101, '', 3, 9, '2021-03-06 00:00:00'),
(51, '人参', 'ニンジン', '', 262, '', 3, 9, '2021-03-06 00:00:00'),
(52, '薬味ネギ', 'ヤクミネギ', '', 108, '', 3, 9, '2021-03-06 00:00:00'),
(53, '焼きそば', 'ヤキソバ', 'マルちゃん', 156, '', 3, 9, '2021-03-06 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `reset_password`
--

CREATE TABLE `reset_password` (
  `id` int NOT NULL,
  `token` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `shops`
--

CREATE TABLE `shops` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `branch_name` varchar(50) DEFAULT NULL,
  `prefecture_id` int DEFAULT NULL,
  `city` varchar(10) DEFAULT NULL,
  `block_number` varchar(50) DEFAULT NULL,
  `user_id` int NOT NULL,
  `collapse` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `shops`
--

INSERT INTO `shops` (`id`, `name`, `branch_name`, `prefecture_id`, `city`, `block_number`, `user_id`, `collapse`) VALUES
(1, 'ロピア', '馬絹店', 14, '川崎市宮前区', '馬絹１丁目９−５', 3, 1),
(4, 'Amazon', '', 0, '', '', 3, 1),
(6, 'MEGAドンキホーテ', '東名川崎店', 14, '川崎市宮前区', '馬絹2-1-1', 3, 1),
(7, 'いなげや', '川崎宮前平前店', 14, '川崎市宮前区', '小台2-2-1', 2, 1),
(8, 'Family Mart', '赤坂パークビル', 13, '港区', '赤坂5-2-20', 2, 1),
(9, 'オーケー', '宮崎台店', 14, '川崎市宮前区', '宮前平3-1-2', 3, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(2, '内山立樹', 'fukunaga.kinoko4929@gmail.com', '16d7a4fca7442dda3ad93c9a726597e4'),
(3, '川上優果', 't70.uchiyama.tatsuki@gmail.com', 'f1116ee30147c961682624f391285bb7'),
(4, 'まひろ', 'uchiyama4929@gmail.com', 'f1116ee30147c961682624f391285bb7'),
(5, 'ああああああああああ', 'goof@gmail.com', 'f1116ee30147c961682624f391285bb7'),
(6, 'テストアカウント', 'test@gmail.com', '16d7a4fca7442dda3ad93c9a726597e4');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- テーブルのインデックス `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`email`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- テーブルの AUTO_INCREMENT `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- テーブルの AUTO_INCREMENT `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;