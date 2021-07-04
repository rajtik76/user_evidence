DROP DATABASE IF EXISTS `user_evidence`;
CREATE DATABASE `user_evidence` /*!40100 DEFAULT CHARACTER SET utf8 */

create table user_evidence.user
(
    id            int auto_increment primary key,
    user_name     varchar(255)                           not null,
    user_password varchar(255)                           not null,
    administrator tinyint(1) default 0                   not null,
    created_at    datetime   default current_timestamp() not null,
    updated_at    datetime   default current_timestamp() null on update current_timestamp(),
    constraint user_user_name_uindex
        unique (user_name)
);

insert into user_evidence.user (user_name, user_password, administrator) value ('user_evidence',
                                                                                '$2y$10$qguiBKc2H/Mfr3usZwo8IO3eFNhcXHHgCjxogopJUoO8L1k/ysYPW',
                                                                                1);