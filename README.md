# Api Football
Plugin Api Football for [magixcms 3](https://www.magix-cms.com)

![52586411_2216172558700610_5569833449105129472_n](https://user-images.githubusercontent.com/356674/66895434-17fc1a80-eff3-11e9-9270-ed6585b52ad2.png)

### version 

[![release](https://img.shields.io/github/release/magix-cms/apifootball.svg)](https://github.com/magix-cms/apifootball/releases/latest)

Authors
-------

* Gerits Aurelien (aurelien[at]magix-cms[point]com)

## Description
Connexion à l'API football pour vous permettre de développer vos propres outils

## Installation
 * Décompresser l'archive dans le dossier "plugins" de magix cms
 * Connectez-vous dans l'administration de votre site internet
 * Cliquer sur l'onglet plugins du menu déroulant pour sélectionner apifootball.
 * Une fois dans le plugin, laisser faire l'auto installation
 * Il ne reste que la configuration du plugin pour correspondre avec vos données.

Requirements
   ------------
   * CURL (http://php.net/manual/en/book.curl.php)
   
### Exemple d'utilisation dans vos plugins

```php
$apifootball = new plugins_apifootball_public();
$dataApiFoot = $apifootball->setItemData();
$newData = array();
$newData['url'] = $dataApiFoot['url_apifb'] . 'leagueTable/1/';
$newData['rapidApiKey'] = $dataApiFoot['key_apifb'];
$newData['debug'] = false;
$newData['method'] = 'json';
$setApi = $apifootball->getApiRequest($newData);
$parseJson = json_decode($setApi, true);
````
Ressources
 -----
  * https://www.api-football.com/
  * https://www.magix-cms.com
