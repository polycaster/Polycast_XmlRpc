<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_XmlRpc
 * @subpackage Value
 * @copyright  Copyright (c) 2005-2009 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Struct.php 17759 2009-08-22 21:26:21Z lars $
 */


/**
 * Polycast_XmlRpc_Value_Collection
 */
require_once 'Polycast/XmlRpc/Value/Collection.php';


/**
 * @category   Zend
 * @package    Zend_XmlRpc
 * @subpackage Value
 * @copyright  Copyright (c) 2005-2009 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Polycast_XmlRpc_Value_Struct extends Polycast_XmlRpc_Value_Collection
{
    /**
     * Set the value of an struct native type
     *
     * @param array $value
     */
    public function __construct($value)
    {
        $this->_type = self::XMLRPC_TYPE_STRUCT;
        parent::__construct($value);
    }

    /**
     * Return the XML code that represent struct native MXL-RPC value
     *
     * @return string
     */
    public function saveXML()
    {
        if (!$this->_as_xml) {   // The XML code was not calculated yet
            
            $generator = $this->getGenerator();
            
            // assemble envelope
            $element = new Polycast_XmlRpc_Generator_Element('value', array(
                $struct = new Polycast_XmlRpc_Generator_Element('struct')
            ));
            
            // assemble members
            if (is_array($this->_value)) {
                foreach ($this->_value as $name => $val) {
                    /* @var $val Polycast_XmlRpc_Value */
                    $struct->appendChild(new Polycast_XmlRpc_Generator_Element('member', 
                        array(
                            new Polycast_XmlRpc_Generator_Element('name', array($name)),
                            $val
                        )
                    ));
                }
            }
            
            $this->_as_xml = $this->_stripXmlDeclaration($generator->generateXml($element));
        }

        return $this->_as_xml;
    }
}

