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
	var slots = {};
	googletag.cmd.push(function () {
		var mapping1 = googletag.sizeMapping().
			addSize([0, 0], [[320, 50], [320, 100]]).
			addSize([500, 200], [[336, 280], [300, 250]]).
			addSize([768, 200], [728, 90]).
			build();

		var mapping2 = googletag.sizeMapping().
			addSize([0, 0], [[320, 50], [320, 100]]).
			addSize([500, 200], [[336, 280], [300, 250]]).
			addSize([768, 200], [728, 90]).
			addSize([1002, 200], [[336, 280], [300, 250]]).
			addSize([1100, 200], [728, 90]).
			build();

		var mapping3 = googletag.sizeMapping().
			addSize([0, 0], []).
			addSize([1151, 200], [[300, 600], [160, 600], [300, 250]]).
			build();

		var mapping4 = googletag.sizeMapping().
			addSize([0, 0], []).
			addSize([1151, 200], [300, 250]).
			build();

		var mapping5 = googletag.sizeMapping().
			addSize([0, 0], []).
			addSize([1331, 200], [160, 600]).
			build();

		if (page_type != 'article') {
			<?php if(is_front_page()){ ?>
			slots['headerAd'] = googletag.defineSlot('/76778142/Itsthevibe_Header_Ad', [[320, 100], [320, 50]], 'div-gpt-ad-1460507361888-3').defineSizeMapping(mapping1).addService(googletag.pubads());
			slots['belowFeaturedAd'] = googletag.defineSlot('/76778142/Itsthevibe_BelowFeatured_Ad', [[320, 100], [320, 50]], 'div-gpt-ad-1460507361888-0').defineSizeMapping(mapping2).addService(googletag.pubads());
			<?php } ?>
			<?php if(is_page('end-slideshow') || in_category('slideshows')){ ?>
			slots['belowpostAd'] = googletag.defineSlot('/76778142/Itsthevibe_BelowPost_Ad', [[320, 100], [320, 50], [300, 250]], 'div-gpt-ad-1460507361888-1').defineSizeMapping(mapping2).addService(googletag.pubads());
			<?php } ?>
		}

		slots['footerAd'] = googletag.defineSlot('/76778142/Itsthevibe_Footer_Ad', [[320, 100], [320, 50], [728, 90], [300, 250]], 'div-gpt-ad-1460507361888-2').addService(googletag.pubads());
		slots['leftSidebarAd'] = googletag.defineSlot('/76778142/Itsthevibe_Left_Sidebar_Ad_2', [160, 600], 'div-gpt-ad-1460507361888-9').defineSizeMapping(mapping5).addService(googletag.pubads());
		slots['sidebarBottomAd'] = googletag.defineSlot('/76778142/Itsthevibe_Sidebar_Ad_Bottom', [300, 250], 'div-gpt-ad-1460507361888-10').defineSizeMapping(mapping4).addService(googletag.pubads());
		slots['sidebarMidAd'] = googletag.defineSlot('/76778142/Itsthevibe_Sidebar_Ad_Mid', [[300, 600], [160, 600], [300, 250]], 'div-gpt-ad-1461545772821-1').defineSizeMapping(mapping3).addService(googletag.pubads());
		slots['sidebarTopAd'] = googletag.defineSlot('/76778142/Itsthevibe_Sidebar_Ad_Top', [300, 250], 'div-gpt-ad-1461545772821-2').defineSizeMapping(mapping4).addService(googletag.pubads());

		slots['sidebarPostTopAd'] = googletag.defineSlot('/76778142/Itsthevibe_PostPage_Ad_Top', [300, 250], 'div-gpt-ad-1461545772821-22').defineSizeMapping(mapping4).addService(googletag.pubads());
		slots['sidebarPostMidAd'] = googletag.defineSlot('/76778142/Itsthevibe_PostPage_Ad_Mid', [[300, 600], [160, 600], [300, 250]], 'div-gpt-ad-1461545772821-23').defineSizeMapping(mapping3).addService(googletag.pubads());

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

	var refreshSidebarMidAd = function () {
		googletag.cmd.push(function () {
			googletag.pubads().refresh([slots['sidebarMidAd']]);
		});
	};
</script>
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
		'//cdn.taboola.com/libtrc/itsthevibe/loader.js');
</script>