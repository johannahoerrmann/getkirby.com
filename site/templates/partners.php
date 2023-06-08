<?php layout() ?>

<style>
	.partners-header {
		display: flex;
		flex-direction: column;
		gap: var(--spacing-8);
	}
	.partners-header nav {
		--min: 9rem;
		--gap: var(--spacing-3);
		max-width: 26rem;
	}

	.partners, .partners-plus {
		--columns: 2;
	}

	@media screen and (max-width: 35rem) {
		.partners-header nav {
			grid-template-columns: 1fr;
		}
		.partners {
			--columns: 1;
		}
	}

	@media screen and (min-width: 60rem) {
		.partners-plus {
			--columns: 3;
		}
		.partners {
			--columns: 3;
		}
	}

	@media screen and (min-width: 70rem) {
		.partners-header {
			align-items: flex-end;
			flex-direction: row;
			justify-content: space-between;
		}
	}
</style>

<article>

	<header class="mb-36">
		<div class="partners-header mb-6">
			<div class="max-w-xl">
				<h1 class="h1 mb-6">Find a Kirby partner to trust with your next
					project</h1>
				<p class="text-xl leading-snug color-gray-700">
					Our curated partners know Kirby inside out and have a wide range of
					experience in web development. Find trusted developers from all over the
					world and rest assured that there is always someone you can turn to.
				</p>
			</div>
			<nav class="auto-fit items-center">
				<a class="btn btn--filled" href="https://airtable.com/shrfCqUxq5L3GyhIb">
					<?= icon('mail') ?>
					Post your project
				</a>
				<a class="btn btn--outlined" href="/partners/join">
					<?= icon('verified') ?>
					Become a partner
				</a>
			</nav>
		</div>

		<div class="partners-filters">
			<h2>Filter</h2>
			<select data-field="languages" data-multiple="true" aria-label="Language filter">
				<option value="_all">All languages</option>
				<option>Czech</option>
				<option>Dutch</option>
				<option>English</option>
				<option>French</option>
				<option>German</option>
				<option>Hungarian</option>
				<option>Italian</option>
				<option>Slovak</option>
				<option>Turkish</option>
			</select>
			<select data-field="region" aria-label="Region filter">
				<option value="_all">All regions</option>
				<option>Asia</option>
				<option>Europe</option>
				<option>North America</option>
			</select>
			<select data-field="type" aria-label="Business type filter">
				<option value="_all">All business types</option>
				<option value="solo">Solo businesses</option>
				<option value="team">Team businesses</option>
			</select>
		</div>
	</header>
	<section class="partners-section partners-plus columns mb-42" style="--gap: var(--spacing-24)">
		<?php foreach ($plus as $partner) : ?>
			<?php snippet('templates/partners/partner.plus', ['partner' => $partner]) ?>
		<?php endforeach ?>
	</section>

	<section class="partners-section partners columns mb-42"
					 style="--column-gap: var(--spacing-24); --row-gap: var(--spacing-12)">
		<?php foreach ($standard as $partner) : ?>
			<?php snippet('templates/partners/partner', ['partner' => $partner]) ?>
		<?php endforeach ?>
	</section>

</article>

<script>
document.querySelectorAll('.partners-filters select').forEach((select) => {
	// field in the dataset of each partner this select filters by
	const field = select.dataset.field;

	// whether this filter can match any of multiple comma-separated values
	const multiple = select.dataset.multiple === 'true';

	select.addEventListener('input', (event) => {
		// filter all nodes that have the data attribute we are filtering by
		document.querySelectorAll('article [data-' + field + ']').forEach((partner) => {
			// keep an object of all filter fields that *don't* match this partner
			partner.partnerFilters ||= {};

			// check if the partner matches the filter (depending on the filter type)
			let matches = null;
			if (multiple === true) {
				const options = partner.dataset[field].split(',');

				matches = options.includes(select.value) === true;
			} else {
				matches = partner.dataset[field] === select.value;
			}

			// update the object of filter fields accordingly
			if (matches === true || select.value === '_all') {
				delete partner.partnerFilters[field];
			} else {
				partner.partnerFilters[field] = false;
			}

			// if there is at least one list entry, at least one of the filters
			// doesn't match this partner, so hide it from the list
			if (Object.keys(partner.partnerFilters).length > 0) {
				partner.style.display = 'none';
			} else {
				partner.style.display = null;
			}
		});

		// hide sections that have no visible children with the current filters
		// (hides the duplicated margins)
		document.querySelectorAll('.partners-section').forEach((section) => {
			// first make it visible if it was hidden before so we can measure its height
			section.style.display = null;

			// check if there is content within the section; otherwise hide it (again)
			if (section.offsetHeight === 0) {
				section.style.display = 'none';
			}
		});
	});
});
</script>
