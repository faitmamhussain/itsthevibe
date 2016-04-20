<style type="text/css">
	.post-share-buttons{
		margin: 20px;
	}
	.post-share-buttons a{
		display: inline-block;
	    vertical-align: top;
		font-family: 'Raleway', sans-serif;
	    font-size: 22px;
	    height: 54px;
	    padding-right: 15px;
	    border-radius: 6px;
	    font-weight: 900;
	    color: #ffffff;
	}
	.post-share-buttons .fb-share-button{
		background-color: #3c56a2;
	}
	.post-share-buttons .fb-share-button:hover{
		background-color: #2c4692;
	}
	.post-share-buttons .twitter-share-button{
		background-color: #56a3d9; 
	}
	.post-share-buttons .twitter-share-button:hover{
		background-color: #94c5e7; 
	}
	.post-share-buttons .pinterest-share-button{
		background-color: #cb211d;
	}
	.post-share-buttons .pinterest-share-button:hover{
		background-color: #e6524f;
	}
	.post-share-buttons .whatsapp-share-button{
		background-color: #81f54a;
	}
	.post-share-buttons .whatsapp-share-button:hover{
		background-color: #A2F978;
	}
	.post-share-buttons .twitter-share-button,
	.post-share-buttons .pinterest-share-button,
	.post-share-buttons .whatsapp-share-button{
		font-size: 34px;
	    padding: 10px;
	    display: none;
	}
	.post-share-buttons .share-button-toggle-icon{
		background-color: #ccc;
		width: 58px;
	}
	.post-share-buttons .share-button-toggle-icon:after{
		content: " ";
	    width: 25px;
	    height: 6px;
	    background-color: #fff;
	    display: block;
	    position: relative;
	    /* position: absolute; */
	    top: 18px;
	    left: 16px;
	    transition: all .15s cubic-bezier(.42,0,.58,1);
	    opacity: 1;
	    border-radius: 2px;
	    -webkit-transition: all .15s cubic-bezier(.42,0,.58,1);
	}
	.post-share-buttons .share-button-toggle-icon:before{
		content: " ";
	    width: 25px;
	    height: 6px;
	    background-color: #fff;
	    display: block;
	    position: relative;
	    /* position: absolute; */
	    top: 27px;
	    left: 28px;
	    transition: translate(-50%,-50%) rotate(90deg);
	    opacity: 1;
	    border-radius: 2px;
	    -webkit-transform: translate(-50%,-50%) rotate(90deg);
	}
	.post-share-buttons .share-button-toggle-icon.open:before{
		transition: translate(-50%,-50%) rotate(0deg);
	    opacity: 1;
	    border-radius: 2px;
	    -webkit-transform: translate(-50%,-50%) rotate(0deg);
	}
	/*.post-share-buttons .share-button-toggle-icon.open:after{
		top: 24px;
	}*/
</style>
<!-- START social share buttons-->
<div class="post-share-buttons">
	<span class="fb-share-container in-post  button-facebook">
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
	</span>
	<a href="" class="share-button-toggle-icon" ></a>
	<a href="http://twitter.com/share?text=<?php echo urlencode($post_title_full); ?>&url=<?php echo urlencode($shareURL); ?>" class="twitter-share-button" target="_blank">
		<i class="fa fa-fw fa-twitter"></i>
	</a>
	<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode($shareURL); ?>&description=<?php echo urlencode($post_title_full); ?>" class="pinterest-share-button" target="_blank">
		<i class="fa fa-fw fa-pinterest"></i>
	</a>
	<a href="whatsapp://send?text=<?php echo urlencode($post_title_full.' | '.$shareURL); ?>" class="whatsapp-share-button" >
		<i class="fa fa-fw fa-whatsapp"></i>
	</a>
</div>

<!-- END social share buttons -->