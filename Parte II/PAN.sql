drop table if exists patient;
drop table if exists doctor;
drop table if exists device;
drop table if exists sensor;
drop table if exists reading;
drop table if exists period;
drop table if exists wears;
drop table if exists request;
drop table if exists study;
drop table if exists series;
drop table if exists element;
drop table if exists region;

create table patient
   (patient_number  varchar(255),
    patient_name  varchar(255),
    birthday  time,
    address  varchar(255),
    primary key(patient_number));

create table doctor
   (doctor_number  varchar(255),
    doctor_id  int(10) UNSIGNED NOT NULL AUTO_INCREMENT,

    primary key(doctor_id));

create table device
   (serialnum  int(10),
    manufacturer  varchar(255),
    model varchar(255)
    primary key(serialnum,manufacturer));


create table sensor
   (serialnum  int(10),
    manufacturer  varchar(255),
    model varchar(255),
    primary key(serialnum,manufacturer),
  foreign key(serialnum,manufacturer) references device(serialnum,manufacturer));

create table reading
   (serialnum  int(10),
    manufacturer  varchar(255),
    readdate datetime,
    value float(10,2),
    primary key(serialnum,manufacturer,readdate));


create table reading
   (start  timestamp,
    end  timestamp,
    primary key(start,end));

create table wears
   (start  timestamp,
    end  timestamp,
    patient_number  varchar(255)
    serialnum  int(10),
    manufacturer  varchar(255),
    primary key(start,end,patient_number),
    foreign key(serialnum,manufacturer) references device(serialnum,manufacturer),
    foreign key(start,end) references period(start,end),
    foreign key(patient_number) references patient(patient_number));


create table request
   (request_number  int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    patient_number  varchar(255),
    doctor_id  int(10) UNSIGNED,
    date date,
    primary key(request_number),
    foreign key(patient_number) references patient(patient_number),
    foreign key(doctor_id) references doctor(doctor_id));


create table study
   (request_number  int(10) UNSIGNED NOT NULL,
    request_description  varchar(255),
    date date,
    doctor_id  int(10) UNSIGNED,
    manufacturer  varchar(255),
    serialnum  int(10),
    primary key(request_number,description),
    foreign key(request_number) references request(request_number),
    foreign key(doctor_id) references doctor(doctor_id),
    foreign key(serialnum,manufacturer) references device(serialnum,manufacturer));

create table series
   (series_id  int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    series_name  varchar(255),
    series_base_url  varchar(255),
    request_number  int(10) UNSIGNED NOT NULL,
    request_description  varchar(255),
    date date,
    primary key(series_id),
    foreign key(request_number,request_description) references request(request_number,request_description));

create table element
   (series_id  int(10) UNSIGNED,
    elem_index  int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    primary key(elem_index),
    foreign key(series_id) references serie(series_id));

create table region
   (series_id  int(10) UNSIGNED,
    elem_index  int(10) UNSIGNED,
    x1  int(10) NOT NULL,
    y1  int(10) NOT NULL,
    x2  int(10),
    y2  int(10),

    primary key(series_id,elem_index),
    foreign key(series_id) references serie(series_id));
