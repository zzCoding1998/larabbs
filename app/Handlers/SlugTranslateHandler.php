<?php


namespace App\Handlers;


use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Overtrue\Pinyin\Pinyin;

class SlugTranslateHandler
{
    public function translate($text)
    {
        $client = new Client();

        $apiUrl = "https://fanyi-api.baidu.com/api/trans/vip/translate?";
        $appId = config('app.baidu_translate.appId');
        $key = config('app.baidu_translate.key');
        $salt = time();

        if(empty($appId) || empty($key)){
            return $this->pinyin($text);
        }

        $sign = md5($appId.$text.$salt.$key);

        $query = http_build_query([
            'q' => $text,
            'from' => 'zh',
            'to' => 'en',
            'appid' => $appId,
            'salt' => $salt,
            'sign' => $sign
        ]);
        $result = $client->get($apiUrl . $query)->getBody()->getContents();

        $result = json_decode($result,true);
        if(isset($result['trans_result'][0]['dst'])){
            return Str::slug($result['trans_result'][0]['dst']);
        }else{
            return $this->pinyin($text);
        }
    }

    protected function pinyin($text)
    {
        return Str::slug(app(Pinyin::class)->permalink($text));
    }
}
