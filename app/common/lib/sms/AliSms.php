<?php
declare(strict_types=1); //严格模式
namespace app\common\lib\sms;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use think\facade\Log;

class AliSms implements SmsBase
{
    /**
     * aliyun发送短信验证码接口
     * @param string $phone
     * @param int $code
     * @return bool
     * @throws ClientException
     */
    public static function sendCaptcha(string $phone, int $code): bool
    {
        if (empty($phone) && empty($code)) {
            return false;
        }
        AlibabaCloud::accessKeyClient(config('aliyun.access_key_id'), config('aliyun.access_secret'))
            ->regionId(config('aliyun.region_id'))
            ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host(config('aliyun.host'))
                ->options([
                    'query' => [
                        'PhoneNumbers' => $phone,
                        'RegionId' => config('aliyun.region_id'),
                        'SignName' => config('aliyun.sign_name'),
                        'TemplateCode' => config('aliyun.template_code'),
                        'TemplateParam' => json_encode(array('code' => $code)),
                    ],
                ])
                ->request();
            Log::info("alisms-sendCode{$phone}-result" . json_encode($result->toArray()));
            // print_r($result->toArray());
        } catch (ClientException $e) {
            $aaa = Log::error('alisms-sendCode{$phone}_exception' . $e->getMessage());
            return false;
            // echo $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            $aaa = Log::error('alisms-sendCode{$phone}_exception' . $e->getMessage());
            return false;
            // echo $e->getErrorMessage() . PHP_EOL;
        }
        if (isset($result['Code']) && $result['Code'] == 'OK') {
            return true;
        }
        return false;
    }
}