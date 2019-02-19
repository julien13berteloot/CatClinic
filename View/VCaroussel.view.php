<?php
/**
 * Affichage du caroussel
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXAM-CNAM
 *
 */
class VCaroussel
{
	/**
	* Constructeur
	*/
	public function __construct() {}

	/**
	* Destructeur
	*/
	public function __destruct() {}

	/**
	* Affichage du caroussel
	*
	* @return none
	*/
	public function showCaroussel()
	{
		echo '
		<div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
			<div class="orbit-wrapper">
				<div class="orbit-controls">
				  <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
				  <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
				</div>
				<ul class="orbit-container">
					<li class="is-active orbit-slide">
						<figure class="orbit-figure">
							<img class="orbit-image" src="https://placehold.it/1200x600/999?text=Slide-1" alt="Space">
							<figcaption class="orbit-caption">Space, the final frontier.</figcaption>
						</figure>
					</li>
					<li class="orbit-slide">
						<figure class="orbit-figure">
							<img class="orbit-image" src="https://placehold.it/1200x600/888?text=Slide-2" alt="Space">
							<figcaption class="orbit-caption">Lets Rocket!</figcaption>
						</figure>
					</li>
					<li class="orbit-slide">
						<figure class="orbit-figure">
							<img class="orbit-image" src="https://placehold.it/1200x600/777?text=Slide-3" alt="Space">
							<figcaption class="orbit-caption">Encapsulating</figcaption>
						</figure>
					</li>
					<li class="orbit-slide">
						<figure class="orbit-figure">
							<img class="orbit-image" src="https://placehold.it/1200x600/666&text=Slide-4" alt="Space">
							<figcaption class="orbit-caption">Outta This World</figcaption>
						</figure>
					</li>
				</ul>
			</div>
			<nav class="orbit-bullets">
				<button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
				<button data-slide="1"><span class="show-for-sr">Second slide details.</span></button>
				<button data-slide="2"><span class="show-for-sr">Third slide details.</span></button>
				<button data-slide="3"><span class="show-for-sr">Fourth slide details.</span></button>
			</nav>
		</div>
		';
	}
  
} // VCaroussel

?>