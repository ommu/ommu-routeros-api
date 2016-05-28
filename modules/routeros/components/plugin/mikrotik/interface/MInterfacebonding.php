<?php
/**
 * Description of Mapi_interface_Bonding
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com> <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 26 May 2016, 15:15 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 */
 
class MInterfacebonding {
	/**
	 * @access private
	 * @var type array
	 */
	private $talker;
	private $_conn;
	
	function __construct($talker, $conn) {
		$this->talker = $talker;
		$this->_conn = $conn;
	}
	
	/**
	 * This method is used to add interface bonding
	 * 
	 * Example in Mikrotik RouterOs :
	 * 
	 * [admin@Router1] interface bonding> add slaves=ether1,ether2
	 * 
	 * Exmple : 
	 * 
	 * $param = array(
	 *						  'name'	=> 'bonding1',
	 *						  'slaves'  => 'ether1,ether2');
	 * 
	 * $this->mikrotik_api->interfaces()->bonding()->add_bonding($param);
	 * 
	 * The $param that you can send to Mikrotik RouterOs are :
	 * 
	 * 1. arp -- Address Resolution Protocol
	 * 
	 * 2. arp-interval -- Time in milliseconds for monitoring ARP requests
	 * 
	 * 3. arp-ip-targets -- IP addresses for monitoring
	 * 
	 * 4. comment -- Set comment for items
	 * 
	 * 5. copy-from -- Item number
	 * 
	 * 6. disabled -- Defines whether MAC Telnet Server is disabled or not
	 * 
	 * 7. down-delay -- Time period the interface is disabled  if a link failure has been detected
	 * 
	 * 8. lacp-rate -- Link Aggregation Control Protocol rate specifies how often to exchange with LACPDUs between bonding peer
	 * 
	 * 9. link-monitoring -- Method for monitoring the link
	 * 
	 * 10. mii-interval -- Time in milliseconds for monitoring mii-type link
	 * 
	 * 11. mode -- Interface bonding mode
	 * 
	 * 12. mtu -- Maximum Transmit Unit
	 * 
	 * 13. name -- Interface name
	 * 
	 * 14. primary -- Slave that will be used in active-backup mode as active link
	 * 
	 * 16. slaves -- Interfaces that are used in bonding
	 * 
	 * 17. up-delay -- Time period the interface is disabled if a link has been brought up
	 * 
	 * 18. up-delay -- Time period the interface is disabled if a link has been brought up
	 *  
	 * @param type $param array
	 * @return type array
	 */
	 public function add_bonding($param) {
		 $sentence = new SentenceUtil();
	   $sentence->addCommand("/interface/bonding/add");
	   foreach ($param as $name => $value){
			   $sentence->setAttribute($name, $value);
	   }	   
	   $this->talker->send($sentence);
	   return "Sucsess";
	}
	
	/**
	 * This method is used to display all interface bonding
	 * 
	 * Example :
	 * 
	 * print_r($this->mikrotik_api->interfaces()->bonding()->get_all_bonding());
	 * @return type array
	 */
	 public function get_all_bonding() {
		 $sentence = new SentenceUtil();
		$sentence->fromCommand("/interface/bonding/getall");
		$this->talker->send($sentence);
		$rs = $this->talker->getResult();
		$i = 0 ;
		if ($i < $rs->size()){
			return $rs->getResultArray();
		}  else {
			return "No Interface Bonding To Set, Please Your Add Interface Bonding";
		}
	}
	
	/**
	 * This method is used to enable interface bonding by id
	 * 
	 * Example :
	 * 
	 * $this->mikrotik_api->interfaces()->bonding()->enable_bonding('*1');
	 * @param type $id string
	 * @return type array
	 */
	 public function enable_bonding($id) {
		$sentence = new SentenceUtil();
		$sentence->addCommand("/interface/bonding/enable");
		$sentence->where(".id", "=", $id);
		$this->talker->send($sentence);
		return "Sucsess";
	}
	
	/**
	 * This method is used to disable interface bonding by id
	 * 
	 * Example :
	 * 
	 * $this->mikrotik_api->interfaces()->bonding()->disable_bonding('*1');
	 * @param type $id string
	 * @return type array
	 */
	 public function disable_bonding($id) {
		 $sentence = new SentenceUtil();
		$sentence->addCommand("/interface/bonding/disable");
		$sentence->where(".id", "=", $id);
		$this->talker->send($sentence);
		return "Sucsess";
	}
	  
	/**
	 * This method is used to set or edit interface bonding by id
	 * 
	 * Example :
	 * 
	 * $param = array(
	 *						  'name'	=> 'bonding1',
	 *						  'slaves'  => 'ether1,ether2');
	 * 
	 * $this->mikrotik_api->interfaces()->bonding()->set_bonding($param, '*1');
	 * 
	 * 
	 * The $param that you can send to Mikrotik RouterOs are :
	 * 
	 * 1. arp -- Address Resolution Protocol
	 * 
	 * 2. arp-interval -- Time in milliseconds for monitoring ARP requests
	 * 
	 * 3. arp-ip-targets -- IP addresses for monitoring
	 * 
	 * 4. comment -- Set comment for items
	 * 
	 * 5. copy-from -- Item number
	 * 
	 * 6. disabled -- Defines whether MAC Telnet Server is disabled or not
	 * 
	 * 7. down-delay -- Time period the interface is disabled  if a link failure has been detected
	 * 
	 * 8. lacp-rate -- Link Aggregation Control Protocol rate specifies how often to exchange with LACPDUs between bonding peer
	 * 
	 * 9. link-monitoring -- Method for monitoring the link
	 * 
	 * 10. mii-interval -- Time in milliseconds for monitoring mii-type link
	 * 
	 * 11. mode -- Interface bonding mode
	 * 
	 * 12. mtu -- Maximum Transmit Unit
	 * 
	 * 13. name -- Interface name
	 * 
	 * 14. primary -- Slave that will be used in active-backup mode as active link
	 * 
	 * 16. slaves -- Interfaces that are used in bonding
	 * 
	 * 17. up-delay -- Time period the interface is disabled if a link has been brought up
	 * 
	 * 18. up-delay -- Time period the interface is disabled if a link has been brought up
	 *  
	 * @param type $param array
	 * @param type $id string
	 * @return type array
	 */
	  public function set_bonding($param, $id) {
		  $sentence = new SentenceUtil();
		$sentence->addCommand("/interface/bonding/set");
		foreach ($param as $name => $value){
				$sentence->setAttribute($name, $value);
		 }
		$sentence->where(".id", "=", $id);
		$this->talker->send($sentence);
		return "Sucsess";
	}	 
	
	/**
	 * This method is used to display one interface bonding
	 * in detail based on the id
	 * 
	 * Example :
	 * 
	 * $this->mikrotik_api->interfaces()->bonding()->detail_bonding('*1');
	 * @param type $id string
	 * @return type array
	 */
	 public function detail_bonding($id) {
		$sentence = new SentenceUtil();
		$sentence->fromCommand("/interface/bonding/print");
		$sentence->where(".id", "=", $id);
		$this->talker->send($sentence);
		$rs = $this->talker->getResult();
		$i = 0;
		if($i < $rs->size()){
			return $rs->getResultArray();
		}  else {
			return "No Interface Bonding With This id = ".$id;
		}
	}
	/**
	 * This method is used to delete interface bonding by id
	 * 
	 * $this->mikrotik_api->interfaces()->bonding()->delete_bonding('*1');
	 * @param type $id string
	 * @return type array
	 */
	 public function delete_bonding($id) {
		 $sentence = new SentenceUtil();
		$sentence->addCommand("/interface/bonding/remove");
		$sentence->where(".id", "=", $id);
		$this->talker->send($sentence);
		return "Sucsess";
	}
}