<?php
abstract class CoreController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        spl_autoload_extensions('.php');
        spl_autoload_register(function ($sNameSpace) {
            $aNameSpace = explode('\\', $sNameSpace);
            $iNameSpace = count($aNameSpace);
            $sClass = $aNameSpace[$iNameSpace - 1];
            $aClass = preg_split('/(?=[A-Z])/', $sClass);
            $iLogics = count($aClass);
            $iCount = 0;
            $sLogic = '';

            if ($iLogics > 1) {
                foreach ($aClass as $sClass) {
                    $iCount++;
                    $sLogic .= $iLogics === $iCount ? $sClass . '.php' : $sClass;
                }
            }

            $sLogicPath = APPPATH . 'logic' . DS . $sLogic;

            if (file_exists($sLogicPath) === true) {
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
