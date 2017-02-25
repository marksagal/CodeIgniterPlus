<?php
class Home extends CoreController
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $sStyle = $this->css(['sample_style.css'], 'sample');
        $sScript = $this->js(['sample_source.js'], 'sample');

        $this->blade->view('home', ['js' => $sScript, 'css' => $sStyle]);
    }
}
