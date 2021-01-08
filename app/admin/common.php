<?php
// 这是系统自动生成的公共文件
function show($status, $message = '', $data = []) {
    $result = [
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ];

    echo json_encode($result);
}