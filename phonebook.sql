create table contact(
id int not null auto_increment,
firstname varchar(70) not null,
surname varchar(70) not null,
PRIMARY KEY (id)
)
ENGINE = INNODB;

create table phone(
id int not null auto_increment,
phone varchar(20) not null,
contact_id int,
PRIMARY KEY (id),
FOREIGN KEY (contact_id) REFERENCES contact(id)
)

ENGINE = INNODB;

create table email(
id int not null auto_increment,
email varchar(255) not null,
contact_id int,
PRIMARY KEY (id),
FOREIGN KEY (contact_id) REFERENCES contact(id)
)
ENGINE = INNODB;