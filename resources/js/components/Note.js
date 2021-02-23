import React from 'react';
import FormNote from './FormNote';
import './NoteStyle.css'


class Note extends React.Component {

    constructor(props){
        super(props)

        this.state = {
            read : true,
            note: this.props.note,
            position: this.props.position,
            loader: false
        }

        this.handleDblClick = this.handleDblClick.bind(this)
        this.submit = this.submit.bind(this)
    }

    handleDblClick (e) {
        this.setState({
            read: !this.state.read
        })
    }

    submit(id, note, position) {
        this.setState({
            loader: true
        })

        axios.patch('/master/notes/' + id + '/store', {
            position: position,
            note: note
        }).then(response => {
            // console.log(response.data)
            this.setState({
                read: true,
                note: response.data.note,
                loader: false
            })
        }).catch((error) => {
            // console.log(error.response.data)
            if (error.response.status == 400) {
                alert(error.response.data.note ? error.response.data.note : error.response.data.position)
            }
            if (error.response.status == 401) {
                alert(error.response.data)
            }
            this.setState({
                read: true,
                loader: false
            })
        })
    }

    render() {
        return (
            <div className="note-td-content">
                {(this.state.loader) 
                ? <div className="loader"></div>
                :  this.state.read 
                    ? <div onDoubleClick={this.handleDblClick}>{this.state.note} / {this.props.dividente}</div>
                    : <FormNote 
                        id={this.props.id} 
                        note={this.state.note} 
                        position={this.state.position} 
                        dividente={this.props.dividente}
                        submit={this.submit} />}
            </div>
        );
    }
}

export default Note;
