<?php
require_once ('db.php');
/*
 # -- BEGIN LICENSE BLOCK ----------------------------------
 #
 # This file is part of MAGIX CMS.
 # MAGIX CMS, The content management system optimized for users
 # Copyright (C) 2008 - 2013 magix-cms.com <support@magix-cms.com>
 #
 # OFFICIAL TEAM :
 #
 #   * Gerits Aurelien (Author - Developer) <aurelien@magix-cms.com> <contact@aurelien-gerits.be>
 #
 # Redistributions of files must retain the above copyright notice.
 # This program is free software: you can redistribute it and/or modify
 # it under the terms of the GNU General Public License as published by
 # the Free Software Foundation, either version 3 of the License, or
 # (at your option) any later version.
 #
 # This program is distributed in the hope that it will be useful,
 # but WITHOUT ANY WARRANTY; without even the implied warranty of
 # MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 # GNU General Public License for more details.
 #
 # You should have received a copy of the GNU General Public License
 # along with this program.  If not, see <http://www.gnu.org/licenses/>.
 #
 # -- END LICENSE BLOCK -----------------------------------
 #
 # DISCLAIMER
 #
 # Do not edit or add to this file if you wish to upgrade MAGIX CMS to newer
 # versions in the future. If you wish to customize MAGIX CMS for your
 # needs please refer to http://www.magix-cms.com for more information.
 */
class plugins_apifootball_public extends plugins_apifootball_db
{
    protected $template, $data;

    /**
     * frontend_controller_home constructor.
     */
    public function __construct()
    {
        $this->template = new frontend_model_template();
        $this->data = new frontend_model_data($this, $this->template);
    }

    /**
     * Assign data to the defined variable or return the data
     * @param string $type
     * @param string|int|null $id
     * @param string $context
     * @param boolean $assign
     * @return mixed
     */
    private function getItems($type, $id = null, $context = null, $assign = true)
    {
        return $this->data->getItems($type, $id, $context, $assign);
    }
    /**
     * @return mixed
     */
    public function setItemData(){
        $setData = $this->getItems('root',NULL,'one',false);
        return $setData;
    }
    /**
     * @param $data
     * @return bool|string|void
     */
    public function getApiRequest($data){
        try {

            $curl_params = array();
            $encodedAuth = $data['rapidApiKey'];
            switch($data['method']){
                default:
                case 'json';
                    $headers = array("X-RapidAPI-Key: " . $encodedAuth,'Accept: application/json');
                    break;
                case 'xml';
                    $headers = array("X-RapidAPI-Key: " . $encodedAuth,'Content-type: text/xml','Accept: text/xml');
                    break;
            }
            $options = array(
                CURLOPT_RETURNTRANSFER  => true,
                CURLINFO_HEADER_OUT     => true,
                CURLOPT_URL             => $data['url'],
                CURLOPT_HTTPHEADER      => $headers,
                CURLOPT_TIMEOUT         => 300,
                CURLOPT_CONNECTTIMEOUT  => 300,
                CURLOPT_CUSTOMREQUEST   => "GET",
                CURLOPT_SSL_VERIFYPEER  => false
            );

            $ch = curl_init();
            curl_setopt_array($ch, $options);

            $response = curl_exec($ch);
            $curlInfo = curl_getinfo($ch);
            curl_close($ch);
            if (array_key_exists('debug', $data) && $data['debug']) {
                var_dump($curlInfo);
                var_dump($response);
            }
            if ($curlInfo['http_code'] == '200') {
                if ($response) {
                    return $response;
                }
            }elseif($curlInfo['http_code'] == '0'){
                print 'Error HTTP: code 0';
                return;
            }


        }catch (Exception $e){
            $logger = new debug_logger(MP_LOG_DIR);
            $logger->log('php', 'error', 'An error has occured : ' . $e->getMessage(), debug_logger::LOG_MONTH);
        }
    }
}
?>