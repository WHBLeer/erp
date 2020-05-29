#
# Table structure for table 'cache_treelist'
#
CREATE TABLE cache_treelist (
	md5hash char(32) DEFAULT '' NOT NULL,
	pid int(11) DEFAULT '0' NOT NULL,
	treelist mediumtext,
	tstamp int(11) DEFAULT '0' NOT NULL,
	expires int(11) unsigned  DEFAULT '0' NOT NULL,

	PRIMARY KEY (md5hash)
) ENGINE=InnoDB;

#
# Table structure for table 'fe_groups'
#
CREATE TABLE fe_groups (
	title varchar(50) DEFAULT '' NOT NULL,
	lockToDomain varchar(50) DEFAULT '' NOT NULL,
	subgroup tinytext,
	TSconfig text
);


#
# Table structure for table 'fe_sessions'
#
CREATE TABLE fe_sessions (
	ses_id varchar(32) DEFAULT '' NOT NULL,
	ses_iplock varchar(39) DEFAULT '' NOT NULL,
	ses_userid int(11) unsigned DEFAULT '0' NOT NULL,
	ses_tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	ses_data mediumblob,
	ses_permanent tinyint(1) unsigned DEFAULT '0' NOT NULL,
	ses_anonymous tinyint(1) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (ses_id),
	KEY ses_tstamp (ses_tstamp)
) ENGINE=InnoDB;

#
# Table structure for table 'fe_users'
#
CREATE TABLE fe_users (
	username varchar(255) DEFAULT '' NOT NULL,
	password varchar(100) DEFAULT '' NOT NULL,
	usergroup tinytext,
	name varchar(160) DEFAULT '' NOT NULL,
	first_name varchar(50) DEFAULT '' NOT NULL,
	middle_name varchar(50) DEFAULT '' NOT NULL,
	last_name varchar(50) DEFAULT '' NOT NULL,
	address varchar(255) DEFAULT '' NOT NULL,
	telephone varchar(30) DEFAULT '' NOT NULL,
	fax varchar(30) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	lockToDomain varchar(50) DEFAULT '' NOT NULL,
	uc blob,
	title varchar(40) DEFAULT '' NOT NULL,
	zip varchar(10) DEFAULT '' NOT NULL,
	city varchar(50) DEFAULT '' NOT NULL,
	country varchar(40) DEFAULT '' NOT NULL,
	www varchar(80) DEFAULT '' NOT NULL,
	company varchar(80) DEFAULT '' NOT NULL,
	image tinytext,
	TSconfig text,
	lastlogin int(10) unsigned DEFAULT '0' NOT NULL,
	is_online int(10) unsigned DEFAULT '0' NOT NULL,

	KEY parent (pid,username(100)),
	KEY username (username(100)),
	KEY is_online (is_online)
);

#
# Table structure for table 'pages_language_overlay'
# Kept with all management fields like uid and pid for b/w compat reasons.
# Table will be removed in v10 with removal of unifiedPageTranslationHandling feature toggle
#
CREATE TABLE pages_language_overlay (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	doktype int(11) unsigned DEFAULT '0' NOT NULL,
	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	sys_language_uid int(11) unsigned DEFAULT '0' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(3) unsigned DEFAULT '0' NOT NULL,
	subtitle varchar(255) DEFAULT '' NOT NULL,
	nav_title varchar(255) DEFAULT '' NOT NULL,
	media int(11) unsigned DEFAULT '0' NOT NULL,
	keywords text,
	description text,
	abstract text,
	author varchar(255) DEFAULT '' NOT NULL,
	author_email varchar(255) DEFAULT '' NOT NULL,
	l18n_diffsource mediumblob,
	url varchar(255) DEFAULT '' NOT NULL,
	shortcut int(10) unsigned DEFAULT '0' NOT NULL,
	shortcut_mode int(10) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY parent (pid,sys_language_uid)
);

#
# Table structure for table 'sys_domain'
#
CREATE TABLE sys_domain (
	domainName varchar(255) DEFAULT '' NOT NULL,

	KEY getSysDomain (hidden),
	KEY getDomainStartPage (pid,hidden,domainName(100))
);

#
# Table structure for table 'sys_template'
#
CREATE TABLE sys_template (
	title varchar(255) DEFAULT '' NOT NULL,
	sitetitle varchar(255) DEFAULT '' NOT NULL,
	root tinyint(4) unsigned DEFAULT '0' NOT NULL,
	clear tinyint(4) unsigned DEFAULT '0' NOT NULL,
	include_static_file text,
	constants text,
	config text,
	nextLevel varchar(5) DEFAULT '' NOT NULL,
	basedOn tinytext,
	includeStaticAfterBasedOn tinyint(4) unsigned DEFAULT '0' NOT NULL,
	static_file_mode tinyint(4) unsigned DEFAULT '0' NOT NULL,

	KEY roottemplate (deleted,hidden,root)
);

#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	CType varchar(255) DEFAULT '' NOT NULL,
	header varchar(255) DEFAULT '' NOT NULL,
	header_position varchar(255) DEFAULT '' NOT NULL,
	rowDescription text,
	bodytext mediumtext,
	bullets_type tinyint(3) unsigned DEFAULT '0' NOT NULL,
	uploads_description tinyint(1) unsigned DEFAULT '0' NOT NULL,
	uploads_type tinyint(3) unsigned DEFAULT '0' NOT NULL,
	assets int(11) unsigned DEFAULT '0' NOT NULL,
	image int(11) unsigned DEFAULT '0' NOT NULL,
	imagewidth mediumint(11) unsigned DEFAULT '0' NOT NULL,
	imageorient tinyint(4) unsigned DEFAULT '0' NOT NULL,
	imagecols tinyint(4) unsigned DEFAULT '0' NOT NULL,
	imageborder tinyint(4) unsigned DEFAULT '0' NOT NULL,
	media int(11) unsigned DEFAULT '0' NOT NULL,
	layout int(11) unsigned DEFAULT '0' NOT NULL,
	frame_class varchar(60) DEFAULT 'default' NOT NULL,
	cols int(11) unsigned DEFAULT '0' NOT NULL,
	spaceBefore smallint(5) unsigned DEFAULT '0' NOT NULL,
	spaceAfter smallint(5) unsigned DEFAULT '0' NOT NULL,
	space_before_class varchar(60) DEFAULT '' NOT NULL,
	space_after_class varchar(60) DEFAULT '' NOT NULL,
	records text,
	pages text,
	colPos int(11) unsigned DEFAULT '0' NOT NULL,
	subheader varchar(255) DEFAULT '' NOT NULL,
	header_link varchar(1024) DEFAULT '' NOT NULL,
	image_zoom tinyint(3) unsigned DEFAULT '0' NOT NULL,
	header_layout varchar(30) DEFAULT '0' NOT NULL,
	list_type varchar(255) DEFAULT '' NOT NULL,
	sectionIndex tinyint(3) unsigned DEFAULT '0' NOT NULL,
	linkToTop tinyint(3) unsigned DEFAULT '0' NOT NULL,
	file_collections text,
	filelink_size tinyint(3) unsigned DEFAULT '0' NOT NULL,
	filelink_sorting varchar(17) DEFAULT '' NOT NULL,
	filelink_sorting_direction varchar(4) DEFAULT '' NOT NULL,
	target varchar(30) DEFAULT '' NOT NULL,
	date int(10) unsigned DEFAULT '0' NOT NULL,
	recursive tinyint(3) unsigned DEFAULT '0' NOT NULL,
	imageheight mediumint(8) unsigned DEFAULT '0' NOT NULL,
	pi_flexform mediumtext,
	accessibility_title varchar(30) DEFAULT '' NOT NULL,
	accessibility_bypass tinyint(3) unsigned DEFAULT '0' NOT NULL,
	accessibility_bypass_text varchar(30) DEFAULT '' NOT NULL,
	selected_categories text,
	category_field varchar(64) DEFAULT '' NOT NULL,
	table_class varchar(60) DEFAULT '' NOT NULL,
	table_caption varchar(255) DEFAULT NULL,
	table_delimiter smallint(6) unsigned DEFAULT '0' NOT NULL,
	table_enclosure smallint(6) unsigned DEFAULT '0' NOT NULL,
	table_header_position tinyint(3) unsigned DEFAULT '0' NOT NULL,
	table_tfoot tinyint(1) unsigned DEFAULT '0' NOT NULL,

	KEY parent (pid,sorting),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l18n_parent,sys_language_uid)
);

#
# Table structure for table 'backend_layout'
#
CREATE TABLE backend_layout (
	title varchar(255) DEFAULT '' NOT NULL,
	config text NOT NULL,
	icon text
);
