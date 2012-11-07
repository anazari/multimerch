<?php
class ModelMultisellerSettings extends Model {
	public function createTable() {
		$sql = "
			CREATE TABLE `" . DB_PREFIX . "ms_product` (
             `product_id` int(11) NOT NULL,
             `seller_id` int(11) DEFAULT NULL,
             `number_sold` int(11) NOT NULL DEFAULT '0',
			 `product_status` TINYINT NOT NULL,
			 `product_approved` TINYINT NOT NULL,
        	PRIMARY KEY (`product_id`)) default CHARSET=utf8";
        
        $this->db->query($sql);
        
		$sql = "
			CREATE TABLE `" . DB_PREFIX . "ms_seller` (
             `seller_id` int(11) NOT NULL AUTO_INCREMENT,
             `nickname` VARCHAR(32) NOT NULL DEFAULT '',
             `company` VARCHAR(32) NOT NULL DEFAULT '',
             `website` VARCHAR(2083) NOT NULL DEFAULT '',
             `description` TEXT NOT NULL DEFAULT '',
			 `country_id` INT(11) NOT NULL DEFAULT '0',
			 `avatar` VARCHAR(255) DEFAULT NULL,
			 `paypal` VARCHAR(255) DEFAULT NULL,
			 `date_created` DATETIME NOT NULL,
			 `seller_status` TINYINT NOT NULL,
			 `seller_approved` TINYINT NOT NULL,
			 `commission` DECIMAL(4,2) NOT NULL DEFAULT '0',
			 `commission_flat` decimal(15,4) NOT NULL DEFAULT '0.0000',
			 `product_validation` tinyint(4) NOT NULL DEFAULT '1',
			 `seller_group` int(11) NOT NULL DEFAULT '1',
        	PRIMARY KEY (`seller_id`)) default CHARSET=utf8";
        
        $this->db->query($sql);
        
		$createTable = "
			CREATE TABLE " . DB_PREFIX . "ms_comments (
             `id` int(11) NOT NULL AUTO_INCREMENT,
             `id_product` int(11) NOT NULL,
             `id_customer` int(10) UNSIGNED DEFAULT NULL,
             `name` varchar(32) NOT NULL DEFAULT '',
             `email` varchar(128) NOT NULL DEFAULT '',
             `comment` text NOT NULL,
             `create_time` int(11) NOT NULL DEFAULT '0',
             `display` tinyint(1) NOT NULL DEFAULT '0',
        	PRIMARY KEY (`id`)) default CHARSET=utf8";
        
        $this->db->query($createTable);        
	
		$createTable = "
			CREATE TABLE " . DB_PREFIX . "ms_product_attribute (
			 `product_id` int(11) NOT NULL,
			 `option_id` int(11) NOT NULL,
			 `option_value_id` int(11) NOT NULL,
        	PRIMARY KEY (`product_id`,`option_id`,`option_value_id`)) default CHARSET=utf8";
        
        $this->db->query($createTable);
        
		$sql = "
			CREATE TABLE `" . DB_PREFIX . "ms_balance` (
             `balance_id` int(11) NOT NULL AUTO_INCREMENT,
             `seller_id` int(11) NOT NULL,
             `order_id` int(11) DEFAULT NULL,
             `product_id` int(11) DEFAULT NULL,
             `withdrawal_id` int(11) DEFAULT NULL,
             `balance_type` int(11) DEFAULT NULL,
             `amount` DECIMAL(15,4) NOT NULL,
             `balance` DECIMAL(15,4) NOT NULL,
             `description` TEXT NOT NULL DEFAULT '',
			 `date_created` DATETIME NOT NULL,
			 `date_modified` DATETIME DEFAULT NULL,
        	PRIMARY KEY (`balance_id`)) default CHARSET=utf8";
        
        $this->db->query($sql);
	
		$sql = "
			CREATE TABLE `" . DB_PREFIX . "ms_order_product_data` (
             `order_product_data_id` int(11) NOT NULL AUTO_INCREMENT,
             `order_id` int(11) NOT NULL,
             `product_id` int(11) NOT NULL,
             `seller_id` int(11) DEFAULT NULL,
             `store_commission_flat` DECIMAL(15,4) NOT NULL,
             `store_commission_pct` DECIMAL(15,4) NOT NULL,
             `seller_net_amt` DECIMAL(15,4) NOT NULL,
        	PRIMARY KEY (`order_product_data_id`)) default CHARSET=utf8";
        
        $this->db->query($sql);
        
		$sql = "
			CREATE TABLE `" . DB_PREFIX . "ms_withdrawal` (
             `withdrawal_id` int(11) NOT NULL AUTO_INCREMENT,
             `seller_id` int(11) NOT NULL,
             `amount` DECIMAL(15,4) NOT NULL,
             `withdrawal_method_id` int(11) DEFAULT NULL,
             `withdrawal_method_data` TEXT NOT NULL DEFAULT '',
			 `withdrawal_status` TINYINT NOT NULL,
             `currency_id` int(11) NOT NULL,
             `currency_code` VARCHAR(3) NOT NULL,
             `currency_value` DECIMAL(15,8) NOT NULL,
			 `description` TEXT NOT NULL DEFAULT '',
             `processed_by` int(11) DEFAULT NULL,
			 `date_created` DATETIME NOT NULL,
			 `date_processed` DATETIME DEFAULT NULL,
        	PRIMARY KEY (`withdrawal_id`)) default CHARSET=utf8";
        	
        $this->db->query($sql);
/*
		$sql = "
			CREATE TABLE `" . DB_PREFIX . "ms_request_seller` (
             `request_seller_id` int(11) NOT NULL AUTO_INCREMENT,
			 `request_id` int(11) NOT NULL,
             `seller_id` int(11) NOT NULL,
			 `request_type` TINYINT NOT NULL,
        	PRIMARY KEY (`request_seller_id`)) default CHARSET=utf8";
        
        $this->db->query($sql);

		$sql = "
			CREATE TABLE `" . DB_PREFIX . "ms_request_product` (
             `request_product_id` int(11) NOT NULL AUTO_INCREMENT,
			 `request_id` int(11) NOT NULL,
             `product_id` int(11) NOT NULL,
			 `request_type` TINYINT NOT NULL,
        	PRIMARY KEY (`request_product_id`)) default CHARSET=utf8";
        
        $this->db->query($sql);

		$sql = "
			CREATE TABLE `" . DB_PREFIX . "ms_request` (
             `request_id` int(11) NOT NULL AUTO_INCREMENT,
			 `request_status` TINYINT NOT NULL,
			 `resolution_type` TINYINT DEFAULT NULL,
             `processed_by` int(11) DEFAULT NULL,
			 `date_created` DATETIME NOT NULL,
			 `date_processed` DATETIME DEFAULT NULL,
             `message_created` TEXT NOT NULL DEFAULT '',
             `message_processed` TEXT NOT NULL DEFAULT '',
        	PRIMARY KEY (`request_id`)) default CHARSET=utf8";
        
		// ms_seller_group - table with seller groups
        $this->db->query($sql);
*/
		$sql = "
			CREATE TABLE `" . DB_PREFIX . "ms_seller_group` (
             `seller_group_id` int(11) NOT NULL AUTO_INCREMENT,
        	PRIMARY KEY (`seller_group_id`)) default CHARSET=utf8";
        
		// ms_seller_group_description - table with seller group information
        $this->db->query($sql);
		
		$sql = "
			CREATE TABLE `" . DB_PREFIX . "ms_seller_group_description` (
             `seller_group_description_id` int(11) NOT NULL AUTO_INCREMENT,
			 `seller_group_id` int(11) NOT NULL,
			 `name` VARCHAR(32) NOT NULL DEFAULT '',
             `description` TEXT NOT NULL DEFAULT '',
			 `language_id` int(11) DEFAULT NULL,
        	PRIMARY KEY (`seller_group_description_id`)) default CHARSET=utf8";
        
        $this->db->query($sql);
		
		// Create default seller group
		$this->db->query("INSERT INTO " . DB_PREFIX . "ms_seller_group () VALUES()");
        $seller_group_id = $this->db->getLastId();
		$this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();
		foreach ($languages as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "ms_seller_group_description SET seller_group_id = '" . (int)$seller_group_id . "', language_id = '" . (int)$language_id . "', name = 'Default', description = 'Default seller group'");
		}

	}
	
	
	//todo drop dbses
	public function dropTable() {
		$sql = "DROP TABLE IF EXISTS
				`" . DB_PREFIX . "ms_product`,
				`" . DB_PREFIX . "ms_seller`,
				`" . DB_PREFIX . "ms_order_product_data`,
				`" . DB_PREFIX . "ms_withdrawal`,
				`" . DB_PREFIX . "ms_product_attribute`,
				`" . DB_PREFIX . "ms_comments`,
				`" . DB_PREFIX . "ms_balance`,
				`" . DB_PREFIX . "ms_seller_group`,
				`" . DB_PREFIX . "ms_seller_group_description`";
								
		$this->db->query($sql);
	}
}