<?php
header("Content-type: text/css; charset: UTF-8");
if(isset($_GET['font_familly']))
{
  $font_familly = $_GET['font_familly'];
}
else {
  $font_familly = 'Open Sans';
}
?>



h1,
h2,
h3,
h4,
h5,
h6 {
  font-family: <?php echo $font_familly?>;
}

@media screen and (max-width: 375px) {
	.change-language {
		font-size: 12px;
		font-family: <?php echo $font_familly?>, sans-serif;
	}
}

.nav-menu li a:not([class*="btn"]),
.breadcrumb li,
.clients-item .clients-content blockquote,
.form-label,
.pricing-checkbox,
.cmn--btn,
.nav--tabs li a {
	font-family: <?php echo $font_familly?>, sans-serif;
}