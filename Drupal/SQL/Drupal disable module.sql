update`d7_system` s
set s.status = 0,
	s.bootstrap = 0
where s.name like "%rules%"