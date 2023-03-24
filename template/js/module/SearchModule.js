export default function SearchModule() {
    const searchBtn = document.querySelector('.header-search')
    const searchForm = document.querySelector('.search-mona')
    let isSearchOpen = false
    if (searchBtn) {
        searchBtn.addEventListener('click', () => {
            isSearchOpen = !isSearchOpen
            if (isSearchOpen) {
                searchForm.classList.add('open')
            } else {
                searchForm.classList.remove('open')
            }
        })
    }
    window.addEventListener('click', (e) => {
        const notForm = searchForm.contains(e.target)
        const notBtn = searchBtn.contains(e.target)
        isSearchOpen = false;
        if (!notForm && !notBtn) {
            searchForm.classList.remove('open')
        }
    })
}