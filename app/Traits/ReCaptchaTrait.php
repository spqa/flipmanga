<?php
/**
 * Created by PhpStorm.
 * User: super
 * Date: 12/13/2016
 * Time: 10:17 PM
 */

namespace App\Traits;


use ReCaptcha\ReCaptcha;

trait ReCaptchaTrait
{
    public function captchaCheck()
    {

        $response = request('g-recaptcha-response');
        $remoteip = isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR'];
        $secret   = env('RE_CAP_SECRET');
        $recaptcha = new ReCaptcha($secret);
        $resp = $recaptcha->verify($response, $remoteip);
        if ($resp->isSuccess()) {
            return 1;
        } else {
            return 0;
        }

    }

}