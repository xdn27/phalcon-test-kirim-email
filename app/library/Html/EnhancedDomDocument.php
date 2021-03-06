<?php
/**
 * Created by PhpStorm.
 * User: gamalan
 * Date: 6/6/17
 * Time: 7:30 PM
 */

namespace Application\Html;


class EnhancedDomDocument extends \DOMDocument
{
    public static function getInstance($ns = null, $qs = null)
    {
        $di = new \DOMImplementation();
        $dt = $di->createDocumentType('html',
            '-//W3C//DTD XHTML 1.0 Transitional //EN',
            'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd');
        return $di->createDocument($ns, $qs, $dt);
    }

    public function changeDoctypeToTransitional()
    {
        try {
            $di = new \DOMImplementation();
            $dt = $di->createDocumentType('html',
                '-//W3C//DTD XHTML 1.0 Transitional //EN',
                'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd');
            $this->appendChild($dt);
        }catch (\Throwable $exc){

        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->saveHTMLExact();
    }

    /**
     * @param string $source
     * @param int $option
     * @param string $encoding
     * @return bool
     */
    public function loadHTML($source, $option = 0, $encoding = 'UTF-8')
    {
        $html = mb_convert_encoding($source, 'HTML-ENTITIES', $encoding);
        return parent::loadHTML($html); // TODO: Change the autogenerated stub
    }

    /**
     * @return string
     */
    public function saveHTMLExact()
    {
        $content = preg_replace(array("/^\<\!DOCTYPE.*?<html><body>/si",
            "!</body></html>$!si"),
            "",
            $this->saveHTML());

        return $content;
    }

    public function saveHTMLTransitional()
    {
        $content = preg_replace(array("/^\<\!DOCTYPE.*?<html><body>/si",
            "!</body></html>$!si"),
            array('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><body>'
            ,'</body></html>'),
            $this->saveHTML());

        return $content;
    }
}