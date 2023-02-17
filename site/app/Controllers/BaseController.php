<?php

namespace App\Controllers;

use App\Models\FormModel;
use App\Models\GroupModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    protected $defaultGroupID = [];

    protected $forms = [];


    public $build = [];

    protected $session;
    

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['custom', 'auth'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);


        // Preload any models, libraries, etc, here.

        $this->session = \Config\Services::session();
        $db = \Config\Database::connect();

        if (!file_exists(ROOTPATH . '/pending_install')){

            $migrate = \Config\Services::migrations();
            $migrate->latest();

            $auth = new \Config\Auth();

            $this->defaultGroupID['owner'] = $db->table('auth_groups')->where('name', $auth->ownerGroup)->get()->getFirstRow()->id;
            $this->defaultGroupID['user'] = $db->table('auth_groups')->where('name', $auth->defaultUserGroup)->get()->getFirstRow()->id;


            $directory = FCPATH . '../writable/forms/';

            $formModel = new FormModel();
            $forms = $formModel->findAll();

            foreach($forms as $form){
                $parsed = Yaml::parseFile($directory . $form->name . '.yaml');
                cache()->save('form_'.$form->name.'_fields', $parsed);

                $required = [];
                $options = [];
                $fields = [];
                foreach($parsed['sections'] as $section){
                    foreach($section['fields'] as $fieldName => $field){
                        $fields[] = $fieldName;
                        if(isset($field['required']) && $field['required']){
                            $required[] = $fieldName;
                        }
                        if(in_array($field['type'], ['select','checkbox'])){
                            $options[$fieldName] = $field['option'];
                        }
                    }
                }
                cache()->save('form_'.$form->name.'_required', $required);
                cache()->save('form_'.$form->name.'_options', $options);
                cache()->save('form_'.$form->name.'_fieldNames', $fields);
            }
        }








    }
}