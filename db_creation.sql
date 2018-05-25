CREATE DATABASE `sandbox` /*!40100 DEFAULT CHARACTER SET utf8 */

create table balance
(
	balance_id int auto_increment
		primary key,
	user_id int not null,
	amount decimal null,
	transaction_id int null,
	created_at datetime default CURRENT_TIMESTAMP null,
	updated_at datetime default CURRENT_TIMESTAMP null,
	deleted_at datetime null
)
engine=InnoDB
;

create table migrations
(
	id int unsigned auto_increment
		primary key,
	migration varchar(255) not null,
	batch int not null
)
engine=InnoDB collate=utf8mb4_unicode_ci
;

create table password_resets
(
	email varchar(255) not null,
	token varchar(255) not null,
	created_at timestamp null
)
engine=InnoDB collate=utf8mb4_unicode_ci
;

create index password_resets_email_index
	on password_resets (email)
;

create table transactions
(
	transaction_id int auto_increment
		primary key,
	description varchar(255) null,
	created_at datetime default CURRENT_TIMESTAMP null,
	updated_at datetime default CURRENT_TIMESTAMP null,
	deleted_at datetime null
)
engine=InnoDB
;

create table users
(
	id int unsigned auto_increment
		primary key,
	name varchar(255) not null,
	email varchar(255) not null,
	password varchar(255) not null,
	remember_token varchar(100) null,
	created_at timestamp null,
	updated_at timestamp null,
	deleted_at timestamp null,
	constraint users_email_unique
		unique (email)
)
engine=InnoDB collate=utf8mb4_unicode_ci
;


