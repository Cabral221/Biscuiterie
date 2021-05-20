
var btns_toggle = document.querySelectorAll('.classe_toggle_form')

// Creer le formulaire de 
const submitFormClasse = (e) => {
    e.preventDefault()
    var form = e.currentTarget
    var data = new FormData(form)

    // recuperer les donnee du form
    const libele = (data.get('libele')).toUpperCase()
    const user_id = parseInt(data.get('user_id'))
    const niveau_id = parseInt(data.get('niveau_id'))
    const program_id = parseInt(data.get('program_id'))

    let input = form.querySelector("#classe_libele_" + program_id)
    let selectUser = form.querySelector("#classe_user_id_" + program_id)
    let selectNiveau = form.querySelector("#classe_niveau_id_" + program_id)

    // Valider le formulaire coté front
    // ...

    // Demarer le loader
    var divLoader = form.querySelectorAll('.classe_info')[0]
    divLoader.innerHTML = "<span class='loader'></span>"
    
    // Construire la requette à envoyé
    window.axios.post("/admin/programs/classes", {
        libele: libele,
        user_id: user_id,
        niveau_id: niveau_id
    }).then((response) => {
        // console.log('success')
        // console.log(response.data)

        // Reset s'il y avait des erreurs
        let inputFormGroup = input.parentNode
        let selectUserFormGroup = selectUser.parentNode
        let selectNiveauFormGroup = selectNiveau.parentNode

        if(inputFormGroup.classList.contains('has-error')){
            let spanMessage = inputFormGroup.getElementsByClassName('help-block')[0] 
            inputFormGroup.classList.remove('has-error')
            inputFormGroup.removeChild(spanMessage)
        }
        if(selectUserFormGroup.classList.contains('has-error')){
            let spanMessage = selectUserFormGroup.getElementsByClassName('help-block')[0] 
            selectUserFormGroup.classList.remove('has-error')
            selectUserFormGroup.removeChild(spanMessage)
        }
        if(selectNiveauFormGroup.classList.contains('has-error')){
            let spanMessage = selectNiveauFormGroup.getElementsByClassName('help-block')[0] 
            selectNiveauFormGroup.classList.remove('has-error')
            selectNiveauFormGroup.removeChild(spanMessage)
        }

        // Construre la response de succés
        if(response.status == 200) {
            var classe = response.data
            // Effacer le contenu des champs du formulaire 
            form.reset()
            // Append un span badge
            var newSpan = document.createElement('span')
                newSpan.classList.add('badge')
                newSpan.classList.add('badge-primary')
                newSpan.style.marginRight = "4px"
                newSpan.innerHTML = classe.libele
            var oldSpans = form.parentNode.parentNode.querySelectorAll('.badge-primary')
            var lastSpan = oldSpans[oldSpans.length - 1]
                lastSpan.style.marginRight = "4px"
                lastSpan.after(newSpan)
            // Afficher le success
            var message = document.createElement('p')
                message.classList.add('alert')
                message.classList.add('alert-success')
                message.innerHTML = "La Classe " + classe.libele + " ajouté avec succés"
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

            // Reload page pour charger de nouveau les enseignants disponible
            // ...
            // OU supprimer tous les elements opton de selection des enseignants
            // ...
        }
    }).catch((error) => {
        // console.log('error')
        // console.log(error.response.data)
        // Erreur
        // Afficher erreurs sous le input
        if(error.response.data.libele){
            let formGroup = input.parentNode
            let spanMessage = document.createElement('span')
                spanMessage.classList.add('help-block')
                spanMessage.innerHTML = error.response.data.libele ?? 'Une erreur s\'est produite !'
            formGroup.classList.add('has-error')
            formGroup.appendChild(spanMessage)
        }
        if(error.response.data.user_id){
            let formGroup = selectUser.parentNode
            let spanMessage = document.createElement('span')
                spanMessage.classList.add('help-block')
                spanMessage.innerHTML = error.response.data.user_id ?? 'Une erreur s\'est produite !'
            formGroup.classList.add('has-error')
            formGroup.appendChild(spanMessage)
        }
        if(error.response.data.niveau_id){
            let formGroup = selectNiveau.parentNode
            let spanMessage = document.createElement('span')
                spanMessage.classList.add('help-block')
                spanMessage.innerHTML = error.response.data.niveau_id ?? 'Une erreur s\'est produite !'
            formGroup.classList.add('has-error')
            formGroup.appendChild(spanMessage)
        }
        
        // Terminer le loader
        divLoader.innerHTML = ''
    })
}

const toggle_form_add_classe = (e) => {
    e.preventDefault()
    const btn = e.currentTarget
    if(btn.classList.contains("badge-success")){
        btn.classList.replace("badge-success", "badge-danger")
        btn.innerHTML = "<i class='fa fa-close'></i>"
    }else{
        btn.classList.replace("badge-danger", "badge-success")
        btn.innerHTML = "<i class='fa fa-plus'></i>"
    }
    var divForm = btn.parentNode.getElementsByClassName('form_add_classe')[0]
    divForm.classList.toggle('d-none')
}

if (btns_toggle.length > 0) {
    btns_toggle.forEach(btn => {
        btn.addEventListener("click", toggle_form_add_classe)

        // Recuperer le formulaire et Accrocher l'event de summission
        var form = btn.parentNode.getElementsByClassName('form_classe')[0]
        form.addEventListener('submit', submitFormClasse)
    })
}
