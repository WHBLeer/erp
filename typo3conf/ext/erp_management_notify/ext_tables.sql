#
# Table structure for table 'tx_erpmanagementnotify_domain_model_message'
#
CREATE TABLE tx_erpmanagementnotify_domain_model_message (

	msg_type int(11) DEFAULT '0' NOT NULL,
	re_type int(11) DEFAULT '0' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,
	bodytext text,
	sendtime int(11) DEFAULT '0' NOT NULL,
	sender int(11) DEFAULT '0' NOT NULL,
	receiver varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementnotify_domain_model_receive'
#
CREATE TABLE tx_erpmanagementnotify_domain_model_receive (

	user int(11) DEFAULT '0' NOT NULL,
	gettime int(11) DEFAULT '0' NOT NULL,
	readtime int(11) DEFAULT '0' NOT NULL,
	status int(11) DEFAULT '0' NOT NULL,
	message int(11) unsigned DEFAULT '0',

);
