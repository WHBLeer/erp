#
# Table structure for table 'tx_erpmanagementlogistics_domain_model_logistics'
#
CREATE TABLE tx_erpmanagementlogistics_domain_model_logistics (

	domestic_waybill varchar(255) DEFAULT '' NOT NULL,
	international_waybill varchar(255) DEFAULT '' NOT NULL,
	estimate_freight double(11,2) DEFAULT '0.00' NOT NULL,
	actual_freight double(11,2) DEFAULT '0.00' NOT NULL,
	aging int(11) DEFAULT '0' NOT NULL,
	weight double(11,2) DEFAULT '0.00' NOT NULL,
	length int(11) DEFAULT '0' NOT NULL,
	width int(11) DEFAULT '0' NOT NULL,
	height int(11) DEFAULT '0' NOT NULL,
	quantity int(11) DEFAULT '0' NOT NULL,
	goodstype int(11) DEFAULT '0' NOT NULL,
	country int(11) unsigned DEFAULT '0',
	erpuser int(11) unsigned DEFAULT '0',

);
