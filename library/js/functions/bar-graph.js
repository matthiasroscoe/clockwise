/**
 * Slide up the bars on scroll
 */

function showBarGraphOnScroll() {
	if ($(".js-graph").length > 0) {
		const graphs = $(".js-graph");

		$(window).on("scroll resize load", function(e) {
			const windowBottom = $(window).scrollTop() + $(window).height();

			graphs.each(function(i, item) {
				const graphOffset = $(item).offset().top + 100;

				if (windowBottom > graphOffset) {
					$(item).addClass("show-bars");
				}
			});
		});
	}
}

/**
 * Mobile toggle graphs
 */

function mobileToggleGraphs() {
	if ($(".js-graph-tab").length) {
		$(".js-graph-tab").on("click", function(e) {
			let animating = false;

			if (!$(this).hasClass("is-active") && !animating) {
				animating = true;
				const year = $(this).data("year");

				// Update tabs
				$(".js-graph-tab").removeClass("is-active");
				$(this).addClass("is-active");

				// Slide down bars graph
				$(".js-graph").removeClass("show-bars");
				setTimeout(function() {
					// Update clockwise bar
					const height = $(`.js-cw-year-${year}`).data("height");
					$(".js-cw-year-1").css("height", height + "%");

					// Update Trad. model bar
					const capexHeight = $(`.js-capex.js-year-${year}`).data("height");
					$(".js-capex.js-year-1").css("height", capexHeight + "%");

					const servUtilHeight = $(`.js-serv-util.js-year-${year}`).data("height");
					$(".js-serv-util.js-year-1").css("height", servUtilHeight + "%");

					const rentHeight = $(`.js-rent.js-year-${year}`).data("height");
					$(".js-rent.js-year-1").css("height", rentHeight + "%");

					// Slide bars back up
					$(".js-graph").addClass("show-bars");
					animating = false;
				}, 1200);
			}
		});
	}
}
