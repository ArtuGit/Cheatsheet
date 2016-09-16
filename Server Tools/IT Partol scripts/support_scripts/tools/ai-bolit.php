<?php
///////////////////////////////////////////////////////////////////////////
// Автор: Григорий Земсков
// Email: audit@revisium.com, http://revisium.com/ai/, http://greg.su, skype: greg_zemskov

// Запрещено использовать в коммерческих целях без согласования с автором скрипта.
//
// Получение свидетельства о государственной регистрации ПЭВМ в РосПатенте - в процессе
///////////////////////////////////////////////////////////////////////////

define('PASS', '940560'); // пароль для запуска

$defaults = array(
	'path' => dirname(__FILE__),
	'scan_all_files' => 0, // полное сканирование файлов (не только .js, .php, .html, .htaccess)
	'scan_delay' => 1, // задержка в миллисекундах при сканировании файлов для снижения нагрузки на файловую систему
	'max_size_to_scan' => '10M',
	'site_url' => '', // адрес вашего сайта
	'no_rw_dir' => 0
);

// завернутые сигнатуры, чтобы не ругались антивирусы на PC и на хостинге
$g_DBShe = unserialize(base64_decode("YToyMDE6e2k6MDtzOjk0OiIkaW5mbyAuPSAoKCRwZXJtcyAmIDB4MDA0MCkgPygoJHBlcm1zICYgMHgwODAwKSA/ICdzJyA6ICd4JyApIDooKCRwZXJtcyAmIDB4MDgwMCkgPyAnUycgOiAnLScpIjtpOjE7czo4NDoiPHRleHRhcmVhIG5hbWU9XCJwaHBldlwiIHJvd3M9XCI1XCIgY29scz1cIjE1MFwiPiIuQCRfUE9TVFsncGhwZXYnXS4iPC90ZXh0YXJlYT48YnI+IjtpOjI7czoxMDE6IjdUTUdBSFk1S2FNOW8zN1cvR1EvZnJGSmV0ZnFsUkdPNkZTUlRNbTdJTFNtMzVvNXo0K3YwbWNmNEthSGdLUzVZMTdlcXF2RDJtbU44Tnp0ZXlwbE5kNldPd3JRVks0NDVKL3kwIjtpOjM7czoxNjoiYzk5ZnRwYnJ1dGVjaGVjayI7aTo0O3M6ODoiYzk5c2hlbGwiO2k6NTtzOjg6InI1N3NoZWxsIjtpOjY7czoxNDoidGVtcF9yNTdfdGFibGUiO2k6NztzOjc2OiJSMGxHT0RsaEpnQVdBSUFBQUFBQUFQLy8veUg1QkFVVUFBRUFMQUFBQUFBbUFCWUFBQUl2akkrcHkrMFBGNGkwZ1Z2enVWeFhEbm9RIjtpOjg7czo3OiJjYXN1czE1IjtpOjk7czoxMzoiV1NDUklQVC5TSEVMTCI7aToxMDtzOjQ3OiJFeGVjdXRlZCBjb21tYW5kOiA8Yj48Zm9udCBjb2xvcj0jZGNkY2RjPlskY21kXSI7aToxMTtzOjExOiJjdHNoZWxsLnBocCI7aToxMjtzOjExMToiQkRBUWtKQ1F3TERCZ05EUmd5SVJ3aE1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakwvd0FBUkNBQVFBQkFEQVNJQUFoRUJBIjtpOjEzO3M6MzA6IltBdjRiZkNZQ1MseEtXayQrVGtVUyx4bkdkQXhbTyI7aToxNDtzOjE1OiJEWF9IZWFkZXJfZHJhd24iO2k6MTU7czoxMDY6Ijl0WlNCMGJ5QnlOVGNnYzJobGJHd2dKaVlnTDJKcGJpOWlZWE5vSUMxcElpazdEUW9nSUNCbGJITmxEUW9nSUNCbWNISnBiblJtS0hOMFpHVnljaXdpVTI5eWNua2lLVHNOQ2lBZ0lHTnMiO2k6MTY7czo4NjoiY3JsZi4ndW5saW5rKCRuYW1lKTsnLiRjcmxmLidyZW5hbWUoIn4iLiRuYW1lLCAkbmFtZSk7Jy4kY3JsZi4ndW5saW5rKCJncnBfcmVwYWlyLnBocCIiO2k6MTc7czoxMDU6Ii8wdFZTRy9TdXYwVXIvaGFVWUFkbjNqTVF3YmJvY0dmZkFlQzI5Qk45dG1CaUpkVjFsaytqWURVOTJDOTRqZHREaWYreE9Zakc2Q0xoeDMxVW85eDkvZUFXZ3NCSzYwa0sybUx3cXpxZCI7aToxODtzOjExNToibXB0eSgkX1BPU1RbJ3VyJ10pKSAkbW9kZSB8PSAwNDAwOyBpZiAoIWVtcHR5KCRfUE9TVFsndXcnXSkpICRtb2RlIHw9IDAyMDA7IGlmICghZW1wdHkoJF9QT1NUWyd1eCddKSkgJG1vZGUgfD0gMDEwMCI7aToxOTtzOjQ0OiJXVCtQe35FVzBFclBPdG5VQCNAJl5sXnNQMWxkbnlAI0AmbnNrK3IwLEdUKyI7aToyMDtzOjM3OiJrbGFzdmF5di5hc3A/eWVuaWRvc3lhPTwlPWFrdGlma2xhcyU+IjtpOjIxO3M6MTIyOiJudCkoZGlza190b3RhbF9zcGFjZShnZXRjd2QoKSkvKDEwMjQqMTAyNCkpIC4gIk1iICIgLiAiRnJlZSBzcGFjZSAiIC4gKGludCkoZGlza19mcmVlX3NwYWNlKGdldGN3ZCgpKS8oMTAyNCoxMDI0KSkgLiAiTWIgPCI7aToyMjtzOjMxOiJzKCkuZygpLnMoKS5zKCkuZygpLnMoKS5zKCkuZygpIjtpOjIzO3M6ODg6IkNSYnNrRUlTK3liS0F3YzYvT0IxalU4WTBZSU1WVWh4aGFPSXNIQUNCeUQwd01BTk9IcVk1WTQ4Z3VpQm5DaGt3UFlOVGt4ZEJSVlJaTEhGa29qWTk2SUkiO2k6MjQ7czo3MzoiJHBvcnRfYmluZF9iZF9wbD0iSXlFdmRYTnlMMkpwYmk5d1pYSnNEUW9rVTBoRlRFdzlJaTlpYVc0dlltRnphQ0F0YVNJN0RRcCI7aToyNTtzOjEyNzoiQ0IyYVRacElERXdNalF0RFFvakxTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExRMEtJM0psY1hWcCI7aToyNjtzOjc6Ik5URGFkZHkiO2k6Mjc7czo3NjoiYSBocmVmPSI8P2VjaG8gIiRmaXN0aWsucGhwP2RpemluPSRkaXppbi8uLi8iPz4iIHN0eWxlPSJ0ZXh0LWRlY29yYXRpb246IG5vbiI7aToyODtzOjExNToiVFJVRkVSRklzTVNrN0RRcGlhVzVrS0ZNc2MyOWphMkZrWkhKZmFXNG9KRXhKVTFSRlRsOVFUMUpVTEVsT1FVUkVVbDlCVGxrcEtTQjhmQ0JrYVdVZ0lrTmhiblFnYjNCbGJpQndiM0owWEc0aU93MEtiRyI7aToyOTtzOjM4OiJSb290U2hlbGwhJyk7c2VsZi5sb2NhdGlvbi5ocmVmPSdodHRwOiI7aTozMDtzOjExMzoibTkxZEN3Z0pHVnZkWFFwT3cwS2MyVnNaV04wS0NSeWIzVjBJRDBnSkhKcGJpd2dkVzVrWldZc0lDUmxiM1YwSUQwZ0pISnBiaXdnTVRJd0tUc05DbWxtSUNnaEpISnZkWFFnSUNZbUlDQWhKR1Z2ZFgiO2k6MzE7czo5MDoiPCU9UmVxdWVzdC5TZXJ2ZXJWYXJpYWJsZXMoInNjcmlwdF9uYW1lIiklPj9Gb2xkZXJQYXRoPTwlPVNlcnZlci5VUkxQYXRoRW5jb2RlKEZvbGRlci5Ecml2IjtpOjMyO3M6NzM6IlIwbEdPRGxoRkFBVUFLSUFBQUFBQVAvLy85M2QzY0RBd0lhR2hnUUVCUC8vL3dBQUFDSDVCQUVBQUFZQUxBQUFBQUFVQUJRQUEiO2k6MzM7czoxNjA6InByaW50KChpc19yZWFkYWJsZSgkZikgJiYgaXNfd3JpdGVhYmxlKCRmKSk/Ijx0cj48dGQ+Ii53KDEpLmIoIlIiLncoMSkuZm9udCgncmVkJywnUlcnLDMpKS53KDEpOigoKGlzX3JlYWRhYmxlKCRmKSk/Ijx0cj48dGQ+Ii53KDEpLmIoIlIiKS53KDQpOiIiKS4oKGlzX3dyaXRhYmwiO2k6MzQ7czoxNjE6IignIicsJyZxdW90OycsJGZuKSkuJyI7ZG9jdW1lbnQubGlzdC5zdWJtaXQoKTtcJz4nLmh0bWxzcGVjaWFsY2hhcnMoc3RybGVuKCRmbik+Zm9ybWF0P3N1YnN0cigkZm4sMCxmb3JtYXQtMykuJy4uLic6JGZuKS4nPC9hPicuc3RyX3JlcGVhdCgnICcsZm9ybWF0LXN0cmxlbigkZm4pIjtpOjM1O3M6MTE6InplaGlyaGFja2VyIjtpOjM2O3M6NToic3lwZXgiO2k6Mzc7czozOToiSkAhVnJAKiZSSFJ3fkpMdy5HfHhsaG5MSn4/MS5id09ieGJQfCFWIjtpOjM4O3M6ODoiY2loc2hlbGwiO2k6Mzk7czoxMjY6IlgxTkZVMU5KVDA1YkozUjRkR0YxZEdocGJpZGRJRDBnZEhKMVpUc05DaUFnSUNCcFppQW9KRjlRVDFOVVd5ZHliU2RkS1NCN0RRb2dJQ0FnSUNCelpYUmpiMjlyYVdVb0ozUjRkR0YxZEdoZkp5NGtjbTFuY205MWNDd2diVyI7aTo0MDtzOjYxOiJKSFpwYzJsMFkyOTFiblFnUFNBa1NGUlVVRjlEVDA5TFNVVmZWa0ZTVTFzaWRtbHphWFJ6SWwwN0lHbG1LIjtpOjQxO3M6NzoiRnhjOTlzaCI7aTo0MjtzOjM5OiJXU09zZXRjb29raWUobWQ1KCRfU0VSVkVSWydIVFRQX0hPU1QnXSkiO2k6NDM7czoxMDc6IkNRYm9HbDdmK3hjQXlVeXN4YjVtS1M2a0FXc25STGRTK3NLZ0dvWldkc3dMRkpaVjh0VnpYc3ErbWVTUEhNeFRJM25TVUI0ZkoydlIzcjNPbnZYdE5BcU42d24vRHRUVGkrQ3UxVU9Kd05MIjtpOjQ0O3M6MTQxOiI8L3RkPjx0ZCBpZD1mYT5bIDxhIHRpdGxlPVwiSG9tZTogJyIuaHRtbHNwZWNpYWxjaGFycyhzdHJfcmVwbGFjZSgiXCIsICRzZXAsIGdldGN3ZCgpKSkuIicuXCIgaWQ9ZmEgaHJlZj1cImphdmFzY3JpcHQ6Vmlld0RpcignIi5yYXd1cmxlbmNvZGUiO2k6NDU7czoxNjoiQ29udGVudC1UeXBlOiAkXyI7aTo0NjtzOjg2OiI8bm9icj48Yj4kY2RpciRjZmlsZTwvYj4gKCIuJGZpbGVbInNpemVfc3RyIl0uIik8L25vYnI+PC90ZD48L3RyPjxmb3JtIG5hbWU9Y3Vycl9maWxlPiI7aTo0NztzOjQ4OiJ3c29FeCgndGFyIGNmenYgJyAuIGVzY2FwZXNoZWxsYXJnKCRfUE9TVFsncDInXSkiO2k6NDg7czoyMToiZXZhbChiYXNlNjRfZGVjb2RlKCRfIjtpOjQ5O3M6MTQyOiI1amIyMGlLVzl5SUhOMGNtbHpkSElvSkhKbFptVnlaWElzSW1Gd2IzSjBJaWtnYjNJZ2MzUnlhWE4wY2lna2NtVm1aWEpsY2l3aWJtbG5iV0VpS1NCdmNpQnpkSEpwYzNSeUtDUnlaV1psY21WeUxDSjNaV0poYkhSaElpa2diM0lnYzNSeWFYTjBjaWdrIjtpOjUwO3M6NzY6IkxTMGdSSFZ0Y0ROa0lHSjVJRkJwY25Wc2FXNHVVRWhRSUZkbFluTm9NMnhzSUhZeExqQWdZekJrWldRZ1lua2djakJrY2pFZ09rdz0iO2k6NTE7czo2NToiaWYgKGVyZWcoJ15bWzpibGFuazpdXSpjZFtbOmJsYW5rOl1dKyhbXjtdKykkJywgJGNvbW1hbmQsICRyZWdzKSkiO2k6NTI7czoxMTA6InZ6djZkK2lPdnRrZDM4VGxIdThtUWF2WGRuSkNicFFjcFhoTmJiTG1aT3FNb3BEWmVOYWxiK1ZLbGVkaENqcFZBTVFTUW54VklFQ1FBZkx1NUtnTG13QjZlaFFRR05TQllqcGc5ZzVHZEJpaFhvIjtpOjUzO3M6NDY6InJvdW5kKDArOTgzMC40Kzk4MzAuNCs5ODMwLjQrOTgzMC40Kzk4MzAuNCkpPT0iO2k6NTQ7czoxMjoiUEhQU0hFTEwuUEhQIjtpOjU1O3M6MTI3OiJxaERUWklwTWNCMXhCb2szMzJCamNjZlBYcTBRc1pVL2c0ZWFwQnhUNWdpdDFyR2RLdHdmMXJ0OU9PaWNjL2hUbHBlRm1FalJSa1dHV1RKVGtDb2wwWDRBdXdKU2ZGaHRmUDVkT2duNTYxaWwrd2t6a3FDRzlkZlQ5enFjMjc0IjtpOjU2O3M6MTIwOiJUc05DaUFnSUNCemFXNHVjMmx1WDJaaGJXbHNlU0E5SUVGR1gwbE9SVlE3RFFvZ0lDQWdjMmx1TG5OcGJsOXdiM0owSUQwZ2FIUnZibk1vWVhSdmFTaGhjbWQyV3pKZEtTazdEUW9nSUNBZ2MybHVMbk5wYmw5aFoiO2k6NTc7czo1MjoiYUhSMGNEb3ZMMm90WkdWMkxuSjFMMmx1WkdWNExuQm9jRDlqY0c0OVpuSmhiV1Z6Wld4cyI7aTo1ODtzOjg3OiJXVEpUa0NvbDBYNEF1d0pTZkZodGZQNWRPZ241NjFpbCt3a3prcUNHOWRmVDl6cWMyNzR2ZUllU2Q0MUN4VUl2SEZuK3RXNzdvRTNvaHFTdjAxQlh6VDAiO2k6NTk7czo3MToiSEJ5YjNSdktTQjhmQ0JrYVdVb0lrVnljbTl5T2lBa0lWeHVJaWs3RFFwamIyNXVaV04wS0ZOUFEwdEZWQ3dnSkhCaFpHUnkiO2k6NjA7czoxNzoiV2ViIFNoZWxsIGJ5IGJvZmYiO2k6NjE7czoxNjoiV2ViIFNoZWxsIGJ5IG9SYiI7aTo2MjtzOjExOiJkZXZpbHpTaGVsbCI7aTo2MztzOjIwOiJTaGVsbCBieSBNYXdhcl9IaXRhbSI7aTo2NDtzOjg6Ik4zdHNoZWxsIjtpOjY1O3M6MTE6IlN0b3JtN1NoZWxsIjtpOjY2O3M6MTE6IkxvY3VzN1NoZWxsIjtpOjY3O3M6MjI6InByaXZhdGUgU2hlbGwgYnkgbTRyY28iO2k6Njg7czoxMzoidzRjazFuZyBzaGVsbCI7aTo2OTtzOjIxOiJGYVRhTGlzVGlDel9GeCBGeDI5U2giO2k6NzA7czoxMjoicjU3c2hlbGwucGhwIjtpOjcxO3M6Mjc6ImRlZmF1bHRfYWN0aW9uID0gJ0ZpbGVzTWFuJyI7aTo3MjtzOjQyOiJXb3JrZXJfR2V0UmVwbHlDb2RlKCRvcERhdGFbJ3JlY3ZCdWZmZXInXSkiO2k6NzM7czo0MDoiJGZpbGVwYXRoPUByZWFscGF0aCgkX1BPU1RbJ2ZpbGVwYXRoJ10pOyI7aTo3NDtzOjk6ImFudGlzaGVsbCI7aTo3NTtzOjk6InJvb3RzaGVsbCI7aTo3NjtzOjExOiJteXNoZWxsZXhlYyI7aTo3NztzOjg4OiIkcmVkaXJlY3RVUkw9J2h0dHA6Ly8nLiRyU2l0ZS4kX1NFUlZFUlsnUkVRVUVTVF9VUkknXTtpZihpc3NldCgkX1NFUlZFUlsnSFRUUF9SRUZFUkVSJ10pIjtpOjc4O3M6MTM1OiI0MFVlQ0tkQjhFT3FtWENLZUczcVUwWWlCanNHV3JVSG13TEdRZ3JOb3V5WEVKOU40dGpWdnJTUUFGRHFEblZIRzl2RFp5QkZ2dzRjVEdKb3EvUEZDVXN6SVN0Q1RZejJaYkxrVEt3dmVNVnNOT0FmS0xJMm5Bb2t6azlJM1pqbDdwQWVCam4iO2k6Nzk7czo4ODoiSVdsdUhqS3B4Ny9YR3FLY0gxR0hFMjA5THh5aU5LejVUS0NvekpYaXF1TnRPQXgzRHg0R0t6TlZuZlVTUi9zSDhDVEFsNXE3d29kYW9qTzN2K3ZDRGVHRSI7aTo4MDtzOjEwMzoiZEhVdTBkSldWc2dEZTJyZmU0Z1dCdGlMVmM1amtwbzFMVDhMcW1lWGVXelNYVjlGNElCVThpM0Jjb2VBclBvUG1uZ1IvQ1liNzUyZmNTOXBHQWpqRkZIMGpkSUt2ajRoTVpObnlWVSI7aTo4MTtzOjE3OiJyZW5hbWUoIndzby5waHAiLCI7aTo4MjtzOjU0OiIkTWVzc2FnZVN1YmplY3QgPSBiYXNlNjRfZGVjb2RlKCRfUE9TVFsibXNnc3ViamVjdCJdKTsiO2k6ODM7czo4NjoiMGlaR2x6Y0d4aGVUcHViMjVsSWo0OFlTQm9jbVZtUFNKb2RIUndPaTh2ZDNkM0xtcHZiMjFzWVhoMFl5NWpiMjBpUGtwdmIyMXNZVmhVUXlCT1pYZHoiO2k6ODQ7czo0OToialZOdFQ5dEFEUDQrYWY4aFF4TnRCVzBoZ1FRRWJLdEtZUHN5b1E3MnBZbXFhMkthbyI7aTo4NTtzOjQ0OiJjb3B5KCRfRklMRVNbeF1bdG1wX25hbWVdLCRfRklMRVNbeF1bbmFtZV0pKSI7aTo4NjtzOjg6IlNoZWxsIE9rIjtpOjg3O3M6OTM6IklpazdEUXBqYjI1dVpXTjBLRk5QUTB0RlZDd2dKSEJoWkdSeUtTQjhmQ0JrYVdVb0lrVnljbTl5T2lBa0lWeHVJaWs3RFFwdmNHVnVLRk5VUkVsT0xDQWlQaVpUVCI7aTo4ODtzOjU4OiJTRUxFQ1QgMSBGUk9NIG15c3FsLnVzZXIgV0hFUkUgY29uY2F0KGB1c2VyYCwgJ0AnLCBgaG9zdGApIjtpOjg5O3M6MjE6IiFAJF9DT09LSUVbJHNlc3NkdF9rXSI7aTo5MDtzOjc5OiI0WVRaaU56TXlNMlV3TWpBMVpHUXhOVGMwWkdGa01XWmlaVDBpWEhnMlppSTdKRzA1TnprMFlUWTBPV0V6WVdRelpEZzVPVEJsT1dKaVlqIjtpOjkxO3M6NDg6IiRhPShzdWJzdHIodXJsZW5jb2RlKHByaW50X3IoYXJyYXkoKSwxKSksNSwxKS5jKSI7aTo5MjtzOjU2OiJ4aCAtcyAiL3Vzci9sb2NhbC9hcGFjaGUvc2Jpbi9odHRwZCAtRFNTTCIgLi9odHRwZCAtbSAkMSI7aTo5MztzOjE4OiJwd2QgPiBHZW5lcmFzaS5kaXIiO2k6OTQ7czoxMjoiQlJVVEVGT1JDSU5HIjtpOjk1O3M6MzE6IkNhdXRhbSBmaXNpZXJlbGUgZGUgY29uZmlndXJhcmUiO2k6OTY7czoyNDoiZXZhbChnemluZmxhdGUoc3RyX3JvdDEzIjtpOjk3O3M6NDM6Im11aVdyNFRtTGFQd1FvSkVTZ0xvQW5RU3Y5M2F4cWhqUm1PQURNb0YzWkwiO2k6OTg7czozMjoiJGthPSc8Py8vQlJFJzska2FrYT0ka2EuJ0FDSy8vPz4iO2k6OTk7czo4NToiJHN1Ymo9dXJsZGVjb2RlKCRfR0VUWydzdSddKTskYm9keT11cmxkZWNvZGUoJF9HRVRbJ2JvJ10pOyRzZHM9dXJsZGVjb2RlKCRfR0VUWydzZCddKSI7aToxMDA7czozOToiJF9fX189QGd6aW5mbGF0ZSgkX19fXykpe2lmKGlzc2V0KCRfUE9TIjtpOjEwMTtzOjM3OiJwYXNzdGhydShnZXRlbnYoIkhUVFBfQUNDRVBUX0xBTkdVQUdFIjtpOjEwMjtzOjg6IkFzbW9kZXVzIjtpOjEwMztzOjUwOiJmb3IoOyRwYWRkcj1hY2NlcHQoQ0xJRU5ULCBTRVJWRVIpO2Nsb3NlIENMSUVOVCkgeyI7aToxMDQ7czo1OToiJGl6aW5sZXIyPXN1YnN0cihiYXNlX2NvbnZlcnQoQGZpbGVwZXJtcygkZm5hbWUpLDEwLDgpLC00KTsiO2k6MTA1O3M6ODoiQmFja2Rvb3IiO2k6MTA2O3M6NDI6IiRiYWNrZG9vci0+Y2NvcHkoJGNmaWNoaWVyLCRjZGVzdGluYXRpb24pOyI7aToxMDc7czoyMzoieyR7cGFzc3RocnUoJGNtZCl9fTxicj4iO2k6MTA4O3M6Mjk6IiRhW2hpdHNdJyk7IFxyXG4jZW5kcXVlcnlcclxuIjtpOjEwOTtzOjI2OiJuY2Z0cHB1dCAtdSAkZnRwX3VzZXJfbmFtZSI7aToxMTA7czoxNDoiZXhlYygicm0gLXIgLWYiO2k6MTExO3M6MzY6ImV4ZWNsKCIvYmluL3NoIiwic2giLCItaSIsKGNoYXIqKTApOyI7aToxMTI7czozMToiPEhUTUw+PEhFQUQ+PFRJVExFPmNnaS1zaGVsbC5weSI7aToxMTM7czozODoic3lzdGVtKCJ1bnNldCBISVNURklMRTsgdW5zZXQgU0FWRUhJU1QiO2k6MTE0O3M6MjM6IiRsb2dpbj1AcG9zaXhfZ2V0dWlkKCk7IjtpOjExNTtzOjYwOiIoZXJlZygnXltbOmJsYW5rOl1dKmNkW1s6Ymxhbms6XV0qJCcsICRfUkVRVUVTVFsnY29tbWFuZCddKSkiO2k6MTE2O3M6MjU6IiEkX1JFUVVFU1RbImM5OXNoX3N1cmwiXSkiO2k6MTE3O3M6NTM6IlBuVmxrV002MyFAI0AmZEt4fm5NRFdNfkR/L0Vzbn54fzZEQCNAJlB+fiw/blksV1B7UG9qIjtpOjExODtzOjM2OiJzaGVsbF9leGVjKCRfUE9TVFsnY21kJ10gLiAiIDI+JjEiKTsiO2k6MTE5O3M6MzU6ImlmKCEkd2hvYW1pKSR3aG9hbWk9ZXhlYygid2hvYW1pIik7IjtpOjEyMDtzOjYxOiJQeVN5c3RlbVN0YXRlLmluaXRpYWxpemUoU3lzdGVtLmdldFByb3BlcnRpZXMoKSwgbnVsbCwgYXJndik7IjtpOjEyMTtzOjM2OiI8JT1lbnYucXVlcnlIYXNodGFibGUoInVzZXIubmFtZSIpJT4iO2k6MTIyO3M6ODM6ImlmIChlbXB0eSgkX1BPU1RbJ3dzZXInXSkpIHskd3NlciA9ICJ3aG9pcy5yaXBlLm5ldCI7fSBlbHNlICR3c2VyID0gJF9QT1NUWyd3c2VyJ107IjtpOjEyMztzOjkxOiJpZiAobW92ZV91cGxvYWRlZF9maWxlKCRfRklMRVNbJ2ZpbGEnXVsndG1wX25hbWUnXSwgJGN1cmRpci4iLyIuJF9GSUxFU1snZmlsYSddWyduYW1lJ10pKSB7IjtpOjEyNDtzOjExOiIvZXRjL3Bhc3N3ZCI7aToxMjU7czoxMToiL3Zhci9jcGFuZWwiO2k6MTI2O3M6MTA6Ii9ldGMvaHR0cGQiO2k6MTI3O3M6MjM6InNoZWxsX2V4ZWMoJ3VuYW1lIC1hJyk7IjtpOjEyODtzOjE1OiIvZXRjL25hbWVkLmNvbmYiO2k6MTI5O3M6NDc6ImlmICghZGVmaW5lZCRwYXJhbXtjbWR9KXskcGFyYW17Y21kfT0ibHMgLWxhIn07IjtpOjEzMDtzOjUxOiIkbWVzc2FnZSA9IGVyZWdfcmVwbGFjZSgiJTVDJTIyIiwgIiUyMiIsICRtZXNzYWdlKTsiO2k6MTMxO3M6MTk6InByaW50ICJTcGFtZWQnPjxicj4iO2k6MTMyO3M6NjA6ImlmKGdldF9tYWdpY19xdW90ZXNfZ3BjKCkpJHNoZWxsT3V0PXN0cmlwc2xhc2hlcygkc2hlbGxPdXQpOyI7aToxMzM7czo4NDoiPGEgaHJlZj0nJFBIUF9TRUxGP2FjdGlvbj12aWV3U2NoZW1hJmRibmFtZT0kZGJuYW1lJnRhYmxlbmFtZT0kdGFibGVuYW1lJz5TY2hlbWE8L2E+IjtpOjEzNDtzOjY2OiJwYXNzdGhydSggJGJpbmRpci4ibXlzcWxkdW1wIC0tdXNlcj0kVVNFUk5BTUUgLS1wYXNzd29yZD0kUEFTU1dPUkQiO2k6MTM1O3M6NjY6Im15c3FsX3F1ZXJ5KCJDUkVBVEUgVEFCTEUgYHhwbG9pdGAgKGB4cGxvaXRgIExPTkdCTE9CIE5PVCBOVUxMKSIpOyI7aToxMzY7czo0MDoic2V0Y29va2llKCAibXlzcWxfd2ViX2FkbWluX3VzZXJuYW1lIiApOyI7aToxMzc7czo4NzoiJHJhNDQgID0gcmFuZCgxLDk5OTk5KTskc2o5OCA9ICJzaC0kcmE0NCI7JG1sID0gIiRzZDk4IjskYTUgPSAkX1NFUlZFUlsnSFRUUF9SRUZFUkVSJ107IjtpOjEzODtzOjUyOiIkX0ZJTEVTWydwcm9iZSddWydzaXplJ10sICRfRklMRVNbJ3Byb2JlJ11bJ3R5cGUnXSk7IjtpOjEzOTtzOjcxOiJzeXN0ZW0oIiRjbWQgMT4gL3RtcC9jbWR0ZW1wIDI+JjE7IGNhdCAvdG1wL2NtZHRlbXA7IHJtIC90bXAvY21kdGVtcCIpOyI7aToxNDA7czozNzoiZWxzZWlmKGZ1bmN0aW9uX2V4aXN0cygic2hlbGxfZXhlYyIpKSI7aToxNDE7czo2OToifSBlbHNpZiAoJHNlcnZhcmcgPX4gL15cOiguKz8pXCEoLis/KVxAKC4rPykgUFJJVk1TRyAoLis/KSBcOiguKykvKSB7IjtpOjE0MjtzOjY5OiJzZW5kKFNPQ0s1LCAkbXNnLCAwLCBzb2NrYWRkcl9pbigkcG9ydGEsICRpYWRkcikpIGFuZCAkcGFjb3Rlc3tvfSsrOzsiO2k6MTQzO3M6MTg6IiRmZSgiJGNtZCAgMj4mMSIpOyI7aToxNDQ7czo2ODoid2hpbGUgKCRyb3cgPSBteXNxbF9mZXRjaF9hcnJheSgkcmVzdWx0LE1ZU1FMX0FTU09DKSkgcHJpbnRfcigkcm93KTsiO2k6MTQ1O3M6NTI6ImVsc2VpZihAaXNfd3JpdGFibGUoJEZOKSAmJiBAaXNfZmlsZSgkRk4pKSAkdG1wT3V0TUYiO2k6MTQ2O3M6NzI6ImNvbm5lY3QoU09DS0VULCBzb2NrYWRkcl9pbigkQVJHVlsxXSwgaW5ldF9hdG9uKCRBUkdWWzBdKSkpIG9yIGRpZSBwcmludCI7aToxNDc7czo4OToiaWYobW92ZV91cGxvYWRlZF9maWxlKCRfRklMRVNbImZpYyJdWyJ0bXBfbmFtZSJdLGdvb2RfbGluaygiLi8iLiRfRklMRVNbImZpYyJdWyJuYW1lIl0pKSkiO2k6MTQ4O3M6ODc6IlVOSU9OIFNFTEVDVCAnMCcgLCAnPD8gc3lzdGVtKFwkX0dFVFtjcGNdKTtleGl0OyA/PicgLDAgLDAgLDAgLDAgSU5UTyBPVVRGSUxFICckb3V0ZmlsZSI7aToxNDk7czo2ODoiaWYgKCFAaXNfbGluaygkZmlsZSkgJiYgKCRyID0gcmVhbHBhdGgoJGZpbGUpKSAhPSBGQUxTRSkgJGZpbGUgPSAkcjsiO2k6MTUwO3M6Mjk6ImVjaG8gIkZJTEUgVVBMT0FERUQgVE8gJGRleiI7IjtpOjE1MTtzOjI0OiIkZnVuY3Rpb24oJF9QT1NUWydjbWQnXSkiO2k6MTUyO3M6NTk6IjwlI0B+Xkh3QUFBQT09QCNAJkRua3dLeC9/Un9VTkAjQCZueDlQZDsoQCNAJnVnY0FBQT09XiN+QCU+IjtpOjE1MztzOjM4OiIkZmlsZW5hbWUgPSAkYmFja3Vwc3RyaW5nLiIkZmlsZW5hbWUiOyI7aToxNTQ7czo0ODoiaWYoJyc9PSgkZGY9QGluaV9nZXQoJ2Rpc2FibGVfZnVuY3Rpb25zJykpKXtlY2hvIjtpOjE1NTtzOjY3OiJkb2N1bWVudC53cml0ZSh1bmVzY2FwZSgnJTNDJTY4JTc0JTZEJTZDJTNFJTNDJTYyJTZGJTY0JTc5JTNFJTNDJTUzIjtpOjE1NjtzOjQ2OiI8JSBGb3IgRWFjaCBWYXJzIEluIFJlcXVlc3QuU2VydmVyVmFyaWFibGVzICU+IjtpOjE1NztzOjMzOiJpZiAoJGZ1bmNhcmcgPX4gL15wb3J0c2NhbiAoLiopLykiO2k6MTU4O3M6NTU6IiR1cGxvYWRmaWxlID0gJHJwYXRoLiIvIiAuICRfRklMRVNbJ3VzZXJmaWxlJ11bJ25hbWUnXTsiO2k6MTU5O3M6MjY6IiRjbWQgPSAoJF9SRVFVRVNUWydjbWQnXSk7IjtpOjE2MDtzOjM4OiJpZigkY21kICE9ICIiKSBwcmludCBTaGVsbF9FeGVjKCRjbWQpOyI7aToxNjE7czoyOToiaWYgKGlzX2ZpbGUoIi90bXAvJGVraW5jaSIpKXsiO2k6MTYyO3M6Njk6Il9fYWxsX18gPSBbIlNNVFBTZXJ2ZXIiLCJEZWJ1Z2dpbmdTZXJ2ZXIiLCJQdXJlUHJveHkiLCJNYWlsbWFuUHJveHkiXSI7aToxNjM7czo1OToiZ2xvYmFsICRteXNxbEhhbmRsZSwgJGRibmFtZSwgJHRhYmxlbmFtZSwgJG9sZF9uYW1lLCAkbmFtZSwiO2k6MTY0O3M6Mjc6IjI+JjEgMT4mMiIgOiAiIDE+JjEgMj4mMSIpOyI7aToxNjU7czo1MjoibWFwIHsgcmVhZF9zaGVsbCgkXykgfSAoJHNlbF9zaGVsbC0+Y2FuX3JlYWQoMC4wMSkpOyI7aToxNjY7czoyMjoiZndyaXRlICgkZnAsICIkeWF6aSIpOyI7aToxNjc7czo1MToiU2VuZCB0aGlzIGZpbGU6IDxJTlBVVCBOQU1FPSJ1c2VyZmlsZSIgVFlQRT0iZmlsZSI+IjtpOjE2ODtzOjQyOiIkZGJfZCA9IEBteXNxbF9zZWxlY3RfZGIoJGRhdGFiYXNlLCRjb24xKTsiO2k6MTY5O3M6NTk6ImlmIChpc19jYWxsYWJsZSgiZXhlYyIpIGFuZCAhaW5fYXJyYXkoImV4ZWMiLCRkaXNhYmxlZnVuYykpIjtpOjE3MDtzOjM0OiJpZiAoKCRwZXJtcyAmIDB4QzAwMCkgPT0gMHhDMDAwKSB7IjtpOjE3MTtzOjY3OiJmb3IgKCR2YWx1ZSkgeyBzLyYvJmFtcDsvZzsgcy88LyZsdDsvZzsgcy8+LyZndDsvZzsgcy8iLyZxdW90Oy9nOyB9IjtpOjE3MjtzOjEwOiJkaXIgL09HIC9YIjtpOjE3MztzOjY6ImxzIC1sYSI7aToxNzQ7czo3NDoiY29weSgkX0ZJTEVTWyd1cGtrJ11bJ3RtcF9uYW1lJ10sImtrLyIuYmFzZW5hbWUoJF9GSUxFU1sndXBrayddWyduYW1lJ10pKTsiO2k6MTc1O3M6MTEzOiJablZ1WTNScGIyNGdlR05qS0NSd0xDUjRQVE14TlRNMk1EQXdLWHNnSkdZZ1BTQkFabWxzWlcxMGFXMWxLQ1J3S1RzZ0pHTnliMjRnUFNCMGFXMWxLQ2tnTFNBa1pqc2dKR1FnUFNCQVptbHNaVjluWiI7aToxNzY7czo4NjoiZnVuY3Rpb24gZ29vZ2xlX2JvdCgpIHskc1VzZXJBZ2VudCA9IHN0cnRvbG93ZXIoJF9TRVJWRVJbJ0hUVFBfVVNFUl9BR0VOVCddKTtpZighKHN0cnAiO2k6MTc3O3M6MTY6ImV2YTFmWWxiYWtCY1ZTaXIiO2k6MTc4O3M6NzU6ImNyZWF0ZV9mdW5jdGlvbigiJiQiLiJmdW5jdGlvbiIsIiQiLiJmdW5jdGlvbiA9IGNocihvcmQoJCIuImZ1bmN0aW9uKS0zKTsiKSI7aToxNzk7czo0NjoibG9uZyBpbnQ6dCgwLDMpPXIoMCwzKTstMjE0NzQ4MzY0ODsyMTQ3NDgzNjQ3OyI7aToxODA7czo0NjoiP3VybD0nLiRfU0VSVkVSWydIVFRQX0hPU1QnXSkudW5saW5rKFJPT1RfRElSLiI7aToxODE7czozNjoiY2F0ICR7YmxrbG9nWzJdfSB8IGdyZXAgInJvb3Q6eDowOjAiIjtpOjE4MjtzOjk3OiJAcGF0aDE9KCdhZG1pbi8nLCdhZG1pbmlzdHJhdG9yLycsJ21vZGVyYXRvci8nLCd3ZWJhZG1pbi8nLCdhZG1pbmFyZWEvJywnYmItYWRtaW4vJywnYWRtaW5Mb2dpbi8nIjtpOjE4MztzOjg3OiIiYWRtaW4xLnBocCIsICJhZG1pbjEuaHRtbCIsICJhZG1pbjIucGhwIiwgImFkbWluMi5odG1sIiwgInlvbmV0aW0ucGhwIiwgInlvbmV0aW0uaHRtbCIiO2k6MTg0O3M6MzE6ImZpbmQgLyAtdHlwZSBmIC1wZXJtIC0wNDAwMCAtbHMiO2k6MTg1O3M6MzE6ImZpbmQgLyAtdHlwZSBmIC1wZXJtIC0wMjAwMCAtbHMiO2k6MTg2O3M6MzA6ImZpbmQgLyAtdHlwZSBmIC1uYW1lIC5odHBhc3N3ZCI7aToxODc7czo2ODoiUE9TVCB7JHBhdGh9eyRjb25uZWN0b3J9P0NvbW1hbmQ9RmlsZVVwbG9hZCZUeXBlPUZpbGUmQ3VycmVudEZvbGRlcj0iO2k6MTg4O3M6MzA6IkBhc3NlcnQoJF9SRVFVRVNUWydQSFBTRVNTSUQnXSI7aToxODk7czo4OiJyb3VuZCgwKyI7aToxOTA7czozOToiZXZhbChiYXNlNjRfZGVjb2RlKCdjR2h3YVc1bWJ5Z3BPdz09JykpIjtpOjE5MTtzOjYxOiIkcHJvZD0ic3kiLiJzIi4idGVtIjskaWQ9JHByb2QoJF9SRVFVRVNUWydwcm9kdWN0J10pOyR7J2lkJ307IjtpOjE5MjtzOjE1OiJwaHAgIi4kd3NvX3BhdGgiO2k6MTkzO3M6Nzc6IiRGY2htb2QsJEZkYXRhLCRPcHRpb25zLCRBY3Rpb24sJGhkZGFsbCwkaGRkZnJlZSwkaGRkcHJvYywkdW5hbWUsJGlkZCk6c2hhcmVkIjtpOjE5NDtzOjQzOiJPREUxTkRWalpHUXlaR0V4TkdZNVpqUTRPV0ZsTldFd01qRmtPV0V6TmpFIjtpOjE5NTtzOjUxOiJzZXJ2ZXIuPC9wPlxyXG48L2JvZHk+PC9odG1sPiI7ZXhpdDt9aWYocHJlZ19tYXRjaCgiO2k6MTk2O3M6NzQ6ImU1V3JQWU5NNXVEVUMyd3JzWkh5UkxTRGcxeVdTbU16UGN6V21GRkFGcUdSMEVUY3JmYTVNU1FlQ2NIQkVjNWNrcFpSNkNyV3YxIjtpOjE5NztzOjY5OiJEMTArKzNxQm5IZnloMWlJNXRadjZ2V2lPMWhWUXZEWjVjcktWMEx0dXlvM3F3M2NBZ011ekI2TFhBUkJTN0llOUJUeG0iO2k6MTk4O3M6MTY6Ijw/cGhwIGV2YWwoJF9HRVQiO2k6MTk5O3M6MTc6Ijw/cGhwIGV2YWwoJF9QT1NUIjtpOjIwMDtzOjIwOiI8P3BocCBldmFsKCRfUkVRVUVTVCI7fQ=="));
$g_SusDB = unserialize(base64_decode("YTozNDp7aTowO3M6MjA6ImluaV9nZXQoJ3NhZmVfbW9kZScpIjtpOjE7czoyMDoiaW5pX2dldCgic2FmZV9tb2RlIikiO2k6MjtzOjI4OiJldmFsKGd6aW5mbGF0ZShiYXNlNjRfZGVjb2RlIjtpOjM7czoxOToiZXZhbChiYXNlNjRfZGVjb2RlKCI7aTo0O3M6MjA6InNycGF0aDovLy4uLy4uLy4uLy4uIjtpOjU7czo3OiI8aWZyYW1lIjtpOjY7czo5OiJnemluZmxhdGUiO2k6NztzOjEyOiJnenVuY29tcHJlc3MiO2k6ODtzOjExOiJqc29uX2RlY29kZSI7aTo5O3M6OToicGhwaW5mbygpIjtpOjEwO3M6MzE6ImV2YWwoZ3p1bmNvbXByZXNzKGJhc2U2NF9kZWNvZGUiO2k6MTE7czoxODoiZXZhbChiYXNlNjRfZGVjb2RlIjtpOjEyO3M6MTQ6IlNIT1cgREFUQUJBU0VTIjtpOjEzO3M6MTQ6InBvc2l4X2dldHB3dWlkIjtpOjE0O3M6MTc6IiRkZWZhdWx0X3VzZV9hamF4IjtpOjE1O3M6MTM6ImV2YWwodW5lc2NhcGUiO2k6MTY7czoyMzoiZG9jdW1lbnQud3JpdGUodW5lc2NhcGUiO2k6MTc7czo1OiJjb3B5KCI7aToxODtzOjE4OiJtb3ZlX3VwbG9hZGVkX2ZpbGUiO2k6MTk7czoxNjoiLjMzMzMzMzMzMzMzMzMzKyI7aToyMDtzOjEzOiIuNjY2NjY2NjY2NjY3IjtpOjIxO3M6ODoicm91bmQoMCkiO2k6MjI7czoxMzoicG9zaXhfZ2V0ZXVpZCI7aToyMztzOjEzOiJwb3NpeF9nZXRldWlkIjtpOjI0O3M6NDc6ImNvcHkoJF9GSUxFU1snZmlsZSddWyd0bXBfbmFtZSddLCAkdXBsb2FkZmlsZSkpIjtpOjI1O3M6Mjg6ImluaV9nZXQoImRpc2FibGVfZnVuY3Rpb25zIikiO2k6MjY7czoyODoiaW5pX2dldCgnZGlzYWJsZV9mdW5jdGlvbnMnKSI7aToyNztzOjE2OiJVTklPTiBTRUxFQ1QgJzAnIjtpOjI4O3M6NDoiMj4mMSI7aToyOTtzOjY6IjIgPiAmMSI7aTozMDtzOjMwOiJlY2hvICRfU0VSVkVSWydET0NVTUVOVF9ST09UJ10iO2k6MzE7czoyMToiPUFycmF5KGJhc2U2NF9kZWNvZGUoIjtpOjMyO3M6MTA6ImtpbGxhbGwgLTkiO2k6MzM7czoxNzoiaXRzb2tub3Byb2JsZW1icm8iO30="));
$g_AdwareSig = unserialize(base64_decode("YToxMTp7aTowO3M6MTk6Il9fbGlua2ZlZWRfcm9ib3RzX18iO2k6MTtzOjEzOiJMSU5LRkVFRF9VU0VSIjtpOjI7czoxODoiX19zYXBlX2RlbGltaXRlcl9fIjtpOjM7czoyNjoiZGlzcGVuc2VyLmFydGljbGVzLnNhcGUucnUiO2k6NDtzOjExOiJMRU5LX2NsaWVudCI7aTo1O3M6MTE6IlNBUEVfY2xpZW50IjtpOjY7czoxNToiZGIudHJ1c3RsaW5rLnJ1IjtpOjc7czoxNjoidGxfbGlua3NfZGJfZmlsZSI7aTo4O3M6MTU6IlRydXN0bGlua0NsaWVudCI7aTo5O3M6MTA6Ii0+U0xDbGllbnQiO2k6MTA7czo4MDoiaXNzZXQoJF9TRVJWRVJbJ0hUVFBfVVNFUl9BR0VOVCddKSAmJiAoJF9TRVJWRVJbJ0hUVFBfVVNFUl9BR0VOVCddID09ICdMTVBfUm9ib3QiO30="));
$g_JSVirSig = unserialize(base64_decode("YToxNzp7aTowO3M6NDI6ImlmKDEpe2Y9J2YnKydyJysnbycrJ20nKydDaCcrJ2FyQycrJ29kZSc7fSI7aToxO3M6MTk6Ii5wcm90b3R5cGUuYX1jYXRjaCgiO2k6MjtzOjMyOiJ0cnl7Qm9vbGVhbigpLnByb3RvdHlwZS5xfWNhdGNoKCI7aTozO3M6Mjg6ImlmKFJlZi5pbmRleE9mKCcuZ29vZ2xlLicpIT0iO2k6NDtzOjczOiJpbmRleE9mfGlmfHJjfGxlbmd0aHxtc258eWFob298cmVmZXJyZXJ8YWx0YXZpc3RhfG9nb3xiaXxocHx2YXJ8YW9sfHF1ZXJ5IjtpOjU7czo0NjoiQXJyYXkucHJvdG90eXBlLnNsaWNlLmNhbGwoYXJndW1lbnRzKS5qb2luKCIiKSI7aTo2O3M6NzE6InE9ZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgiZCIrImkiKyJ2Iik7cS5hcHBlbmRDaGlsZChxKyIiKTt9Y2F0Y2gocXcpe2g9IjtpOjc7czo2ODoiK3p6O3NzPVtdO2Y9J2ZyJysnb20nKydDaCc7Zis9J2FyQyc7Zis9J29kZSc7dz10aGlzO2U9d1tmWyJzdWJzdHIiXSgiO2k6ODtzOjEwMjoiczUocTUpe3JldHVybiArK3E1O31mdW5jdGlvbiB5ZihzZix3ZSl7cmV0dXJuIHNmLnN1YnN0cih3ZSwxKTt9ZnVuY3Rpb24geTEod2Ipe2lmKHdiPT0xNjgpd2I9MTAyNTtlbHNlIjtpOjk7czo1NjoiaWYobmF2aWdhdG9yLnVzZXJBZ2VudC5tYXRjaCgvKGFuZHJvaWR8bWlkcHxqMm1lfHN5bWJpYW4iO2k6MTA7czoxMDA6ImRvY3VtZW50LndyaXRlKCc8c2NyaXB0IGxhbmd1YWdlPSJKYXZhU2NyaXB0IiB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0iJytkb21haW4rJyI+PC9zY3InKydpcHQ+JykiO2k6MTE7czoyODoiaHR0cDovL3Boc3AucnUvXy9nby5waHA/c2lkPSI7aToxMjtzOjg6Ii5keW5kbnMuIjtpOjEzO3M6ODoiLmR5bmRucy0iO2k6MTQ7czoxNDoiPC9odG1sPjxzY3JpcHQiO2k6MTU7czoxNDoiPC9odG1sPjxpZnJhbWUiO2k6MTY7czo2MDoiPW5hdmlnYXRvclthcHBWZXJzaW9uX3Zhcl0uaW5kZXhPZigiTVNJRSIpIT0tMT8nPGlmcmFtZSBuYW1lIjt9"));

////////////////////////////////////////////////////////////////////////////
define('AI_VERSION', '20120902');

define('INFO_M', base64_decode('PGZvbnQgY29sb3I9I0UwNjA2MD7QotC+0LvRjNC60L4g0LTQu9GPINC90LXQutC+0LzQvNC10YDRh9C10YHQutC+0LPQviDQuNGB0L/QvtC70YzQt9C+0LLQsNC90LjRjyE8L2ZvbnQ+PC9oNT4='));

$l_Res = '';

$g_Structure = array();
$g_Counter = 0;

$g_NotRead = array();
$g_FileInfo = array();
$g_Iframer = array();
$g_PHPCodeInside = array();
$g_CriticalJS = array();
$g_UnixExec = array();
$g_SkippedFolders = array();

$g_TotalFolder = 0;
$g_TotalFiles = 0;

$g_FoundTotalDirs = 0;
$g_FoundTotalFiles = 0;

if (!isCli()) {
   $defaults['site_url'] = 'http://' . $_SERVER['HTTP_HOST'] . '/'; 
}

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

set_time_limit(0);
ini_set('max_execution_time', '90000');
ini_set('memory_limit','256M');

if (!function_exists('stripos')) {
	function stripos($par_Str, $par_Entry) {
		return strpos(strtolower($par_Str), strtolower($par_Entry));
	}
}

/**
 * Print file
*/
function printFile() {
	$l_FileName = $_GET['fn'];
	$l_CRC = isset($_GET['c']) ? (int)$_GET['c'] : 0;
	$l_Content = implode('', file($l_FileName));
	$l_FileCRC = crc32($l_Content);
	if ($l_FileCRC != $l_CRC) {
		print 'Доступ запрещен.';
		exit;
	}
	
	print '<pre>' . htmlspecialchars($l_Content) . '</pre>';
}

/**
 * Determine php script is called from the command line interface
 * @return bool
 */
function isCli()
{
	return php_sapi_name() == 'cli';
}

/**
 * Print to console
 * @param mixed $text
 * @param bool $add_lb Add line break
 * @return void
 */
function stdOut($text, $add_lb = true)
{
	if (!isCli())
		return;
		
	if (is_bool($text))
	{
		$text = $text ? 'true' : 'false';
	}
	else if (is_null($text))
	{
		$text = 'null';
	}
	if (!is_scalar($text))
	{
		$text = print_r($text, true);
	}

	@fwrite(STDOUT, $text . ($add_lb ? "\n" : ''));
}

/**
 * Print progress
 * @param int $num Current file
 */
function printProgress($num)
{

	$total_files = $GLOBALS['g_FoundTotalFiles'];
	$elapsed_time = microtime(true) - START_TIME;
	$stat = '';
	if ($elapsed_time >= 1)
	{
		$elapsed_seconds = round($elapsed_time, 0);
		$fs = floor($num / $elapsed_seconds);
		$left_files = $total_files - $num;
		if ($fs > 0) {
		   $left_time = ceil($left_files / $fs);
		   $stat = '. [Avg: ' . $fs . ' files/s' . ($left_time > 0  ? ' Left: ' . seconds2Human($left_time) : '') . ']';
                }
	}
	$text = "Scanning file $num of {$total_files}" . $stat;
	$text = str_pad($text, 75, ' ', STR_PAD_RIGHT);

	stdOut(str_repeat(chr(8), 80) . $text, false);
}

/**
 * Seconds to human readable
 * @param int $seconds
 * @return string
 */
function seconds2Human($seconds)
{
	$r = '';
	$_seconds = floor($seconds);
	$ms = $seconds - $_seconds;
	$seconds = $_seconds;
	if ($hours = floor($seconds / 3600))
	{
		$r .= $hours . (isCli() ? ' h ' : ' час ');
		$seconds = $seconds % 3600;
	}

	if ($minutes = floor($seconds / 60))
	{
		$r .= $minutes . (isCli() ? ' m ' : ' мин ');
		$seconds = $seconds % 60;
	}

	$r .= $seconds + ($ms > 0 ? round($ms, 5) : 0) . (isCli() ? ' s' : ' сек'); //' сек' - not good for shell

	return $r;
}

if (isCli())
{

	$cli_options = array(
		'm:' => 'memory:',
		's:' => 'size:',
		'a' => 'all',
		'd:' => 'delay:',
		'r:' => 'report:',
		'h' => 'help'
	);

	$options = getopt(implode('', array_keys($cli_options)), array_values($cli_options));

	if (isset($options['h']) OR isset($options['help']))
	{
		$memory_limit = ini_get('memory_limit');
		echo <<<HELP
AI-Bolit - Script to search for shells and other malicious software.

Usage: php {$_SERVER['PHP_SELF']} [OPTIONS] [PATH]
Current default path is: {$defaults['path']}

Mandatory arguments to long options are mandatory for short options too.
  -p, --path=PATH      Directory path to scan, by default the file directory is used
                       Current path: {$defaults['path']}
  -m, --memory=SIZE    Maximum amount of memory a script may consume. Current value: $memory_limit
                       Can take shorthand byte values (1M, 1G...)
  -s, --size=SIZE      Scan files are smaller than SIZE. 0 - All files. Current value: {$defaults['max_size_to_scan']}
  -a, --all            Scan all files (by default scan. js,. php,. html,. htaccess)
  -d, --delay=INT      delay in milliseconds when scanning files to reduce load on the file system (Default: 1)
  -r, --report=PATH    Filename of report html, by default '.2report.html'  is used, relative to scan path
                       Enter your email address if you wish to report has been sent to the email.
                       You can also specify multiple email separated by commas.
      --help           display this help and exit

HELP;
		exit;
	}

	if (
		(isset($options['memory']) AND !empty($options['memory']) AND ($memory = $options['memory']))
		OR (isset($options['m']) AND !empty($options['m']) AND ($memory = $options['m']))
	)
	{
		$memory = getBytes($memory);
		if ($memory > 0)
		{
			$defaults['memory_limit'] = $memory;
		}
	}

	if (
		(isset($options['size']) AND !empty($options['size']) AND ($size = $options['size']) !== false)
		OR (isset($options['s']) AND !empty($options['s']) AND ($size = $options['s']) !== false)
	)
	{
		$size = getBytes($size);
		$defaults['max_size_to_scan'] = $size > 0 ? $size : 0;
	}

	if (
		(isset($options['delay']) AND !empty($options['delay']) AND ($delay = $options['delay']) !== false)
		OR (isset($options['d']) AND !empty($options['d']) AND ($delay = $options['d']) !== false)
	)
	{
		$delay = (int) $delay;
		if (!($delay < 0))
		{
			$defaults['scan_delay'] = $delay;
		}
	}

	if (isset($options['all']) OR isset($options['a']))
	{
		$defaults['scan_all_files'] = 1;
	}

	if (
		(isset($options['report']) AND ($report = $options['report']) !== false)
		OR (isset($options['r']) AND ($report = $options['r']) !== false)
	)
	{
		define('REPORT', $report);
	}

	defined('REPORT') OR define('REPORT', '.2report.html');

	$last_arg = max(1, sizeof($_SERVER['argv']) - 1);
	if (isset($_SERVER['argv'][$last_arg]))
	{
		$path = $_SERVER['argv'][$last_arg];
		if (
			substr($path, 0, 1) != '-'
			AND (substr($_SERVER['argv'][$last_arg - 1], 0, 1) != '-' OR array_key_exists(substr($_SERVER['argv'][$last_arg - 1], -1), $cli_options)))
		{
			$defaults['path'] = $path;
		}
	}
}

// Init
define('MAX_ALLOWED_PHP_HTML_IN_DIR', 100);
define('BASE64_LENGTH', 100);

// принудильно запускаем полное сканирование при запуске из командной строки
if (isCli() || isset($_GET['full'])) {
  $defaults['scan_all_files'] = 1;
}

define('SCAN_ALL_FILES', (bool) $defaults['scan_all_files']);
define('SCAN_DELAY', (int) $defaults['scan_delay']);
define('MAX_SIZE_TO_SCAN', getBytes($defaults['max_size_to_scan']));

if ($defaults['memory_limit'] AND ($defaults['memory_limit'] = getBytes($defaults['memory_limit'])) > 0)
	ini_set('memory_limit', $defaults['memory_limit']);

define('START_TIME', microtime(true));

define('ROOT_PATH', realpath($defaults['path']));

if (!ROOT_PATH)
{
        if (isCli())  {
		die(stdOut("Directory '{$defaults['path']}' not found!"));
	}
}
elseif(!is_readable(ROOT_PATH))
{
        if (isCli())  {
		die(stdOut("Cannot read directory '" . ROOT_PATH . "'!"));
	}
}

define('CURRENT_DIR', getcwd());
chdir(ROOT_PATH);

// Проверяем отчет
if (isCli() AND REPORT !== '' AND !getEmails(REPORT))
{
	$report = str_replace('\\', '/', REPORT);
	$abs = strpos($report, '/') === 0 ? DIRECTORY_SEPARATOR : '';
	$report = array_values(array_filter(explode('/', $report)));
	$report_file = array_pop($report);
	$report_path = realpath($abs . implode(DIRECTORY_SEPARATOR, $report));

	define('REPORT_FILE', $report_file);
	define('REPORT_PATH', $report_path);

	if (REPORT_FILE AND REPORT_PATH AND is_file(REPORT_PATH . DIRECTORY_SEPARATOR . REPORT_FILE))
	{
		@unlink(REPORT_PATH . DIRECTORY_SEPARATOR . REPORT_FILE);
	}
}

ob_start();
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >

<style type="text/css">
 body {
   font-family: Georgia;
   color: #303030;
   background: #FFFFF0;
   font-size: 12px;
   margin: 20px;
   padding: 0;
 }

 h3 {
   font-size: 27px;
   margin: 0 0;
 }

 .sec {
  font-size: 25px;
  margin-bottom: 10px;
 }


 .warn {
   color: #FF4C00;
   margin: 0 0 20px 0;
 }

 .warn .it {
   color: #FF4C00;
 }

 .warn2 {
   color: #42ADFF;
   margin: 0 0 20px 0;
 }

 .warn2 .it {
   color: #42ADFF;
 }

 .ok {
   color: #007F0E;
   margin: 0 0 20px 0;
 }

 .vir {
    color: #A00000;
    margin: 0 0 20px 0;
  }

 .vir .it {
    color: #A00000;
 }

 .disclaimer {
   font-size: 11px;
   font-family: Arial;
   color: #505050;
   margin: 10px 0 10px 0;
 }

 .thanx {
  border: 1px solid #F0F0F0;
   padding: 20px 20px 10px 20px;
  font-size: 12px;
  font-family: Arial;
  background: #FBFFBA;
 }

 .footer {
  margin: 40px 0 0 0;
 }

 .rep {
   margin: 10px 0 20px 0;
   font-size: 11px;
   font-family: Arial;
 }

 .notice
 {
  border: 1px solid cornflowerblue;
  padding: 10px;
  font-size: 12px;
  font-family: Arial;
  background: #E8F8F8;
 }

 .offer {
  -webkit-border-radius: 6px;
   -moz-border-radius: 6px;
   border-radius: 6px;

   position: absolute;
   width: 350px;
   right: 100px;
   top: 85px;
   background: #E06060;
   color: white;
   font-size: 11px;
   font-family: Arial;
   padding: 20px 20px 10px 20px;

 }

  .offer2 {
  -webkit-border-radius: 6px;
   -moz-border-radius: 6px;
   border-radius: 6px;

   position: absolute;
   width: 350px;
   right: 100px;
   top: 100px;
   background: #30A030;
   color: white;
   font-size: 11px;
   font-family: Arial;
   padding: 20px 20px 10px 20px;

 }

 
 .offer A, .offer2 A {
   color: yellow;
 }

 .update {
   color: red;
   font-size: 12px;
   font-family: Arial;
   margin: 0 0 20px 0;
 }

 .tbg0 {
 }

 .tbg1 {
   background: #F0F0F0;
 }

 .it {
    font-size: 12px;
    font-family: Arial;
 }

 .ctd {
    font-size: 12px;
    font-family: Arial;
    color: #909090;
 }

 .flist {
   margin: 10px 0 30px 0;
 }

 .tbgh {
   background: #E0E0E0;
 }

 TH {
   text-align: left;
   font-size: 12px;
   font-family: Arial;
   color: #909090;
 }

 .details {
  font-size: 9px;
  font-family: Arial;
  color: #303030;
 }

 .marker
 {
    color: #FF0000;
    font-size: 16px;
    font-weight: 700;
 }

</style>

<script language="javascript">
  function addToIgnore(par_Lnk, par_FN, par_CRC) {
	var o = document.getElementById('igid');
	var ta = document.forms.ignore.list;
	
	ta.value = ta.value + par_FN + "\t" + par_CRC + "\n";
	
	par_Lnk.innerHTML = 'Добавлено'; 
	o.style.display = 'block';
  }
</script>

</head>
<body>

<?php

////////////////////////////////////////////////////////////////////////////
$l_Result = '';

$l_Result .= '<h3>AI-Болит v.' . AI_VERSION . ' &mdash; удаленькая искалка вредоносного ПО на хостинге.</h3><h5>Григорий Земсков, 2012, <a target=_blank href="http://revisium.com/ai/">Страница проекта на revisium.com.</a>  ' . INFO_M . '</h5>';

$l_CreationTime = filemtime(__FILE__);
if (time() - $l_CreationTime > 86400) {
  $l_Result .= '<div class="update">Проверьте обновление на сайте <a href="http://revisium.com/ai/">http://revisium.com/ai/</a>. Возможно, ваша версия скрипта уже устарела.</div>';
}

define('QCR_INDEX_FILENAME', 'fn');
define('QCR_INDEX_TYPE', 'type');
define('QCR_INDEX_WRITABLE', 'wr');
define('QCR_SVALUE_FILE', '1');
define('QCR_SVALUE_FOLDER', '0');

/**
 * Extract emails from the string
 * @param string $email
 * @return array of strings with emails or false on error
 */
function getEmails($email)
{
	$email = preg_split('#[,\s;]#', $email, -1, PREG_SPLIT_NO_EMPTY);
	$r = array();
	for ($i = 0, $size = sizeof($email); $i < $size; $i++)
	{
	        if (function_exists('filter_var')) {
   		   if (filter_var($email[$i], FILTER_VALIDATE_EMAIL))
   		   {
   		   	$r[] = $email[$i];
    		   }
                } else {
                   // for PHP4
                   if (strpos($email[$i], '@') !== false) {
   		   	$r[] = $email[$i];
                   }
                }
	}
	return empty($r) ? false : $r;
}

/**
 * Get bytes from shorthand byte values (1M, 1G...)
 * @param int|string $val
 * @return int
 */
function getBytes($val)
{
	$val = trim($val);
	$last = strtolower($val{strlen($val) - 1});
	switch($last) {
		case 't':
			$val *= 1024;
		case 'g':
			$val *= 1024;
		case 'm':
			$val *= 1024;
		case 'k':
			$val *= 1024;
	}
	return intval($val);
}

/**
 * Format bytes to human readable
 * @param int $bites
 * @return string
 */
function bytes2Human($bites)
{
	if ($bites < 1024)
	{
		return $bites . ' b';
	}
	elseif (($kb = $bites / 1024) < 1024)
	{
		return number_format($kb, 2) . ' Kb';
	}
	elseif (($mb = $kb / 1024) < 1024)
	{
		return number_format($mb, 2) . ' Mb';
	}
	elseif (($gb = $mb / 1024) < 1024)
	{
		return number_format($gb, 2) . ' Gb';
	}
	else
	{
		return number_format($gb / 1024, 2) . 'Tb';
	}
}

///////////////////////////////////////////////////////////////////////////
function needIgnore($par_FN, $par_CRC) {
  global $g_IgnoreList;
  
  for ($i = 0; $i < count($g_IgnoreList); $i++) {
     if (strpos($par_FN, $g_IgnoreList[$i][0]) !== false) {
		if ($par_CRC == $g_IgnoreList[$i][1]) {
			return true;
		}
	 }
  }
  
  return false;
}

function printList($par_List, $par_Details = null, $par_NeedIgnore = false) {
  global $g_Structure;
  
  $l_Result = '';
  $l_Result .= "<div class=\"flist\"><table cellspacing=1 cellpadding=4 border=0>";

  $l_Result .= "<tr class=\"tbgh" . ( $i % 2 ). "\">";
  $l_Result .= "<th>Путь</th>";
  $l_Result .= "<th>Дата создания</th>";
  $l_Result .= "<th>Дата модификации</th>";
  $l_Result .= "<th width=90>Размер</th>";
  $l_Result .= "<th width=90>CRC32</th>";
  
  $l_Result .= "</tr>";

  for ($i = 0; $i < count($par_List); $i++) {
    $l_Pos = $par_List[$i];
        if ($par_NeedIgnore) {
         	if (needIgnore($g_Structure['n'][$par_List[$i]], $g_Structure['crc'][$l_Pos])) {
         		continue;
         	}
        }
  
     $l_Creat = $g_Structure['c'][$l_Pos] > 0 ? date("d/m/Y H:i:s", $g_Structure['c'][$l_Pos]) : '-';
     $l_Modif = $g_Structure['m'][$l_Pos] > 0 ? date("d/m/Y H:i:s", $g_Structure['m'][$l_Pos]) : '-';
     $l_Size = $g_Structure['s'][$l_Pos] > 0 ? bytes2Human($g_Structure['s'][$l_Pos]) : '-';

     if ($par_Details != null) {
        $l_WithMarket = preg_replace('|@AI_MARKER@|smi', '<span class="marker">|</span>', $par_Details[$i]);
        $l_Body = '<div class="details">' . $l_WithMarket . '</div>';
     } else {
        $l_Body = '';
     }

     $l_Result .= '<tr class="tbg' . ( $i % 2 ). '">';
	 
	 if (is_file($g_Structure['n'][$l_Pos])) {
		$l_Result .= '<td><div class="it"><a  class="it" target="_blank" href="'. $defaults['site_url'] . 'ai-bolit.php?fn=' .
	              $g_Structure['n'][$l_Pos] . '&ph=' . crc32(PASS) . '&c=' . $g_Structure['crc'][$l_Pos] . '">' . $g_Structure['n'][$l_Pos] . '</a></div>' . $l_Body . '</td>';
	 } else {
		$l_Result .= '<td><div class="it">' . $g_Structure['n'][$par_List[$i]] . '</div></td>';
	 }
	 
     $l_Result .= '<td><div class="ctd">' . $l_Creat . '</div></td>';
     $l_Result .= '<td><div class="ctd">' . $l_Modif . '</div></td>';
     $l_Result .= '<td><div class="ctd">' . $l_Size . '</div></td>';
     $l_Result .= '<td><div class="ctd"><a href="#" onclick="addToIgnore(this, \'' . $g_Structure['n'][$l_Pos] . '\',\'' . $g_Structure['crc'][$l_Pos] . '\');return false;">' . $g_Structure['crc'][$l_Pos] . '</a></div></td>';
     $l_Result .= '</tr>';

  }

  $l_Result .= "</table></div>";

  return $l_Result;
}

///////////////////////////////////////////////////////////////////////////
function QCR_ScanDirectories($l_RootDir)
{
	global $g_Structure, $g_Counter, $g_Doorway, $g_FoundTotalFiles, $g_FoundTotalDirs, 
			$g_SkippedFolders, $g_DirIgnoreList;
	$l_DirCounter = 0;
	$l_DoorwayFilesCounter = 0;
	$l_SourceDirIndex = $g_Counter - 1;

	if ($l_DIRH = @opendir($l_RootDir))
	{
		while ($l_FileName = readdir($l_DIRH))
		{
			if ($l_FileName == '.' || $l_FileName == '..') continue;
			$l_FileName = $l_RootDir . '/' . $l_FileName;

			$l_Ext = substr($l_FileName, strrpos($l_FileName, '.') + 1);

			$l_IsDir = is_dir($l_FileName);

			// какие файлы точно нужно сканировать
			$l_NeedToScan = SCAN_ALL_FILES || (in_array($l_Ext, array(
				'js', 'php', 'php3', 'phtml', 'shtml', 'khtml',
				'php4', 'php5', 'tpl', 'inc', 'htaccess', 'html', 'htm'
			)));

			if ($l_IsDir)
			{
				// директория в игноре?
				$l_Skip = false;
				for ($dr = 0; $dr < count($g_DirIgnoreList); $dr++) {
					if (($g_DirIgnoreList[$dr] != '') &&
						preg_match('#' . $g_DirIgnoreList[$dr] . '#', $l_FileName, $l_Found)) {
						$l_Skip = true;
					}
				}
			
				// если в игноре, пропускаем ее
				if ($l_Skip) {
					$g_SkippedFolders[] = $l_FileName;
					continue;
				}
				
				$g_Structure['d'][$g_Counter] = $l_IsDir;
				$g_Structure['n'][$g_Counter] = $l_FileName;

				$l_DirCounter++;

				if ($l_DirCounter > MAX_ALLOWED_PHP_HTML_IN_DIR)
				{
					$g_Doorway[] = $l_SourceDirIndex;
					$l_DirCounter = -655360;
				}

				$g_Counter++;
				$g_FoundTotalDirs++;

				QCR_ScanDirectories($l_FileName);

			} else
			{
				if ($l_NeedToScan)
				{
					$g_FoundTotalFiles++;
					if (in_array($l_Ext, array(
						'php', 'php3',
						'php4', 'php5', 'html', 'htm', 'phtml', 'shtml', 'khtml'
					))
					)
					{
						$l_DoorwayFilesCounter++;
						
						if ($l_DoorwayFilesCounter > MAX_ALLOWED_PHP_HTML_IN_DIR)
						{
							$g_Doorway[] = $l_SourceDirIndex;
							$l_DoorwayFilesCounter = -655360;
						}
					}

					$l_Stat = stat($l_FileName);

					$g_Structure['d'][$g_Counter] = $l_IsDir;
					$g_Structure['n'][$g_Counter] = $l_FileName;
					$g_Structure['s'][$g_Counter] = $l_Stat['size'];
					$g_Structure['c'][$g_Counter] = $l_Stat['ctime'];
					$g_Structure['m'][$g_Counter] = $l_Stat['mtime'];

					$g_Counter++;
				}
			}
		}

		closedir($l_DIRH);
	}

	return $g_Structure;
}

///////////////////////////////////////////////////////////////////////////
function getFragment($par_Content, $par_Pos) {
  $l_MaxChars = 75;

  $l_PosLeft = max(0, $par_Pos - $l_MaxChars);
  $l_Len = min(strlen($par_Content) - 1, $l_MaxChars);

  $l_Res = substr($par_Content, $l_PosLeft, $l_MaxChars) .
           '@AI_MARKER@' . substr($par_Content,
           $l_PosLeft + $l_MaxChars, $l_MaxChars);


  return htmlspecialchars($l_Res);
}

///////////////////////////////////////////////////////////////////////////
function escapedHexToHex($escaped)
{ $GLOBALS['g_EncObfu']++; return chr(hexdec($escaped[1])); }
function escapedOctDec($escaped)
{ $GLOBALS['g_EncObfu']++; return chr(octdec($escaped[1])); }
function escapedDec($escaped)
{ $GLOBALS['g_EncObfu']++; return chr($escaped[1]); }

function UnwrapObfu($par_Content) {
  $GLOBALS['g_EncObfu'] = 0;

  $par_Content = preg_replace_callback('/\\\\x([a-fA-F0-9]{2})/i','escapedHexToHex', $par_Content);
  $par_Content = preg_replace_callback('/\\\\([0-9]{3})/i','escapedOctDec', $par_Content);
  $par_Content = preg_replace_callback('/\\\\d([0-9]{1,3})/i','escapedDec', $par_Content);

  return $par_Content;
}

///////////////////////////////////////////////////////////////////////////
function QCR_SearchPHP($src)
{
  if (preg_match("/(<\?php[\w\s]{5,})/smi", $src, $l_Found, PREG_OFFSET_CAPTURE)) {
	  return $l_Found[0][1];
  }

  if (preg_match("/(<%[\w\s]{10,})/smi", $src, $l_Found, PREG_OFFSET_CAPTURE)) {
	  return $l_Found[0][1];
  }
  if (preg_match("/(<script[^>]*language\s*=\s*)('|\"|)php('|\"|)([^>]*>)/i", $src, $l_Found, PREG_OFFSET_CAPTURE)) {
    return $l_Found[0][1];
  }

  return false;
}

///////////////////////////////////////////////////////////////////////////
function QCR_GoScan($par_Offset)
{
	global $g_Iframer, $g_SuspDir, $g_Redirect, $g_Doorway, $g_EmptyLink, $g_Structure, $g_Counter, 
		   $g_WritableDirectories, $g_CriticalPHP, $g_TotalFolder, $g_TotalFiles, $g_WarningPHP, $g_AdwareList,
		   $g_CriticalPHP, $g_CriticalJS, $g_CriticalJSFragment, $g_PHPCodeInside, $g_PHPCodeInsideFragment, 
		   $g_NotRead, $g_WarningPHPFragment, $g_BigFiles, $g_RedirectPHPFragment, $g_EmptyLinkSrc, $g_CriticalPHPFragment, 
                   $g_Base64Fragment, $g_UnixExec;

	static $_files_and_ignored = 0;

//	print "<pre>";
//	var_dump($g_Structure['n']);
//	print "</pre>";

	for ($i = $par_Offset; $i < $g_Counter; $i++)
	{
		$l_Filename = $g_Structure['n'][$i];

		if ($g_Structure['d'][$i])
		{
			// FOLDER
			$g_TotalFolder++;

			if (is_writable($l_Filename))
			{
				$g_WritableDirectories[] = $i;
			}
		}
		else
		{

			// FILE
			if (MAX_SIZE_TO_SCAN > 0 AND $g_Structure['s'][$i] > MAX_SIZE_TO_SCAN)
			{
				$g_BigFiles[] = $i;
			}
			else
			{
				$g_TotalFiles++;

                $l_Content = @implode('', file($l_Filename));
                if (($l_Content == '') && ($g_Structure['s'][$i] > 0)) {
                   $g_NotRead[] = $i;
                }

				$g_Structure['crc'][$i] = crc32($l_Content);
				
				$l_Unwrapped = UnwrapObfu($l_Content);

				// ignore itself
				if (strpos($l_Content, 'KHGHGGGGHJHKJHGJKHGGGHJKHGG') !== false) {
					continue;
				}

				// warnings
				$l_Pos = '';
				if (WarningPHP($l_Filename, $l_Unwrapped, $l_Pos))
				{
					$g_WarningPHP[] = $i;
					$g_WarningPHPFragment[] = getFragment($l_Content, $l_Pos);
				}

				// adware
				if (Adware($l_Filename, $l_Unwrapped))
				{
					$g_AdwareList[] = $i;
				}

				// critical
				if (CriticalPHP($l_Filename, $i, $l_Unwrapped, $l_Pos))
				{
					$g_CriticalPHP[] = $i;
					$g_CriticalPHPFragment[] = getFragment($l_Content, $l_Pos);
				}

				// critical JS
				$l_Pos = CriticalJS($l_Filename, $i, $l_Content);
				if ($l_Pos !== false)
				{
					$g_CriticalJS[] = $i;
					$g_CriticalJSFragment[] = getFragment($l_Content, $l_Pos);
				}

				if
				(stripos($l_Filename, 'index.php') ||
					stripos($l_Filename, 'index.htm') ||
					SCAN_ALL_FILES
				)
				{
					// check iframes
					if (stripos($l_Unwrapped, '<iframe'))
					{
						$g_Iframer[] = $i;
					}

					// check empty links
					if (preg_match_all('|<a[^>]+href([^>]+)>(.*?)</a>|smiu', $l_Unwrapped, $l_Found, PREG_SET_ORDER))
					{
						for ($kk = 0; $kk < count($l_Found); $kk++) {
							if ((trim(strip_tags($l_Found[$kk][2])) == '') && 
                                                           (strpos($l_Found[$kk][2], 'http://') !== false)) {
							    $g_EmptyLink[] = $i;
							    $g_EmptyLinkSrc[$i] = $l_Found;
							    break;
							}
						}
					}
				}

				// check for PHP code inside any type of file
				if ((stripos($l_Filename, '.php') === false) && 
				    (stripos($l_Filename, '.phtml') === false))
				{
					$l_Pos = QCR_SearchPHP($l_Content);
					if ($l_Pos !== false)
					{
						$g_PHPCodeInside[] = $i;
						$g_PHPCodeInsideFragment[] = getFragment($l_Unwrapped, $l_Pos);
					}
				}

				// articles
				if (stripos($l_Filename, 'article_index'))
				{
					$g_AdwareSig[] = $i;
				}

				// unix executables
				if (strpos($l_Content, chr(127) . 'ELF') !== false) 
				{
                    $g_UnixExec[] = $i;
                }
				
				// htaccess
				if (stripos($l_Filename, '.htaccess'))
				{
				
				if (stripos($l_Content, 'index.php?name=$1') !== false ||
						stripos($l_Content, 'index.php?m=1') !== false
					)
					{
						$g_SuspDir[] = $i;
					}

					$l_Pos = stripos($l_Content, '^(%2d|-)[^=]+$');
					if ($l_Pos !== false)
					{
						$g_Redirect[] = $i;
                        $g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}

					$l_Pos = stripos($l_Content, '%{HTTP_USER_AGENT}');
					if ($l_Pos !== false)
					{
						$g_Redirect[] = $i;
                        $g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}

					$l_HTAContent = preg_replace('|^\s*#.+$|m', '', $l_Content);

					if (
						preg_match_all("|RewriteRule\s+.+?\s+http://(.+?)/.+\s+\[.*R=\d+.*\]|smi", $l_HTAContent, $l_Found, PREG_SET_ORDER)
					)
					{
						$l_Host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
						for ($j = 0; $j < sizeof($l_Found); $j++)
						{
							$l_Found[$j][1] = str_replace('www.', '', $l_Found[$j][1]);
							if ($l_Found[$j][1] != $l_Host)
							{
								$g_Redirect[] = $i;
								break;
							}
						}
					}

					unset($l_HTAContent);
					
					$l_Pos = stripos($l_Content, 'auto_prepend_file');
					if ($l_Pos !== false) {
						$g_Redirect[] = $i;
						$g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}
					$l_Pos = stripos($l_Content, 'auto_append_file');
					if ($l_Pos !== false) {
						$g_Redirect[] = $i;
						$g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}

					if (preg_match("|RewriteRule\s+\^\(\.\*\)\$\s+-\s+\[\s*F\s*,\s*L\s*\]|smi", $l_Content, $l_Found)) {
						$g_Redirect[] = $i;
					}
				}
			}
			
			unset($l_Unwrapped);
			unset($l_Content);
			
			printProgress(++$_files_and_ignored);
		} // end of if (file)

		usleep(SCAN_DELAY * 1000);

	} // end of for

}

///////////////////////////////////////////////////////////////////////////
function WarningPHP($l_FN, $l_Content, &$par_Pos)
{
  global $g_SusDB;

  $l_Res = false;

  foreach ($g_SusDB as $l_Item)
  {
    if (($par_Pos = stripos($l_Content, $l_Item)) !== false) {

       $l_Res = true;
       break;
    }
  } 

  return $l_Res;
}

///////////////////////////////////////////////////////////////////////////
function Adware($l_FN, $l_Content)
{
  global $g_AdwareSig;

  $l_Res = false;

  foreach ($g_AdwareSig as $l_Item)
  {
    if (stripos($l_Content, $l_Item) !== false) {
       $l_Res = true;
       break;
    }
  }

  return $l_Res;
}

///////////////////////////////////////////////////////////////////////////
function CriticalPHP($l_FN, $l_Index, $l_Content, &$l_Pos)
{
  global $g_DBShe, $g_Base64, $g_Base64Fragment;

  // KHGHGGGGHJHKJHGJKHGGGHJKHGG
  $l_Res = false;

  foreach ($g_DBShe as $l_Item)
  {
  
    $l_Pos = stripos($l_Content, $l_Item);
    if ($l_Pos !== false) {
       $l_Res = true;
       break;
    }
  }

  if (preg_match('#((include|include_once|require|require_once)[\(\s\"\']+?http://.+?/.+?;)#smi', $l_Content, $l_Found)) {
     $g_Base64[] = $l_Index;
     $g_Base64Fragment[] = getFragment($l_Found[1], 0);
     return true;
  }

  // detect base64 suspicious
  if (preg_match('|([A-Za-z0-9+/]{' . BASE64_LENGTH . ',})|smi', $l_Content, $l_Found)
	&& (($l_Pos = stripos($l_Content, 'eval')) || ($l_Pos = stripos($l_Content, 'array_map')) ||
	($l_Pos = stripos($l_Content, 'sort')) || ($l_Pos = stripos($l_Content, 'create_function')) || ($l_Pos = stripos($l_Content, 'base64_decode')) ||
        ($l_Pos = stripos($l_Content, 'gzip_')) || ($l_Pos = stripos($l_Content, 'preg_replace_callback'))
        )
	) {
     $g_Base64[] = $l_Index;
     $g_Base64Fragment[] = getFragment($l_Content, $l_Pos);
  }

  // count number of base64_decode entries
  $l_Count = substr_count($l_Content, 'base64_decode');
  if ($l_Count > 16) {
     $g_Base64[] = $l_Index;
     $g_Base64Fragment[] = '';
  }


  return $l_Res;
}

///////////////////////////////////////////////////////////////////////////
function CriticalJS($l_FN, $l_Index, $l_Content)
{
  global $g_JSVirSig;

  $l_Res = false;

  foreach ($g_JSVirSig as $l_Item)
  {
    $l_Pos = stripos($l_Content, $l_Item);
    if ($l_Pos !== false) {
		return $l_Pos;
       break;
    }
  }

  return $l_Res;
}


///////////////////////////////////////////////////////////////////////////
if (!isCli()) {
   header('Content-type: text/html; charset=utf-8');
}

if (!isCli()) {

  if (isset($_GET['fn']) && ($_GET['ph'] == crc32(PASS))) {
     printFile();
     exit;
  }

  if ($_GET['p'] != PASS) {
    print "Запустите скрипт с паролем, который установлен в переменной PASS (в начале файла). <br/>Например, так http://ваш_сайт_и_путь_до_скрипта/ai-bolit.php?p=<b>qwe555</b>";
    exit;
  }
}

if (!is_readable(ROOT_PATH)) {
  print "Текущая директория не доступна для чтения скрипту. Пожалуйста, укажите права на доступ <b>rwxr-xr-x</b> или с помощью командной строки <b>chmod +r имя_директории</b>";
  exit;
}

$g_IgnoreList = array();
$g_DirIgnoreList = array();

$l_IgnoreFilename = '.aignore';
$l_DirIgnoreFilename = '.adirignore';

if (file_exists($l_IgnoreFilename)) {
    $l_IgnoreListRaw = file($l_IgnoreFilename);
    for ($i = 0; $i < count($l_IgnoreListRaw); $i++) 
    {
    	$g_IgnoreList[] = explode("\t", trim($l_IgnoreListRaw[$i]));
    }
    unset($l_IgnoreListRaw);
}

if (file_exists($l_DirIgnoreFilename)) {
    $g_DirIgnoreList = file($l_DirIgnoreFilename);
	
	for ($i = 0; $i < count($g_DirIgnoreList); $i++) {
		$g_DirIgnoreList[$i] = trim($g_DirIgnoreList[$i]);
	}
}

stdOut("Start scanning '" . ROOT_PATH . "'.");
QCR_ScanDirectories(ROOT_PATH);

stdOut("Founded $g_FoundTotalFiles files in $g_FoundTotalDirs directories.");
QCR_GoScan(0);

////////////////////////////////////////////////////////////////////////////

$l_Result .= "<div class=\"sec\"><b>Отчет по " . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : realpath('.')) . "</b></div>";

$time_tacked = seconds2Human(microtime(true) - START_TIME);

$l_Result .= "<div class=\"rep\">Известно ". count($g_DBShe) ." шелл-сигнатур, а также " . (count($g_SusDB) + count($g_AdwareSig ) + count($g_JSVirSig)). " других вредоносных фрагментов. Затрачено времени: <b>$time_tacked</b
>.<br/>Сканирование начато: " . date('d-m-Y в H:i:s', floor(START_TIME)) . ". Сканирование завершено: " . date('d-m-Y в H:i:s') . ".</div> ";

$l_Result .= "<div class=\"rep\">Всего проверено $g_TotalFolder директорий и $g_TotalFiles файлов.</div>";

if (!$defaults['scan_all_files']) {
	$l_Result .= '<div class="rep" style="color: #0000A0">Внимание, скрипт выполнил быструю проверку сайта. Проверяются только наиболее критические файлы, но часть вредоносных скриптов может быть не обнаружена. Пожалуйста, запустите скрипт из командной строки для выполнения полного тестирования. Подробнее смотрите в <a href="http://revisium.com/ai/faq.php">FAQ вопрос №10</a>.</div>';
}

$l_Result .= "<div class=\"sec\">Критические замечания</div>";

$l_ShowOffer = false;

stdOut("\nBuilding report\n");

stdOut("Building list of shells\n");

if (count($g_CriticalPHP) > 0) {

  $l_Result .= "<div class=\"vir\"><b>Найдены сигнатуры шелл-скрипта. Подозрение на вредоносный скрипт:</b>";
  $l_Result .= printList($g_CriticalPHP, $g_CriticalPHPFragment, true);
  $l_Result .= "</div>";

  $l_ShowOffer = true;
} else {

  $l_Result .= '<div class="ok"><b>Шелл-скрипты не найдены.</b></div>';

}

stdOut("Building list of js\n");

if (count($g_CriticalJS) > 0) {
  $l_Result .= "<div class=\"vir\"><b>Найдены сигнатуры javascript вирусов:</b>";
  $l_Result .= printList($g_CriticalJS, $g_CriticalJSFragment, true);
  $l_Result .= "</div>";

  $l_ShowOffer = true;
}

stdOut("Building list of unix executables\n");

if (count($g_UnixExec) > 0) {
  $l_Result .= "<div class=\"vir\"><b>Найдены сигнатуры исполняемых файлов unix. Они могут быть вредоносными файлами:</b>";
  $l_Result .= printList($g_UnixExec, '', true);
  $l_Result .= "</div>";

  $l_ShowOffer = true;
}

stdOut("Building list of base64s\n");

if (count($g_Base64) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"vir\"><b>Найдены длинные зашифрованные последовательности в PHP. Подозрение на вредоносный скрипт:</b>";
  $l_Result .= printList($g_Base64, $g_Base64Fragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of iframes\n");

if (count($g_Iframer) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"vir\"><b>Подозрение на вредоносный скрипт:</b>";
  $l_Result .= printList($g_Iframer, '', true);
  $l_Result .= "</div>";

}

stdOut("Building list of susp dirs\n");

if (count($g_SuspDir) > 0) {

  $l_Result .= "<div class=\"vir\"><b>Скорее всего этот файл лежит в каталоге с дорвеем:</b>";
  $l_Result .= printList($g_SuspDir);
  $l_Result .= "</div>";

} else {

  $l_Result .= '<div class="ok"><b>Не найдено директорий c дорвеями</b></div>';

}

stdOut("Building list of redirects\n");

$l_Result .= "<div class=\"sec\">Предупреждения</div>";

if (count($g_Redirect) > 0) {

  $l_ShowOffer = true;
  $l_Result .= "<div class=\"warn\"><b>Опасный код в .htaccess (редирект на внешний сервер, подмена расширений или автовнедрение кода):</b>";
  $l_Result .= printList($g_Redirect, $g_RedirectPHPFragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of php inj\n");

if (count($g_PHPCodeInside) > 0) {

  $l_ShowOffer = true;
  $l_Result .= "<div class=\"warn\"><b>В не .php файле содержится стартовая сигнатура PHP кода. Возможно, там вредоносный код:</b>";
  $l_Result .= printList($g_PHPCodeInside, $g_PHPCodeInsideFragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of adware\n");

if (count($g_AdwareList) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"warn\"><b>В этих файлах размещен код по продаже ссылок. Убедитесь, что размещали его вы:</b>";
  $l_Result .= printList($g_AdwareList, '', true);
  $l_Result .= "</div>";

}

stdOut("Building list of unread files\n");

if (count($g_NotRead) > 0) {

  $l_ShowOffer = true;
  $l_Result .= "<div class=\"warn\"><b>Непроверенные файлы - ошибка чтения:</b>";
  $l_Result .= printList($g_NotRead);
  $l_Result .= "</div>";

}
stdOut("Building list of empty links\n");

if (count($g_EmptyLink) > 0) {
  $l_ShowOffer = true;
  $l_Result .= "<div class=\"warn\"><b>В этих файлах размещены невидимые ссылки. Подозрение на ссылочный спам:</b>";
  $l_Result .= printList($g_EmptyLink, '', true);

  $l_Result .= 'Список невидимых ссылок:<br/>';
  
  for ($i = 0; $i < count($g_EmptyLink); $i++) {
	$l_Idx = $g_EmptyLink[$i];
    for ($j = 0; $j < count($g_EmptyLinkSrc[$l_Idx]); $j++) {
      $l_Result .= '<span class="details">' . $g_Structure['n'][$g_EmptyLink[$i]] . ' &rarr; ' . htmlspecialchars($g_EmptyLinkSrc[$l_Idx][$j][0]) . '</span><br/>';
	}
  }

  $l_Result .= "</div>";

}

stdOut("Building list of doorways\n");

if (count($g_Doorway) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"warn\"><b>Найдены директории, в которых подозрительно много файлов .php или .html. Подозрение на дорвей:</b>";
  $l_Result .= printList($g_Doorway);
  $l_Result .= "</div>";

}

if (count($g_WarningPHP) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"warn\"><b>Скрипт использует код, которые часто используются во вредоносных скриптах:</b>";


  $l_Result .= printList($g_WarningPHP, $g_WarningPHPFragment, true);
  $l_Result .= "</div>";

} else {

  $l_Result .= '<div class="ok"><b>Подозрительные скрипты не найдены</b></div>';

}

stdOut("Building list of skipped dirs\n");
if (count($g_SkippedFolders) > 0) {
     $l_Result .= "<div class=\"warn2\"><b>Директории из файла .adirignore были пропущены при сканировании:</b><br/>";
     $l_Result .= join("<br>", $g_SkippedFolders);
     $l_Result .= "</div>";
 }

 stdOut("Building list of writeable dirs\n");

if (!$defaults['no_rw_dir']) {
   if (count($g_WritableDirectories) > 0) {

     $l_Result .= "<div class=\"warn2\"><b>Потенциально небезопасно! Директории, доступные скрипту на запись:</b>";
     $l_Result .= printList($g_WritableDirectories);
     $l_Result .= "</div>";

   } else {

     $l_Result .= '<div class="ok"><b>Не найдено директорий, доступных на запись скриптом</b></div>';

   }
}

$max_size_to_scan = getBytes(MAX_SIZE_TO_SCAN);
$max_size_to_scan = $max_size_to_scan > 0 ? $max_size_to_scan : getBytes('1m');

stdOut("Building list of bigfiles\n");

if (count($g_BigFiles) > 0) {

  $l_Result .= "<div class=\"warn2\"><b>Большие файлы (больше чем " . bytes2Human($max_size_to_scan) . "! Пропущено:</b>";
  $l_Result .= printList($g_BigFiles);
  $l_Result .= "</div>";

} else {
  if (SCAN_ALL_FILES) {
	$l_Result .= '<div class="ok"><b>Не найдено файлов больше чем ' . bytes2Human($max_size_to_scan) . '</b></div>';
  }
}

if (function_exists('memory_get_peak_usage')) {
  $l_Result .= 'Использовано памяти при сканировании: ' . bytes2Human(memory_get_peak_usage()) . '<p>';
}

$l_Result .= '<div id="igid" style="display: none;"><div class="sec">Добавить в список игнорируемых</div>';
$l_Result .= '<form name="ignore"><textarea name="list" style="width: 600px; height: 400px;"></textarea></form>';
$l_Result .= '<div class="details">Скопируйте этот список и вставьте его в файл .aignore, чтобы исключить эти файлы из отчета.</div></div>';

if (!SCAN_ALL_FILES) {
  $l_Result .= '<div class="notice"><span class="vir">[!]</span> В скрипте отключено полное сканирование файлов, проверяются только .php, .html, .htaccess. Чтобы выполнить более тщательное сканирование, <br/>поменяйте значение настройки на <b>\'scan_all_files\' => 1</b> в самом верху скрипта. Скрипт в этом случае может работать очень долго. Рекомендуется отключить на хостинге лимит по времени выполнения, либо запускать скрипт из командной строки.</div>';
}

$l_Result .= '<div class="footer"><div class="disclaimer"><span class="vir">[!]</span> Отказ от гарантий: даже если скрипт не нашел вредоносных скриптов на сайте, автор не гарантирует их полное отсутствие, а также не несет ответственности за возможные последствия работы скрипта ai-bolit.php или неоправданные ожидания пользователей относительно функциональности и возможностей.</div>';
$l_Result .= '<div class="thanx">Замечания и предложения по работе скрипта присылайте на <a href="mailto:audit@revisium.com">audit@revisium.com</a>.<p>Также буду чрезвычайно благодарен за любые упоминания скрипта ai-bolit на вашем сайте, в блоге, среди друзей, знакомых и клиентов. Ссылочку можно поставить на <a href="http://revisium.com/ai/">http://revisium.com/ai/</a>. <p>Если будут вопросы - пишите <a href="mailto:audit@revisium.com">audit@revisium.com</a>. Кстати, еще я написал <a href="http://sale.qpl.ru/">скрипт доски объявлений</a> и собрал точную <a href="http://gzq.ru/">базу IP</a> по городам России.</div>';
$l_Result .= '</div>';

$l_OfferVK = '<p>Если у вас есть эккаунт ВКонтакте, приглашаю в <a href="http://vk.com/club37695705" target=_blank>группу "Безопасность Веб-сайтов"</a>: там я делюсь опытом защиты веб-сайтов и поиска вредоносных скриптов.</p>' ;
              

if ($l_ShowOffer) {
  print '<div class="offer" id="ofr">' .
        'Не уверены, как правильно <b>очистить сервер от вирусов и шеллов</b>? Напишите мне через <a href="http://www.revisium.com/ru/contacts/">форму на сайте</a> или на email: <a href="mailto:audit@revisium.com">audit@revisium.com</a>. Профессионально почищу сервер от вредоносных скриптов, проанализирую пути и причины появления вирусов, объясню как снизить вероятность повторного заражения. Услуга платная.<p>' .
        'Если скрипт оказался вам полезен, <br>пожалуйста, <a href="http://revisium.com/ai/others.php" target=_blank><b>поддержите проект материально</b></a>. Спасибо.' .
		$l_OfferVK .
        '<p><a href="#" onclick="document.getElementById(\'ofr\').style.display=\'none\'" style="color: #303030">[x] закрыть сообщение</a></p>' .
        '</div>';
} else {
  print '<div class="offer2" id="ofr2">' . $l_OfferVK .
        '<p><a href="#" onclick="document.getElementById(\'ofr2\').style.display=\'none\'" style="color: #303030">[x] закрыть сообщение</a></p>' .
        '</div>';
}

////////////////////////////////////////////////////////////////////////////
print $l_Result;

$l_Result = ob_get_clean();

if (!isCli())
{
	echo $l_Result;
	exit;
}

if (!defined('REPORT') OR REPORT === '')
{
	die('Report not written.');
}

$emails = getEmails(REPORT);

if (!$emails)
{
	if (defined('REPORT_PATH') AND REPORT_PATH)
	{
		if (!is_writable(REPORT_PATH))
		{
			stdOut("\nCannot write report. Report dir " . REPORT_PATH . " is not writable.");
		}

		else if (!REPORT_FILE)
		{
			stdOut("\nCannot write report. Report filename is empty.");
		}

		else if (($file = REPORT_PATH . DIRECTORY_SEPARATOR . REPORT_FILE) AND is_file($file) AND !is_writable($file))
		{
			stdOut("\nCannot write report. Report file '$file' exists but is not writable.");
		}

		else
		{
			file_put_contents($file, $l_Result);
			stdOut("\nReport written to '$file'.");
		}
	}
}
else
{
	$headers = array(
		'MIME-Version: 1.0',
		'Content-type: text/html; charset=UTF-8',
		'From: ' . ($defaults['email_from'] ? $defaults['email_from'] : 'AI-Bolit@myhost')
	);

	for ($i = 0, $size = sizeof($emails); $i < $size; $i++)
	{
		@mail($emails[$i], 'AI-Bolit Report ' . date("d/m/Y H:i", time()), $l_Result, implode("\r\n", $headers));
	}

	stdOut("\nReport sended to " . implode(', ', $emails));
}

$time_taken = microtime(true) - START_TIME;
$time_taken = number_format($time_taken, 5);
stdOut("Scanning complete! Time taken: " . seconds2Human($time_taken));

