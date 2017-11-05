-- Query name of patients with studies made by all Medtronic devices in the past year

select patient_name
from Patient as p
where not exists(select serialnum
				 from Device as d
				 where manufacturer like 'Medtronic'
				 and serialnum not in (select serialnum
			 							from Study as s, Request as r, Patient as p2
			 							where s.request_number = r.request_number and
			 							r.patient_number = p2.patient_number and
			 							TIMESTAMPDIFF(year, s.study_date, CURRENT_TIMESTAMP()) = 1 and
			 							p.patient_name = p2.patient_name));
				 						

-- Patients with the highest number of readings of LDL cholesterol above 200 in the past 90 days

select patient_name
from Patient natural join Reading natural join Sensor natural join Wears
where value > 200 and units like 'LDL cholesterol in mg/dL' and 
	  TIMESTAMPDIFF(day, read_datetime, CURRENT_TIMESTAMP()) <= 90
group by patient_name
having count(value) >= all(select count(value)
							from Patient natural join Reading natural join Sensor natural join Wears
							where value > 200 and units like 'LDL cholesterol in mg/dL' and 
	  						TIMESTAMPDIFF(day, read_datetime, CURRENT_TIMESTAMP()) <= 90
							group by patient_name);
