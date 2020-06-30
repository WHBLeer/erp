#
# Table structure for table 'tx_erpmanagementorder_domain_model_order'
#
CREATE TABLE tx_erpmanagementorder_domain_model_order (

	amazon_order_id varchar(255) DEFAULT '' NOT NULL,
	goods_title varchar(255) DEFAULT '' NOT NULL,
	goods_image varchar(255) DEFAULT '' NOT NULL,
	asin_num varchar(255) DEFAULT '' NOT NULL,
	seller_sku varchar(255) DEFAULT '' NOT NULL,
	sales_link varchar(255) DEFAULT '' NOT NULL,
	purchase_date int(11) DEFAULT '0' NOT NULL,
	last_update_date int(11) DEFAULT '0' NOT NULL,
	earliest_ship_date int(11) DEFAULT '0' NOT NULL,
	latest_ship_date int(11) DEFAULT '0' NOT NULL,
	earliest_delivery_date int(11) DEFAULT '0' NOT NULL,
	latest_delivery_date int(11) DEFAULT '0' NOT NULL,
	order_status int(11) DEFAULT '0' NOT NULL,
	fulfillment_channel int(11) DEFAULT '0' NOT NULL,
	ship_service_level int(11) DEFAULT '0' NOT NULL,
	sales_channel varchar(255) DEFAULT '' NOT NULL,
	currency_code varchar(255) DEFAULT '' NOT NULL,
	amount varchar(255) DEFAULT '' NOT NULL,
	number_of_items_shipped int(11) DEFAULT '0' NOT NULL,
	number_of_items_unshipped int(11) DEFAULT '0' NOT NULL,
	payment_method varchar(255) DEFAULT '' NOT NULL,
	payment_method_details text,
	marketplace_id varchar(255) DEFAULT '' NOT NULL,
	shipment_service_level_category varchar(255) DEFAULT '' NOT NULL,
	shipped_by_amazon_t_f_m int(11) DEFAULT '0' NOT NULL,
	order_type varchar(255) DEFAULT '' NOT NULL,
	business_order int(11) DEFAULT '0' NOT NULL,
	prime int(11) DEFAULT '0' NOT NULL,
	global_express_enabled int(11) DEFAULT '0' NOT NULL,
	premium_order int(11) DEFAULT '0' NOT NULL,
	replacement_order int(11) DEFAULT '0' NOT NULL,
	sold_by_a_b int(11) DEFAULT '0' NOT NULL,
	goods int(11) unsigned DEFAULT '0',
	erpuser int(11) unsigned DEFAULT '0',
	address int(11) unsigned DEFAULT '0',
	shipper int(11) unsigned DEFAULT '0',
	revenue int(11) unsigned DEFAULT '0',

);

#
# Table structure for table 'tx_erpmanagementorder_domain_model_address'
#
CREATE TABLE tx_erpmanagementorder_domain_model_address (

	name varchar(255) DEFAULT '' NOT NULL,
	telephone varchar(255) DEFAULT '' NOT NULL,
	postcode varchar(255) DEFAULT '' NOT NULL,
	state varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	street_number varchar(255) DEFAULT '' NOT NULL,
	address varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementorder_domain_model_revenue'
#
CREATE TABLE tx_erpmanagementorder_domain_model_revenue (

	order_amount double(11,2) DEFAULT '0.00' NOT NULL,
	commission double(11,2) DEFAULT '0.00' NOT NULL,
	arrive double(11,2) DEFAULT '0.00' NOT NULL,
	cost_amount double(11,2) DEFAULT '0.00' NOT NULL,
	actual_amount double(11,2) DEFAULT '0.00' NOT NULL,
	freight double(11,2) DEFAULT '0.00' NOT NULL,
	service_fee double(11,2) DEFAULT '0.00' NOT NULL,
	profit double(11,2) DEFAULT '0.00' NOT NULL,
	profit_margin double(11,2) DEFAULT '0.00' NOT NULL,
	currency_code double(11,2) DEFAULT '0.00' NOT NULL,

);

#
# Table structure for table 'tx_erpmanagementorder_domain_model_shipper'
#
CREATE TABLE tx_erpmanagementorder_domain_model_shipper (

	name_zh varchar(255) DEFAULT '' NOT NULL,
	name_en varchar(255) DEFAULT '' NOT NULL,
	sku varchar(255) DEFAULT '' NOT NULL,
	number int(11) DEFAULT '0' NOT NULL,
	weight double(11,2) DEFAULT '0.00' NOT NULL,
	length double(11,2) DEFAULT '0.00' NOT NULL,
	width double(11,2) DEFAULT '0.00' NOT NULL,
	height double(11,2) DEFAULT '0.00' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	route int(11) DEFAULT '0' NOT NULL,
	providers int(11) DEFAULT '0' NOT NULL,
	gn_waybill varchar(255) DEFAULT '' NOT NULL,
	gn_tracking varchar(255) DEFAULT '' NOT NULL,
	gn_status int(11) DEFAULT '0' NOT NULL,
	gj_waybill varchar(255) DEFAULT '' NOT NULL,
	gj_tracking varchar(255) DEFAULT '' NOT NULL,
	gj_status int(11) DEFAULT '0' NOT NULL,
	shipper_address_line1 text,
	shipper_address_line2 text,
	shipper_address_line3 text,
	shipper_city varchar(255) DEFAULT '' NOT NULL,
	shipper_state_or_region varchar(255) DEFAULT '' NOT NULL,
	shipper_country_code varchar(255) DEFAULT '' NOT NULL,
	shipper_phone varchar(255) DEFAULT '' NOT NULL,
	shipper_address_type varchar(255) DEFAULT '' NOT NULL,
	shipper_is_address_sharing_confidential int(11) DEFAULT '0' NOT NULL,
	delivery_type int(11) DEFAULT '0' NOT NULL,
	remark text,
	customermail text,
	logs text,
	reissue int(11) unsigned DEFAULT '0',

);
