-- CREATE DATABASE SCRIPT



-- Crear la tabla 'areas'
CREATE TABLE `areas` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
);

-- Crear la tabla 'roles'
CREATE TABLE `roles` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) UNIQUE NOT NULL,
    `description` TEXT NULL,
    `permissions` JSON NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
);

-- Crear la tabla 'users'
CREATE TABLE `users` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(255) NULL,
    `cellphone` VARCHAR(255) NULL,
    `gender` ENUM('male', 'female', 'other') NULL,
    `bio` TEXT NULL,
    `profile_picture` VARCHAR(255) NULL,
    `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `area_id` BIGINT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL,
    FOREIGN KEY (`area_id`) REFERENCES `areas`(`id`) ON DELETE CASCADE
);

-- Crear la tabla 'user_roles' para la relación muchos a muchos entre 'users' y 'roles'
CREATE TABLE `user_roles` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `role_id` BIGINT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE CASCADE
);

-- Crear la tabla 'processes'
CREATE TABLE `processes` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NULL,
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `owner_id` BIGINT UNSIGNED NOT NULL,
    `expiration_date` DATE NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`owner_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

-- Crear la tabla 'process_role' para la relación muchos a muchos entre 'processes' y 'roles'
CREATE TABLE `process_role` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `process_id` BIGINT UNSIGNED NOT NULL,
    `role_id` BIGINT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`process_id`) REFERENCES `processes`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE CASCADE
);

-- Crear la tabla 'process_user' para la relación muchos a muchos entre 'processes' y 'users'
CREATE TABLE `process_user` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `process_id` BIGINT UNSIGNED NOT NULL,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`process_id`) REFERENCES `processes`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

-- Crear la tabla 'isos'
CREATE TABLE `isos` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NULL,
    `file_path` VARCHAR(255) NOT NULL,
    `process_id` BIGINT UNSIGNED NOT NULL,
    `expiration_date` DATE NOT NULL,
    `status` ENUM('active', 'inactive', 'archived') DEFAULT 'active',
    `version` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`process_id`) REFERENCES `processes`(`id`) ON DELETE CASCADE
);

-- Crear la tabla 'user_iso' para la relación muchos a muchos entre 'users' y 'isos'
CREATE TABLE `user_iso` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `iso_id` BIGINT UNSIGNED NOT NULL,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`iso_id`) REFERENCES `isos`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

-- Crear la tabla 'task_iso' para la relación muchos a muchos entre 'tasks' y 'isos'
CREATE TABLE `task_iso` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `iso_id` BIGINT UNSIGNED NOT NULL,
    `task_id` BIGINT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`iso_id`) REFERENCES `isos`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`task_id`) REFERENCES `tasks`(`id`) ON DELETE CASCADE
);
-- Crear la tabla 'tasks'
CREATE TABLE `tasks` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` BIGINT UNSIGNED NOT NULL,  -- Relación con la tabla de usuarios
    `process_id` BIGINT UNSIGNED NOT NULL,  -- Relación con la tabla de procesos
    `iso_id` BIGINT UNSIGNED NOT NULL,  -- Relación con la tabla de archivos ISO
    `description` TEXT NOT NULL,  -- Descripción de la tarea
    `due_date` DATE NOT NULL,  -- Fecha de vencimiento de la tarea
    `status` ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',  -- Estado de la tarea
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,  -- Marca de tiempo de creación
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,  -- Marca de tiempo de actualización
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,  -- Relación con usuarios
    FOREIGN KEY (`process_id`) REFERENCES `processes`(`id`) ON DELETE CASCADE,  -- Relación con procesos
    FOREIGN KEY (`iso_id`) REFERENCES `isos`(`id`) ON DELETE CASCADE  -- Relación con archivos ISO
);

-- Crear la tabla 'process_iso' para la relación muchos a muchos entre 'processes' y 'isos'
CREATE TABLE `process_iso` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `process_id` BIGINT UNSIGNED NOT NULL,
    `iso_id` BIGINT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`process_id`) REFERENCES `processes`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`iso_id`) REFERENCES `isos`(`id`) ON DELETE CASCADE
);

CREATE TABLE `comments` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `iso_id` BIGINT UNSIGNED DEFAULT NULL,
    `process_id` BIGINT UNSIGNED DEFAULT NULL,
    `task_id` BIGINT UNSIGNED DEFAULT NULL,
    `comment` TEXT NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`iso_id`) REFERENCES `isos`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`process_id`) REFERENCES `processes`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`task_id`) REFERENCES `tasks`(`id`) ON DELETE CASCADE
);



CREATE TABLE `iso_versions` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `iso_id` BIGINT UNSIGNED NOT NULL,
    `version_number` VARCHAR(255) NOT NULL,  -- Número de versión del archivo ISO
    `release_date` DATE NOT NULL,            -- Fecha de lanzamiento de la versión
    `file_path` VARCHAR(255) NOT NULL,       -- Ruta al archivo ISO de esta versión
    `changes` TEXT NULL,                     -- Descripción de los cambios realizados
    `status` ENUM('active', 'inactive') DEFAULT 'active',  -- Estado de la versión (por ejemplo, activa o inactiva)
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`iso_id`) REFERENCES `isos`(`id`) ON DELETE CASCADE  -- Relación con la tabla isos
);

-- FIRST INSERTS








INSERT INTO `iso_versions` (`iso_id`, `version_number`, `release_date`, `file_path`, `changes`, `status`, `created_at`, `updated_at`)
VALUES 
(2, 'v1.0', '2025-08-01', '/path/to/iso/file_v1.0.iso', 'Primera versión del archivo ISO.', 'active', NOW(), NOW());

-- Insertar un usuario en la tabla 'users'
INSERT INTO `users` (`name`, `email`, `password`, `phone`, `cellphone`, `gender`, `bio`, `profile_picture`, `is_admin`, `is_active`, `area_id`, `created_at`, `updated_at`)
VALUES 
('Juan Pérez', -- Nombre del usuario
 'juan.perez@example.com', -- Correo electrónico
 '$2y$10$Jv5DQhB6g8PQ9.m9MQth5.rDO5pOAFhVpDl0kQhpLV8JhFwmF6Z6e', -- Contraseña (en formato hashed, en este caso, es un ejemplo)
 '1234567890', -- Teléfono
 '0987654321', -- Celular
 'male', -- Género
 'Desarrollador con experiencia en Laravel', -- Biografía
 'default-profile.jpg', -- Foto de perfil (deberías tener una imagen predeterminada en la ruta)
 1, -- Administrador (1 = es administrador, 0 = no lo es)
 1, -- Usuario activo (1 = activo, 0 = desactivado)
 1, -- Relación con el área (suponiendo que 'area_id = 1' es un área válida)
 NOW(), -- Fecha de creación
 NOW()); -- Fecha de actualización





-- Crear el área (asumiendo que las áreas existen, sino se crea una)
INSERT INTO `areas` (`name`, `description`, `created_at`, `updated_at`)
VALUES 
('Desarrollo', 'Área encargada de todo el desarrollo de software', NOW(), NOW());

-- Insertar roles
INSERT INTO `roles` (`name`, `description`, `permissions`, `created_at`, `updated_at`)
VALUES 
('Administrador', 'Rol de administrador con todos los permisos', '{"create": true, "edit": true, "delete": true}', NOW(), NOW()),
('Usuario', 'Rol estándar de usuario', '{"create": false, "edit": true, "delete": false}', NOW(), NOW());

-- Relacionar al usuario con el rol de "Administrador"
INSERT INTO `user_roles` (`user_id`, `role_id`, `created_at`, `updated_at`)
VALUES 
(2, 1, NOW(), NOW());  -- Suponiendo que el primer usuario tiene ID = 1 y el rol "Administrador" tiene ID = 1


-- Insertar proceso
INSERT INTO `processes` (`name`, `description`, `status`, `owner_id`, `expiration_date`, `created_at`, `updated_at`)
VALUES 
('Proceso de Desarrollo de Software', 'Proceso relacionado con la creación y gestión de software', 'active', 2, '2025-12-31', NOW(), NOW());



-- Insertar usuario con ID 1 (asegúrate de que el área con `area_id = 1` ya exista)
INSERT INTO `users` (`name`, `email`, `password`, `phone`, `cellphone`, `gender`, `bio`, `profile_picture`, `is_admin`, `is_active`, `area_id`, `created_at`, `updated_at`)
VALUES 
('CARLOS AAAAz', 'carlos@example.com', '$2y$10$zEq8gzoL57YRJY4ZqIhHnOP3qDFhEHE6KI7dDCXt6dWUTvPr9.v9m', '123', '0987654321', 'male', 'Biografía de carlos', 'profile_picture.jpg', true, true, 1, NOW(), NOW());




-- Relacionar el proceso con los roles
INSERT INTO `process_role` (`process_id`, `role_id`, `created_at`, `updated_at`)
VALUES 
(2, 1, NOW(), NOW()),  -- Relacionar "Proceso de Desarrollo de Software" con el rol "Administrador"
(2, 2, NOW(), NOW());  -- Relacionar "Proceso de Desarrollo de Software" con el rol "Usuario"

-- Relacionar usuario con el proceso
INSERT INTO `process_user` (`process_id`, `user_id`, `created_at`, `updated_at`)
VALUES 
(2, 3, NOW(), NOW());  -- Relacionar el "Proceso de Desarrollo de Software" con el usuario 1

-- Insertar archivo ISO (este es solo un ejemplo, deberías modificar la ruta del archivo)
INSERT INTO `isos` (`name`, `description`, `file_path`, `process_id`, `expiration_date`, `status`, `version`, `created_at`, `updated_at`)
VALUES 
('ISO 9001:2025', 'Documento ISO de calidad para gestión empresarial', '/path/to/iso/iso9001_2025.pdf', 2, '2025-12-31', 'active', '1.0', NOW(), NOW());

-- Relacionar archivo ISO con el proceso
INSERT INTO `process_iso` (`process_id`, `iso_id`, `created_at`, `updated_at`)
VALUES 
(2, 2, NOW(), NOW());  -- Relacionar el "Proceso de Desarrollo de Software" con el archivo ISO 'ISO 9001:2025'

-- Insertar una tarea
INSERT INTO `tasks` (`user_id`, `process_id`, `iso_id`, `description`, `due_date`, `status`, `created_at`, `updated_at`)
VALUES 
(3, 2, 2, 'Realizar revisión del archivo ISO 9001:2025', '2025-12-01', 'pending', NOW(), NOW());

-- Insertar un comentario sobre un archivo ISO
INSERT INTO `comments` (`user_id`, `iso_id`, `process_id`, `task_id`, `comment`, `created_at`, `updated_at`)
VALUES 
(2, 2, 2, NULL, 'Este archivo ISO requiere una revisión adicional antes de su implementación.', NOW(), NOW());
