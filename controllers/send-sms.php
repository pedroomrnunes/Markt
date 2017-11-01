<?php

/*
use Clickatell\Rest;
use Clickatell\ClickatellException;

$clickatell = new \Clickatell\Rest('token');

// Full list of support parameters can be found at https://www.clickatell.com/developers/api-documentation/rest-api-request-parameters/
try {
    $result = $clickatell->sendMessage(['to' => ['27111111111'], 'content' => 'Message Content']);
    foreach ($result['messages'] as $message) {
        var_dump($message);
               [
            'apiMsgId'  => null|string,            'accepted'  => boolean,            'to'        => string,             'error'     => null|string
        ]        
    }
} catch (ClickatellException $e) {   
    var_dump($e->getMessage());
} */
?> 
<script>
/* var xhr = new XMLHttpRequest();
xhr.open("GET", "https://platform.clickatell.com/messages/http/send?apiKey=8F5WrBqPQUuULaEugnhCew==&to=351913599120&content=Test+message+text", true);
xhr.onreadystatechange = function(){
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log('success');
    }
};
xhr.send(); */

var xhr = new XMLHttpRequest(),
    body = JSON.stringify({
        "content": "Test Message Text",
        "to": ["351913599120"]
    });
xhr.open("POST", 'https://platform.clickatell.com/messages', true);
xhr.setRequestHeader("Content-Type", "application/json");
xhr.setRequestHeader("Authorization", "6R_cf0bdQ7avc2fgHOBj4g==");
xhr.onreadystatechange = function(){
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log('success');
    }
};

xhr.send(body);
</script>