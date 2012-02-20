INSERT INTO `cart`.`cscart_payment_processors` (
`processor_id` ,
`processor` ,

`processor_script` ,
`processor_template` ,
`admin_template` ,
`callback` ,
`type`
)
VALUES (
NULL , 'SohaPay', 'class_sohapay.php', 'sohapay.tpl', 'sohapay.tpl', 'Y', 'P'
);
