<?php
require_once (__DIR__.'/crest.php');


$tel		 = $_POST['drop1'][1];
$name 		 = $_POST['drop1'][0];

$ut1 		 = $_POST['drop1'][2];
$ut2 		 = $_POST['drop1'][3];
$ut3		 = $_POST['drop1'][4];
$ut4 		 = $_POST['drop1'][5];
$ut5		 = $_POST['drop1'][6];

$del = ['%', '%', '}', '{'];

    $ut3 = str_replace($del, '' , $ut3);
    $ut4 = str_replace($del, '' , $ut4);
    $ut5 = str_replace($del, '' , $ut5);




$tar = $_POST['drop1'][7];

if(!$tar){
    $tar = ' ';
}


$dopi = '';

if($tar == 'Получить аудит'){
    $dopi = '(Получить аудит)';
}

if($tar == 'Пакет “Стартовый” единоразовый 19 900 руб'){
    $dopi = '(Тариф)';
}
if($tar == 'Пакет “Базовый”  до 20 сотрудников От 15 900 руб./мес'){
    $dopi = '(Тариф)';
}
if($tar == 'Пакет “Стандартный” до 50 сотрудников От 39 900 руб./мес'){
    $dopi = '(Тариф)';
}
if($tar == 'Пакет “Расширенный”  до 100 сотрудников От 63 900 руб./мес'){
    $dopi = '(Тариф)';
}


$dopi = 'Заявка с сайта КДП ' . $dopi;



if($tel == ''){

}
else{

   $contact = CRest::call(
    'crm.contact.add',
    [
        'fields' => [
            'NAME' =>  $name,
            'PHONE' => Array(
                "n0" => Array(
                    "VALUE" => "$tel",
                    "VALUE_TYPE" => "WORK",
                ),
            ),
        ],
    ]
    );

   $result = CRest::call(
    'crm.deal.add',
    [
        'fields' => [
            'TITLE' => $dopi,
            'ASSIGNED_BY_ID' => '24',
            'CATEGORY_ID' => 0,
            'CONTACT_ID' => $contact['result'],
            'UTM_SOURCE' => $ut1,
            'UTM_MEDIUM' => $ut2,
            'UTM_CAMPAIGN' => $ut3,
            'UTM_CONTENT' => $ut4,
            'UTM_TERM' => $ut5,
            'COMMENTS' => $tar,
            'SOURCE_ID' => 'WEB',
        ]
    ]
    );
}    
?>



