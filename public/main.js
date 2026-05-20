const cookieBanner = document.getElementById("cookie-banner")

function showSidebar(){
    const sidebar = document.querySelector('.sidebar')
    sidebar.style.display = 'flex'
}

function hideSidebar(){
    const sidebar = document.querySelector('.sidebar')
    sidebar.style.display = 'none'
}

/*----Dropdown Helpers----*/

function toggleDropdown(id) {
    var allDropdowns = document.querySelectorAll('.index-dropdown-content')
    allDropdowns.forEach(function(d) {
        if (d.id !== id) {
            d.classList.remove('show')
            var btn = d.previousElementSibling
            if (btn) btn.removeAttribute('aria-expanded')
        }
    })
    var target = document.getElementById(id)
    var btn = target.previousElementSibling
    var isOpen = target.classList.toggle('show')
    if (btn) btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false')
}

function filterDropdown(id) {
    var input = document.querySelector('#' + id + ' input')
    if (!input) return
    var filter = input.value.toUpperCase()
    var div = document.getElementById(id)
    var a = div.getElementsByTagName('a')
    for (var i = 0; i < a.length; i++) {
        var txtValue = a[i].textContent || a[i].innerText
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = ''
        } else {
            a[i].style.display = 'none'
        }
    }
}

/*----Dropdown Toggle Functions----*/

function kommunFunction() { toggleDropdown('kommun-dorpdown') }
function tjanstFunction()  { toggleDropdown('tjanst-dorpdown') }
function djurtypFunction() { toggleDropdown('djurtyp-dorpdown') }
function storlekFunction() { toggleDropdown('storlek-dorpdown') }
function prisFunction()    { toggleDropdown('pris-dorpdown') }

/*----Dropdown Filter Functions----*/

function filterFunctionKommun() { filterDropdown('kommun-dorpdown') }
function filterFunctionTjanst() { filterDropdown('tjanst-dorpdown') }
function filterFunctionDjurtyp() { filterDropdown('djurtyp-dorpdown') }

/*----Option Selection — Update Button Text----*/

document.addEventListener('click', function(event) {
    var link = event.target.closest('.index-dropdown-content a')
    if (!link) return
    event.preventDefault()
    var dropdown = link.closest('.index-dropdown-content')
    var btn = dropdown.previousElementSibling
    var btnText = btn && btn.querySelector('.index-dropdown-btn-text')
    if (btnText) btnText.textContent = link.textContent.trim()
    dropdown.classList.remove('show')
    if (btn) btn.removeAttribute('aria-expanded')
})

/*----Price Slider (custom drag-based)----*/

var pris = {
    min: 140,
    max: 270,
    rangeMin: 0,
    rangeMax: 500,
    step: 10,
    dragging: null   // 'min' or 'max'
}

function clamp(val, lo, hi) {
    return Math.max(lo, Math.min(hi, val))
}

function snapToStep(val) {
    return Math.round(val / pris.step) * pris.step
}

function valueFromClientX(clientX) {
    var wrapper = document.getElementById('pris-slider-wrapper')
    if (!wrapper) return 0
    var rect = wrapper.getBoundingClientRect()
    var pct = clamp((clientX - rect.left) / rect.width, 0, 1)
    return snapToStep(pris.rangeMin + pct * (pris.rangeMax - pris.rangeMin))
}

function renderPriceSlider() {
    var span = (pris.rangeMax - pris.rangeMin)
    var leftPct  = (pris.min - pris.rangeMin) / span * 100
    var rightPct = (pris.max - pris.rangeMin) / span * 100

    var range = document.getElementById('pris-range')
    if (range) {
        range.style.left  = leftPct + '%'
        range.style.width = (rightPct - leftPct) + '%'
    }

    var thumbMin = document.getElementById('pris-thumb-min')
    var thumbMax = document.getElementById('pris-thumb-max')
    if (thumbMin) thumbMin.style.left = leftPct + '%'
    if (thumbMax) thumbMax.style.left = rightPct + '%'

    var btnText = document.getElementById('pris-btn-text')
    if (btnText) btnText.textContent = pris.min + 'kr-' + pris.max + 'kr'

    var minDisplay = document.getElementById('pris-min-display')
    var maxDisplay = document.getElementById('pris-max-display')
    if (minDisplay) minDisplay.textContent = pris.min + ' kr'
    if (maxDisplay) maxDisplay.textContent = pris.max + ' kr'
}

function initPriceSlider() {
    renderPriceSlider()

    function onDragStart(thumbId, e) {
        e.preventDefault()
        pris.dragging = thumbId
        var el = document.getElementById('pris-thumb-' + thumbId)
        if (el) el.classList.add('dragging')
    }

    function onDragMove(clientX) {
        if (!pris.dragging) return
        var val = valueFromClientX(clientX)
        if (pris.dragging === 'min') {
            pris.min = clamp(val, pris.rangeMin, pris.max - pris.step)
        } else {
            pris.max = clamp(val, pris.min + pris.step, pris.rangeMax)
        }
        renderPriceSlider()
    }

    function onDragEnd() {
        if (!pris.dragging) return
        var el = document.getElementById('pris-thumb-' + pris.dragging)
        if (el) el.classList.remove('dragging')
        pris.dragging = null
    }

    var tMin = document.getElementById('pris-thumb-min')
    var tMax = document.getElementById('pris-thumb-max')
    if (tMin) {
        tMin.addEventListener('mousedown',  function(e) { onDragStart('min', e) })
        tMin.addEventListener('touchstart', function(e) { onDragStart('min', e) }, { passive: false })
    }
    if (tMax) {
        tMax.addEventListener('mousedown',  function(e) { onDragStart('max', e) })
        tMax.addEventListener('touchstart', function(e) { onDragStart('max', e) }, { passive: false })
    }

    document.addEventListener('mousemove',  function(e) { onDragMove(e.clientX) })
    document.addEventListener('touchmove',  function(e) { onDragMove(e.touches[0].clientX) }, { passive: true })
    document.addEventListener('mouseup',    onDragEnd)
    document.addEventListener('touchend',   onDragEnd)
}

document.addEventListener('DOMContentLoaded', initPriceSlider)

/*----Mobile Filter Toggle----*/

function toggleMobileFilters() {
    var container = document.getElementById('index-filter-container')
    var chevron   = document.getElementById('filter-toggle-chevron')
    var isOpen    = container.classList.toggle('mobile-visible')
    if (chevron) chevron.classList.toggle('open', isOpen)
}

/*----Clear All Filters----*/

function clearFilters() {
    document.querySelectorAll('.index-dropdown-content').forEach(function(d) {
        d.classList.remove('show')
        var searchInput = d.querySelector('input[type="text"]')
        if (searchInput) {
            searchInput.value = ''
            filterDropdown(d.id)
        }
        var btn = d.previousElementSibling
        if (btn) btn.removeAttribute('aria-expanded')
    })
    document.querySelectorAll('.index-dropdown-btn-text').forEach(function(span) {
        var label = span.closest('.index-filter-group').querySelector('.index-filter-label')
        if (!label) return
        var key = label.textContent.trim().toUpperCase()
        var defaults = {
            'KOMMUN':  'Kommuner',
            'TJÄNST':  'Tjänster',
            'DJURTYP': 'Djurtyper',
            'STORLEK': 'Storlekar'
        }
        if (defaults[key]) span.textContent = defaults[key]
    })

    pris.min = 140
    pris.max = 270
    renderPriceSlider()

    var dateInput = document.getElementById('datum-input')
    if (dateInput) dateInput.value = ''
}

/*----Close Dropdowns On Outside Click----*/

window.onclick = function(event) {
    if (
        !event.target.matches('.index-dropdown-btn') &&
        !event.target.matches('.index-dropdown-btn-text') &&
        !event.target.matches('.index-dropdown-chevron') &&
        !event.target.closest('.index-dropdown-content')
    ) {
        document.querySelectorAll('.index-dropdown-content').forEach(function(d) {
            d.classList.remove('show')
            var btn = d.previousElementSibling
            if (btn) btn.removeAttribute('aria-expanded')
        })
    }
}
