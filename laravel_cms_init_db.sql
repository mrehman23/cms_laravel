-- --------------------------------------------------------

--
-- Table structure for table `kd_auth_assignment`
--

CREATE TABLE `kd_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kd_auth_assignment`
--

INSERT INTO `kd_auth_assignment` (`item_name`, `user_id`, `created_at`, `updated_at`) VALUES
('adm_user_management', 1, 1630344822, NULL),
('general_permissions', 1, 1630345210, NULL),
('super_permission', 1, 1630350436, NULL),
('general_permissions', 2, 1635800552, NULL),
('super_permission', 2, 1635800573, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kd_auth_item`
--

CREATE TABLE `kd_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int NOT NULL,
  `description` varchar(4000) DEFAULT NULL,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  `user_dashboard` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kd_auth_item`
--

INSERT INTO `kd_auth_item` (`name`, `type`, `description`, `created_at`, `updated_at`, `user_dashboard`) VALUES
('adm_user_management', 2, NULL, 1630313248, 1630313248, NULL),
('general_permissions', 2, 'contain all general permissions', 1630316325, 1630316325, NULL),
('super_permission', 2, NULL, 1630321565, 1630321565, NULL),
('admin_permissions', 2, 'Admin User permissions...', 1640330844, 1640330844, NULL),
('setting_permissions', 2, NULL, 1652876738, 1652876738, NULL),
('pages_permissions', 2, NULL, 1652883395, 1652883395, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kd_auth_item_child`
--

CREATE TABLE `kd_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kd_auth_item_child`
--

INSERT INTO `kd_auth_item_child` (`parent`, `child`) VALUES
('adm_user_management', 'kd.assignment.assign'),
('adm_user_management', 'kd.assignment.index'),
('adm_user_management', 'kd.assignment.revoke'),
('adm_user_management', 'kd.assignment.view'),
('adm_user_management', 'kd.permission.assign'),
('adm_user_management', 'kd.permission.create'),
('adm_user_management', 'kd.permission.delete'),
('adm_user_management', 'kd.permission.edit'),
('adm_user_management', 'kd.permission.index'),
('adm_user_management', 'kd.permission.remove'),
('adm_user_management', 'kd.permission.store'),
('adm_user_management', 'kd.permission.update'),
('adm_user_management', 'kd.permission.view'),
('adm_user_management', 'kd.user.activate'),
('adm_user_management', 'kd.user.create'),
('adm_user_management', 'kd.user.delete'),
('adm_user_management', 'kd.user.edit'),
('adm_user_management', 'kd.user.index'),
('adm_user_management', 'kd.user.store'),
('adm_user_management', 'kd.user.update'),
('adm_user_management', 'kd.user.view'),
('general_permissions', 'admin.change.password.form'),
('general_permissions', 'home'),
('general_permissions', 'logout'),
('general_permissions', 'admin.change.password'),
('super_permission', 'admin.home'),
('super_permission', 'admin.client.create'),
('super_permission', 'admin.client.index'),
('super_permission', 'admin.department.create'),
('super_permission', 'admin.department.index'),
('super_permission', 'admin.finance.generalvoucher'),
('super_permission', 'admin.finance.index'),
('super_permission', 'admin.im.create'),
('super_permission', 'admin.im.index'),
('super_permission', 'admin.inv.hit'),
('super_permission', 'admin.inv.index'),
('super_permission', 'admin.jo.create'),
('super_permission', 'admin.jo.index'),
('super_permission', 'admin.jo.invoice'),
('super_permission', 'admin.po.create'),
('super_permission', 'admin.po.index'),
('super_permission', 'admin.po.invoice'),
('super_permission', 'admin.pro.dept.assign'),
('super_permission', 'admin.pro.dept.receive'),
('super_permission', 'admin.profile.changepassword'),
('super_permission', 'admin.profile.index'),
('super_permission', 'admin.reports.r1'),
('super_permission', 'admin.reports.r2'),
('super_permission', 'admin.shipment.index'),
('super_permission', 'admin.shipment.invoice'),
('super_permission', 'admin.shipment.process'),
('super_permission', 'admin.vendor.create'),
('super_permission', 'admin.vendor.index'),
('super_permission', 'admin.pro.lab.assign'),
('super_permission', 'admin.pro.lab.receive'),
('super_permission', 'admin.pro.dept.index'),
('super_permission', 'adm_user_management'),
('super_permission', 'finance_permissions'),
('super_permission', 'general_permissions'),
('super_permission', 'hr_permissions'),
('super_permission', 'department_permissions'),
('super_permission', 'floor_incharge_permissions'),
('super_permission', 'gm_permissions'),
('super_permission', 'admin.im.view'),
('super_permission', 'admin.im.edit'),
('super_permission', 'admin.im.itemtype'),
('super_permission', 'admin.im.itcreate'),
('super_permission', 'admin.im.itedit'),
('super_permission', 'admin.im.itstore'),
('super_permission', 'admin.im.itupdate'),
('super_permission', 'admin.im.itdelete'),
('super_permission', 'admin.im.update'),
('super_permission', 'admin.im.delete'),
('super_permission', 'admin.im.prosetup'),
('super_permission', 'admin.im.pscreate'),
('super_permission', 'admin.im.psdelete'),
('super_permission', 'admin.im.psedit'),
('super_permission', 'admin.im.psstore'),
('super_permission', 'admin.im.psupdate'),
('super_permission', 'admin.im.itype_lov'),
('super_permission', 'admin.client.delete'),
('super_permission', 'admin.client.edit'),
('super_permission', 'admin.client.update'),
('super_permission', 'admin.vendor.delete'),
('super_permission', 'admin.vendor.edit'),
('super_permission', 'admin.vendor.update'),
('super_permission', 'admin.department.delete'),
('super_permission', 'admin.department.edit'),
('super_permission', 'admin.department.update'),
('super_permission', 'setting_permissions'),
('setting_permissions', 'admin.settings.index'),
('setting_permissions', 'admin.settings.store'),
('super_permission', 'pages_permissions'),
('pages_permissions', 'admin.pages.create'),
('pages_permissions', 'admin.pages.edit'),
('pages_permissions', 'admin.pages.index'),
('pages_permissions', 'admin.pages.store'),
('pages_permissions', 'admin.pages.update'),
('pages_permissions', 'admin.pages.delete');

--
-- Dumping data for table `kd_users`
--

INSERT INTO `kd_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mati', 'mati@gmail.com', NULL, '$2y$10$lglPTWB13UlB.RwnWiL7JOopRlpeZwGdvV.OdYKaAAl.8MyMB8AFu', NULL, '2022-05-18 06:15:07', '2022-05-18 06:15:07'),
(2, 'Waqas Ahmed', 'waqas@gmail.com', NULL, '$2y$10$3Iax8H/yrv.kgcod0XZr4uYPTIpMUEuZs.N9CNHJE8PpRk9lSVA4y', NULL, '2022-05-18 06:15:55', '2022-05-18 06:15:55');
COMMIT;
