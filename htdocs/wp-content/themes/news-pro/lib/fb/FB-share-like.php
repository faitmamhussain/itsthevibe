<style>
/* for fb share/like button */
.fb-like-and-share {
	margin-bottom: 20px;
}

.fb-like-and-share * {
	box-sizing: border-box;
	-moz-box-sizing: border-box;
}

.fb-share-wrap {
	width: 100%;
}

.fb-share-wrap .fb-share-container {
	display: table;
	height: 54px;
	width: 100%;
	margin: 10px auto;
}

.fb-share-wrap .fb-share-container .fb-button {
	background-color: #3c56a2;
	display: table-row;
	overflow-y: hidden;
	margin: 10px;
	position: relative;
	margin-bottom: 10px;
	text-decoration: none;
}

.fb-share-wrap .fb-share-container .fb-button:hover {
	background-color: #2c4692;
}

.fb-share-wrap .fb-share-container .fb-button .text {
	text-align: center;
	font-size: 22px;
	display: table-cell;
	width: 100%;
	border-radius: 6px;
	vertical-align: middle;
	color: #fff;
	padding: 0 10px;
	font-weight: 700;
}

.fb-share-wrap .fb-share-container .fb-button .text .hide-1, .fb-share-wrap .fb-share-container .fb-button .text .hide-2 {
	visibility: hidden;
	position: absolute;
}

.facebook-icon {
	font-size: 40px !important;
	display: inline-block;
	margin: 6px 20px;
	vertical-align: middle;
}

@media screen and (max-width: 768px) {
	.fb-share-wrap .fb-share-container .fb-button .text .hide-1 {
		display: none !important;
		visibility: hidden !important;
		position: absolute !important;
	}
}

@media screen and (max-width: 600px) {
	.fb-share-wrap .fb-share-container .fb-button .text {
		font-size: 18px !important;
	}
}
</style>

<!-- START FB Like and Share -->
<div class="fb-like-and-share">
	<div class="fb-share-wrap">
		<div class="fb-share-container in-post  button-facebook">
			<a href="#"
			   class="fb-button fb-share-button"
			   data-href="<?php echo (!empty($shareURL)) ? $shareURL : get_permalink();?>"
			   data-layout="link"
			   data-domain="itsthevibe"<?php echo (!empty($shareURL)) ? ' data-share-url="'.$shareURL.'"' : '';?>>
				<span class="text">
					<i class="fa fa-facebook-square facebook-icon"></i>
					<span class="no-hide">Share</span>
					<span class="hide-1" style="position:static; visibility:visible;">this</span>
					<span class="hide-2" style="position:static; visibility:visible;">on Facebook</span>
				</span>
			</a>
		</div>
		<script>
			recalc_button(".fb-share-container.in-post");
		</script>
	</div>
</div>
<!-- END FB Like and Share -->