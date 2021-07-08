import Swal from 'sweetalert2'

var btns_toggle_missing = document.querySelectorAll('.toggle-missing-checkbox')
var btns_toggle_missing_from_admin = document.querySelectorAll('.toggle-missing-checkbox-admin')

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
        Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: response.data.message,
            timer: 1000,
            showConfirmButton: false,
        })
        // desable loader
        div.classList.remove('loader')
        div.appendChild(checkbox)
        
    }).catch((error) => {
        console.log(error.response)
        // sweet Alert
        Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: response.data.message,
            timer: 1000,
            showConfirmButton: false,
        })
        // desable loader
        div.classList.remove('loader')
        div.appendChild(checkbox)
    })
}

const toggle_missing_student_from_admin = (e) => {
    e.preventDefault()
    let checkbox = e.target
    let id = checkbox.dataset.missingid
    let classeId = checkbox.dataset.classeid
    // Active loader
    let div = checkbox.parentNode
    div.innerHTML = ""
    div.classList.add('loader')
    // toggle http
    window.axios.post("/admin/classes/"+ classeId +"/missing/mark", {
        missing_list_item: id
    }).then((response) => {
        console.log(response.data)
        // sweet Alert
        Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: response.data.message,
            timer: 1000,
            showConfirmButton: false,
        })
        // desable loader
        div.classList.remove('loader')
        div.appendChild(checkbox)
        // Reecrire le td à coté
        let nextTd = div.parentNode.nextElementSibling;
        nextTd.innerHTML = (response.data.missingState) 
                                ? "<span class='badge badge-danger'>Absent(e)</span>" 
                                : "<span class='badge badge-success'><i class='fa fa-check'></i></span>";
        
    }).catch((error) => {
        console.log(error)
        // sweet Alert
        Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: response.data.message,
            timer: 1000,
            showConfirmButton: false,
        })
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

if (btns_toggle_missing_from_admin.length > 0) {
    // Parcourir et ecouter le onChange
    btns_toggle_missing_from_admin.forEach((checkbox) => {
        checkbox.addEventListener('change', toggle_missing_student_from_admin)
    })
}
