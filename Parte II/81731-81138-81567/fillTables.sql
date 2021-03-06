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
insert into Device values ('A1', 'Airsense', 'a9800');
insert into Device values ('A2', 'Airsense', 'a7658');
insert into Device values ('A3', 'Airsense', 'a3333');
insert into Device values ('A4', 'Airsense', 'a3333');
insert into Device values ('A5', 'Airsense', 'a9800');
insert into Device values ('S2', 'Siemens', 's3421');
insert into Device values ('B2', 'Bosch', 'b8765');
insert into Device values ('T1', 'Thermotec', 't2990');
insert into Device values ('T2', 'Thermotec', 't2990');
insert into Device values ('H1', 'Honeywell', 'h6776');
insert into Device values ('H2', 'Honeywell', 'h4444');
insert into Device values ('E1', 'Envitec', 'e5876');
insert into Device values ('E2', 'Envitec', 'e5876');
insert into Device values ('M1', 'Medtronic', 'm7891');
insert into Device values ('M2', 'Medtronic', 'm4536');
insert into Device values ('M3', 'Medtronic', 'm6543');
insert into Device values ('M4', 'Medtronic', 'm9023');
insert into Device values ('M5', 'Medtronic', 'm7123');
insert into Device values ('S3', 'Siemens', 's4040');
insert into Device values ('S4', 'Siemens', 's3131');
insert into Device values ('S5', 'Siemens', 's1111');
insert into Device values ('B3', 'Bosch', 'b4589');
insert into Device values ('B4', 'Bosch', 'b3232');
insert into Device values ('B5', 'Bosch', 'b4455');
insert into Device values ('I1', 'Iberdata', 'i3030');
insert into Device values ('I2', 'Iberdata', 'i9009');
insert into Device values ('I3', 'Iberdata', 'i7050');
insert into Device values ('I4', 'Iberdata', 'i3553');
insert into Device values ('I5', 'Iberdata', 'i7005');
insert into Device values ('I6', 'Iberdata', 'i6531');

insert into Sensor values ('S1', 'Siemens', 'LDL cholesterol in mg/dL');
insert into Sensor values ('B1', 'Bosch', 'Creatinine in mg/L');
insert into Sensor values ('A1', 'Airsense', 'HDL cholesterol in mg/dL');
insert into Sensor values ('A2', 'Airsense', 'Hemoglobin in g/dL');
insert into Sensor values ('A3', 'Airsense', 'Creatinine in mg/L');
insert into Sensor values ('A4', 'Airsense', 'Creatinine in mg/L');
insert into Sensor values ('A5', 'Airsense', 'Hemoglobin in g/dL');
insert into Sensor values ('S2', 'Siemens', 'HDL cholesterol in mg/dL');
insert into Sensor values ('B2', 'Bosch', 'LDL cholesterol in mg/dL');
insert into Sensor values ('T1', 'Thermotec', 'Temperature in ºC');
insert into Sensor values ('T2', 'Thermotec', 'Temperature in ºC');
insert into Sensor values ('H1', 'Honeywell', 'Glucose level in mmol/L');
insert into Sensor values ('H2', 'Honeywell', 'Glucose level in mmol/L');
insert into Sensor values ('E1', 'Envitec', 'Hemoglobin in g/dL');
insert into Sensor values ('E2', 'Envitec', 'Creatinine in mg/L');

insert into Reading values ('S1', 'Siemens', '2017-10-30 18:20:00', 217);
insert into Reading values ('S1', 'Siemens', '2017-10-30 18:21:00', 225);
insert into Reading values ('S1', 'Siemens', '2017-10-15 13:12:11', 220);
insert into Reading values ('S1', 'Siemens', '2017-10-17 20:08:21', 201);
insert into Reading values ('B1', 'Bosch', '2017-10-15 10:17:55', 10.1);
insert into Reading values ('A1', 'Airsense', '2017-07-31 15:25:45', 77);
insert into Reading values ('A1', 'Airsense', '2017-08-07 08:54:07', 100);
insert into Reading values ('A2', 'Airsense', '2017-10-31 09:57:35', 12.8);
insert into Reading values ('A2', 'Airsense', '2017-03-17 11:47:59', 15.7);
insert into Reading values ('A3', 'Airsense', '2016-12-25 20:20:20', 8.2);
insert into Reading values ('A4', 'Airsense', '2017-01-20 23:17:05', 11.8);
insert into Reading values ('A5', 'Airsense', '2017-03-29 21:40:47', 17.2);
insert into Reading values ('S2', 'Siemens', '2017-01-29 19:20:27', 117);
insert into Reading values ('B2', 'Bosch', '2017-10-14 10:39:06', 224);
insert into Reading values ('T1', 'Thermotec', '2017-10-28 07:44:21', 35);
insert into Reading values ('T2', 'Thermotec', '2016-04-06 09:45:17', 36.5);
insert into Reading values ('T2', 'Thermotec', '2016-07-16 11:12:12', 34.7);
insert into Reading values ('H1', 'Honeywell', '2017-10-31 12:55:59', 5.9);
insert into Reading values ('H2', 'Honeywell', '2016-04-17 14:32:58', 7.5);
insert into Reading values ('E1', 'Envitec', '2016-01-30 16:27:44', 17.9);
insert into Reading values ('E2', 'Envitec', '2017-05-29 19:42:28', 12.2);

insert into Period values ('2017-04-01 10:00:01', '2017-10-31 17:18:19');
insert into Period values ('2017-01-17 08:11:17', '2017-10-25 19:00:91');
insert into Period values ('2016-01-02 10:08:00', '2030-12-31 00:00:00');
insert into Period values ('2017-03-04 12:34:55', '2030-12-31 00:00:00');
insert into Period values ('2015-05-08 22:30:05', '2030-12-31 00:00:00');
insert into Period values ('2016-02-26 13:08:45', '2030-12-31 00:00:00');
insert into Period values ('2016-07-31 15:03:41', '2017-09-17 13:00:07');
insert into Period values ('2016-08-26 21:00:23', '2017-02-23 17:55:42');
insert into Period values ('2017-04-06 12:07:44', '2030-12-31 00:00:00');
insert into Period values ('2016-01-12 00:00:00', '2017-11-02 07:15:18');
insert into Period values ('2017-05-10 11:12:15', '2030-12-31 00:00:00');
insert into Period values ('2016-04-02 08:11:17', '2016-12-15 00:00:00');
insert into Period values ('2016-03-20 20:17:25', '2017-01-01 10:00:10');
insert into Period values ('2016-01-07 12:00:15', '2016-04-28 17:17:17');
insert into Period values ('2016-01-02 09:30:27', '2016-01-07 18:20:24');
insert into Period values ('2017-02-01 10:10:10', '2020-02-01 00:00:00');
insert into Period values ('2017-11-01 00:00:00', '2017-11-05 00:00:00');
insert into Period values ('2016-07-31 15:03:41', '2018-01-01 00:00:00');

insert into Wears values ('2017-04-01 10:00:01', '2017-10-31 17:18:19', 'P-1', 'S1', 'Siemens');
insert into Wears values ('2017-01-17 08:11:17', '2017-10-25 19:00:21', 'P-2', 'B1', 'Bosch');
insert into Wears values ('2016-01-02 10:08:00', '2030-12-31 00:00:00', 'P-3', 'A1', 'AirSense');
insert into Wears values ('2017-03-04 12:34:55', '2030-12-31 00:00:00', 'P-4', 'A2', 'AirSense');
insert into Wears values ('2015-05-08 22:30:05', '2030-12-31 00:00:00', 'P-5', 'A3', 'AirSense');
insert into Wears values ('2016-02-26 13:08:45', '2030-12-31 00:00:00', 'P-6', 'A4', 'AirSense');
insert into Wears values ('2016-07-31 15:03:41', '2017-09-17 13:00:07', 'P-7', 'A5', 'AirSense');
insert into Wears values ('2016-08-26 21:00:23', '2017-02-23 17:55:42', 'P-8', 'S2', 'Siemens');
insert into Wears values ('2017-04-06 12:07:44', '2030-12-31 00:00:00', 'P-9', 'B2', 'Bosch');
insert into Wears values ('2016-01-12 00:00:00', '2017-11-02 07:15:18', 'P-10', 'T1', 'Thermotec');
insert into Wears values ('2017-05-10 11:12:15', '2030-12-31 00:00:00', 'P-8', 'H1', 'Honeywell');
insert into Wears values ('2016-04-02 08:11:10', '2016-12-15 00:01:10', 'P-2', 'T2', 'Thermotec');
insert into Wears values ('2016-03-20 20:17:25', '2017-01-01 10:00:10', 'P-1', 'H2', 'Honeywell');
insert into Wears values ('2016-01-07 12:00:15', '2016-04-28 17:17:17', 'P-7', 'E1', 'Envitec');
insert into Wears values ('2016-01-02 09:30:27', '2016-01-07 18:20:24', 'P-10', 'E2', 'Envitec');

insert into Request values (1, 'P-1', 'D-101', '2016-02-07');
insert into Request values (2, 'P-2', 'D-102', '2017-07-17');
insert into Request values (3, 'P-3', 'D-103', '2016-05-15');
insert into Request values (4, 'P-4', 'D-104', '2017-08-31');
insert into Request values (5, 'P-5', 'D-105', '2016-10-16');
insert into Request values (6, 'P-6', 'D-106', '2016-09-21');
insert into Request values (7, 'P-7', 'D-107', '2017-04-19');
insert into Request values (8, 'P-8', 'D-108', '2017-01-21');
insert into Request values (9, 'P-9', 'D-109', '2016-12-16');
insert into Request values (10, 'P-10' 'D-110', '2017-06-25');
insert into Request values (11, 'P-5', 'D-105', '2017-05-09');
insert into Request values (12, 'P-7', 'D-107', '2017-10-24');
insert into Request values (13, 'P-8', 'D-108', '2016-07-05');
insert into Request values (14, 'P-2', 'D-102', '2016-04-02');
insert into Request values (15, 'P-1', 'D-101', '2016-10-09');
insert into Request values (16, 'P-3', 'D-103', '2017-09-06');
insert into Request values (17, 'P-4', 'D-104', '2017-03-11');
insert into Request values (18, 'P-3', 'D-103', '2016-02-10');
insert into Request values (19, 'P-3', 'D-103', '2016-04-03');
insert into Request values (20, 'P-3', 'D-103', '2016-07-20');
insert into Request values (21, 'P-3', 'D-103', '2016-09-07');

insert into Study values (1, 'X-ray both feet', '2016-03-05', 'D-102', 'Medtronic', 'M1');
insert into Study values (2, 'Ecography both feet', '2017-08-30', 'D-101', 'Medtronic', 'M2');
insert into Study values (3, 'Endoscopy esophagus', '2016-06-02', 'D-105', 'Medtronic', 'M3');
insert into Study values (4, 'Endoscopy stomach', '2017-10-07', 'D-103', 'Medtronic', 'M4');
insert into Study values (5, 'Echocardiography', '2016-10-31', 'D-104', 'Medtronic', 'M5');
insert into Study values (6, 'Mammography', '2016-03-05', 'D-107', 'Iberdata', 'I6');
insert into Study values (7, 'Colonoscopy', '2017-05-12', 'D-110', 'Siemens', 'S3');
insert into Study values (8, 'Magnetic Resonance both shoulders', '2017-02-25', 'D-101', 'Siemens', 'S4');
insert into Study values (9, 'Magnetic Resonance both knees', '2017-01-08', 'D-108', 'Siemens', 'S5');
insert into Study values (10, 'Electrocardiogram', '2017-07-27', 'D-109', 'Bosch', 'B3');
insert into Study values (11, 'Electrocardiogram', '2017-10-08', 'D-106', 'Bosch', 'B4');
insert into Study values (12, 'Prostate Specific Antigen (PSA test)', '2017-10-31', 'D-102', 'Bosch', 'B5');
insert into Study values (13, 'Mammography', '2017-07-27', 'D-107', 'Iberdata', 'I1');
insert into Study values (14, 'Colonoscopy', '2017-05-09', 'D-105', 'Iberdata', 'I2');
insert into Study values (15, 'Echocardiography', '2017-10-29', 'D-108', 'Iberdata', 'I3');
insert into Study values (16, 'X-ray chest', '2017-10-01', 'D-102', 'Iberdata', 'I4');
insert into Study values (17, 'X-ray both elbows', '2017-05-27', 'D-101', 'Iberdata', 'I5');
insert into Study values (18, 'X-ray right foot', '2016-03-25', 'D-104', 'Medtronic', 'M1');
insert into Study values (19, 'Ecography left foot', '2016-08-31', 'D-109', 'Medtronic', 'M2');
insert into Study values (20, 'Endoscopy stomach', '2016-10-10', 'D-110', 'Medtronic', 'M4');
insert into Study values (21, 'Echocardiography', '2016-10-17', 'D-105', 'Medtronic', 'M5');

insert into Series values (1, 'X-ray right foot', 'http://www.healthcarecentre/11/', 1, 'X-ray both feet');
insert into Series values (2, 'X-ray left foot', 'http://www.healthcarecentre/21/', 1, 'X-ray both feet');
insert into Series values (3, 'Ecography right foot', 'http://www.healthcarecentre/32/', 2, 'Ecography both feet');
insert into Series values (4, 'Ecography left foot', 'http://www.healthcarecentre/42/', 2, 'Ecography both feet');
insert into Series values (5, 'Endoscopy esophagus', 'http://www.healthcarecentre/53/', 3, 'Endoscopy esophagus');
insert into Series values (6, 'Endoscopy stomach', 'http://www.healthcarecentre/64/', 4, 'Endoscopy stomach');
insert into Series values (7, 'Echocardiography', 'http://www.healthcarecentre/75/', 5, 'Echocardiography');
insert into Series values (8, 'Mammography', 'http://www.healthcarecentre/86/', 6, 'Mammography');
insert into Series values (9, 'Colonoscopy', 'http://www.healthcarecentre/97/', 7, 'Colonoscopy');
insert into Series values (10, 'Magnetic Resonance right shoulder', 'http://www.healthcarecentre/108/', 8, 'Magnetic Resonance both shoulders');
insert into Series values (11, 'Magnetic Resonance left shoulder', 'http://www.healthcarecentre/118/', 8, 'Magnetic Resonance both shoulders');
insert into Series values (12, 'Magnetic Resonance right knee', 'http://www.healthcarecentre/129/', 9, 'Magnetic Resonance both shoulders');
insert into Series values (13, 'Magnetic Resonance left knee', 'http://www.healthcarecentre/139/', 9, 'Magnetic Resonance both shoulders');
insert into Series values (14, 'Electrocardiogram', 'http://www.healthcarecentre/1410/', 10, 'Electrocardiogram');
insert into Series values (15, 'Electrocardiogram', 'http://www.healthcarecentre/1511/', 11, 'Electrocardiogram');
insert into Series values (16, 'Prostate Specific Antigen (PSA test)', 'http://www.healthcarecentre/1612/', 12, 'Prostate Specific Antigen (PSA test)');
insert into Series values (17, 'Mammography', 'http://www.healthcarecentre/1713/', 13, 'Mammography');
insert into Series values (18, 'Colonoscopy', 'http://www.healthcarecentre/1814/', 14, 'Colonoscopy');
insert into Series values (19, 'Echocardiography', 'http://www.healthcarecentre/1915/', 15, 'Echocardiography');
insert into Series values (20, 'X-ray chest', 'http://www.healthcarecentre/2016/', 16, 'X-ray chest');
insert into Series values (21, 'X-ray right elbow', 'http://www.healthcarecentre/2117/', 17, 'X-ray both elbows');
insert into Series values (22, 'X-ray left elbow', 'http://www.healthcarecentre/2217/', 17, 'X-ray both elbows');
insert into Series values (23, 'X-ray right foot', 'http://www.healthcarecentre/2318/', 18, 'X-ray right foot');
insert into Series values (24, 'Ecography left foot', 'http://www.healthcarecentre/2419/', 19, 'Ecography left foot');
insert into Series values (25, 'Endoscopy stomach', 'http://www.healthcarecentre/2520/', 20, 'Endoscopy stomach');
insert into Series values (26, 'Echocardiography', 'http://www.healthcarecentre/2621/', 21, 'Echocardiography');

insert into Element values (1, 1);
insert into Element values (1, 2);
insert into Element values (1, 3);
insert into Element values (2, 1);
insert into Element values (2, 2);
insert into Element values (3, 1);
insert into Element values (3, 2);
insert into Element values (3, 3);
insert into Element values (3, 4);
insert into Element values (4, 1);
insert into Element values (4, 2);
insert into Element values (5, 1);
insert into Element values (5, 2);
insert into Element values (6, 1);
insert into Element values (6, 2);
insert into Element values (7, 1);
insert into Element values (7, 2);
insert into Element values (8, 1);
insert into Element values (8, 2);
insert into Element values (8, 3);
insert into Element values (8, 4);
insert into Element values (9, 1);
insert into Element values (9, 2);
insert into Element values (10, 1);
insert into Element values (10, 2);
insert into Element values (11, 1);
insert into Element values (11, 2);
insert into Element values (12, 1);
insert into Element values (12, 2);
insert into Element values (13, 1);
insert into Element values (13, 2);
insert into Element values (14, 1);
insert into Element values (14, 2);
insert into Element values (15, 1);
insert into Element values (15, 2);
insert into Element values (16, 1);
insert into Element values (16, 2);
insert into Element values (17, 1);
insert into Element values (17, 2);
insert into Element values (18, 1);
insert into Element values (18, 2);
insert into Element values (19, 1);
insert into Element values (19, 2);
insert into Element values (20, 1);
insert into Element values (20, 2);
insert into Element values (21, 1);
insert into Element values (21, 2);
insert into Element values (22, 1);
insert into Element values (22, 2);
insert into Element values (22, 3);
insert into Element values (22, 4);

insert into Region values (1, 1, 0.107, 0.638, 0.180, 0.762);
insert into Region values (1, 2, 0.230, 0.567, 0.443, 0.899);
insert into Region values (1, 3, 0.432, 0.565, 0.118, 0.779);
insert into Region values (2, 1, 0.508, 0.234, 0.734, 0.923);
insert into Region values (2, 1, 0.100, 0.100, 0.230, 0.230);
insert into Region values (2, 2, 0.214, 0.657, 0.978, 0.999);
insert into Region values (3, 1, 0.115, 0.376, 0.647, 0.762);
insert into Region values (3, 2, 0.534, 0.980, 0.234, 0.762);
insert into Region values (3, 3, 0.675, 0.192, 0.567, 0.762);
insert into Region values (3, 4, 0.453, 0.876, 0.290, 0.834);
insert into Region values (4, 1, 0.489, 0.789, 0.117, 0.878);
insert into Region values (4, 2, 0.222, 0.333, 0.444, 0.555);
insert into Region values (5, 1, 0.654, 0.218, 0.905, 0.675);
insert into Region values (5, 2, 0.232, 0.798, 0.190, 0.458);
insert into Region values (6, 1, 0.616, 0.717, 0.818, 0.919);
insert into Region values (6, 2, 0.111, 0.999, 0.222, 0.777);
insert into Region values (7, 1, 0.668, 0.669, 0.888, 0.889);
insert into Region values (7, 2, 0.558, 0.475, 0.222, 0.332);
insert into Region values (8, 1, 0.142, 0.173, 0.194, 0.289);
insert into Region values (8, 2, 0.765, 0.975, 0.333, 0.777);
insert into Region values (8, 3, 0.211, 0.991, 0.224, 0.664);
insert into Region values (8, 4, 0.168, 0.845, 0.333, 0.456);
insert into Region values (9, 1, 0.121, 0.343, 0.565, 0.787);
insert into Region values (9, 2, 0.099, 0.677, 0.345, 0.899);
insert into Region values (10, 1, 0.321, 0.654, 0.765, 0.987);
insert into Region values (10, 2, 0.545, 0.878, 0.688, 0.727);
insert into Region values (11, 1, 0.646, 0.789, 0.889, 0.989);
insert into Region values (11, 2, 0.109, 0.234, 0.565, 0.898);
insert into Region values (12, 1, 0.212, 0.245, 0.656, 0.787);
insert into Region values (12, 2, 0.893, 0.909, 0.345, 0.897);
insert into Region values (13, 1, 0.666, 0.999, 0.222, 0.666);
insert into Region values (13, 2, 0.878, 0.989, 0.356, 0.676);
insert into Region values (14, 1, 0.111, 0.225, 0.348, 0.987);
insert into Region values (14, 2, 0.590, 0.334, 0.212, 0.455);
insert into Region values (15, 1, 0.690, 0.990, 0.213, 0.676);
insert into Region values (15, 2, 0.276, 0.387, 0.432, 0.878);
insert into Region values (16, 1, 0.175, 0.345, 0.478, 0.889);
insert into Region values (16, 2, 0.289, 0.367, 0.878, 0.995);
insert into Region values (17, 1, 0.567, 0.890, 0.345, 0.789);
insert into Region values (17, 2, 0.465, 0.443, 0.556, 0.954);
insert into Region values (18, 1, 0.586, 0.669, 0.665, 0.753);
insert into Region values (18, 2, 0.123, 0.456, 0.789, 0.890);
insert into Region values (19, 1, 0.643, 0.717, 0.542, 0.999);
insert into Region values (19, 2, 0.545, 0.878, 0.688, 0.727);
insert into Region values (20, 1, 0.534, 0.796, 0.968, 0.998);
insert into Region values (20, 2, 0.321, 0.543, 0.765, 0.987);
insert into Region values (21, 1, 0.199, 0.299, 0.399, 0.599);
insert into Region values (21, 2, 0.209, 0.309, 0.409, 0.509);
insert into Region values (22, 1, 0.534, 0.756, 0.867, 0.957);
insert into Region values (22, 2, 0.476, 0.874, 0.565, 0.878);
insert into Region values (22, 3, 0.223, 0.345, 0.678, 0.967);
insert into Region values (22, 4, 0.234, 0.678, 0.456, 0.789);
