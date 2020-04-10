#
# Table structure for table 'tx_erpmanagementproduct_domain_model_product'
#
CREATE TABLE tx_erpmanagementproduct_domain_model_product (

	numbering varchar(255) DEFAULT '' NOT NULL COMMENT '编号',
	name varchar(255) DEFAULT '' NOT NULL COMMENT '名称',
	business text COMMENT '商品主页',
	original text COMMENT '原始规格',
	category int(11) unsigned DEFAULT '0' COMMENT '产品分类',
	approval int(11) unsigned DEFAULT '0' COMMENT '审核状态',
	shelves int(11) unsigned DEFAULT '0' COMMENT '上架状态',
	gettype int(11) unsigned DEFAULT '0' COMMENT '商品获取类型',
	info int(11) unsigned DEFAULT '0' COMMENT '产品信息',
	cost int(11) unsigned DEFAULT '0' COMMENT '成本运费',
	descr int(11) unsigned DEFAULT '0' NOT NULL COMMENT '产品介绍',
	variants int(11) unsigned DEFAULT '0' NOT NULL COMMENT '规格变体',

);

#
# Table structure for table 'tx_erpmanagementproduct_domain_model_info'
#
CREATE TABLE tx_erpmanagementproduct_domain_model_info (

	trade_name varchar(255) DEFAULT '' NOT NULL COMMENT '厂家名称',
	brand_name varchar(255) DEFAULT '' NOT NULL COMMENT '品牌名称',
	trade_num varchar(255) DEFAULT '' NOT NULL COMMENT '厂家编号',
	sku varchar(255) DEFAULT '' NOT NULL COMMENT '内部sku',
	source varchar(255) DEFAULT '' NOT NULL COMMENT '产品来源',
	link varchar(255) DEFAULT '' NOT NULL COMMENT '产品地址',
	code varchar(255) DEFAULT '' NOT NULL COMMENT '产品码',
	remark varchar(255) DEFAULT '' NOT NULL COMMENT '备注',

);

#
# Table structure for table 'tx_erpmanagementproduct_domain_model_cost'
#
CREATE TABLE tx_erpmanagementproduct_domain_model_cost (

	cg double(11,2) DEFAULT '0.00' NOT NULL COMMENT '采购价',
	zl double(11,2) DEFAULT '0.00' NOT NULL COMMENT '重量',
	cc varchar(255) DEFAULT '' NOT NULL COMMENT '尺寸',
	kd int(11) DEFAULT '0' NOT NULL COMMENT '宽度',
	gd int(11) DEFAULT '0' NOT NULL COMMENT '高度',
	yf double(11,2) DEFAULT '0.00' NOT NULL COMMENT '国内运费',
	zk double(11,2) DEFAULT '0.00' NOT NULL COMMENT '折扣',
	calculation text COMMENT '计算结果',
	sy int(11) DEFAULT '0' NOT NULL COMMENT '库存',
	sj int(11) DEFAULT '0' NOT NULL COMMENT '预处理时间',

);

#
# Table structure for table 'tx_erpmanagementproduct_domain_model_desc'
#
CREATE TABLE tx_erpmanagementproduct_domain_model_desc (

	product int(11) unsigned DEFAULT '0' NOT NULL COMMENT '产品id',

	title text COMMENT '标题',
	keyword text COMMENT '关键字',
	key_points text COMMENT '要点说明',
	description text COMMENT '产品介绍',
	lang int(11) unsigned DEFAULT '0' COMMENT '翻译语言',

);

#
# Table structure for table 'tx_erpmanagementproduct_domain_model_variants'
#
CREATE TABLE tx_erpmanagementproduct_domain_model_variants (

	product int(11) unsigned DEFAULT '0' NOT NULL COMMENT '产品id',

	combination varchar(255) DEFAULT '' NOT NULL COMMENT '组合',
	sku_new varchar(255) DEFAULT '' NOT NULL COMMENT 'sku修正',
	markup double(11,2) DEFAULT '0.00' NOT NULL COMMENT '加价',
	kucun int(11) DEFAULT '0' NOT NULL COMMENT '库存',
	upc_ean varchar(255) DEFAULT '' NOT NULL COMMENT 'UPC/EAN',
	images text COMMENT '已选图片',

);

#
# Table structure for table 'tx_erpmanagementproduct_domain_model_desc'
#
CREATE TABLE tx_erpmanagementproduct_domain_model_desc (

	product int(11) unsigned DEFAULT '0' NOT NULL COMMENT '产品id',

);

#
# Table structure for table 'tx_erpmanagementproduct_domain_model_variants'
#
CREATE TABLE tx_erpmanagementproduct_domain_model_variants (

	product int(11) unsigned DEFAULT '0' NOT NULL COMMENT '产品id',

);
