insert into Patient values ('P-1', 'John Smith', '1990-07-01', 'London');
insert into Patient values ('P-2', 'Roger Smith', '1987-05-05', 'Liverpool');
insert into Patient values ('P-3', 'James Bond', '1975-08-30', 'Bristol');
insert into Patient values ('P-4', 'Kelly Fernandez', '1985-10-06', 'London');
insert into Patient values ('P-5', 'Liz Wang', '1987-12-25', 'Birmingham');
insert into Patient values ('P-6', 'Richard Gun', '1965-11-15', 'Manchester');
insert into Patient values ('P-7', 'Gisele Joly', '1950-02-07', 'Manchester');
insert into Patient values ('P-8', 'Isaac Newton', '1966-04-09', 'Sheffield');
insert into Patient values ('P-9', 'Lilian Holmes', '1955-06-20', 'Liverpool');
insert into Patient values ('P-10', 'Wellington Ramirez', '1959-09-14', 'London');

insert into Doctor values ('P-1', 'D-101');
insert into Doctor values ('P-2', 'D-102');
insert into Doctor values ('P-3', 'D-103');
insert into Doctor values ('P-4', 'D-104');
insert into Doctor values ('P-5', 'D-105');
insert into Doctor values ('P-6', 'D-106');
insert into Doctor values ('P-7', 'D-107');
insert into Doctor values ('P-8', 'D-108');
insert into Doctor values ('P-9', 'D-109');
insert into Doctor values ('P-10', 'D-110');

insert into Device values ('S1', 'Siemens', 's6373');
insert into Device values ('B1', 'Bosch', 'b7566');
insert into Device values ('M1', 'Medtronic', 'm9800');
insert into Device values ('M2', 'Medtronic', 'm7658');
insert into Device values ('M3', 'Medtronic', 'm3333');
insert into Device values ('M4', 'Medtronic', 'm3333');
insert into Device values ('M5', 'Medtronic', 'm9800');
insert into Device values ('S2', 'Siemens', 's3421');
insert into Device values ('B2', 'Bosch', 'b8765');
insert into Device values ('T1', 'Thermotec', 't2990');
insert into Device values ('T2', 'Thermotec', 't2990');
insert into Device values ('H1', 'Honeywell', 'h6776');
insert into Device values ('H2', 'Honeywell', 'h4444');
insert into Device values ('E1', 'Envitec', 'e5876');
insert into Device values ('E2', 'Envitec', 'e5876');

insert into Sensor values ('S1', 'Siemens', 'mg/dL');
insert into Sensor values ('B1', 'Bosch', 'g/dL');
insert into Sensor values ('M1', 'Medtronic', 'mg/dL');
insert into Sensor values ('M2', 'Medtronic', 'g/dL');
insert into Sensor values ('M3', 'Medtronic', 'mg/dL');
insert into Sensor values ('M4', 'Medtronic', 'mg/dL');
insert into Sensor values ('M5', 'Medtronic', 'mg/dL');
insert into Sensor values ('S2', 'Siemens', 'g/dL');
insert into Sensor values ('B2', 'Bosch', 'mg/dL');
insert into Sensor values ('T1', 'Thermotec', 'mg/dL');
insert into Sensor values ('T2', 'Thermotec', 'mg/dL');
insert into Sensor values ('H1', 'Honeywell', 'mg/dL');
insert into Sensor values ('H2', 'Honeywell', 'g/dL');
insert into Sensor values ('E1', 'Envitec', 'mg/dL');
insert into Sensor values ('E2', 'Envitec', 'mg/dL');

insert into Reading values ('S1', 'Siemens', '2017-09-01 18:20:00', 7.8);
insert into Reading values ('S1', 'Siemens', '2017-09-01 18:21:00', 10.5);
insert into Reading values ('B1', 'Bosch', '2017-10-15 10:17:55', 20.75);
insert into Reading values ('M1', 'Medtronic', '2017-07-31 15:25:45', 217);
insert into Reading values ('M1', 'Medtronic', '2017-08-7 08:54:07', 225);
insert into Reading values ('M2', 'Medtronic', '2017-10-31 09:57:35', 5.7);
insert into Reading values ('M2', 'Medtronic', '2017-02-17 11:47:59', 6.7);
insert into Reading values ('M3', 'Medtronic', '2016-12-25 20:20:20', 300);
insert into Reading values ('M4', 'Medtronic', '2017-01-20 23:17:05', 190);
insert into Reading values ('M5', 'Medtronic', '2017-03-29 21:40:47', 200);
insert into Reading values ('S2', 'Siemens', '2017-10-29 19:20:27', 3.2);
insert into Reading values ('B2', 'Bosch', '2017-09-14 10:39:06', 315);
insert into Reading values ('T1', 'Thermotec', '2017-10-28 07:44:21', 215);
insert into Reading values ('T2', 'Thermotec', '2016-04-06 09:45:17', 235);
insert into Reading values ('H1', 'Honeywell', '2017-10-31 12:55:59', 175);
insert into Reading values ('H2', 'Honeywell', '2017-04-17 14:32:58', 17.1);
insert into Reading values ('E1', 'Envitec', '2017-01-30 16:27:44', 255);
insert into Reading values ('E2', 'Envitec', '2017-05-29 19:42:28', 265);

insert into Period values ('2017-04-01 10:00:01', '2017-10-31 17:18:19');
insert into Period values ('2017-01-17 08:11:17', '2017-10-25 19:00:91');
insert into Period values ('2016-01-02 10:08:00', '2999-12-31 00:00:00');
insert into Period values ('2017-03-04 12:34:55', '2999-12-31 00:00:00');
insert into Period values ('2015-05-08 22:30:05', '2999-12-31 00:00:00');
insert into Period values ('2016-02-26 13:08:45', '2999-12-31 00:00:00');
insert into Period values ('2016-07-31 15:03:41', '2017-09-17 13:00:07');
insert into Period values ('2016-08-26 21:00:23', '2017-02-23 17:55:42');
insert into Period values ('2017-04-06 12:07:44', '2999-12-31 00:00:00');
insert into Period values ('2016-01-12 00:00:00', '2017-11-02 07:15:18');
insert into Period values ('2017-05-10 11:12:15', '2999-12-31 00:00:00');

insert into Wears values ('2017-04-01 10:00:01', '2017-10-31 17:18:19', )










