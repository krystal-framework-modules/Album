
CREATE TABLE `users_album` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `file` varchar(255),

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);