drop table ENCLOSEMENT_LOOKUP;
create table ENCLOSEMENT_LOOKUP (id int primary key, description varchar(1000));

drop table TYPE_LOOKUP;
create table TYPE_LOOKUP (id int primary key, description varchar(1000));

drop table ZONING_LOOKUP;
create table ZONING_LOOKUP (id int primary key, description varchar(1000));

drop table CONDITION_LOOKUP;
create table CONDITION_LOOKUP (id int primary key, description varchar(1000));

drop table PROPERTY;
create table PROPERTY (
	id int primary key, 
	square_footage double, 
	description varchar(9999), 
	last_update date,
	type_id int,
	zoning_id int,
	condition_id int,
	foreign key(type_id) references TYPE_LOOKUP(id),
	foreign key(zoning_id) references ZONING_LOOKUP(id),
	foreign key(condition_id) references CONDITION_LOOKUP(id)
	);

drop table ADDRESS;
create table ADDRESS (
	property_id int,
	address varchar(1000),
	foreign key(property_id) references PROPERTY(id)
	);

drop table OWNER;
create table OWNER (
	property_id int,
	name varchar(1000),
	foreign key(property_id) references PROPERTY(id)	
	);
	
drop table PHOTO;
create table PHOTO (
	property_id int,
	url varchar(1000),
	foreign key(property_id) references PROPERTY(id)
	);






