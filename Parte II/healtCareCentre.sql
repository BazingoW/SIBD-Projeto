drop table if exists Patient;
drop table if exists Doctor;
drop table if exists Device;
drop table if exists Sensor;
drop table if exists Reading;
drop table if exists Period;
drop table if exists Wears;
drop table if exists Request;
drop table if exists Study;
drop table if exists Series;
drop table if exists Element;
drop table if exists Region;

create table Patient
	(patient_number	varchar(255),
	 patient_name	varchar(255),
	 birthday	date,
	 address	varchar(255)
	 primary key(patient_number));

create table Doctor
	(patient_number	varchar(255),
	 doctor_id	int(10) UNSIGNED,
	 primary key(doctor_id),
	 foreign key (patient_number) references Patient(patient_number));

create table Device
	(serialnum int(10) UNSIGNED,
	 manufacturer varchar(255),
	 model varchar(255),
	 primary key(serialnum, manufacturer));

create table Sensor
	(serialnum int(10) UNSIGNED,
	 manufacturer varchar(255),
	 units varchar(255),
	 primary key(serialnum, manufacturer),
	 foreign key(serialnum, manufacturer) references Device(serialnum, manufacturer));

create table Reading
	(serialnum int(10) UNSIGNED,
	 manufacturer varchar(255),
	 read_date datetime,
	 value float(10,2),
	 primary key(serialnum, manufacturer),
	 foreign key(serialnum, manufacturer) references Sensor(serialnum, manufacturer));

create table Period
	(start_date datetime,
	 end_date datetime,
	 primary key(start_date, end_date));

create table Wears
	(start_date datetime,
	 end_date datetime,
	 patient_number varchar(255),
	 serialnum int(10) UNSIGNED,
	 manufacturer varchar(255),
	 primary key(start_date, end_date, patient_number),
	 foreign key(start_date, end_date) references Period(start_date, end_date),
	 foreign key(patient_number) references Patient(patient_number),
	 foreign key(serialnum, manufacturer) references Device(serialnum, manufacturer));

create table Request
	(request_number int(10) UNSIGNED,
	 patient_number varchar(255),
	 doctor_id int(10) UNSIGNED,
	 request_date date,
	 primary key(request_number),
	 foreign key(patient_number) references Patient(patient_number),
	 foreign key(doctor_id) references Doctor(doctor_id));

create table Study
	(request_number int(10) UNSIGNED,
	 description varchar(255),
	 study_date date,
	 doctor_id int(10) UNSIGNED,
	 manufacturer varchar(255),
	 serialnum int(10) UNSIGNED,
	 primary key(request_number, description),
	 foreign key(request_number) references Request(request_number),
	 foreign key(doctor_id) references Doctor(doctor_id),
	 foreign key(manufacturer, serialnum) references Device(manufacturer, serialnum));

create table Series
	(series_id int(10) UNSIGNED,
	 series_name varchar(255),
	 base_url varchar(255),
	 request_number int(10) UNSIGNED,
	 description varchar(255),
	 primary key(series_id)
	 foreign key(request_number, description) references Study(request_number, description));

create table Element
	(series_id int(10) UNSIGNED,
	 elem_index int(10) UNSIGNED AUTO_INCREMENT,
	 primary key(series_id, elem_index),
	 foreign key(series_id) references Series(series_id));

create table Region
	(series_id int(10) UNSIGNED,
	 elem_index int(10) UNSIGNED,
	 x1 float(2,1),
	 y1 float(2,1),
	 x2 float(2,1),
	 y2 float(2,1),
	 primary key(series_id, elem_index, x1, y1, x2, y2)
	 foreign key(series_id) references Element(series_id, elem_index));















