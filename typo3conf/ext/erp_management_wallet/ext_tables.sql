#
# Table structure for table 'tx_erpmanagementwallet_domain_model_record'
#
CREATE TABLE tx_erpmanagementwallet_domain_model_record (

	success_time int(11) DEFAULT '0' NOT NULL,
	amount double(11,2) DEFAULT '0.00' NOT NULL,
	serial_number varchar(255) DEFAULT '' NOT NULL,
	order_number varchar(255) DEFAULT '' NOT NULL,
	payment int(11) DEFAULT '0' NOT NULL,
	status int(11) DEFAULT '0' NOT NULL,
	billtype int(11) DEFAULT '0' NOT NULL,
	remark text,
	country int(11) unsigned DEFAULT '0',
	erpuser int(11) unsigned DEFAULT '0',

);

#
# Table structure for table 'tx_erpmanagementwallet_domain_model_log'
#
CREATE TABLE tx_erpmanagementwallet_domain_model_log (

	wallet int(11) unsigned DEFAULT '0' NOT NULL,

	balance double(11,2) DEFAULT '0.00' NOT NULL,
	chmoney double(11,2) DEFAULT '0.00' NOT NULL,
	remark text,

);

#
# Table structure for table 'tx_erpmanagementwallet_domain_model_wallet'
#
CREATE TABLE tx_erpmanagementwallet_domain_model_wallet (

	wallet_number varchar(255) DEFAULT '' NOT NULL,
	balance double(11,2) DEFAULT '0.00' NOT NULL,
	password varchar(255) DEFAULT '' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	alipay varchar(255) DEFAULT '' NOT NULL,
	wxpay varchar(255) DEFAULT '' NOT NULL,
	log int(11) unsigned DEFAULT '0' NOT NULL,
	record int(11) unsigned DEFAULT '0' NOT NULL,
	erpuser int(11) unsigned DEFAULT '0',

);

#
# Table structure for table 'tx_erpmanagementwallet_domain_model_log'
#
CREATE TABLE tx_erpmanagementwallet_domain_model_log (

	wallet int(11) unsigned DEFAULT '0' NOT NULL,

);
