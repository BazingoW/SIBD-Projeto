-- Function region_overlaps_element

delimiter $$
create function region_overlaps_element(series_id_A int(10), elem_index_A int(10), x1_B float(4,3), y1_B float(4,3), x2_B float(4,3), y2_B float(4,3))
returns int
begin
	declare overlaps int;
	select count(r.elem_index) into overlaps
	from region as r
	where r.series_id = series_id_A and r.elem_index = elem_index_A and
		((r.x1 < x2_B) and (r.x2 > x1_B) and (r.y1 < y2_B) and (r.y2 > y1_B));
	if overlaps > 0 then
		set overlaps = 1;
	end if;
	return overlaps;
end$$
delimiter ;