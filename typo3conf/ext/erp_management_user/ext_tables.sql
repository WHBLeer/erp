#
# Table structure for table 'fe_users'
#
CREATE TABLE fe_users (

	authcode varchar(255) DEFAULT '' NOT NULL,
	wxopenid varchar(255) DEFAULT '' NOT NULL,
	bindip text,
	nickname varchar(255) DEFAULT '' NOT NULL,
	city int(11) unsigned DEFAULT '0',
	province int(11) unsigned DEFAULT '0',

	tx_extbase_type varchar(255) DEFAULT '' NOT NULL,

);
