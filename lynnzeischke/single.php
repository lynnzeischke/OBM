<?php
/**
 * Einzelner Blogartikel.
 *
 * @package lynnzeischke
 */

get_header();

while ( have_posts() ) :
	the_post();
	$cat     = lz_primary_category();
	$content = lz_prepare_content( apply_filters( 'the_content', get_the_content() ) );
	$toc     = lz_toc_from_content( $content );
	$cta     = lz_cta_for_category( $cat );
	?>
	<article <?php post_class( 'single-post' ); ?>>
		<header class="page-hero post-hero">
			<div class="hero-grid" aria-hidden="true"></div>
			<div class="container narrow">
				<?php lz_breadcrumbs(); ?>
				<?php if ( $cat ) : ?>
					<a class="eyebrow" href="<?php echo esc_url( get_category_link( $cat ) ); ?>" data-reveal><?php echo esc_html( $cat->name ); ?></a>
				<?php endif; ?>
				<h1 data-reveal style="--d:1"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="lead" data-reveal style="--d:2"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
				<p class="post-meta" data-reveal style="--d:3">
					<?php esc_html_e( 'Von Lynn Zeischke', 'lynnzeischke' ); ?> ·
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					<?php if ( get_the_modified_date( 'Ymd' ) > get_the_date( 'Ymd' ) ) : ?>
						· <?php esc_html_e( 'aktualisiert', 'lynnzeischke' ); ?> <time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( get_the_modified_date() ); ?></time>
					<?php endif; ?>
					· <?php echo esc_html( lz_reading_time() ); ?>
				</p>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="container narrow post-cover" data-reveal>
				<?php the_post_thumbnail( 'large', array( 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?>
			</div>
		<?php endif; ?>

		<div class="container post-layout<?php echo $toc ? ' has-toc' : ''; ?>">
			<?php if ( $toc ) : ?>
				<aside class="toc" aria-label="<?php esc_attr_e( 'Inhalt', 'lynnzeischke' ); ?>">
					<p class="toc-title"><?php esc_html_e( 'Inhalt', 'lynnzeischke' ); ?></p>
					<ol>
						<?php foreach ( $toc as $item ) : ?>
							<li><a href="#<?php echo esc_attr( $item['id'] ); ?>"><?php echo esc_html( $item['text'] ); ?></a></li>
						<?php endforeach; ?>
					</ol>
				</aside>
			<?php endif; ?>

			<div class="post-body">
				<div class="entry-content prose">
					<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
				<?php
				wp_link_pages(
					array(
						'before' => '<nav class="page-links">',
						'after'  => '</nav>',
					)
				);
				?>

				<?php the_tags( '<p class="post-tags">', '', '</p>' ); ?>

				<div class="share">
					<span><?php esc_html_e( 'Teilen:', 'lynnzeischke' ); ?></span>
					<?php
					$url   = rawurlencode( get_permalink() );
					$title = rawurlencode( get_the_title() );
					?>
					<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo esc_attr( $url ); ?>" target="_blank" rel="noopener">LinkedIn</a>
					<a href="https://wa.me/?text=<?php echo esc_attr( $title . '%20' . $url ); ?>" target="_blank" rel="noopener">WhatsApp</a>
					<a href="mailto:?subject=<?php echo esc_attr( $title ); ?>&amp;body=<?php echo esc_attr( $url ); ?>"><?php esc_html_e( 'E-Mail', 'lynnzeischke' ); ?></a>
					<button type="button" class="copy-link" data-url="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'Link kopieren', 'lynnzeischke' ); ?></button>
				</div>

				<aside class="author-box">
					<span class="lz-mark" aria-hidden="true">LZ</span>
					<div>
						<p class="author-name">Lynn Zeischke</p>
						<p><?php echo esc_html( lz_opt( 'hero_badge' ) ); ?></p>
					</div>
				</aside>

				<aside class="cta-box">
					<p class="cta-kicker"><?php esc_html_e( 'Kostenfrei & unverbindlich', 'lynnzeischke' ); ?></p>
					<h2><?php echo esc_html( $cta['title'] ); ?></h2>
					<p><?php echo esc_html( $cta['text'] ); ?></p>
					<div class="cta-actions">
						<a class="btn btn-dark" href="<?php echo esc_url( lz_link( $cta['link'] . '#kontakt' ) ); ?>"><?php esc_html_e( 'Erstgespräch anfragen', 'lynnzeischke' ); ?> <span class="arrow" aria-hidden="true">→</span></a>
						<a class="btn btn-outline-dark" href="<?php echo esc_url( lz_link( $cta['link'] ) ); ?>"><?php echo esc_html( $cta['label'] ); ?></a>
					</div>
				</aside>
			</div>
		</div>
	</article>

	<?php
	$related = lz_related_posts( 3 );
	if ( $related->have_posts() ) :
		?>
		<section class="section section-alt">
			<div class="container">
				<div class="section-head">
					<span class="eyebrow"><?php esc_html_e( 'Weiterlesen', 'lynnzeischke' ); ?></span>
					<h2><?php esc_html_e( 'Das könnte Sie auch interessieren', 'lynnzeischke' ); ?></h2>
				</div>
				<div class="grid grid-3 post-grid">
					<?php
					$i = 0;
					while ( $related->have_posts() ) :
						$related->the_post();
						get_template_part( 'template-parts/post', 'card', array( 'delay' => $i++ ) );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<?php
endwhile;

get_footer();
