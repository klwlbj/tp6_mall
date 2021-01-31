<?php
// 这是系统自动生成的公共文件
/**通用化api数据格式输岀
 * @param $status
 * @param string $message
 * @param array $data
 * @param string $httpStatus
 * @return false|string
 */
function show($status, $message = '', $data = [], $httpStatus = 200)
{
    $result = [
        'status' => $status,
        'message' => $message,
        'data' => $data,
        // 'httpStatus' => $httpStatus,
    ];

    return json_encode($result, $httpStatus);
}