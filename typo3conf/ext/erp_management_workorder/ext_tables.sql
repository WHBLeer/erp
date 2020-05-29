#
# Table structure for table 'tx_erpmanagementworkorder_domain_model_workorder'
#
CREATE TABLE tx_erpmanagementworkorder_domain_model_workorder (

	title varchar(255) DEFAULT '' NOT NULL,
	worktype int(11) DEFAULT '0' NOT NULL,
	closetime int(11) DEFAULT '0' NOT NULL,
	contact varchar(255) DEFAULT '' NOT NULL,
	telephone varchar(255) DEFAULT '' NOT NULL,
	dialogue int(11) unsigned DEFAULT '0' NOT NULL,
	erpuser int(11) unsigned DEFAULT '0',

);

#
# Table structure for table 'tx_erpmanagementworkorder_domain_model_dialogue'
#
CREATE TABLE tx_erpmanagementworkorder_domain_model_dialogue (

	workorder int(11) unsigned DEFAULT '0' NOT NULL,

	bodytext text,
	type varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementworkorder_domain_model_dialogue'
#
CREATE TABLE tx_erpmanagementworkorder_domain_model_dialogue (

	workorder int(11) unsigned DEFAULT '0' NOT NULL,

);
