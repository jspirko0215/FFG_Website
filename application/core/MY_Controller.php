<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

ini_set('display_errors', 0);

class API2_Controller extends CI_Controller
{

    protected $root_tag = 'response';
    protected $response;                //response array
    protected $request;                 //request array
    protected $errors;                  //error array
    protected $validation_rules;
    protected $user = array();          // user data

    public function __construct()
    {
        parent::__construct();
        $this->load->config('api2_config');
        $this->load->library('form_validation');
        $_POST = $_GET;
        $_POST['api'] = 1;
        if (!$this->validateRequest($this->router->method)) {
            $this->_output();
        }
        $this->request = $this->input->get();
        // If request has "token" get user data from DB
        if (isset($this->request['token']) && $this->request['token'])
            $this->user = $this->api_model->getUserDataByToken($this->request['token']); // Check $this->user var in methods for access control by token
    }

    /*
     * Outputs API response
     */

    public function validateRequest($method)
    {
        $rules = $this->config->item($method, 'api_validation');
        if (!$rules)
            return true;
        $this->form_validation->set_rules($rules);
        if (!$this->form_validation->run()) {
            //var_dump($this->form_validation);

            foreach ($this->form_validation->_error_array as $k => $v) {
                $this->addError($v, $k, 0);
            }
            return false;
        } else {
            return true;
        }
    }

    /*
     * Converts entities array to XML string
     */

    protected function addError($text, $field = null, $code = null)
    {
        $this->errors[] = array(
            'text' => $text,
            'field' => $field,
            'code' => $code,
        );
    }

    public function _output()
    {
        $this->outputResponse();
    }

    /*
     * Add error entity to array
     */

    protected function outputResponse()
    {
        if (!$this->errors && !is_array($this->response))
            $this->addError('UNDEFINED ERROR');

        if (!$this->errors)
            $res = $this->arrayToXML($this->root_tag, $this->response);
        else
            $res = $this->getErrorResponse();

        if (!isset($_POST['xml']))
            header('Content-Type: text/xml, charset=utf-8');
        echo $res;
        exit;
    }

    /*
     * Generates error document
     */

    protected function arrayToXML($root_element_name, $ar)
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><' . $root_element_name . '></' . $root_element_name . '>');
        $f = create_function('$f,$c,$a', '
            foreach($a as $k => $v)
            {
                if(is_array($v))
                {
                    if(!is_int($k))
                        $ch = $c->addChild($k);
                    else
                    {
                        $ch = $c->addChild(str_replace("_set","",$c->getName()));
                    }
                    $f($f, $ch, $v);
                }
                else
                {
                    $c->addChild($k, $v);
                }
            }
        ');
        $f($f, $xml, $ar);
        return $xml->asXML();
    }

    /*
     * Validates request parameters using rules defined in api config
     */

    protected function getErrorResponse()
    {
        $writer = new XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->startElement('error_response');

        //$writer->startElement('is_error');
        //$writer->text(1);
        //$writer->endElement();

        $writer->startElement('error_set');
        foreach ($this->errors as $error) {
            $writer->startElement('error');
            if ($error['code'] !== null) {
                $writer->startAttribute('code');
                $writer->text($error['code']);
                $writer->endAttribute();
            }
            if ($error['field']) {
                $writer->startAttribute('field');
                $writer->text($error['field']);
                $writer->endAttribute();
            }
            $writer->text($error['text']);
            $writer->endElement();
        }
        $writer->endElement();
        $writer->endElement();

        $writer->endDocument();
        $res = $writer->outputMemory();
        return $res;
    }

    /*
     * Return request variable
     */

    public function hasErrors()
    {
        return $this->errors;
    }

    public function transform($entity, $type = null)
    {
        $res = array();
        $fields = $this->config->item('default', 'api_transform');
        if ($type) {
            $fields1 = $this->config->item($type, 'api_transform');
            if ($fields1)
                $fields = array_merge($fields, $fields1);
        }
        foreach ($entity as $k => $v) {
            if (isset($fields[$k])) {
                if ($fields[$k] !== false)
                    $res[$fields[$k]] = $v;
            } else
                $res[$k] = $v;
        }
        return $res;
    }

    protected function param($key = null)
    {
        if (!$key)
            return $this->request;
        else if (!isset($this->request[$key]))
            return null;
        else
            return $this->request[$key];
    }
}

?>