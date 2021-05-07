import React from 'react';
import ReactDOM from 'react-dom';

import Note from './Note';
import History from './Histories/History'

// Gestion des notes
const notes_td = document.querySelectorAll('.note-td');

notes_td.forEach((note_td) => {
    const id = parseInt(note_td.dataset.note_id)
    const note = parseFloat(note_td.dataset.note)
    const position = parseInt(note_td.dataset.note_position)
    const dividente = parseInt(note_td.dataset.note_dividente)
    
    ReactDOM.render(<Note id={id} note={note} position={position} dividente={dividente} />, note_td)
})

// Gestion de l'historique
const form_history = document.getElementById('form_range_history')
if (form_history) {
    console.log('formulaire historique');
    
    // Demarre le loader
    
    // Recuperer l'année selectionner
    const form_data = $(form_history).serializeArray()
    console.log(form_data[0].value)
    
    
    // A revoir l'approche
    var div = document.getElementById('histories_content')
    if(div != undefined && form_data[0].value){
        ReactDOM.render(<History year={form_data[0].value} />, div)
    }
    
}


// gestion de l'impression
// .. de manier ajaxifier
