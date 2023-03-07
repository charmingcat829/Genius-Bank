<?php
header("Content-type: text/css; charset: UTF-8");
if(isset($_GET['color']))
{
  $color = '#'.$_GET['color'];
}
else {
  $color = '#FF9900';
}
?>

h1 a:hover,
h2 a:hover,
h3 a:hover,
h4 a:hover,
h5 a:hover,
h6 a:hover {
	color: <?php echo $color?>;
}

.pagination li a:hover {
	border-color: <?php echo $color?>;
}
.service-item__icon {
  border-color: <?php echo $color.'4d' ?>
}
.pagination li a.active {
	background: <?php echo $color?>;
	border-color: <?php echo $color?>;
}

.owl-dots .owl-dot.active {
	border: 1px solid <?php echo $color?>;
	border-color: <?php echo $color?>;
}
.owl-trigger > div.active {
	background: <?php echo $color.'cc' ?>;

}
.owl-dots .owl-dot span {
	background: <?php echo $color?>;
}

.toTopBtn {
	border: 1px solid <?php echo $color?>;
	background: <?php echo $color?>;
}

.footer-wrapper .footer-links ul li a:hover {
	color: <?php echo $color?>;
}

.footer-input-group .form-control:focus {
	border-color: <?php echo $color?>;
}

.social-icons li a i {
	background: <?php echo $color?>;
}

.nav-menu li .sub-nav {
	border-bottom: 3px solid <?php echo $color?>;
}

.nav-menu li .sub-nav li a:hover {
	background: <?php echo $color?>;
}
.blog__item-content .meta-post i,
.feature-item__icon {
	color: <?php echo $color?>;
}

.feature-item__cont-title {
	color: <?php echo $color?>;
}

.feature-item:hover .feature-item__icon {
	background: <?php echo $color?> !important;
}

.breadcrumb li {
	color: <?php echo $color?>;
}

.about__item ul li::before {
	background: <?php echo $color?>;
}

.widget-header {
	background: <?php echo $color?>;
}

.widget-body .archive-links li a::before {
	color: <?php echo $color?>;
}

.widget-body .latest-posts li a .cont .date {
	color: <?php echo $color?>;
}

.widget-body .widget-tags li a:hover,
.widget-body .widget-tags li a.active {
	background: <?php echo $color?>;
	border-color: <?php echo $color?>;
}

.about-list li > span::before {
	color: <?php echo $color?>;
}

.about-thumb .thumb::before {
	background: <?php echo $color?>;
}

.service-item__icon {
	color: <?php echo $color?>;
}

.service-item:hover .service-item__icon {
	background: <?php echo $color?>;
	border-color: <?php echo $color?>;
}

.service-item:hover .service-item__cont-title a,
.service-item:hover .service-item__cont-title {
	color: <?php echo $color?>;
}

.counter-item .counter-content .counter-title {
	color: <?php echo $color?>;
}

.clients-item .clients-content blockquote::before {
	color: <?php echo $color?>;
}

.clients-item .clients-content .name::after {
	background: <?php echo $color?>;
}

.clients-item .clients-thumb::before {
	background: <?php echo $color?>;
}

.owl-trigger > div {
	color: <?php echo $color?>;
}

.form--control:focus {
	border-color: <?php echo $color?>;
}

.contact__item-icon {
	color: <?php echo $color?>;
}

.form-check-input:checked {
	background: <?php echo $color?>;
	border-color: <?php echo $color?>;
}

.plan__item-body ul li::before {
	color: <?php echo $color?>;
}

.plan__item:hover .plan__item-header .right .title {
	color: <?php echo $color?>;
}

.pricing--wrapper
	div[class*="col"]:nth-child(2)
	.plan__item-header
	.right
	.title {
	color: <?php echo $color?>;
}

.blog__item-content .read-more {
	color: <?php echo $color?>;
}

.social-icons-dark li a i {
	background: <?php echo $color?>;
}

.cmn--btn {
	background: <?php echo $color?>;
}

.footer-bottom p a {
	color: <?php echo $color?>;
}

.cmn--btn:hover,
.cmn--btn.btn-outline {
	color: <?php echo $color?>;
	border-color: <?php echo $color?>;
}

.cmn--btn.btn-outline:hover {
	background: <?php echo $color?>;
}

button.cmn--btn:hover {
	background: <?php echo $color?>;
}

.video--btn {
	background: <?php echo $color?>;
}

.video--btn::after,
.video--btn::before {
	background: <?php echo $color?>;
}

.btn--base,
.badge--base,
.bg--base {
	background-color: <?php echo $color?> !important;
}

.btn--warning,
.badge--warning,
.bg--warning {
	background-color: <?php echo $color?> !important;
}

.text--base {
	color: <?php echo $color?> !important;
}

.nav--tabs li a.active {
	background: <?php echo $color?>;
}

.contact__item-icon {
    color: <?php echo $color?>;
    border: 2px solid <?php echo $color?>;
}

.cmn--btn {
	font-family: <?php echo $color?>, sans-serif;
}