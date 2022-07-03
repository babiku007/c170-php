SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `gm_game_map` (
  `id` int NOT NULL,
  `target` tinyint NOT NULL,
  `player_id` int NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `max` tinyint NOT NULL DEFAULT '100',
  `min` tinyint NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0:已結束,1:未結束'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `gm_player` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `gm_round` (
  `id` int NOT NULL,
  `game_map_id` int NOT NULL,
  `guess` tinyint NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `gm_game_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_id` (`player_id`);

ALTER TABLE `gm_player`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

ALTER TABLE `gm_round`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_map_id` (`game_map_id`);


ALTER TABLE `gm_game_map`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `gm_player`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `gm_round`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;


ALTER TABLE `gm_game_map`
  ADD CONSTRAINT `gm_game_map_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `gm_player` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `gm_round`
  ADD CONSTRAINT `gm_round_ibfk_1` FOREIGN KEY (`game_map_id`) REFERENCES `gm_game_map` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
