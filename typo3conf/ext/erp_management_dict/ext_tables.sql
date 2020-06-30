#
# Table structure for table 'tx_erpmanagementdict_domain_model_dicttype'
#
CREATE TABLE tx_erpmanagementdict_domain_model_dicttype (

	name varchar(255) DEFAULT '' NOT NULL,
	code varchar(255) DEFAULT '' NOT NULL,
	devid varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementdict_domain_model_dictitem'
#
CREATE TABLE tx_erpmanagementdict_domain_model_dictitem (

	name varchar(255) DEFAULT '' NOT NULL,
	code varchar(255) DEFAULT '' NOT NULL,
	dicttype int(11) unsigned DEFAULT '0',

);

#
# Table structure for table 'tx_erpmanagementdict_domain_model_region'
#
CREATE TABLE tx_erpmanagementdict_domain_model_region (

	name varchar(255) DEFAULT '' NOT NULL,
	short varchar(255) DEFAULT '' NOT NULL,
	code varchar(255) DEFAULT '' NOT NULL,
	level int(11) DEFAULT '0' NOT NULL,
	parent int(11) DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementdict_domain_model_category'
#
CREATE TABLE tx_erpmanagementdict_domain_model_category (

	ctype int(11) DEFAULT '0' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	name_en varchar(255) DEFAULT '' NOT NULL,
	code varchar(255) DEFAULT '' NOT NULL,
	close int(11) DEFAULT '0' NOT NULL,
	parent_id varchar(255) DEFAULT '' NOT NULL,
	parent int(11) unsigned DEFAULT '0',

);
