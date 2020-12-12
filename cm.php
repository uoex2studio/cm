<?php 
require 'api.php';
$class = new coinmaster;
popen('cls', 'w');
echo "COIN MASTER | ปั้มสปิน BY | UOEX2STUDIO \n";
echo "บริการ API FACEBOOK BY | UOEX2STUDIO \n";
echo "สนใจติดต่อ ซื้อ API FACEBOOK \n";
echo "LINE : uoex2 (ทักด้วยว่า ซื้อ API FB) \n";
echo "------------------ [ ตั้งค่า ] ------------------\n";
$link = readline("ลิ้งค์ : ");
$count = readline("จำนวน : ");
popen('cls', 'w');
echo "------------------ [ 0/".$count." ] ------------------\n";
$bossnz = preg_match_all('/~[^}]*?s=m/', $link, $a);
if ($bossnz == NULL) {
	$bossnz = preg_match_all('/~[^}]*/', $link, $a);
	$edit1 = str_replace('~', '', $a[0]);
	$edit2 = str_replace('', '', $edit1[0]);
	$code = $edit2;
}else{
	$edit1 = str_replace('~', '', $a[0]);
	$edit2 = str_replace('?s=m', '', $edit1[0]);
	$code = $edit2;
}
if (empty($code)) {
	echo "ERROR : TryAgain";
	exit();
}
for ($i=0; $i < $count; $i++) {
	$start = $class->addspin($link);
	$number = $i+1;
	popen('cls', 'w');
	echo "================= [ ระบบกำลังดำเนินการขั้นตอน ] =================\n";
	print_r("[ ".$number."/".$count." ] - โค้ดลูกค้า : ".$code."\n");
}
?>