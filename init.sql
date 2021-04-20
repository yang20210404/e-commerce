INSERT INTO `user` (`username`, `auth_key`, `password`, `balance`, `status`, `created_at`, `updated_at`, `last_login_at`, `admin`) VALUES
('admin', 'Mu1Pt4MwR3iLcigx790vnwa0aBL136ZS', '$2y$13$9c7lcUm7GUPP1ALgXBnKOO607GH1.cNQ/E9bOGABsEsvg5ENXkwX.', '0.00', 10, 1618825986, 1618886190, 1618885770, 1);

INSERT INTO `categories` (`name`, `is_delete`) VALUES
('3c產品', 0),
('居家生活', 0),
('運動用品', 0);

INSERT INTO `products` (`category_id`, `name`, `description`, `image`, `price`, `status`, `is_delete`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'ASUS X509JP 15吋筆電(i7-1065G7/MX330/4G/1T HDD+256G SSD/Laptop/冰柱銀)', '<p>X509JP-0161S1065G7 最新第十代i7-1065G7</p>\r\n\r\n<p>4GB DDR4 記憶體 / 1T HDD+256G SSD</p>\r\n\r\n<p>MX330 2GB GDDR5獨顯</p>\r\n\r\n<p>Win10 /冰柱銀</p>\r\n', '/products/1618893782-8F157E583F-Gd-8960376.jpeg', '25000.00', 1, 0, 1618822278, 1618894974, 1, 1),
(1, 'DELL Inspiron 5000 15吋筆電 (i5-1135G7/8G/512G/MX350/Win10/綠)', '<p>15.6吋 FHD 防眩光螢幕</p>\r\n\r\n<p>全新第11代處理器</p>\r\n\r\n<p>全新轉軸設計，散熱更高效</p>\r\n\r\n<p>智能控溫、開蓋即亮、一鍵風扇</p>\r\n\r\n<p>類四窄邊框，金屬機身，體積小巧</p>\r\n', '/products/1618822322-55350E7C67-Gd-9244150.jpeg', '37000.00', 1, 0, 1618822322, 1618894996, 1, 1),
(1, '2020 MacBook Pro 13.3吋/1.4GHZ 第八代 i5 /8GB/256GB', '<p>1.4GHz 4核 8 代i5</p>\r\n\r\n<p>觸控欄及 Touch ID</p>\r\n\r\n<p>8GB LPDDR3 記憶體</p>\r\n\r\n<p>256GB SSD</p>\r\n\r\n<p>13 吋 Retina 顯示器</p>\r\n', '/products/1618822340-F30629149C-SP-8922617.jpeg', '40000.00', 1, 0, 1618822340, 1618895025, 1, 1),
(2, '居家生活 科羅旺本色亞麻綠布紋皮沙發組 (1+2+3人)', '<p>椅架採用優質紐西蘭松木，堅固又耐用！</p>\r\n\r\n<p>內裡採用高密度泡棉+絲棉，柔軟又舒適！</p>\r\n\r\n<p>外材採用高級亞麻布紋皮包覆，美觀又親膚！</p>\r\n\r\n<p>享免組裝為您配送到府服務哦~</p>\r\n', '/products/1618888340-C6AB6B170435B50E73AF1D4D7F3A843DEE30EDD2.jpeg', '12750.00', 1, 0, 1618888340, 1618888340, 1, 1),
(2, 'PUSH!居家生活用品手壓式手捲真空壓縮袋旅行便攜袋套裝組合(1組6入裝)S59', '<p>行李箱、衣櫃、抽屜、輕鬆整理可反覆使用</p>\r\n\r\n<p>超強密封性節省空間75％，防塵防潮防蟲</p>\r\n\r\n<p>非對稱拉鍊更好密封,精選複合材質柔韌耐用</p>\r\n\r\n<p>精巧設計出氣口，長久不回氣</p>\r\n', '/products/1618888391-EF4CA557BF-SP-6408219.jpeg', '400.00', 1, 0, 1618888391, 1618888391, 1, 1),
(2, '居家生活 溫德2.7尺橡木紋六斗櫃', '<p>外觀簡約橡木紋，散發古典光采</p>\r\n\r\n<p>鋼珠滑軌抽屜結構，滑順好推拉</p>\r\n\r\n<p>高級防蛀木板，有穩定性的結構</p>\r\n\r\n<p>復古式皮箱造型+烤漆鋁條</p>\r\n\r\n<p>免組立/專人到府組裝</p>\r\n', '/products/1618888431-29003543817D23D3FFE515B77ACA8C39916989E6.jpeg', '9500.00', 1, 0, 1618888431, 1618888431, 1, 1),
(3, 'SPALDING 斯伯丁 SGT 深溝柔軟膠 - 星際藍 籃球 7號', '<p>● SGT 深溝柔軟膠系列</p>\r\n\r\n<p>● 7號</p>\r\n\r\n<p>● 材質：柔軟橡膠</p>\r\n\r\n<p>● 適合室外及一般場地</p>\r\n', '/products/1618893878-75A596B7CD-SP-6062126.jpeg', '550.00', 1, 0, 1618893878, 1618893878, 1, 1),
(3, '瑜珈八字繩 拉力繩 8字彈力繩 彈力帶 居家運動健身(單入)', '<p>※ 加厚乳膠管,彈性佳,拉力強</p>\r\n\r\n<p>※ 高密度環保海綿,舒適綿密</p>\r\n\r\n<p>※ 多功能,適用多個部位鍛鍊</p>\r\n', '/products/1618894030-p0834210795094-item-cfdcxf4x0700x0700-m.jpeg', '70.00', 1, 0, 1618894004, 1618894030, 1, 1);