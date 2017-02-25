<?php
abstract class CoreController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        spl_autoload_extensions('.php');
        spl_autoload_register(function ($sClass) {
            $sLogicPath = APPPATH . 'logic' . DS . $sClass . '.php';

            if (file_exists($sLogicPath) === true && empty($sClass) !== true) {
                require_once $sLogicPath;
            }
        });
    }

    protected function js($aScripts, $sPath)
    {
        $this->minify->add_js($aScripts, 'js' . DS . $sPath);
        $this->minify->deploy_js();

        return '/assets/js/' . $sPath . '_scripts.min.js';
    }

    protected function css($aStyles, $sPath)
    {
        $this->minify->add_css($aStyles, 'css' . DS . $sPath);
        $this->minify->deploy_css();

        return '/assets/css/' . $sPath . '_styles.min.css';
    }
}
