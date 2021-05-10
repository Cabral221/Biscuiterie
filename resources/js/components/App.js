import React from 'react'
import ReactDOM from 'react-dom'

import Note from './Notes/Note'
import History from './Histories/History'

// Gestion des notes
const notes_td = document.querySelectorAll('.note-td')

notes_td.forEach((note_td) => {
    const id = parseInt(note_td.dataset.note_id)
    const note = parseFloat(note_td.dataset.note)
    const position = parseInt(note_td.dataset.note_position)
    const dividente = parseInt(note_td.dataset.note_dividente)
    
    ReactDOM.render(<Note id={id} note={note} position={position} dividente={dividente} />, note_td)
})

// Gestion de l'historique
const element = document.getElementById('histories_content')
if(element != undefined){
    ReactDOM.render(<History />, element)
}


// Gestion des niveaux
var btns_toggle = document.querySelectorAll('.niveau_toggle_form')

const toggle_form_add = (e) => {
    const btn = e.currentTarget
    if(btn.classList.contains("badge-success")){
        btn.classList.replace("badge-success", "badge-danger")
        btn.innerHTML = "<i class='fa fa-close'></i>"
    }else{
        btn.classList.replace("badge-danger", "badge-success")
        btn.innerHTML = "<i class='fa fa-plus'></i>"
    }

    var parent = btn.parentNode
    var divForm = parent.getElementsByClassName('form_add_niveau')
    divForm[0].classList.toggle('d-none')
}

if (btns_toggle.length > 0) {
    btns_toggle.forEach(btn => {
        console.log(btn)
        btn.addEventListener("click", toggle_form_add)
    })
}
