var btns_toggle = document.querySelectorAll('.niveau_toggle_form')

// Creer le formulaire de 
const submitFormNiveau = (e) => {
    e.preventDefault()
    var form = e.currentTarget
    var data = new FormData(form)
    // recuperer les donnee du form
    const libele = data.get('libele')
    const program_id = data.get('program_id')
    var input = form.querySelector("#niveau_libele_" + program_id)
    // Valider le formulaire coté front
    // ...

    // Demarer le loader
    var divLoader = form.querySelectorAll('.niveau_info')[0]
    divLoader.innerHTML = "<span class='loader'></span>"
    
    // Construire la requete à envoyé
    window.axios.post("/admin/programs/niveaux", {
        program_id: program_id,
        libele: libele
    }).then((response) => {
        console.log('success')
        var formGroup = input.parentNode
        if(formGroup.classList.contains('has-error')){
            let spanMessage = formGroup.getElementsByClassName('help-block')[0] 
            formGroup.classList.remove('has-error')
            formGroup.removeChild(spanMessage)
        }

        if(response.status == 200) {
            var niveau = response.data
            // Effacer le input
            input.value = ''
            // Append un span badge
            var newSpan = document.createElement('span')
                newSpan.classList.add('badge')
                newSpan.classList.add('badge-primary')
                newSpan.style.marginRight = "4px"
                newSpan.innerHTML = niveau.libele
            var oldSpans = form.parentNode.parentNode.querySelectorAll('.badge-primary')
            var lastSpan = oldSpans[oldSpans.length - 1]
                lastSpan.style.marginRight = "4px"
                lastSpan.after(newSpan)
            // Afficher le success
            var message = document.createElement('p')
                message.classList.add('alert')
                message.classList.add('alert-success')
                message.innerHTML = 'Niveau ajouté avec succés'
            var firstSpan = oldSpans[0]
                firstSpan.before(message)
            setTimeout(() => {
                return message.remove()
            }, 3000)

            // Terminer le loader
            divLoader.innerHTML = ''
            // Toggle le formulaire (button + form)
            var btn = form.parentNode.previousElementSibling
                btn.classList.replace("badge-danger", "badge-success")
                btn.innerHTML = "<i class='fa fa-plus'></i>"
            form.parentNode.classList.add('d-none')
        }
    }).catch((error) => {
        console.log('error')
        console.log(error.response.data)
        // Afficher erreurs sous le input
        var formGroup = input.parentNode
        var spanMessage = document.createElement('span')
            spanMessage.classList.add('help-block')
            spanMessage.innerHTML = error.response.data.libele ?? 'Une erreur s\'est produite !'
            formGroup.classList.add('has-error')
            formGroup.appendChild(spanMessage)
        // Terminer le loader
        divLoader.innerHTML = ''
    })
}

const toggle_form_add = (e) => {
    e.preventDefault()
    const btn = e.currentTarget
    if(btn.classList.contains("badge-success")){
        btn.classList.replace("badge-success", "badge-danger")
        btn.innerHTML = "<i class='fa fa-close'></i>"
    }else{
        btn.classList.replace("badge-danger", "badge-success")
        btn.innerHTML = "<i class='fa fa-plus'></i>"
    }
    var divForm = btn.parentNode.getElementsByClassName('form_add_niveau')[0]
    divForm.classList.toggle('d-none')
}

if (btns_toggle.length > 0) {
    btns_toggle.forEach(btn => {
        btn.addEventListener("click", toggle_form_add)

        // Recuperer le formulaire et Accrocher l'event de summission
        var form = btn.parentNode.getElementsByClassName('form_niveaux')[0]
        form.addEventListener('submit', submitFormNiveau)
    })
}
