-- Query name of patients with studies made by all Medtronic devices in the past year

--select patient_name
--from Patient as p, Study as s, Device as d1, Doctor as d2
--where p.patient_number = d2.patient_number and s.doctor_id = d2.doctor_id and s.manufacturer = d1.manufacturer and s.serialnum = d1.serialnum and s.manufacturer like 'Medtronic' and DATEPART(yy, s.study_date) = DATEPART(yy, DATEADD(yy, -1, getdate()));

--select patient_name
--from Patient as p, Study as s, Device as d1, Doctor as d2
--where p.patient_number = d2.patient_number and s.doctor_id = d2.doctor_id and s.manufacturer = d1.manufacturer and s.serialnum = d1.serialnum and s.manufacturer like 'Medtronic' and TIMESTAMPDIFF(year, s.study_date, CURRENT_TIMESTAMP()) = 1;

select patient_name
from Patient
where not exists(select d.manufacturer
				 from Device as d
				 where d.manufacturer like 'Medtronic'
				 and d.manufacturer not in (select s.manufacturer
				 							from Study as s, Doctor as d, Patient as p
				 							where d.doctor_id = s.doctor_id and 
				 							d.patient_number = p.patient_number and 
											TIMESTAMPDIFF(year, s.study_date, CURRENT_TIMESTAMP()) = 1));

-- Patients with the highest number of readings of LDL cholesterol above 200 in the past 90 days

select patient_name
from Patient natural join Reading natural join Sensor natural join Wears
where value > 200 and units like 'LDL cholesterol mg/dL' and 
	  TIMESTAMPDIFF(day, read_datetime, CURRENT_TIMESTAMP()) <= 90
group by patient_name
having count(value) >= all(select count(value)
							from Patient natural join Reading natural join Sensor natural join Wears
							where value > 200 and units like 'LDL cholesterol mg/dL' and 
	  						TIMESTAMPDIFF(day, read_datetime, CURRENT_TIMESTAMP()) <= 90
							group by patient_name);