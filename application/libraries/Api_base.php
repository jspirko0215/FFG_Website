<?php

class Api_Base
{

    protected $writer;
    protected $response;
    protected $request;
    protected $validationRules;
    protected $errors;
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->writer = new XMLWriter();
        $this->writer->openMemory();
        $this->errors = array();
        $_POST=array_merge($_POST,$_GET);
        $this->readRequest();
    }

    public function readRequest()
    {
        $this->request = $this->CI->input->get();
    }

    public function validateRequest()
    {
        $baseRules = array(
            array(
                'field' => 'gymID',
                'label' => 'gymID',
                'rules' => 'required|integer'
            ),
            array(
                'field' => 'authKey',
                'label' => 'authKey',
                'rules' => 'required'
            ),
        );
        $this->CI->load->library('form_validation');
        $this->CI->form_validation->set_rules($this->validationRules);
        $this->CI->form_validation->set_rules($baseRules);
        if (!$this->CI->form_validation->run())
        {
            $this->addError(0, 'Invalid request format');
        }
        else
        {
            $this->CI->load->model('Gym_model', '', TRUE);
            $res = $this->CI->Gym_model->getGym($this->request['gymID'], $this->request['authKey']);
            if (!$res)
            {
                $this->addError(0, 'Wrong gymID or authKey');
            }
            else
            {
                return true;
            }
        }
    }

    protected function addError($code=0, $text='Error', $field='')
    {
        $this->errors[] = array('code' => $code, 'text' => $text, 'field' => $field);
    }

    protected function errorResponse()
    {
	header('Content-Type: text/xml, charset=utf-8');
        $this->writer->startDocument('1.0', 'UTF-8');
        $this->writer->startElement('response');

        $this->writer->startElement('is_error');
        $this->writer->text(1);
        $this->writer->endElement();

        $this->writer->startElement('errors');
        foreach ($this->errors as $error)
        {
            $this->writer->startElement('error');
            $this->writer->startAttribute('code');
            $this->writer->text($error['code']);
            $this->writer->endAttribute();
            $this->writer->startAttribute('field');
            $this->writer->text($error['field']);
            $this->writer->endAttribute();
            $this->writer->text($error['text']);
            $this->writer->endElement();
        }
        $this->writer->endElement();
        $this->writer->endElement();

        $this->writer->endDocument();
        $this->response = $this->writer->outputMemory();
        echo $this->response;
    }

    protected function successResponse($data)
    {
	header('Content-Type: text/xml, charset=utf-8');
        echo $this->assocArrayToXML('response',$data);
        return;
        $this->writer->startDocument('1.0', 'UTF-8');
        $this->writer->startElement('response');

        foreach ($data as $key => $value)
        {
            $this->writer->startElement($key);
            $this->writer->text($value);
            $this->writer->endElement();
        }
        $this->writer->endElement();
        $this->writer->endDocument();
        $this->response = $this->writer->outputMemory();
        echo $this->response;
    }

    /*private function writeEntity($name, $childs)
    {
        $buf='';
        $this->writer->startElement($name);
        foreach ($data as $key => $value)
        {
            if(is_array($value))
                $buf=$this->writeEntity ($key, $value);
        }
        $this->writer->endElement();
    }*/

    public function assocArrayToXML($root_element_name,$ar)
    {
        $xml = new SimpleXMLElement("<?xml version=\"1.0\"?><{$root_element_name}></{$root_element_name}>");
        $f = create_function('$f,$c,$a', '
            foreach($a as $k=>$v) {
                if(is_array($v)) {
                    $k=$v["entityName"];
                    unset($v["entityName"]);
                    $ch=$c->addChild($k);
                    $f($f,$ch,$v);
                } else {
                    $c->addChild($k,$v);
                }
            }');
        $f($f, $xml, $ar);
        return $xml->asXML();
    }

    public function hasErrors()
    {
        return count($this->errors);
    }

}

?>
