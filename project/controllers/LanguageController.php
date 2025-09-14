<?php

require_once __DIR__ . '/../core/Controller.php';

class LanguageController extends Controller
{
    public function switch(): void
    {
        if (!$this->handleFormSubmission()) {
            $this->redirect('/');
        }

        $language = $_POST['language'] ?? null;
        $redirect = $_POST['redirect'] ?? '/';

        if ($language) {
            $this->i18n->setLanguage($language, $this->session);
        }

        $this->redirect($redirect);
    }
}
