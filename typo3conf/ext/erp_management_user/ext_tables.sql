#
# Table structure for table 'fe_users'
#
CREATE TABLE fe_users (

	account_id varchar(255) DEFAULT '' NOT NULL,
	order_lasttime int(11) DEFAULT '0' NOT NULL,
	wxopenid varchar(255) DEFAULT '' NOT NULL,
	bindip text,
	nickname varchar(255) DEFAULT '' NOT NULL,
	citys int(11) unsigned DEFAULT '0',
	province int(11) unsigned DEFAULT '0',
	auth int(11) unsigned DEFAULT '0' NOT NULL,
	position int(11) unsigned DEFAULT '0',

);

#
# Table structure for table 'tx_erpmanagementuser_domain_model_erpuserauth'
#
CREATE TABLE tx_erpmanagementuser_domain_model_erpuserauth (

	erpuser int(11) unsigned DEFAULT '0' NOT NULL,

	developer_id varchar(255) DEFAULT '' NOT NULL,
	shopalias varchar(255) DEFAULT '' NOT NULL,
	awsaccount varchar(255) DEFAULT '' NOT NULL,
	authcountry varchar(255) DEFAULT '' NOT NULL,
	authtime int(11) DEFAULT '0' NOT NULL,
	amazon_id varchar(255) DEFAULT '' NOT NULL,
	amazon_token varchar(255) DEFAULT '' NOT NULL,
	authtype int(11) DEFAULT '0' NOT NULL,
	market int(11) unsigned DEFAULT '0',

);

#
# Table structure for table 'tx_erpmanagementuser_domain_model_position'
#
CREATE TABLE tx_erpmanagementuser_domain_model_position (

	ip varchar(255) DEFAULT '' NOT NULL,
	locatlat varchar(255) DEFAULT '' NOT NULL,
	locat_lng varchar(255) DEFAULT '' NOT NULL,
	nation varchar(255) DEFAULT '' NOT NULL,
	province varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	district varchar(255) DEFAULT '' NOT NULL,
	adcode int(11) DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementuser_domain_model_erpuserauth'
#
CREATE TABLE tx_erpmanagementuser_domain_model_erpuserauth (

	erpuser int(11) unsigned DEFAULT '0' NOT NULL,

);
