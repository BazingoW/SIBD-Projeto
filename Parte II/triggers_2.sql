
-- I)

delimiter $$
create trigger prevent_insert before insert on Study
for each row
begin
	if exists(select *
			  from Request
			  where request_number = new.request_number and doctor_id = new.doctor_id) then
		call doctor_who_prescribes_an_exame_cannot_perform_the_same_exam();
	end if;
end$$
delimiter ;

delimiter $$
create trigger prevent_update before update on Study
for each row
begin
if exists(select *
		  from Request
		  where request_number = new.request_number and doctor_id = new.doctor_id) then
		call doctor_who_prescribes_an_exame_cannot_perform_the_same_exam();
end if;
end$$
delimiter ;

--II)

delimiter $$
create trigger prevent_device_association_insert before insert on Wears
for each row
begin
	if exists(select *
		  	  from Wears
		 	  where serialnum = new.serialnum and manufacturer = new.manufacturer and
		(((TIMESTAMPDIFF(second, start_date, new.end_date) >= 0) and (TIMESTAMPDIFF(second, new.end_date, end_date) >= 0)) or
	 	((TIMESTAMPDIFF(second, start_date, new.start_date) >= 0) and (TIMESTAMPDIFF(second, new.start_date, end_date) >= 0)) or
		 ((TIMESTAMPDIFF(second, new.start_date, start_date) >= 0) and (TIMESTAMPDIFF(second, end_date, new.end_date) >= 0)))) then
		
		signal sqlstate '45000' set message_text = 'Overlapping Periods';
	end if;
end$$
delimiter ;

delimiter $$
create trigger prevent_device_association_update before update on Wears
for each row
begin
	if exists(select *
		  	  from Wears
		 	  where serialnum = new.serialnum and manufacturer = new.manufacturer and
		(((TIMESTAMPDIFF(second, start_date, new.end_date) >= 0) and (TIMESTAMPDIFF(second, new.end_date, end_date) >= 0)) or
	 	((TIMESTAMPDIFF(second, start_date, new.start_date) >= 0) and (TIMESTAMPDIFF(second, new.start_date, end_date) >= 0)) or
		 ((TIMESTAMPDIFF(second, new.start_date, start_date) >= 0) and (TIMESTAMPDIFF(second, end_date, new.end_date) >= 0)))) then
		
		signal sqlstate '45000' set message_text = 'Overlapping Periods';
	end if;
end$$
delimiter ;

-------- II) COM INIBIÇÂO DE O MESMO PACIENTE USAR DOIS DEVICES AO MESMO TEMPO


delimiter $$
create trigger prevent_device_association_insert before insert on Wears
for each row
begin
	if exists(select *
		  	  from Wears
		 	  where (serialnum = new.serialnum and manufacturer = new.manufacturer) or (patient_number = new.patient_number) and
		(((TIMESTAMPDIFF(second, start_date, new.end_date) >= 0) and (TIMESTAMPDIFF(second, new.end_date, end_date) >= 0)) or
	 	((TIMESTAMPDIFF(second, start_date, new.start_date) >= 0) and (TIMESTAMPDIFF(second, new.start_date, end_date) >= 0)) or
		 ((TIMESTAMPDIFF(second, new.start_date, start_date) >= 0) and (TIMESTAMPDIFF(second, end_date, new.end_date) >= 0)))) then
		
		signal sqlstate '45000' set message_text = 'Overlapping Periods';
	end if;
end$$
delimiter ;

delimiter $$
create trigger prevent_device_association_update before update on Wears
for each row
begin
	if exists(select *
		  	  from Wears
		 	  where (serialnum = new.serialnum and manufacturer = new.manufacturer) or (patient_number = new.patient_number) and
		(((TIMESTAMPDIFF(second, start_date, new.end_date) >= 0) and (TIMESTAMPDIFF(second, new.end_date, end_date) >= 0)) or
	 	((TIMESTAMPDIFF(second, start_date, new.start_date) >= 0) and (TIMESTAMPDIFF(second, new.start_date, end_date) >= 0)) or
		 ((TIMESTAMPDIFF(second, new.start_date, start_date) >= 0) and (TIMESTAMPDIFF(second, end_date, new.end_date) >= 0)))) then
		
		signal sqlstate '45000' set message_text = 'Overlapping Periods';
	end if;
end$$
delimiter 



