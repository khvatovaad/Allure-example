<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I
use Qameta\Allure\Allure;

class Functional extends \Codeception\Module
{
    public function checkEmptyPostRequest($url) {
        Allure::displayName('check empty post request');
        $this->getModule('REST')->sendPost($url, []);
        $this->getModule('REST')->seeResponseCodeIs(200);
    }

    public function checkInvalidParamsInGetRequest($url, $params) {
        Allure::displayName('check invalid params in request ' . implode(",", $params) );
        $this->getModule('REST')->sendGet($url, $params);
        $this->getModule('REST')->seeResponseCodeIs(200);
    }


}
