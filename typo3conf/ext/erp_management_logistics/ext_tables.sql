#
# Table structure for table 'tx_erpmanagementlogistics_domain_model_logistics'
#
CREATE TABLE tx_erpmanagementlogistics_domain_model_logistics (

	domestic_waybill varchar(255) DEFAULT '' NOT NULL,
	international_waybill varchar(255) DEFAULT '' NOT NULL,
	customer_order_number varchar(255) DEFAULT '' NOT NULL,
	shipping_method_code varchar(255) DEFAULT '' NOT NULL,
	tracking_number varchar(255) DEFAULT '' NOT NULL,
	transaction_number varchar(255) DEFAULT '' NOT NULL,
	tax_number varchar(255) DEFAULT '' NOT NULL,
	length int(11) DEFAULT '0' NOT NULL,
	width int(11) DEFAULT '0' NOT NULL,
	height int(11) DEFAULT '0' NOT NULL,
	package_count int(11) DEFAULT '0' NOT NULL,
	weight double(11,2) DEFAULT '0.00' NOT NULL,
	application_type int(11) DEFAULT '0' NOT NULL,
	return_option int(11) DEFAULT '0' NOT NULL,
	tariff_prepay int(11) DEFAULT '0' NOT NULL,
	insurance_option int(11) DEFAULT '0' NOT NULL,
	coverage double(11,2) DEFAULT '0.00' NOT NULL,
	sensitive_type_i_d int(11) DEFAULT '0' NOT NULL,
	source_code varchar(255) DEFAULT '' NOT NULL,
	erpuser int(11) unsigned DEFAULT '0',
	receiver int(11) unsigned DEFAULT '0',
	sender int(11) unsigned DEFAULT '0',
	parcels int(11) unsigned DEFAULT '0' NOT NULL,
	child_orders int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementlogistics_domain_model_receiver'
#
CREATE TABLE tx_erpmanagementlogistics_domain_model_receiver (

	country_code varchar(255) DEFAULT '' NOT NULL,
	first_name varchar(255) DEFAULT '' NOT NULL,
	last_name varchar(255) DEFAULT '' NOT NULL,
	company varchar(255) DEFAULT '' NOT NULL,
	street varchar(255) DEFAULT '' NOT NULL,
	street_address1 varchar(255) DEFAULT '' NOT NULL,
	street_address2 varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	state varchar(255) DEFAULT '' NOT NULL,
	zip varchar(255) DEFAULT '' NOT NULL,
	phone varchar(255) DEFAULT '' NOT NULL,
	house_number varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementlogistics_domain_model_sender'
#
CREATE TABLE tx_erpmanagementlogistics_domain_model_sender (

	country_code varchar(255) DEFAULT '' NOT NULL,
	first_name varchar(255) DEFAULT '' NOT NULL,
	last_name varchar(255) DEFAULT '' NOT NULL,
	company varchar(255) DEFAULT '' NOT NULL,
	street varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	state varchar(255) DEFAULT '' NOT NULL,
	zip varchar(255) DEFAULT '' NOT NULL,
	phone varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementlogistics_domain_model_parcels'
#
CREATE TABLE tx_erpmanagementlogistics_domain_model_parcels (

	logistics int(11) unsigned DEFAULT '0' NOT NULL,

	e_name varchar(255) DEFAULT '' NOT NULL,
	c_name varchar(255) DEFAULT '' NOT NULL,
	h_s_code varchar(255) DEFAULT '' NOT NULL,
	quantity int(11) DEFAULT '0' NOT NULL,
	unit_price double(11,2) DEFAULT '0.00' NOT NULL,
	unit_weight double(11,2) DEFAULT '0.00' NOT NULL,
	remark text,
	product_url varchar(255) DEFAULT '' NOT NULL,
	sku varchar(255) DEFAULT '' NOT NULL,
	invoice_remark varchar(255) DEFAULT '' NOT NULL,
	currency_code varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementlogistics_domain_model_childorders'
#
CREATE TABLE tx_erpmanagementlogistics_domain_model_childorders (

	logistics int(11) unsigned DEFAULT '0' NOT NULL,

	box_number varchar(255) DEFAULT '' NOT NULL,
	length int(11) DEFAULT '0' NOT NULL,
	width int(11) DEFAULT '0' NOT NULL,
	height int(11) DEFAULT '0' NOT NULL,
	box_weight double(11,2) DEFAULT '0.00' NOT NULL,
	child_details text,

);

#
# Table structure for table 'tx_erpmanagementlogistics_domain_model_parcels'
#
CREATE TABLE tx_erpmanagementlogistics_domain_model_parcels (

	logistics int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementlogistics_domain_model_childorders'
#
CREATE TABLE tx_erpmanagementlogistics_domain_model_childorders (

	logistics int(11) unsigned DEFAULT '0' NOT NULL,

);
