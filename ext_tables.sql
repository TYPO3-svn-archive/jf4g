
#
# Table structure for table 'pages'
#
CREATE TABLE pages (
	tx_jf4g_pin int(11) DEFAULT '0' NOT NULL,
	tx_jf4g_allowedpin text
	tx_jf4g_navigation text,
	tx_jf4g_mystory text,
	tx_jf4g_publish tinyint(3) DEFAULT '0' NOT NULL,
	tx_jf4g_newsid text,
	tx_jf4g_calendarpid text,
	tx_jf4g_address text,
	tx_jf4g_languages text,
	tx_jf4g_email tinytext
);
