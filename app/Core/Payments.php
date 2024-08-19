<?php
$gopay = GoPay\payments([
  'goid' => $goid,
  'clientId' => $clientId,
  'clientSecret' => $clientSecret,
  'gatewayUrl' => 'https://gw.sandbox.gopay.com/api'
]);

$methods = [
  'gopay' => $gopay,
];
return $methods;
