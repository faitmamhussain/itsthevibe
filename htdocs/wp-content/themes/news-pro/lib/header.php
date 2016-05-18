<?php if($thisPageType == 'ITV_Article'):?>

<script type='text/javascript'>
	var googletag = googletag || {};
	googletag.cmd = googletag.cmd || [];
	(function () {
		var gads = document.createElement('script');
		//gads.async = true;
		gads.type = 'text/javascript';
		var useSSL = 'https:' == document.location.protocol;
		gads.src = (useSSL ? 'https:' : 'http:') +
		'//www.googletagservices.com/tag/js/gpt.js';
		var node = document.getElementsByTagName('script')[0];
		node.parentNode.insertBefore(gads, node);
	})();
</script>
<script type='text/javascript' async>
	googletag.cmd.push(function () {
		googletag.pubads().setTargeting('utm_source', utm_source_value);
		googletag.pubads().setTargeting('utm_camp', utm_campaign_value);
		googletag.pubads().setTargeting('utm_medium', utm_medium_value);
		googletag.pubads().setTargeting('utm_cont', utm_content_value);
		googletag.pubads().setTargeting('test', test_value);
		googletag.pubads().setTargeting('page_type', page_type);
		googletag.pubads().setTargeting('tag', post_tags);
		googletag.pubads().setTargeting('post_id', post_id);
		googletag.pubads().setTargeting('explicit', explicitCheck);
		googletag.pubads().setTargeting('post_slug', post_slug);

		googletag.pubads().enableAsyncRendering();
		googletag.pubads().enableSingleRequest();
		googletag.enableServices();
	});
</script>
<?php endif; ?>


<script type="text/javascript">
	window._taboola = window._taboola || [];
	<?php if(in_category('slideshows')): ?>
	_taboola.push({photo: 'auto'});
	<?php else: ?>
	_taboola.push({article: 'auto'});
	<?php endif ?>
	!function (e, f, u) {
		e.async = 1;
		e.src = u;
		f.parentNode.insertBefore(e, f);
	}(document.createElement('script'),
		document.getElementsByTagName('script')[0],
		'//cdn.taboola.com/libtrc/payee-standardnews/loader.js');
</script>
