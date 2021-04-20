CREATE TABLE `cart_items` (
                              `id` int(11) NOT NULL,
                              `product_id` int(11) NOT NULL,
                              `quantity` int(2) NOT NULL,
                              `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `cash_flow`
--

CREATE TABLE `cash_flow` (
                             `id` int(11) NOT NULL,
                             `created_by` int(11) NOT NULL,
                             `money` decimal(10,2) NOT NULL,
                             `description` longtext,
                             `type` tinyint(1) NOT NULL,
                             `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `categories`
--

CREATE TABLE `categories` (
                              `id` int(11) NOT NULL,
                              `name` varchar(255) NOT NULL,
                              `is_delete` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `categories`
--

INSERT INTO `categories` (`id`, `name`, `is_delete`) VALUES
(12, '3c產品', 0),
(13, '居家生活', 0),
(14, '運動用品', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `migration`
--

CREATE TABLE `migration` (
                             `version` varchar(180) NOT NULL,
                             `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1617777694),
('m130524_201442_init', 1617777695),
('m210407_060223_create_products_table', 1618563212),
('m210407_060243_create_orders_table', 1618563212),
('m210407_060325_create_order_items_table', 1618563212),
('m210407_060358_create_cart_items_table', 1618563212),
('m210407_060416_create_cash_flow_table', 1618563212),
('m210412_080656_add_is_delete_to_products_table', 1618563212),
('m210415_040426_rename_columns_to_cash_flow_table', 1618563212),
('m210419_050954_create_categories_table', 1618818441),
('m210419_051012_add_category_id_column_to_product_table', 1618818589);

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
                          `id` int(11) NOT NULL,
                          `username` varchar(255) NOT NULL,
                          `total_price` decimal(10,2) NOT NULL,
                          `status` tinyint(1) NOT NULL,
                          `created_at` int(11) DEFAULT NULL,
                          `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `order_items`
--

CREATE TABLE `order_items` (
                               `id` int(11) NOT NULL,
                               `product_id` int(11) NOT NULL,
                               `product_name` varchar(255) NOT NULL,
                               `product_price` decimal(10,2) NOT NULL,
                               `order_id` int(11) NOT NULL,
                               `quantity` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
                            `id` int(11) NOT NULL,
                            `category_id` int(11) NOT NULL,
                            `name` varchar(255) NOT NULL,
                            `description` longtext,
                            `image` varchar(2000) DEFAULT '/products/noimage.jpeg',
                            `price` decimal(10,2) NOT NULL,
                            `status` tinyint(2) NOT NULL,
                            `is_delete` tinyint(1) DEFAULT '0',
                            `created_at` int(11) DEFAULT NULL,
                            `updated_at` int(11) DEFAULT NULL,
                            `created_by` int(11) DEFAULT NULL,
                            `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `image`, `price`, `status`, `is_delete`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(13, 12, 'ASUS X509JP 15吋筆電(i7-1065G7/MX330/4G/1T HDD+256G SSD/Laptop/冰柱銀)', '<p>X509JP-0161S1065G7 最新第十代i7-1065G7</p>\r\n\r\n<p>4GB DDR4 記憶體 / 1T HDD+256G SSD</p>\r\n\r\n<p>MX330 2GB GDDR5獨顯</p>\r\n\r\n<p>Win10 /冰柱銀</p>\r\n', '/products/1618893782-8F157E583F-Gd-8960376.jpeg', '25000.00', 1, 0, 1618822278, 1618894974, 1, 1),
(14, 12, 'DELL Inspiron 5000 15吋筆電 (i5-1135G7/8G/512G/MX350/Win10/綠)', '<p>15.6吋 FHD 防眩光螢幕</p>\r\n\r\n<p>全新第11代處理器</p>\r\n\r\n<p>全新轉軸設計，散熱更高效</p>\r\n\r\n<p>智能控溫、開蓋即亮、一鍵風扇</p>\r\n\r\n<p>類四窄邊框，金屬機身，體積小巧</p>\r\n', '/products/1618822322-55350E7C67-Gd-9244150.jpeg', '37000.00', 1, 0, 1618822322, 1618894996, 1, 1),
(15, 12, '2020 MacBook Pro 13.3吋/1.4GHZ 第八代 i5 /8GB/256GB', '<p>1.4GHz 4核 8 代i5</p>\r\n\r\n<p>觸控欄及 Touch ID</p>\r\n\r\n<p>8GB LPDDR3 記憶體</p>\r\n\r\n<p>256GB SSD</p>\r\n\r\n<p>13 吋 Retina 顯示器</p>\r\n', '/products/1618822340-F30629149C-SP-8922617.jpeg', '40000.00', 1, 0, 1618822340, 1618895025, 1, 1),
(16, 13, '居家生活 科羅旺本色亞麻綠布紋皮沙發組 (1+2+3人)', '<p>椅架採用優質紐西蘭松木，堅固又耐用！</p>\r\n\r\n<p>內裡採用高密度泡棉+絲棉，柔軟又舒適！</p>\r\n\r\n<p>外材採用高級亞麻布紋皮包覆，美觀又親膚！</p>\r\n\r\n<p>享免組裝為您配送到府服務哦~</p>\r\n', '/products/1618888340-C6AB6B170435B50E73AF1D4D7F3A843DEE30EDD2.jpeg', '12750.00', 1, 0, 1618888340, 1618888340, 1, 1),
(17, 13, 'PUSH!居家生活用品手壓式手捲真空壓縮袋旅行便攜袋套裝組合(1組6入裝)S59', '<p>行李箱、衣櫃、抽屜、輕鬆整理可反覆使用</p>\r\n\r\n<p>超強密封性節省空間75％，防塵防潮防蟲</p>\r\n\r\n<p>非對稱拉鍊更好密封,精選複合材質柔韌耐用</p>\r\n\r\n<p>精巧設計出氣口，長久不回氣</p>\r\n', '/products/1618888391-EF4CA557BF-SP-6408219.jpeg', '400.00', 1, 0, 1618888391, 1618888391, 1, 1),
(18, 13, '居家生活 溫德2.7尺橡木紋六斗櫃', '<p>外觀簡約橡木紋，散發古典光采</p>\r\n\r\n<p>鋼珠滑軌抽屜結構，滑順好推拉</p>\r\n\r\n<p>高級防蛀木板，有穩定性的結構</p>\r\n\r\n<p>復古式皮箱造型+烤漆鋁條</p>\r\n\r\n<p>免組立/專人到府組裝</p>\r\n', '/products/1618888431-29003543817D23D3FFE515B77ACA8C39916989E6.jpeg', '9500.00', 1, 0, 1618888431, 1618888431, 1, 1),
(19, 14, 'SPALDING 斯伯丁 SGT 深溝柔軟膠 - 星際藍 籃球 7號', '<p>● SGT 深溝柔軟膠系列</p>\r\n\r\n<p>● 7號</p>\r\n\r\n<p>● 材質：柔軟橡膠</p>\r\n\r\n<p>● 適合室外及一般場地</p>\r\n', '/products/1618893878-75A596B7CD-SP-6062126.jpeg', '550.00', 1, 0, 1618893878, 1618893878, 1, 1),
(20, 14, '瑜珈八字繩 拉力繩 8字彈力繩 彈力帶 居家運動健身(單入)', '<p>※ 加厚乳膠管,彈性佳,拉力強</p>\r\n\r\n<p>※ 高密度環保海綿,舒適綿密</p>\r\n\r\n<p>※ 多功能,適用多個部位鍛鍊</p>\r\n', '/products/1618894030-p0834210795094-item-cfdcxf4x0700x0700-m.jpeg', '70.00', 1, 0, 1618894004, 1618894030, 1, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
                        `id` int(11) NOT NULL,
                        `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                        `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
                        `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                        `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
                        `status` smallint(6) NOT NULL DEFAULT '10',
                        `created_at` int(11) NOT NULL,
                        `updated_at` int(11) NOT NULL,
                        `last_login_at` int(11) DEFAULT NULL,
                        `admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password`, `balance`, `status`, `created_at`, `updated_at`, `last_login_at`, `admin`) VALUES
(1, 'admin', 'CSLPkOFLBErwQOgQx6sasbueWU_M_cuv', '$2y$13$enRERdlY/BFKq4ahvgRhIuVvc0vDuoM6TXJFTcr6rv0Y6MwN8YKeS', '0.00', 10, 1617781795, 1618887612, 1618887612, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `cart_items`
--
ALTER TABLE `cart_items`
    ADD PRIMARY KEY (`id`),
  ADD KEY `idx-cart_items-product_id` (`product_id`),
  ADD KEY `idx-cart_items-created_by` (`created_by`);

--
-- 資料表索引 `cash_flow`
--
ALTER TABLE `cash_flow`
    ADD PRIMARY KEY (`id`),
  ADD KEY `idx-cash_flow-created_by` (`created_by`);

--
-- 資料表索引 `categories`
--
ALTER TABLE `categories`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- 資料表索引 `migration`
--
ALTER TABLE `migration`
    ADD PRIMARY KEY (`version`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
    ADD PRIMARY KEY (`id`),
  ADD KEY `idx-orders-created_by` (`created_by`);

--
-- 資料表索引 `order_items`
--
ALTER TABLE `order_items`
    ADD PRIMARY KEY (`id`),
  ADD KEY `idx-order_items-product_id` (`product_id`),
  ADD KEY `idx-order_items-order_id` (`order_id`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
    ADD PRIMARY KEY (`id`),
  ADD KEY `idx-products-created_by` (`created_by`),
  ADD KEY `idx-products-updated_by` (`updated_by`),
  ADD KEY `idx-products-category_id` (`category_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cart_items`
--
ALTER TABLE `cart_items`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cash_flow`
--
ALTER TABLE `cash_flow`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `categories`
--
ALTER TABLE `categories`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_items`
--
ALTER TABLE `order_items`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `cart_items`
--
ALTER TABLE `cart_items`
    ADD CONSTRAINT `fk-cart_items-created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-cart_items-product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- 資料表的限制式 `cash_flow`
--
ALTER TABLE `cash_flow`
    ADD CONSTRAINT `fk-cash_flow-created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- 資料表的限制式 `orders`
--
ALTER TABLE `orders`
    ADD CONSTRAINT `fk-orders-created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- 資料表的限制式 `order_items`
--
ALTER TABLE `order_items`
    ADD CONSTRAINT `fk-order_items-order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-order_items-product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- 資料表的限制式 `products`
--
ALTER TABLE `products`
    ADD CONSTRAINT `fk-products-category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-products-created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-products-updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;