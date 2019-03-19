if (
    !document.implementation.hasFeature(
        'http://www.w3.org/TR/SVG11/feature#Image',
        '1.1'
    )
) {
    let imgs = document.querySelectorAll('img')
    let endsWithDotSvg = /.*\.svg$/
    let i = 0
    let l = imgs.length
    for (; i != l; ++i) {
        if (imgs[i].src.match(endsWithDotSvg)) {
            imgs[i].src = imgs[i].src.slice(0, -3) + 'png'
        }
    }
}
