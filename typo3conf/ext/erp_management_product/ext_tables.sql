#
# Table structure for table 'tx_erpmanagementproduct_domain_model_product'
#
CREATE TABLE tx_erpmanagementproduct_domain_model_product (

	numbering varchar(255) DEFAULT '' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	business text,
	original text,
	imageuids varchar(255) DEFAULT '' NOT NULL,
	category int(11) unsigned DEFAULT '0',
	approval int(11) unsigned DEFAULT '0',
	shelves int(11) unsigned DEFAULT '0',
	gtypes int(11) unsigned DEFAULT '0',
	info int(11) unsigned DEFAULT '0',
	cost int(11) unsigned DEFAULT '0',
	descr int(11) unsigned DEFAULT '0' NOT NULL,
	variants int(11) unsigned DEFAULT '0' NOT NULL,
	images int(11) unsigned DEFAULT '0' NOT NULL,
	adduser int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementproduct_domain_model_info'
#
CREATE TABLE tx_erpmanagementproduct_domain_model_info (

	trade_name varchar(255) DEFAULT '' NOT NULL,
	brand_name varchar(255) DEFAULT '' NOT NULL,
	trade_num varchar(255) DEFAULT '' NOT NULL,
	sku varchar(255) DEFAULT '' NOT NULL,
	source varchar(255) DEFAULT '' NOT NULL,
	link varchar(255) DEFAULT '' NOT NULL,
	code varchar(255) DEFAULT '' NOT NULL,
	remark varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementproduct_domain_model_cost'
#
CREATE TABLE tx_erpmanagementproduct_domain_model_cost (

	cg double(11,2) DEFAULT '0.00' NOT NULL,
	zl double(11,2) DEFAULT '0.00' NOT NULL,
	cc varchar(255) DEFAULT '' NOT NULL,
	kd int(11) DEFAULT '0' NOT NULL,
	gd int(11) DEFAULT '0' NOT NULL,
	yf double(11,2) DEFAULT '0.00' NOT NULL,
	zk double(11,2) DEFAULT '0.00' NOT NULL,
	calculation text,
	sy int(11) DEFAULT '0' NOT NULL,
	sj int(11) DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementproduct_domain_model_desc'
#
CREATE TABLE tx_erpmanagementproduct_domain_model_desc (

	product int(11) unsigned DEFAULT '0' NOT NULL,

	title text,
	keyword text,
	key_points text,
	description text,
	lang varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementproduct_domain_model_variants'
#
CREATE TABLE tx_erpmanagementproduct_domain_model_variants (

	product int(11) unsigned DEFAULT '0' NOT NULL,

	combination varchar(255) DEFAULT '' NOT NULL,
	sku_new varchar(255) DEFAULT '' NOT NULL,
	markup double(11,2) DEFAULT '0.00' NOT NULL,
	kucun int(11) DEFAULT '0' NOT NULL,
	upc_ean varchar(255) DEFAULT '' NOT NULL,
	images text,

);

#
# Table structure for table 'tx_erpmanagementproduct_domain_model_desc'
#
CREATE TABLE tx_erpmanagementproduct_domain_model_desc (

	product int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementproduct_domain_model_variants'
#
CREATE TABLE tx_erpmanagementproduct_domain_model_variants (

	product int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementimages_domain_model_images'
#
CREATE TABLE tx_erpmanagementimages_domain_model_images (

	product int(11) unsigned DEFAULT '0' NOT NULL,

);
