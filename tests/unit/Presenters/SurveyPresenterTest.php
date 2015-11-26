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
     * @var SurveyPresenter
     */
    private $presenter;

    /**
     * @var UnitTestView
     */
    private $view;

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->view = new UnitTestView();
        $this->presenter = new SurveyPresenter();
        $this->presenter->attachMockView($this->view);

        $survey = new Survey();
        $survey->Title = "Customer Feedback 2015";
        $survey->save();
    }

    protected function _after()
    {
    }

    public function testSurveyPresenterNeedsASurvey()
    {
        $this->presenter->test();

        $this->assertTrue($this->view->hasNoSurvey, "Calling the survey presenter without specifying a survey should fail");


        $this->presenter->setUrlCapturedData(1);
        $this->presenter->test();

        $this->assertFalse($this->view->hasNoSurvey, "Calling the survey presenter while specifying a survey should be ok!");

        $this->presenter->setUrlCapturedData(2);
        $this->presenter->test();

        $this->assertTrue($this->view->hasNoSurvey, "Calling the survey presenter without specifying a survey should fail");
    }

    public function testSurveyPassesTitle()
    {
        $this->presenter->setUrlCapturedData(1);
        $this->presenter->test();

        $this->assertEquals("Customer Feedback 2015", $this->view->title);
    }

    public function testSurveyQuestionNavigation()
    {
        $this->presenter->setUrlCapturedData(1);
        $this->presenter->test();

        $this->assertEquals("1. How tall is a tree?", $this->view->question);

        $this->firstQuestion->Question = "1. How tall is a boat?";
        $this->firstQuestion->save();

        $this->presenter->test();

        $this->assertEquals("1. How tall is a boat?", $this->view->question);
    }
}