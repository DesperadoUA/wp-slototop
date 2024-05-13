<?php
$response['status'] = SUCCESS_STATUS;
$response['body'] = getSettings();
echo json_encode($response);