<?php
/**
 * @Copyright
 * @package     Field - license check
 * @author      anton {@link http://www.dibuxo.com}
 * @version     Joomla! 2.5 - 1.0.24
 * @date        Created on 09-09-2013
 * @link        Project Site {@link http://store.dibuxo.com}
 *
 * @license GNU/GPL
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

defined('JPATH_PLATFORM') or die;

class JFormFieldS2sLicenseCheck extends JFormField
{
    protected $type = 's2slicensecheck';

    protected function getLabel(){
        return "<strong>License</strong>";
    }

    protected function getInput()
    {
        $field_set = $this->form->getFieldset();
        $license_email = $field_set['jform_params_s2s_license_email']->value;

        //sesion para no llamar cada vez
        $session = JFactory::getSession();
        $valida_sesion = $session->get('s2slicensecheck');
        //var_dump($valida_sesion);

        $valida = $this->_checkLicense($license_email);

        if($valida){

            $field_value='<div class="alert alert-success">'.JText::_('SOCIAL2S_FIELD_LICENSE_OK').'</div>';
        
         }else{
            //mensaje de alerta y compra
            // Get the params and set the new values
            /*LITE*/
            $params = $this->form->getValue('params');
            $params->s2s_stupid_cookie_on = '0';
            //$params->s2sgroup = '0';
            //$params->s2s_size = 'btn';
            $params->s2s_insert = '0';

            //consulta

            $reparams = $this->form->getValue('params');
    
            $encode_params = json_encode($reparams);
            $db = JFactory::getDBO();
            $query = $db->getQuery(true);
            // Build the query
            $query->update('#__extensions AS a');
            $query->set('a.params = ' . $db->quote((string)$encode_params));
            $query->where('a.element = "social2s"');

            // Execute the query
            $db->setQuery($query);
            $db->query();

            //alerta LITE
            $field_value='<div class="alert alert-error"><h4>'.JText::_('SOCIAL2S_DONATE').'</h4>'.JText::_('SOCIAL2S_DONATE_DESC').'</div>';
        }

        //$field_set = $this->form->getFieldset();
        $field_value .= "";

        return $field_value;
    }

    private function _checkLicense($email){

        $params = $this->form->getValue('params');

        $session = JFactory::getSession();
        if(!$session->get('s2semailcheck')){
            $session->set('s2semailcheck',$email);
        }
        if(!$session->get('s2slicensecheck')){
            $session->set('s2slicensecheck',0);
        }

        $valida = false;

        if($email==""){
            //$valida = false;
            $session->set('s2slicensecheck', 0);
            $session->set('s2semailcheck',$email);
        }else{
            $email_session = $session->get('s2semailcheck');

            if($email_session != $email){
                $session->set('s2slicensecheck', 0);
                $session->set('s2semailcheck',$email);

                if($this->_checkHome($email)){

                    $session->set('s2slicensecheck', 1);
                    $valida = true;
                }else{
                    $session->set('s2slicensecheck', 0); 
                    $valida = false;
                }
            }else{

                if($session->get('s2slicensecheck') == 1){
                    $valida = true;
                }else{
                    if($this->_checkHome($email)){
                        $valida = true;
                    }else{
                        $valida = false;
                    }
                }
            }
        }
        return $valida;
    }

    private function _checkHome($email){

        $url_fopen = ini_get('allow_url_fopen');
        if(function_exists('curl_init') && !empty($url_fopen)){

            $url_check = 'http://soft.dibuxo.com/licenses/social2s/validation.php?email='.$email;
            $curl_response = curl_init($url_check);
            curl_setopt($curl_response, CURLOPT_HEADER, 0);
            curl_setopt($curl_response, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl_response, CURLOPT_NOSIGNAL, 1);
            curl_setopt($curl_response, CURLOPT_CONNECTTIMEOUT, 5);
            $response = curl_exec($curl_response);

            $session = JFactory::getSession();
            //echo "</br>la respuesta es:".$response;
            if($response == "OK"){
                //echo "</br>respuesta OK";
                return true;
            }else{
                //echo "</br>respuesta KO";
                $session->set('s2slicensecheck', 0);
                return false;
            }
        }else{
            echo '<div class="alert alert-error">Error validating: curl must be supported by your server</div>';
            return false;
        }
    }

}
