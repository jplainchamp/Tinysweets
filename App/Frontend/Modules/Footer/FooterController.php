<?php
namespace App\Frontend\Modules\Footer;

use \OCFram\BackController;
use \OCFram\HTTPRequest;

class FooterController extends BackController
{
    public function executeAboutus(HTTPRequest $request)
    {
        $this->page->addVar('title', 'TINY SWEETS');

    }

    public function executeCgv(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Nos conditions générales de ventes');
    }

    public function executeContact(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Nous contacter');
    }
}