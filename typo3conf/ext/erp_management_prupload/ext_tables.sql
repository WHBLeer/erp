#
# Table structure for table 'tx_erpmanagementprupload_domain_model_upload'
#
CREATE TABLE tx_erpmanagementprupload_domain_model_upload (

	market varchar(255) DEFAULT '' NOT NULL,
	lang varchar(255) DEFAULT '' NOT NULL,
	category_text varchar(255) DEFAULT '' NOT NULL,
	category_node varchar(255) DEFAULT '' NOT NULL,
	template varchar(255) DEFAULT '' NOT NULL,
	uploadtime int(11) DEFAULT '0' NOT NULL,
	cp_status int(11) DEFAULT '0' NOT NULL,
	gx_status int(11) DEFAULT '0' NOT NULL,
	tp_status int(11) DEFAULT '0' NOT NULL,
	kc_status int(11) DEFAULT '0' NOT NULL,
	jg_status int(11) DEFAULT '0' NOT NULL,
	last_update_date int(11) DEFAULT '0' NOT NULL,
	products text,
	user int(11) unsigned DEFAULT '0',

);
