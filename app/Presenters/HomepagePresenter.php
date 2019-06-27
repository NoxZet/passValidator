<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Validate\Validator;

final class HomepagePresenter extends Nette\Application\UI\Presenter {
    
    public function renderDefault(): void {
        $this->template->requirements = Validator::getRequirements();
    }
    
    public function createComponentValidateForm(): Form {
        $form = new Form;
        // the password is intentionally not obscured (not using $form->addPassword) for this code demo
        $form->addText('pass', "Password:")->setRequired("Please enter password");
        $form->addSubmit('send', "Validate");
        $form->onSuccess[] = [$this, "validateFormSuccess"];
        return $form;
    }
    
    public function validateFormSuccess(Form $form, \stdClass $values): void {
        if (Validator::validate($values->pass))
            $this->flashMessage('Password valid');
        else
            $this->flashMessage('Password invalid!');
        $this->redirect(':');
    }
}
