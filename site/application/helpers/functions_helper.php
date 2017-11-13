<?php

function cal($x)
{
    return round($x*0.859845228,1);
}

function green_button_data()
    {
		$xml = @simplexml_load_file(FCPATH.'uploads/1dayLP_45Days.xml');
        $arr=xml2array($xml);
		$arr=$arr[2][0];
		foreach($arr as &$x)
		{
			$x=$x[1];
			$x=array_merge($x[0],$x);
			unset($x[0]);
			$x['start']=date('Y-m-d',$x['start']);
		}
        return $arr;
	}
	
	function xml2array($xml)
    {
        $arXML = array();

        $t = array();
        if(count($xml->children()))
        {
            foreach ($xml->children() as $name => $xmlchild)
            {
                if(count($xmlchild->children()))
                    $t[] = xml2array($xmlchild);
                else
                    $t[$name] = xml2array($xmlchild);
            }
            $arXML = $t;
        }
        else
        {
            $arXML = trim((string) $xml);
        }
        return($arXML);
    }

?>
