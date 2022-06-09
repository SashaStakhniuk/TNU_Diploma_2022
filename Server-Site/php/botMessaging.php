
<?php
$data = json_decode(file_get_contents('php://input'), TRUE);
//записую в файл лог повідомлень
//file_put_contents('TGDatas.txt', '$data: '.print_r($data, 1)."\n", FILE_APPEND);

$data = $data['callback_query'] ? $data['callback_query'] : $data['message'];

define('TOKEN', '5252698701:AAEAK9Ys5FSEEtWpICgZFPMowWNB7jRoZak');

$message = mb_strtolower(($data['text'] ? $data['text'] : $data['data']),'utf-8');


switch ($message) {
	case 'так':
	 $method = 'sendMessage';
		$send_data = [
			'text' => 'Який режим Ви бажаєте увімкнути?',
			'reply_markup'  => [
				'resize_keyboard' => true,
				'keyboard' => [
						[
							['text' => 'Годинник'],
							['text' => 'Анімація1'],
						],
						[
							['text' => 'Анімація2'],
							['text' => 'Анімація3'],
						]
					]
				]
			];
		writeIntoFile("on");
	break;
	case 'ні':
	 $method = 'sendMessage';
		$send_data = ['text' => 'Від цих слів, десь у світі сумує один кубик...',
						'reply_markup'  => ['remove_keyboard' => true]
					 ];
		writeIntoFile("off");
	break;
    case '/switch_on':
        $method = 'sendMessage';
		$send_data = [
			'text' => 'Cкажу, щоб прокидався. Оберіть режим роботи: ',
			'reply_markup'  => [
				'resize_keyboard' => true,
				'keyboard' => [
						[
							['text' => 'Годинник'],
							['text' => 'Анімація1'],
						],
						[
							['text' => 'Анімація2'],
							['text' => 'Анімація3'],
						]
					]
				]
			];
			writeIntoFile("on");
    break;
	case '/menu':
	 $method = 'sendMessage';
		$send_data = [
			'text' => 'Будь ласка:',
			'reply_markup'  => [
				'resize_keyboard' => true,
				'keyboard' => [
						[
							['text' => 'Годинник'],
							['text' => 'Анімація1'],
						],
						[
							['text' => 'Анімація2'],
							['text' => 'Анімація3'],
						]
					]
				]
			];
	break;	
	case '/time':
	case 'годинник':
		$method = 'sendMessage';
		$send_data = ['text' => 'Вмикаю годинник'];
		writeIntoFile("t");
	break;
	case '/switch_off':
        $method = 'sendMessage';
		$send_data = ['text' => 'Вимикаю куб...  -_-',
						'reply_markup'  => ['remove_keyboard' => true]
					 ];
		writeIntoFile("off");
    break;
	case 'анімація1':
	case '/animation1':
        $method = 'sendMessage';
		$send_data = ['text' => 'Перемикаю анімацію на перший режим =)'];
		writeIntoFile("a1");
    break;
	case 'анімація2':
	case '/animation2':
        $method = 'sendMessage';
		$send_data = ['text' => 'Змінюю анімацію на режим 2'];
		writeIntoFile("a2");
    break;
	case 'анімація3':
	case '/animation3':
        $method = 'sendMessage';
		$send_data = ['text' => 'Вмикаю анімацію №3'];
		writeIntoFile("a3");
    break;
	default:
		$method = 'sendMessage';
		$send_data = [
			'text' => 'Ви хочете погратись кубом?',
			'reply_markup'  => [
				'resize_keyboard' => true,
				'keyboard' => [
						[
							['text' => 'Так'],
							['text' => 'Ні'],
						]
					]
				]
			];
}

$send_data['chat_id'] = $data['chat'] ['id'];

$res = sendTelegram($method, $send_data);




function sendTelegram($method, $data, $headers = [])
{
	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_POST => 1,
		CURLOPT_HEADER => 0,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => 'https://api.telegram.org/bot' . TOKEN . '/' . $method,
		CURLOPT_POSTFIELDS => json_encode($data),
		CURLOPT_HTTPHEADER => array_merge(array("Content-Type: application/json"))
	]);
	$result = curl_exec($curl);
	curl_close($curl);
	return (json_decode($result, 1) ? json_decode($result, 1) : $result);
}

function writeIntoFile($value){
    $myfile = fopen("../action.txt", "w") or die("Unable to open file!");
    $value.="\n";
    fwrite($myfile, $value);
    fclose($myfile);
}

?>