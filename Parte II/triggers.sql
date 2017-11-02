
-- I)

delimiter$$
create trigger prevent_insert before insert on Study
for each row
begin
	if exists(select *
			  from Request
			  where request_number = new.request_number and doctor_id = new.doctor_id) then
		call doctor_who_prescribes_an_exame_cannot_perform_the_same_exam();
	end if;
end$$
delimiter;

delimiter$$

create trigger prevent_update before update on Study
for each row
begin
	if exists(select *
			  from Request
			  where request_number = new.request_number and doctor_id = new.doctor_id) then
		call doctor_who_prescribes_an_exame_cannot_perform_the_same_exam();
	end if;
end$$
delimiter;

--II)

delimiter$$
create trigger prevent_association before insert on Wears
for each row
begin

	signal sqlstate '45000' set message_text = 'Overlapping Periods';

end$$
delimiter;

delimiter$$
create trigger prevent_association update on Wears
for each row
begin

	signal sqlstate '45000' set message_text = 'Overlapping Periods';

end$$
delimiter;