HOWTO INSTALL

Note: Before any update it's recommended to perform a backup !

If you have a previous version of adsmanager < 2.5 RC2
******************************************************************

Please first upgrade (uninstall/reinstall) the adsmanager component to 2.5 RC2 (stable)
then follow the normal procedure

If it's the first install or if you have a version >= 2.6 
*********************************************************
1- Install adsmanager component (adsmanager.zip), mod_ads.zip, mod_menu.zip and mod_search.zip
plg_social.zip plg_captcha.zip plg_jcomments.zip
using the Joomla Extensions Installation Page

2- If you are using community builder, you have to install communitybuilder_adsmanager_plugin.zip
using the Community Builder Installation Page
          -----------------
          
Basic Error and FAQ:
********************

1) If you get the following error:
Warning: require_once(....../communitybuilder_adsmanager_plugin/plug.php) [function.require-once]
You have install the communitybuilder plugin via the adsmanager page instead of communitybuilder page.
You should delete manually the directory .../images/com_adsmanager/plugins/communitybuilder_adsmanager_plugin

2) You want to change the DEVICE $ € £ etc..
Edit your language file /languages/.../...com_adsmanager.ini
ADSMANAGER_DEVICE="%s €"

3) You want to change the format of date
Edit your language file /languages/.../...com_adsmanager.ini
ADSMANAGER_DATE_FORMAT_LC="%d-%m-%Y"

4) If you are using JoomFISH, you will notice an issue "no translate of subcategory in some case"
for that, there is a bug in joomfish

In joomfish.class.php , line 98

Replace :

foreach ($tableArray["fieldTablePairs"] as $key=>$value){
                $reftable = $tableArray["fieldTablePairs"][$key];
                $alias = $tableArray["tableAliases"][$reftable];

by :

foreach ($tableArray["reverseTableAliases"] as $alias=>$reftable){
    //$reftable = $tableArray["fieldTablePairs"][$key];
    //$alias = $tableArray["tableAliases"][$reftable];



