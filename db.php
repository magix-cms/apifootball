<?php
class plugins_apifootball_db
{
    /**
     * @param $config
     * @param bool $params
     * @return mixed|null
     * @throws Exception
     */
    public function fetchData($config, $params = false)
    {
        if (!is_array($config)) return '$config must be an array';

        $sql = '';

        if($config['context'] === 'all') {
            switch ($config['type']) {
                /*case 'images':
                    $sql = 'SELECT img.name_img
							FROM mc_catalog_cat_club AS img
							WHERE img.id_product = :id';
                    break;*/
            }

            return $sql ? component_routing_db::layer()->fetchAll($sql,$params) : null;
        }
        elseif($config['context'] === 'one') {
            switch ($config['type']) {
                case 'root':
                    $sql = 'SELECT * FROM mc_apifootball ORDER BY id_apifb DESC LIMIT 0,1';
                    break;
                case 'page':
                    $sql = 'SELECT * FROM `mc_apifootball` WHERE `id_apifb` = :id_apifb';
                    break;
            }

            return $sql ? component_routing_db::layer()->fetch($sql,$params) : null;
        }
    }

    /**
     * @param $config
     * @param array $params
     * @return bool|string
     */
    public function insert($config,$params = array())
    {
        if (!is_array($config)) return '$config must be an array';

        $sql = '';

        switch ($config['type']) {
            case 'newConfig':
                $sql = 'INSERT INTO mc_apifootball (url_apifb,key_apifb) VALUE(:url_apifb,:key_apifb)';

                break;
        }

        if($sql === '') return 'Unknown request asked';

        try {
            component_routing_db::layer()->insert($sql,$params);
            return true;
        }
        catch (Exception $e) {
            return 'Exception reçue : '.$e->getMessage();
        }
    }

    /**
     * @param $config
     * @param array $params
     * @return bool|string
     */
    public function update($config,$params = array())
    {
        if (!is_array($config)) return '$config must be an array';

        $sql = '';

        switch ($config['type']) {
            case 'content':
            case 'config':
                $sql = 'UPDATE mc_apifootball
                    SET url_apifb=:url_apifb,
                        key_apifb=:key_apifb
                    WHERE id_apifb=:id';
                break;
        }

        if($sql === '') return 'Unknown request asked';

        try {
            component_routing_db::layer()->update($sql,$params);
            return true;
        }
        catch (Exception $e) {
            return 'Exception reçue : '.$e->getMessage();
        }
    }
}
?>