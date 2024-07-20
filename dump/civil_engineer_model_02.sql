-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/07/2024 às 22:50
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- START TRANSACTION;
-- SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `civil_engineer`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `response` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `assessment` float NOT NULL,
  `short_description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `card_name` varchar(255) NOT NULL,
  `card_bank` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `installments` int(16) NOT NULL,
  `installments_amount` float NOT NULL,
  `total_value` float NOT NULL,
  `status` varchar(255) NOT NULL,
  `mp_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`mp_json`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `payment_projects`
--

CREATE TABLE `payment_projects` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_payment` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `is_discount` tinyint(4) NOT NULL,
  `price` float NOT NULL,
  `discount_percent` int(11) NOT NULL,
  `is_download` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `posts_instagram`
--

CREATE TABLE `posts_instagram` (
  `id` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `discount_percent` float NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `square_meters` float NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `bedrooms` int(11) NOT NULL,
  `garages` int(11) NOT NULL,
  `is_discount` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `project_carousel`
--

CREATE TABLE `project_carousel` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `project_files`
--

CREATE TABLE `project_files` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `reimbursement`
--

CREATE TABLE `reimbursement` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_payment` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `motive` text NOT NULL,
  `response` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_user_type` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_confirm` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `id_user_type`, `name`, `email`, `password`, `is_confirm`, `created_at`) VALUES
(1, 1, 'Admin', 'master@admin.com', '0192023a7bbd73250516f069df18b500', 1, '2024-06-12 22:58:46');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`permissions`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `permissions`, `created_at`) VALUES
(1, 'Administrador', '{\"home\":[\"READ\"],\"users\":[\"READ\",\"INSERT\",\"UPDATE\",\"DELETE\"],\"projects\":[\"READ\",\"INSERT\",\"UPDATE\",\"DELETE\"],\"team\":[\"READ\",\"INSERT\",\"UPDATE\",\"DELETE\"],\"payments\":[\"READ\"],\"reimbursement\":[\"READ\"],\"feedbacks\":[\"READ\",\"INSERT\",\"UPDATE\",\"DELETE\"],\"posts_instagram\":[\"READ\",\"INSERT\",\"UPDATE\",\"DELETE\"],\"faq\":[\"READ\",\"INSERT\",\"UPDATE\",\"DELETE\"]}', '2024-06-11 13:32:15'),
(2, 'Cliente', '{}', '2024-06-11 13:32:28');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_user` (`id_user`);

--
-- Índices de tabela `payment_projects`
--
ALTER TABLE `payment_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_payment_project` (`id_user`),
  ADD KEY `payment_project` (`id_project`),
  ADD KEY `payment` (`id_payment`);

--
-- Índices de tabela `posts_instagram`
--
ALTER TABLE `posts_instagram`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Índices de tabela `project_carousel`
--
ALTER TABLE `project_carousel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_images_carousel` (`id_project`);

--
-- Índices de tabela `project_files`
--
ALTER TABLE `project_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_files` (`id_project`);

--
-- Índices de tabela `reimbursement`
--
ALTER TABLE `reimbursement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_payment_reimbursement` (`id_user`),
  ADD KEY `payment_reimbursement` (`id_payment`);

--
-- Índices de tabela `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_user` (`id_user_type`);

--
-- Índices de tabela `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `payment_projects`
--
ALTER TABLE `payment_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `posts_instagram`
--
ALTER TABLE `posts_instagram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `project_carousel`
--
ALTER TABLE `project_carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `project_files`
--
ALTER TABLE `project_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `reimbursement`
--
ALTER TABLE `reimbursement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payment_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `payment_projects`
--
ALTER TABLE `payment_projects`
  ADD CONSTRAINT `payment` FOREIGN KEY (`id_payment`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_project` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_payment_project` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `project_carousel`
--
ALTER TABLE `project_carousel`
  ADD CONSTRAINT `project_images_carousel` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id`);

--
-- Restrições para tabelas `project_files`
--
ALTER TABLE `project_files`
  ADD CONSTRAINT `project_files` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id`);

--
-- Restrições para tabelas `reimbursement`
--
ALTER TABLE `reimbursement`
  ADD CONSTRAINT `payment_reimbursement` FOREIGN KEY (`id_payment`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_payment_reimbursement` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `type_user` FOREIGN KEY (`id_user_type`) REFERENCES `user_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
