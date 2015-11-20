<?php

namespace Presenters;

use Rhubarb\Crown\Context;
use Rhubarb\Crown\Request\WebRequest;
use Rhubarb\Leaf\Views\UnitTestView;
use Rhubarb\Scaffolds\SurveyBuilder\Models\Survey;
use Rhubarb\Scaffolds\SurveyBuilder\Presenters\SurveyPresenter;

class SurveyPresenterTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testSurveyPresenterNeedsASurvey()
    {
        $view = new UnitTestView();

        $presenter = new SurveyPresenter();
        $presenter->attachMockView($view);
        $presenter->test();

        $this->assertTrue($view->hasNoSurvey, "Calling the survey presenter without specifying a survey should fail");

        $survey = new Survey();
        $survey->save();

        $presenter->setUrlCapturedData(1);
        $presenter->test();

        $this->assertFalse($view->hasNoSurvey, "Calling the survey presenter while specifying a survey should be ok!");

        $presenter->setUrlCapturedData(2);
        $presenter->test();

        $this->assertTrue($view->hasNoSurvey, "Calling the survey presenter without specifying a survey should fail");
    }
}