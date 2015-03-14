drop database listhub;
create database listhub;
use listhub;

create table user (
	id int not null auto_increment primary key,
	name varchar(100) not null,
	lastname varchar(100) not null,
	email varchar(100) not null,
	image varchar(200),
	password varchar(50) not null,
	is_admin boolean not null default 0,
	is_active boolean not null default 0,
	created_at datetime not null
);


insert into user (name,lastname,email,password,is_admin,is_active,created_at) value ("Agustin","Ramos","evilnapsis@gmail.com","96f960d318379175afcc47a9ed670bc7958e4f2e",1,1,NOW());

create table priority (
	id int not null auto_increment primary key,
	name varchar(200) not null,
	color varchar(200),
	image varchar(200)
);

insert into priority (name) value ("Normal");
insert into priority (name) value ("Baja");
insert into priority (name) value ("Media");
insert into priority (name) value ("Alta");

create table project (
	id int not null auto_increment primary key,
	name varchar(200) not null,
	description varchar(5000) not null,
	color varchar(500),
	image varchar(500),
	user_id int not null,
	created_at datetime not null,
	foreign key (user_id) references user(id)
);

create table task (
	id int not null auto_increment primary key,
	name varchar(200) not null,
	description varchar(5000) not null,
	start_at varchar(5000) not null,
	finish_at varchar(5000) not null,
	project_id int not null,
	priority_id int not null,
	is_finish boolean not null default 0,
	created_at datetime not null,
	foreign key (project_id) references project(id),
	foreign key (priority_id) references priority(id)
);

alter table task add column is_started_at datetime not null;
alter table task add column is_finished_at datetime not null;

create table tag(
	id int not null auto_increment primary key,
	name varchar(200) not null,
	project_id int not null,
	created_at datetime not null,
	foreign key (project_id) references project(id)
);

create table task_tag(
	task_id int not null,
	tag_id int not null,
	foreign key (task_id) references task(id),
	foreign key (tag_id) references tag(id)
);
