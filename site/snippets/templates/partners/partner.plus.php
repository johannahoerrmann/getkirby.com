<a href="<?= $partner->url() ?>" data-country="<?= $partner->country() ?>" data-type="<?= $partner->type() ?>">
	<article>
		<p class="flex items-center text-xs" style="gap: var(--spacing-1)">
			<?= ucfirst($partner->type()) ?>
			<span class="mr-1"
						title="Certified Kirby Partner"><?= icon('verified') ?></span>
		</p>
		<h3 class="h3 truncate flex mb-3 items-center">
			<?= $partner->title() ?>
		</h3>
		<figure>
			<div style="--aspect-ratio: 3/2" class="mb-3">
				<?php if ($image = $partner->card()): ?>
					<?= $image->resize(800) ?>
				<?php elseif ($image = $partner->avatar()): ?>
					<span class="p-6 bg-light">
						<img class="shadow-xl bg-white" style="width: auto; height: 100%;"
								 src="<?= $image->resize(650)->url() ?>">
					</span>
				<?php endif ?>
			</div>
			<figcaption class="font-mono text-sm mb-6">
				<p>
					<?= $partner->subtitle() ?>
				</p>
				<p class="color-gray-600">
					<?= $partner->location() ?>
				</p>
			</figcaption>
		</figure>
		<div class="prose text-base">
			<?= $partner->summary() ?>
		</div>
	</article>
</a>
