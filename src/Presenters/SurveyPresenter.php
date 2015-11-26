<?php

namespace Rhubarb\Scaffolds\SurveyBuilder\Presenters;

use Rhubarb\Leaf\Presenters\Forms\Form;
use Rhubarb\Scaffolds\SurveyBuilder\Models\Survey;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;

class SurveyPresenter extends Form
{
    protected function createView()
    {
        return new SurveyView();
    }

    protected function applyModelToView()
    {
        parent::applyModelToView();

        $this->view->hasNoSurvey = true;

        if (isset($this->model->SurveyID)){

            try {
                $survey = $this->getSurvey();
                $this->view->title = $survey->Title;
                $this->view->question = "1. How tall is a tree?";
                $this->view->hasNoSurvey = false;
            } catch (RecordNotFoundException $er){}
        }
    }

    public function setUrlCapturedData($surveyId)
    {
        $this->model->SurveyID = $surveyId;
    }

    protected function getSurvey()
    {
        return new Survey($this->model->SurveyID);
    }
}