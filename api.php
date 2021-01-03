<? php 
class coinmaster {
	const  CURL_TIMEOUT = 3600 ;
	const  CONNECT_TIMEOUT = 30 ;
	 ฟังก์ชัน ส่วนตัวCurl ( $ method , $ url , $ header , $ data , $ cookie ) {
		$ ch = curl_init ();
		curl_setopt ( $ ch , CURLOPT_URL , $ url );
		curl_setopt ( $ ch , CURLOPT_POSTFIELDS , json_encode ( อาร์เรย์ ()));
		curl_setopt ( $ ch , CURLOPT_USERAGENT , 'Mozilla / 5.0 (Windows NT 6.3) AppleWebKit / 537.36 (KHTML เช่น Gecko) Chrome / 77.0.3865.120 Safari / 537.36' );
		curl_setopt ( $ ch , CURLOPT_SSL_VERIFYHOST , เท็จ );
		curl_setopt ( $ CH , CURLOPT_SSL_VERIFYPEER , เท็จ );
		curl_setopt ( $ CH , CURLOPT_RETURNTRANSFER , จริง );
		curl_setopt ( $ CH , CURLOPT_TIMEOUT , ตนเอง :: CURL_TIMEOUT );
		curl_setopt ( $ CH , CURLOPT_CONNECTTIMEOUT , ตนเอง :: CONNECT_TIMEOUT );
		curl_setopt ( $ ch , CURLOPT_CUSTOMREQUEST , $วิธีการ );
		curl_setopt ( $ ch , CURLOPT_ENCODING , '' );
		curl_setopt ( $ ch , CURLOPT_IPRESOLVE , CURL_IPRESOLVE_V4 );
		ถ้า ( $ header ) {
			curl_setopt ( $ ch , CURLOPT_HTTPHEADER , $ header );
		}
		ถ้า ( $ data ) {
			curl_setopt ( $ ch , CURLOPT_POSTFIELDS , $ data );
		}
		ถ้า ( $ cookie ) {
			curl_setopt ( $ CH , CURLOPT_COOKIESESSION , จริง );
			curl_setopt ( $ ch , CURLOPT_COOKIEJAR , $คุกกี้ );
			curl_setopt ( $ ch , CURLOPT_COOKIEFILE , $คุกกี้ );
		}
		กลับ curl_exec ( $ ch );
	}
	 ส่วนหัวฟังก์ชัน ส่วนตัว () {
		$ header = array (
			"คาดหวัง: 100 ต่อ" ,
			"Connection: keep-alive" ,
			"โฮสต์: vik-game.moonactive.net"
		);
		ส่งคืน $ header ;
	}
	ส่วนหัว ฟังก์ชัน ส่วนตัวwhittoken ( $ devicetoken ) {
		$ header = array (
			"คาดหวัง: 100 ต่อ" ,
			"Connection: keep-alive" ,
			"X-CLIENT-VERSION: 3.5.191" ,
			"คุกกี้: cme = global;" ,
			"Content-Type: application / x-www-form-urlencoded" ,
			"การอนุญาต: ผู้ถือ" . $ devicetoken ,
			"โฮสต์: vik-game.moonactive.net"
		);
		ส่งคืน $ header ;
	}
	 ฟังก์ชัน ส่วนตัวgen_uuid () {
		กลับ sprintf ( '% 04x% 04x-% 04x-% 04x-% 04x-% 04x% 04x% 04x' ,
			mt_rand ( 0 , 0xffff ), mt_rand ( 0 , 0xffff ),
			mt_rand ( 0 , 0xffff ),
			mt_rand ( 0 , 0x0fff ) | 0x4000 ,
			mt_rand ( 0 , 0x3fff ) | 0x8000 ,
			mt_rand ( 0 , 0xffff ), mt_rand ( 0 , 0xffff ), mt_rand ( 0 , 0xffff )
		);
	}
	 ฟังก์ชัน ส่วนตัวgettokenfb () {
		$ access_tokenfb = [ '210962723864160 | WYzhnniFlO7F0kFoR47qLOVq8VY' ,
'421197359034857 | uJjtxDCSSLwSjS_mvkTd_1HvFxI' ,
'581916489311354 | Op4edD7byo7A-6S6tvxebm2erAw' ,
'3223864081053568 | hgtqpYkTnUwFHNsdnmmAMnxi0d0' ,
'147228726827769 | DSunx0H44YUVrydQKLlbAkqZW_4' ,
'827698368070670 | SVhzuNDqTMXft2_1nX05H7Suq1Q' ,];
		$ bz = 0 ;
		ทำ {
			$ facebookgen = $ this -> Curl ( "GET" , "https://graph.facebook.com/670835880297746/accounts/test-users?access_token=" . $ access_tokenfb [ $ bz ]. "& installed = true & permissions = read_stream & method = โพสต์ " ,เท็จ ,เท็จ ,เท็จ );
			$โทเค็น = json_decode ( $ facebookgen ,จริง );
			$ bz ++;
			ถ้า ( $ bz > 2 ) {
				$ bz = 0 ;
			}
			echo  "กำลังดำเนินการ >>>>:" . $ bz . "\ n" ;
		} ในขณะที่ ( ว่าง ( $ token [ 'access_token' ]));
		$ this -> fb [ 'access_token' ] = $โทเค็น [ 'access_token' ];
		ส่งคืน $ this -> fb [ 'access_token' ];
	}
	 ฟังก์ชั่น ส่วนตัวเข้าสู่ระบบ ( $ deviceID , $ devicetoken ) {
		$ข้อมูล = "อุปกรณ์% 5budid% 5d =" $ DeviceID "& API_KEY = viki & API_SECRET = coin & Client% 5bversion% 5d = 3.5_fband & Device% 5bchange% 5d = 20201105_5 & fbToken = & seq = 0" ;
		$ login = $ this -> Curl ( "POST" , "https://vik-game.moonactive.net/api/v1/users/login" , $ this -> headerwhittoken ( $ devicetoken ), $ data , false ) ;
		$ข้อมูล = json_decode ( $เข้าสู่ระบบ ,ความจริง );
		$ res =อาร์เรย์ (
			"deviceID" => $ deviceID ,
			"info" => อาร์เรย์ (
				"change_timestamp" => $ info [ 'change_timestamp' ],
				"profile" => $ info [ 'profile' ],
				"sessionToken" => $ info [ 'sessionToken' ],
				"userId" => $ info [ 'userId' ]
			)
		);
		ส่งคืน json_encode ( $ res , JSON_UNESCAPED_SLASHES );
	}
	 ฟังก์ชัน ส่วนตัวLoginfbgame ( $ deviceID , $ devicetoken , $ userid , $ fbtoken ) {
		$ข้อมูล = "อุปกรณ์% 5budid% 5d =" $ DeviceID "& API_KEY = viki & API_SECRET = เหรียญและผู้ใช้% 5bfb_token% 5d =" $ fbtoken "& p = fb & ไคลเอนต์% 5bversion% 5d = 3.5.191_fband & อุปกรณ์% 5bchange% 5d = 20201105_5" ;
		$ startlogin = $ this -> Curl ( "POST" , "https://vik-game.moonactive.net/api/v1/users/" . $ userid . "/ update_fb_data" , $ this -> headerwhittoken ( $ devicetoken ), $ data , false );
		ส่งคืน $ startlogin ;
	}
	 ฟังก์ชัน ส่วนตัวเริ่ม () {
		$ deviceID = $ นี้ -> gen_uuid ();
		$ data = array (
			'deviceId' => $ deviceID 
		);
		$ start = $ this -> Curl ( "POST" , "https://vik-game.moonactive.net/api/v1/authentication/register" , $ this -> header (), $ data , false );
		$ทะเบียน = json_decode ( $เริ่มต้น ,จริง );
		$ startlogin = $ this ->เข้าสู่ระบบ ( $ deviceID , $ register [ 'deviceToken' ]); // รับค่าทหมด
		$ startlogin = json_decode ( $ startlogin ,จริง ); // แปลงเป็นอาร์เรย์
		$ นี้ -> DeviceID = $ startlogin [ 'DeviceID' ];
		$ นี้ -> nonfbuserId = $ startlogin [ 'ข้อมูล' ] [ 'หมายเลขผู้ใช้' ];
		$ นี้ -> sessionToken = $ startlogin [ 'ข้อมูล' ] [ 'sessionToken' ];
	}
	 ฟังก์ชัน ส่วนตัวStart2 ( $ link ) {
		$ facetoken = $ นี้ -> gettokenfb ();
		$ startloginfb = $ this -> Loginfbgame ( $ this -> deviceID , $ this -> sessionToken , $ this -> nonfbuserId , $ facetoken );
		$ startloginfb = json_decode ( $ startloginfb ,จริง );
		
		ถ้า ( ว่าง ( $ startloginfb [ 'userId' ])) {
			$ this -> addspin ( $ link );
			ทางออก ();
		}
		$ this -> userId = $ startloginfb [ 'userId' ];
		$ นี้ -> fbUserId = $ startloginfb [ 'fbUserId' ];
		$ นี้ -> fbToken = $ startloginfb [ 'fbToken' ];
	}
	 addspin ฟังก์ชัน สาธารณะ ( $ link ) {
		$ นี้ ->เริ่ม ();
		$ this -> Start2 ( $ link );
		$ bossnz = preg_match_all ( '/ ~ [^}] *? s = m /' , $ link , $ a );
		ถ้า ( $ bossnz == NULL ) {
			$ bossnz = preg_match_all ( '/ ~ [^}] * /' , $ link , $ a );
			$ edit1 = str_replace ( '~' , '' , $ a [ 0 ]);
			$ edit2 = str_replace ( '' , '' , $ edit1 [ 0 ]);
			$ link = $ edit2 ;
		} else {
			$ edit1 = str_replace ( '~' , '' , $ a [ 0 ]);
			$ edit2 = str_replace ( '? s = m' , '' , $ edit1 [ 0 ]);
			$ link = $ edit2 ;
		}
		// หา userid ของคนแชร์ลิงค์ง
echo  "กำลังหา Userid เพื่อดำเนินการต่อ ... \ n" ;
		$ getuseridaddlink = $ config = $ this -> Curl ( "GET" , "https://vik-game.moonactive.net/external/users/~" . $ link . "/ เชิญ? s = m" ,เท็จ ,เท็จ ,เท็จ );
		$ getuseridaddlinkpor = preg_match_all ( '/ & amp; c = [^}] * /' , $ getuseridaddlink , $ pora );
		$ getuseridaddlink1 = str_replace ( '& amp; c =' , '' , $ pora [ 0 ]);
		$ getuseridaddlink2 = str_replace ( '' , '' , $ getuseridaddlink1 [ 0 ]);
		// ข้อมูลโพสต์
ก้อง "กำลังเข้าระบบ ... \ n" ;
		$ข้อมูล = "อุปกรณ์% 5budid% 5d =" $ นี้ ->DeviceID "& API_KEY = viki & API_SECRET = เหรียญและอุปกรณ% 5bchange% 5d = 20201105_4 & fbToken =" $ นี้ ->fbToken "& locale = th & 1604586433725 = ลบ" ;
		$ data2 = "อุปกรณ์% 5budid% 5d =" $ นี้ ->DeviceID "& API_KEY = viki & API_SECRET = เหรียญและอุปกรณ% 5bchange% 5d = 20201105_4 & fbToken =" $ นี้ ->fbToken "& locale = th" ;
		$ data3 = "อุปกรณ์% 5budid% 5d =" $ นี้ ->DeviceID "& API_KEY = viki & API_SECRET = เหรียญและอุปกรณ% 5bchange% 5d = 20201105_4 & fbToken =" $ นี้ ->fbToken "& locale = th & item = บ้าน & state = 0 & รวม% 5b0% 5d = สัตว์เลี้ยง" ;
		$ data4 = "อุปกรณ์% 5budid% 5d =" $ นี้ ->DeviceID "& API_KEY = viki & API_SECRET = เหรียญและอุปกรณ% 5bchange% 5d = 20201105_4 & fbToken =" $ นี้ ->fbToken "& locale = th & item = บ้าน & state = 1 & รวม% 5b0% 5d = สัตว์เลี้ยง" ;
		$ data5 = "อุปกรณ์% 5budid% 5d =" $ นี้ ->DeviceID "& API_KEY = viki & API_SECRET = เหรียญและอุปกรณ% 5bchange% 5d = 20201105_4 & fbToken =" $ นี้ ->fbToken "& locale = th & item = ฟาร์ม & state = 0 & รวม% 5b0% 5d = สัตว์เลี้ยง" ;
		$ data6 = "อุปกรณ์% 5budid% 5d =" $ นี้ ->DeviceID "& API_KEY = viki & API_SECRET = เหรียญและอุปกรณ% 5bchange% 5d = 20201105_4 & fbToken =" $ นี้ ->fbToken "& locale = th & item = Ship & state = 0 & include% 5b0% 5d = pets" ;
		$ dataconfig = "อุปกรณ์% 5budid% 5d =" $ นี้ ->DeviceID "& API_KEY = viki & API_SECRET = เหรียญและอุปกรณ% 5bchange% 5d = 20201105_5 & fbToken =" $ นี้ ->fbToken "& locale = th & map% 5blocale% 5d = th" ;
		$ balanceconfig = "อุปกรณ์% 5budid% 5d =" $ นี้ ->DeviceID "& API_KEY = viki & API_SECRET = เหรียญและอุปกรณ% 5bchange% 5d = 20201105_5 & fbToken = & สถาน = th & อุปกรณ์% 5bos% 5d = Android และไคลเอ็นต์% 5bversion% 5d = 3.5.210 และขยาย = true & การ config = ทั้งหมดและแบ่ง = true & ได้แก่ % 5b0% 5d = สัตว์เลี้ยงและรวม% 5b1% 5d = vquestRewards" ;
		$ datafriends = "อุปกรณ์% 5budid% 5d =" $ นี้ ->DeviceID "& API_KEY = viki & API_SECRET = เหรียญและอุปกรณ% 5bchange% 5d = 20201105_5 & fbToken =" $ นี้ ->fbToken "& locale = th & non_players = 500 & p = fb & snfb = true" ;
		$ dataaccept_invitation = "อุปกรณ์% 5budid% 5d =" $ นี้ ->DeviceID "& API_KEY = viki & API_SECRET = เหรียญและอุปกรณ% 5bchange% 5d = 20201105_5 & fbToken = & สถาน = th & เชิญ =" $ getuseridaddlink2 ;
		// เริ่มเล่นเกม
ก้อง "กำลังเริ่มเกมส์ ... \ n" ;
		$ accept_invitation = $ this -> Curl ( "POST" , "https://vik-game.moonactive.net/api/v1/users/" . $ this -> userId . "/ accept_invitation" , $ this -> headerwhittoken ( $ this -> sessionToken ), $ dataaccept_invitation , false );
		$ config = $ this -> Curl ( "POST" , "https://vik-game.moonactive.net/api/v1/users/" . $ this -> userId . "/ config" , $ this -> headerwhittoken ( $ this -> sessionToken ), $ dataconfig , false );
		$ balance = $ this -> Curl ( "POST" , "https://vik-game.moonactive.net/api/v1/users/" . $ this -> userId . "/ balance" , $ this -> headerwhittoken ( $ this -> sessionToken ), $ balanceconfig , false );
		$ friends = $ this -> Curl ( "POST" , "https://vik-game.moonactive.net/api/v1/users/" . $ this -> userId . "/ friends" , $ this -> headerwhittoken ( $ this -> sessionToken ), $ datafriends , false );
		$ upgread = $ this -> Curl ( "POST" , "https://vik-game.moonactive.net/api/v1/users/" . $ this -> userId . "/ upgrade" , $ this -> headerwhittoken ( $ this -> sessionToken ), $ data3 , false );
		$ coun = 1 ;
		สำหรับ ( $ i = 0 ; $ i < 18 ; $ i ++) {
			$ coun ++;
			$ dataspin = "อุปกรณ์% 5budid% 5d =" $ นี้ ->DeviceID "& API_KEY = viki & API_SECRET = เหรียญและอุปกรณ% 5bchange% 5d = 20201105_4 & fbToken =" $ นี้ ->fbToken "& สถาน = th & seq =" $ coun "& auto_spin = เท็จ & bet = 1 & Client% 5bversion% 5d = 3.5.210_fband" ;
			$ startspin = $ this -> Curl ( "POST" , "https://vik-game.moonactive.net/api/v1/users/" . $ this -> userId . "/ spin" , $ this -> headerwhittoken ( $ this -> sessionToken ), $ dataspin , false );
		}
		$ start = $ this -> Curl ( "POST" , "https://vik-game.moonactive.net/api/v1/users/" . $ this -> userId . "/ read_sys_messages" , $ this -> headerwhittoken ( $ this -> sessionToken ), $ data , false );
		$ upgread2 = $ this -> Curl ( "POST" , "https://vik-game.moonactive.net/api/v1/users/" . $ this -> userId . "/ upgrade" , $ this -> headerwhittoken ( $ this -> sessionToken ), $ data4 , false );
		$ upgread3 = $ this -> Curl ( "POST" , "https://vik-game.moonactive.net/api/v1/users/" . $ this -> userId . "/ upgrade" , $ this -> headerwhittoken ( $ this -> sessionToken ), $ data5 , false );
		$ upgread4 = $ this -> Curl ( "POST" , "https://vik-game.moonactive.net/api/v1/users/" . $ this -> userId . "/ upgrade" , $ this -> headerwhittoken ( $ this -> sessionToken ), $ data6 , false );
		$ dataconfigloop = "อุปกรณ์% 5budid% 5d =" $ นี้ ->DeviceID "& API_KEY = viki & API_SECRET = เหรียญและอุปกรณ% 5bchange% 5d = 20201105_5 & fbToken =" $ นี้ ->fbToken "& locale = th & map% 5bMaxXP% 5d = 4" ;
		$ configloop = $ this -> Curl ( "POST" , "https://vik-game.moonactive.net/api/v1/users/" . $ this -> userId . "/ config" , $ this -> headerwhittoken ( $ this -> sessionToken ), $ dataconfigloop , false );
		ส่งคืน $ accept_invitation ;
	}
}
?>
