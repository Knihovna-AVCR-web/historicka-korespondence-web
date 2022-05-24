import Alpine from 'alpinejs'
import baguetteBox from 'baguettebox.js'

window.Alpine = Alpine

Alpine.start()

document.addEventListener('DOMContentLoaded', () => {
    document
        .querySelectorAll('.wp-block-image')
        .forEach((image) =>
            image.classList.add(
                image.closest('.wp-block-gallery')
                    ? 'wp-block-image-in-gallery'
                    : 'wp-block-image-single'
            )
        )
    baguetteBox.run('.wp-block-gallery')
    baguetteBox.run('.wp-block-image-single', {
        buttons: false,
    })
    baguetteBox.run('.wp-block-media-text', {
        buttons: false,
    })
    baguetteBox.run('.gallery', {
        filter: /.+/i,
    })
})
