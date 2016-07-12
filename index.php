<?php
header('Content-Type: text/html; charset=UTF-8');
$host = "localhost";
$username = "hasegawa";
$pass = "hasegawa0515";
$dbname = "lesson";
$sql = "SELECT * FROM `kadai_hasegawa_ziplist`";
$table_sql = "SHOW FULL COLUMNS FROM `kadai_hasegawa_ziplist`";

$link = mysql_connect($host, $username, $pass);
$db = mysql_select_db($dbname, $link);
mysql_query('SET NAMES utf8', $link );

$res = mysql_query($sql);
$column_count = mysql_num_fields($res);

$table_data = mysql_query($table_sql);

$count_th = 0;
?>
<html>
<head>
<title>PHP課題4_3</title>
</head>
<body>
	<p>PHP課題4_3</p>
	<table border=1>
		<?php
		printf("<tr></tr>");
		while ($count_th < $column_count) {
			$show_table_data = mysql_fetch_assoc($table_data);
			printf("<th>%s</th>", print_r($show_table_data["Comment"],true));
			$count_th++;
		}
		$count_th = 0;
		while($row = mysql_fetch_assoc($res)) {
			printf("<tr></tr>");
			while ($count_th < $column_count) {
				$column_name = mysql_field_name($res, $count_th);	//カラム名取得
				$count_th++;
				if($count_th == 3){
					printf("<th><a href='%s?postal_code=%s'>%s</a></th>","overwrite.php",$row[print_r($column_name,true)],$row[print_r($column_name,true)]);
				}elseif (10 <= $count_th) {
					if ($count_th == 13) {
						if ($row[print_r($column_name,true)] == 0) {
							printf("<th>該当せず</th>");
						}else{
							printf("<th>該当</th>");
						}
					}else if ($count_th == 14) {
						switch ($row[print_r($column_name,true)]) {
							case 0:
								printf("<th>変更なし</th>");
								break;
							case 1:
								printf("<th>変更あり</th>");
								break;
							case 2:
								printf("<th>廃止(廃止データのみ使用)</th>");
								break;
						}
					}else{
						switch ($row[print_r($column_name,true)]) {
							case 0:
								printf("<th>変更なし</th>");
								break;
							case 1:
								printf("<th>市政・区政・町政・分区・政令指定都市施行</th>");
								break;
							case 2:
								printf("<th>住居表示の実施</th>");
								break;
							case 3:
								printf("<th>区画整理</th>");
								break;
							case 4:
								printf("<th>郵便区調整等</th>");
								break;
							case 5:
								printf("<th>訂正</th>");
								break;
							case 6:
								printf("<th>廃止(廃止データのみ使用)</th>");
								break;
						}
					}
				}else{
					printf("<th>%s</th>", $row[print_r($column_name,true)]);
				}
			}
			$count_th = 0;
		}
		?>
	</table>
</body>
<?php mysql_close($link); ?>
</html>