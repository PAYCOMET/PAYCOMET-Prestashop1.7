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

class Paytpv_Order_Info extends ObjectModel
{
	public $id_customer;
	public $id_cart;
	public $paytpv_iduser;
	public $paytpvagree;
	public $suscription;
	public $periodicity;
	public $cycles;
	public $date;


	public static function save_Order_Info($id_customer,$id_cart,$paytpvagree,$suscription,$peridicity,$cycles,$paytpv_iduser=0){
		// Eliminamos la orden si existe.
		$sql = 'DELETE FROM '. _DB_PREFIX_ .'paytpv_order_info where id_customer = '.pSQL($id_customer) .' and id_cart= "'. pSQL($id_cart) .'"';
		Db::getInstance()->Execute($sql);

		// Insertamos los datos de la orden
		$sql = 'INSERT INTO '. _DB_PREFIX_ .'paytpv_order_info (`id_customer`,`id_cart`,`paytpvagree`,`suscription`,`periodicity`,`cycles`,`date`,`paytpv_iduser`) VALUES('.pSQL($id_customer).',"'.pSQL($id_cart).'",'.pSQL($paytpvagree).','.pSQL($suscription).','.pSQL($peridicity).','.pSQL($cycles).',"'.pSQL(date('Y-m-d H:i:s')).'",'.pSQL($paytpv_iduser).')';
		Db::getInstance()->Execute($sql);
		
		return true;

	}


	public static function get_Order_Info($id_customer,$id_cart){
		$sql = 'select * from ' . _DB_PREFIX_ .'paytpv_order_info where id_customer = '.pSQL($id_customer) . ' and id_cart="'.pSQL($id_cart).'"';
		$result = Db::getInstance()->getRow($sql);

		// Si no hay datos los almacenamos. Por defecto se guarda la tarjeta.
		if (empty($result) === true){
			self::save_Order_info($id_customer,$id_cart,1,0,0,0,0,0);
			$result = self::get_Order_Info($id_customer,$id_cart);
		}

		return $result;


	}


    
	
}
