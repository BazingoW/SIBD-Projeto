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
				 							from study as s, Doctor as d, Patient as p
				 							where d.doctor_id = s.doctor_id and d.patient_number = p.patient_number));

-- Patients with the highest number of readings of LDL cholesterol above 200 in the past 90 days

select patient_name
from Patient as p, Reading as r, Sensor as s, Wears as w
where r.serialnum = w.serialnum and r.manufacturer = w.manufacturer and s.serialnum = r.serialnum and s.manufacturer = r.manufacturer and p.patient_number = w.patient_number and r.value > 200 and s.units like 'LDL cholesterol in mg/dL' and TIMESTAMPDIFF(day, r.read_datetime, CURRENT_TIMESTAMP()) <= 90;