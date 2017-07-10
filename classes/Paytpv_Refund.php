<?php
/*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author     Jose Ramon Garcia <jrgarcia@paytpv.com>
*  @copyright  2015 PAYTPV ON LINE S.L.
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/

class Paytpv_Refund extends ObjectModel
{
	public $id;
	public $id_order;
	public $amount;
	public $date;
		

	public static function add_Refund($id_order,$amount,$type)
    {
        $sql = 'INSERT INTO '. _DB_PREFIX_ .'paytpv_refund (`id_order`,`amount`,`type`,`date`) VALUES('.pSQL($id_order).',"'.pSQL($amount).'","'.pSQL($type).'","'.pSQL(date('Y-m-d H:i:s')).'")';
		Db::getInstance()->Execute($sql);
    }


    public static function get_TotalRefund($id_order)
    {
        $sql = 'select sum(amount) as "total_amount" FROM '. _DB_PREFIX_ .'paytpv_refund where id_order = '. pSQL($id_order);
		$result = Db::getInstance()->getRow($sql);
		return $result["total_amount"]; 
    }

    public static function get_Refund($id_order)
    {
        $sql = 'select * FROM '. _DB_PREFIX_ .'paytpv_refund where id_order = '. pSQL($id_order);
		$refunds = Db::getInstance()->executeS($sql);
		return $refunds; 
    }

    	
}
