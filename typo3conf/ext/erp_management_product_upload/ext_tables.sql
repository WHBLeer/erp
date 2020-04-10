#
# Table structure for table 'tx_erpmanagementproductupload_domain_model_upload'
#
CREATE TABLE tx_erpmanagementproductupload_domain_model_upload (

	subdate int(11) DEFAULT '0' NOT NULL,
	lang varchar(255) DEFAULT '' NOT NULL,
	timing int(11) DEFAULT '0' NOT NULL,
	st1 int(11) DEFAULT '0' NOT NULL,
	st2 int(11) DEFAULT '0' NOT NULL,
	st3 int(11) DEFAULT '0' NOT NULL,
	st4 int(11) DEFAULT '0' NOT NULL,
	st5 int(11) DEFAULT '0' NOT NULL,
	user int(11) unsigned DEFAULT '0',
	category int(11) unsigned DEFAULT '0',
	template int(11) unsigned DEFAULT '0',
	shop int(11) unsigned DEFAULT '0',

);
