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
require('./Niveau/Niveau')
// Gestion des classes
require('./Classe/Classe')
require('./Classe/Missing')
