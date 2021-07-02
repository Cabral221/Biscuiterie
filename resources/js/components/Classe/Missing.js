var btns_toggle_missing = document.querySelectorAll('.toggle-missing-checkbox')

const toggle_missing_student = (e) => {
    e.preventDefault()
    let checkbox = e.target
    let id = checkbox.dataset.missingid
    // Active loader
    let div = checkbox.parentNode
    div.innerHTML = ""
    div.classList.add('loader')
    // toggle http
    window.axios.post("/master/missing/mark", {
        missing_list_item: id
    }).then((response) => {
        console.log(response.data)
        // sweet Alert
        // ...
        // desable loader
        div.classList.remove('loader')
        div.appendChild(checkbox)
        
    }).catch((error) => {
        console.log(error.response)
        // sweet Alert
        // ...
        // desable loader
        div.classList.remove('loader')
        div.appendChild(checkbox)
    })
}

if (btns_toggle_missing.length > 0) {
    // Parcourir et ecouter le onChange
    btns_toggle_missing.forEach((checkbox) => {
        checkbox.addEventListener('change', toggle_missing_student)
    })
}
