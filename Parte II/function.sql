delimiter $$
create function region_overlaps_element(series_id_A int(10), elem_index_A int(10), x1_B float(4,3), y1_B float(4,3), x2_B float(4,3), y2_B float(4,3))
returns int
begin
	declare overlaps int;
	select count(r.elem_index) into overlaps
	from region as r
	where r.series_id = series_id_A and r.elem_index = elem_index_A and
		(((x1_B between r.x1 and r.x2) or (x2_B between r.x1 and r.x2)) and
		((y1_B between r.y1 and r.y2) or (y2_B between r.y1 and r.y2)) or
		((x1_B > r.x1) and (x2_B < r.x2) and (y1_B > r.y1) and (y2_B < r.y2)) or
		((x1_B < r.x1) and (x2_B > r.x2) and (y1_B < r.y1) and (y2_B > r.y2)));
	if overlaps > 0 then
		set overlaps = 1;
	end if;
	return overlaps;
end$$
delimiter ;

