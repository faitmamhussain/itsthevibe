<?php

function generateNextPagePreviewLink($postId, $previewLink, $previewPage = null)
{
	$queryArgs = [
		'preview_id'    => $postId,
		//'preview_nonce' => wp_create_nonce('post_preview_' . $postId),
		'preview' => 'true',
		'page' => $previewPage,
	];

	return set_url_scheme(add_query_arg($queryArgs, $previewLink));
}

$totalPages = $numpages;
$currentPage = $page;
$nextPage;
$buttonText;
$postNext = false;

echo "<!--debug 2-->";

if($totalPages <= 1 || $totalPages <= $currentPage){
	$nextPage = get_permalink(get_adjacent_post(false,'',true));
	$buttonText = 'Next Post';
	$postNext = true;
} else {
	$nextPage = get_permalink() . ($page + 1) . '/';
	$buttonText = 'Next Slide';
}

if( ! $postNext && is_preview())
{
	$nextPage = get_permalink();
	$previewPage = null;

	if (in_array( $post->post_status, array( 'draft', 'pending' ) ) )
		$previewPage = $page+1;

	$nextPage = generateNextPagePreviewLink($post->ID, $nextPage, $previewPage);

}
?>
<style>
	/* for fb share&next button */
	.fb-share-and-next{display:block; width:100%; clear:both;}
	.fb-share-wrap.bottom{display:table-cell; width:40%;}
	.fb-share-wrap.bottom .fb-share-container .fb-button .icon{border-radius:6px 0 0 6px;}
	.next-button{display:table-cell; width:30%; vertical-align:middle;}
	.next-button a {width:95%; height:54px; float:right; background-color:#098cf0; border-radius:6px; color:#fff !important; font:600 22px Arial,Helvetica,sans-serif;}
	.next-button a:hover{background-color:#249BF5; text-decoration:none;}
	.next-button a span{display:inline-block; vertical-align:middle; position:relative; left:25%; top:25%;}
	.next-button .next-arrow{margin-left:10px;}
	@media screen and (max-width: 768px) {
		.next-button a span{left:25%; top:25%;}
		.next-button .next-arrow{margin-left:2px;}
	}

	@media screen and (max-width: 600px) {
		.next-button a{font-size:18px !important; top:30% !important;}

	}

	@media screen and (max-width: 478px) {
		.next-button .next-arrow{margin:-5px 0 0 32px; width:30px;}
		.next-button a span{left:15%; top:15%;}
	}
</style>
<!-- START FB Share and Next Button -->
<div class="fb-share-and-next">
	<div class="fb-share-wrap bottom">
		<div class="fb-share-container below-post  button-facebook">
			<a href="#" class="fb-button button-facebook" data-domain="itsthevibe">
				<span class="icon"></span>
				<span class="text">
					<span class="no-hide">Share</span>
					<span class="hide-1" style="position:static; visibility:visible;">This Story</span>
					<span class="hide-2" style="position:static; visibility:visible;">On Facebook</span>
				</span>
			</a>
		</div>
		<script>
			show_button(".fb-share-container.below-post","api",0,0);
		</script>
	</div>
	<div class="next-button">
		<a href="<?php echo $nextPage; ?>">
			<span class="button-text"><?php echo $buttonText; ?></span>
			<span class="next-arrow">→</span>
		</a>
	</div>
</div>
<!-- END FB Share and Next Button -->