<?php
// if there is anything to notify, then return the response with data for
// push notification else just exit the code
$webNotificationPayload['title'] = 'Ajouter une nouvelle analyse ?';
$webNotificationPayload['body'] = 'Cliquez ici pour ajoutez une nouvelle analyse';
$webNotificationPayload['icon'] = 'https://phppot.com/badge.png';
    
echo json_encode($webNotificationPayload);
exit();
?>