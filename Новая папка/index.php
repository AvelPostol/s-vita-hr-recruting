<?

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require_once (__DIR__.'/crest.php');

file_put_contents(__DIR__ . '/debag.json',  var_export($_POST, true));

$Phone = 0;


/*
$_POST = array (
  'Name' => 'тестовый конт123',
  'Phone' => '+7 (992) 222-38-87',
  'payment' => 
  array (
    'sys' => 'none',
    'systranid' => '0',
    'orderid' => '1911020594',
    'products' => 
    array (
      0 => 
      array (
        'name' => 'МЕЛЬНИЦА КОРИЦА-САХАР KOTANYI, 57 Г',
        'quantity' => '1',
        'amount' => '182',
        'externalid' => 'EaM4C2f0AaeaHIToY905',
        'price' => '182',
      ),
      1 => 
      array (
        'name' => 'МЕЛЬНИЦА ВАНИЛЬНАЯ КАРАМЕЛЬ KOTANYI, 53 Г',
        'quantity' => '1',
        'amount' => '198',
        'externalid' => 'SN1hPhGPD7CFiaNTzScd',
        'price' => '198',
      ),
    ),
    'amount' => '380',
    'subtotal' => '380',
    'delivery' => 'Самовывоз',
    'delivery_price' => '0',
    'delivery_fio' => '',
    'delivery_address' => 'RU: 190000, Санкт-Петербург',
    'delivery_comment' => '',
    'delivery_zip' => '190000',
  ),
  'COOKIES' => '_ym_uid=1675320088657932894; _ym_d=1675320088; tildauid=1675320088176.700766; _ym_isad=2; tildasid=1680521076075.862635; _ym_visorc=w; previousUrl=coffee-magnate.ru%2Faccessories',
  'formid' => 'form493249737',
  'formname' => 'Cart',
);

$result_adres = CRest::call('crm.contact.list', [
	'select' => ['ADDRESS'],
	'order' => ['DATE_CREATE' => 'DESC'],
	//'filter' => ['ID' => '687'],
]);*/



$post = $_POST;
$name = $_POST['Name'];
$Phone = $_POST['Phone'];
$payment = $_POST['payment'];
$products = $_POST['payment']['products'];


$delivery = $payment['delivery']; // Выбор доставки 
$delivery_price = $payment['delivery_price']; // заверенная стоимость доставки
$delivery_address = $payment['delivery_address']; // адресс доставки

$utm_source = $_POST['utm_source'];
$utm_ya_campaign = $_POST['utm_ya_campaign'];
$utm_content = $_POST['utm_content'];




$result_contact = CRest::call('crm.contact.list', [
	'select' => [
		'ID', 
		],
		'filter' => [
			'PHONE' => $Phone,
		]
	]);


	
if(!$result_contact['result'][0]['ID']){
	$result_contact_i = CRest::call('crm.contact.add', [
		'fields' => [
			'NAME' => $name,
			"SECOND_NAME" => "",
			"LAST_NAME" => "",
			"OPENED" => "Y",
			"ASSIGNED_BY_ID" => 17,
			"TYPE_ID" => "CLIENT",
			"SOURCE_ID" => "SELF",
			'PHONE' => array((object)["VALUE" => $Phone, "VALUE_TYPE" => "WORK"]),
			],
		]);
	$result_contact_id_f = $result_contact_i['result'];
}
else{
	$result_contact_id_f = $result_contact['result'][0]['ID'];
}


$delivery_address_point = $delivery_address;



if($delivery == 'Самовывоз'){
	$delivery_im = 85;
}
else{
	
	if($delivery == 'Доставка до двери (только по СПБ)'){
		$delivery_im = 51; // 83  85
	}
	if($delivery == 'СДЭК (пункт выдачи)'){
		$delivery_im = 53; // 83  85
	}
	if($delivery == 'СДЭК (доставка до двери)'){
		$delivery_im = 83; // 83  85
	}
	$delivery_address = $delivery . ' / ' . $delivery_address . ' / приблизительная стоимость доставки: ' . $delivery_price;
}





$All_point = '';
foreach ($_POST['payment']['products'] as $prod){

	$p_quantity = $prod['quantity'];
	$PRODUCT_NAME = $prod['name'];
	$price = $prod['price'];


	$All_point = $All_point . ' Название: ' . $PRODUCT_NAME . ' Цена: ' . $price . ' Количество: ' . $p_quantity . ' // ';
//	$All_point = $All_point .	'<ol style="text-align: left;"><li style=""><p>Название: МЕЛЬНИЦА КОРИЦА-САХАР KOTANYI, 57 Г Цена: 182 Количество: 1</p></li><li style=""><p>; Название: МЕЛЬНИЦА ВАНИЛЬНАЯ КАРАМЕЛЬ</p></li><li style=""><p>KOTANYI, 53 Г Цена: 198 Количество: 1;</p></li></ol>';
}



$result = CRest::call('crm.deal.add', [
	'fields' => [
				'CATEGORY_ID' => 0,
				'IS_NEW' => 'Y',
				'TITLE' => 'Заявка с сайта coffee-magnate.ru',
				'ASSIGNED_BY_ID' => '1',
				'STATUS_ID' => 'NEW',
			 // 'ADDRESS' => $delivery_address,
				//'ADDRESS' => 'RU: 190000, Санкт-Петербург',
				'UF_CRM_1677670535901' => [$delivery_address_point],
				'UF_CRM_1677847983' => $delivery_im,
				'COMMENTS' => $All_point,
				'CONTACT_ID' => $result_contact_id_f,
				'NAME' => $name,
			/*	'UF_CRM_1680171752' => [
					$delivery_address
				],*/
				'PHONE' =>[
					"n0" => [
						"VALUE" => $Phone,
						"VALUE_TYPE" => "WORK",
							],
					],
				'utm_source' => $utm_source,
				'utm_campaign' => $utm_ya_campaign,
				'utm_content' => $utm_content
	],
	'params' => ["REGISTER_SONET_EVENT" => "Y"]
]);

$id_deal = $result['result'];
$All_arr = [];




// товарные позиции
foreach ($_POST['payment']['products'] as $prod){

		$externalid = 1;
		$price = $prod['price'];
		$externalid = $prod['externalid'];

		if(stristr($externalid, '#', true)){
			$externalid = stristr($externalid, '#', true);
		}

		$result_products = CRest::call('crm.product.list', [
			'filter' => ['XML_ID' => $externalid],
			'select' => ["ID"],
		]);
		$PRODUCT_ID = '0';
		
		foreach($result_products as $result_product){
			if($result_product[0]['ID']){
				$PRODUCT_ID = $result_product[0]['ID'];
			}
	
			

		}

		$p_quantity = $prod['quantity'];
		$PRODUCT_NAME = $prod['name'];



		$an_ar1 = [];
		$an_ar1['PRODUCT_ID'] = $PRODUCT_ID;
		$an_ar1['PRICE'] = $price;
		$an_ar1['QUANTITY'] = $p_quantity;

		$an_ar1['PRODUCT_NAME'] = $PRODUCT_NAME;

	

		$All_arr[] = $an_ar1;
		
	
	}


$result_f = CRest::call('crm.deal.productrows.set', [
	'id' => $id_deal,
	'rows' => $All_arr
]);

