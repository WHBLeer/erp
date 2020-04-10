#
# Table structure for table 'tx_erpmanageproducttemplate_domain_model_template'
#
CREATE TABLE tx_erpmanageproducttemplate_domain_model_template (

	name varchar(255) DEFAULT '' NOT NULL,
	name_en varchar(255) DEFAULT '' NOT NULL,
	code varchar(255) DEFAULT '' NOT NULL,
	close int(11) DEFAULT '0' NOT NULL,
	parent_id int(11) DEFAULT '0' NOT NULL,
	bodytext text,
	parent int(11) unsigned DEFAULT '0',

);
