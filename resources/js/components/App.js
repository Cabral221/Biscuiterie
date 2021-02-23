import React from 'react';
import ReactDOM from 'react-dom';

import Note from './Note';


const notes_td = document.querySelectorAll('.note-td');

notes_td.forEach((note_td) => {
    const id = parseInt(note_td.dataset.note_id)
    const note = parseFloat(note_td.dataset.note)
    const position = note_td.dataset.note_position
    const dividente = parseInt(note_td.dataset.note_dividente)

    ReactDOM.render(<Note id={id} note={note} position={position} dividente={dividente} />, note_td)
})
