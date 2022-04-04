<?php
use Qameta\Allure\Allure;
use Qameta\Allure\Attribute\DisplayName;
use Qameta\Allure\Attribute\Severity;
use Qameta\Allure\Attribute\Feature;
use Qameta\Allure\Attribute\Story;
use Qameta\Allure\Attribute\Label;


class ExampleCest
{

    /**
     * @dataProvider dataProvider
     */
    #[
        Feature("post"),
        Severity(Severity::CRITICAL),
        DisplayName("postman/post positive"),
        Label(Label::OWNER,  "Анастасия")
    ]
    public function checkPostRequest(FunctionalTester $tester, \Codeception\Example $dataProvider) {
        Allure::tag('positive');
        Allure::description($dataProvider['title']);

        $tester->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $tester->sendPost('post', [$dataProvider['params']]);
        $tester->canSeeResponseCodeIs(200);
        $tester->checkEmptyPostRequest('post');

    }
    #[
        Feature("post"),
        Severity(Severity::CRITICAL),
        DisplayName("postman/post negative"),
        Label(Label::OWNER,  "Анастасия")
    ]
    public function checkPostRequestNegative(FunctionalTester $tester) {
        Allure::tag('negative');
        Allure::description('Пример 3');
        $tester->checkEmptyPostRequest('post');
    }

    private function dataProvider() {
        return [
            [
                'title' => "Пример 1",
                'params' => ['strange' => 'boom'],
            ],
            [
                'title' => "Пример 2",
                'params' => ['strange' => 'boom11'],
            ],
        ];
    }


}
